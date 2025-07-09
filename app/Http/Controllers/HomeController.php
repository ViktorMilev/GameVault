<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HomepageService;

class HomeController extends Controller
{
    protected $homepageService;

    public function __construct(HomepageService $homepageService) {
        $this->homepageService = $homepageService;
    }

    public function index() {
        $pageTitle = "GameVault";
        $categories = $this->homepageService->fetchCategoriesAndSubcategories();
        $games = $this->homepageService->fetchAllGames();
        $navbarItems = $this->homepageService->fetchNavbarItems();
        
        return view('pages.index', 
            compact(
                'pageTitle', 
                'categories',
                'games',
                'navbarItems',
            )
        );
    }

    public function categories($categoryName) {
        $pageTitle = "GameVault";
        $categories = $this->homepageService->fetchCategoriesAndSubcategories();
        $categoryId = $this->homepageService->fetchCategoryIdBySubcategory($categoryName);
        $games = $this->homepageService->fetchGamesByCategory($categoryId);
        $navbarItems = $this->homepageService->fetchNavbarItems();
        
        return view('pages.games_gallery', 
            compact(
                'pageTitle', 
                'categories',
                'games',
                'navbarItems',
            )
        );
    }

    public function about() {
        $pageTitle = "About Us";
        $categories = $this->homepageService->fetchCategoriesAndSubcategories();
        $navbarItems = $this->homepageService->fetchNavbarItems();

        return view('pages.about',
            compact(
                'pageTitle',
                'categories',
                'navbarItems',
            )
        );
    }

    public function contacts() {
        $pageTitle = "About Us";
        $categories = $this->homepageService->fetchCategoriesAndSubcategories();
        $navbarItems = $this->homepageService->fetchNavbarItems();

        return view('pages.contacts',
            compact(
                'pageTitle',
                'categories',
                'navbarItems',
            )
        );
    }

    public function search(Request $request) {
        $categories = $this->homepageService->fetchCategoriesAndSubcategories();
        $navbarItems = $this->homepageService->fetchNavbarItems();
        $query = $request->input('q');
        $games = $this->homepageService->searchGamesByQuery($query);
        $pageTitle = "Search Results for " . $query;

        return view('pages.search_results',
            compact(
                'pageTitle',
                'categories',
                'navbarItems',
                'games',
                'query',
            )
        );
    }
}