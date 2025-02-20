<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * FRONTEND ROUTES
 */
Route::get('/', [BlogController::class, 'index'])->name('home');
Route::get('/post/{slug}', [BlogController::class, 'readPost'])->name('read_post');
Route::get('/post/category/{slug}', [BlogController::class, 'categoryPosts'])->name('category_posts');
Route::get('/post/author/{username}', [BlogController::class, 'authorPosts'])->name('author_posts');
Route::get('/post/tag/{any}', [BlogController::class, 'tagPost'])->name('tag_posts');
Route::get('/search', [BlogController::class, 'searchPost'])->name('search_posts');

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{post_id}', [CommentController::class, 'fetch'])->name('comments.fetch');

Route::get('/contact', [BlogController::class, 'contactPage'])->name('contact');
Route::post('/contact', [BlogController::class, 'sendEmail'])->name('send_email');



/**
 * TESTING ROUTES
 */
Route::view('/example-page', 'example-page');
Route::view('/example-auth', 'example-auth');

/**
 * ADMIN ROUTES
 */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest', 'preventBackHistory'])->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::get('/login', 'loginForm')->name('login');
            Route::post('/login', 'loginHandler')->name('login_handler');
            Route::get('/forgot-password', 'forgotForm')->name('forgot');
            Route::post('/send-reset-password', 'sendPasswordResetLink')->name('send_password_reset_link');
            Route::get('/reset-password/{token}', 'resetForm')->name('reset_password_form');
        });
    });

    Route::middleware(['auth', 'preventBackHistory'])->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'adminDashboard')->name('dashboard');
            Route::post('/logout', 'logoutHandler')->name('logout');
            Route::get('/profile', 'profileView')->name('profile');


            Route::middleware(['onlySuperAdmin'])->group(function () {
                Route::get('/settings', 'generalSettings')->name('setting');
                Route::post('/update-logo', 'updateLogo')->name('update_logo');
                Route::get('/categories', 'categoriesPage')->name('categories');
            });
        });

        Route::controller(PostController::class)->group(function () {
            Route::get('/post/new', 'addPost')->name('add_post');
            Route::post('/post/create', 'createPost')->name('create_post');
            Route::get('/posts', 'allPost')->name('posts');
            Route::get('/post/{id}/edit', 'editPost')->name('edit_post');
            Route::post('/post/update', 'updatePost')->name('update_post');
        });
    });
});
