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

    /* Styling untuk alert */
    /* Styling untuk alert */
    .custom-alert-info {
        border-radius: 12px;
        background-color: #e7f8fb;
        /* Background biru muda */
        border: 1px solid #c8e6f9;
        /* Border biru soft */
        padding: 1.5rem;
        font-size: 1rem;
        color: #1565c0;
        /* Warna teks utama biru gelap */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    /* Styling untuk icon circle dengan animasi denyut jantung */
    .custom-alert-info .icon-circle {
        background-color: #90caf9;
        /* Warna background icon biru muda */
        color: #1e88e5;
        /* Warna icon biru */
        border-radius: 50%;
        padding: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        width: 45px;
        height: 45px;
        flex-shrink: 0;
        animation: heartbeat 1.5s ease-in-out infinite;
    }

    /* Definisi animasi denyut jantung */
    @keyframes heartbeat {
        0% {
            transform: scale(1);
        }

        25% {
            transform: scale(1.1);
        }

        50% {
            transform: scale(1);
        }

        75% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }

    /* Styling untuk judul dan pesan alert */
    .custom-alert-info .alert-title {
        font-weight: 600;
        font-size: 1.125rem;
        margin-bottom: 0.25rem;
        color: #1e88e5;
        /* Judul berwarna biru */
    }

    .custom-alert-info .alert-message {
        font-size: 0.95rem;
        color: #1565c0;
        /* Pesan berwarna biru gelap */
        margin-bottom: 0;
    }

    @media (max-width: 576px) {
        .card-header-custom h5 {
            justify-content: center;
            text-align: center;
            font-size: 1.25rem;
            flex-direction: column;
        }
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10 col-sm-12">
            <div class="card custom-card mt-4 mb-4">
                <div class="card-header card-header-custom">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cloud-upload-alt text-primary me-2"></i>
                        <?= translate('Form Upload Dokumen');?>
                    </h5>
                </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate method="post" action="<?= base_url('form/form_dokumen_upload_save'); ?>" enctype="multipart/form-data">
                        <!-- Input Hidden -->
                         <input type="hidden" name="id_perusahaan" id="id_perusahaan" value="<?= $get_user['id']; ?>">
                         <!-- end -->
                        <div class="custom-alert-info d-flex align-items-start gap-3 mb-3">
                            <div class="icon-circle">
                                <i class="fas fa-info-circle"></i> <!-- atau pakai Bootstrap Icon: <i class="bi bi-info-circle"></i> -->
                            </div>
                            <div>
                                <div class="alert-title"><?= translate('Informasi');?></div>
                                <p class="alert-message"><?= translate('Dimohon kembali untuk mengecek file dokumen yang di perlukan pada proses sebelumnya di "Form Download" apakah dokumen sudah di download atau belum. <b>Format yang dijinkan upload : .pdf/.jpg/.jpeg/.png size 5 MB.</b>');?></p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Unggah Dokumen OEKO-TEX Code of Conduct');?></label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-rocket"></i><!-- Bootstrap Icons -->
                                </span>
                                <input class="form-control" type="file" name="code_of_conduct_document" id="code_of_conduct_document" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= translate('Unggah Dokumen Social Compliance');?></label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-rocket"></i><!-- Bootstrap Icons -->
                                </span>
                                <input class="form-control" type="file" name="social_compliance_document" id="social_compliance_document" required>
                            </div>
                        </div>

                         <div class="mb-3">
                            <label for="nama_perusahaan" class="form-label"><?= translate('Unggah KTP / NPWP');?></label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-rocket"></i><!-- Bootstrap Icons -->
                                </span>
                                <input class="form-control" type="file" name="upload_ktp_npwp" id="upload_ktp_npwp" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nama_perusahaan" class="form-label"><?= translate('Unggah NIB');?></label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-rocket"></i><!-- Bootstrap Icons -->
                                </span>
                                <input class="form-control" type="file" name="upload_nib" id="upload_nib" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nama_perusahaan" class="form-label"><?= translate('Unggah Dokumen Lain');?></label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-rocket"></i><!-- Bootstrap Icons -->
                                </span>
                                <input class="form-control" type="file" name="upload_other_document" id="upload_other_document" required>
                            </div>
                        </div>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="pdfModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Lebih lebar dan tengah -->
                                <div class="modal-content shadow-lg">
                                    <div class="modal-header bg-success text-white">
                                        <h6 class="modal-title text-white">
                                            <i class="bi bi-file-earmark-pdf-fill me-2"></i> Download Documents
                                        </h6>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <?php if (!empty($files)): ?>
                                            <div class="list-group">
                                                <?php foreach ($files as $file): ?>
                                                    <a href="<?= $file['path'] ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" download title="Klik untuk mengunduh file ini">
                                                        <div>
                                                            <i class="bi bi-file-pdf-fill text-danger me-2"></i>
                                                            <strong><?= $file['name'] ?></strong>
                                                            <div class="small text-muted">Klik untuk mengunduh</div>
                                                        </div>
                                                        <span class="badge text-sm fw-semibold border border-success-600 text-success-600 bg-transparent px-20 py-9 radius-4 text-white"><i class="fas fa-file-pdf me-3"></i>PDF</span>
                                                    </a>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="alert alert-info text-center">
                                                <i class="bi bi-info-circle-fill me-1"></i> Tidak ada dokumen untuk diunduh.
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="bi bi-x-circle me-1"></i> Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- End Modal-->



                        <div class="form-group d-flex align-items-center justify-content-end gap-8">
                            <a href="<?= base_url('form/form_persyaratan') ?>" class="btn btn-warning-500 border-neutral-100 px-32">
                                Next Page <i class="fas fa-arrow-right"></i>
                            </a>
                            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pdfModal">
                                Download Document
                            </button> -->
                            <button type="submit" class="form-wizard-submit btn btn-primary-600 px-32"><i class="fa-solid fa-paper-plane me-3"></i>Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>