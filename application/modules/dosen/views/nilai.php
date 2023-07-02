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

if (!empty($revisiInfo)) {
    foreach ($revisiInfo as $uf) {
        $path = $uf->path;
    }
}
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><a href="<?php echo base_url() ?>dosen/pendadaran"><i class="fa fa-chevron-left"></i></a> &nbsp;Sidang Pendadaran</h3>
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
                            <strong>REVISI</strong>
                            <ul>
                                <li>Simpan Laporan Tugas Akhir(.pdf) yang telah diberi pesan revisi, lalu unggah</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="x_content">
                    <?php
                    if (!empty($nilaiInfoEdit)) {
                        $i = 1;
                        foreach ($nilaiInfoEdit as $record) {
                    ?>
                        <?php
                            $i++;
                        } ?>
                    <?php
                    } ?>
                    <div class="col-md-6">
                        <!--table revisi-->
                        <table class="table table-bordered">
                            <thead>
                                <tr bgcolor="#59BD96" style="color: white">
                                    <th colspan="4">
                                        <h4><strong>Unggah Revisi Laporan</strong></h4>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        <form id="formRevisi" action="<?php echo base_url() ?>dosen/pendadaran/submitrevisi" enctype="multipart/form-data" method="post" role="form" data-parsley-validate class="form-horizontal form-label-left">
                                            <?php if ($ketuaInfo != null) { ?>
                                                <input type="hidden" name="nama_dosen_revisi" value="<?php echo $ketuaInfo[0]->nama ?>">
                                            <?php } elseif ($sekreInfo != null) { ?>
                                                <input type="hidden" name="nama_dosen_revisi" value="<?php echo $sekreInfo[0]->nama ?>">
                                            <?php } elseif ($anggotaInfo != null) { ?>
                                                <input type="hidden" name="nama_dosen_revisi" value="<?php echo $anggotaInfo[0]->nama ?>">
                                            <?php } ?>
                                            <input type="hidden" name="id_penilaian" value="<?php echo $record->id_penilaian ?>">
                                            <input type="hidden" name="id_mahasiswa" value="<?php echo $record->id_mahasiswa ?>">
                                            <input type="hidden" name="id_sidang" value="<?php echo $record->id_sidang ?>">
                                            <input type="hidden" name="id_anggota_sidang" value="<?php echo $record->id_anggota_sidang ?>">
                                            <input type="file" class="form-control" name="path">
                                            <?php if ($path != "") { ?>
                                                <a href="<?php echo base_url() ?>uploads/revisi_sidang/<?php echo $path ?>" class="btn btn-info" style="margin-top: 3%" download>
                                                    <i class="fa fa-save"></i>
                                                </a>
                                            <?php } ?>
                                            <button class="btn btn-warning pull-right" style="margin-top: 3%" type="submit">Submit</button>
                                            <!--                                        <input class="btn btn-warning pull-right" style="margin-top: 3%" type="submit">-->
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--end table nilai-->
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <thead>
                                <tr bgcolor="#67CEA6" style="color: white">
                                    <th colspan="6">
                                        <h4><strong>Hasil Akhir</strong></h4>
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <?php if ($nilaiInfo[0]->status == 'disetujui') { ?>
                                    <tr>
                                        <td colspan="6">
                                            <h5><strong>
                                                    <center>Penentuan</center>
                                                </strong></h5>
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
                                <?php } ?>
                                <?php if ($nilaiInfo[0]->status != 'disetujui') { ?>
                                    <?php if ($nilaiInfo[0]->status == 'lulus') { ?>
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
                                    <?php } elseif ($nilaiInfo[0]->status == 'lulus_revisi') { ?>
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
                                    <?php } else { ?>
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
                                    <?php } ?>
                                <?php } ?>
                            </tfoot>
                        </table>
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
                            <h5><strong>Data tidak dapat diubah, jika telah memilih tombol <i>Yes</i></strong></h5>
                            <div id="testmodal" style="padding: 5px 20px;">
                                <form action="<?php echo base_url() ?>dosen/pendadaran/submitPenentuanLulus" method="post" enctype="multipart/form-data" role="form">
                                    <input type="button" class="btn btn-danger" data-dismiss="modal" value="No">
                                    <input type="hidden" name="id_mahasiswa" value="<?php echo $nilaiInfo[0]->id_mahasiswa ?>">
                                    <input type="hidden" name="nilai" value="<?php echo $penilaianRataInfo[0]->avg_nilai ?>">
                                    <input type="hidden" name="id_penilaian" value="<?php echo $nilaiInfo[0]->id_penilaian ?>">
                                    <input type="hidden" name="id_sidang" value="<?php echo $nilaiInfo[0]->id_sidang ?>">
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
                            <h5><strong>Data tidak dapat diubah, jika telah memilih tombol <i>Yes</i></strong></h5>
                            <div id="testmodal" style="padding: 5px 20px;">
                                <form action="<?php echo base_url() ?>dosen/pendadaran/submitPenentuanLulusRevisi" method="post" enctype="multipart/form-data" role="form">
                                    <input type="button" class="btn btn-danger" data-dismiss="modal" value="No">
                                    <input type="hidden" name="id_mahasiswa" value="<?php echo $nilaiInfo[0]->id_mahasiswa ?>">
                                    <input type="hidden" name="nilai" value="<?php echo $penilaianRataInfo[0]->avg_nilai ?>">
                                    <input type="hidden" name="id_penilaian" value="<?php echo $nilaiInfo[0]->id_penilaian ?>">
                                    <input type="hidden" name="id_sidang" value="<?php echo $nilaiInfo[0]->id_sidang ?>">
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
                            <h5><strong>Data tidak dapat diubah, jika telah memilih tombol <i>Yes</i></strong></h5>
                            <div id="testmodal" style="padding: 5px 20px;">
                                <form action="<?php echo base_url() ?>dosen/pendadaran/submitPenentuanUlang" method="post" enctype="multipart/form-data" role="form">
                                    <input type="button" class="btn btn-danger" data-dismiss="modal" value="No">
                                    <input type="hidden" name="id_mahasiswa" value="<?php echo $nilaiInfo[0]->id_mahasiswa ?>">
                                    <input type="hidden" name="nilai" value="<?php echo $penilaianRataInfo[0]->avg_nilai ?>">
                                    <input type="hidden" name="id_penilaian" value="<?php echo $nilaiInfo[0]->id_penilaian ?>">
                                    <input type="hidden" name="id_sidang" value="<?php echo $nilaiInfo[0]->id_sidang ?>">
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
<script src="<?php echo base_url() ?>elusistatic/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>