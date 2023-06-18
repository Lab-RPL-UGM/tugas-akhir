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
            <?php //var_dump($dataThead);?>
            <div class="x_panel">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php $this->load->helper('form');
                        $error=$this->session->flashdata('error');
                        $success=$this->session->flashdata('success');
                        if($error) {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                    <?php } elseif($success) { ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5>
                                <i class="fa fa-warning"></i>
                                Periode pertama ini harap diisi dengan sebenar-benarnya karena data periode pertama ini akan dijadikan patokan oleh periode-periode selanjutnya
                            </h5>
                        </div>
                    <?php } ?>
                </div>
                <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" id="addPeriodeForm" action="<?php echo base_url() . 'akademik/periode/add_period'?>"
                        method="post">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Semester
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <!-- <input type="hidden" <?php //if(isset($dataUser)) { echo 'value=\"'. $dataUser[0]->id_user . '\"'; } ?> name="userId" id="userId" /> -->
                                        <select id="semester" name="semester" required="required" class="form-control">
                                            <option value="">Pilih Semester ...</option>
                                            <option value="genap">Genap</option>
                                            <option value="ganjil">Ganjil</option>
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
                                    <input id="thn1" min="2000" type="number" name="thn1" required="required" class="form-control">
                                </div>
                                <center>
                                    <h4 class="col-md-4 col-sm-4 col-xs-4">/</h4>
                                </center>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <input readonly id="thn2" type="number" name="thn2" class="form-control">
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
    <script>
        // $('#myDatepicker2').datetimepicker({
        //     format: 'DD/MM/YYYY'
        // });
        // $('#myDatepicker3').datetimepicker({
        //     format: 'HH:mm'
        // });
        // $('#myDatepicker4').datetimepicker({
        //     format: 'DD/MM/YYYY'
        // });
        // $('#myDatepicker5').datetimepicker({
        //     format: 'HH:mm'
        // });
        $("#thn1").on('change keyup', function () {
                $("#thn2").val(parseInt($(this).val()) + 1);
            }
        );
    </script>
    <script>
        $.validator.addMethod("greaterThan", function (value, element, param) {
                var target = $(param);
                if (this.settings.onfocusout && target.not(".validate-greaterThan-blur").length) {
                    target.addClass("validate-greaterThan-blur").on("blur.validate-greaterThan", function () {
                        $(element).valid();
                    });
                }
                return value > target.val();
            }

            , "Please enter a greater value.");
    </script>
    <script src="<?php echo base_url() . 'elusistatic/js/addPeriode.js'?>"></script>
