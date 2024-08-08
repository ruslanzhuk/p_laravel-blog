<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterSubscriptionController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostFeedController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/feed', [PostFeedController::class, 'index'])->name('posts.feed');
Route::resource('posts', PostController::class)->only('show');
Route::resource('users', UserController::class)->only('show');
Route::resource('posts.comments', PostCommentController::class)->only('index');
Route::post('comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('newsletter-subscriptions/unsubscribe', [NewsletterSubscriptionController::class, 'unsubscribe'])->name('newsletter-subscriptions.unsubscribe');

Route::get('cos', [HomeController::class, 'index'])->name('home.index');
Route::get('cos/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('cos/users', [HomeController::class, 'users'])->name('home.users');


Route::post('posts/{post}/reactions', [ReactionController::class, 'store'])->name('reactions.store');
//Route::delete('posts/{post}/reactions', [ReactionController::class, 'destroy'])->name('reactions.destroy');
