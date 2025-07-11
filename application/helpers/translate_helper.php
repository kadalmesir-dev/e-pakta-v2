<?php
use Stichoza\GoogleTranslate\GoogleTranslate;

if (!function_exists('translate')) {
    function translate($text)
    {
        $CI  =& get_instance();
        $lang = $CI->session->userdata('site_lang') ?? 'id';

        if ($lang == 'id') return str_replace(['{{', '}}'], '', $text); // hapus kurung doang

        // Pisahkan frasa yang dibungkus {{...}}
        $split = preg_split('/({{.*?}})/', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
        $final = '';

        try {
            $tr = new GoogleTranslate($lang);

            foreach ($split as $part) {
                if (preg_match('/{{(.*?)}}/', $part, $match)) {
                    // Tambahkan spasi di depan jika sebelumnya tidak ada spasi
                    if (!preg_match('/\s$/', $final)) {
                        $final .= ' ';
                    }

                    $final .= $match[1];

                    // Tambahkan spasi setelahnya jika belum ada
                    $final .= ' ';
                } else {
                    $translated = $tr->translate($part);

                    // Trim dulu agar tidak dobel spasi
                    $final .= trim($translated) . ' ';
                }
            }

            return trim($final);
        } catch (Exception $e) {
            return str_replace(['{{', '}}'], '', $text); // fallback: hapus kurung aja
        }
    }
}

// $excluded_phrases = ['PT Dan Liris', 'Pt dan Liris', 'Pt Dan Liris', 'pt dan liris', 'PT DAN LIRIS'];

// if (!function_exists('translate')) {
//     function translate($text)
//     {
//         $CI =& get_instance();
//         $lang = $CI->session->userdata('site_lang') ?? 'id';

//         // Kalau default (misal 'id'), gak usah translate
//         if ($lang == 'id') return $text;

//         try {
//             $tr = new GoogleTranslate($lang);
//             return $tr->translate($text);
//         } catch (Exception $e) {
//             return $text; // fallback ke asli
//         }
//     }
// }
