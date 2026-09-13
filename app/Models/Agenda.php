<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
        'jenis',
        'status',
        'peserta'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'waktu_mulai' => 'string',
        'waktu_selesai' => 'string'
    ];

    // Accessor untuk memastikan waktu_mulai hanya berisi waktu
    public function getWaktuMulaiAttribute($value)
    {
        if ($value) {
            // Jika value berisi datetime, ambil hanya bagian waktu
            if (strpos($value, ' ') !== false) {
                return date('H:i:s', strtotime($value));
            }
            return $value;
        }
        return null;
    }

    public function getWaktuSelesaiAttribute($value)
    {
        if ($value) {
            // Jika value berisi datetime, ambil hanya bagian waktu
            if (strpos($value, ' ') !== false) {
                return date('H:i:s', strtotime($value));
            }
            return $value;
        }
        return null;
    }

    public function scopeUpcoming($query)
    {
        return $query->where('tanggal_mulai', '>=', now()->toDateString())
                    ->whereIn('status', ['upcoming', 'ongoing']);
    }

    public function scopeByMonth($query, $month, $year)
    {
        return $query->whereMonth('tanggal_mulai', $month)
                    ->whereYear('tanggal_mulai', $year);
    }

    public function getFormattedTanggalAttribute()
    {
        $format = 'd-m-Y';
        if ($this->tanggal_selesai && $this->tanggal_mulai != $this->tanggal_selesai) {
            return $this->tanggal_mulai ? $this->tanggal_mulai->format($format) . ' - ' . $this->tanggal_selesai->format($format) : '-';
        }
        return $this->tanggal_mulai ? $this->tanggal_mulai->format($format) : '-';
    }

    /**
     * Menghitung status agenda secara otomatis berdasarkan waktu saat ini
     */
    public function calculateAutoStatus()
    {
        $now = now();
        
        // Jika agenda dibatalkan, tetap cancelled
        if ($this->status === 'cancelled') {
            return 'cancelled';
        }
        
        // Pastikan tanggal_mulai ada
        if (!$this->tanggal_mulai) {
            return 'upcoming'; // Default jika tidak ada tanggal
        }
        
        // Gabungkan tanggal dan waktu untuk perhitungan yang akurat
        $tanggalWaktuMulai = $this->tanggal_mulai->format('Y-m-d');
        if ($this->waktu_mulai) {
            // Pastikan format waktu benar (HH:MM:SS)
            $waktuMulai = $this->waktu_mulai;
            if (strlen($waktuMulai) === 5) { // Format HH:MM
                $waktuMulai .= ':00'; // Tambahkan detik
            }
            $tanggalWaktuMulai .= ' ' . $waktuMulai;
        } else {
            $tanggalWaktuMulai .= ' 00:00:00'; // Default waktu mulai
        }
        
        // Tentukan tanggal dan waktu selesai
        $tanggalSelesai = $this->tanggal_selesai ?? $this->tanggal_mulai;
        $tanggalWaktuSelesai = $tanggalSelesai->format('Y-m-d');
        if ($this->waktu_selesai) {
            // Pastikan format waktu benar (HH:MM:SS)
            $waktuSelesai = $this->waktu_selesai;
            if (strlen($waktuSelesai) === 5) { // Format HH:MM
                $waktuSelesai .= ':00'; // Tambahkan detik
            }
            $tanggalWaktuSelesai .= ' ' . $waktuSelesai;
        } else {
            $tanggalWaktuSelesai .= ' 23:59:59'; // Default waktu selesai
        }
        
        try {
            $waktuMulai = \Carbon\Carbon::parse($tanggalWaktuMulai);
            $waktuSelesai = \Carbon\Carbon::parse($tanggalWaktuSelesai);
            
            // Jika waktu sekarang sebelum waktu mulai
            if ($now->lt($waktuMulai)) {
                return 'upcoming';
            }
            // Jika waktu sekarang setelah waktu selesai
            elseif ($now->gt($waktuSelesai)) {
                return 'completed';
            }
            // Jika waktu sekarang antara waktu mulai dan selesai
            else {
                return 'ongoing';
            }
        } catch (\Exception $e) {
            // Jika ada error parsing, return upcoming sebagai fallback
            return 'upcoming';
        }
    }

    /**
     * Accessor untuk mendapatkan status otomatis
     */
    public function getAutoStatusAttribute()
    {
        return $this->calculateAutoStatus();
    }

    /**
     * Update status agenda berdasarkan waktu saat ini
     */
    public function updateStatusFromTime()
    {
        $newStatus = $this->calculateAutoStatus();
        
        // Hanya update jika status berubah dan bukan cancelled
        if ($newStatus !== $this->status && $this->status !== 'cancelled') {
            $this->update(['status' => $newStatus]);
        }
        
        return $newStatus;
    }

    /**
     * Scope untuk agenda berdasarkan status otomatis
     */
    public function scopeByAutoStatus($query, $status)
    {
        return $query->where(function($q) use ($status) {
            $now = now();
            
            switch ($status) {
                case 'upcoming':
                    $q->where(function($subQ) use ($now) {
                        $subQ->whereRaw("
                            CONCAT(
                                tanggal_mulai, ' ', 
                                CASE 
                                    WHEN waktu_mulai IS NULL OR waktu_mulai = '' THEN '00:00:00'
                                    WHEN CHAR_LENGTH(waktu_mulai) = 5 THEN CONCAT(waktu_mulai, ':00')
                                    ELSE waktu_mulai
                                END
                            ) > ?
                        ", [$now->format('Y-m-d H:i:s')])
                        ->where('status', '!=', 'cancelled');
                    });
                    break;
                    
                case 'ongoing':
                    $q->where(function($subQ) use ($now) {
                        $subQ->whereRaw("
                            CONCAT(
                                tanggal_mulai, ' ', 
                                CASE 
                                    WHEN waktu_mulai IS NULL OR waktu_mulai = '' THEN '00:00:00'
                                    WHEN CHAR_LENGTH(waktu_mulai) = 5 THEN CONCAT(waktu_mulai, ':00')
                                    ELSE waktu_mulai
                                END
                            ) <= ?
                        ", [$now->format('Y-m-d H:i:s')])
                        ->whereRaw("
                            CONCAT(
                                COALESCE(tanggal_selesai, tanggal_mulai), ' ', 
                                CASE 
                                    WHEN waktu_selesai IS NULL OR waktu_selesai = '' THEN '23:59:59'
                                    WHEN CHAR_LENGTH(waktu_selesai) = 5 THEN CONCAT(waktu_selesai, ':00')
                                    ELSE waktu_selesai
                                END
                            ) >= ?
                        ", [$now->format('Y-m-d H:i:s')])
                        ->where('status', '!=', 'cancelled');
                    });
                    break;
                    
                case 'completed':
                    $q->where(function($subQ) use ($now) {
                        $subQ->whereRaw("
                            CONCAT(
                                COALESCE(tanggal_selesai, tanggal_mulai), ' ', 
                                CASE 
                                    WHEN waktu_selesai IS NULL OR waktu_selesai = '' THEN '23:59:59'
                                    WHEN CHAR_LENGTH(waktu_selesai) = 5 THEN CONCAT(waktu_selesai, ':00')
                                    ELSE waktu_selesai
                                END
                            ) < ?
                        ", [$now->format('Y-m-d H:i:s')])
                        ->where('status', '!=', 'cancelled');
                    });
                    break;
                    
                case 'cancelled':
                    $q->where('status', 'cancelled');
                    break;
            }
        });
    }
}
