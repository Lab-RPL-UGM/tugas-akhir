<?php 
if($dataPeriode != FALSE) {
    $id_periode = $dataPeriode[0]->id_periode;
    
    $tahun_ajaran = $dataPeriode[0]->tahun_ajaran;
    
    $thn1 = explode('/',$tahun_ajaran)[0];
    $thn2 = explode('/',$tahun_ajaran)[1];

    $semester = $dataPeriode[0]->semester;


    if($semester == 'ganjil'){
        $next_semester = 'genap';
        $next_tahun_ajaran = $tahun_ajaran;
    } else {
        $next_semester = 'ganjil';
        $thn1 = $thn2;
        $thn2 = $thn2 + 1;
        $next_tahun_ajaran = $thn1 . '/' . $thn2;
    }
    $tanggal_sekarang = date("Y-m-d");

    if($dataPeriode[0]->tgl_awal_regis_ta && $dataPeriode[0]->tgl_akhir_regis_ta){
        $tanggal_awal_regis_ta = date_format(date_create_from_format('Y-m-d', $dataPeriode[0]->tgl_awal_regis_ta), 'd-m-Y');
        $tanggal_akhir_regis_ta = date_format(date_create_from_format('Y-m-d', $dataPeriode[0]->tgl_akhir_regis_ta), 'd-m-Y');
        $status_regis_ta = $tanggal_sekarang >= $dataPeriode[0]->tgl_awal_regis_ta && $tanggal_sekarang <= $dataPeriode[0]->tgl_akhir_regis_ta;
    } else {
        $tanggal_awal_regis_ta = NULL;
        $tanggal_akhir_regis_ta = NULL;
        $status_regis_ta = NULL;
    }
    if($dataPeriode[0]->tgl_awal_regis_yudisium && $dataPeriode[0]->tgl_akhir_regis_yudisium){
        $tanggal_awal_regis_yudisium = date_format(date_create_from_format('Y-m-d', $dataPeriode[0]->tgl_awal_regis_yudisium), 'd-m-Y');
        $tanggal_akhir_regis_yudisium = date_format(date_create_from_format('Y-m-d', $dataPeriode[0]->tgl_akhir_regis_yudisium), 'd-m-Y');
        $status_regis_yudisium = $tanggal_sekarang >= $dataPeriode[0]->tgl_awal_regis_yudisium && $tanggal_sekarang <= $dataPeriode[0]->tgl_akhir_regis_yudisium;
    } else {
        $tanggal_awal_regis_yudisium = NULL;
        $tanggal_akhir_regis_yudisium = NULL;
        $status_regis_yudisium = NULL;
    }
}
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2> Periode Registrasi
                </h2>
                <div class="clearfix"></div>
            </div>
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

            <?php if($dataPeriode != FALSE) {?>
            <div class="x_content">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <center>
                        <p>
                            <h3>Periode Semester
                                <span>
                                    <strong>
                                        <?php echo ucfirst($dataPeriode[0]->semester) . " " . $dataPeriode[0]->tahun_ajaran ?>
                                    </strong>
                                </span>
                            </h3>
                        </p>
                        <p>
                            <i>
                                <?php echo DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->format('j F Y'); ?>
                            </i>
                        </p>
                    </center>
                    <!-- <a href="<?php //echo base_url() ?>akademik/periode/ubah_periode" class="btn btn-default pull-right">
                        <i class="fa fa-clock-o"></i> Ganti Periode</button>
                    </a> -->
                    <a data-toggle='modal' data-target="#modalGanti" class="btn btn-default pull-right">
                        <i class="fa fa-clock-o"></i> Ganti Periode</button>
                    </a>


                </div>
            </div>
            <?php }  else { ?>
            <div class="x_content">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <center>
                        <p>
                            <h3>Belum ada data periode</h3>
                        </p>
                        <p>
                            <i>
                                <?php echo DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->format('j F Y'); ?>
                            </i>
                        </p>
                    </center>
                    <a href="<?php echo base_url() ?>akademik/periode/ubah_periode" class="btn btn-default pull-right">
                        <i class="fa fa-clock-o"></i> Mulai Periode</button>
                    </a>
                </div>
            </div>
            <?php } ?>


            <?php if($dataPeriode != FALSE) {?>
            <div class="col-md-6">
                <div class="x_panel">
                    <div class="x_content">
                        <center>
                            <h2>
                                <strong>TUGAS AKHIR</strong>
                            </h2>
                            <div class="x_title">
                                <div class="clearfix"></div>
                            </div>
                            <h2>Status Registrasi</h2>
                            <?php if($status_regis_ta) { ?>
                            <h1>
                                <span class="label label-success">Aktif</span>
                            </h1>
                            <?php } else { ?>
                            <h1>
                                <span class="label label-default">Tidak aktif</span>
                            </h1>
                            <?php } ?>
                            <div class="row" style="margin-top:10%">
                                <div class="col-md-6">
                                    <h2>
                                        <strong>Tanggal Awal</strong>
                                    </h2>
                                    <?php if($tanggal_awal_regis_ta == NULL) { ?>
                                    <h1>
                                        <i>(Belum di set)</i>
                                    </h1>
                                    <?php } else { ?>
                                    <h1>
                                        <strong>
                                            <?php echo $tanggal_awal_regis_ta?>
                                        </strong>
                                    </h1>
                                    <?php } ?>

                                </div>
                                <div class="col-md-6">
                                    <h2>
                                        <strong>Tanggal Akhir</strong>
                                    </h2>
                                    <?php if($tanggal_akhir_regis_ta == NULL) { ?>
                                    <h1>
                                        <i>(Belum di set)</i>
                                    </h1>
                                    <?php } else { ?>
                                    <h1>
                                        <strong>
                                            <?php echo $tanggal_akhir_regis_ta?>
                                        </strong>
                                    </h1>
                                    <?php } ?>
                                </div>
                            </div>

                            <h4 style="margin-top:20%">Ubah Tanggal Registrasi:</h4>
                            <a href="" data-toggle="modal" data-target="#ubahTanggalTAModal" class="modal_date btn btn-primary btn-sm">
                                <i class="fa fa-pencil"></i> Ubah</button>
                            </a>
                        </center>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="x_panel">
                    <div class="x_content">
                        <center>
                            <h2>
                                <strong>YUDISIUM</strong>
                            </h2>
                            <div class="x_title">
                                <div class="clearfix"></div>
                            </div>
                            <h4>Status Registrasi :</h4>
                            <?php if($status_regis_yudisium) { ?>
                            <h1>
                                <span class="label label-success">Aktif</span>
                            </h1>
                            <?php } else { ?>
                            <h1>
                                <span class="label label-default">Tidak aktif</span>
                            </h1>
                            <?php } ?>
                            <div class="row" style="margin-top:10%">
                                <div class="col-md-6">
                                    <h2>
                                        <strong>Tanggal Awal</strong>
                                    </h2>
                                    <?php if($tanggal_awal_regis_yudisium == NULL) { ?>
                                    <h1>
                                        <i>(Belum di set)</i>
                                    </h1>
                                    <?php } else { ?>
                                    <h1>
                                        <strong>
                                            <?php echo $tanggal_awal_regis_yudisium?>
                                        </strong>
                                    </h1>
                                    <?php } ?>

                                </div>
                                <div class="col-md-6">
                                    <h2>
                                        <strong>Tanggal Akhir</strong>
                                    </h2>
                                    <?php if($tanggal_akhir_regis_yudisium == NULL) { ?>
                                    <h1>
                                        <i>(Belum di set)</i>
                                    </h1>
                                    <?php } else { ?>
                                    <h1>
                                        <strong>
                                            <?php echo $tanggal_akhir_regis_yudisium?>
                                        </strong>
                                    </h1>
                                    <?php } ?>
                                </div>
                            </div>

                            <h4 style="margin-top:20%">Ubah Tanggal Registrasi:</h4>
                            <a href="" data-toggle="modal" data-jenis="yudisium" data-target="#ubahTanggalYudisiumModal" class="modal_date btn btn-primary btn-sm">
                                <i class="fa fa-pencil"></i> Ubah</button>
                            </a>
                        </center>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalGanti" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ganti Periode</h4>
            </div>
            <div class="modal-body">
                <p>
                    <center>
                        <h5>Apakah anda yakin ingin merubah periode menjadi
                            <br>
                            <br>
                            <strong>
                                <?php echo 'Tahun Ajaran ' . $next_tahun_ajaran . " Semester " . ucfirst($next_semester); ?>?</strong>
                        </h5>
                    </center>
                </p>
            </div>
            <div class="modal-footer">
                <form action="<?php echo base_url() . 'akademik/periode/add_period' ?>" method="post">
                    <input type="hidden" name="semester" id="semester" value="<?php echo $next_semester; ?>">
                    <input type="hidden" name="tahun_ajaran" id="tahun_ajaran" value="<?php echo $next_tahun_ajaran; ?>">
                    <button type="submit" class="btn btn-primary">Ganti</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ubah Tanggal TA-->
<div class="modal fade" id="ubahTanggalTAModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ubah Tanggal Registrasi Tugas Akhir</h4>
            </div>
            <form class="form-horizontal form-label-left" id="editTanggalTA" action="<?php echo base_url() . 'akademik/periode/edit_tanggal_regis/ta'?>"
                method="post">
                <div class="modal-body">                                        
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Awal Registrasi
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class='input-group date' id='datetimepicker1'>
                                <input name="tanggal_awal_ta" id="tanggal_awal_ta" type='text' class="form-control" value="<?php echo ($tanggal_awal_regis_ta ? $tanggal_awal_regis_ta : "
                                    ")?>" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Akhir Registrasi
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class='input-group date' id='datetimepicker2'>
                                <input name="tanggal_akhir_ta" id="tanggal_akhir_ta" type='text' class="form-control" value="<?php echo ($tanggal_akhir_regis_ta ? $tanggal_akhir_regis_ta : "
                                    ")?>" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_periode" id="id_periode" value="<?php echo $id_periode; ?>">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Ubah Tanggal Yudisium-->
<div class="modal fade" id="ubahTanggalYudisiumModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ubah Tanggal Registrasi Yudisium</h4>
            </div>
            <form class="form-horizontal form-label-left" id="editTanggalYudisium" action="<?php echo base_url() . 'akademik/periode/edit_tanggal_regis/yudisium'?>"
                method="post">
                <div class="modal-body">                                        
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Awal Registrasi
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class='input-group date' id='datetimepicker3'>
                                <input name="tanggal_awal_yudisium" id="tanggal_awal_yudisium" type='text' class="form-control" value="<?php echo ($tanggal_awal_regis_yudisium ? $tanggal_awal_regis_yudisium : "
                                    ")?>" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Akhir Registrasi
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class='input-group date' id='datetimepicker4'>
                                <input name="tanggal_akhir_yudisium" id="tanggal_akhir_yudisium" type='text' class="form-control" value="<?php echo ($tanggal_akhir_regis_yudisium ? $tanggal_akhir_regis_yudisium : "
                                    ")?>" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_periode" id="id_periode" value="<?php echo $id_periode; ?>">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /page content -->
<script>
$(document).on("click", ".open-AddBookDialog", function () {
     var myBookId = $(this).data('id');
     $(".modal-body #bookId").val( myBookId );
     // As pointed out in comments, 
     // it is superfluous to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
// $(".modal_date").click(function(){
//     var jenis = $(this).data('jenis');
//      $(".modal-body #jenis").val(jenis);
// });

</script>
<script src="<?php echo base_url() . 'elusistatic/js/addEditTanggalRegis.js'?>"></script>
<!-- moment -->
<script src="<?php echo base_url(); ?>elusistatic/vendors/moment/min/moment.min.js"></script>
<!-- bootstrap-datetimepicker -->
<script src="<?php echo base_url(); ?>elusistatic/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $('#datetimepicker1').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $('#datetimepicker2').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $('#datetimepicker3').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $('#datetimepicker4').datetimepicker({
        format: 'DD-MM-YYYY'
    });
</script>