<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Profile;

class UserProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $profile = Profile::first(); // Ambil profil madrasah untuk informasi tambahan
        
        return view('user.profile.show', compact('user', 'profile'));
    }

    public function showChangePassword()
    {
        $user = Auth::user();
        return view('user.profile.change-password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.profile.show')
            ->with('success', 'Password berhasil diperbarui!');
    }
}
