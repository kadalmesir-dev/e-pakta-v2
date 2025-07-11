<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $judul_website; ?></title>
  <link rel="icon" type="image/png" href="<?= base_url('assets/'); ?>img/favicon/dan_liris.png" sizes="16x16">
  <!-- remix icon font css  -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/remixicon.css">
  <!-- BootStrap css -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/bootstrap.min.css">
  <!-- Apex Chart css -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/lib/apexcharts.css">
  <!-- Data Table css -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/lib/dataTables.min.css">
  <!-- Text Editor css -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/lib/editor-katex.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/lib/editor.atom-one-dark.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/lib/editor.quill.snow.css">
  <!-- Date picker css -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/lib/flatpickr.min.css">
  <!-- Calendar css -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/lib/full-calendar.css">
  <!-- Vector Map css -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/lib/jquery-jvectormap-2.0.5.css">
  <!-- Popup css -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/lib/magnific-popup.css">
  <!-- Slick Slider css -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/lib/slick.css">
  <!-- prism css -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/lib/prism.css">
  <!-- file upload css -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/lib/file-upload.css">

  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/lib/audioplayer.css">
  <!-- main css -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/style.css">

  <!-- Sweat alert -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/sweetalert2.min.css">
  <script src="<?= base_url('assets/'); ?>js/sweetalert2.all.min.js"></script>

</head>

<body>
 <?php
$lang_map = [
  'id' => ['label' => 'Bahasa Indonesia', 'flag' => 'https://flagcdn.com/id.svg'],
  'en' => ['label' => 'English', 'flag' => 'https://flagcdn.com/gb.svg'],
  'zh-CN' => ['label' => 'Chinese', 'flag' => 'https://flagcdn.com/cn.svg'],
];
$current_lang = $this->session->userdata('site_lang') ?? 'id';
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12 d-flex justify-content-end p-3">
      <div class="dropdown translate-dropdown position-relative">
        <button class="btn btn-light dropdown-toggle d-flex align-items-center gap-2"
          type="button" id="languageBtn" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="<?= $lang_map[$current_lang]['flag']; ?>" width="20" height="14" alt="flag">
          <?= $lang_map[$current_lang]['label']; ?>
        </button>

        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageBtn">
          <?php foreach ($lang_map as $key => $val): ?>
            <li>
              <a class="dropdown-item translate-option <?= $current_lang == $key ? 'active' : '' ?>"
                 data-lang="<?= $key ?>" href="#">
                <img src="<?= $val['flag']; ?>" width="20" class="me-2"> <?= $val['label']; ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>

<style>
/* Styling minimal tetap dipertahankan agar rapi */
.translate-dropdown .dropdown-menu {
  min-width: 180px;
  border-radius: 10px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.translate-dropdown .dropdown-item.active {
  font-weight: bold;
  background-color: #e9ecef;
}

.translate-dropdown img {
  vertical-align: middle;
  object-fit: cover;
}
</style>

