<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Periode
                <small>Add</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php //var_dump($waktu_awal);?>
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
                    <form class="form-horizontal form-label-left" id="addEditPeriodeForm" action="<?php echo base_url() . 'akademik/periode/edit'?>"
                        method="post">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Semester
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="hidden" value="<?php echo $dataPeriode[0]->id_periode ?>" name="id_periode" id="id_periode" /> 
                                    <select id="semester" name="semester" required="required" class="form-control">
                                    <?php $semester = $dataPeriode[0]->semester?>
                                        <option value="genap" <?php echo ($semester == 'genap') ? "selected=\"selected\"" : ""; ?>>Genap</option>
                                        <option value="ganjil"<?php echo ($semester == 'ganjil') ? "selected=\"selected\"" : ""; ?>>Ganjil</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Tahun Ajaran
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <input id="thn1" type="text" name="thn1" required="required" class="form-control" value="<?php echo explode('/',$dataPeriode[0]->tahun_ajaran)[0]?>">
                                </div>
                                <center>
                                    <h4 class="col-md-4 col-sm-4 col-xs-4">/</h4>
                                </center>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <input id="thn2" type="text" name="thn2" required="required" class="form-control" value="<?php echo explode('/',$dataPeriode[0]->tahun_ajaran)[1]?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Jenis Periode
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <select name="jenis" id="jenis" class="form-control">
                                    <?php $jenis = $dataPeriode[0]->jenis?>
                                        <option value="ta" <?php echo ($jenis == 'ta') ? "selected=\"selected\"" : ""; ?>>Tugas Akhir</option>
                                        <option value="yudisium" <?php echo ($jenis == 'yudisium') ? "selected=\"selected\"" : ""; ?>>Yudisium</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal dan waktu registrasi dimulai
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <div class='input-group date' id='myDatepicker2'>
                                        <input name="tanggal_awal" id="tanggal_awal" type='text' class="form-control" value="<?php echo $tanggal_awal?>"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <div class='input-group date' id='myDatepicker3'>
                                        <input name="waktu_awal" id="waktu_awal" type='text' class="form-control" value="<?php echo $waktu_awal?>" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal dan waktu registrasi berakhir
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <div class='input-group date' id='myDatepicker4'>
                                        <input name="tanggal_akhir" id="tanggal_akhir" type='text' class="form-control" value="<?php echo $tanggal_akhir?>"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <div class='input-group date' id='myDatepicker5'>
                                        <input name="waktu_akhir" id="waktu_akhir" type='text' class="form-control" value="<?php echo $waktu_akhir?>"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">

                                <a href="<?php echo base_url() ?>akademik/periode/" class="btn btn-danger">Cancel</a>
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button class="btn btn-success" name="submit" type="submit">Submit</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url() . 'elusistatic/js/addEditPeriode.js'?>"></script>

<!-- moment -->
<script src="<?php echo base_url(); ?>elusistatic/vendors/moment/min/moment.min.js"></script>
<!-- bootstrap-datetimepicker -->
<script src="<?php echo base_url(); ?>elusistatic/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $('#myDatepicker2').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    $('#myDatepicker3').datetimepicker({
        format: 'HH:mm'
    });
    $('#myDatepicker4').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    $('#myDatepicker5').datetimepicker({
        format: 'HH:mm'
    });
</script>
<script>
    $.validator.addMethod( "greaterThan", function( value, element, param ) {
    var target = $(param);

    if ( this.settings.onfocusout && target.not( ".validate-greaterThan-blur" ).length ) {
        target.addClass( "validate-greaterThan-blur" ).on( "blur.validate-greaterThan", function() {
            $( element ).valid();
        } );
    }

    return value > target.val();
    }, "Please enter a greater value." );
</script>