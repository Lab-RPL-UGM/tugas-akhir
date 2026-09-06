<?php
$id_bidang = '';
$nama = '';

if (!empty($dataBidang)) {
    foreach ($dataBidang as $uf) {
        $id_bidang = $uf->id_bidang;
        $nama = $uf->nama;
    }
}
?>
<div class="page-title">
    <div class="title_left">
        <h3>Manajemen Bidang
            <small>Edit</small>
        </h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4>Detail Bidang</h4>
            </div>
            <div class="x_content">
                <br />
                <form id="addEditBidangForm" class="form-horizontal form-label-left" action="<?php echo base_url(); ?>akademik/bidang/edit" method="post">
                    <input type="hidden" name="id_bidang" value="<?php echo $id_bidang; ?>">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Nama Bidang
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="nama" id="nama" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $nama; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 pull-right">
                            <a href="<?php echo base_url(); ?>akademik/bidang" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
