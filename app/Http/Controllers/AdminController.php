<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Game;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\GamePlatform;
use App\Models\Platform;
use App\Models\User;
use App\Services\AdminService;
use App\Services\HomepageService;

class AdminController extends Controller
{
    protected $adminService;
    protected $homepageService;
    protected $adminEmailAddress;
    protected $adminPassword;

    public function __construct(AdminService $adminService, HomepageService $homepageService) {
        $this->adminService = $adminService;
        $this->homepageService = $homepageService;
        $adminEmailAddress = env('ADMIN_EMAIL_ADDRESS', '');
        $adminPassword = env('ADMIN_PASSWORD', '');
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

    public function categoriesIndexPage($entity) {
        switch ($entity) {
            case 'games':
                $pageTitle = 'Admin • Games';
                break;
            case 'game_platforms':
                $pageTitle = 'Admin • Game Platforms';
                break;
            case 'categories':
                $pageTitle = 'Admin • Categories';
                break;
            case 'games':
                $pageTitle = 'Admin • Games';
                break;
            case 'games':
                $pageTitle = 'Admin • Games';
                break;
            case 'users':
                $pageTitle = 'Admin • Users';
                break;
            case 'system_settings':
                $pageTitle = 'Admin • System Settings';
                break;
            default:
                abort(404, 'Entity type not found.');
        }
        
        $games = $this->homepageService->fetchAllGames();
        $gamePlatforms = $this->homepageService->fetchAllGamePlatforms();
        $gameCategories = $this->homepageService->fetchCategoriesAndSubcategories();
        $subcategories = Subcategory::with('category')->get();
        $users = $this->homepageService->fetchAllUsers();
    
        return view('pages.admin.categories_index', 
            compact(
                'pageTitle',
                'games',
                'gamePlatforms',
                'gameCategories',
                'subcategories',
                'users'
            )
        );
    }

    public function entityCreatePage($entity, $slug = null) {
        $pageTitle = 'Create A New ';
        $entityData = null;

        switch ($entity) {
            case 'games':
                $pageTitle .= 'Game';
                $entityBladeFileName = 'game';
                $entityData = $this->homepageService->fetchEntityBySlug(Game::class, 'slug', $slug);
                break;
            case 'platforms':
                $pageTitle .= 'Game Platform';
                $entityBladeFileName = 'game_platform';
                $entityData = $this->homepageService->fetchEntityBySlug(Platform::class, 'slug', $slug);
                break;
            case 'categories':
                $pageTitle .= 'Category';
                $entityBladeFileName = 'game_category';
                $entityData = $this->homepageService->fetchEntityBySlug(Category::class, 'id', $slug);
                break;
            case 'subcategories':
                $pageTitle .= 'Subcategory';
                $entityBladeFileName = 'game_subcategory';
                $entityData = $this->homepageService->fetchEntityBySlug(Subcategory::class, 'id', $slug);
                break;
            case 'users':
                $pageTitle .= 'User';
                $entityBladeFileName = 'user';
                $entityData = $this->homepageService->fetchEntityBySlug(User::class, 'username', $slug);
                break;
            default:
                abort(404, 'Entity type not found.');
        }

        $gameCategories = $this->homepageService->fetchCategories();
        $gameSubcategories = $this->homepageService->fetchSubcategories();
        $gamePlatforms = $this->homepageService->fetchAllGamePlatforms();        

        
        return view('pages.admin.entity_create_page', 
            compact(
                'slug',
                'pageTitle',
                'gameCategories',
                'gameSubcategories',
                'gamePlatforms',
                'entityData',
                'entityBladeFileName'
            )
        );
    }

    public function entityEditPage($entity, $slug) {
        $pageTitle = 'Edit ';
        $entityData = null;

        switch ($entity) {
            case 'games':
                $pageTitle .= 'Game';
                $entityBladeFileName = 'game';
                $entityData = $this->homepageService->fetchEntityBySlug(Game::class, 'slug', $slug);
                break;
            case 'game_platforms':
                $pageTitle .= 'Game Platform';
                $entityBladeFileName = 'game_platform';
                $entityData = $this->homepageService->fetchEntityBySlug(Platform::class, 'slug', $slug);
                break;
            case 'categories':
                $pageTitle .= 'Category';
                $entityBladeFileName = 'game_category';
                $entityData = $this->homepageService->fetchEntityBySlug(Category::class, 'id', $slug);
                break;
            case 'subcategories':
                $pageTitle .= 'Subcategory';
                $entityBladeFileName = 'game_category';
                $entityData = $this->homepageService->fetchEntityBySlug(Subcategory::class, 'id', $slug);
                break;
            case 'users':
                $pageTitle .= 'User';
                $entityBladeFileName = 'user';
                $entityData = $this->homepageService->fetchEntityBySlug(User::class, 'username', $slug);
                break;
            default:
                abort(404, 'Entity type not found.');
        }

        $gameCategories = $this->homepageService->fetchCategories();
        $gameSubcategories = $this->homepageService->fetchSubcategories();
        $gamePlatforms = $this->homepageService->fetchAllGamePlatforms();

    
        return view('pages.admin.entity_edit_page', 
            compact(
                'pageTitle',
                'gameCategories',
                'gameSubcategories',
                'gamePlatforms',
                'entityData',
                'entityBladeFileName'
            )
        );
    }

    public function addEntityData(Request $request, $entity, $slug) {
        switch ($entity) {
            case 'games':
                return $this->adminService->addGame($request, $slug);
            case 'platforms':
                return $this->adminService->addGamePlatform($request, $slug);
            case 'categories':
                return $this->adminService->addGameCategory($request, $slug);
            case 'subcategories':
                return $this->adminService->addGameSubcategory($request, $slug);
            case 'users':
                return $this->adminService->addUser($request, $slug);
            default:
                abort(404, 'Entity type not found.');
        } 
    }

    public function updateEntityData(Request $request, $entity, $slug)
    {
        switch ($entity) {
            case 'games':
                return $this->adminService->updateGame($request, $slug);
            case 'game_platforms':
                return $this->adminService->updateGamePlatform($request, $slug);
            case 'categories':
                return $this->adminService->updateGameCategory($request, $slug);
            case 'subcategories':
                return $this->adminService->updateGameSubcategory($request, $slug);
            case 'users':
                return $this->adminService->updateUser($request, $slug);
            default:
                abort(404, 'Entity type not found.');
        }
    }

    public function deleteEntity(Request $request, $entity, $slug) {
        $entityName = '';
        switch ($entity) {
            case 'games':
                $entityName = 'Game';
                $game = Game::where('slug', $slug)->first();

                if (!$game) {
                    return redirect()->back()->with('error', 'Game not found.');
                }

                if (!empty($game->cover_image)) {   
                    $coverImagePath = public_path('images/game_covers/' . $game->cover_image);
                    $result = unlink($coverImagePath);
                    if (file_exists($coverImagePath)) {
                        unlink($coverImagePath);
                    }
                }

                $game->delete();

                break;
            case 'game_platforms':
                $entityName = 'Game Platform';
                $gamePlatform = Platform::where('slug', $slug)->first();
                if (!$gamePlatform) {
                    return redirect()->back()->with('error', 'Game platform not found.');
                }

                $gamePlatform->delete();
                break;
            case 'categories':
                $entityName = 'Category';
                $category = Category::where('id', $slug)->first();

                if (!$category) {
                    return redirect()->back()->with('error', 'Category not found.');
                }

                $category->delete();
                break;
            case 'subcategories':
                $entityName = 'Subcategory';
                $subcategory = Subcategory::where('id', $slug)->first();

                if (!$subcategory) {
                    return redirect()->back()->with('error', 'Subcategory not found.');
                }

                $subcategory->delete();
                break;
            case 'users':
                $entityName = 'User';
                $user = User::where('username', $slug)->first();

                if (!$user) {
                    return redirect()->back()->with('error', 'User not found.');
                }

                $user->delete();
                break;
            default:
                abort(404, 'Entity type not found.');
        }

        return redirect()->back()->with('success', $entityName . ' deleted successfully.');
    }



    // AUTHENTICATION

    public function signUpPage() {
        $pageTitle = 'Admin Sign Up';
    
        return view('pages.admin.sign_up', 
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

    public function login(Request $request, $adminPage = false) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        if ($user->is_admin === 'false') {
            return back()->withErrors(['auth' => 'Only administrators are allowed access to this page!']);
        }

        Auth::login($user);

        $request->session()->put('is_admin', true);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request) {
        $request->session()->forget('is_admin');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', trans('auth.messages.logout'));
    }            
}