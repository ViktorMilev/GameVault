<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    private $adminEmailAddress = 'vikdmilev@gmail.com';
    private $adminPassword = 'ux]=Cd(,n1)l@E;';

    public function loginPage() {
        return view('pages.admin.login');
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

    public function dashboard(Request $request) {
        if (!$request->session()->get('is_admin')) {
            abort(403, 'Unauthorized. You do not have access to this page.');
        }

        return view('pages.admin.dashboard');
    }

    public function logout(Request $request) {
        $request->session()->forget('is_admin');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}