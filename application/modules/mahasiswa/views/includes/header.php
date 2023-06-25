<?php

/**
 * Created by nad.
 * Date: 07/03/2018
 * Time: 11:31
 * Description:
 */
?>
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

    <!-- Bootstrap -->
    <link href="<?php echo base_url() ?>elusistatic/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url() ?>elusistatic/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="<?php echo base_url() ?>elusistatic/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- validation css -->
    <link href="<?php echo base_url() ?>elusistatic/css/validation.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url() ?>elusistatic/build/css/custom.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>elusistatic/build/css/customm.css" rel="stylesheet">

    <script src="<?php echo base_url() ?>elusistatic/vendors/jquery/dist/jquery.min.js"></script>
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
                        <a href="<?php echo base_url(); ?>mahasiswa" class="site_title"><i class="fa fa-graduation-cap"></i> <span>TRPL-TA</span></a>
                    </div>
                    <div class="clearfix"></div>
                    <br />
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>Mahasiswa</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?php echo base_url(); ?>mahasiswa"><i class="fa fa-home"></i> Dashboard</a></li>
                                <li><a href="<?php echo base_url(); ?>mahasiswa/profil"><i class="fa fa-user"></i> Profil</a></li>
                                <li><a><i class="fa fa-edit"></i> Data <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo base_url(); ?>mahasiswa/pengajuan/tugasakhir">Tugas Akhir</a></li>
                                        <li><a href="<?php echo base_url(); ?>mahasiswa/sidang">Sidang</a></li>
                                        <li><a href="<?php echo base_url(); ?>mahasiswa/yudisium">Yudisium</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo base_url(); ?>mahasiswa/pengumuman"><i class="fa fa-bell"></i> Pengumuman</a></li>
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
                                    <li><a href="<?php echo base_url(); ?>mahasiswa/changepassword"><i class="fa fa-key pull-right"></i> Ubah Password</a></li>
                                    <li><a href="<?php echo base_url(); ?>mahasiswa/logout"><i class="fa fa-sign-out pull-right"></i> Keluar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">