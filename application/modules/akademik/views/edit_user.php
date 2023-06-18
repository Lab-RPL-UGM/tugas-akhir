<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>User
                <small>Edit</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php //var_dump($dataUser);?>
            <div class="x_panel">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                        $this->load->helper('form');
                        $error = $this->session->flashdata('error');
                        if($error)
                        {
                    ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                        <?php } ?>
                        <?php  
                        $success = $this->session->flashdata('success');
                        if($success)
                        {
                    ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                        <?php } ?>
                </div>
                <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" id="addEditUserForm" action="<?php echo base_url() ?>akademik/user/edit_user/<?php echo $role; ?>" method="post">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Lengkap
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="hidden" value="<?php  echo $role ;  ?>" name="role" id="role" /> 
                                <input type="hidden" value="<?php  echo $dataUser[0]->id_user ;  ?>" name="userId" id="userId" /> 
                                <input id="fname" type="text" name="fname" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $dataUser[0]->nama?>">
                            </div>
                        </div>
                        <?php if($role == ROLE_MAHASISWA){?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">NIM
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="nim" type="text" name="nim" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $dataUser[0]->nim?>">
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($role == ROLE_DOSEN || $role == ROLE_KAPRODI){?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Gelar Depan
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="gelar_depan" type="text" name="gelar_depan" required="required" placeholder="Drs." class="form-control col-md-7 col-xs-12" value="<?php echo $dataUser[0]->gelar_depan?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Gelar Belakang
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="gelar_belakang" type="text" name="gelar_belakang" required="required" placeholder="S.Kom, M.Kom" class="form-control col-md-7 col-xs-12" value="<?php echo $dataUser[0]->gelar_belakang?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">NID
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="nid" type="text" name="nid" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $dataUser[0]->nid?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kuota Maksimal Mahasiswa
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="kuota_mahasiswa" type="number" name="kuota_mahasiswa" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $dataUser[0]->kuota_mahasiswa?>">
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Username
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="username" type="text" name="username" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $dataUser[0]->username?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <center>
                                    <a id="changePassLabel" onClick="unHide()"><u>Change Password</u></a>
                                </center>
                                <center>
                                    <a id="cancelPass" onClick="unHide()"><u>Cancel</u></a>
                                </center>
                            </div>
                        </div>
                        <div id="passForm">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">New Password</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">

                                    <input id="password" type="password" name="password" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="cpassword" type="password" name="cpassword" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <?php if($role == ROLE_MAHASISWA) {?>
                                    <a href="<?php echo base_url() . 'akademik/akun_mahasiswa/'?>" class="btn btn-danger">Cancel</a>
                                <?php } ?>
                                <?php if($role == ROLE_DOSEN) {?>
                                    <a href="<?php echo base_url() . 'akademik/akun_dosen/'?>" class="btn btn-danger">Cancel</a>
                                <?php } ?>
                                <?php if($role == ROLE_KAPRODI) {?>
                                    <a href="<?php echo base_url() . 'akademik/akun_kaprodi/'?>" class="btn btn-danger">Cancel</a>
                                <?php } ?>
                                <?php if($role == ROLE_AKADEMIK) {?>
                                    <a href="<?php echo base_url() . 'akademik/akun_akademik/'?>" class="btn btn-danger">Cancel</a>
                                <?php } ?>
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var x = document.getElementById("passForm");
    var y = document.getElementById("cancelPass");
    var z = document.getElementById("changePassLabel");
    
    y.style.cursor = "pointer";
    z.style.cursor = "pointer";
    x.style.display = "none";
    y.style.display = "none";

    function unHide() {
        if (x.style.display === "none") {
            x.style.display = "block";
            y.style.display = "block";
            z.style.display = "none";
        } else {
            x.style.display = "none";
            y.style.display = "none";
            z.style.display = "block";
        }
    }
</script>
<script src="<?php echo base_url() . 'elusistatic/js/addEditUser.js'?>"></script>