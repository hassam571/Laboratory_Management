<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display the login form.
     *
     * @return \Illuminate\View\View
     */
    public function roleerror()
    {
        return view('auth.errors.error403'); // Ensure this view exists (resources/views/auth/login.blade.php)
    }
    public function showLoginForm()
    {
        return view('auth.staff.login'); // Ensure this view exists (resources/views/auth/login.blade.php)
    }
    
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
    ]);

    $remember = $request->has('remember');

    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();
        $user = Auth::user();

        if ($user->status !== 'active') {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Your account is inactive. Please contact the laboratory manager or admin.',
            ])->onlyInput('email');
        }

        return match ($user->role) {
            'admin'         => redirect()->route('admin.dashboard'),
            'receptionist'  => redirect()->route('receptionist.dashboard'),
            'sampler'        => redirect()->route('sampler.dashboard'),
            'reporter'          => redirect()->route('reporter.dashboard'),
            'manager'          => redirect()->route('manager.dashboard'),
            'patient'          => redirect()->route('patient.dashboard'),
            default         => redirect()->intended('/'),
        };
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
}

    
    /**
     * Log the user out and invalidate the session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
}

    
}
