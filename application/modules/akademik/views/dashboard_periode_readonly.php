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

            <div class="x_content">
                <a href="" class="btn btn-primary pull-right">
                    <i class="fa fa-clock-o"></i> Histori Periode</button>
                </a>

                <div class="col-md-4 col-sm-6 col-xs-12 col-md-offset-4">
                    <center>
                        <label class="control-label" for="name">Tahun Ajaran
                            <span class="required">*</span>
                        </label>
                    </center>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 col-md-offset-4">
                    <div class="col-md-4">
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <span>
                            <center>
                                <h2>/</h2>
                            </center>
                        </span>
                    </div>
                    <div class="col-md-4">
                        <input disabled="disabled" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 col-md-offset-4">
                    <center>
                        <label class="control-label" for="name">Semester
                            <span class="required">*</span>
                        </label>
                    </center>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 col-md-offset-4">
                    <select name="semester" id="semester" class="form-control">
                        <option value="">Pilih Semester ...</option>
                        <option value="genap">Genap</option>
                        <option value="ganjil">Ganjil</option>
                    </select>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 col-md-offset-4">
                    <br>
                    <center>
                        <button type="button" class="btn btn-success">Set Periode</button>
                    </center>
                </div>
                <a href="" class="btn btn-default pull-right">
                    <i class="fa fa-clock-o"></i> Ganti Periode</button>
                </a>
            </div>
        </div>


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
                        <br>
                        <br>
                        <br>
                        <br>
                        <h4>Status Registrasi :</h4>
                        <h1>
                            <span class="label label-default">Tidak aktif</span>
                        </h1>

                        <br>
                        <br>
                        <br>
                        <br>
                        <h4>Ubah Status Registrasi :</h4>
                        <a href="" class="btn btn-success btn-sm">
                            <i class="fa fa-check"></i> Aktifkan</button>
                        </a>
                        <a href="" class="btn btn-danger btn-sm">
                            <i class="fa fa-close"></i> Nonaktifkan</button>
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
                        <br>
                        <br>
                        <br>
                        <br>
                        <h4>Status Registrasi :</h4>
                        <h1>
                            <span class="label label-default">Tidak aktif</span>
                        </h1>

                        <br>
                        <br>
                        <br>
                        <br>
                        <h4>Ubah Status Registrasi :</h4>
                        <a href="" class="btn btn-success btn-sm">
                            <i class="fa fa-check"></i> Aktifkan</button>
                        </a>
                        <a href="" class="btn btn-danger btn-sm">
                            <i class="fa fa-close"></i> Nonaktifkan</button>
                        </a>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="deleteModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Periode</h4>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus data?</p>
            </div>
            <div class="modal-footer">
                <form action="<?php echo base_url() . 'akademik/periode/delete' ?>" method="post">
                    <input type="hidden" name="id_periode" id="id_periode" value="">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on("click", "#delete_modal", function () {
        var id_periode = $(this).data('id');
        $(".modal-footer #id_periode").val(id_periode);
    });
</script>
</div>

<!-- /page content -->