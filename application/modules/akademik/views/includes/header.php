<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if (isset($pageTitle)) {
        echo '<title>' . $pageTitle . '</title>';
    } else {
        echo '<title>TA</title>';
    } ?>

    <!-- jQuery -->
    <script src="<?php echo base_url() ?>elusistatic/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link href="<?php echo base_url() ?>elusistatic/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url() ?>elusistatic/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url() ?>elusistatic/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url() ?>elusistatic/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="<?php echo base_url() ?>elusistatic/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="<?php echo base_url() ?>elusistatic/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?php echo base_url() ?>elusistatic/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="<?php echo base_url() ?>elusistatic/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="<?php echo base_url() ?>elusistatic/vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url() ?>elusistatic/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- validation css -->
    <link href="<?php echo base_url() ?>elusistatic/css/validation.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url() ?>elusistatic/build/css/custom.min.css" rel="stylesheet">
    <!-- Ion.RangeSlider -->
    <link href="<?php echo base_url() ?>elusistatic/vendors/normalize-css/normalize.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>elusistatic/vendors/ion.rangeSlider/css/ion.rangeSlider.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>elusistatic/vendors/ion.rangeSlider/css/ion.rangeSlider.skinModern.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url() ?>elusistatic/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>elusistatic/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>elusistatic/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>elusistatic/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>elusistatic/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- jQuery validate -->
    <script src="<?php echo base_url() ?>elusistatic/js/jquery.validate.js"></script>

    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?php echo base_url() ?>akademik" class="site_title"><i class="fa fa-graduation-cap"></i> <span>TRPL-TA</span></a>
                    </div>
                    <div class="clearfix"></div>
                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>Akademik</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?php echo base_url() ?>akademik/dashboard/"><i class="fa fa-home"></i> Dashboard</a></li>
                                <li><a href="<?php echo base_url() ?>akademik/pengumuman/"><i class="fa fa-cloud-upload"></i> Pengumuman</a></li>
                                <li><a><i class="fa fa-user"></i> Daftar User <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo base_url(); ?>akademik/daftar_mahasiswa">Mahasiswa</a></li>
                                        <li><a href="<?php echo base_url(); ?>akademik/daftar_dosen">Dosen</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-group"></i> Akun User <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo base_url() ?>akademik/akun_mahasiswa/">Mahasiswa</a></li>
                                        <li><a href="<?php echo base_url() ?>akademik/akun_dosen/">Dosen</a></li>
                                        <li><a href="<?php echo base_url() ?>akademik/akun_akademik/">Akademik</a></li>
                                        <li><a href="<?php echo base_url() ?>akademik/akun_kaprodi/">Kaprodi</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-file-archive-o"></i> Syarat <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo base_url() ?>akademik/penilaian/">Penilaian</a></li>
                                        <li><a href="<?php echo base_url() ?>akademik/berkas_sidang/">Sidang</a></li>
                                        <li><a href="<?php echo base_url() ?>akademik/berkas_yudisium/">Yudisium</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-check"></i> Persetujuan <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo base_url() ?>akademik/tugas_akhir">Tugas Akhir</a></li>
                                        <li><a href="<?php echo base_url() ?>akademik/sidang">Sidang</a></li>
                                        <li><a href="<?php echo base_url() ?>akademik/yudisium">Yudisium</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo base_url() ?>akademik/periode/"><i class="fa fa-clock-o"></i> Periode Registrasi</a></li>
                                <li><a href="<?php echo base_url() ?>akademik/proyek/"><i class="fa fa-files-o"></i> Proyek</a></li>
                                <?php if ($this->session->userdata('isKaprodi')) { ?>
                                    <li><a href="<?php echo base_url() ?>kaprodi/"><i class="fa fa-arrow-circle-right"></i> Ganti ke Kaprodi</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i> <?php echo $this->session->userdata('name'); ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li><a href="<?php echo base_url(); ?>akademik/changePassword"><i class="fa fa-key pull-right"></i> Ubah Password</a></li>
                                    <li><a href="<?php echo base_url(); ?>akademik/logout"><i class="fa fa-sign-out pull-right"></i> Keluar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">