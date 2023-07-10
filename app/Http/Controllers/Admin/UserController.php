<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Role;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Route;


/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::paginate();
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();

        $roles = Role::all()->pluck('name', 'id');

        return view('admin.users.create', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        // request()->validate(User::$rules);
        $request->validated();

        $user = User::create([
            'name' => $request->get('name'),
            'role_id' => $request->get('role_id'),
            'date_birth' => $request->get('date_birth'), 
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        foreach ($request->input('images', []) as $file) {
            $user->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images', 'users-media');
        }

        flash()->overlay('"'. $user->name . '"' . trans('global.created-succesfully'), trans('global.saved-user'));

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // $user = User::find($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all()->pluck('name', 'id');

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // request()->validate(User::$rules);
        
        $request->validated();

        $user->update($request->all());

        if (($user->getMedia('images'))) {
            foreach ($user->getMedia() as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }
    
        $media = $user->getMedia()->pluck('file_name')->toArray();
    
        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $user->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images','users-media');
            }
        }
    


        flash()->overlay('"'. $user->name . '"' . trans('global.updated-succesfully'), trans('global.updated-user'));

        return redirect()->route('users.index');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        flash()->overlay('"'. $user->name . '"' . trans('global.deleted-succesfully'), trans('global.deleted-user'));

        return redirect()->route('users.index');
    }

    public function changePasswordSave(Request $request){
        
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required','min:8','string'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        flash()->overlay(trans('password-changed-successfully'), trans('change-password'));
        return redirect()->route('users.index');
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function deleteMedia(Media $media)
    {
        //Delete on the server 
        File::delete(public_path('media/users/' . $media->model_id . "/" . $media->file_name));
       
        
        //Delete on the database
        $media->delete();

        flash()->overlay(trans('global.deleted-succesfully'), trans('global.delete-image'));

        return redirect()->route('users.index');
    }
}
