<?php
/**
 * Created by nad.
 * Date: 23/03/2018
 * Time: 07:28
 * Description:
 */
//var_dump($berkasInfo)
?>
<?php
$id_berkas_sidang = '';
$nama_berkas = '';
$id_valid_sidang = '';
$isValid = '';
$path = '';
$id_sidang = '';
$id_mahasiswa = '';
$status = '';

if(!empty($berkasInfo))
{
    foreach ($berkasInfo as $uf)
    {
        $id_berkas_sidang = $uf->id_berkas_sidang;
        $nama_berkas = $uf->nama_berkas;
        $id_valid_sidang = $uf->id_valid_sidang;
        $isValid = $uf->isValid;
        $path = $uf->path;
        $id_sidang = $uf->id_sidang;
        $id_mahasiswa = $uf->id_mahasiswa;
        $status = $uf->status;
    }
}
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Pendaftaran Sidang</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php if ($ta != false){?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="col-md-6">
                        <h2>Penting !<br><small>
                                <ul>
                                    <li>Diwajibkan untuk membaca tata cara pada PENGUMUMAN</li>
                                    <li>Maksimal ukuran berkas 10Mb</li>
                                </ul>
                                <h5 class="badge bg-red">Pastikan Anda telah melengkapi
                                    <a href="<?php base_url()?>../profil" style="color: white"><u>PROFIL</u></a>
                                    dengan benar</h5>
                            </small></h2>
                    </div>
                    <div class="col-md-6">
                        <?php if ($id_sidang == null){?>
                        <form action="<?php echo base_url() ?>mahasiswa/sidang/daftar" method="post" enctype="multipart/form-data" role="form">
                            <input type="hidden" name="total_syarat" value="<?php echo $totalSyarat?>">
                            <input type="hidden" name="id_syarat" value="<?php echo $idBerkas[0]->id_berkas_sidang?>">
                            <input type="hidden" name="id_periode" value="<?php echo $idPeriode[0]->id_periode?>">
                            <input type="submit" class="btn btn-primary pull-right" value="Daftar">
                        </form>
                        <?php }?>
                        <?php if ($status == 'mengulang'){?>
                            <form action="<?php echo base_url() ?>mahasiswa/sidang/daftarUlang" method="post" enctype="multipart/form-data" role="form">
                                <input type="hidden" name="id_periode" value="<?php echo $idPeriode[0]->id_periode?>">
                                <input type="hidden" name="id_sidang_lama" value="<?php echo $berkasInfo[0]->id_sidang?>">
                                <input type="submit" class="btn btn-primary pull-right" value="Daftar Ulang">
                            </form>
                        <?php }?>
                    </div>
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
                    <!--start pane upload-->
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <div id="myTabContent" class="tab-content">
                            <?php
                            if(!empty($berkasInfo))
                                {
                                    foreach($berkasInfo as $record)
                                    {
                            ?>
                                    <!--Pane upload berkas-->
                                    <div role="tabpanel" class="tab-pane fade in" id="tab_content_<?php echo $record->id_valid_sidang ?>" aria-labelledby="usulan">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <strong><h4><?php echo $record->nama_berkas?></h4>
                                                </strong>
                                                <?php echo $record->path ?>
                                            </tr>
                                            <form action="<?php echo base_url();?>mahasiswa/sidang/editBerkas" enctype="multipart/form-data" method="post">
                                                <tr>
                                                    <th colspan="2"><strong>Unggah[*pdf]</strong> <br> Maksimal 10mb</th>
                                                    <th>
                                                        <input type="hidden" value="<?php echo $record->id_mahasiswa?>">
                                                        <input type="hidden" name="total_syarat" value="<?php echo $totalSyarat?>">
                                                        <input value="<?php echo $record->id_berkas_sidang ?>" type="number" name="id_berkas_sidang" hidden>
                                                        <input value="<?php echo $record->id_valid_sidang ?>" type="number" name="id_valid_sidang" hidden>
                                                        <input type="text" name="nama_berkas" value="<?php echo $record->nama_berkas ?>" hidden>
                                                        <input value="<?php echo $record->path ?>" type="file" name="path" class="form-control">
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td colspan="3">
                                                        <input type="submit" class="btn btn-primary btn-sm" value="Save">
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </form>
                                        </table>
                                    </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <!--end pane upload-->
                    <?php if ($status!='mengulang'){?>
                    <table class="table table-bordered">
                        <thead>
                        <tr bgcolor="#67CEA6" style="color: white">
                            <th colspan="4"><h4><strong>Data Berkas Sidang</strong></h4></th>
                        </tr>
                        <tr bgcolor="#59BD96" style="color: white">
                            <th>Aksi</th>
                            <th>Berkas</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!empty($berkasInfo))
                        {
                            foreach($berkasInfo as $record)
                                {
                                ?>
                                <tr>
                                    <td>
                                        <a href="#tab_content_<?php echo $record->id_valid_sidang ?>" id="usulan" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-sm btn-warning">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <?php if ($record->path !=''){?>
                                            <a href="<?php echo base_url()?>uploads/sidang/<?php echo $record->id_berkas_sidang?>/<?php echo $record->path?>" class="btn btn-sm btn-info" target="_blank">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        <?php }?>
                                        <input type="hidden" value="<?php echo $record->id_valid_sidang ?>">
                                    </td>
                                    <td><?php echo $record->nama_berkas ?></td>
                                    <?php if ($record->isValid == '3') {
                                        echo "<td><span class=\"label label-danger\">" . "Ditolak" . "</span></td>";
                                    } elseif ($record->isValid == '2') {
                                        echo "<td><span class=\"label label-success\">" . "Diterima" . "</span></td>";
                                    }elseif ($record->isValid == '1') {
                                        echo "<td><span class=\"label label-warning\">" . "Proses" . "</span></td>";
                                    } else {
                                        echo "<td><span class=\"label label-default\">" . "Belum Diunggah" . "</span></td>";
                                    }
                                    ?>
                                </tr>
                                    <?php
                                }
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php }?>
                    <!--end upload berkas-->
                </div>
                <!--<div class="ln_solid"></div>-->
            </div>
        </div>
    </div>
    <?php }else{?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <center>
                        <h4>
                            <strong>BELUM </strong>DAPAT DAFTAR SIDANG
                        </h4>
                        <br>
                        <h5>Silahkan tunggu informasi selanjutnya</h5>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
</div>
