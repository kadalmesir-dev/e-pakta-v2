<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller {

    public function change()
    {
        $lang = $this->input->post('lang');
        $allowed = ['id', 'en', 'zh-CN'];

        if (!in_array($lang, $allowed)) {
            show_error('Bahasa tidak didukung.', 400);
            return;
        }

        $this->session->set_userdata('site_lang', $lang);
        echo json_encode(['status' => 'ok']);
    }
}
