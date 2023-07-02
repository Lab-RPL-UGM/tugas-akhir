<?php
/**
 * Created by nad.
 * Date: 22/03/2018
 * Time: 22:26
 * Description:
 */
//var_dump($proyekInfo)
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Project Management</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <!--berkas mahasiswa-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Daftar Seluruh Proyek<small></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12">
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
                    <a href="<?php echo base_url()?>dosen/proyek/addNew" class="btn btn-success pull-right">Add New Project</a>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Judul Proyek</th>
                            <th>Penanggung Jawab</th>
                            <th>Instansi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!empty($proyekInfo))
                            {
                            foreach($proyekInfo as $record)
                            {
                        ?>
                        <tr>
                            <td><?php echo $record->nama_proyek ?></td>
                            <td><?php echo $record->nama_dosen ?></td>
                            <td><?php echo $record->klien ?></td>

                            <?php if ($record->status == 'disetujui') {
                                echo "<td><span class=\"label label-success\">" . $record->status . "</span></td>";
                            } elseif ($record->status == 'pending') {
                                echo "<td><span class=\"label label-warning\">" . $record->status . "</span></td>";
                            } else {
                                echo "<td><span class=\"label label-danger\">" . $record->status . "</span></td>";
                            }
                            ?>
                            <td>
                                <a href="<?php echo base_url() ?>dosen/proyek/editOld/<?php echo $record->id_proyek?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
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