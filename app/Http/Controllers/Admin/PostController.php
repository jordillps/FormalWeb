<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\PostTranslation;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $users = User::all()->pluck('name', 'id');
        $categories = Category::all()->pluck('name', 'id');
        $tags = Tag::all()->pluck('name', 'id');
        return view('admin.posts.create', compact('post','users', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        
        $request->validated();

        $post = Post::create($request->all());

        //Post Url
        $post->url = Str::slug($post->title);
        $post->save();

        foreach ($request->input('images', []) as $file) {
            $post->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images', 'posts-media');
        }

        flash()->overlay('"'. $post->title . '"' . trans('global.created-succesfully'), trans('global.saved-post'));

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $users = User::all()->pluck('name', 'id');
        $categories = Category::all()->pluck('name', 'id');
        $tags = Tag::all()->pluck('name', 'id');
        return view('admin.posts.edit', compact('post', 'users', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {

        $request->validated();

        $post->update($request->all());

        if(!isset($request->isPublished)){
            $post->isPublished = 0;
            $post->published_at = null;
            $post->save();
        }

        $post->url = Str::slug($post->title);
        $post->save();

        $tags = collect($request->get('tags'))->map(function($tag){
            return Tag::find($tag) ? $tag : '';
                // : Tag::create(['name'=> $tag])->id;
        });

        $post->tags()->sync($tags);

        if (($post->getMedia('images'))) {
            foreach ($post->getMedia() as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }
    
        $media = $post->getMedia()->pluck('file_name')->toArray();
    
        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $post->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images','posts-media');
            }
        }
    
        
        flash()->overlay('"'. $post->title . '"' . trans('global.updated-succesfully'), trans('global.updated-post'));

        return redirect()->route('posts.index');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();

        $postTranslations = PostTranslation::where('post_id', $post->id)->get();

        foreach($postTranslations as $postTranslation){
            $postTranslation->delete();
        }

        flash()->overlay('"'. $post->title . '"' . trans('global.deleted-succesfully'), trans('global.deleted-post'));

        return redirect()->route('posts.index');
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
        File::delete(public_path('media/posts/' . $media->model_id . "/" . $media->file_name));


        //Delete on the database
        $media->delete();

        flash()->overlay(trans('global.deleted-succesfully'), trans('global.delete-image'));

        return redirect()->route('posts.index');
    }
}
