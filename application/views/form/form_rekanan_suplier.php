<style>
    body {
        background-color: #f4f5f7;
    }

    .custom-card {
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
        background: #fff;
        padding: 25px;
        border: none;
    }

    .card-header-custom {
        background-color: transparent;
        border-bottom: none;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .card-header-custom h5 {
        font-weight: 700;
        font-size: 1.5rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label {
        font-weight: 500;
    }

    .form-control,
    .form-select {
        border-radius: 10px;
    }

    .input-group-text {
        border-radius: 10px;
        cursor: pointer;
    }

    @media (max-width: 576px) {
        .card-header-custom h5 {
            justify-content: center;
            text-align: center;
            font-size: 1.25rem;
            flex-direction: column;
        }
    }

    .email-group {
        margin-top: 0.5rem;
        gap: 0.5rem;
    }

    .email-group input {
        flex: 1;
    }

    .btn-remove-email {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10 col-sm-12">
            <div class="card custom-card mt-4 mb-4">
                <div class="card-header card-header-custom">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-briefcase text-primary me-2"></i>
                        <?= translate('Profil Rekanan / Supplier'); ?>
                    </h5>
                </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate method="post" action="<?= base_url('form/form_rekanan_suplier_save'); ?>">
                        <!-- Inpt Hidden -->
                        <input type="hidden" name="id_perusahaan" id="id_perusahaan" value="<?= $get_user['id']; ?>">
                        <!-- End -->
                        <div class="mb-3">
                            <label class="form-label"><?= translate('Nama Perusahaan'); ?></label>
                            <input type="text" name="company_name" id="company_name" class="form-control" value="<?= $get_user['company_name']; ?>" required readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Jenis Perusahaan'); ?></label>

                            <!-- Select yang hanya untuk tampilan, disabled -->
                            <select class="form-select" name="company_type_display" id="company_type_display" disabled>
                                <option <?= empty($get_user['company_type']) ? 'selected' : '' ?> disabled><?= translate('Pilih Jenis Perusahaan'); ?></option>
                                <option value="PT" <?= ($get_user['company_type'] == 'PT') ? 'selected' : '' ?>><?= translate('PT'); ?></option>
                                <option value="CV" <?= ($get_user['company_type'] == 'CV') ? 'selected' : '' ?>><?= translate('CV'); ?></option>
                                <option value="Perorangan" <?= ($get_user['company_type'] == 'Perorangan') ? 'selected' : '' ?>><?= translate('Perorangan'); ?></option>
                            </select>

                            <!-- Hidden input agar value tetap ikut submit -->
                            <input type="hidden" name="company_type" value="<?= $get_user['company_type'] ?>">
                        </div>


                        <div class="mb-3">
                            <label class="form-label"><?= translate('Jenis Support'); ?></label>
                            <select class="form-select" name="support_type" id="support_type" required>
                                <?php $support_type = cek_value(safe_array($main, 'support_type')); ?>

                                <option <?= ($support_type == '') ? 'selected' : '' ?> disabled><?= translate('Pilih Jenis Support'); ?></option>
                                <option value="Garment" <?= ($support_type == 'Garment') ? 'selected' : '' ?>><?= translate('Garment'); ?></option>
                                <option value="Textile" <?= ($support_type == 'Textile') ? 'selected' : '' ?>><?= translate('Textile'); ?></option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Alamat'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="address" id="address" class="form-control" value="<?= cek_value(safe_array($main, 'address')); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Telephone'); ?> <span class="text-danger">*</span></label>
                            <input type="number" name="telephone" id="telephone" value="<?= cek_value(safe_array($main, 'telephone')); ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Fax'); ?></label>
                            <input type="text" name="fax" id="fax" value="<?= cek_value(safe_array($main, 'fax')); ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Email'); ?> <span class="text-danger">*</span></label>

                            <?php
                            $default_email = isset($get_user['email']) ? $get_user['email'] : '';
                            $emails = explode(',', safe_array($main, 'email'));

                            // Filter out the default email from $emails if it's already included
                            $emails = array_filter($emails, function ($e) use ($default_email) {
                                return trim($e) !== trim($default_email);
                            });

                            // Batasi maksimal 3 email tambahan
                            $emails = array_slice($emails, 0, 3);
                            ?>

                            <div id="email-wrapper">
                                <!-- Email pertama dari user, readonly -->
                                <div class="input-group email-group mb-2">
                                    <input type="email" name="email[]" class="form-control" value="<?= cek_value($default_email); ?>" readonly>
                                </div>

                                <!-- Email tambahan yang bisa diubah -->
                                <?php foreach ($emails as $email): ?>
                                    <div class="input-group email-group mb-2">
                                        <input type="email" name="email[]" class="form-control" placeholder="<?= translate('Email perusahaan'); ?>" value="<?= cek_value($email); ?>" required>
                                        <button type="button" class="btn btn-outline-danger btn-sm btn-remove-email">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="button" id="add-email" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-plus"></i> <?= translate('Tambah Email'); ?>
                                </button>
                            </div>
                        </div>




                        <!-- <div class="mb-3">
                            <label class="form-label"><?= translate('Email'); ?> <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="<?= translate('Email perusahaan'); ?>" value="<?= cek_value(safe_array($main, 'email')); ?>" required>
                            <div class="invalid-feedback"><?= translate('Email diperlukan.'); ?></div>
                        </div> -->

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Website'); ?></label>
                            <input type="text" name="website" id="website" value="<?= cek_value(safe_array($main, 'website')); ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Tahun Berdiri'); ?></label>
                            <input type="number" name="year_founded" id="year_founded" value="<?= cek_value(safe_array($main, 'year_founded')); ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Pemilik'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="owner_name" id="owner_name" value="<?= cek_value(safe_array($main, 'owner_name')); ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Penanggung Jawab'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="person_responsible" id="person_responsible" value="<?= cek_value(safe_array($main, 'person_responsible')); ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('KTP / NPWP'); ?> <span class="text-danger">*</span></label>
                            <input type="number" name="no_ktp_npwp" id="no_ktp_npwp" value="<?= cek_value(safe_array($main, 'no_ktp_npwp')); ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Bank'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="bank" id="bank" value="<?= cek_value(safe_array($main, 'bank')); ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Pemilik Rekening'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="account_owner" id="account_owner" value="<?= cek_value(safe_array($main, 'account_owner')); ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Nomor Rekening'); ?> <span class="text-danger">*</span></label>
                            <input type="number name=" account_number" id="account_number" value="<?= cek_value(safe_array($main, 'account_number')); ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Jumlah Pekerja'); ?></label>
                            <input type="number" name="number_of_workers" id="number_of_workers" value="<?= cek_value(safe_array($main, 'number_of_workers')); ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Luas area') ?> (m<sup>2</sup>)</label>
                            <input type="number" name="area" id="area" value="<?= cek_value(safe_array($main, 'area')); ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Spesialisasi Produk'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name=" special_product" id="special_product" value="<?= cek_value(safe_array($main, 'special_product')); ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Kapasitas Produksi'); ?></label>
                            <input type="text" name="product_capacity" id="product_capacity" value="<?= cek_value(safe_array($main, 'product_capacity')); ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Jumlah Mesin'); ?> <span class="text-danger">*</span></label>
                            <input type="number" name="number_of_machines" id="number_of_machines" value="<?= cek_value(safe_array($main, 'number_of_machines')); ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Sejarah Perusahaan'); ?></label>
                            <textarea name="company_history" id="company_history" class="form-control" required><?= cek_value(safe_array($main, 'company_history')); ?></textarea>
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-end gap-8">
                            <!-- <a href="<?= base_url('form/form_download_dokumen') ?>" class="btn btn-warning-500 border-neutral-100 px-32">
                                Next Page <i class="fas fa-arrow-right"></i>
                            </a> -->
                            <button type="submit" class="form-wizard-submit btn btn-primary-600 px-32"><i class="fa-solid fa-paper-plane me-3"></i>Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const inputs = () => form.querySelectorAll('input, select, textarea');

        // Navigasi enter
        form.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const focusables = inputs();
                let index = Array.from(focusables).indexOf(document.activeElement);
                if (index > -1 && index < focusables.length - 1) {
                    focusables[index + 1].focus();
                } else if (index === focusables.length - 1) {
                    focusables[0].focus();
                }
            }
        });

        const wrapper = document.getElementById('email-wrapper');
        const addBtn = document.getElementById('add-email');
        const maxEmails = 4; // total: 1 readonly + 3 tambahan

        function updateRemoveButtons() {
            const emailGroups = wrapper.querySelectorAll('.email-group');
            emailGroups.forEach((group, i) => {
                const removeBtn = group.querySelector('.btn-remove-email');
                if (removeBtn) {
                    // Tombol hapus hanya tampil jika bukan email pertama
                    removeBtn.style.display = i === 0 ? 'none' : 'inline-block';
                }
            });
        }

        // Tambah email
        addBtn.addEventListener('click', function() {
            const total = wrapper.querySelectorAll('.email-group').length;
            if (total < maxEmails) {
                const div = document.createElement('div');
                div.className = 'input-group email-group mb-2';
                div.innerHTML = `
                <input type="email" name="email[]" class="form-control" placeholder="<?= translate('Email perusahaan'); ?>" required>
                <button type="button" class="btn btn-outline-danger btn-sm btn-remove-email">
                    <i class="fas fa-trash-alt"></i>
                </button>
            `;
                wrapper.appendChild(div);
                updateRemoveButtons();
            } else {
                alert("<?= translate('Maksimal 3 email tambahan.'); ?>");
            }
        });

        // Hapus email tambahan
        wrapper.addEventListener('click', function(e) {
            if (e.target.closest('.btn-remove-email')) {
                e.target.closest('.email-group').remove();
                updateRemoveButtons();
            }
        });

        updateRemoveButtons(); // Panggil saat pertama kali load
    });
</script>


<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input, select, textarea');

        form.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Cegah submit form

                // Ambil elemen aktif
                let index = Array.from(inputs).indexOf(document.activeElement);
                if (index > -1 && index < inputs.length - 1) {
                    inputs[index + 1].focus(); // Fokus ke input selanjutnya
                } else if (index === inputs.length - 1) {
                    inputs[0].focus(); // Balik ke input pertama jika sudah terakhir
                }
            }
        });
    });
</script> -->