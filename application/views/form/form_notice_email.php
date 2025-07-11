<!-- Google Fonts: Inter -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<div class="container py-5">
  <div class="d-flex justify-content-center align-items-center min-vh-100">
    <div id="pulseCard" class="bg-white rounded-4 shadow-lg p-4 p-md-5 w-100 pulse" style="max-width: 920px; border: 1px solid #e4e6ef;">
      <div class="row align-items-center g-4">
        <!-- Left Image -->
        <div class="col-md-6 text-center">
          <img src="<?= base_url('assets/') ?>img/call_center_2.png" alt="Email Illustration" class="img-fluid" style="max-width: 280px;">
        </div>

        <!-- Right Text -->
        <div class="col-md-6 text-center text-md-start">
          <h4 class="fw-semibold text-dark mb-3" style="font-size: 1.5rem;">Check Your Email</h4>
          <p class="text-secondary" style="font-size: 1rem; line-height: 1.6;">
            We have sent a verification link to your email address.<br>
            Please check your inbox or spam folder to continue the process.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Styling -->
<style>
  body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(to right, #f4f6fc, #e9efff);
    margin: 0;
    padding: 0;
  }

  .text-secondary {
    color: #6c757d !important;
  }

  .text-dark {
    color: #2c2f36 !important;
  }

  .shadow-lg {
    box-shadow: 0 0.5rem 2rem rgba(0, 0, 0, 0.08) !important;
  }

  .pulse {
    animation: pulse-animation 2s infinite;
    transition: all 0.6s ease;
  }

  @keyframes pulse-animation {
    0% { transform: scale(1); }
    50% { transform: scale(1.03); }
    100% { transform: scale(1); }
  }

  .fade-out {
    animation: shrink-fade 1s forwards;
  }

  @keyframes shrink-fade {
    0% { opacity: 1; transform: scale(1); }
    100% { opacity: 0; transform: scale(0.6); }
  }

  @media (max-width: 768px) {
    .text-md-start {
      text-align: center !important;
    }

    .col-md-6 {
      text-align: center;
    }
  }
</style>

<!-- Script Redirect -->
<script>
  setTimeout(() => {
    const card = document.getElementById("pulseCard");
    card.classList.remove("pulse");
    card.classList.add("fade-out");

    // Redirect after animation ends (1s)
    setTimeout(() => {
      window.location.href = "<?= base_url('auth/reset_session') ?>";
    }, 1000);
  }, 3000);
</script>
