<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/game/{slug}', [HomeController::class, 'gameArticle'])->name('game.article');
Route::get('/categories/{slug}', [HomeController::class, 'categories'])->name('categories.index');
Route::get('/about_us', [HomeController::class, 'about'])->name('about');
Route::get('/contacts', [HomeController::class, 'contacts'])->name('contacts');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::post('/ajax-search', [HomeController::class, 'ajaxSearch'])->name('ajaxSearch');


Route::prefix('admin')->group(function () {
    Route::get('/sign-in', [AdminController::class, 'signInPage'])->name('admin.signin');
    Route::post('/sign-in', [AdminController::class, 'register'])->name('admin.signin.auth');
    Route::get('/login', [AdminController::class, 'loginPage'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.auth');
    
    Route::middleware(['admin'])->group(function () {
        Route::get('/homepage', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/{entity}', [AdminController::class, 'categoriesIndexPage'])->name('admin.categories.index');
        Route::get('/{entity}/new-{slug}', [AdminController::class, 'entityEditPage'])->name('admin.entities.create');
        Route::get('/{entity}/edit/{slug}', [AdminController::class, 'entityEditPage'])->name('admin.entities.edit');
        Route::get('/{entity}/delete/{slug}', [AdminController::class, 'entityEditPage'])->name('admin.entities.delete');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        Route::post('/{entity}/edit/{slug}/update-data', [AdminController::class, 'updateEntityData'])->name('admin.entities.update');

        Route::post('/theme/change', function(\Illuminate\Http\Request $request) {
            $request->validate([
                'theme' => 'required|string'
            ]);

            session(['theme' => $request->theme]);

            return back();
        })->name('theme.change');
    });
});