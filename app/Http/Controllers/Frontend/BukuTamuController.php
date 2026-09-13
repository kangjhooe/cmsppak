<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BukuTamu;
use Illuminate\Http\Request;

class BukuTamuController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'instansi' => 'nullable|string|max:255',
            'pesan' => 'required|string|max:1000',
            'g-recaptcha-response' => 'required|recaptcha'
        ], [
            'g-recaptcha-response.required' => 'Mohon verifikasi reCAPTCHA',
            'g-recaptcha-response.recaptcha' => 'Verifikasi reCAPTCHA gagal'
        ]);

        BukuTamu::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'instansi' => $request->instansi,
            'pesan' => $request->pesan
        ]);

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim. Terima kasih telah menghubungi kami.');
    }
}
