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
    display: flex;
    background-color: #fff;
    border-radius: 1.25rem;
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    max-width: 900px;
    width: 100%;
    transition: all 0.4s ease;
  }

  .login-card:hover {
    transform: scale(1.005);
  }

  .login-image {
    flex: 1;
    position: relative;
    background: url('https://th.bing.com/th/id/R.09386e8f68f4c18a774b34fc504707af?rik=QUGMaDICQyasTQ&riu=http%3a%2f%2fefrataretailindo.gbgindonesia.com%2fwp-content%2fuploads%2f2021%2f03%2fdan-liris.jpg&ehk=1D4OZ3wpVQo7bjc%2by%2fN%2f%2bADz%2bWTuiya%2br3K%2feBzW3AU%3d&risl=&pid=ImgRaw&r=0') no-repeat center center;
    background-size: cover;
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 2.5rem 2rem 3rem;
  }

  .login-image h4 {
    margin: 0 0 0.4rem 0;
    font-size: 2rem;
    font-weight: 700;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8);
    position: relative;
    z-index: 2;
  }

  .login-image span {
    font-size: 1.1rem;
    font-weight: 500;
    letter-spacing: 0.03em;
    text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.7);
    position: relative;
    z-index: 2;
  }

  /* Hilangkan overlay blur dan gelap */
  .login-image::before {
    content: none;
  }

  .login-form {
    flex: 1;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background-color: #ffffff;
  }

  .login-form img {
    display: block;
    margin: 0 auto 1rem auto;
    height: 50px;
  }

  .login-form h6 {
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 1.25rem;
    text-align: center;
  }

  .login-form p.text-muted {
    text-align: center;
    color: #6c757d;
    margin-bottom: 1.5rem;
  }

  .login-form .form-control,
  .login-form .form-select {
    border-radius: 0.75rem;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    border: 1px solid #dce3ea;
    background: #f9fafb;
    transition: box-shadow 0.3s ease;
    margin-bottom: 1rem;
  }

  .login-form .form-control:focus,
  .login-form .form-select:focus {
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
    margin-top: 1rem;
    text-align: center;
  }

  .signup-link a {
    color: #4f46e5;
    text-decoration: none;
    font-weight: 500;
  }

  .signup-link a:hover {
    text-decoration: underline;
  }


  .lupa-password-link {
    font-size: 0.9rem;
    margin-top: 1rem;
    text-align: center;
  }

  .lupa-password-link a {
    color: #4f46e5;
    text-decoration: none;
    font-weight: 500;
  }

  .lupa-password-link a:hover {
    text-decoration: underline;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .login-card {
      flex-direction: column;
      border-radius: 1rem;
    }

    .login-image {
      min-height: 200px;
      justify-content: center;
      align-items: center;
      text-align: center;
      border-radius: 1rem 1rem 0 0;
      padding: 2rem 1.5rem 2rem;
      background-position: center center;
    }

    .login-image h4 {
      font-size: 1.6rem;
    }

    .login-image span {
      font-size: 1rem;
    }

    .login-form h6 {
      text-align: center;
    }
  }

  .form-group {
    margin-bottom: 1.25rem;
    position: relative;
  }

  .password-input-container {
    position: relative;
  }

  .password-toggle {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: var(--text-light);
  }

  #password {
    padding-left: 40px;
    height: 48px;
    line-height: 48px;
    /* Sama dengan height */
  }

  .eye-icon {
    transition: all 0.2s ease;
  }
</style>

<div class="login-container">
  <div class="login-card">
    <div class="login-image">
      <h4 style="color: white;"><?= translate('{{PT Dan Liris}}') ?></h4>
      <span><?= translate('Central Java, Indonesia') ?></span>
    </div>
    <div class="login-form">
      <img src="<?= base_url('/assets/img/dan_liris.png'); ?>" alt="<?= translate('Logo PT Dan Liris') ?>" />
      <h6><?= translate('Portal Rekanan {{PT Dan Liris}}');?></h6>
      <p class="text-muted"><?= translate('Silakan login dengan akun yang sudah terdaftar') ?></p>

      <form action="<?= base_url('auth/index'); ?>" method="post">
        <input type="text" class="form-control" placeholder="<?= translate('Nama Perusahaan') ?>" name="nama_perusahaan" id="nama_perusahaan" required>

        <select class="form-select" name="jenis_perusahaan" id="jenis_perusahaan" required>
          <option selected disabled><?= translate('Pilih Jenis Perusahaan') ?></option>
          <option value="PT"><?= translate('PT') ?></option>
          <option value="CV"><?= translate('CV') ?></option>
          <option value="Perorangan"><?= translate('Perorangan') ?></option>
        </select>

        <div class="form-group">
          <div class="password-input-container">
            <input type="password" class="form-control" id="password" name="password"
              placeholder="<?= translate('Masukkan Password') ?>" required minlength="8">
            <span class="password-toggle">
              <iconify-icon class="eye-icon" icon="mdi:eye-off" width="20" height="20" style="vertical-align: middle;"></iconify-icon>
            </span>
          </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mb-3 lupa-password-link">
          <a href="<?= base_url('auth/reset_password'); ?>" class="text-primary-600 fw-medium">
            <?= translate('Lupa Password ?') ?>
          </a>
        </div>

        <button type="submit" class="btn-login text-center"><?= translate('Login') ?></button>
      </form>

      <div class="signup-link">
        <?= translate('Daftar akun disini!') ?>
        <a href="<?= base_url('auth/register'); ?>"><?= translate('Sign Up') ?></a>
      </div>
    </div>
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

<!-- Logika Sweat Alert -->
<?php
$flash_type = '';
$flash_msg = '';

if ($this->session->flashdata('success_message')) {
  $flash_type = 'success';
  $flash_msg = $this->session->flashdata('success_message');
} elseif ($this->session->flashdata('error_message')) {
  $flash_type = 'error';
  $flash_msg = $this->session->flashdata('error_message');
}
?>

<?php if ($flash_type && $flash_msg) : ?>
  <style>
    .swal2-container .swal2-popup.swal2-toast {
      font-size: 0.9rem !important;
      padding: 0.75em 1em !important;
      width: auto !important;
      max-width: 280px !important;
      background-color: <?= $flash_type === 'success' ? '#28a745' : '#db3545' ?> !important;
      color: #fff !important;
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.2) !important;
      display: flex !important;
      align-items: center !important;
    }

    .swal2-container .swal2-popup.swal2-toast .swal2-title {
      margin: 0 !important;
      padding: 0 !important;
      font-size: 1em !important;
      color: #fff !important;
    }

    .swal2-container .swal2-popup.swal2-toast .swal2-icon {
      margin: 0 0.6em 0 0 !important;
      transform: scale(0.9);
    }

    .swal2-icon.swal2-success {
      border-color: #fff !important;
    }

    .swal2-icon.swal2-success [class^="swal2-success-line"] {
      background-color: #fff !important;
    }

    .swal2-icon.swal2-success .swal2-success-ring {
      border: 0.25em solid rgba(255, 255, 255, 0.5) !important;
    }

    .swal2-icon.swal2-error {
      border-color: #fff !important;
    }

    .swal2-icon.swal2-error [class^="swal2-x-mark-line"] {
      background-color: #fff !important;
    }

    .swal2-container .swal2-popup.swal2-toast .swal2-icon-content {
      color: #fff !important;
    }
  </style>

  <script>
    Swal.fire({
      toast: true,
      icon: '<?= $flash_type ?>',
      title: '<?= $flash_msg ?>',
      position: 'top-end',
      iconColor: '#fff',
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