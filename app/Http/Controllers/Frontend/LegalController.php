<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Profile;

class LegalController extends Controller
{
    public function privacy()
    {
        $profile = Profile::first();

        return view('frontend.legal.privacy', compact('profile'));
    }

    public function terms()
    {
        $profile = Profile::first();

        return view('frontend.legal.terms', compact('profile'));
    }

    public function cookies()
    {
        $profile = Profile::first();

        return view('frontend.legal.cookies', compact('profile'));
    }
}
