<!-- CSS -->
<style>
    :root {
        --primary-color: #4e73df;
        --primary-dark: #3b5fc6;
        --secondary-color: #6c8ac9;
        --light-bg: #f8fafc;
        --text-dark: #1e293b;
        --text-medium: #334155;
        --text-light: #64748b;
        --top-bg-color: #7697de;
        --input-border: #e2e8f0;
        --input-focus: rgba(78, 115, 223, 0.15);
        --decoration-color: rgba(118, 151, 222, 0.15);
    }

    body {
        margin: 0;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        min-height: 100vh;
        color: var(--text-dark);
        background: linear-gradient(to bottom,
                var(--top-bg-color) 0%,
                var(--top-bg-color) 40%,
                white 40%,
                white 100%);
        line-height: 1.5;
    }

    .container-register {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 2rem 1rem;
    }

    .card-register {
        background-color: #ffffff;
        border-radius: 1rem;
        padding: 2.5rem;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
        width: 100%;
        max-width: 28rem;
        margin: 1rem;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .logo-container {
        display: flex;
        justify-content: center;
        margin-bottom: 1.5rem;
        position: relative;
    }

    /* Decorative circle behind logo */
    .logo-container::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 7rem;
        height: 7rem;
        border-radius: 50%;
        background-color: var(--decoration-color);
        z-index: 0;
    }

    .logo-container img {
        height: 5.5rem;
        width: auto;
        object-fit: contain;
        position: relative;
        z-index: 1;
    }

    .card-register h5 {
        text-align: center;
        font-weight: 600;
        margin-bottom: 2rem;
        font-size: 1.5rem;
        color: var(--text-dark);
        position: relative;
        padding-bottom: 1.25rem;
    }

    /* Elegant underline decoration */
    .card-register h5::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 4rem;
        height: 0.25rem;
        background: linear-gradient(90deg,
                var(--primary-color) 0%,
                var(--secondary-color) 100%);
        border-radius: 0.25rem;
    }

    .form-group {
        margin-bottom: 1.25rem;
        position: relative;
    }

    .password-input-container {
        position: relative;
        display: flex;
        align-items: center;
    }

    .password-toggle {
        position: absolute;
        left: 12px;
        cursor: pointer;
        color: var(--text-light);
        transition: color 0.2s ease;
        z-index: 2;
        display: flex;
    }

    .password-toggle:hover {
        color: var(--primary-color);
    }

    .eye-icon {
        transition: all 0.2s ease;
    }

    /* Adjust input padding to make space for icon */
    #password {
        padding-left: 40px;
    }

    label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--text-medium);
    }

    input.form-control {
        width: 100%;
        font-size: 0.9375rem;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        border: 1px solid var(--input-border);
        transition: all 0.2s ease;
        box-sizing: border-box;
        background-color: #ffffff;
    }

    input.form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.125rem var(--input-focus);
        outline: none;
    }

    input.form-control::placeholder {
        color: #94a3b8;
        opacity: 1;
    }

    .btn-register {
        margin-top: 1rem;
        width: 100%;
        background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
        color: white;
        font-weight: 600;
        border-radius: 0.5rem;
        padding: 0.8125rem;
        border: none;
        cursor: pointer;
        font-size: 0.9375rem;
        transition: all 0.2s ease;
    }

    .btn-register:hover,
    .btn-register:focus {
        transform: translateY(-1px);
        box-shadow: 0 0.25rem 0.75rem rgba(108, 138, 201, 0.2);
    }

    .btn-register:active {
        transform: translateY(0);
    }

    .login-link {
        text-align: center;
        margin-top: 1.5rem;
        font-size: 0.875rem;
        color: var(--text-light);
    }

    .login-link a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s ease;
    }

    .login-link a:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    /* Responsive adjustments */
    @media (max-width: 640px) {
        .card-register {
            padding: 2rem 1.5rem;
            border-radius: 0.875rem;
        }

        .logo-container img {
            height: 4.5rem;
        }

        .logo-container::before {
            width: 6rem;
            height: 6rem;
        }
    }

    @media (max-width: 400px) {
        .card-register {
            padding: 1.75rem 1.25rem;
        }

        .card-register h5 {
            font-size: 1.375rem;
            margin-bottom: 1.75rem;
        }

        input.form-control {
            padding: 0.6875rem 0.875rem;
        }

        .btn-register {
            padding: 0.75rem;
        }

        .logo-container::before {
            width: 5rem;
            height: 5rem;
        }
    }

    /* Load Inter font */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
</style>

<div class="container-register">
    <div class="card-register">
        <div class="logo-container">
            <img src="<?= base_url('/assets/img/dan_liris.png'); ?>" alt="Logo PT Dan Liris" class="logo-img" />
        </div>

        <h5 class="text-center mb-5"><?= translate('Registrasi');?></h5>

        <form action="<?= base_url('auth/register');?>" method="post">
            <div class="form-group">
                <label for="nama"><?= translate('Nama Perusahaan');?></label>
                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="<?= translate('Masukkan nama perusahaan');?>" required>
            </div>

            <div class="form-group">
                <label for="email"><?= translate('Email');?></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="<?= translate('email@perusahaan.com');?>" required>
            </div>

            <div class="form-group">
                <label for="jenis"><?= translate('Jenis Perusahaan')?></label>
                <select class="form-select" name="company_type" id="company_type" required>
                    <option selected disabled><?= translate('Pilih Jenis Perusahaan')?></option>
                    <option value="PT"><?= translate('PT');?></option>
                    <option value="CV"><?= translate('CV');?></option>
                    <option value="Perorangan"><?= translate('Perorangan');?></option>
                </select>
                <!-- <input type="text" class="form-control" id="jenis" placeholder="PT, CV, atau lainnya" required> -->
            </div>

            <div class="form-group">
                <label for="password"><?= translate('Password');?></label>
                <div class="password-input-container">
                    <span class="password-toggle">
                        <iconify-icon class="eye-icon" icon="mdi:eye-off" width="20" height="20"></iconify-icon>
                    </span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="<?= translate('Buat password');?>" required minlength="8">
                </div>
            </div>

            <button type="submit" class="btn btn-register"><?= translate('Daftar Sekarang');?></button>

            <div class="login-link">
                <?= translate('Sudah punya akun?');?> <a href="<?= base_url('auth'); ?>"><?= translate('Masuk disini');?></a>
            </div>
        </form>
    </div>
</div>

<!-- JS -->
<script>
    // Password toggle functionality
    document.querySelector('.password-toggle').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = this.querySelector('.eye-icon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.setAttribute('icon', 'mdi:eye');
        } else {
            passwordInput.type = 'password';
            eyeIcon.setAttribute('icon', 'mdi:eye-off');
        }
    });
</script>

<!-- Sweeat Alert -->
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

