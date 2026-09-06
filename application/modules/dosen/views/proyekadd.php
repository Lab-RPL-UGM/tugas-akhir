<?php

/**
 * Created by nad.
 * Date: 22/03/2018
 * Time: 21:12
 * Description:
 */
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><a href="<?php echo base_url() ?>dosen/proyek"><i class="fa fa-chevron-left"></i></a> Project Management <small>Add, Edit</small></h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h4>Detail Proyek</h4>
                </div>
                <div class="x_content">
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
                    <br />
                    <form id="tambah-proyek" action="<?php echo base_url() ?>dosen/proyek/addNewProject" method="post" role="form" data-parsley-validate class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Penanggung jawab</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <!-- Proyek yang diajukan selalu atas nama dosen yang login -- tidak bisa
                                     dilimpahkan ke dosen lain, jadi bukan dropdown lagi. -->
                                <p class="form-control-static"><strong><?php echo $dosenSaya ? $dosenSaya->nama : '(akun Anda belum tertaut ke data dosen)'; ?></strong></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Periode</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <!-- Selalu periode yang sedang aktif sekarang -- otomatis, tidak perlu dipilih. -->
                                <p class="form-control-static"><strong>
                                    <?php echo $periodeAktif ? ucfirst($periodeAktif->semester) . ' ' . $periodeAktif->tahun_ajaran . ' (Aktif)' : '(belum ada periode aktif)'; ?>
                                </strong></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_bidang">Bidang</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <!-- SOP: satu proyek boleh punya lebih dari satu bidang -->
                                <select id="id_bidang" name="id_bidang[]" class="form-control" multiple="multiple">
                                    <?php foreach ($dataBidang as $b) { ?>
                                        <option value="<?php echo $b->id_bidang; ?>"><?php echo $b->nama; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama-proyek">Judul Proyek <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nama-proyek" id="nama-proyek" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deskripsi">Deksripsi Proyek <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea type="text" name="deskripsi" id="deskripsi" rows="4" required="required" class="form-control col-md-7 col-xs-12"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tools">Tools Proyek <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <!-- required dilepas dari sini: begitu jquery.tagsInput aktif, input asli
                                     ini disembunyikan, dan constraint "required" pada elemen tersembunyi
                                     bikin browser (Chrome dkk) menolak submit form sama sekali. -->
                                <input type="text" name="tools" id="tools" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="instansi" class="control-label col-md-3 col-sm-3 col-xs-12">Mitra</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="klien" class="form-control col-md-7 col-xs-12" type="text" name="klien">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 pull-right">
                                <a href="<?php echo base_url() ?>dosen/proyek" class="btn btn-danger">Cancel</a>
                                <input type="submit" class="btn btn-success" value="Submit" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tag input untuk field Tools: ketik lalu Enter/koma jadi tag terpisah -->
<link href="<?php echo base_url() ?>elusistatic/vendors/jquery.tagsinput/dist/jquery.tagsinput.min.css" rel="stylesheet">
<script src="<?php echo base_url() ?>elusistatic/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- Select2 untuk multi-select Bidang -- belum dimuat di modul dosen, jadi ditambah di sini -->
<link href="<?php echo base_url() ?>elusistatic/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
<script src="<?php echo base_url() ?>elusistatic/vendors/select2/dist/js/select2.full.min.js"></script>
<script>
    $(function () {
        $('#tools').tagsInput({
            width: '100%',
            interactive: true,
            defaultText: 'tambah tool...'
        });
        $('#id_bidang').select2({
            width: '100%',
            placeholder: 'Pilih satu atau lebih bidang...'
        });
    });
</script>