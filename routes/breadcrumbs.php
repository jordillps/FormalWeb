<?php // routes/breadcrumbs.php

use App\Models\User;
use App\Models\Post;
use App\Models\Project;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


//Admin
Breadcrumbs::for('admin', function ($trail) {
    $trail->push(trans('global.dashboard'), route('admin'));
});


// Users
Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push(trans('global.users'), route('users.index'));
});

// Users > Create User
Breadcrumbs::for('users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('users.index');
    $trail->push(trans('global.create-user'), route('users.create'));
});

// Users > Show User
Breadcrumbs::for('users.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('users.index');
    $trail->push($user->name, route('users.show', $user));
});

// Users > Edit User
Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('users.index');
    $trail->push($user->name, route('users.edit', $user));
});


// Posts
Breadcrumbs::for('posts.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push(trans('global.posts'), route('posts.index'));
});

// Posts > Create Post
Breadcrumbs::for('posts.create', function (BreadcrumbTrail $trail) {
    $trail->parent('posts.index');
    $trail->push(trans('global.create-post'), route('posts.create'));
});

// Posts > Show Post
Breadcrumbs::for('posts.show', function (BreadcrumbTrail $trail, Post $post) {
    $trail->parent('posts.index');
    if($post->title != null){
        $trail->push($post->title, route('posts.show', $post));
    }
});

// Posts > Edit Post
Breadcrumbs::for('posts.edit', function (BreadcrumbTrail $trail, Post $post) {
    $trail->parent('posts.index');
    if($post->title != null){
        $trail->push($post->title, route('posts.edit', $post));
    }
});


// Pages
Breadcrumbs::for('pages.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push(trans('global.pages'), route('pages.index'));
});

// Legal Pages
Breadcrumbs::for('legal-pages.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push(trans('global.legal-pages'), route('legal-pages.index'));
});

// Headers
Breadcrumbs::for('headers.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push(trans('global.headers'), route('headers.index'));
});

// Abouts
Breadcrumbs::for('abouts.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push(trans('global.about'), route('abouts.index'));
});

// Services
Breadcrumbs::for('services.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push(trans('global.services'), route('services.index'));
});

// Titles
Breadcrumbs::for('titles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push(trans('global.titles'), route('titles.index'));
});

// Contacts
Breadcrumbs::for('contacts-list.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push(trans('global.contacts'), route('contacts-list.index'));
});

// Tags
Breadcrumbs::for('tags.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push(trans('global.tags'), route('tags.index'));
});

// Categories
Breadcrumbs::for('categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push(trans('global.categories'), route('categories.index'));
});

// Projects
Breadcrumbs::for('projects.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push(trans('global.projects'), route('projects.index'));
});

// Projects > Create Project
Breadcrumbs::for('projects.create', function (BreadcrumbTrail $trail) {
    $trail->parent('projects.index');
    $trail->push(trans('global.create-project'), route('projects.create'));
});

// Projects > Show Project
Breadcrumbs::for('projects.show', function (BreadcrumbTrail $trail, Project $project) {
    $trail->parent('projects.index');
    if($project->title != null){
        $trail->push($project->title, route('projects.show', $project));
    }
});

// Projects > Edit Project
Breadcrumbs::for('projects.edit', function (BreadcrumbTrail $trail, Project $project) {
    $trail->parent('projects.index');
    if($project->title != null){
        $trail->push($project->title, route('projects.edit', $project));
    }
});





