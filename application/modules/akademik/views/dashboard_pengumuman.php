<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Pengumuman
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
                <a href="adduser.html">
                    <a href="<?php echo base_url() ?>akademik/pengumuman/add_form" class="btn btn-success pull-right" style="margin-bottom: 2%"><i class="fa fa-plus"></i> Buat Pengumuman</button>
                    </a>
                    <table id="datatable" class="table table-striped table-bordered dt-responsive bulk_action" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="col-md-3">Judul Pengumuman</th>
                                <th class="col-md-1">Detail</th>
                                <th class="col-md-1">Dibuat pada:</th>
                                <th class="col-md-1">Terupdate pada:</th>
                                <th class="col-md-3">Lampiran</th>
                                <th class="col-md-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i=1;
                                foreach($dataTable as $data) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $data->judul; ?>
                                </td>
                                <td align="center">
                                    <a class="btn btn-sm btn-default" data-toggle='modal' id="see_modal" data-target='#seeModal<?php echo $data->id_pengumuman; ?>'>
                                        Lihat
                                    </a>
                                </td>
                                <div class="modal fade" id="seeModal<?php echo $data->id_pengumuman; ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Lihat Isi Pengumuman</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p align="center"><b><?php echo $data->judul ?></b></p>
                                                <br>
                                                <br>
                                                <p id="teks">
                                                    <?php echo $data->deskripsi;?>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <td>
                                    <?php echo $data->createdDtm; ?>
                                </td>
                                <td>
                                    <?php echo $data->updatedDtm; ?>
                                </td>
                                <td>
                                    <?php echo (isset($data->lampiran) ? "<a target=\"_blank\" href=\"" . base_url() . "uploads/data_pengumuman/" . $data->lampiran . "\">" . explode('-', $data->lampiran)[1] . "</a>" : "Tidak ada lampiran");?>
                                </td>
                                <td>
                                    <a href="<?php echo base_url()?>akademik/pengumuman/edit_form/<?php echo $data->id_pengumuman ?>" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn-danger" data-toggle='modal' id="delete_modal" data-target='#deleteModal<?php echo $data->id_pengumuman;?>'>
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                                <div class="modal fade" id="deleteModal<?php echo $data->id_pengumuman; ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Hapus Pengumuman</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah anda yakin ingin menghapus pengumuman ini?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="<?php echo base_url() . 'akademik/pengumuman/delete' ?>" method="post">
                                                    <input type="hidden" name="id_p" id="id_p" value="<?php echo $data->id_pengumuman; ?>">
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <!-- <script>
        $(document).on("click", "#see_modal", function () {
            var id_pengumuman = $(this).data('id');
            $(".modal-body #teks").val(id_pengumuman);
        });
    </script> -->
</div>

<!-- /page content -->