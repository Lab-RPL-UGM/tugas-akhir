<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>e-Lusi - Kaprodi </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url()?>elusistatic/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url()?>elusistatic/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="<?php echo base_url()?>elusistatic/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url()?>elusistatic/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div style="transform: translateY(50%);">
    <center>
        <h1>Selamat datang, <?php echo $this->session->userdata('name'); ?></h1>
    </center>
    <div class="login_wrapper">
<!--        <section class="login_content">-->
            <form>
                <div class="separator">
                    <center>
                        <h4>Silahkan pilih menu ..</h4>
                    </center>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="<?php echo base_url(); ?>kaprodi/switch_akademik" class="btn btn-lg btn-block btn-app">
                                <i class="fa fa-user"></i>  AKADEMIK
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="<?php echo base_url(); ?>kaprodi/switch_dosen"class="btn btn-lg btn-block btn-app">
                                <i class="fa fa-user"></i> DOSEN
                            </a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="separator">
                    <div class="clearfix"></div>
                    <br />
                    <center>
                        <div>
                            <h3><i class="fa fa-graduation-cap"></i> Proyek Akhir TRPL</h3>
                            <p>©2023 All Rights Reserved.</p>
                        </div>
                    </center>
                </div>
            </form>
<!--        </section>-->
    </div>
</div>
</body>
</html>