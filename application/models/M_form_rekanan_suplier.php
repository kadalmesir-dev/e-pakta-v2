<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_form_rekanan_suplier extends CI_Model
{

    // === 1. FORM REKANAN SUPLIER ===
    public function save_form_rekanan_suplier()
    {
        $d = $this->input->post();

        // Gabungkan email array jadi string dengan koma
        if (isset($d['email']) && is_array($d['email'])) {
            $d['email'] = implode(',', array_map('trim', $d['email']));
        }

        // Tambahkan field default
        $d['active_st'] = 1;
        $d['delete_st'] = 0;

        // Cek apakah data sudah ada berdasarkan id_perusahaan
        $this->db->where('id_perusahaan', $d['id_perusahaan']);
        $query = $this->db->get('Epakta_profile_supplier');

        if ($query->num_rows() > 0) {
            $d['update_at'] = date('Y-m-d H:i:s');
            $this->db->where('id_perusahaan', $d['id_perusahaan']);
            $this->db->update('Epakta_profile_supplier', $d);
        } else {
            $d['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('Epakta_profile_supplier', $d);
        }

        redirect('form/form_download_dokumen');
    }

    // public function save_form_rekanan_suplier()
    // {
    //     $d = $this->input->post();

    //     $d['active_st'] = 1;
    //     $d['delete_st'] = 0;

    //     // Cek apakah data sudah ada
    //     $this->db->where('id_perusahaan', $d['id_perusahaan']);
    //     $query = $this->db->get('Epakta_profile_supplier');

    //     if ($query->num_rows() > 0) {
    //         $d['update_at'] = date('Y-m-d H:i:s');
    //         $this->db->where('id_perusahaan', $d['id_perusahaan']);
    //         $this->db->update('Epakta_profile_supplier', $d);
    //     } else {
    //         $d['created_at'] = date('Y-m-d H:i:s');
    //         $this->db->insert('Epakta_profile_supplier', $d);
    //     }

    //     redirect('form/form_download_dokumen');
    // }

    // === 2. FORM DOKUMEN UPLOAD ===

   public function save_form_dokumen_upload()
    {
        $this->load->library('Azure_blob');

        $d = $this->input->post();

        $file_fields = ['code_of_conduct_document', 'social_compliance_document', 'upload_ktp_npwp', 'upload_nib', 'upload_other_document'];
        $allowed_types = ['jpg', 'jpeg', 'png', 'pdf'];
        $max_size = 5 * 1024 * 1024; // 5MB

        // Cek apakah data upload sudah ada
        $this->db->where('id_perusahaan', $d['id_perusahaan']);
        $query = $this->db->get('Epakta_upload_document');
        $existing_data = $query->row_array(); // bisa null kalau insert

        // Cek file
        if (
            (empty($_FILES['code_of_conduct_document']['name']) && empty($existing_data['code_of_conduct_document'])) ||
            (empty($_FILES['social_compliance_document']['name']) && empty($existing_data['social_compliance_document'])) ||
            (empty($_FILES['upload_nib']['name']) && empty($existing_data['upload_nib']))
        ) {
          $this->session->set_flashdata('error', "Dokumen 'Code of Conduct', 'Social Compliance',dan 'NIB' wajib diunggah.");
          redirect($_SERVER['HTTP_REFERER']);

        }

        foreach ($file_fields as $field) {
            if (!empty($_FILES[$field]['name'])) {
                $file_name = $_FILES[$field]['name'];
                $file_tmp = $_FILES[$field]['tmp_name'];
                $file_size = $_FILES[$field]['size'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                if (!in_array($file_ext, $allowed_types)) {
                    show_error("File $field harus bertipe JPG, PNG, atau PDF.");
                    return;
                }

                if ($file_size > $max_size) {
                    show_error("Ukuran file $field tidak boleh lebih dari 5MB.");
                    return;
                }

                // --- Hapus file lama jika ada dan valid ---
                if (!empty($existing_data[$field])) {
                    $old_url = $existing_data[$field];

                    // Validasi apakah benar-benar URL Azure Blob
                    if (strpos($old_url, 'https://storagepublicdivision.blob.core.windows.net') === 0) {
                        $parsed = parse_url($old_url, PHP_URL_PATH); // /digitalsign/folder/file.pdf
                        if ($parsed && strpos($parsed, '/digitalsign/') !== false) {
                            $blob_path = ltrim(str_replace("/digitalsign/", "", $parsed), '/'); // folder/file.pdf
                            try {
                                $this->azure_blob->deleteBlob($blob_path);
                            } catch (Exception $e) {
                                log_message('error', 'Gagal hapus blob lama: ' . $e->getMessage());
                                // lanjut saja, jangan hentikan proses
                            }
                        }
                    }
                }

                // Upload baru ke Azure
                $unique_name = $field . '/' . time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file_name);
                $azure_url = $this->azure_blob->uploadBlob($file_tmp, $unique_name);

                if ($azure_url) {
                    $d[$field] = $azure_url; // Simpan URL ke DB
                } else {
                    show_error("Gagal mengupload file $field ke Azure.");
                    return;
                }
            } else {
                // Kalau tidak upload ulang, tetap simpan data lama (khusus update)
                if ($existing_data && isset($existing_data[$field])) {
                    $d[$field] = $existing_data[$field];
                }
            }
        }

        $d['active_st'] = 1;
        $d['delete_st'] = 0;

        if ($existing_data) {
            $d['update_at'] = date('Y-m-d H:i:s');
            $this->db->where('id_perusahaan', $d['id_perusahaan']);
            $this->db->update('Epakta_upload_document', $d);
        } else {
            $d['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('Epakta_upload_document', $d);
        }

        redirect('form/form_persyaratan');
    }



    // === 3. FORM PERSYARATAN ===
    public function save_form_persyaratan()
    {
        $d = $this->input->post();

        $d['active_st'] = 1;
        $d['delete_st'] = 0;

        $this->db->where('id_perusahaan', $d['id_perusahaan']);
        $query = $this->db->get('Epakta_approval');

        if ($query->num_rows() > 0) {
            $d['update_at'] = date('Y-m-d H:i:s');
            $this->db->where('id_perusahaan', $d['id_perusahaan']);
            $this->db->update('Epakta_approval', $d);
        } else {
            $d['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('Epakta_approval', $d);
        }

        redirect('form/form_pernyataan');
    }

    // === 4. FORM PERNYATAAN ===
    public function save_form_pernyataan($data = null)
    {
        // Ambil data dari parameter atau dari input POST
        $d = $data ?? $this->input->post();

        // Validasi wajib
        if (empty($d['signature_data']) || empty($d['id_perusahaan'])) {
            return false; // Return false agar bisa ditangani dari controller jika error
        }

        // Siapkan data untuk insert/update
        $insertData = [
            'signature_data'       => $d['signature_data'],
            'id_perusahaan'        => $d['id_perusahaan'],
            'pernyataan_checked'   => isset($d['pernyataan_checked']) ? 1 : 0,
            'active_st'            => 1,
            'deleted_st'           => 0
        ];

        // Cek apakah data untuk perusahaan ini sudah ada
        $existing = $this->db
            ->where('id_perusahaan', $d['id_perusahaan'])
            ->get('Epakta_signature');

        if ($existing->num_rows() > 0) {
            $insertData['update_at'] = date('Y-m-d H:i:s');
            $this->db->where('id_perusahaan', $d['id_perusahaan'])
                ->update('Epakta_signature', $insertData);
        } else {
            $insertData['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('Epakta_signature', $insertData);
        }

        return true;
    }
}
