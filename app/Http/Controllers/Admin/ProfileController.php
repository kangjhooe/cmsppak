<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        return view('admin.profile.index', compact('profile'));
    }

    public function store(Request $request)
    {
        // Debug: Log request data
        \Log::info('Profile store request data:', $request->all());
        
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'npsn' => 'nullable|string|max:20',
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',
            'whatsapp_admin' => 'nullable|string|max:20',
            'jam_operasional' => 'nullable|string|max:255',
            'koordinat_lat' => 'nullable|numeric|between:-90,90',
            'koordinat_lng' => 'nullable|numeric|between:-180,180',
            'koordinat_alt' => 'nullable|integer|min:0',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'sejarah' => 'required|string',
            'kepala_sekolah' => 'nullable|string|max:255',
            'jumlah_siswa' => 'nullable|integer|min:0',
            'jumlah_guru' => 'nullable|integer|min:0',
            'jumlah_kelas' => 'nullable|integer|min:0',
            'tahun_berdiri' => 'nullable|integer|min:1900|max:2100',
            'fasilitas' => 'nullable|string',
            'prestasi' => 'nullable|string',
            'struktur_organisasi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|mimes:ico,png,jpg,jpeg,svg|max:2048',
            'foto_kepala_madrasah' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Validasi field profil frontend
            'profil_hero_title' => 'nullable|string|max:255',
            'profil_hero_subtitle' => 'nullable|string|max:255',
            'profil_hero_description' => 'nullable|string',
            'profil_show_statistics' => 'nullable|boolean',
            'profil_show_contact' => 'nullable|boolean',
            'profil_show_social_media' => 'nullable|boolean',
            'profil_show_principal' => 'nullable|boolean',
            'profil_show_vision_mission' => 'nullable|boolean',
            'profil_show_history' => 'nullable|boolean',
            'profil_show_facilities' => 'nullable|boolean',
            'profil_show_achievements' => 'nullable|boolean',
            'profil_show_organization' => 'nullable|boolean',
            'profil_show_emergency_contact' => 'nullable|boolean',
            'profil_custom_sections' => 'nullable|json'
        ]);

        $data = $request->except(['logo', 'favicon', 'foto_kepala_madrasah', 'hero_image']);
        
        // Handle checkbox values - jika tidak ada, berarti false
        $checkboxFields = [
            'profil_show_statistics',
            'profil_show_contact', 
            'profil_show_social_media',
            'profil_show_principal',
            'profil_show_vision_mission',
            'profil_show_history',
            'profil_show_facilities',
            'profil_show_achievements',
            'profil_show_organization',
            'profil_show_emergency_contact'
        ];
        
        foreach ($checkboxFields as $field) {
            $data[$field] = $request->has($field) ? (bool)$request->input($field) : false;
        }
        
        // Set default values untuk field profil frontend jika kosong
        $defaults = [
            'profil_hero_title' => 'Profil ' . __('school'),
            'profil_hero_subtitle' => $data['nama_sekolah'] ?? '',
            'profil_hero_description' => $data['alamat'] ?? '',
            'profil_custom_sections' => $data['profil_custom_sections'] ?? []
        ];
        
        // Merge dengan data yang ada
        $data = array_merge($defaults, $data);
        
        if ($request->hasFile('logo')) {
            if (Profile::first() && Profile::first()->logo) {
                Storage::delete('public/' . Profile::first()->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        if ($request->hasFile('favicon')) {
            if (Profile::first() && Profile::first()->favicon) {
                Storage::delete('public/' . Profile::first()->favicon);
            }
            $data['favicon'] = $request->file('favicon')->store('favicons', 'public');
        }

        if ($request->hasFile('foto_kepala_madrasah')) {
            if (Profile::first() && Profile::first()->foto_kepala_madrasah) {
                Storage::delete('public/' . Profile::first()->foto_kepala_madrasah);
            }
            $data['foto_kepala_madrasah'] = $request->file('foto_kepala_madrasah')->store('photos', 'public');
        }

        if ($request->hasFile('hero_image')) {
            if (Profile::first() && Profile::first()->hero_image) {
                Storage::delete('public/' . Profile::first()->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')->store('hero-images', 'public');
        }

        // Debug: Log data yang akan disimpan
        \Log::info('Profile data to save:', $data);
        
        try {
            $profile = Profile::updateOrCreate(['id' => 1], $data);
            
            // Debug: Log hasil penyimpanan
            \Log::info('Profile saved successfully:', $profile->toArray());
            
            // Clear cache jika ada
            \Cache::forget('profile_data');
            
        } catch (\Exception $e) {
            \Log::error('Profile save error: ' . $e->getMessage());
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }

        return redirect()->route('admin.profile.index')
                        ->with('success', 'Profil sekolah berhasil diperbarui');
    }
}
