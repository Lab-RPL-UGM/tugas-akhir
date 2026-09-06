<div class="row">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Manajemen Bidang
                    </h2>
                    <div class="clearfix"></div>
                </div>
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
                    <a href="<?php echo base_url(); ?>akademik/bidang/add_form" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Bidang Baru</a>
                    <table id="tabel" class="table table-striped table-bordered dt-responsive">
                        <thead>
                            <tr>
                                <th class="col-md-8">Nama Bidang</th>
                                <th class="col-md-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataBidang as $data) { ?>
                                <tr>
                                    <td>
                                        <?php echo $data->nama; ?>
                                    </td>
                                    <td align="center" style="vertical-align:middle">
                                        <a data-toggle="tooltip" title="Edit" href="<?php echo base_url(); ?>akademik/bidang/edit_form/<?php echo $data->id_bidang; ?>" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a title="Delete" class="btn btn-danger" data-toggle='modal' id="delete_modal" data-target='#deleteModal<?php echo $data->id_bidang; ?>'>
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>

                                    <div class="modal fade" id="deleteModal<?php echo $data->id_bidang; ?>" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Hapus Bidang</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus bidang <strong><?php echo $data->nama; ?></strong>?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="<?php echo base_url() . 'akademik/bidang/delete' ?>" method="post">
                                                        <input type="hidden" name="id_bidang" value="<?php echo $data->id_bidang; ?>">
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#tabel').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': true
        })
    })
</script>
