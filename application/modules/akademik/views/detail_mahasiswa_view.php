<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4>
                    <a href="<?php echo base_url() ;?>akademik/daftar_mahasiswa">
                        <i class="fa fa-chevron-left"></i>
                    </a> &nbsp;Daftar Mahasiswa
                </h4>
            </div>
            <br>
            <br>
            <div class="clearfix"></div>

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
            <div role="main">
                <div class="x_content">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Profil Mahasiswa</h3>
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
                                                <img class="img-responsive avatar-view img-circle" style="height: 200px; width: 200px" onerror="this.src='<?php echo base_url(); ?>elusistatic/build/images/default.jpg'"
                                                    src="<?php echo base_url() . 'uploads/foto/mahasiswa/' . $dataMahasiswa[0]->foto ?>"
                                                    alt="Avatar" title="Change the avatar">
                                            </div>
                                        </div>
                                        <h3>
                                            <?php echo $dataMahasiswa[0]->nama; ?>
                                        </h3>

                                        <ul class="list-unstyled user_data">
                                            <li class="m-top-xs">
                                                <strong>NIM : </strong>
                                                <?php echo $dataMahasiswa[0]->nim; ?>
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
                            <div class="col-md-12">
                                <div class="x_panel">

                                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                            <li role="presentation" class="active">
                                                <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="false">Identitas Diri</a>
                                            </li>
                                            <li role="presentation" class="">
                                                <a href="#tab_content2" role="tab" id="profile-tab1" data-toggle="tab" aria-expanded="false">Tugas Akhir </a>
                                            </li>
                                            <li role="presentation" class="">
                                                <a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Berkas Sidang</a>
                                            </li>
                                            <li role="presentation" class="">
                                                <a href="#tab_content4" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">Penilaian</a>
                                            </li>
                                            <li role="presentation" class="">
                                                <a href="#tab_content5" role="tab" id="profile-tab4" data-toggle="tab" aria-expanded="false">Berkas Yudisium</a>
                                            </li>
                                        </ul>
                                        <div id="myTabContent" class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                                <!-- start detail profile-->
                                                <div class="x_title">
                                                    <h3>Detail Profil</h3>
                                                </div>
                                                <div class="x_content">
                                                    <div class="col-md-2">
                                                        <label>IPK</label>
                                                        <h5>
                                                            <?php echo $dataMahasiswa[0]->ipk; ?>
                                                        </h5>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>SKS</label>
                                                        <h5>
                                                            <?php echo $dataMahasiswa[0]->jumlah_SKS; ?>
                                                        </h5>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Email</label>
                                                        <h5>
                                                            <?php echo $dataMahasiswa[0]->email; ?>
                                                        </h5>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>HP</label>
                                                        <h5>
                                                            <?php echo $dataMahasiswa[0]->mobile; ?>
                                                        </h5>
                                                    </div>
                                                    <div class="profile_left">
                                                        <label>
                                                            <h5>
                                                                <i class="fa fa-user"></i>
                                                                <strong>Nama Lengkap</strong>
                                                            </h5>
                                                        </label>
                                                        <h5>
                                                            <?php echo $dataMahasiswa[0]->nama; ?>
                                                        </h5>
                                                        <hr>
                                                        <label>
                                                            <h5>
                                                                <strong>NIM</strong>
                                                            </h5>
                                                        </label>
                                                        <h5>
                                                            <?php echo $dataMahasiswa[0]->nim; ?>
                                                        </h5>
                                                        <hr>
                                                        <label>
                                                            <h5>
                                                                <strong>KEAHLIAN</strong>
                                                            </h5>
                                                        </label>
                                                        <h5>
                                                            <?php echo $dataMahasiswa[0]->skill; ?>
                                                        </h5>
                                                        <hr>
                                                        <label>
                                                            <h5>
                                                                <strong>PENGALAMAN</strong>
                                                            </h5>
                                                        </label>
                                                        <h5>
                                                            <span>
                                                                <?php echo $dataMahasiswa[0]->pengalaman; ?>
                                                            </span>
                                                        </h5>
                                                        <br>
                                                    </div>
                                                </div>
                                                <!-- end detail profile -->
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab1">
                                                <div class="x_title">
                                                    <h3>Tugas Akhir</h3>
                                                </div>
                                                <?php if($dataJudulTA != FALSE) {?>
                                                <div class="x_content">
                                                    <div class="profile_left">
                                                        <label>
                                                            <h5>
                                                                <i class="fa fa-user"></i>
                                                                <strong>Dosen Pembimbing</strong>
                                                            </h5>
                                                        </label>
                                                        <h5>
                                                            <?php echo ($dataDosbing != NULL ? $dataDosbing[0]->nama : '<i>Belum ada dosen pembimbing</i>')?>
                                                        </h5>
                                                        <hr>
                                                        <label>
                                                            <h5>
                                                                <strong>Judul Proyek</strong>
                                                            </h5>
                                                        </label>
                                                        <h5>
                                                            <?php echo $dataJudulTA[0]->judul_ta ?>
                                                        </h5>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <?php } else {?>
                                                <center>
                                                    <i>(Belum mengambil tugas akhir)</i>
                                                </center>
                                                <?php } ?>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab2">
                                                <div class="col-md-12 col-xs-12 col-sm-12">
                                                    <!--table nilai-->
                                                    <?php if($dataBerkasSidang != FALSE) { ?>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr bgcolor="#67CEA6" style="color: white">
                                                                <th colspan="4">
                                                                    <h4>
                                                                        <strong>Berkas Sidang</strong>
                                                                    </h4>
                                                                </th>
                                                            </tr>
                                                            <tr bgcolor="#59BD96" style="color: white">
                                                                <th>No</th>
                                                                <th>Berkas</th>
                                                                <th>Status</th>
                                                                <th>Lihat</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                                $i=1;
                                                                foreach($dataBerkasSidang as $data) { 
                                                            ?>

                                                            <tr>
                                                                <td>
                                                                    <?php echo $i ?>
                                                                </td>
                                                                <th>
                                                                    <?php echo $data->nama_berkas ?>
                                                                </th>
                                                                <td>
                                                                <?php if($data->isValid == 0) {
                                                                            echo '<span class="label label-default">belum diupload</span>'; 
                                                                        } elseif($data->isValid == 1) {
                                                                            echo '<span class="label label-warning">proses</span>';
                                                                        } elseif($data->isValid == 2) {
                                                                            echo '<span class="label label-success">disetujui</span>';
                                                                        } elseif($data->isValid == 3) {
                                                                            echo '<span class="label label-danger">ditolak</span>k';
                                                                        } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if($data->isValid != 0 ) { ?>
                                                                    <a href="<?php echo base_url()?>uploads/sidang/<?php echo $data->id_berkas_sidang . '/' . $data->path ?>" class="btn btn-sm btn-info"
                                                                        target="_blank">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <?php $i++; } ?>

                                                        </tbody>
                                                    </table>
                                                    <?php } else { ?>
                                                    <div class="x_title">
                                                        <h3>Berkas Sidang</h3>
                                                    </div>
                                                    <center>
                                                        <i>(Belum mendaftar sidang)</i>
                                                    </center>
                                                    <?php } ?>
                                                    <!--end table nilai-->
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab3">
                                                <?php if($dataPenilaian != FALSE) {?>
                                                <div class="col-md-6 col-xs-12 col-sm-12">
                                                    <!--table nilai-->
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr bgcolor="#67CEA6" style="color: white">
                                                                <th colspan="4">
                                                                    <h4>
                                                                        <strong>Data Penilaian</strong>
                                                                    </h4>
                                                                </th>
                                                            </tr>
                                                            <tr bgcolor="#59BD96" style="color: white">
                                                                <th>No</th>
                                                                <th>Subject</th>
                                                                <th>Nilai</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                        $i=1;
                                                        foreach ($dataPenilaian as $data) { ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $i; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $data['nama_komponen']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo round($data['nilai'], 2); ?>
                                                                </td>

                                                            </tr>
                                                            <?php $i++; } ?>
                                                        </tbody>
                                                    </table>
                                                    <!--end table nilai-->
                                                </div>
                                                <center>
                                                    <div class="col-md-6">
                                                        <h5>Nilai Akhir</h5>
                                                        <h1>
                                                            <strong>
                                                                <?php echo $dataNilaiSidang ?>
                                                            </strong>
                                                        </h1>
                                                    </div>
                                                </center>
                                                <?php } else { ?>
                                                <div class="col-md-12 col-xs-12 col-sm-12">
                                                    <div class="x_title">
                                                        <h3>Penilaian</h3>
                                                    </div>
                                                    <center>
                                                        <i>(Belum ada data penilaian)</i>
                                                    </center>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab4">
                                                <?php if($dataBerkasYudisium != FALSE) {?>
                                                <div class="col-md-12 col-xs-12 col-sm-12">
                                                    <!--table berkas yudisium-->
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr bgcolor="#67CEA6" style="color: white">
                                                                <th colspan="4">
                                                                    <h4>
                                                                        <strong>Berkas Yudisium</strong>
                                                                    </h4>
                                                                </th>
                                                            </tr>
                                                            <tr bgcolor="#59BD96" style="color: white">
                                                                <th>No</th>
                                                                <th>Subject</th>
                                                                <th>Nilai</th>
                                                                <th>Lihat</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i=1; foreach ($dataBerkasYudisium as $data) { ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $i; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $data->nama_berkas; ?>
                                                                </td>
                                                                <td>
                                                                    <?php if($data->isValid == 0) {
                                                                            echo '<span class="label label-default">belum diupload</span>'; 
                                                                        } elseif($data->isValid == 1) {
                                                                            echo '<span class="label label-warning">proses</span>';
                                                                        } elseif($data->isValid == 2) {
                                                                            echo '<span class="label label-success">disetujui</span>';
                                                                        } elseif($data->isValid == 3) {
                                                                            echo '<span class="label label-danger">ditolak</span>k';
                                                                        } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if($data->isValid != 0 ) { ?>
                                                                    <a href="<?php echo base_url()?>uploads/yudisium/<?php echo $data->id_berkas_yudisium . '/' . $data->path ?>" class="btn btn-sm btn-info"
                                                                        target="_blank">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                    <?php $i++;} ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                    <!--end table berkas yudisium-->
                                                    <?php    } else { ?>
                                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                                        <div class="x_title">
                                                            <h3>Berkas Yudisium</h3>
                                                        </div>
                                                        <center>
                                                            <i>(Belum mendaftar yudisium)</i>
                                                        </center>
                                                    </div>
                                                    <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--tab panel-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /page content -->