<?php

/**
 * Created by nad.
 * Date: 23/03/2018
 * Time: 07:32
 * Description:
 */
//var_dump($mhsInfo);
?>
<?php
$nim = '';
$nama = '';
$ipk = '';
$foto = '';
$jumlah_sks = '';
$email = '';
$mobile = '';
$skill = '';
$pengalaman = '';

if (!empty($mhsInfo)) {
    foreach ($mhsInfo as $uf) {
        $nim = $uf->nim;
        $nama = $uf->nama;
        $ipk = $uf->ipk;
        $foto = $uf->foto;
        $jumlah_sks = $uf->jumlah_SKS;
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
            <h3><a href="<?php echo base_url() ?>dosen/bimbingan"><i class="fa fa-chevron-left"></i></a> Profil <small>Mahasiswa</small></h3>
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
                                <center><img class="img-responsive avatar-view img-circle" style="height: 150px; width: 150px" src="<?php echo base_url() ?>/uploads/foto/akademik/<?php echo $foto ?>" onerror="this.src='<?php echo base_url(); ?>elusistatic/build/images/default.jpg'" alt="Avatar"></center>
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
                    </div>
                </div>
            </div>
        </div>
        <!--tab panel-->
        <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                            <!-- start detail profile-->
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
                                <div class="profile_left">
                                    <label>
                                        <h5><i class="fa fa-user"></i> <strong>Nama Lengkap</strong></h5>
                                    </label>
                                    <h5><?php echo $nama ?></h5>
                                    <hr>
                                    <label>
                                        <h5><strong>NIM</strong></h5>
                                    </label>
                                    <h5><?php echo $nim ?></h5>
                                    <hr>
                                    <label>
                                        <h5><strong>KEAHLIAN</strong></h5>
                                    </label>
                                    <h5><?php echo $skill ?></h5>
                                    <hr>
                                    <label>
                                        <h5><strong>PENGALAMAN</strong></h5>
                                    </label>
                                    <h5><?php echo $pengalaman ?></h5>
                                    <br>
                                </div>
                            </div>
                            <!-- end detail profile -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--tab panel-->
    </div>
</div>