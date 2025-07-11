<style>
    body {
        background-color: #f2f4f7;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
    }

    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }

    .login-card {
        background-color: #fff;
        border-radius: 1.25rem;
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
        max-width: 480px;
        width: 100%;
        padding: 2rem;
        text-align: center;
        transition: all 0.4s ease;
    }

    .login-card:hover {
        transform: scale(1.005);
    }

    .fa-key {
        font-size: 3.5rem;
        color: #6366f1;
        margin-bottom: 1rem;
    }

    h6 {
        font-weight: 600;
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    p.text-muted {
        font-size: 0.95rem;
        color: #6c757d;
        margin-bottom: 1.5rem;
    }

    .form-control {
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        border: 1px solid #dce3ea;
        background: #f9fafb;
        transition: box-shadow 0.3s ease;
        margin-bottom: 1rem;
        width: 100%;
    }

    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
        border-color: #6366f1;
        background-color: #fff;
        outline: none;
    }

    .btn-login {
        background-color: #6366f1;
        color: #fff;
        font-weight: 600;
        border-radius: 0.75rem;
        padding: 0.75rem;
        border: none;
        width: 100%;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-login:hover {
        background-color: #4f46e5;
        transform: translateY(-1px);
    }

    .signup-link {
        font-size: 0.9rem;
        margin-top: 1.25rem;
    }

    .signup-link a {
        color: #4f46e5;
        text-decoration: none;
        font-weight: 500;
    }

    .signup-link a:hover {
        text-decoration: underline;
    }

    .password-input-container {
        position: relative;
        width: 100%;
    }

    .password-input-container .form-control {
        padding-right: 2.75rem;
        /* Untuk icon mata */
    }

    .password-toggle {
        position: absolute;
        top: 50%;
        right: 1rem;
        transform: translateY(-50%);
        cursor: pointer;
        color: #6c757d;
    }

    .form-group-2 .form-control,
    .form-group-2 .form-select {
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        border: 1px solid #dce3ea;
        background: #f9fafb;
        transition: box-shadow 0.3s ease;
        margin-bottom: 1rem;
    }
</style>

<!-- FORM LOGIN -->
<div class="login-container">
    <div class="login-card">
        <i class="fas fa-key"></i>
        <h6><?= translate('Lupa Password');?></h6>
        <p class="text-muted"><?= translate('Silahkan masukkan password terbaru');?></p>

        <form action="<?= base_url('auth/reset_password'); ?>" method="post">
            <div class="form-group-2">
                <input
                    type="text"
                    class="form-control"
                    placeholder="<?= translate('Nama Perusahaan');?>"
                    name="nama_perusahaan"
                    id="nama_perusahaan"
                    required>

                <select
                    class="form-select"
                    name="jenis_perusahaan"
                    id="jenis_perusahaan"
                    required>
                    <option selected disabled><?= translate('Pilih Jenis Perusahaan');?></option>
                    <option value="PT"><?= translate('PT');?></option>
                    <option value="CV"><?= translate('CV');?></option>
                    <option value="Perorangan"><?= translate('Perorangan');?></option>
                </select>
            </div>

            <div class="form-group">
                <div class="password-input-container">
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        placeholder="<?= translate('Masukkan Password');?>"
                        required
                        minlength="8">

                    <span class="password-toggle" onclick="togglePassword()">
                        <iconify-icon
                            id="eyeIcon"
                            class="eye-icon"
                            icon="mdi:eye-off"
                            width="20"
                            height="20">
                        </iconify-icon>
                    </span>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-unlock-alt me-3 text-white"></i><?= translate('Reset Password');?>
            </button>
        </form>

        <div class="signup-link">
            <?= translate('Sudah ingat password?');?>
            <a href="<?= base_url('auth'); ?>"><?= translate('Login');?></a>
        </div>
    </div>
</div>

<!-- JS PASSWORD TOGGLE -->
<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('eyeIcon');

        if (input.type === 'password') {
            input.type = 'text';
            icon.setAttribute('icon', 'mdi:eye');
        } else {
            input.type = 'password';
            icon.setAttribute('icon', 'mdi:eye-off');
        }
    }
</script>

<?php if ($this->session->flashdata('error_message')) : ?>
  <style>
    .swal2-container .swal2-popup.swal2-toast {
      font-size: 0.9rem !important;
      padding: 0.75em 1em !important;
      width: auto !important;
      max-width: 280px !important;
      background-color: #db3545 !important; /* paksa latar merah */
      color: #fff !important;
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.2) !important;
    }

    .swal2-container .swal2-popup.swal2-toast .swal2-title {
      margin: 0 !important;
      padding: 0 !important;
      font-size: 1em !important;
      color: #fff !important;
    }

    .swal2-container .swal2-popup.swal2-toast .swal2-icon.swal2-error {
      color: #fff !important;
      border-color: #fff !important;
      background-color: transparent !important;
    }

    .swal2-container .swal2-popup.swal2-toast .swal2-icon-content {
      color: #fff !important;
    }
  </style>

  <script>
    Swal.fire({
      toast: true,
      icon: 'error',
      title: '<?= $this->session->flashdata('error_message'); ?>',
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
      }
    });
  </script>
<?php endif; ?>
