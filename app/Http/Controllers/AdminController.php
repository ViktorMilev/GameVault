<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Game;
use App\Models\User;
use App\Services\AdminService;
use App\Services\HomepageService;

class AdminController extends Controller
{
    private $adminEmailAddress = 'vikdmilev@gmail.com';
    private $adminPassword = 'ux]=Cd(,n1)l@E;';
    protected $adminService;
    protected $homepageService;

    public function __construct(AdminService $adminService, HomepageService $homepageService) {
        $this->adminService = $adminService;
        $this->homepageService = $homepageService;
    }

    public function signInPage() {
        $pageTitle = 'Admin Sign In';
    
        return view('pages.admin.sign_in', 
            compact(
                'pageTitle'
            )
        );
    }

    public function loginPage() {
        $pageTitle = 'Admin Login';
    
        return view('pages.admin.login', 
            compact(
                'pageTitle'
            )
        );
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.login')
                ->with('success', 'Account created successfully.');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        $request->session()->put('is_admin', true);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
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

        $categoryEntitiesCountMap = $this->adminService->fetchCategoryEntitiesCountMap();

        $latestGames = $this->adminService->fetchLatestGames();

        return view('pages.admin.dashboard', 
            compact(
                'pageTitle',
                'categoryEntitiesCountMap',
                'latestGames'
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

    public function entityEditPage($entity, $slug) {
        $pageTitle = 'Edit ';
        $entityData = null;

        switch ($entity) {
            case 'games':
                $pageTitle .= 'Game';
                $entityBladeFileName = 'edit_game';
                $entityData = $this->homepageService->fetchEntityBySlug(Game::class, 'slug', $slug);
                break;
            case 'users':
                $pageTitle .= 'User';
                $entityBladeFileName = 'edit_user';
                $entityData = $this->homepageService->fetchEntityBySlug(User::class, 'username', $slug);
                break;
            default:
                abort(404, 'Entity type not found.');
        }

 

        $gameCategories = $this->homepageService->fetchCategories();
        $gameSubcategories = $this->homepageService->fetchSubcategories();
        $gamePlatforms = $this->homepageService->fetchAllGamePlatforms();

    
        return view('pages.admin.entity_edit_views' . '.' . $entityBladeFileName, 
            compact(
                'pageTitle',
                'gameCategories',
                'gameSubcategories',
                'gamePlatforms',
                'entityData'
            )
        );
    }


    public function updateEntityData(Request $request, $entity, $slug)
    {
        switch ($entity) {
            case 'games':
                return $this->adminService->updateGame($request, $slug);
            case 'users':
                return $this->adminService->updateUser($request, $slug);
            default:
                abort(404, 'Entity type not found.');
        }
    }
}