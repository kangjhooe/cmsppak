<?php

namespace App\Helpers;

class JabatanHelper
{
    public static function getJabatanDisplay($jabatan)
    {
        switch ($jabatan) {
            case 'Kepala Sekolah':
                return __('kepala_sekolah');
            case 'Wakil Kepala Sekolah':
                return __('wakil_kepala_sekolah');
            default:
                return $jabatan;
        }
    }
}
