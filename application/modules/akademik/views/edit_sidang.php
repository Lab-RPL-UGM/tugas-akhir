<?php

/**
 * Created by nad.
 * Date: 26/03/2018
 * Time: 21:21
 * Description:
 */
//var_dump($berkasInfo);
//var_dump($sidangInfo);
?>
<?php
$id_berkas_sidang = '';
$nama_berkas = '';
$id_valid_sidang = '';
$isValid = '';
$path = '';
$id_sidang = '';
$nim = '';
$nama = '';
$id_mahasiswa = '';

if (!empty($berkasInfo)) {
    foreach ($berkasInfo as $uf) {
        $id_berkas_sidang = $uf->id_berkas_sidang;
        $nama_berkas = $uf->nama_berkas;
        $id_valid_sidang = $uf->id_valid_sidang;
        $isValid = $uf->isValid;
        $path = $uf->path;
        $id_sidang = $uf->id_sidang;
    }
}
if (!empty($sidangInfo)) {
    foreach ($sidangInfo as $uf) {
        $nim = $uf->nim;
        $nama = $uf->nama;
        $id_mahasiswa = $uf->id_mahasiswa;
    }
}
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><a href="<?php echo base_url() ?>akademik/sidang"><i class="fa fa-chevron-left"></i></a> &nbsp;Sidang</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <!--berkas mahasiswa-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Detail Pengajuan<small></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <span class="col-md-2 badge"><strong>NIM</strong></span>
                        <span class="col-md-7"><?php echo $nim ?></span>
                    </div>
                    <br>
                    <div class="row">
                        <span class="col-md-2 badge"><strong>Nama</strong></span>
                        <span class="col-md-7"><?php echo $nama ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
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
                </div>
            </div>
        </div>
    </div>
</div>