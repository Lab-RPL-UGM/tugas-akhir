<?php
/**
 * Created by nad.
 * Date: 23/03/2018
 * Time: 07:28
 * Description:
 */
?>
<?php
$id_berkas_yudisium = '';
$nama_berkas = '';
$id_valid_yudisium = '';
$isValid = '';
$path = '';
$id_yudisium = '';
$id_mahasiswa = '';
$yudisium = '';
// get periode
$periode = '';
$awal = '';
$akhir = '';
$id_periode = '';

//get date_now
$date_now = date("Y-m-d");

if(!empty($periodeInfo))
{
    foreach ($periodeInfo as $uf)
    {
        $awal = $uf->tgl_awal_regis_yudisium;
        $akhir = $uf->tgl_akhir_regis_yudisium;
        $periode = $uf->status_periode;
        $id_periode = $uf->id_periode;
    }
}

if(!empty($berkasInfo))
{
    foreach ($berkasInfo as $uf)
    {
        $id_berkas_yudisium = $uf->id_berkas_yudisium;
        $nama_berkas = $uf->nama_berkas;
        $id_valid_yudisium = $uf->id_valid_yudisium;
        $isValid = $uf->isValid;
        $path = $uf->path;
        $id_yudisium = $uf->id_yudisium;
        $id_mahasiswa = $uf->id_mahasiswa;
    }
}
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Pendaftaran Yudisium</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php if ($sidang!=false){?>
    <!--    validasi berdasarkan periode-->
        <?php if ($periode == 1 && $date_now >= $awal && $date_now <= $akhir && $sidang[0]->id_mahasiswa != null){?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="col-md-6">
                            <h2>Penting !<br><small>
                                    <ul>
                                        <li>Diwajibkan untuk membaca tata cara pada PENGUMUMAN.</li>
                                        <br>
                                        <li>Maksimal ukuran berkas 10Mb</li>
                                    </ul>
                                    <h5 class="badge bg-red">Pastikan Anda telah melengkapi
                                    <a href="<?php base_url()?>../profil" style="color: white"><u>PROFIL</u></a>
                                    dengan benar</h5>
                                </small></h2>
                        </div>
                        <div class="col-md-6">
                            <?php if ($id_yudisium == null){?>
                                <form action="<?php echo base_url() ?>mahasiswa/yudisium/daftar" method="post" enctype="multipart/form-data" role="form">
                                    <input type="hidden" name="id_periode" value="<?php echo $id_periode?>">
                                    <input type="hidden" name="total_syarat" value="<?php echo $totalSyarat?>">
                                    <input type="hidden" name="id_syarat" value="<?php echo $idBerkas[0]->id_berkas_yudisium?>">
                                    <input type="submit" class="btn btn-primary pull-right" value="Daftar">
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
                                        <div role="tabpanel" class="tab-pane fade in" id="tab_content_<?php echo $record->id_valid_yudisium ?>" aria-labelledby="usulan">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <strong><h4><?php echo $record->nama_berkas?></h4>
                                                    </strong>
                                                    <?php echo $record->path ?>
                                                </tr>
                                                <form action="<?php echo base_url();?>mahasiswa/yudisium/editBerkas" enctype="multipart/form-data" method="post">
                                                    <tr>
                                                        <th colspan="2"><strong>Unggah[*pdf]</strong> <br> Maksimal 10mb</th>
                                                        <th>
                                                            <input type="hidden" value="<?php echo $record->id_mahasiswa?>">
                                                            <input type="hidden" name="total_syarat" value="<?php echo $totalSyarat?>">
                                                            <input value="<?php echo $record->id_berkas_yudisium ?>" type="number" name="id_berkas_yudisium" hidden>
                                                            <input value="<?php echo $record->id_valid_yudisium ?>" type="number" name="id_valid_yudisium" hidden>
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
                        <table class="table table-bordered">
                            <thead>
                            <tr bgcolor="#67CEA6" style="color: white">
                                <th colspan="4"><h4><strong>Data Berkas Yudisium</strong></h4></th>
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
                                            <a href="#tab_content_<?php echo $record->id_valid_yudisium ?>" id="usulan" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-sm btn-warning">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <?php if ($record->path !=''){?>
                                                <a href="<?php echo base_url()?>uploads/yudisium/<?php echo $record->id_berkas_yudisium?>/<?php echo $record->path?>" class="btn btn-sm btn-info" target="_blank">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            <?php }?>
                                            <input type="hidden" value="<?php echo $record->id_valid_yudisium ?>">
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
                        <!--end upload berkas-->
                    </div>
                    <!--<div class="ln_solid"></div>-->
                </div>
            </div>
        </div>
        <?php }?>
    <?php } else {?>
        <!--    end validasi berdasarkan periode-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <center>
                            <h4>
                                <strong>BUKAN PERIODE </strong>PENDAFTARAN YUDISIUM
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

