<div class="page-title">
    <div class="title_left">
        <h3>Manajemen Proyek
            <small>Add</small>
        </h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <?php //var_dump($dataDosen) 
    ?>
    <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4>Detail Proyek</h4>
            </div>
            <div class="x_content">
                <br />
                <form id="addEditProyekForm" class="form-horizontal form-label-left" action="<?php echo base_url(); ?>akademik/proyek/add" method="post">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="select_dosen">Penanggung jawab
                            <span class="required"> *</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="select_dosen" name="select_dosen" class="form-control" required="required">
                                <option value="">Pilih dosen penanggung jawab ...</option>
                                <?php foreach ($dataDosen as $data) { ?>
                                    <option value="<?php echo $data->id_dosen; ?>"><?php echo $data->nama; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama_proyek">Judul Proyek
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="nama_proyek" id="nama_proyek" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="deskripsi">Deksripsi Proyek <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea type="text" name="deskripsi" id="deskripsi" rows="4" required="required" class="form-control col-md-7 col-xs-12"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="tools">Tools Proyek <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="tools" id="tools" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="instansi" class="control-label col-md-4 col-sm-4 col-xs-12">Instansi / Klien
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="instansi" class="form-control col-md-7 col-xs-12" type="text" name="instansi">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 pull-right">
                            <a href="<?php echo base_url(); ?>akademik/proyek" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url() . 'elusistatic/js/addEditProyek.js' ?>"></script>