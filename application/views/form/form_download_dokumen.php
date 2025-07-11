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

        .form-group.d-flex {
            flex-direction: column;
            align-items: stretch !important;
        }
    }

    .dokumen-download-section {
        padding: 2rem;
        background-color: #f9f9f9;
        border-radius: 10px;
        margin-bottom: 2rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .info-box {
        position: relative;
        background-color: #e7f3fe;
        padding: 1.5rem 1rem 1rem 3rem;
        border-left: 4px solid #2196F3;
        border-radius: 6px;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
        color: #084298;
        display: flex;
        align-items: center;
    }

    .info-box i {
        position: absolute;
        top: 8px;
        left: 8px;
        font-size: 16px;
        color: #2196F3;
        animation: heartbeat 1.5s infinite;
    }

    @keyframes heartbeat {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.3);
        }
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .dokumen-card-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .dokumen-card {
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        padding: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: box-shadow 0.2s ease;
    }

    .dokumen-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .dokumen-left {
        display: flex;
        align-items: center;
    }

    .dokumen-right .btn {
        font-size: 0.9rem;
        padding: 0.35rem 0.8rem;
        border-radius: 6px;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10 col-sm-12">
            <div class="card custom-card mt-4 mb-4">
                <div class="card-header card-header-custom">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cloud-download-alt text-primary me-2"></i>
                        <?= translate('Form Download Dokumen')?>
                    </h5>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url('form/form_rekanan_suplier_save'); ?>">
                        <section class="dokumen-download-section">
                            <div class="info-box">
                                <i class="fas fa-info-circle"></i>
                                <?= translate('Harap download dokumen yang tersedia sebelum lanjut ke tahap berikutnya.');?>
                            </div>

                            <h6 class="section-title mb-3 mt-5">
                                <i class="bi bi-file-earmark-pdf-fill text-danger me-2"></i>
                                Download Documents
                            </h6>

                            <div class="dokumen-card-list">
                                <?php if (!empty($files)): ?>
                                    <?php foreach ($files as $file): ?>
                                        <div class="dokumen-card">
                                            <div class="dokumen-left">
                                                <i class="bi bi-file-earmark-pdf-fill text-danger fs-4 me-3"></i>
                                                <div>
                                                    <div class="fw-bold"><?= $file['name'] ?></div>
                                                    <div class="small text-muted"><?= translate('Klik untuk mengunduh');?></div>
                                                </div>
                                            </div>
                                            <div class="dokumen-right">
                                                <a href="<?= $file['path'] ?>" class="btn btn-sm btn-success d-flex align-items-center" download>
                                                    <i class="fas fa-file-pdf me-2"></i> PDF
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="alert alert-info text-center">
                                        <i class="bi bi-info-circle-fill me-1"></i><?= translate('Tidak ada dokumen untuk diunduh.');?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </section>


                        <div class="form-group d-flex align-items-center justify-content-end gap-3 flex-wrap mt-4">
                            <a href="<?= base_url('form/form_upload_dokumen') ?>" class="btn btn-warning">
                                Next Page <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>