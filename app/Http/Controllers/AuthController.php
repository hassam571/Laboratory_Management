<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

     public function patient()
     {
         return view('auth.patient.login'); // Ensure this view exists (resources/views/auth/login.blade.php)
     }
     

     public function loginp(Request $request)
     {
         // Validate the incoming request
         $request->validate([
             'user_name' => 'required', // Assuming email is used as user_id
             'password' => 'required',
         ]);
 
         // Check if customer with the given email exists
         $customer = Customer::where('user_name', $request->user_name)->first();
 
         if (!$customer) {
             return back()->withErrors(['user_name' => 'No user found with this email.']);
         }
 
         // Check if password matches
         if ($customer->password !== $request->password) {
             return back()->withErrors(['user_name' => 'Incorrect password.']);
         }
 
         // If login is successful, set the session for the customer
         Session::put('customerId', $customer->customerId);
         Session::put('customerName', $customer->name);
 
         // Redirect to the dashboard
         return redirect()->route('patient.dashboard');
     }



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
