<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }


    public function index()
    {

        $validasi = $this->form_validation;
        $validasi->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required|trim');
        $validasi->set_rules('jenis_perusahaan', 'Jenis Perusahaan', 'required|trim');
        $validasi->set_rules('password', 'Password', 'required|trim');

        if ($validasi->run() == false) {

            $errorParam = $this->input->get('error');

            if ($errorParam == 'unauthorized') {
                $this->session->set_flashdata('error_message', 'Sorry, you are not allowed to access this page, please login first');
                redirect('auth');
            }


            $data['judul_website'] = "Form Login";
            $this->load->view('template/login_header', $data);
            $this->load->view('auth/index');
            $this->load->view('template/login_footer');
        } else {
            $this->_login();
        }
    }

    // Login
    private function _login()
    {
        $nama_perusahaan = $this->input->post('nama_perusahaan');
        $jenis_perusahaan = $this->input->post('jenis_perusahaan');
        $password = $this->input->post('password');

        $get_user = $this->db->get_where('Epakta_register', [
            'company_name' => $nama_perusahaan
        ])->row_array();

        if ($get_user) {
            if ($get_user['active_st'] == '1') {
                if (password_verify($password, $get_user['password'])) {

                    //  Regenerate session ID untuk mencegah session fixation
                    $this->session->sess_regenerate(TRUE);

                    // Set session user
                    $data = [
                        'nama_perusahaan' => $get_user['company_name'],
                        'id' => $get_user['id'],
                        'is_logged_in' => TRUE,
                        'user_agent' => $this->input->user_agent()
                    ];
                    $this->session->set_userdata($data);

                    redirect('form');
                } else {
                    $this->session->set_flashdata('error_message', 'Password yang anda masukkan salah!!');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('error_message', 'Nama Perusahaan ini belum di Aktivasi');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('error_message', 'Nama Perusahaan tidak ada. Silakan register!');
            redirect('auth');
        }
    }



    // Register

    public function register()
    {
        // Form Validation
        $validasi = $this->form_validation;

        $validasi->set_rules('company_name', 'Company Name', 'required|trim');
        $validasi->set_rules('email', 'Email', 'required|trim|valid_email');
        $validasi->set_rules('company_type', 'Company Type', 'required|trim');
        $validasi->set_rules('password', 'Password', 'required|trim|min_length[3]', [
            'min_length' => 'Password terlalu pendek'
        ]);

        if ($validasi->run() == false) {
            $data['judul_website'] = "Form Register";
            $this->load->view('template/login_header', $data);
            $this->load->view('auth/register');
            $this->load->view('template/login_footer');
        } else {
            $company_name = $this->input->post('company_name', true); // <-- Tambahkan ini
            $email        = $this->input->post('email', true);

            // Cek apakah email sudah digunakan
            $cek_user = $this->db->get_where('Epakta_register', ['email' => $email])->row();

            if ($cek_user) {
                $this->session->set_flashdata('error_message', 'Email ini sudah terdaftar sebelumnya.');
                redirect('auth/register');
            }

            // Simpan data
            $data = [
                'company_name' => htmlspecialchars($company_name),
                'email'        => htmlspecialchars($email),
                'password'     => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'company_type' => htmlspecialchars($this->input->post('company_type')),
                'active_st'    => 1,
                'delete_st'    => 0,
                'created_at'   => date('Y-m-d H:i:s')
            ];

            $this->db->insert('Epakta_register', $data);
            $this->session->set_flashdata('success_message', 'Akun berhasil dibuat. Silakan login.');
            redirect('auth');
        }
    }


    // Reset Password
    public function reset_password()
    {
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required|trim');
        $this->form_validation->set_rules('jenis_perusahaan', 'Jenis Perusahaan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['judul_website'] = "Reset Password";
            $this->load->view('template/form_header', $data);
            $this->load->view('auth/reset_password', $data);
            $this->load->view('template/form_footer');
        } else {
            $nama_perusahaan   = $this->input->post('nama_perusahaan', true);
            $jenis_perusahaan  = $this->input->post('jenis_perusahaan', true);
            $password_baru     = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            //get data
            $user = $this->db->get_where('Epakta_register', [
                'company_name'  => $nama_perusahaan,
                'company_type' => $jenis_perusahaan
            ])->row();

            if ($user) {
                $this->db->where('id', $user->id);
                $this->db->update('Epakta_register', ['password' => $password_baru]);

                $this->session->set_flashdata('success_message', 'Password berhasil di-reset.');
                redirect('auth');
            } else {
                $this->session->set_flashdata('error_message', 'Data perusahaan tidak ditemukan.');
                redirect('auth/reset_password');
            }
        }
    }

    // Reset Session 
    public function reset_session()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
