<style>
    body {
        background-color: #f4f5f7;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        font-size: 1rem;
        line-height: 1.6;
        color: #333;
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

    .form-check-label {
        font-size: 0.95rem;
        font-weight: 500;
    }

    .btn-disabled {
        pointer-events: none;
        opacity: 0.6;
        cursor: not-allowed;
    }

    .card-body ul {
        list-style-type: disc;
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }

    .card-body ul ul {
        list-style-type: circle;
        padding-left: 1.5rem;
    }

    /* Custom checkbox animation (fallback if Bootstrap's JS/CSS fails) */
    .form-check-input {
        appearance: auto;
        accent-color: #0d6efd;
        width: 1.2rem;
        height: 1.2rem;
        transition: all 0.2s ease-in-out;
    }

    .form-check-input:checked {
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    @media (max-width: 576px) {
        .card-header-custom h5 {
            justify-content: center;
            text-align: center;
            font-size: 1.25rem;
            flex-direction: column;
        }

        .card-body {
            font-size: 0.95rem;
        }
    }
</style>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <div class="card custom-card mt-4 mb-4">
                <div class="card-header card-header-custom">
                    <h5 class="card-title mb-0 text-center"><i class="fas fa-file-signature text-primary me-2"></i><?= translate('Kesanggupan Persyaratan K3 dan Lingkungan');?></h5>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url('form/form_persyaratan_save') ?>">
                        <!-- Input Hidden -->
                        <input type="hidden" name="id_perusahaan" id="id_perusahaan" value="<?= $get_user['id']; ?>">
                        <!-- End -->
                        <p>
                            <?= translate(' Sehubungan dengan diberlakukannya program Sistem Manajemen K3 dan Lingkungan sesuai dengan standar ISO 14001:2015 di {{PT Dan Liris}}, maka terdapat beberapa hal yang ditetapkan dan diberlakukan oleh pihak perusahaan, yaitu :');?>
                        </p>
                        <ul>
                            <li><?= translate('Supplier wajib mengelola material kimia yang dibawa ke area {{PT Dan Liris}} dengan cara sebagai berikut :')?>
                                <ul>
                                    <li><?= translate('Menyediakan Lembar Keselamatan Bahan atau Material Safety Data Sheet (MSDS).');?></li>
                                    <li><?= translate('Memberikan Label dan simbol B3 pada kemasan material yang mengandung B3.');?></li>
                                    <li><?= translate('Memastikan penanganan dan penataan material yang benar untuk mencegah kebocoran, tumpahan dan kerusakan.');?></li>
                                </ul>
                            </li>
                            <li><?= translate('Supplier wajib mengelola sampah dari kegiatan supplier dengan cara sebagai berikut :');?>
                                <ul>
                                    <li><?= translate('Membuang sampah pada tempatnya.');?></li>
                                    <li><?= translate('Tidak membawa kemasan yang berlebih.');?></li>
                                    <li><?= translate('Sebisa mungkin diambil kembali dari area lingkungan {{PT Dan Liris}} sampah-sampah B3 yang dihasilkan supplier.');?></li>
                                </ul>
                            </li>
                            <li><?= translate('Mematikan mesin kendaraan saat bongkar muat dan parkir.');?></li>
                            <li><?= translate('Memastikan kendaraan sudah melalui uji emisi dan memenuhi standar baku (untuk supplier jasa angkutan).');?></li>
                            <li><?= translate('Tidak merokok di area {{PT Dan Liris}} kecuali di area yang telah ditentukan.');?></li>
                            <li><?= translate('Tidak mencuci kendaraan di area {{PT Dan Liris}}.');?></li>
                            <li><?= translate('Mematuhi peraturan keselamatan dan kesehatan kerja yang berlaku di lingkungan {{PT Dan Liris}}.')?></li>
                            <li><?= translate('Menggunakan Alat Pelindung Diri (APD) ketika memasuki area yang ditentukan.');?></li>
                            <li><?= translate('Mengikuti prosedur tanggap darurat yang ditetapkan perusahaan.');?></li>
                            <li><?= translate('Menjaga kebersihan, mencegah pencemaran dan memelihara kelestarian lingkungan di area {{PT Dan Liris}}.');?></li>
                        </ul>

                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox" id="persetujuan_persyaratan" name="persetujuan_persyaratan" value="1"
                                <?= (cek_value(safe_array($main, 'persetujuan_persyaratan')) == '1') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="persetujuan_persyaratan">
                                <?= translate('Dengan melanjutkan, saya telah membaca dan menyetujui ketentuan di atas.');?>
                            </label>
                        </div>


                        <div class="form-group d-flex align-items-center justify-content-end gap-8 mt-5">
                            <!-- <a href="<?= base_url('form/form_pernyataan') ?>" class="btn btn-warning-500 border-neutral-100 px-32">
                                Next Page <i class="fas fa-arrow-right"></i>
                            </a> -->
                            <button type="submit" id="btnNext" class="form-wizard-submit btn btn-primary-600 px-32 btn-disabled"><i class="fas fa-thumbs-up me-2"></i><?= translate('Setuju');?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const checkbox = document.getElementById('persetujuan_persyaratan');
    const btnNext = document.getElementById('btnNext');

    function updateButton() {
        if (checkbox.checked) {
            btnNext.classList.remove('btn-disabled');
        } else {
            btnNext.classList.add('btn-disabled');
        }
    }

    window.addEventListener('DOMContentLoaded', updateButton);
    checkbox.addEventListener('change', updateButton);
    btnNext.addEventListener('click', function(e) {
        if (btnNext.classList.contains('btn-disabled')) {
            e.preventDefault();
        }
    });
</script>