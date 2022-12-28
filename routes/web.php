<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubforumController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/test', function () {
    return 'test';
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/forums', [SubforumController::class, 'index'])->name('subforums.index');
Route::get('/forums/{subforum}', [SubforumController::class, 'show'])->name('subforums.show');
Route::get('/forums/{subforum}/{post}', [PostController::class, 'show'])->name('subforum.posts.show');
require __DIR__.'/auth.php';
