<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Game;
use App\Models\Platform;
use App\Models\GamePlatform;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageService
{
    public function fetchCategoriesAndSubcategories() {
        return Category::with('subcategories')->get();
    }

    public function fetchNavbarItems($t) {
        return [
            [
                'name' => $t['general']['navbar']['home'],
                'type' => 'homeIndex',
                'route' => route('homepage'),
            ],
            [
                'name' => $t['general']['navbar']['categories'],
                'type' => 'dropdown',
                'route' => '',
            ],
            [
                'name' => $t['general']['navbar']['about_us'],
                'type' => 'singular',
                'route' => route('about'),
            ],
            [
                'name' => $t['general']['navbar']['contacts'],
                'type' => 'singular',
                'route' => route('contacts'),
            ],
        ];
    }

    public function fetchCategories() {
        return Category::all();
    }

    public function fetchSubcategories() {
        return Subcategory::all();
    }

    public function fetchCategoryIdBySubcategory($subcatName) {
        return Subcategory::where('slug', $subcatName)->value('category_id');
    }

    public function fetchEntityBySlug($model, $field, $slug) {
        return $model::where($field, $slug)->first();
    }

    public function fetchAllGames() {
        return Game::all();
    }

    public function fetchAllGamePlatforms() {
        return Platform::all();
    }

    public function fetchGamesByCategory($categoryId) {
        return Game::with(['subcategory', 'platforms'])
                    ->where('category_id', $categoryId)
                    ->get();
    }

    public function fetchGameByName($gameName) {
        return Game::with(['subcategory', 'platforms'])
                    ->where('slug', $gameName)
                    ->get();
    }

    public function fetchAllUsers() {
        return User::select(['id', 'username', 'email'])->get();
    }

    public function searchGamesByQuery($query) {
        return Game::with(['category', 'subcategory', 'platforms'])
                    ->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('developer', 'LIKE', "%{$query}%")
                    ->orWhere('publisher', 'LIKE', "%{$query}%")
                    ->get();
    }
}