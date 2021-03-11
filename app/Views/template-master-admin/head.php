<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Omega CMS Siswa</title>
  <!-- Bootstrap  -->
  <link rel="stylesheet" href="<?= base_url('public/assets/plugins/bootstrap/css/bootstrap.min.css') ?>">
  <!-- Main Smart Wizards -->
  <link href="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
  <!-- Datatables -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('public/assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Icheck Bootstrap -->
  <link rel="stylesheet" href="<?= base_url('public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('public/assets/css/adminlte.min.css'); ?>">

  <!--- Running in spark -->
  <!-- <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/plugins/datetimepicker/jquery.datetimepicker.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/style-followup.css">
  <link rel="stylesheet" type="text/css" href="/assets/plugins/datetimepicker/jquery.datetimepicker.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/plugins/swiper/css/swiper.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/plugins/fullcalendar/main.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/style-followup.css"> -->
  <!--- End spark -->

  <!-- Swiper -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/plugins/swiper/css/swiper.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <!-- DatePicker -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <!-- Full Calendar -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/plugins/fullcalendar/main.css') ?>">
  <!-- DateTimePicker -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/plugins/datetimepicker/jquery.datetimepicker.min.css') ?>">
  <!-- Style Follow Up -->
  <link rel="stylesheet" type="text/css" href="<?= base_url("public/assets/css/style-followup.css") ?>">

  <style>
    .paginate_button {
      padding: 0 !important;
      border: none !important;
    }

    .paginate_button:hover {
      background: transparent !important;
      border: none !important;
    }

    .btn-export {
      margin-top: 19px !important;
    }

    .dt-siswaWrapper {
      overflow-x: scroll;
    }

    .dataTables_processing {
      padding: 5px 0 !important;
      background: black !important;
      border-radius: 8px !important;
      opacity: 0.8 !important;
      color: #ffffff !important;
    }

    .is-paddingless {
      padding: 0 !important;
    }

    .is-marginless {
      margin: 0 !important;
    }

    .badge-black {
      background: #000;
    }

    .badge-white {
      background: #fff;
      color: #000;
      border: 1px solid grey;
    }

    .datetimepicker {
      width: 100%;
    }

    .xdsoft_datetimepicker.xdsoft_noselect.xdsoft_.xdsoft_inline,
    .xdsoft_datepicker.active {
      width: 100% !important;
    }

    .xdsoft_month,
    .xdsoft_year {
      z-index: 0 !important;
    }

    .user-comment {
      margin: 5px 0;
    }

    .spacer-comment,
    .date-comment {
      margin: 10px 0 5px 12px;
    }

    .btn-label {
      position: relative;
      left: -12px;
      display: inline-block;
      padding: 6px 12px;
      background: #007BFF;
      border-radius: 3px 0 0 3px;
    }

    .btn-label-2 {
      position: relative;
      left: -12px;
      display: inline-block;
      padding: 6px 12px;
      background: white;
      border-radius: 3px 0 0 3px;
    }

    .btn-labeled {
      padding-top: 0;
      padding-bottom: 0;
    }

    .btn {
      margin-bottom: 10px;
    }

    #dt-siswa {
      position: relative;
    }

    #custom-loading-dt-siswa {
      position: absolute;
      top: 60%;
      left: 0;
      right: 0;
      width: 100%;
      line-height: 30px;
      height: 40px;
      padding: 5px 0;
      text-align: center;
      border-radius: 8px;
      font-size: 19px;
      background: black;
      opacity: 0.8;
      color: #ffffff;
    }

    #processingIndicator {
      background: black;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0.6;
      z-index: 999;
    }

    #override-sign-in-button {
      background: rgb(40, 59, 88) !important;
    }

    .swiper-container {
      width: 100%;
      height: 100%;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }

    .fc-next-button,
    .fc-prev-button {
      background: transparent !important;
      border: none !important;
      padding: 5px !important;
    }

    .fc-icon.fc-icon-chevron-right,
    .fc-icon.fc-icon-chevron-left {
      color: rgb(30, 34, 64) !important;
    }

    .dtSiswa {
      overflow: scroll;
    }

    .fc-event-title.fc-sticky {
      font-size: 11px !important;
    }

    .nav-link {
      color: rgb(40, 59, 88) !important;
    }

    .nav-sidebar>.nav-item>.nav-link.active {
      color: #c2c7d0;
      background-color: rgb(232, 219, 84) !important;
    }

    [class*="sidebar-dark-"] .sidebar a {
      color: rgb(40, 59, 88) !important;
    }

    .info a:hover {
      color: rgb(184, 181, 158) !important;
    }

    [class*="sidebar-dark"] .brand-link {
      border: none !important;
    }

    .nav-sidebar>.nav-item:hover>.nav-link,
    [class*="sidebar-dark-"] .nav-sidebar>.nav-item>.nav-link:focus {
      background: rgb(232, 219, 84) !important;
    }
  </style>

  <script>
    var authRole = '<?= (int) session('authenticated')->role ?>';
    var baseUrl = '<?= base_url(); ?>'
  </script>
</head>