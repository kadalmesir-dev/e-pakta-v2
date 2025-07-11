<style>
    body {
        background-color: #f4f5f7;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        font-size: 0.875rem;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        padding: 20px;
    }

    .custom-card {
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
        background: #fff;
        padding: 30px;
        margin-top: 30px;
        border-left: 5px solid rgba(13, 110, 253, 0.3);
        /* Garis halus dengan sedikit transparansi */
    }

    .card-header-custom {
        text-align: center;
        margin-bottom: 25px;
    }

    .card-header-custom h6 {
        font-weight: bold;
        font-size: 1.25rem;
        color: #0d6efd;
        margin: 0;
        text-transform: uppercase;
    }

    .card-body {
        padding: 25px;
        background: #fafafa;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
    }

    .card-body p {
        margin-bottom: 15px;
    }

    .card-body ul {
        padding-left: 20px;
        margin-bottom: 15px;
    }

    .card-body ul li {
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .form-check {
        margin-top: 20px;
        display: flex;
        align-items: center;
    }

    .form-check-input {
        margin-right: 10px;
        width: 1.2rem;
        height: 1.2rem;
        accent-color: #0d6efd;
    }

    .form-check-label {
        font-size: 0.9rem;
        font-weight: 500;
    }

    .btn {
        padding: 0.6rem 1.8rem;
        font-size: 1rem;
        border-radius: 6px;
        border: none;
    }

    .btn-primary-600 {
        background-color: #0d6efd;
        color: white;
    }

    .btn-disabled {
        pointer-events: none;
        opacity: 0.6;
        cursor: not-allowed;
    }

    .form-group {
        margin-top: 25px;
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .form-group a {
        text-decoration: none;
    }

    /* Desain responsif untuk mobile */
    @media (max-width: 576px) {
        .card-header-custom h5 {
            font-size: 1.2rem;
            text-align: center;
        }

        .card-body {
            padding: 15px;
        }

        .form-group {
            flex-direction: column;
            align-items: stretch;
        }
    }

    /* Modal custom */
    .modal-content {
        border-radius: 15px;
    }

    .signature-box {
        border: 2px dashed #ced4da;
        border-radius: 10px;
        background-color: #f8f9fa;
        padding: 15px;
    }

    canvas {
        width: 100%;
        height: auto;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
    }
</style>

<div class="container">
    <div class="custom-card">
        <div class="card-header-custom">
            <h6><i class="fas fa-clipboard-check me-2"></i> <?= translate('Pernyataan');?></h6>
        </div>
        <div class="card-body">
            <form id="pernyataanForm" method="post" action="<?= base_url('form/form_pernyataan_save'); ?>">
                <!-- input hidden -->
                <input type="hidden" name="id_perusahaan" id="id_perusahaan" value="<?= $get_user['id']; ?>">
                <!-- end -->
                <p>
                    <?= translate('Dengan ini menyatakan bahwa,<br>');?>
                    <?= translate('1. Sebagai rekanan {{PT DAN LIRIS}}, kami berkomitmen untuk:');?>
                </p>
                <ul>
                    <li><?= translate('Tidak menawarkan dan/atau memberikan uang serta barang dalam bentuk apapun, layanan, fasilitas dan/atau bentuk imbalan apapun dengan dalih apapun juga baik langsung maupun tidak langsung kepada karyawan dan/atau yang mewakili {{PT DAN LIRIS}}.');?></li>
                    <li><?= translate('Tidak menaikkan harga jual barang/jasa dan biaya lainnya yang bertujuan untuk kepentingan dan/atau keuntungan pribadi karyawan dan/atau yang mewakili {{PT DAN LIRIS}}.');?></li>
                    <li><?= translate('Mematuhi semua ketentuan hukum dan etika bisnis yang berlaku serta menjaga kerahasiaan data dan informasi yang berkaitan dengan {{PT DAN LIRIS}}.');?></li>
                </ul>
                <p>
                    <?= translate('2. Jika dikemudian hari terdapat indikasi dan/atau bukti pelanggaran terhadap pernyataan ini, maka pihak kami siap menerima segala konsekuensi yang berlaku baik dalam bentuk pembatalan kerjasama, tuntutan sejumlah denda yang besarnya ditentukan secara sepihak oleh {{PT DAN LIRIS}} sebagai kompensasi atas kerugian perusahaan dan sanksi lainnya sesuai dengan ketentuan hukum yang berlaku.');?>
                </p>
                <p>
                    <?= translate(' Demikian surat pernyataan ini dibuat dengan sebenar-benarnya dan tanpa paksaan dari pihak manapun. Surat ini sebagai bentuk komitmen kami untuk menjaga integritas kerjasama secara transparan dan profesional.');?>
                </p>

                <div class="form-check style-check d-flex align-items-center">
                    <input class="form-check-input" type="checkbox" name="pernyataan_checked" id="pernyataan_checked" value="1"
                        <?= (cek_value(safe_array($main, 'pernyataan_checked')) == '1') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="pernyataan_checked">
                        <?= translate(' Dengan melanjutkan, saya telah membaca dan menyetujui ketentuan di atas.');?>
                    </label>
                </div>
                <!-- Modal TTD -->
                <div class="modal fade" id="ttdmodal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content shadow-lg" style="border-radius: 20px; overflow: hidden;">

                            <!-- Header -->
                            <div class="modal-header justify-content-center" style="
                background: linear-gradient(135deg, #00b4db, #0083b0);
                color: #fff;
                border-bottom: none;
                padding: 1.5rem;
                border-top-left-radius: 20px;
                border-top-right-radius: 20px;">

                                <div class="d-flex align-items-center">
                                    <i class="fas fa-signature me-2" style="font-size: 1.8rem;"></i>
                                    <div style="font-size: 1.1rem; font-weight: 600; letter-spacing: 0.5px;"><?= translate('Tanda Tangan Digital');?></div>
                                </div>

                                <button type="button" class="btn-close btn-close-white position-absolute end-0 me-3" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Body -->
                            <div class="modal-body" style="background-color: #f7f9fc;">
                                <div class="signature-box" style="
                    border: 2px dashed #b0bec5; 
                    border-radius: 15px; 
                    padding: 20px; 
                    background: #ffffff;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                                    <canvas id="signature-pad" height="300" style="width:100%; border-radius:10px; box-shadow: inset 0 0 10px rgba(0,0,0,0.05);"></canvas>
                                </div>

                                <!-- Tombol Undo & Clear -->
                                <div class="d-flex justify-content-center flex-wrap gap-3 mt-4">
                                    <button id="undo" type="button" class="btn btn-warning text-white px-4 py-2" style="min-width: 140px;">
                                        <i class="fas fa-undo me-2"></i> Undo
                                    </button>
                                    <button id="clear" type="button" class="btn btn-danger text-white px-4 py-2" style="min-width: 140px;">
                                        <i class="fas fa-trash-alt me-2"></i> Delete
                                    </button>
                                </div>

                                <!-- Hidden input untuk simpan data -->
                                <input type="hidden" id="signature_data" name="signature_data" />
                            </div>

                            <!-- Footer -->
                            <div class="modal-footer justify-content-between flex-wrap" style="
                background-color: #f1f5f9; 
                border-bottom-left-radius: 20px; 
                border-bottom-right-radius: 20px;">

                                <button type="button" class="btn btn-secondary px-4 py-2 mb-2 mb-md-0" data-bs-dismiss="modal" style="min-width: 140px;">
                                    <i class="fas fa-times-circle me-2"></i> <?= translate('Tutup');?>
                                </button>
                                <button type="submit" class="btn btn-primary text-white px-4 py-2 mb-2 mb-md-0" id="saveSignature" style="min-width: 180px;">
                                    <i class="fas fa-check-circle me-2"></i> Save
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Modal -->


                <div class="form-group">
                    <button type="button" id="btnNext" class="form-wizard-submit btn btn-primary-600 px-32 btn-disabled" data-bs-toggle="modal" data-bs-target="#ttdmodal"><i class="fas fa-thumbs-up me-2"></i> <?= translate('Setuju');?></button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    const checkbox = document.getElementById('pernyataan_checked');
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

    const canvas = document.getElementById("signature-pad");
    let signaturePad = null;
    let undoStack = [];

    function initializeSignaturePad() {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = 300 * ratio;
        canvas.getContext("2d").scale(ratio, ratio);

        signaturePad = new SignaturePad(canvas, {
            backgroundColor: '#ffffff',
            penColor: '#000000'
        });

        undoStack = [];
        saveState();

        signaturePad.onEnd = function() {
            saveState();
        };
    }

    window.addEventListener("load", initializeSignaturePad);
    document.getElementById('ttdmodal').addEventListener('shown.bs.modal', resizeCanvas);

    function resizeCanvas() {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        const data = signaturePad.toData();
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = 300 * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
        signaturePad.fromData(data);
    }

    function saveState() {
        const data = signaturePad.toData();
        if (undoStack.length === 0 || JSON.stringify(data) !== JSON.stringify(undoStack[undoStack.length - 1])) {
            undoStack.push(data);
        }
    }

    document.getElementById("clear").addEventListener("click", () => {
        signaturePad.clear();
        undoStack = [];
        saveState();
    });

    document.getElementById("undo").addEventListener("click", () => {
        if (undoStack.length > 1) {
            undoStack.pop();
            const previousState = undoStack[undoStack.length - 1];
            signaturePad.clear();
            signaturePad.fromData(previousState);
        } else {
            signaturePad.clear();
            undoStack = [];
            saveState();
        }
    });

    // Convert to Blob JPG & Upload
    function uploadSignature(blob) {
        const formData = new FormData();
        formData.append("signature", blob, "ttd.jpg");
        formData.append("id_perusahaan", document.getElementById("id_perusahaan").value);
        formData.append("pernyataan_checked", document.getElementById("pernyataan_checked").checked ? 1 : 0);

        if (document.getElementById("signature_exists")) {
            formData.append("mode", "update");
        }

        fetch("<?= base_url('form/upload_signature_to_azure') ?>", {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                if (res.status === 'success') {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('ttdmodal'));
                    if (modal) modal.hide();

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Tanda tangan disimpan.',
                        timer: 1200,
                        showConfirmButton: false
                    }).then(() => {
                        // ⚠️ Hapus submit form jika semua data sudah dikirim via fetch
                        window.location.href = res.redirect || "<?= base_url('form/form_notice_email') ?>";
                    });

                } else {
                    Swal.fire("Gagal", res.message || "Gagal menyimpan tanda tangan", "error");
                }
            })
            .catch(err => {
                Swal.fire("Error", "Terjadi kesalahan jaringan", "error");
                console.error(err);
            });
    }


    // function uploadSignature(blob) {
    //     const formData = new FormData();
    //     formData.append("signature", blob, "ttd.jpg");

    //     // Optional: jika sedang edit, kirim info file sebelumnya
    //     if (document.getElementById("signature_exists")) {
    //         formData.append("mode", "update");
    //     }

    //     fetch("<?= base_url('form/upload_signature_to_azure') ?>", {
    //             method: "POST",
    //             body: formData
    //         })
    //         .then(res => res.json())
    //         .then(res => {
    //             if (res.status === 'success') {
    //                 Swal.fire({
    //                     icon: 'success',
    //                     title: 'Berhasil!',
    //                     text: 'Tanda tangan disimpan.',
    //                     timer: 1000,
    //                     showConfirmButton: false
    //                 });

    //                 const modal = bootstrap.Modal.getInstance(document.getElementById('ttdmodal'));
    //                 modal.hide();

    //                 // Submit form utama
    //                 document.getElementById("pernyataanForm").submit();
    //             } else {
    //                 Swal.fire("Gagal", res.message || "Gagal menyimpan tanda tangan", "error");
    //             }
    //         })
    //         .catch(err => {
    //             Swal.fire("Error", "Terjadi kesalahan jaringan", "error");
    //             console.error(err);
    //         });
    // }

    document.getElementById("saveSignature").addEventListener("click", () => {
        if (!signaturePad || signaturePad.isEmpty()) {
            Swal.fire("Oops!", "Silakan tanda tangani terlebih dahulu.", "warning");
        } else {
            const dataURL = signaturePad.toDataURL("image/jpeg", 0.9);

            // Convert base64 ke Blob
            fetch(dataURL)
                .then(res => res.blob())
                .then(blob => {
                    uploadSignature(blob);
                });
        }
    });

    document.getElementById("pernyataanForm").addEventListener("submit", function(event) {
        // Dicegah dulu, submit hanya boleh lewat uploadSignature()
        event.preventDefault();
    });
