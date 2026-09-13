<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GuruStaf;
use App\Models\Profile;
use Illuminate\Http\Request;

class GuruStafController extends Controller
{
    public function index(Request $request)
    {
        $query = GuruStaf::where('status', 'active');
        
        if ($request->has('jabatan')) {
            $query->where('jabatan', $request->jabatan);
        }
        
        $guruStaf = $query->orderBy('nama', 'asc')->paginate(12);
        $profile = Profile::first();
        
        $jabatan = GuruStaf::where('status', 'active')
            ->distinct()
            ->pluck('jabatan')
            ->filter()
            ->values();
            
        return view('frontend.guru-staf.index', compact('guruStaf', 'jabatan', 'profile'));
    }

    public function show($id)
    {
        $guruStaf = GuruStaf::where('id', $id)
            ->where('status', 'active')
            ->firstOrFail();
            
        $guruStafLainnya = GuruStaf::where('status', 'active')
            ->where('id', '!=', $guruStaf->id)
            ->where('jabatan', $guruStaf->jabatan)
            ->orderBy('created_at', 'asc')
            ->limit(6)
            ->get();
            
        $profile = Profile::first();
        
        return view('frontend.guru-staf.show', compact('guruStaf', 'guruStafLainnya', 'profile'));
    }
}
