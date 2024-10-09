<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TA-TRPL</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url() ?>elusistatic/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url() ?>elusistatic/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="<?php echo base_url() ?>elusistatic/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url() ?>elusistatic/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
    <div class="row">
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="<?php echo base_url(); ?>login/loginMe" method="post">
                        <h1>LOGIN</h1>
                        <h5>Masukkan Username dan Password</h5>
                        <!--                    start of notif alert-->
                        <?php $this->load->helper('form'); ?>
                        <div class="col-md-12">
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                        </div>
                        <?php
                        $this->load->helper('form');
                        $error = $this->session->flashdata('error');
                        if ($error) {
                        ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <?php echo $error; ?>
                            </div>
                        <?php }
                        $success = $this->session->flashdata('success');
                        if ($success) {
                        ?>
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <?php echo $success; ?>
                            </div>
                        <?php } ?>
                        <form action="<?php echo base_url(); ?>login/loginMe" method="post">
                            <div>
                                <input type="text" name="username" class="form-control" placeholder="Username" required />
                            </div>
                            <div>
                                <input type="password" name="password" class="form-control" placeholder="Password" required />
                            </div>
                            <div>
                                <span class="pull-left">Lupa password? Hubungi akademik</span>
                                <input type="submit" class="btn btn-default submit btn-success pull-right" value="Log In" />
                            </div>
                        </form>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h3><i class="fa fa-graduation-cap"></i> Proyek Akhir TRPL</h3>
                                <p>©2024 All Rights Reserved.</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>
<div class="row">
    <hr /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
    <div class="col-md-4 col-sm-4 col-xs-4"></div>
    <div class="col-md-4 col-sm-4 col-xs-4">
        <div role="main">
            <div class="x_title">
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nama Dosen</th>
                            <th>Jumlah Mahasiswa yang Dibimbing</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataTable as $data) { ?>
                            <tr>
                                <td style="vertical-align:middle"><?php echo $data['nama_dosen']; ?></td>
                                <td style="vertical-align:middle">
                                    <center>

                                        <?php echo ($data['bimbingan'] != NULL ? '(' . $data['bimbingan'] . ' / ' . $data['kuota_mahasiswa'] . ')' : '<i>(Tidak ada data)</i>'); ?>

                                    </center>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</html>