</script>


<!-- <script>
    const checkbox = document.getElementById('pernyataan_checked');
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

    // checkbox.addEventListener('change', function() {
    //     btnNext.classList.toggle('btn-disabled', !this.checked);
    // });

    // btnNext.addEventListener('click', function(e) {
    //     if (btnNext.classList.contains('btn-disabled')) {
    //         e.preventDefault();
    //     }
    // });

    const canvas = document.getElementById("signature-pad");
    let signaturePad = null;
    let undoStack = [];

    function initializeSignaturePad() {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = 300 * ratio;
        canvas.getContext("2d").scale(ratio, ratio);

        signaturePad = new SignaturePad(canvas, {
            backgroundColor: '#ffffff',
            penColor: '#000000'
        });

        undoStack = [];
        saveState();

        signaturePad.onEnd = function() {
            saveState();
            showLivePreview(); // Tampilkan live preview realtime
        };
    }

    function saveState() {
        const data = signaturePad.toData();
        if (undoStack.length === 0 || JSON.stringify(data) !== JSON.stringify(undoStack[undoStack.length - 1])) {
            undoStack.push(data);
        }
    }

    window.addEventListener("load", initializeSignaturePad);

    document.getElementById('ttdmodal').addEventListener('shown.bs.modal', resizeCanvas);

    function resizeCanvas() {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        const data = signaturePad.toData();
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = 300 * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
        signaturePad.fromData(data);
    }

    document.getElementById("clear").addEventListener("click", () => {
        signaturePad.clear();
        undoStack = [];
        saveState();
        showLivePreview();
    });

    document.getElementById("undo").addEventListener("click", () => {
        if (undoStack.length > 1) {
            undoStack.pop();
            const previousState = undoStack[undoStack.length - 1];
            signaturePad.clear();
            signaturePad.fromData(previousState);
            showLivePreview();
        } else {
            signaturePad.clear();
            undoStack = [];
            saveState();
            showLivePreview();
        }
    });

    // Resize + compress
    function optimizeBase64(dataURL, callback) {
        const img = new Image();
        img.onload = function() {
            const targetWidth = 600;
            const targetHeight = 200;

            const offscreenCanvas = document.createElement('canvas');
            offscreenCanvas.width = targetWidth;
            offscreenCanvas.height = targetHeight;
            const ctx = offscreenCanvas.getContext('2d');
            ctx.fillStyle = "#FFFFFF";
            ctx.fillRect(0, 0, targetWidth, targetHeight);
            ctx.drawImage(img, 0, 0, targetWidth, targetHeight);

            const compressedDataURL = offscreenCanvas.toDataURL("image/jpeg", 0.9); 
            callback(compressedDataURL);
        };
        img.src = dataURL;
    }

    document.getElementById("saveSignature").addEventListener("click", () => {
        if (!signaturePad || signaturePad.isEmpty()) {
            Swal.fire("Oops!", "Silakan tanda tangani terlebih dahulu.", "warning");
        } else {
            const dataURL = signaturePad.toDataURL();
            optimizeBase64(dataURL, function(compressedDataURL) {
                document.getElementById("signature_data").value = compressedDataURL;

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Tanda tangan disimpan.',
                    timer: 1000,
                    showConfirmButton: false
                });

                const modal = bootstrap.Modal.getInstance(document.getElementById('ttdmodal'));
                modal.hide();

                // Tambahkan ini untuk submit form setelah tanda tangan
                document.getElementById("pernyataanForm").submit();
            });
        }
    });

    document.getElementById("pernyataanForm").addEventListener("submit", function(event) {
        if (!document.getElementById("signature_data").value) {
            event.preventDefault();
            Swal.fire("Perhatian!", "Silakan tanda tangani terlebih dahulu.", "warning");
            return false;
        }

        Swal.fire({
            title: 'Menyimpan...',
            text: 'Mohon tunggu sebentar.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    });
</script> -->