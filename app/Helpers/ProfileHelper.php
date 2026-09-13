<?php

namespace App\Helpers;

class ProfileHelper
{
    /**
     * Membersihkan nomor telepon dari karakter non-digit
     */
    public static function cleanPhoneNumber($phone)
    {
        if (!$phone) return '';
        return preg_replace('/[^0-9]/', '', $phone);
    }

    /**
     * Membuat URL telepon
     */
    public static function makePhoneUrl($phone)
    {
        if (!$phone) return '';
        $cleanPhone = self::cleanPhoneNumber($phone);
        return 'tel:' . $cleanPhone;
    }

    /**
     * Membuat URL WhatsApp
     */
    public static function makeWhatsAppUrl($phone)
    {
        if (!$phone) return '';
        $cleanPhone = self::cleanPhoneNumber($phone);
        return 'https://wa.me/' . $cleanPhone;
    }
}
