<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Model
        $this->load->model('M_form_rekanan_suplier');

        // Proteksi akses url langsung
        if (!$this->session->userdata('is_logged_in')) {
            $this->session->sess_destroy();
            redirect('auth?error=unauthorized');
        }


        // Proteksi user-agent
        if ($this->session->userdata('user_agent') !== $this->input->user_agent()) {
            $this->session->sess_destroy();
            redirect('auth');
        }
    }

    public function index()
    {
        $data['judul_website'] = "Form Rekanan Suplier";
        $id_user = $this->session->userdata('id');
        $data['get_user'] = $this->db->get_where('Epakta_register', ['id' => $id_user])->row_array();
        $data['main'] = $this->db->get_where('Epakta_profile_supplier', ['id_perusahaan' => $id_user])->row_array();

        // Proteksi: jika $main null, jadikan array kosong
        $data['main'] = $data['main'] ?? [];

        $this->load->view('template/form_header', $data);
        $this->load->view('form/form_rekanan_suplier', $data);
        $this->load->view('template/form_footer');
    }


    public function form_persyaratan()
    {
        $data['judul_website'] = "Form Kesanggupan Persyaratan ";
        $id_user = $this->session->userdata('id');
        $data['get_user'] = $this->db->get_where('Epakta_register', ['id' => $id_user])->row_array();
        $data['main'] = $this->db->get_where('Epakta_approval', ['id_perusahaan' => $id_user])->row_array();
        $this->load->view('template/form_header', $data);
        $this->load->view('form/form_kesanggupan_persyaratan', $data);
        $this->load->view('template/form_footer');
    }

    public function form_download_dokumen()
    {
        $data['judul_website'] = "Form Download Dokumen";
        $data['files'] = [
            [
                'name' => 'OEKO-TEX Code of Conduct',
                'path' => base_url('assets/files/OEKO-TEX_STeP_Code_of_Conduct_EN.pdf')
            ],
            [
                'name' => 'Social Compliance (English)',
                'path' => base_url('assets/files/Social Compliance_Code of Conduct_EN.pdf')
            ],
            [
                'name' => 'Social Compliance (Local)',
                'path' => base_url('assets/files/Social Compliance_Code of Conduct_IN.pdf')
            ]
        ];
        $this->load->view('template/form_header', $data);
        $this->load->view('form/form_download_dokumen');
        $this->load->view('template/form_footer');
    }

    public function form_upload_dokumen()
    {
        $data['judul_website'] = "Form Upload Dokumen";
        $id_user = $this->session->userdata('id');
        $data['get_user'] = $this->db->get_where('Epakta_register', ['id' => $id_user])->row_array();
        $data['files'] = [
            [
                'name' => 'OEKO-TEX Code of Conduct',
                'path' => base_url('assets/files/OEKO-TEX_STeP_Code_of_Conduct_EN.pdf')
            ],
            [
                'name' => 'Social Compliance (English)',
                'path' => base_url('assets/files/Social Compliance_Code of Conduct_EN.pdf')
            ],
            [
                'name' => 'Social Compliance (Local)',
                'path' => base_url('assets/files/Social Compliance_Code of Conduct_IN.pdf')
            ]
        ];
        $this->load->view('template/form_header', $data);
        $this->load->view('form/form_upload_dokumen');
        $this->load->view('template/form_footer');
    }


    public function form_pernyataan()
    {
        $data['judul_website'] = "Form Pernyataan";
        $id_user = $this->session->userdata('id');
        $data['get_user'] = $this->db->get_where('Epakta_register', ['id' => $id_user])->row_array();
        $data['main'] = $this->db->get_where('Epakta_signature', ['id_perusahaan' => $id_user])->row_array();
        $this->load->view('template/form_header', $data);
        $this->load->view('form/form_pernyataan');
        $this->load->view('template/form_footer');
    }

    public function form_notice_email()
    {
        $data['judul_website'] = "Form Notice Email";
        $this->load->view('template/form_header', $data);
        $this->load->view('form/form_notice_email');
        $this->load->view('template/form_footer');
    }

    // Save Area
    public function form_rekanan_suplier_save()
    {
        $this->M_form_rekanan_suplier->save_form_rekanan_suplier();
    }

    public function form_persyaratan_save()
    {
        $this->M_form_rekanan_suplier->save_form_persyaratan();
    }

    public function form_dokumen_upload_save()
    {
        $this->M_form_rekanan_suplier->save_form_dokumen_upload();
    }

    public function form_pernyataan_save()
    {
        $this->M_form_rekanan_suplier->save_form_pernyataan();
    }
    // End


    // Service ttd kirim ke blob azure
    public function upload_signature_to_azure()
    {
        header('Content-Type: application/json');

        //Debug
        log_message('debug', 'Session data: ' . print_r($this->session->userdata(), true));


        // Cek apakah session login masih aktif dan valid
        if (
            !$this->session->userdata('is_logged_in') ||
            !$this->session->userdata('id') 
            // $this->session->userdata('user_agent') !== $this->input->user_agent()
        ) {
            echo json_encode([
                'status' => 'unauthorized',
                'message' => 'Sesi Anda telah habis atau tidak valid. Silakan login ulang.'
            ]);
            return;
        }

        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['signature'])) {
                $fileTmpPath = $_FILES['signature']['tmp_name'];
                $ext = strtolower(pathinfo($_FILES['signature']['name'], PATHINFO_EXTENSION));
                $filename = 'ttd_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
                $azureFolder = 'ttd_epakta';
                $blobPath = $azureFolder . '/' . $filename;

                $this->load->library('azure_blob');
                $azureUrl = $this->azure_blob->uploadBlob($fileTmpPath, $blobPath);

                if ($azureUrl) {
                    $data = $this->input->post();
                    $data['signature_data'] = $azureUrl;

                    $this->M_form_rekanan_suplier->save_form_pernyataan($data);

                    echo json_encode([
                        'status' => 'success',
                        'file' => $azureUrl,
                        'redirect' => base_url('form/form_notice_email')
                    ]);
                    return;
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Gagal upload ke Azure.'
                    ]);
                    return;
                }
            }

            echo json_encode([
                'status' => 'error',
                'message' => 'Request tidak valid'
            ]);
        } catch (Exception $e) {
            // Tangkap semua error & kirim dalam JSON agar tidak crash
            log_message('error', 'Upload Signature Error: ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ]);
        }
    }
}
