<?php
$id_dosen = '';
$nid = '';
$nama = '';
$foto = '';
$email = '';
$mobile = '';
$skill = '';

if(!empty($profilInfo))
{
    foreach ($profilInfo as $uf)
    {
        $id_dosen = $uf->id_dosen;
        $nid = $uf->nid;
        $nama = $uf->nama;
        $foto = $uf->foto;
        $email = $uf->email;
        $mobile = $uf->mobile;
        $skill = $uf->skill;
    }
}
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Profil <small>Dosen</small></h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="profile_left">
                        <div class="profile_img">
                            <div id="crop-photo">
                                <!-- Current avatar -->
                                <center><img class="img-responsive avatar-view img-circle" style="height: 150px; width: 150px" src="<?php echo base_url()?>/uploads/foto/dosen/<?php echo $foto?>" onerror="this.src='<?php echo base_url(); ?>elusistatic/build/images/default.jpg'" alt="Avatar" title="Change the avatar"></center>
                                <form action="<?php echo base_url();?>dosen/profil/editPhoto" enctype="multipart/form-data" method="post">
                                    <!-- Current avatar -->
                                    <center>
                                        <div class="input-group input-sm">
                                            <div class="file-upload">
                                                <div class="file-select">
                                                    <center>
                                                        <i class="fa fa-upload"> &nbsp;Pilih Foto</i>
                                                        <input class="input-sm" type="file" name="foto" id="chooseFile" style="border: black 2px">
                                                        <input type="hidden" class="form-control required" id="id_dosen" name="id_dosen" value="<?php echo $id_dosen; ?>" >
                                                    </center>
                                                </div>
                                            </div>
                                            <span class="input-group-btn">
                                            <input type="submit" class="btn btn-primary btn-sm" value="Save">
                                        </span>
                                        </div>
                                    </center>
                                </form>
                            </div>
                        </div>
                        <h3><?php echo $nama?></h3>

                        <ul class="list-unstyled user_data">
                            <li class="m-top-xs">
                                <strong>NIP/NIKA : </strong>
                                <?php echo $nid?>
                            </li>
                            <li>
                                <i class="fa fa-briefcase user-profile-icon"></i> Dosen
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--                        alert-->
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                        ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php } ?>
                    <?php
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                        ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php } ?>

                    <div class="row">
                        <div class="col-md-12">
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button></div>'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--tab panel-->
        <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="profil" aria-labelledby="home-tab">
                            <!-- start detail profile-->
                            <div class="x_title">
                                <a href="#tab_content2" class="btn btn-primary pull-right" role="tab" id="profile-edit" data-toggle="tab" aria-expanded="false">Update Profile</a>
                                <h3>Detail Profil</h3>
                            </div>
                            <div class="x_content">
                                <div class="profile_left">
                                    <div class="col-md-6">
                                        <label><h4><strong>No. HP</strong></h4></label>
                                        <h4><?php echo $mobile?></h4>
                                        <hr>
                                    </div>
                                    <div class="col-md-6">
                                        <label><h4><strong>Email</strong></h4></label>
                                        <h4><?php echo $email?></h4>
                                        <hr>
                                    </div>
                                    <hr>
                                    <label><h4><i class="fa fa-user"></i> <strong>NAMA LENGKAP</strong></h4></label>
                                    <h4><?php echo $nama?></h4>
                                    <hr>
                                    <label><h4><strong>NIP / NIDN</strong></h4></label>
                                    <h4><?php echo $nid?></h4>
                                    <hr>
                                    <label><h4><strong>KEAHLIAN</strong></h4></label>
                                    <h4><?php echo $skill?></h4>
                                    <br>
                                </div>
                            </div>
                            <!-- end detail profile -->
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            <!-- start update profile -->
                            <div class="x_title">
                                <h2>Detail Profil<small></small></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <!-- start update profile -->
                                <form role="form" action="<?php echo base_url() ?>dosen/profil/editProfil" method="post"  id="editProfilFormDosen" enctype="multipart/form-data">
                                    <input type="hidden" class="form-control required" id="id_dosen" name="id_dosen" value="<?php echo $id_dosen ?>" >
                                    <input type="hidden" class="form-control required" id="id_user" name="id_user" value="<?php echo $userId ?>" >
                                    <div class="col-md-6">
                                        <label for="mobile">No. Hp <span>*</span></label>
                                        <input type="number" id="mobile" class="form-control" name="mobile" value="<?php echo $mobile?>"/><br>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">Email <span>*</span></label>
                                        <input type="email" id="email" class="form-control" name="email" value="<?php echo $email?>"/><br>
                                    </div>
                                    <div class="clearfix"></div>
                                    <label for="nama">Nama Lengkap <span>*</span></label>
                                    <input type="text" id="nama" class="form-control" name="nama" value="<?php echo $nama?>"/><br>
                                    <label for="nid">NIP/NIKA <span>*</span></label>
                                    <input type="number" id="nid" class="form-control" name="nid" value="<?php echo $nid?>"/><br>
                                    <label for="skill">Keahlian <small>(pisahkan dengan 'koma')</small></label>
                                    <textarea class="form-control" id="skill" name="skill" id=""rows="3"><?php echo $skill?></textarea>
                                    <br/>
                                    <a href="#profil" class="btn btn-danger" role="tab" id="home-tab" data-toggle="tab" aria-expanded="true">Cancel</a>
                                    <input type="submit" class="btn btn-primary" value="Save">
                                </form>
                            </div>
                            <!-- end update profile -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--tab panel-->
    </div>
</div>
<script src="<?php echo base_url()?>elusistatic/js/editProfil.js"></script>