<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Fungsi hari dari tanggal
if (!function_exists('to_day_indonesia')) {
    function to_day_indonesia($tanggal)
    {
        $hari = date('l', strtotime($tanggal));
        $indo = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];
        return $indo[$hari] ?? '-';
    }
}

// Format tanggal lengkap dengan hari
if (!function_exists('to_date_indonesia')) {
    function to_date_indonesia($tanggal)
    {
        // Mendapatkan nama hari
        // $hari = to_day_indonesia($tanggal);

        // Daftar bulan dalam bahasa Indonesia
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        // Format tanggal
        $tgl = date('j', strtotime($tanggal));
        $bln = $bulan[(int)date('m', strtotime($tanggal))];
        $thn = date('Y', strtotime($tanggal));

        // Mengembalikan tanggal dengan format: Tanggal, Bulan, Tahun
        return "$tgl $bln $thn";
    }
}

// Safe kondisi value kosong 
if (!function_exists('safe_array')) {
    function safe_array($array, $key, $default = null) {
        return (is_array($array) && array_key_exists($key, $array)) ? $array[$key] : $default;
    }
}

if (!function_exists('cek_value')) {
    function cek_value($value, $default = '-') {
        return ($value !== '' && $value !== null) ? $value : $default;
    }
}



