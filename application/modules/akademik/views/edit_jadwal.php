<?php
/**
 * Created by nad.
 * Date: 16/04/2018
 * Time: 19:48
 * Description:
 */
//var_dump($dosenInfo)
//var_dump($sidangInfo)
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                <a href="<?php echo base_url() ?>akademik/sidang">
                    <i class="fa fa-chevron-left"></i>
                </a>
                Jadwal Sidang
                <small>Edit</small>
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
                    <form id="jadwalFormEdit" action="<?php echo base_url()?>akademik/sidang/editJadwal/<?php echo $sidangInfo[0]->id_sidang?>/<?php echo $sidangInfo[0]->id_mahasiswa?>" method="post" role="form" data-parsley-validate class="form-horizontal form-label-left">
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
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <div class='input-group date myDatepicker4' id='myDatepicker4'>
                                            <input value="<?php echo date_format(date_create_from_format('Y-m-d',$sidangInfo[0]->tanggal), 'd/m/Y'); ?>" name="editTanggalJadwal" id="editTanggalJadwal" type='text' class="form-control"/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                        <div id="errordiv"></div>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <div class='input-group date myDatepicker5' id='myDatepicker5'>
                                            <input value="<?php echo substr($sidangInfo[0]->waktu,0,5)?>" name="editWaktuJadwal" id="editWaktuJadwal" type='text' class="form-control"/>
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
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <input value="<?php echo $sidangInfo[0]->ruang?>" name="editRuangJadwal" id="editRuangJadwal" type='text' class="form-control"/>
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
                                <input type="hidden" name="editIdKetua" id="editIdKetua" value="<?php echo $ketuaInfo[0]->id_anggota_sidang?>">
                                <select class="form-control col-md-7 col-xs-12" id="editDataKetua" name="editDataKetua">
                                    <?php
                                    if(!empty($dosenInfo))
                                    {
                                        foreach ($dosenInfo as $dosen)
                                        {
                                            ?>
                                            <?php if ($dosen->id_dosen!=$sidangInfo[0]->id_dosbing){?>
                                            <option value="<?php echo $dosen->id_dosen. ' '. $dosen->nama_dosen?>" <?php echo ($dosen->id_dosen == $ketuaInfo[0]->id_dosen) ? "selected=\"selected\"" : ""; ?>>
                                                <?php echo $dosen->nama_dosen?>
                                            </option>
                                        <?php }else{?>
                                            <option hidden></option>
                                        <?php }?>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="sekre">Sekretaris</label><small></small>
                                <?php if ($sekreInfo!=null){?>
                                    <input type="hidden" name="editIdSekre" id="editIdSekre" value="<?php echo $sekreInfo[0]->id_anggota_sidang?>">
                                <?php }?>
                                <select class="form-control col-md-7 col-xs-12" id="editDataSekre" name="editDataSekre">
                                    <option value="">Tidak ada sekretaris</option>
                                    <?php
                                    if(!empty($dosenInfo))
                                    {
                                        foreach ($dosenInfo as $dosen)
                                        {
                                            ?>
                                            <?php if (!empty($sekreInfo)){?>
                                            <?php if ($dosen->id_dosen!=$anggotaInfo[0]->id_dosen){?>
                                                <option value="<?php echo $dosen->id_dosen. ' '. $dosen->nama_dosen?>" <?php echo ($dosen->id_dosen == $sekreInfo[0]->id_dosen) ? "selected=\"selected\"" : ""; ?>>
                                                    <?php echo $dosen->nama_dosen?>
                                                </option>
                                            <?php }else{?>
                                                <option hidden></option>
                                            <?php }?>
                                        <?php }else{?>
                                            <?php if ($dosen->id_dosen!=$anggotaInfo[0]->id_dosen){?>
                                                <option value="<?php echo $dosen->id_dosen. ' '. $dosen->nama_dosen?>">
                                                    <?php echo $dosen->nama_dosen?>
                                                </option>
                                            <?php }else{?>
                                                <option hidden></option>
                                            <?php }?>
                                        <?php }?>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <div id="errordiv-sekre"></div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label for="anggota">Dosen Pembimbing</label><small></small>
                                <input name="editIdAnggota" id="editIdAnggota" type="hidden" value="<?php echo $anggotaInfo[0]->id_anggota_sidang?>">
                                <select name="editDataAnggota" id="editDataAnggota" class="form-control">
                                    <option value="" selected>
                                        <?php echo $anggotaInfo[0]->nama_dosen?>
                                    </option>
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
<script src="<?php echo base_url() . 'elusistatic/js/addJadwal.js'?>"></script>
<!-- moment -->
<script src="<?php echo base_url(); ?>elusistatic/vendors/moment/min/moment.min.js"></script>
<!-- bootstrap-datetimepicker -->
<script src="<?php echo base_url(); ?>elusistatic/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $('.myDatepicker4').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    $('.myDatepicker5').datetimepicker({
        format: 'HH:mm'
    });
</script>