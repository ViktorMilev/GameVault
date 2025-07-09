<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Game;
use App\Models\GamePlatform;
use Illuminate\Support\Facades\Route;

class HomepageService
{
    public function fetchCategoriesAndSubcategories() {
        return Category::with('subcategories')->get();
    }

    public function fetchCategoryIdBySubcategory($subcatName) {
        return Subcategory::where('slug', $subcatName)->value('category_id');
    }

    public function fetchAllGames() {
        return Game::all();
    }

    public function fetchGamesByCategory($categoryId) {
        return Game::with(['subcategory', 'platforms'])
                    ->where('category_id', $categoryId)
                    ->get();
    }

    public function fetchNavbarItems() {
        return [
            [
                'name' => 'Home',
                'type' => 'homeIndex',
                'route' => route('homepage'),
            ],
            [
                'name' => 'Categories',
                'type' => 'dropdown',
                'route' => '',
            ],
            [
                'name' => 'About Us',
                'type' => 'singular',
                'route' => route('about'),
            ],
            [
                'name' => 'Contacts',
                'type' => 'singular',
                'route' => route('contacts'),
            ],
        ];
    }

    public function searchGamesByQuery($query) {
        return Game::with(['category', 'subcategory', 'platforms'])
                    ->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('developer', 'LIKE', "%{$query}%")
                    ->orWhere('publisher', 'LIKE', "%{$query}%")
                    ->get();
    }
}