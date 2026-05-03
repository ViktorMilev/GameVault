<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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

Route::post('/lang/switch', function (Request $request) {
    $locale = $request->input('locale');

    if (in_array($locale, ['en', 'bg', 'ru'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('app.lang.switch');

Route::get('/sign-up', [UserController::class, 'signUpPage'])->name('signup');
Route::post('/sign-up', [UserController::class, 'register'])->name('signup.auth');
Route::get('/login', [UserController::class, 'loginPage'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.auth');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


Route::prefix('admin')->group(function () {
    Route::get('/sign-up', [AdminController::class, 'signUpPage'])->name('admin.signup');
    Route::post('/sign-up', [AdminController::class, 'register'])->name('admin.signup.auth');
    Route::get('/login', [AdminController::class, 'loginPage'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.auth');
    
    Route::middleware(['admin'])->group(function () {
        Route::get('/homepage', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/{entity}', [AdminController::class, 'categoriesIndexPage'])->name('admin.categories.index');
        Route::get('/{entity}/new-{slug}', [AdminController::class, 'entityCreatePage'])->name('admin.entities.create');
        Route::get('/{entity}/edit/{slug}', [AdminController::class, 'entityEditPage'])->name('admin.entities.edit');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');


        // Actions
        Route::post('/{entity}/edit/{slug}/store-data', [AdminController::class, 'addEntityData'])->name('admin.entities.store');
        Route::post('/{entity}/edit/{slug}/update-data', [AdminController::class, 'updateEntityData'])->name('admin.entities.update');
        Route::post('/{entity}/delete/{slug}', [AdminController::class, 'deleteEntity'])->name('admin.entities.delete');


        Route::post('lang/switch', function (Request $request) {
            $locale = $request->input('locale');

            if (in_array($locale, ['en', 'bg', 'ru'])) {
                Session::put('locale', $locale);
            }
            return redirect()->back();
        })->name('admin.lang.switch');

        Route::post('/theme/change', function(\Illuminate\Http\Request $request) {
            $request->validate([
                'theme' => 'required|string'
            ]);

            session(['theme' => $request->theme]);

            return back();
        })->name('admin.system.theme.change');
    });
});