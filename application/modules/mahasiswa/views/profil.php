<?php
$id_mahasiswa = '';
$nim = '';
$nama = '';
$foto = '';
$jumlah_sks = '';
$ipk = '';
$email = '';
$mobile = '';
$skill = '';
$pengalaman = '';


if(!empty($profilInfo))
{
    foreach ($profilInfo as $uf)
    {
        $id_mahasiswa = $uf->id_mahasiswa;
        $nim = $uf->nim;
        $nama = $uf->nama;
        $foto = $uf->foto;
        $jumlah_sks = $uf->jumlah_sks;
        $ipk = $uf->ipk;
        $email = $uf->email;
        $mobile = $uf->mobile;
        $skill = $uf->skill;
        $pengalaman = $uf->pengalaman;
    }
}
?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Profil <small>Mahasiswa</small></h3>
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
                                <center>
                                    <img name="foto" class="img-responsive avatar-view img-circle" style="height: 150px; width: 150px" src="<?php echo base_url()?>/uploads/foto/mahasiswa/<?php echo $foto?>" onerror="this.src='<?php echo base_url(); ?>elusistatic/build/images/default.jpg'" alt="Avatar" title="Pas Photo Latar Belakang Biru">
                                </center>
                                <form action="<?php echo base_url();?>mahasiswa/profil/editPhoto" enctype="multipart/form-data" method="post">
                                    <!-- Current avatar -->
                                    <center>
                                        <div class="input-group input-sm">
                                            <div class="file-upload">
                                                <div class="file-select">
                                                    <center>
                                                        <i class="fa fa-upload"> &nbsp;Pilih Foto</i>
                                                        <input class="input-sm" type="file" name="foto" id="chooseFile" required style="border: black 2px">
                                                        <input type="hidden" class="form-control required" id="id_mahasiswa_foto" name="id_mahasiswa" value="<?php echo $id_mahasiswa; ?>" >
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
                        <h3><?php echo $nama ?></h3>

                        <ul class="list-unstyled user_data">
                            <li class="m-top-xs">
                                <strong>NIM : </strong>
                                <?php echo $nim ?>
                            </li>
                            <li>
                                <i class="fa fa-briefcase user-profile-icon"></i> Mahasiswa
                            </li>
                        </ul>
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
                            <a href="#edit" class="btn btn-primary pull-right" role="tab" id="profile-edit" data-toggle="tab" aria-expanded="false">Update Profile</a>
                            <div class="x_title">
                                <h3>Detail Profil</h3>
                            </div>
                            <div class="x_content">
                                <div class="col-md-2">
                                    <label>IPK</label>
                                    <h5><?php echo $ipk ?></h5>
                                </div>
                                <div class="col-md-2">
                                    <label>SKS</label>
                                    <h5><?php echo $jumlah_sks ?></h5>
                                </div>
                                <div class="col-md-4">
                                    <label>Email</label>
                                    <h5><?php echo $email ?></h5>
                                </div>
                                <div class="col-md-4">
                                    <label>HP</label>
                                    <h5><?php echo $mobile ?></h5>
                                </div>
                                <div class="row">&nbsp;</div>
                                <div class="profile_left">
                                    <label><h5><i class="fa fa-user"></i> <strong>NAMA LENGKAP</strong></h5></label>
                                    <h5><?php echo $nama ?></h5>
                                    <hr>
                                    <label><h5><strong>NIM</strong></h5></label>
                                    <h5><?php echo $nim ?></h5>
                                    <hr>
                                    <label><h5><strong>KEAHLIAN</strong></h5></label>
                                    <h5><?php echo $skill ?></h5>
                                    <hr>
                                    <label><h5><strong>PENGALAMAN</strong></h5></label>
                                    <h5>
                                        <span><?php echo $pengalaman ?></span>
                                    </h5>
                                    <br>
                                </div>
                            </div>
                            <!-- end detail profile -->
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="edit" aria-labelledby="profile-tab">
                            <!-- start update profile -->
                            <div class="x_title">
                                <h2>Detail Profil<small></small></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <!-- form start update profile -->
                                <form role="form" action="<?php echo base_url() ?>mahasiswa/profil/editProfil" method="post" id="editProfilForm" enctype="multipart/form-data">
                                    <input type="hidden" class="form-control required" id="id_mahasiswa" name="id_mahasiswa" value="<?php echo $id_mahasiswa ?>" >
                                    <input type="hidden" class="form-control required" id="id_user" name="id_user" value="<?php echo $userId ?>" >
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="email">Email <span>*</span></label>
                                            <input type="email" id="email" name="email" class="form-control" value="<?php echo $email ?>">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="ipk">IPK <span>*</span></label>
                                            <input type="number" min="0.00" max="4" step="0.01" id="ipk" class="form-control" name="ipk" placeholder="0.00" value="<?php echo $ipk ?>">
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-6">
                                            <label for="hp">No. HP  <span>*</span></label>
                                            <input type="number" id="mobile" class="form-control" name="mobile" placeholder="contoh : 0857xxx" value="<?php echo $mobile ?>">
                                        </div>
                                        <div class="col-md-2" style="margin-bottom: 3%">
                                            <label for="sks">SKS <span>*</span></label>
                                            <input type="number" id="jumlah_SKS" class="form-control" maxlength="3" name="jumlah_SKS" value="<?php echo $jumlah_sks ?>">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <label for="nim">NIM <span>*</span></label>
                                    <input type="text" id="nim" class="form-control col-md-6" name="nim" value="<?php echo $nim ?>">
                                    <div class="clearfix"></div>
                                    <br>
                                    <label for="fullname">Nama Lengkap <span>*</span></label>
                                    <input type="text" id="nama" class="form-control" name="nama" value="<?php echo $nama ?>"><br>
                                    <label for="skill">Keahlian <small>(pisahkan dengan 'koma')</small></label>
                                    <input class="form-control" id="skill" name="skill" value="<?php echo $skill ?>">
                                    <br/>
                                    <label for="experience">Pengalaman <small>(deskripsikan)</small></label>
                                    <textarea class="form-control" id="pengalaman" name="pengalaman" rows="3"><?php echo $pengalaman ?></textarea>
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
