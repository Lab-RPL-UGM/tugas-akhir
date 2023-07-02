<?php

/**
 * Created by nad.
 * Date: 23/03/2018
 * Time: 18:20
 * Description:
 */
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Ubah Password <small>Atur password baru</small></h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <form role="form" action="<?php echo base_url() ?>akademik/changePassword/changePassword" method="post">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Detail Password</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <label>Password Lama</label>
                            <input name="oldPassword" id="inputOldPassword" type="password" placeholder="Password Lama" class="form-control" required><br>
                        </div>
                        <hr>
                        <div class="row">
                            <label>Password Baru</label>
                            <input name="newPassword" id="inputOldPassword2" type="password" placeholder="Password Baru" class="form-control" required><br>
                        </div>
                        <div class="row">
                            <label>Konfirmasi Password Baru</label>
                            <input name="cNewPassword" id="inputOldPassword3" type="password" placeholder="Konfirmasi Password Baru" class="form-control" required><br>
                        </div>

                        <input type="submit" class="btn btn-primary pull-right" value="Submit">
                        <input type="reset" class="btn btn-danger pull-right" value="Reset">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <?php
            $this->load->helper('form');
            $error = $this->session->flashdata('error');
            if ($error) {
            ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>
            <?php
            $success = $this->session->flashdata('success');
            if ($success) {
            ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php } ?>

            <?php
            $noMatch = $this->session->flashdata('nomatch');
            if ($noMatch) {
            ?>
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('nomatch'); ?>
                </div>
            <?php } ?>

            <div class="row">
                <div class="col-md-12">
                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                </div>
            </div>
        </div>
    </div>
</div>