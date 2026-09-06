<?php

/**
 * Created by nad.
 * Date: 22/03/2018
 * Time: 21:12
 * Description:
 */
?>
<?php
$id_proyek = '';
$proyek_dosen = '';
$nama_proyek = '';
$nama_dosen = '';
$klien = '';
$deskripsi = '';
$tools = '';
$id_periode = '';

if (!empty($proyekInfo)) {
    foreach ($proyekInfo as $uf) {
        $id_proyek = $uf->id_proyek;
        $proyek_dosen = $uf->id_dosen;
        $nama_proyek = $uf->nama_proyek;
        $nama_dosen = $uf->nama_dosen;
        $klien = $uf->klien;
        $deskripsi = $uf->deskripsi;
        $tools = $uf->tools;
        $id_periode = $uf->id_periode;
    }
}
$selectedBidangIds = $selectedBidangIds ?? [];
//var_dump($proyekInfo);
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
                    <form id="edit-proyek" action="<?php echo base_url() ?>dosen/proyek/editProject" method="post" role="form" data-parsley-validate class="form-horizontal form-label-left">
                        <div class="form-group">
                            <input type="hidden" name="id-proyek" id="id-proyek" class="form-control col-md-7 col-xs-12" value="<?php echo $id_proyek ?>">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Penanggung jawab</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <!-- Proyek yang diajukan selalu atas nama dosen yang login -- tidak bisa
                                     dilimpahkan ke dosen lain, jadi bukan dropdown lagi. -->
                                <p class="form-control-static"><strong><?php echo $nama_dosen; ?></strong></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_periode">Periode
                                <span class="required"> *</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="id_periode" name="id_periode" class="form-control" required="required">
                                    <option value="">Pilih periode ...</option>
                                    <?php foreach ($dataPeriode as $p) { ?>
                                        <option value="<?php echo $p->id_periode; ?>" <?php echo ($p->id_periode == $id_periode) ? 'selected' : ''; ?>>
                                            <?php echo ucfirst($p->semester) . ' ' . $p->tahun_ajaran . ($p->status_periode == 1 ? ' (Aktif)' : ''); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_bidang">Bidang</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <!-- SOP: satu proyek boleh punya lebih dari satu bidang -->
                                <select id="id_bidang" name="id_bidang[]" class="form-control" multiple="multiple">
                                    <?php foreach ($dataBidang as $b) { ?>
                                        <option value="<?php echo $b->id_bidang; ?>" <?php echo in_array((int)$b->id_bidang, $selectedBidangIds) ? 'selected' : ''; ?>>
                                            <?php echo $b->nama; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama-proyek">Judul Proyek <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nama-proyek" id="nama-proyek" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $nama_proyek ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deskripsi">Deksripsi Proyek <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea type="text" name="deskripsi" id="deskripsi" rows="4" required="required" class="form-control col-md-7 col-xs-12"><?php echo $deskripsi ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tools">Tools Proyek <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <!-- required dilepas: input tersembunyi setelah jquery.tagsInput aktif
                                     bikin browser menolak submit kalau atributnya masih required -->
                                <input type="text" name="tools" id="tools" class="form-control col-md-7 col-xs-12" value="<?php echo $tools ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="instansi" class="control-label col-md-3 col-sm-3 col-xs-12">Mitra</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="klien" class="form-control col-md-7 col-xs-12" type="text" name="klien" value="<?php echo $klien ?>">
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

<!-- Tag input untuk field Tools: ketik lalu Enter/koma jadi tag terpisah.
     Value existing (comma-separated) otomatis di-parse jadi tag saat init. -->
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