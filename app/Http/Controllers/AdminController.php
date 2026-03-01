<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\HomepageService;

class AdminController extends Controller
{
    private $adminEmailAddress = 'vikdmilev@gmail.com';
    private $adminPassword = 'ux]=Cd(,n1)l@E;';
    protected $homepageService;

    public function __construct(HomepageService $homepageService) {
        $this->homepageService = $homepageService;
    }

    public function loginPage() {
        $pageTitle = 'Admin Login';
    
        return view('pages.admin.login', 
            compact(
                'pageTitle'
            )
        );
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($request->email === $this->adminEmailAddress && $request->password === $this->adminPassword) {
            $request->session()->put('is_admin', true);
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request) {
        $request->session()->forget('is_admin');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function dashboard(Request $request) {
        $pageTitle = 'Dashboard';

        if (!$request->session()->get('is_admin')) {
            abort(403, 'Unauthorized. You do not have access to this page.');
        }

        return view('pages.admin.dashboard', 
            compact(
                'pageTitle'
            )
        );
    }

    public function categoriesIndexPage() {
        $pageTitle = 'categoriesIndexPage';
        $games = $this->homepageService->fetchAllGames();
        $gameCategories = $this->homepageService->fetchCategoriesAndSubcategories();
        $users = $this->homepageService->fetchAllUsers();
    
        return view('pages.admin.categories_index', 
            compact(
                'pageTitle',
                'games',
                'gameCategories',
                'users'
            )
        );
    }

    public function entityEditPage($entity, $id) {
        $pageTitle = 'entityEditPage';
    
        return view('pages.admin.entity_edit', 
            compact(
                'pageTitle'
            )
        );
    }
}