<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;
use Astrotomic\Translatable\Translatable;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\JsonLd;
use App\Models\Category;




class BlogWebController extends Controller 
{
    use Translatable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        SEOTools::setTitle(trans('seo.blog-title'));
        SEOTools::setDescription(trans('seo.blog-description'));

        JsonLd::setTitle(trans('seo.blog-title'));
        JsonLd::setDescription(trans('seo.blog-description'));

        // dd($request->all());
        
        $posts = Post::where('isPublished', true)
        // ->leftJoin('post_translations', 'post_translations.post_id', 'posts.id')
        // ->where('post_translations.locale', app()->getLocale())
        ->orderBy('published_at', 'desc')->paginate(12);

        // $posts = $posts->map(function ($post) {
        //     return collect($post->toArray())
        //         ->only(['id', 'published_at', 'category_id','translations'])
        //         ->all();
        // });
        // return  $posts;

        if ($request->has('category') && $request->category != '') {
            $posts = Post::where('category_id', $request->category)->paginate(12);
        }
    
        $categories = Category::all();

        return view('blog', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        SEOTools::setTitle($post->{'title:'. app()->getLocale()});
        SEOTools::setDescription($post->{'excerpt:'. app()->getLocale()});

        JsonLd::setTitle($post->{'title:'. app()->getLocale()});
        JsonLd::setDescription($post->{'excerpt:'. app()->getLocale()});
        if(count($post->getMedia('images'))>1){
            JsonLd::addImage($post->getMedia('images')[1]->getUrl());
        }
            
        $setting = Setting::first();

        $tags = $post->tags;
        $relatedPosts = Post::where('category_id', $post->category_id)
        ->where('id','!=', $post->id)
        ->where('isPublished', true)
        ->take(3)
        ->get();

         //Previous post
        $previous_id = Post::where('user_id', $post->user_id)
        ->where('id','<', $post->id)
        ->max('id');
        $previous = Post::find($previous_id);

        //Next post
        $next_id = Post::where('user_id', $post->user_id)
            ->where('id','>', $post->id)
            ->min('id');
        $next = Post::find($next_id);

        return view('blog-details', compact('post', 'setting', 'tags', 'relatedPosts', 'previous', 'next'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
