<?php
/**
 * Created by nad.
 * Date: 23/03/2018
 * Time: 07:31
 * Description:
 */
?>
<?php
$path = '';

if(!empty($revisiInfo))
{
    foreach ($revisiInfo as $uf)
    {
        $path = $uf->path;
    }
}
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><a href="<?php echo base_url()?>dosen/pendadaran"><i class="fa fa-chevron-left"></i></a> &nbsp;Sidang Pendadaran</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <!--berkas mahasiswa-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Form Penilaian</h2>
                    <div class="clearfix" style="margin-top: -5%"></div>
                    <div class="row well">
                        <div class="col-md-6">
                            <strong>PENILAIAN</strong>
                            <ul>
                                <li>Nilai harus 3 digit</li>
                                <li>Nilai tidak boleh lebih dari 4.00</li>
                                <li>Nilai wajib diisi semua</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <strong>REVISI</strong>
                            <ul>
                                <li>Simpan Laporan Tugas Akhir(.pdf) yang telah diberi pesan revisi, lalu unggah</li>
                            </ul>
                            <?php if (!empty($ketuaInfo) && $nilaiInfo[0]->nilai_akhir_dosen!=0.00){?>
                            <strong>HASIL AKHIR</strong>
                            <ul>
                                <li>Tentukan hasil akhir setelah semua anggota sidang memberi penilaian</li>
                            </ul>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="x_content">
                    <p class="col-md-12 product_price"><strong>Penilaian : </strong>
                        <span class="badge bg-red">1</span> Kurang
                        <span class="badge bg-orange">2</span> Cukup
                        <span class="badge bg-green">3</span> Baik
                        <span class="badge bg-blue">4</span> Sangat Baik
                    </p>
                    <div class="col-md-6">
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
                        <!--table nilai-->
                        <table class="table table-bordered">
                            <thead>
                            <tr bgcolor="#67CEA6" style="color: white">
                                <th colspan="4"><h4><strong>Data Penilaian</strong></h4></th>
                            </tr>
                            <tr bgcolor="#59BD96" style="color: white">
                                <th>No</th>
                                <th class="col-md-8">Subject</th>
                                <th>Nilai</th>
                            </tr>
                            </thead>
                            <tbody>
<!--                            form insert nilai when nilai_akhir_sidang-->
                            <?php if ($nilaiInfo[0]->nilai==0.00){?>
                            <form id="formNilai" action="<?php echo base_url()?>dosen/pendadaran/submitnilai" method="post" role="form" data-parsley-validate class="form-horizontal form-label-left">
                                <?php
                                if(!empty($nilaiInfo))
                                {
                                    $i=1;
                                    foreach($nilaiInfo as $record)
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <th><?php echo $record->nama_nilai ?></th>
                                            <td>
                                                <input type="hidden" value="<?php echo $record->id_komponen_nilai?>" name="id_komponen_nilai_<?php echo $i?>" id="id_komponen_nilai_<?php echo $i?>">
                                                <input type="text" class="form-control"
                                                       data-val="true"
                                                       data-inputmask="'mask': '9.99'"
                                                       name="nilai_<?php echo $i?>" id="nilai_<?php echo $i?>">
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }?>
                                    <input type="hidden" name="last_index" value="<?php echo $i?>">
                                <?php
                                }?>
                                <tr>
                                    <td colspan="3">
                                        <a class="btn btn-warning pull-right" data-toggle="modal" data-target="#submit-nilai">Submit</a>
                                    </td>
                                </tr>
                                <input type="hidden" name="nilai_akhir_dosen" value="<?php echo $record->nilai_akhir_dosen?>">
                                <input type="hidden" name="id_penilaian" value="<?php echo $record->id_penilaian?>">
                                <input type="hidden" name="id_sidang" value="<?php echo $record->id_sidang?>">
                                <!--modal submit nilai-->
                                <div id="submit-nilai" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">Penilaian</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div id="testmodal" style="padding: 5px 20px;">
                                                    <div class="modal-body">
                                                        <center>
                                                            <h4>Apakah yakin nilai yang dimasukkan benar?</h4>
                                                            <h6>
                                                                <strong>
                                                                    Nilai wajib 3 digit dan tidak lebih besar dari 4.00
                                                                </strong>
                                                            </h6>
                                                            <div id="testmodal" style="padding: 5px 20px;">
                                                                <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel">
                                                                <input type="submit" class="btn btn-success" value="Submit">
                                                            </div>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php }else{?>
                            <form id="formNilai" action="<?php echo base_url()?>dosen/pendadaran/submitnilai" method="post" role="form" data-parsley-validate class="form-horizontal form-label-left">
                                <?php
                                if(!empty($nilaiInfoEdit))
                                {
                                    $i=1;
                                    foreach($nilaiInfoEdit as $record)
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <th><?php echo $record->nama_nilai ?></th>
                                            <?php if ($record->status=='disetujui'){?>
                                                <td>
                                                    <input type="hidden" value="<?php echo $record->id_komponen_nilai?>" name="id_komponen_nilai_<?php echo $i?>" id="id_komponen_nilai_<?php echo $i?>">
                                                    <input type="text" class="form-control"
                                                           data-val="true"
                                                           data-inputmask="'mask': '9.99'"
                                                           value="<?php echo $record->nilai?>"
                                                           name="nilai_<?php echo $i?>" id="nilai_<?php echo $i?>">
                                                </td>
                                            <?php }else{?>
                                                <td>
                                                    <center><?php echo $record->nilai?></center>
                                                </td>
                                            <?php }?>
                                        </tr>
                                        <?php
                                        $i++;
                                    }?>
                                    <input type="hidden" name="last_index" value="<?php echo $i?>">
                                    <?php
                                }?>
                                <tr>
                                    <td colspan="3">
                                        <?php if ($record->nilai_akhir_dosen == 0){?>
                                            <a class="btn btn-warning pull-right" data-toggle="modal" data-target="#submit-nilai">Submit</a>
                                        <?php }else{?>
                                            <?php if ($record->status=='disetujui'){?>
                                                <a class="btn btn-warning pull-right" data-toggle="modal" data-target="#submit-nilai"><i class="fa fa-edit"></i> Edit</a>
                                            <?php }?>
                                            <center><h4><strong>Total : </strong><?php echo $totalNilaiInfoKetua[0]->total_nilai?></h4></center>
                                        <?php }?>
                                    </td>
                                </tr>
                                <input type="hidden" name="nilai_akhir_dosen" value="<?php echo $record->nilai_akhir_dosen?>">
                                <input type="hidden" name="id_penilaian" value="<?php echo $record->id_penilaian?>">
                                <input type="hidden" name="id_sidang" value="<?php echo $record->id_sidang?>">
                                <!--modal submit nilai-->
                                <div id="submit-nilai" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">Penilaian</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div id="testmodal" style="padding: 5px 20px;">
                                                    <div class="modal-body">
                                                        <center>
                                                            <h4>Apakah yakin nilai yang dimasukkan benar?</h4>
                                                            <h6>
                                                                <strong>
                                                                    Nilai wajib 3 digit dan tidak lebih besar dari 4.00
                                                                </strong>
                                                            </h6>
                                                            <div id="testmodal" style="padding: 5px 20px;">
                                                                <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel">
                                                                <input type="submit" class="btn btn-success" value="Submit">
                                                            </div>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php }?>
                            </tbody>
                        </table>
                        <!--end table nilai-->
                    </div>
                    <div class="col-md-6">
                        <!--table revisi-->
                        <table class="table table-bordered">
                            <thead>
                            <tr bgcolor="#59BD96" style="color: white">
                                <th colspan="4"><h4><strong>Unggah Revisi Laporan</strong></h4></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="3">
                                    <form id="formRevisi" action="<?php echo base_url()?>dosen/pendadaran/submitrevisi" enctype="multipart/form-data" method="post" role="form" data-parsley-validate class="form-horizontal form-label-left">
                                        <?php if ($ketuaInfo!=null){?>
                                        <input type="hidden" name="nama_dosen_revisi" value="<?php echo $ketuaInfo[0]->nama?>">
                                        <?php }elseif ($sekreInfo!=null){?>
                                        <input type="hidden" name="nama_dosen_revisi" value="<?php echo $sekreInfo[0]->nama?>">
                                        <?php }elseif ($anggotaInfo!=null){?>
                                        <input type="hidden" name="nama_dosen_revisi" value="<?php echo $anggotaInfo[0]->nama?>">
                                        <?php }?>
                                        <input type="hidden" name="id_penilaian" value="<?php echo $record->id_penilaian?>">
                                        <input type="hidden" name="id_mahasiswa" value="<?php echo $record->id_mahasiswa?>">
                                        <input type="hidden" name="id_sidang" value="<?php echo $record->id_sidang?>">
                                        <input type="hidden" name="id_anggota_sidang" value="<?php echo $record->id_anggota_sidang?>">
                                        <input type="file" class="form-control" name="path">
                                        <?php if ($path != ""){?>
                                        <a href="<?php echo base_url()?>uploads/revisi_sidang/<?php echo $path?>" class="btn btn-info" style="margin-top: 3%" download>
                                            <i class="fa fa-save"></i>
                                        </a>
                                        <?php }?>
                                        <button class="btn btn-warning pull-right" style="margin-top: 3%" type="submit">Submit</button>
