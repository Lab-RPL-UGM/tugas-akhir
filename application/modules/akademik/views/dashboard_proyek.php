<div class="row">

    <!--berkas mahasiswa-->
    <div class="row">
        <?php //var_dump($lol); ?>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Manajemen Proyek
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
                    <a href="<?php echo base_url();?>akademik/proyek/add_form" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Proyek Baru</a>
                    <form action="<?php echo base_url(); ?>akademik/proyek/multiple_action" method="post">
                        <table id="tabel" class="table table-striped table-bordered bulk_action dt-responsive">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="col-md-3">Nama Proyek</th>
                                    <th class="col-md-2">Penanggung Jawab</th>
                                    <th class="col-md-2">Instansi</th>
                                    <th class="col-md-1">Status</th>
                                    <th class="col-md-2">Persetujuan</th>
                                    <th class="col-md-2">Aksi</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php foreach ($dataTable as $data) { ?>
                                <tr>
                                    <th>
                                        <input id="table_records[]" type="checkbox" class="flat" name="table_records[]" value="<?php echo $data->id_proyek;?>">
                                    </th>
                                    <td>
                                        <?php echo $data->nama_proyek; ?>
                                    </td>
                                    <td>
                                        <?php echo $data->nama_dosen; ?>
                                    </td>
                                    <td>
                                        <?php echo (isset($data->klien) ? $data->klien : "<i>(tidak ada klien)</i>") ; ?>
                                    </td>
                                    <td align="center" style="vertical-align:middle">
                                        <?php if($data->status == 'disetujui') { ?>
                                        <span class="label label-success">Diterima</span>
                                        <?php } elseif($data->status == 'pending') { ?>
                                        <span class="label label-warning">Pending</span>
                                        <?php } else { ?>
                                        <span class="label label-danger">Ditolak</span>
                                        <?php } ?>
                                    </td>
                                    <td align="center" style="vertical-align:middle">
                                        <?php if($data->status == 'pending' || $data->status == 'ditolak'){?>
                                        <a title="Setujui" data-id="<?php echo $data->id_proyek; ?>" data-toggle='modal' id="accept_modal" data-target='#accModal'
                                            class="btn btn-success">
                                            <i class="glyphicon glyphicon-ok"></i>
                                        </a>
                                        <?php } else { ?>
                                        <a disabled="disabled" class="btn btn-success">
                                            <i disabled="disabled" class="glyphicon glyphicon-ok"></i>
                                        </a>
                                        <?php } ?>
                                        <a title="Tolak" data-id="<?php echo $data->id_proyek; ?>" data-toggle='modal' id="decline_modal" data-target='#declModal'
                                            class="btn btn-danger">
                                            <i class="glyphicon glyphicon-remove"></i>
                                        </a>
                                    </td>

                                    <td align="center" style="vertical-align:middle">
                                        <a data-toggle="tooltip" title="Edit" href="<?php echo base_url(); ?>akademik/proyek/edit_form/<?php echo $data->id_proyek; ?>"
                                            class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a title="Delete" class="btn btn-danger" data-toggle='modal' id="delete_modal" data-target='#deleteModal<?php echo $data->id_proyek;?>'>
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>

                                    <div class="modal fade" id="deleteModal<?php echo $data->id_proyek; ?>" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Hapus Proyek</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus proyek ini?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="<?php echo base_url() . 'akademik/proyek/delete' ?>" method="post">
                                                        <input type="hidden" name="id_proyek" id="id_proyek" value="<?php echo $data->id_proyek; ?>">
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
                    <button type="submit" title="Setujui yang dicentang" name="submit_form"
                        id="submit_form" class="btn btn-success" value="1">Accept Checked</button>
                    <button type="submit" title="Tolak yang dicentang" name="submit_form"
                        id="submit_form" class="btn btn-danger" value="0">Decline Checked</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Accept-->
<div class="modal fade" id="accModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Persetujuan</h4>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menyetujui?</p>
            </div>
            <div class="modal-footer">
                <form action="<?php echo base_url() . 'akademik/proyek/accept' ?>" method="post">
                    <input type="hidden" name="id_proyek" id="id_proyek" value="">
                    <button type="submit" class="btn btn-success">Setujui</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Decline-->
<div class="modal fade" id="declModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Persetujuan</h4>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menolak?</p>
            </div>
            <div class="modal-footer">
                <form action="<?php echo base_url() . 'akademik/proyek/decline' ?>" method="post">
                    <input type="hidden" name="id_proyek" id="id_proyek" value="">
                    <button type="submit" class="btn btn-danger">Tolak</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Accept Checked-->
<div class="modal fade" id="accModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Persetujuan</h4>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menyetujui?</p>
            </div>
            <div class="modal-footer">
                <form action="<?php echo base_url() . 'akademik/proyek/accept' ?>" method="post">
                    <input type="text" name="id_proyek" id="id_proyek" value="">
                    <button type="submit" class="btn btn-success">Setujui</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on("click", "#accept_modal", function () {
        var id_proyek = $(this).data('id');
        $(".modal-footer #id_proyek").val(id_proyek);
    });
    $(document).on("click", "#decline_modal", function () {
        var id_proyek = $(this).data('id');
        $(".modal-footer #id_proyek").val(id_proyek);
    });
    $(function () {
        $('#tabel').DataTable({
            'paging' : true,
            'lengthChange' : true,
            'searching' : true,
            'ordering' : false,
            'info' : true,
            'autoWidth' :true
        })
    })
</script>