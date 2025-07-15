<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog; // Add this import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Record login activity
            ActivityLog::create([
                'user_id' => Auth::id(),
                'login_time' => now(),
                'user_agent' => $request->userAgent(),
                'status' => 'active',
            ]);

            return redirect()->route('profile.showProfile');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function logout(Request $request)
    {
        // Update the user's most recent active log entry
        if (Auth::check()) {
            $latestLog = ActivityLog::where('user_id', Auth::id())
                ->where('status', 'active')
                ->latest('login_time') // Specify the column to order by
                ->first();

            if ($latestLog) {
                $latestLog->update([
                    'logout_time' => now(),
                    'status' => 'inactive'
                ]);
            }
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.show');
    }
}
