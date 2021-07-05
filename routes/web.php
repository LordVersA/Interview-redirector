<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth', 'lang'])->group(function () {

    Route::resource('/link', DashboardController::class)->name("links", "link");
    Route::resource('/category', CategoryController::class)->name("category", "category");
    Route::get("/links/{label}", [DashboardController::class, 'getByCategory'])->name("getByCategory");

});


Route::get('/', function () {
    return redirect(\route("login"));
});
Route::post('/logout', function () {
    if (Auth::check())
        Auth::logout();
    return redirect(route('login'));
})->name("logout");


Route::get("/r/{name}", [DashboardController::class, "redirect"])->name('redirect');

Route::get('/dashboard', function () {
    return redirect(\route("link.index"));
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