<!--                                        <input class="btn btn-warning pull-right" style="margin-top: 3%" type="submit">-->
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!--end table nilai-->
                        <?php if (!empty($ketuaInfo) && $nilaiInfo[0]->nilai_akhir_dosen!=0.00){?>
                        <div class="">
                            <table class="table table-bordered">
                                <thead>
                                <tr bgcolor="#67CEA6" style="color: white">
                                    <th colspan="6"><h4><strong>Hasil Akhir</strong></h4></th>
                                </tr>
                                <tr bgcolor="#59BD96" style="color: white">
                                    <th class="col-md-6" colspan="2">Peran</th>
                                    <th class="col-md-6" colspan="2">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($penilaianInfo)) {
                                    foreach ($penilaianInfo as $record) {
                                        ?>
                                        <tr>
                                            <td colspan="2"><?php echo $record->role?></td>
                                            <td colspan="2"><?php echo $record->sum_nilai?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="6">
                                        <h5><strong><center>Total Akhir</center></strong></h5>
                                    </th>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h3>
                                            <strong>
                                                <center>
                                                    <?php if($penilaianRataInfo[0]->avg_nilai >= 3.75){?>
                                                    A
                                                    <?php } elseif($penilaianRataInfo[0]->avg_nilai < 3.75 && $penilaianRataInfo[0]->avg_nilai >= 3.50){?>
                                                    A-
                                                    <?php } elseif($penilaianRataInfo[0]->avg_nilai < 3.50 && $penilaianRataInfo[0]->avg_nilai >= 3.25){?>
                                                    A/B
                                                    <?php } elseif($penilaianRataInfo[0]->avg_nilai < 3.25 && $penilaianRataInfo[0]->avg_nilai >= 3.00){?>
                                                    B+
                                                    <?php } elseif($penilaianRataInfo[0]->avg_nilai < 3.00 && $penilaianRataInfo[0]->avg_nilai >= 2.75){?>
                                                    B
                                                    <?php } elseif($penilaianRataInfo[0]->avg_nilai < 2.75 && $penilaianRataInfo[0]->avg_nilai >= 2.50){?>
                                                    B-
                                                    <?php } elseif($penilaianRataInfo[0]->avg_nilai < 2.50 && $penilaianRataInfo[0]->avg_nilai >= 2.25){?>
                                                    B/C
                                                    <?php } elseif($penilaianRataInfo[0]->avg_nilai < 2.25 && $penilaianRataInfo[0]->avg_nilai >= 2.00){?>
                                                    C+
                                                    <?php } elseif($penilaianRataInfo[0]->avg_nilai < 2.00 && $penilaianRataInfo[0]->avg_nilai >= 1.75){?>
                                                    C
                                                    <?php } elseif($penilaianRataInfo[0]->avg_nilai < 1.75 && $penilaianRataInfo[0]->avg_nilai >= 1.50){?>
                                                    C-
                                                    <?php } else {?>
                                                    Tidak Lulus
                                                    <?php }?>
                                                </center>
                                            </strong>
                                        </h3>
                                    </td>
                                    <td colspan="2">
                                        <h3><strong>
                                                <center>
                                                    <?php echo substr($penilaianRataInfo[0]->avg_nilai,0,4)?>
                                                </center>
                                            </strong>
                                        </h3>
                                    </td>
                                </tr>
                                <?php if ($nilaiInfo[0]->status=='disetujui'){?>
                                <tr>
                                    <td colspan="6">
                                        <h5><strong><center>Penentuan</center></strong></h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4">
                                        <h3><strong>
                                                <center>
                                                    <a class="btn btn-primary" data-toggle="modal" data-target="#mengulang">Mengulang</a>
                                                </center>
                                            </strong>
                                        </h3>
                                    </td>
                                    <td class="col-md-4">
                                        <h3><strong>
                                                <center>
                                                    <a class="btn btn-primary" data-toggle="modal" data-target="#lulus_revisi">Lulus Revisi</a>
                                                </center>
                                            </strong>
                                        </h3>
                                    </td>
                                    <td class="col-md-4">
                                        <h3><strong>
                                                <center>
                                                    <a class="btn btn-primary" data-toggle="modal" data-target="#lulus">Lulus</a>
                                                </center>
                                            </strong>
                                        </h3>
                                    </td>
                                </tr>
                                <?php }?>
                                <?php if ($nilaiInfo[0]->status!='disetujui'){?>
                                <?php if ($nilaiInfo[0]->status=='lulus'){?>
                                <tr>
                                    <td colspan="3">
                                        <h3><strong>
                                                <center>
                                                    Lulus
                                                </center>
                                            </strong>
                                        </h3>
                                    </td>
                                </tr>
                                <?php }elseif ($nilaiInfo[0]->status=='lulus_revisi'){?>
                                    <tr>
                                        <td colspan="3">
                                            <h3><strong>
                                                    <center>
                                                        Lulus dengan Revisi
                                                    </center>
                                                </strong>
                                            </h3>
                                        </td>
                                    </tr>
                                <?php }else{?>
                                    <tr>
                                        <td colspan="3">
                                            <h3><strong>
                                                    <center>
                                                        Mengulang
                                                    </center>
                                                </strong>
                                            </h3>
                                        </td>
                                    </tr>
                                <?php }?>
                                <?php }?>
                                </tfoot>
                            </table>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--modal-->
<div id="lulus" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    <center>
                        <strong>PENILAIAN FINAL</strong>
                    </center>
                </h4>
            </div>
            <div class="modal-body">
                <div id="testmodal" style="padding: 5px 20px;">
                    <div class="modal-body">
                        <center>
                            <h4>Mahasiswa LULUS ?</h4>
                            <h5>Pastikan semua anggota sidang telah mengisi nilai</h5>
                            <h5><strong>Data tidak dapat diubah, jika telah memilih  tombol <i>Yes</i></strong></h5>
                            <div id="testmodal" style="padding: 5px 20px;">
                                <form action="<?php echo base_url() ?>dosen/pendadaran/submitPenentuanLulus" method="post" enctype="multipart/form-data" role="form">
                                    <input type="button" class="btn btn-danger" data-dismiss="modal" value="No">
                                    <input type="hidden" name="id_mahasiswa" value="<?php echo $nilaiInfo[0]->id_mahasiswa?>">
                                    <input type="hidden" name="nilai" value="<?php echo $penilaianRataInfo[0]->avg_nilai?>">
                                    <input type="hidden" name="id_penilaian" value="<?php echo $nilaiInfo[0]->id_penilaian?>">
                                    <input type="hidden" name="id_sidang" value="<?php echo $nilaiInfo[0]->id_sidang?>">
                                    <input type="submit" class="btn btn-success" value="Yes">
                                </form>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="lulus_revisi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    <center>
                        <strong>PENILAIAN FINAL</strong>
                    </center>
                </h4>
            </div>
            <div class="modal-body">
                <div id="testmodal" style="padding: 5px 20px;">
                    <div class="modal-body">
                        <center>
                            <h4>Mahasiswa LULUS dengan REVISI ?</h4>
                            <h5>Pastikan semua anggota sidang telah mengisi nilai</h5>
                            <h5><strong>Data tidak dapat diubah, jika telah memilih  tombol <i>Yes</i></strong></h5>
                            <div id="testmodal" style="padding: 5px 20px;">
                                <form action="<?php echo base_url() ?>dosen/pendadaran/submitPenentuanLulusRevisi" method="post" enctype="multipart/form-data" role="form">
                                    <input type="button" class="btn btn-danger" data-dismiss="modal" value="No">
                                    <input type="hidden" name="id_mahasiswa" value="<?php echo $nilaiInfo[0]->id_mahasiswa?>">
                                    <input type="hidden" name="nilai" value="<?php echo $penilaianRataInfo[0]->avg_nilai?>">
                                    <input type="hidden" name="id_penilaian" value="<?php echo $nilaiInfo[0]->id_penilaian?>">
                                    <input type="hidden" name="id_sidang" value="<?php echo $nilaiInfo[0]->id_sidang?>">
                                    <input type="submit" class="btn btn-success" value="Yes">
                                </form>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="mengulang" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    <center>
                        <strong>PENILAIAN FINAL</strong>
                    </center>
                </h4>
            </div>
            <div class="modal-body">
                <div id="testmodal" style="padding: 5px 20px;">
                    <div class="modal-body">
                        <center>
                            <h4>Mahasiswa MENGULANG ?</h4>
                            <h5>Pastikan semua anggota sidang telah mengisi nilai</h5>
                            <h5><strong>Data tidak dapat diubah, jika telah memilih  tombol <i>Yes</i></strong></h5>
                            <div id="testmodal" style="padding: 5px 20px;">
                                <form action="<?php echo base_url() ?>dosen/pendadaran/submitPenentuanUlang" method="post" enctype="multipart/form-data" role="form">
                                    <input type="button" class="btn btn-danger" data-dismiss="modal" value="No">
                                    <input type="hidden" name="id_mahasiswa" value="<?php echo $nilaiInfo[0]->id_mahasiswa?>">
                                    <input type="hidden" name="nilai" value="<?php echo $penilaianRataInfo[0]->avg_nilai?>">
                                    <input type="hidden" name="id_penilaian" value="<?php echo $nilaiInfo[0]->id_penilaian?>">
                                    <input type="hidden" name="id_sidang" value="<?php echo $nilaiInfo[0]->id_sidang?>">
                                    <input type="submit" class="btn btn-success" value="Yes">
                                </form>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jquery.inputmask -->
<script src="<?php echo base_url()?>elusistatic/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>