<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TitleController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\LegalPageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\HomeWebController;
use App\Http\Controllers\AboutWebController;
use App\Http\Controllers\ServicesWebController;
use App\Http\Controllers\ProjectsWebController;
use App\Http\Controllers\BlogWebController;
use App\Http\Controllers\ContactWebController;
use App\Http\Controllers\LegalNoticeController;
use App\Http\Controllers\CookiesPolicyController;
use App\Http\Controllers\PrivacyPolicyController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Web
Route::get('/', [HomeWebController::class,'index'])->name('home');
Route::get('/sobre-mi-desarollador-web', [AboutWebController::class,'index'])->name('about-me');
Route::get('/servicios-desarrollo-web-seo', [ServicesWebController::class,'index'])->name('services');
Route::get('/proyectos-desarrollo-web-seo', [ProjectsWebController::class,'index'])->name('projects');
Route::get('/blog-desarrollo-web', [BlogWebController::class,'index'])->name('blog');
Route::get('/blog-desarrollo-web/{post}', [BlogWebController::class,'show'])->name('blog.show');
Route::get('/contacto-formal-web-lleida', [ContactWebController::class,'index'])->name('contact');

//Legal Pages
Route::get('/aviso-legal', [LegalNoticeController::class,'index'])->name('legal-notice');
Route::get('/politica-cookies', [CookiesPolicyController::class,'index'])->name('cookies-policy');
Route::get('/politica-privacidad', [PrivacyPolicyController::class,'index'])->name('privacy-policy');

Route::get('locale/{locale}', [LocalizationController::class,'setLocale'])->name('setLocale');

//Web Contacts
Route::resource('/contacts', ContactFormController::class);


//Auth
Auth::routes(['register' => false]);


//Admin
Route::group(['middleware' => ['auth']], function () {

    // Route::get('/emailverification', 'HomeController@emailverification')->name('emailverification');

	Route::group(["prefix" => "admin"], function() {
        Route::get('/', [HomeController::class, 'index'])->name('admin');

        //Users
        Route::resource('/users', UserController::class);
        Route::post('/change-password', [UserController::class, 'changePasswordSave'])->name('users.changePassword');
        Route::post('/users/storeMedia', [UserController::class, 'storeMedia'])->name('users.storeMedia');
        Route::delete('/users/{media}/deleteMedia', [UserController::class, 'deleteMedia'])->name('users.deleteMedia');

        //Posts
        Route::resource('/posts', PostController::class);
        Route::post('/posts/storeMedia', [PostController::class, 'storeMedia'])->name('posts.storeMedia');
        Route::delete('/posts/{media}/deleteMedia', [PostController::class, 'deleteMedia'])->name('posts.deleteMedia');

        //Pages
        Route::resource('/pages', PageController::class);

        //Pages Components
        Route::resource('/headers', HeaderController::class);
        Route::post('/headers/storeMedia', [HeaderController::class, 'storeMedia'])->name('headers.storeMedia');
        Route::delete('/headers/{media}/deleteMedia', [HeaderController::class, 'deleteMedia'])->name('headers.deleteMedia');

        Route::resource('/abouts', AboutController::class);
        Route::post('/abouts/storeMedia', [AboutController::class, 'storeMedia'])->name('abouts.storeMedia');
        Route::delete('/abouts/{media}/deleteMedia', [AboutController::class, 'deleteMedia'])->name('abouts.deleteMedia');

        Route::resource('/services', ServiceController::class);
        Route::post('/services/storeMedia', [ServiceController::class, 'storeMedia'])->name('services.storeMedia');
        Route::delete('/services/{media}/deleteMedia', [ServiceController::class, 'deleteMedia'])->name('services.deleteMedia');

        Route::resource('/titles', TitleController::class);

        //Projects
        Route::resource('/projects', ProjectController::class);
        Route::post('/projects/storeMedia', [ProjectController::class, 'storeMedia'])->name('projects.storeMedia');
        Route::delete('/projects/{media}/deleteMedia', [ProjectController::class, 'deleteMedia'])->name('projects.deleteMedia');

        //Contacts
        Route::group(["prefix" => "contacts-list"], function() {
            Route::get('/', [ContactController::class, 'index'])->name('contacts-list.index');
            Route::delete('/{id}', [ContactController::class, 'destroy'])->name('contacts-list.destroy');
        });

        //Categories
        Route::resource('/categories', CategoryController::class);

        //Tags
        Route::resource('/tags', TagController::class);

        //LegalPages
        Route::resource('/legal-pages', LegalPageController::class);

        //Settings
        Route::resource('/settings', SettingController::class);
        Route::post('/settings/storeMedia', [SettingController::class, 'storeMedia'])->name('settings.storeMedia');
        Route::delete('/settings/{media}/deleteMedia', [SettingController::class, 'deleteMedia'])->name('settings.deleteMedia');

    });
});

//Redirects
Route::redirect('/sobremi-diseño-web.html', '/sobre-mi-desarollador-web', 301);
Route::redirect('/sobremi-diseño-web.es.html', '/sobre-mi-desarollador-web', 301);
Route::redirect('/index.es.html', '/', 301);
Route::redirect('/index.html', '/', 301);
Route::redirect('/policy.html', '/', 301);
Route::redirect('/proyectos-web-responsive-lleida.html', '/proyectos-desarrollo-web-seo', 301);
Route::redirect('/servicios-diseño-web-posicionamiento-seo-lleida.html', '/servicios-desarrollo-web-seo', 301);
Route::redirect('/contacto-formal-web-lleida.php', '/contacto-formal-web-lleida', 301);
Route::redirect('/contacto-formal-web-lleida.es.php', '/contacto-formal-web-lleida', 301);
Route::redirect('/contacto', '/contacto-formal-web-lleida', 301);








