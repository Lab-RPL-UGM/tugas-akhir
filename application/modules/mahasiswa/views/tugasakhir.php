<?php

/**
 * Created by nad.
 * Date: 22/03/2018
 * Time: 12:48
 * Description:
 */
//var_dump($periodeInfo)
?>
<?php
$pilihan = array();
//diset null karna untuk pilihan ke tiga
$proyek = array();
$id_pengajuan_ta = array();
$id_usulan = '';
$judul = '';
$deskripsi = '';
$bisnis_rule = '';
$arr_jenis = array();
//cek jenis khusus inputan ke-3
$jenis = '';
// get periode
$periode = '';
$awal = '';
$akhir = '';
$id_periode = '';

// active pane saat edit form
$active_proyek = 0;
$active_usulan = 0;

//get date_now
$date_now = date("Y-m-d");

if (!empty($periodeInfo)) {
    foreach ($periodeInfo as $uf) {
        $awal = $uf->tgl_awal_regis_ta;
        $akhir = $uf->tgl_akhir_regis_ta;
        $periode = $uf->status_periode;
        $id_periode = $uf->id_periode;
    }
}

if (!empty($taInfo)) {
    $i = 0;
    $p = 0;
    foreach ($taInfo as $record) {
        if ($record->jenis == "proyek") {
            $pilihan[$p] = $record->pilihan;
            $id_pengajuan_ta[$p] = $record->id_pengajuan_ta;
            $arr_jenis[$i] = $record->jenis;
            // apabila jenis pilihannya = proyek
            $proyek[$p] = $record->id_proyek;
            $p++;
        } else {
            // apabila jenis pilihannya = usulan
            // langsung dikasih indeks yang ke-3 (array mulai dari 0) karna tempatnya adalah dipaling bawah/pilihan ke-3
            $pilihan[$p] = $record->pilihan;
            $id_usulan = $record->id_usulan;
            $id_pengajuan_ta[$p] = $record->id_pengajuan_ta;
            $arr_jenis[$i] = $record->jenis;

            $judul = $record->judul;
            $deskripsi = $record->deskripsi;
            $bisnis_rule = $record->bisnis_rule;
        }
        $i++;
    }
    foreach ($arr_jenis as $value) {
        if ($value == "usul") {
            $active_proyek = 0;
            $active_usulan = 1;
            $jenis = 'usul';
            break;
        } else {
            $active_proyek = 1;
            $jenis = 'proyek';
        }
    }
}
// var_dump($arr_jenis);
// echo "pilihan \n";
// var_dump($pilihan);
// echo "proyek \n";
// var_dump($proyek);
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Tugas Akhir</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <!-- validasi berdasarkan periode-->
    <div class="row">
        <div class="col-md-12">
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

            <div class="row">
                <div class="col-md-12">
                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php if ($periode == 1 && $date_now >= $awal && $date_now <= $akhir && isset($taTerplotting) && empty($taTerplotting)) { ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x-panel">
                    <?php if (!empty($taInfo)) { ?>
                        <div class="x_panel">
                            <div class="x_title">
                                <h3><strong>STATUS : <?= strtoupper($record->status_pengambilan) ?></strong></h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="tab-content">
                                <!-- <button class="btn btn-warning pull-right"><i class="fa fa-edit"></i> Ganti Judul</button>-->
                                <!-- form info-->
                                <div class="tab-pane active fade in" id="content">
                                    <a class="btn btn-primary pull-right" data-toggle="tab" href="#edit"><i class="fa fa-edit"></i> Edit</a>
                                    <div class="x_content">
                                        <div class="form-group">
                                            <?php
                                            foreach ($taInfo as $record) {
                                                if ($record->jenis == "proyek") {
                                            ?>
                                                    <!--proyek-->
                                                    <div class="row">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pilihan</label>
                                                        <div class="well col-md-8">
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul Proyek</label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                <span>
                                                                    <?php echo $record->nama ?>
                                                                </span>
                                                            </div>
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi Proyek</label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                <span>
                                                                    <?php echo $record->deskripsi_proyek ?>
                                                                </span>
                                                            </div>
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tools Proyek</label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                <span>
                                                                    <?php echo $record->tools ?>
                                                                </span>
                                                            </div>
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Dosen Pembimbing Proyek</label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                <span>
                                                                    <?php echo $dataDosbing[0]->nama ?>
                                                                </span>
                                                            </div>
                                                            <?php if (isset($dataDosbing[1]->id_dosen)) { ?>
                                                                <div class="clearfix" style="margin-bottom: 2%"></div>
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Dosen Pembimbing 2</label>
                                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                                    <span>
                                                                        <?php echo $dataDosbing[1]->nama ?>
                                                                    </span>
                                                                </div>
                                                            <?php } ?>
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                        </div>
                                                    </div>
                                                <?php } else { ?>
                                                    <!--usulan-->
                                                    <div class="row">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pilihan</label>
                                                        <div class="well col-md-8">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Usulan Judul</label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <span><?php echo $record->judul ?></span>
                                                            </div>
                                                            <!-- <div class="clearfix" style="margin-bottom: 2%"></div>
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi Sistem</label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                <span>
                                                                    <?php echo $record->deskripsi ?>
                                                                </span>
                                                            </div> -->
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Perusahaan Mitra</label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                <span>
                                                                    <?php echo $record->bisnis_rule ?>
                                                                </span>
                                                            </div>
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi Proyek</label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <a target="_blank" href="<?php echo base_url(); ?>uploads/persetujuan/<?php echo $record->file_persetujuan; ?>"><?php echo $record->file_persetujuan ?></a>
                                                            </div>
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Dosen Pembimbing 1</label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                <span>
                                                                    <?php echo $dataDosbing[0]->nama ?>
                                                                </span>
                                                            </div>
                                                            <?php if (isset($dataDosbing[1]->id_dosen)) { ?>
                                                                <div class="clearfix" style="margin-bottom: 2%"></div>
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Dosen Pembimbing 2</label>
                                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                                    <span>
                                                                        <?php echo $dataDosbing[1]->nama ?>
                                                                    </span>
                                                                </div>
                                                            <?php } ?>
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                        </div>
                                                    </div>
                                            <?php
                                                }
                                            }

                                            ?>
                                            <?php if ($record->status_pengambilan == "revisi") { ?>
                                                <div class="row">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi Revisi</label>
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $record->reason ?></label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- end tab pane-->
                                <div class="tab-pane fade in" id="edit">
                                    <a href="#content" data-toggle="tab" class="btn btn-round btn-primary"><i class="fa fa-chevron-left"></i> Back</a>



                                    <div class="x_content">
                                        <form role="form" id="daftar" action="<?php echo base_url() ?>mahasiswa/pengajuan/edit_ta" method="POST" data-parsley-validate class="form-horizontal form-label-left" role="form" enctype="multipart/form-data">
                                            <input type="hidden" name="id_periode" value="<?php echo $id_periode ?>">
                                            <center><span class="badge" style="margin-bottom:15px">DAFTAR TUGAS AKHIR</span></center>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                                <!-- Get Id Pengajuan TA -->
                                                <input type="hidden" name="pilihan3" value="<?php echo $id_pengajuan_ta[0] ?>">
                                                <input type="hidden" name="jenis_pilihan3" value="<?php echo $jenis ?>">
                                                <input type="hidden" name="id_usulan" value="<?php echo $id_usulan ?>">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="btn-group" data-toggle="buttons" id="pilihan3">
                                                        <a class="<?php if ($active_usulan != 0) {
                                                                        echo 'active ';
                                                                    } ?>btn btn-default" href="#tab_content3" role="tab" data-toggle="tab" aria-expanded="true"><input type="radio" name="jenis" value="usul" <?php if ($active_usulan != 0) {
                                                                                                                                                                                                                    echo 'checked ';
                                                                                                                                                                                                                } ?>>Usulan</a>
                                                        <a class="<?php if ($active_proyek != 0) {
                                                                        echo 'active ';
                                                                    } ?>btn btn-default" href="#tab_content4" role="tab" data-toggle="tab" aria-expanded="true"><input type="radio" name="jenis" value="proyek" <?php if ($active_proyek != 0) {
                                                                                                                                                                                                                    echo 'checked ';
                                                                                                                                                                                                                } ?>>Project</a>
                                                    </div>
                                                </div>
                                                <div class="clearfix" style="margin-bottom: 2%"></div>
                                                <!--pane 2-->
                                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                                    <div id="myTabContent" class="tab-content">
                                                        <!--pane ide-->
                                                        <div role="tabpanel" class="<?php if ($active_usulan != 0) {
                                                                                        echo 'active ';
                                                                                    } ?>tab-pane fade in" id="tab_content3" aria-labelledby="home-tab">
                                                            <!--pilihan usulan-->
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Usulan Judul <span class="required">*</span>
                                                                    </label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" name="judul" class="form-control col-md-7 col-xs-12" placeholder="Tuliskan judul anda" value="<?php echo $judul ?>">
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi Sistem <span class="required">*</span>
                                                                    </label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <textarea type="text" name="deskripsi" id="deskripsi" class="form-control col-md-7 col-xs-12" placeholder="Deskripsikan dengan singkat dan jelas"><?php echo $deskripsi ?></textarea>
                                                                    </div>
                                                                </div> -->
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Perusahaan Mitra
                                                                    </label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <textarea type="text" name="bisnis_rule" id="bisnis" class="form-control col-md-7 col-xs-12" placeholder="Nama Perusahaan Mitra"><?php echo $bisnis_rule ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi Proyek <span class="required">*</span></label>
                                                                    <!-- <small>Bagi yang mengajukan project dari institusi</small> -->
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="file" name="file_persetujuan" class="form-control col-md-7 col-xs-12">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tentukan dosen pembimbing 1 <span class="required">*</span></label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <select name="dosen" id="dosen" class="form-control">
                                                                            <option value="">Pilih Dosen pembimbing 1..</option>
                                                                            <?php foreach ($dataDosen as $data) { ?>
                                                                                <option <?= ($active_usulan != 0 && isset($dataDosbing[0]->id_dosen) && $dataDosbing[0]->id_dosen == $data->id_dosen) ? "selected" : "" ?> value="<?php echo $data->id_dosen ?>">
                                                                                    <?php echo $data->nama; ?>
                                                                                </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tentukan dosen pembimbing 2</label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <select name="dosen2" id="dosen2" class="form-control">
                                                                            <option value="">Pilih Dosen pembimbing 2..</option>
                                                                            <?php foreach ($dataDosen as $data) { ?>
                                                                                <option <?= ($active_usulan != 0 && isset($dataDosbing[1]->id_dosen) && $dataDosbing[1]->id_dosen == $data->id_dosen) ? "selected" : "" ?> value="<?php echo $data->id_dosen ?>">
                                                                                    <?php echo $data->nama; ?>
                                                                                </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                        <small>Dosen 2 harus berbeda dengan Dosen 1</small>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-9">
                                                                    <input type="submit" class="btn btn-success pull-right" value="Submit">
                                                                </div>
                                                            </div>
                                                            <!--end usulan-->
                                                        </div>
                                                        <!--end ide-->

                                                        <!--start project-->
                                                        <div role="tabpanel" class="<?php if ($active_proyek != 0) {
                                                                                        echo 'active ';
                                                                                    } ?>tab-pane fade in" id="tab_content4" aria-labelledby="home-tab">
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul Proyek</label>
                                                                    <!-- Get Id Pengajuan TA Proyek -->
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <select name="proyektiga" class="form-control proyek">
                                                                            <option value="">Pilih ..</option>
                                                                            <?php
                                                                            if (!empty($proyekInfo)) {
                                                                                foreach ($proyekInfo as $record) {
                                                                            ?>
                                                                                    <option data-deskripsi="<?= $record->deskripsi ?>" data-tools="<?= $record->tools ?>" value="<?php echo $record->id_proyek ?>" <?php if (!empty($proyek[0])) {
                                                                                                                                                                                                                        if ($proyek[0] == $record->id_proyek) {
                                                                                                                                                                                                                            echo "selected";
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                    } ?>><?php echo $record->nama_proyek ?> (<?php echo $record->nama ?>)</option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi <span class="required">*</span></label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <textarea cols="4" readonly class="form-control deskripsi_proyek"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tools <span class="required">*</span></label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input readonly class="form-control tools_proyek">
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tentukan dosen pembimbing 2</label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <select name="dosenProyek" id="dosen" class="form-control">
                                                                            <option value="">Pilih Dosen pembimbing 2..</option>
                                                                            <?php foreach ($dataDosen as $data) { ?>
                                                                                <option <?= ($active_proyek != 0 && isset($dataDosbing[1]->id_dosen) && $dataDosbing[1]->id_dosen == $data->id_dosen) ? "selected" : "" ?> value="<?php echo $data->id_dosen ?>">
                                                                                    <?php echo $data->nama; ?>
                                                                                </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div> -->
                                                                <div class="form-group col-md-9">
                                                                    <input type="submit" class="btn btn-success pull-right" style="margin-top: 3%" value="Submit">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end project-->
                                                    </div>
                                                </div>
                                                <!--end pane 2-->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!--end tab pane-->
                                <!--form edit-->

                                <!-- end tab pane-->
                            </div>
                        </div>
                    <?php } elseif ($taTerplotting) { ?>
                        <!-- start bila sudah terplotting di TA-->
                        <div class="x_panel">
                            <div class="alert alert-warning">
                                <h4><i class="fa fa-warning"></i> PERHATIAN!</h4>
                                Anda telah terplotting pada tugas akhir yang tertera di bawah ini.

                                Jika anda ingin mengubah tugas akhir, anda bisa menekan tombol "Ganti tugas akhir" dengan konsekuensi tugas akhir yang sudah anda ganti akan menjadi nonaktif dan
                                digantikan dengan tugas akhir baru yang telah anda pilih.
                            </div>
                            <h3><strong>STATUS : <span class="label label-success">AKTIF</span></strong></h3>
                            <div class="clearfix"></div>
                            <center>
                                <h4><span class="label label-default">Judul Tugas Akhir</span></h4><br>
                                <h3><?php echo $taTerplotting['judul_ta']; ?></h3><br>
                                <h4><span class="label label-default">Dosen Pembimbing</h4><br>
                                <h3><?php echo $taTerplotting['dosbing']; ?></h3><br>
                            </center>

                            <a data-toggle="modal" data-target="#ubahTA" type="button" class="btn btn-default pull-right"><i class="fa fa-edit"></i> Ganti Tugas Akhir</a>

                        </div>
                        <!-- end bila sudah terplotting di TA-->
                    <?php } else { ?>
                        <div class="x_panel">
                            <div class="x_title">
                                <h5 class="badge bg-red">Pastikan Anda telah melengkapi
                                    <a href="<?php base_url() ?>../profil" style="color: white"><u>PROFIL</u></a>
                                    dengan benar
                                </h5>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br>
                                <form role="form" id="daftar" action="<?php echo base_url() ?>mahasiswa/pengajuan/daftar_ta" method="POST" data-parsley-validate class="form-horizontal form-label-left" role="form" enctype="multipart/form-data">
                                    <input type="hidden" name="id_periode" value="<?php echo $id_periode ?>">
                                    <center><span class="badge" style="margin-bottom:15px">DAFTAR TUGAS AKHIR</span></center>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="btn-group" data-toggle="buttons" id="pilihan3">
                                                <a class="active btn btn-default" href="#tab_content3" role="tab" id="ide" data-toggle="tab" aria-expanded="true"><input type="radio" name="jenis_radio" value="usul" checked>Usul Ide</a>
                                                <a class="btn btn-default" href="#tab_content4" role="tab" id="proyek" data-toggle="tab" aria-expanded="true"><input type="radio" name="jenis_radio" value="proyek">Project</a>
                                            </div>
                                        </div>
                                        <div class="clearfix" style="margin-bottom: 2%"></div>
                                        <!--pane 2-->
                                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                            <div id="myTabContent" class="tab-content">
                                                <!--pane ide-->
                                                <div role="tabpanel" class="active tab-pane fade in" id="tab_content3" aria-labelledby="home-tab">
                                                    <!--status perpanjangan-->
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Usulan Judul <span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" name="judul" class="form-control col-md-7 col-xs-12" placeholder="Tuliskan judul anda">
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi Sistem <span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <textarea type="text" name="deskripsi" id="deskripsi" class="form-control col-md-7 col-xs-12" placeholder="Deskripsikan dengan singkat dan jelas"></textarea>
                                                            </div>
                                                        </div> -->
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Perusahaan Mitra
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <textarea type="text" name="bisnis_rule" id="bisnis" class="form-control col-md-7 col-xs-12" placeholder="Nama perusahaan mitra anda"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi Proyek <span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="file" name="file_persetujuan" class="form-control col-md-7 col-xs-12">
                                                                <!-- <small>Bagi yang mengajukan project dari institusi </small> -->
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tentukan dosen pembimbing 1 <span class="required">*</span></label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <select name="dosen" id="dosen" class="form-control">
                                                                    <option value="">Pilih Dosen pembimbing 1..</option>
                                                                    <?php foreach ($dataDosen as $data) { ?>
                                                                        <option <?= ($active_proyek != 0 && isset($dataDosbing[1]->id_dosen) && $dataDosbing[1]->id_dosen == $data->id_dosen) ? "selected" : "" ?> value="<?php echo $data->id_dosen ?>">
                                                                            <?php echo $data->nama; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tentukan dosen pembimbing 2</label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <select name="dosen2" id="dosen2" class="form-control">
                                                                    <option value="">Pilih Dosen pembimbing 2..</option>
                                                                    <?php foreach ($dataDosen as $data) { ?>
                                                                        <option <?= ($active_proyek != 0 && isset($dataDosbing[1]->id_dosen) && $dataDosbing[1]->id_dosen == $data->id_dosen) ? "selected" : "" ?> value="<?php echo $data->id_dosen ?>">
                                                                            <?php echo $data->nama; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <small>Dosen 2 harus berbeda dengan Dosen 1</small>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-9">
                                                            <input type="submit" class="btn btn-success pull-right" value="Submit">
                                                        </div>
                                                    </div>
                                                    <!--end perpanjangan-->
                                                </div>
                                                <!--end ide-->
                                                <!--start project-->
                                                <div role="tabpanel" class="tab-pane fade in" id="tab_content4" aria-labelledby="home-tab">
                                                    <!--status baru-->
                                                    <div class="row">
                                                        <div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Pilihan Proyek <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <select name="proyektiga" class="form-control proyek">
                                                                        <option value="">Pilih ..</option>
                                                                        <?php
                                                                        if (!empty($proyekInfo)) {
                                                                            foreach ($proyekInfo as $record) {
                                                                        ?>
                                                                                <option data-deskripsi="<?= $record->deskripsi ?>" data-tools="<?= $record->tools ?>" value="<?php echo $record->id_proyek ?>"><?php echo $record->nama_proyek ?> (<?= $record->nama ?>)</option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi <span class="required">*</span></label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <textarea cols="4" readonly class="form-control deskripsi_proyek"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tools <span class="required">*</span></label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <input readonly class="form-control tools_proyek">
                                                                </div>
                                                            </div>
                                                            <!-- <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tentukan dosen pembimbing 2</label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <select name="dosenProyek" id="dosen2" class="form-control">
                                                                        <option value="">Pilih Dosen pembimbing 2..</option>
                                                                        <?php foreach ($dataDosen as $data) { ?>
                                                                            <option value="<?php echo $data->id_dosen ?>">
                                                                                <?php echo $data->nama; ?>
                                                                            </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <small>Dosen 2 harus berbeda dengan Dosen Pemilik Proyek</small>
                                                                </div>
                                                            </div> -->
                                                            <div class="form-group col-md-9">
                                                                <input type="submit" class="btn btn-success pull-right" value="Submit">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end project-->
                                            </div>
                                        </div>
                                        <!--end pane 2-->
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php } elseif (isset($taTerplotting) && !empty($taTerplotting)) { ?>
        <!--    end validasi berdasarkan periode-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <center>
                            <h3>
                                <strong> <?= $taTerplotting['judul_ta'] ?> </strong>
                            </h3>
                            <h5>Dosen Pembimbing <strong><?= $taDosbing[0]->nama ?> <?= (isset($taDosbing[1]->nama)) ? " dan " . $taDosbing[1]->nama : "" ?></strong></h5>
                            <h5>Progress <strong><?= $taTerplotting['progress'] ?>%</strong></h5>
                        </center>
                        <br>

                        <a data-toggle="modal" data-target="#tambahBimbingan" type="button" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Update Bimbingan</a>

                        <table id="datatable-nopage" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Ke</th>
                                    <th>Tanggal</th>
                                    <th>Subject</th>
                                    <th>Deskripsi</th>
                                    <th>Catatan Dosen</th>
                                    <th>File</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($taBimbingan) && count($taBimbingan) > 0) {
                                    foreach ($taBimbingan as $kBimbingan => $vBimbingan) { ?>
                                        <tr>
                                            <td><?= $kBimbingan + 1 ?></td>
                                            <td><?= date('d-m-Y H:i', strtotime($vBimbingan->created_at)) ?></td>
                                            <td><?= $vBimbingan->subject ?></td>
                                            <td><?= $vBimbingan->description ?></td>
                                            <td><?= $vBimbingan->reason ?></td>
                                            <td>
                                                <?php echo (isset($vBimbingan->file) ? "<a target=\"_blank\" href=\"" . base_url() . "uploads/data_bimbingan/" . $vBimbingan->file . "\">" . $vBimbingan->file . "</a>" : "Tidak ada lampiran"); ?>
                                            </td>
                                            <td><?= ucfirst($vBimbingan->status) ?></td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <!--    end validasi berdasarkan periode-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <center>
                            <h4>
                                <strong>BUKAN PERIODE </strong>PENDAFTARAN TUGAS AKHIR
                            </h4>
                            <br>
                            <h5>Silahkan tunggu informasi selanjutnya</h5>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<!-- Modal Update Bimbingan -->
<div class="modal fade" id="tambahBimbingan" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Catatan Bimbingan</h4>
            </div>
            <form action="<?php echo base_url(); ?>mahasiswa/pengajuan/updateBimbingan" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="x_panel">
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Subject Bimbingan <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" name="subject" class="form-control col-md-7 col-xs-12" placeholder="Tuliskan subject bimbingan anda">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">File Bimbingan <small>(pdf)</small> <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <div style="border:2px dashed #E0E0E0">
                                    <input type="file" class="form-control-file" id="file" name="file">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Deskripsi Bimbingan <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <textarea type="text" name="description" rows="4" class="form-control col-md-7 col-xs-12" placeholder="Tuliskan deskripsi bimbingan anda"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="status" id="status" value="pengajuan">
                    <input type="hidden" name="id_ta" id="id_ta" value=<?php echo $taTerplotting['id_ta'] ?>>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Ubah Tanggal Yudisium-->
<div class="modal fade" id="ubahTA" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ganti Tugas Akhir</h4>
            </div>
            <div class="modal-body">
                <center>
                    <h5><strong>Apakah anda yakin ingin mengganti tugas akhir?</strong></h5>
                </center>
            </div>
            <form action="<?php echo base_url(); ?>mahasiswa/pengajuan/setNonaktifTA" method="post">
                <div class="modal-footer">
                    <input type="hidden" name="is_ubah" id="is_ubah" value="1">
                    <input type="hidden" name="judul_ta" id="judul_ta" value="<?php echo $taTerplotting['judul_ta']; ?>">
                    <input type="hidden" name="id_ta" id="id_ta" value=<?php echo $taTerplotting['id_ta'] ?>>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        jQuery.validator.addMethod("notEqualToGroup", function(value, element, options) {
            // get all the elements passed here with the same class
            var elems = $(element).parents('form').find(options[0]);
            // the value of the current element
            var valueToCompare = value;
            // count
            var matchesFound = 0;
            // loop each element and compare its value with the current value
            // and increase the count every time we find one
            jQuery.each(elems, function() {
                thisVal = $(this).val();
                if (thisVal == valueToCompare) {
                    matchesFound++;
                }
            });
            // count should be either 0 or 1 max
            if (this.optional(element) || matchesFound <= 1) {
                //elems.removeClass('error');
                return true;
            } else {
                //elems.addClass('error');
            }
        }, jQuery.validator.format("<font color='red'>Setiap nomor pilihan harus berbeda.</font>"))

        $("#daftar").validate({
            rules: {
                proyektiga: {
                    required: true
                },
                satu: {
                    required: true,
                    notEqualToGroup: ['.distinctemails']
                },
                dua: {
                    required: true,
                    notEqualToGroup: ['.distinctemails']
                },
                tiga: {
                    required: true,
                    notEqualToGroup: ['.distinctemails']
                },
            },
            messages: {
                proyeksatu: {
                    required: "Proyek harus diisi"
                },
                satu: {
                    required: "Nomor pilihan tidak boleh kosong"
                },
                dua: {
                    required: "Nomor pilihan tidak boleh kosong"
                },
                tiga: {
                    required: "Nomor pilihan tidak boleh kosong"
                },
            }
        });

        //hapus isi inputan saat klik button proyek
        $('#tab_content3').click(function() {
            $('input[name=judul]').prop('required', true);
            $('input[name=deskripsi]').prop('required', true);
            $('input[name=bisnis_rule]').prop('required', true);
            $('input[name=file_persetujuan]').prop('required', true);
            $('input[name=proyektiga]').prop('required', false);
        });
        $('#tab_content4').click(function() {
            $('input[name=judul]').prop('required', false);
            $('input[name=deskripsi]').prop('required', false);
            $('input[name=bisnis_rule]').prop('required', false);
            $('input[name=file_persetujuan]').prop('required', false);
            $('input[name=proyektiga]').prop('required', true);
        });

        // // kembalikan pilihan saat klik button ide
        // $('#ide').click(function() {
        //     $('select[name=proyektiga]').val('').change();
        // });

        $('.proyek').change(function() {
            $('.deskripsi_proyek').val($(this).find(':selected').data('deskripsi'));
            $('.tools_proyek').val($(this).find(':selected').data('tools'));
        });

        $('.proyek').trigger('change');
        $("#datatable-nopage_filter").ready(function() {
            $(".dataTables_filter").hide();
        });
    });
</script>