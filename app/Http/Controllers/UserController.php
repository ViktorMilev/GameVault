<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Carbon;


use App\Models\Game;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\GamePlatform;
use App\Models\Platform;
use App\Models\User;

class UserController extends Controller 
{


    public function __construct() {

    }

    public function signUpPage() {
        $pageTitle = 'Sign Up Page';
    
        return view('pages.signup', 
            compact(
                'pageTitle'
            )
        );
    }

    public function loginPage() {
        $pageTitle = 'Login Page';
    
        return view('pages.loginpage', 
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

        return redirect()->route('login')->with('success', trans('auth.messages.user_create_success'));
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

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('homepage');
    }

    public function logout(Request $request) {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', trans('auth.messages.logout'));
    }


    public function profile() {
        $pageTitle = 'User Profile';
    
        return view('pages.profile', 
            compact(
                'pageTitle'
            )
        );
    }

    public function updateProfile() {

    }

    public function changePassword() {

    }

    public function deleteAccount() {

    }


    public function storeUserReview(Request $request) {
        $validate = Validator::make($request->all(), [
            //'game_id' => 'required|exists:games,id',
            'rating' => 'required|in:1,2,3,4,5',
            'text' => 'nullable|string|max:1000',
        ]);

        $validate->validate();

        $reviewText = $request->input('text');

        dd($reviewText);

        #TODO: Store the review in the database, associating it with the authenticated user and the specified game.

        return response('success', 200);
    }
}