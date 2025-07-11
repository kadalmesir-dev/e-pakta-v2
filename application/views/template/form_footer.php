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

 <!-- <script>
$(document).ready(function() {
    // =============================== Wizard Step Js Start ================================
    
    // Fungsi untuk memvalidasi input wajib diisi
    function validasiInput(parentFieldset) {
        var valid = true;
        parentFieldset.find('.wizard-required').each(function() {
            if($(this).val().trim() === "") {
                $(this).siblings(".wizard-form-error").show();
                valid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).siblings(".wizard-form-error").hide();
                $(this).removeClass('is-invalid');
            }
        });
        return valid;
    }
    
    // Fungsi untuk scroll ke step yang aktif
    function scrollKeStepAktif() {
        var stepAktif = $('.form-wizard-list .active');
        var container = $('.form-wizard-header');
        var posisiStep = stepAktif.position().left;
        var lebarContainer = container.width();
        var lebarStep = stepAktif.outerWidth();
        
        // Hitung posisi scroll yang dibutuhkan
        var scrollKe = posisiStep - (lebarContainer / 2) + (lebarStep / 2);
        
        // Animasi scroll
        container.stop().animate({
            scrollLeft: scrollKe
        }, 400);
    }
    
    // Klik tombol next
    $('.form-wizard-next-btn').on("click", function() {
        var fieldsetSaatIni = $(this).parents('.wizard-fieldset');
        var stepAktif = $(this).parents('.form-wizard').find('.form-wizard-list .active');
        
        // Validasi input
        if(validasiInput(fieldsetSaatIni)) {
            // Animasi hide fieldset saat ini
            fieldsetSaatIni.removeClass("show").addClass("menghilang");
            
            setTimeout(function() {
                // Update status step
                stepAktif.removeClass('active')
                    .addClass('completed')
                    .next()
                    .addClass('active');
                
                // Tampilkan fieldset berikutnya
                var nextFieldset = fieldsetSaatIni.next('.wizard-fieldset');
                nextFieldset.addClass("show muncul")
                    .on('animationend', function() {
                        $(this).removeClass("muncul");
                    });
                
                // Scroll ke step yang aktif
                scrollKeStepAktif();
                
                // Hilangkan class menghilang setelah animasi selesai
                fieldsetSaatIni.removeClass("menghilang");
            }, 400);
        }
    });
    
    // Klik tombol previous
    $('.form-wizard-previous-btn').on("click", function() {
        var fieldsetSaatIni = $(this).parents('.wizard-fieldset');
        var stepAktif = $(this).parents('.form-wizard').find('.form-wizard-list .active');
        
        // Animasi hide fieldset saat ini
        fieldsetSaatIni.removeClass("show").addClass("menghilang");
        
        setTimeout(function() {
            // Update status step
            stepAktif.removeClass('active')
                .prev()
                .removeClass('completed')
                .addClass('active');
            
            // Tampilkan fieldset sebelumnya
            var prevFieldset = fieldsetSaatIni.prev('.wizard-fieldset');
            prevFieldset.addClass("show muncul")
                .on('animationend', function() {
                    $(this).removeClass("muncul");
                });
            
            // Scroll ke step yang aktif
            scrollKeStepAktif();
            
            // Hilangkan class menghilang setelah animasi selesai
            fieldsetSaatIni.removeClass("menghilang");
        }, 400);
    });
    
    // Klik tombol submit
    $(document).on("click", ".form-wizard .form-wizard-submit", function() {
        var fieldsetSaatIni = $(this).parents('.wizard-fieldset');
        
        if(validasiInput(fieldsetSaatIni)) {
            // Tandai step terakhir sebagai selesai
            $('.form-wizard-list__item:last').addClass('completed');
            
            // Submit form (simulasi)
            var form = $(this).parents('form');
            console.log('Form data:', form.serialize());
            
            // Tampilkan pesan sukses
            alert("Formulir berhasil dikirim!");
            
            // Disable tombol submit untuk menghindari double submit
            $(this).prop('disabled', true);
        }
    });
    
    // Handle focus dan blur pada input
    $(".form-control").on({
        'focus': function() {
            $(this).parent().addClass("focus-input");
            $(this).siblings(".wizard-form-error").hide();
            $(this).removeClass('is-invalid');
        },
        'blur': function() {
            if($(this).val().trim() === '') {
                $(this).parent().removeClass("focus-input");
                $(this).siblings(".wizard-form-error").show();
                $(this).addClass('is-invalid');
            } else {
                $(this).parent().addClass("focus-input");
                $(this).siblings(".wizard-form-error").hide();
                $(this).removeClass('is-invalid');
            }
        }
    });
    
    // =============================== Wizard Step Js End ================================
});
</script> -->


    <script>
        // =============================== Wizard Step Js Start ================================
        $(document).ready(function() {
            // click on next button
            $('.form-wizard-next-btn').on("click", function() {
                var parentFieldset = $(this).parents('.wizard-fieldset');
                var currentActiveStep = $(this).parents('.form-wizard').find('.form-wizard-list .active');
                var next = $(this);
                var nextWizardStep = true;
                parentFieldset.find('.wizard-required').each(function(){
                    var thisValue = $(this).val();

                    if( thisValue == "") {
                        $(this).siblings(".wizard-form-error").show();
                        nextWizardStep = false;
                    }
                    else {
                        $(this).siblings(".wizard-form-error").hide();
                    }
                });
                if( nextWizardStep) {
                    next.parents('.wizard-fieldset').removeClass("show","400");
                    currentActiveStep.removeClass('active').addClass('activated').next().addClass('active',"400");
                    next.parents('.wizard-fieldset').next('.wizard-fieldset').addClass("show","400");
                    $(document).find('.wizard-fieldset').each(function(){
                        if($(this).hasClass('show')){
                            var formAtrr = $(this).attr('data-tab-content');
                            $(document).find('.form-wizard-list .form-wizard-step-item').each(function(){
                                if($(this).attr('data-attr') == formAtrr){
                                    $(this).addClass('active');
                                    var innerWidth = $(this).innerWidth();
                                    var position = $(this).position();
                                    $(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});
                                }else{
                                    $(this).removeClass('active');
                                }
                            });
                        }
                    });
                }
            });
            //click on previous button
            $('.form-wizard-previous-btn').on("click",function() {
                var counter = parseInt($(".wizard-counter").text());;
                var prev =$(this);
                var currentActiveStep = $(this).parents('.form-wizard').find('.form-wizard-list .active');
                prev.parents('.wizard-fieldset').removeClass("show","400");
                prev.parents('.wizard-fieldset').prev('.wizard-fieldset').addClass("show","400");
                currentActiveStep.removeClass('active').prev().removeClass('activated').addClass('active',"400");
                $(document).find('.wizard-fieldset').each(function(){
                    if($(this).hasClass('show')){
                        var formAtrr = $(this).attr('data-tab-content');
                        $(document).find('.form-wizard-list .form-wizard-step-item').each(function(){
                            if($(this).attr('data-attr') == formAtrr){
                                $(this).addClass('active');
                                var innerWidth = $(this).innerWidth();
                                var position = $(this).position();
                                $(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});
                            }else{
                                $(this).removeClass('active');
                            }
                        });
                    }
                });
            });
            //click on form submit button
            $(document).on("click",".form-wizard .form-wizard-submit" , function(){
                var parentFieldset = $(this).parents('.wizard-fieldset');
                var currentActiveStep = $(this).parents('.form-wizard').find('.form-wizard-list .active');
                parentFieldset.find('.wizard-required').each(function() {
                    var thisValue = $(this).val();
                    if( thisValue == "" ) {
                        $(this).siblings(".wizard-form-error").show();
                    }
                    else {
                        $(this).siblings(".wizard-form-error").hide();
                    }
                });
            });
            // focus on input field check empty or not
            $(".form-control").on('focus', function(){
                var tmpThis = $(this).val();
                if(tmpThis == '' ) {
                    $(this).parent().addClass("focus-input");
                }
                else if(tmpThis !='' ){
                    $(this).parent().addClass("focus-input");
                }
            }).on('blur', function(){
                var tmpThis = $(this).val();
                if(tmpThis == '' ) {
                    $(this).parent().removeClass("focus-input");
                    $(this).siblings(".wizard-form-error").show();
                }
                else if(tmpThis !='' ){
                    $(this).parent().addClass("focus-input");
                    $(this).siblings(".wizard-form-error").hide();
                }
            });
        });
        // =============================== Wizard Step Js End ================================
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