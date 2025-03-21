<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    public function index()
    {
        // Get current user settings or set defaults
        $user = Auth::user();
        $settings = $user->settings ?? [];
        
        $userSettings = [
            'theme' => $settings['theme'] ?? 'light',
        ];
        
        return view('settings', compact('userSettings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'theme' => 'required|string|in:light,dark,system',
        ]);

        $user = Auth::user();
        
        // Get existing settings or initialize an empty array
        $settings = $user->settings ?? [];
        
        // Update only the theme setting
        $settings['theme'] = $request->theme;
        
        $user->settings = $settings;
        $user->save();

        return redirect()->route('settings')->with('status', 'Settings updated successfully!');
    }

    public function showPassword()
    {
        return view('settings.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('settings.password')->with('status', 'Password updated successfully!');
    }

    public function showNotifications()
    {
        return view('settings.notifications');
    }

    public function updateNotifications(Request $request)
    {
        $user = Auth::user();
        
        // Store notification preferences
        $settings = $user->settings ?? [];
        $settings['notifications'] = [
            'email_news' => $request->has('email_news'),
            'email_account' => $request->has('email_account'),
            'email_marketing' => $request->has('email_marketing'),
            'push_all' => $request->has('push_all'),
        ];
        
        $user->settings = $settings;
        $user->save();

        return redirect()->route('settings.notifications')->with('status', 'Notification settings updated successfully!');
    }

    public function showPrivacy()
    {
        return view('settings.privacy');
    }

    public function updatePrivacy(Request $request)
    {
        $request->validate([
            'profile_visibility' => 'required|string|in:public,registered,private',
        ]);
        
        $user = Auth::user();
        
        // Store privacy settings
        $settings = $user->settings ?? [];
        $settings['privacy'] = [
            'profile_visibility' => $request->profile_visibility,
            'allow_analytics' => $request->has('allow_analytics'),
            'allow_cookies' => $request->has('allow_cookies'),
        ];
        
        $user->settings = $settings;
        $user->save();

        return redirect()->route('settings.privacy')->with('status', 'Privacy settings updated successfully!');
    }
}
