<?php

/**
 * Created by nad.
 * Date: 12/04/2018
 * Time: 18:30
 * Description:
 */
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                <a href="<?php echo base_url() ?>akademik/sidang">
                    <i class="fa fa-chevron-left"></i>
                </a>
                Jadwal Sidang
                <small>Add</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
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
                </div>
                <div class="x_content">
                    <br />
                    <form id="jadwalForm" action="<?php echo base_url() ?>akademik/sidang/jadwal/<?php echo $sidangInfo[0]->id_sidang ?>/<?php echo $sidangInfo[0]->id_mahasiswa ?>" method="post" role="form" data-parsley-validate class="form-horizontal form-label-left">
                        <div class="x_title">
                            <h2>Jadwal<small></small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal dan waktu
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <div class='input-group date myDatepicker2' id='myDatepicker2'>
                                            <input name="tanggalJadwal" id="tanggalJadwal" type='text' class="form-control" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                        <div id="errordiv"></div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class='input-group date myDatepicker3' id='myDatepicker3'>
                                            <input name="waktuJadwal" id="waktuJadwal" type='text' class="form-control" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div>
                                        <div id="errordiv-waktu"></div>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-12 text-center" style="top: 6px;">
                                        s/d
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class='input-group date myDatepicker3' id='myDatepicker3'>
                                            <input name="waktuSelesaiJadwal" id="waktuSelesaiJadwal" type='text' class="form-control" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div>
                                        <div id="errordiv-waktu"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Ruang
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <input name="ruangJadwal" id="ruangJadwal" type='text' class="form-control" />
                                        <div id="errordiv-ruang"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="x_title">
                            <h2>Anggota<small></small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="ketua">Ketua</label><small></small>
                                <span class="required">*</span>
                                <select class="form-control col-md-7 col-xs-12" id="dataKetua" name="dataKetua">
                                    <option value="0" disabled selected>Pilih ..</option>
                                    <?php
                                    if (!empty($dosenInfo)) {
                                        foreach ($dosenInfo as $dosen) {
                                    ?>
                                            <?php if ($dosen->id_dosen != $sidangInfo[0]->id_dosbing) { ?>
                                                <!--                                            <option value="--><?php //echo $dosen->id_dosen 
                                                                                                                    ?><!--">--><?php //echo $dosen->nama_dosen 
                                                                                                                                ?><!--</option>-->
                                                <option value="<?php echo $dosen->id_dosen . ' ' . $dosen->nama_dosen ?>"><?php echo $dosen->nama_dosen ?></option>
                                            <?php } else { ?>
                                                <option hidden></option>
                                            <?php } ?>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <div id="errordiv-ketua"></div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="ketua">Sekretaris</label><small></small>
                                <span class="required">*</span>
                                <select class="form-control col-md-7 col-xs-12" id="dataSekretaris" required name="dataSekretaris">
                                    <option value="" selected>Pilih ..</option>
                                    <?php
                                    if (!empty($dosenInfo)) {
                                        foreach ($dosenInfo as $dosen) {
                                    ?>
                                            <option value="<?php echo $dosen->id_dosen . ' ' . $dosen->nama_dosen ?>">
                                                <?php echo $dosen->nama_dosen ?>
                                            </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <div id="errordiv-sekre"></div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="anggota">Anggota</label><small></small>
                                <span class="required">*</span>
                                <select class="form-control" required name="dataAnggota">
                                    <?php
                                    if (!empty($dosenInfo)) {
                                        foreach ($dosenInfo as $dosen) {
                                    ?>
                                            <option value="<?php echo $dosen->id_dosen . ' ' . $dosen->nama_dosen ?>" <?php echo ($dosen->id_dosen == $sidangInfo[0]->id_dosbing) ? "selected=\"selected\"" : ""; ?>>
                                                <?php echo $dosen->nama_dosen ?>
                                            </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-12 col-sm-12" style="margin-top: 5%">
                                <input type="submit" class="btn btn-primary pull-right" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url() . 'elusistatic/js/addJadwal.js' ?>"></script>
<!-- moment -->
<script src="<?php echo base_url(); ?>elusistatic/vendors/moment/min/moment.min.js"></script>
<!-- bootstrap-datetimepicker -->
<script src="<?php echo base_url(); ?>elusistatic/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $('.myDatepicker2').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    $('.myDatepicker3').datetimepicker({
        format: 'HH:mm'
    });
</script>