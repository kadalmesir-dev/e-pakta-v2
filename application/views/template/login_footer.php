<!-- jQuery library js -->
<script src="<?= base_url('assets/'); ?>js/lib/jquery-3.7.1.min.js"></script>
<!-- Bootstrap js -->
<script src="<?= base_url('assets/'); ?>js/lib/bootstrap.bundle.min.js"></script>
<!-- Apex Chart js -->
<script src="<?= base_url('assets/'); ?>js/lib/apexcharts.min.js"></script>
<!-- Data Table js -->
<script src="<?= base_url('assets/'); ?>js/lib/dataTables.min.js"></script>
<!-- Iconify Font js -->
<script src="<?= base_url('assets/'); ?>js/lib/iconify-icon.min.js"></script>
<!-- jQuery UI js -->
<script src="<?= base_url('assets/'); ?>js/lib/jquery-ui.min.js"></script>
<!-- Vector Map js -->
<script src="<?= base_url('assets/'); ?>js/lib/jquery-jvectormap-2.0.5.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/lib/jquery-jvectormap-world-mill-en.js"></script>
<!-- Popup js -->
<script src="<?= base_url('assets/'); ?>js/lib/magnifc-popup.min.js"></script>
<!-- Slick Slider js -->
<script src="<?= base_url('assets/'); ?>js/lib/slick.min.js"></script>
<!-- prism js -->
<script src="<?= base_url('assets/'); ?>js/lib/prism.js"></script>
<!-- file upload js -->
<script src="<?= base_url('assets/'); ?>js/lib/file-upload.js"></script>
<!-- audioplayer -->
<script src="<?= base_url('assets/'); ?>js/lib/audioplayer.js"></script>

<!-- main js -->
<script src="<?= base_url('assets/'); ?>js/app.js"></script>


<script>
  // ================== Password Show Hide Js Start ==========
  function initializePasswordToggle(toggleSelector) {
    $(toggleSelector).on('click', function() {
      $(this).toggleClass("ri-eye-off-line");
      var input = $($(this).attr("data-toggle"));
      if (input.attr("type") === "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
  }
  // Call the function
  initializePasswordToggle('.toggle-password');
  // ========================= Password Show Hide Js End ===========================
</script>

<!-- Script untuk mengatur label tombol dan simpan pilihan -->
<script>
  $(document).ready(function() {
    $('.translate-option').click(function(e) {
      e.preventDefault();
      const lang = $(this).data('lang');
      const baseUrl = '<?= base_url() ?>';
      const originalText = $('#languageBtn').html();

      $('#languageBtn').html('<i class="fas fa-spinner fa-spin"></i>');

      $.post(baseUrl + 'language/change', {
          lang: lang
        })
        .done(function() {
          location.reload();
        })
        .fail(function(xhr) {
          console.error('Error:', xhr.responseText);
          $('#languageBtn').html(originalText);
          alert('Gagal mengubah bahasa. Silakan coba lagi.');
        });
    });
  });
</script>



</body>

</html>