<?php
/**
 * Created by nad.
 * Date: 26/03/2018
 * Time: 21:14
 * Description:
 */
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Persetujuan Sidang</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <!--berkas mahasiswa-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Daftar Mahasiswa Mengajukan<small></small></h2>
                    <div class="clearfix"></div>
                    <div class="row">
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

                            <div class="row">
                                <div class="col-md-12">
                                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Tanggal Daftar</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Tanggal Uji</th>
                            <th>Status</th>
                            <th>Detail</th>
                            <th>Plot Jadwal</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!empty($sidangInfo))
                        {
                            foreach($sidangInfo as $record)
                            {
                                ?>
                                <tr>
                                    <td><?php echo date_format(date_create_from_format('Y-m-d',substr($record->createdDtm,0,10)), 'd/m/Y') ?></td>
                                    <td><?php echo $record->nim ?></td>
                                    <td><?php echo $record->nama ?></td>
                                    <td>
                                        <?php if ($record->tanggal!=null){?>
                                            <?php echo date_format(date_create_from_format('Y-m-d',$record->tanggal), 'd/m/Y'); ?>
                                        <?php }else{?>
                                            <span>-</span>
                                        <?php }?>
                                    </td>
                                    <?php if ($record->status == 'disetujui') {
                                        echo "<td><span class=\"label label-info\">" . $record->status . "</span></td>";
                                    } elseif ($record->status == 'pending') {
                                        echo "<td><span class=\"label label-warning\">" . $record->status . "</span></td>";
                                    } elseif ($record->status == 'lulus' || $record->status == 'lulus_revisi') {
                                        echo "<td><span class=\"label label-success\">" . $record->status . "</span></td>";
                                    } else {
                                        echo "<td><span class=\"label label-danger\">" . $record->status . "</span></td>";
                                    }
                                    ?>
                                    <td>
                                        <a href="<?php echo base_url() ?>akademik/sidang/detail/<?php echo $record->id_sidang?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    </td>
                                    <td>
                                        <?php if ($record->status == 'disetujui'){?>
                                            <?php if ($record->tanggal == null){?>
                                                <a href="<?php echo base_url() ?>akademik/sidang/plot/<?php echo $record->id_sidang?>" class="btn btn-info">
                                                    <i class="fa fa-clock-o"></i>
                                                </a>
                                            <?php }else{?>
                                                <a href="<?php echo base_url() ?>akademik/sidang/editplot/<?php echo $record->id_sidang?>" class="btn btn-info">
                                                    <i class="fa fa-clock-o"></i>
                                                </a>
                                            <?php }?>
                                        <?php }elseif ($record->status == 'pending'){?>
                                            <?php if ($record->tanggal == null){?>
                                                <a href="<?php echo base_url() ?>akademik/sidang/plot/<?php echo $record->id_sidang?>" class="btn btn-info">
                                                    <i class="fa fa-clock-o"></i>
                                                </a>
                                            <?php }else{?>
                                                <a href="<?php echo base_url() ?>akademik/sidang/editplot/<?php echo $record->id_sidang?>" class="btn btn-info">
                                                    <i class="fa fa-clock-o"></i>
                                                </a>
                                            <?php }?>
                                        <?php }else{?>
                                            Sudah sidang
                                        <?php }?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function () {
    $('#datatable').DataTable({
        'paging' : true,
        'lengthChange' : true,
        'searching' :true,
        'ordering' : false,
        'info' : true,
        'autoWidth' : true
    })
})
</script>