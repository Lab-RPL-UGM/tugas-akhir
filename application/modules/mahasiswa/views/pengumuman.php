<?php
/**
 * Created by nad.
 * Date: 23/03/2018
 * Time: 08:27
 * Description:
 */
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Pengumuman</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <!--table berkas-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><small>Silahkan unduh berkas yang tersedia</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Judul Pengumuman</th>
                            <th>Tanggal Unggah</th>
                            <th>Lampiran</th>
                            <th>Lihat</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                        foreach($dataTable as $data) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo substr($data->judul,0,15) . "..."; ?>
                                </td>
                                <div class="modal fade" id="seeModal<?php echo $data->id_pengumuman; ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Pengumuman</h4>
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
                                    <?php if ($data->lampiran!=null){?>
                                    <a href="<?php echo base_url()?>uploads/data_pengumuman/<?php echo $data->lampiran?>" target="_blank">
                                        <?php echo (isset($data->lampiran) ?  explode('-', $data->lampiran)[1] : "Tidak ada lampiran");?>
                                    </a>
                                    <?php }else{?>
                                        Tidak ada lampiran
                                    <?php }?>
                                </td>
                                <td align="center">
                                    <a class="btn btn-sm btn-info" title="Lihat" data-toggle='modal' id="see_modal" data-target='#seeModal<?php echo $data->id_pengumuman; ?>'>
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
