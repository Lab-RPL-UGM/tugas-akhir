<?php

/**
 * Created by nad.
 * Date: 22/03/2018
 * Time: 12:48
 * Description:
 */
//var_dump($periodeInfo)
?>
<?php
$pilihan = array();
//diset null karna untuk pilihan ke tiga
$proyek = array();
$id_pengajuan_ta = array();
$id_usulan = '';
$judul = '';
$deskripsi = '';
$bisnis_rule = '';
$arr_jenis = array();
//cek jenis khusus inputan ke-3
$jenis = '';
// get periode
$periode = '';
$awal = '';
$akhir = '';
$id_periode = '';

// active pane saat edit form
$active_proyek = 0;
$active_usulan = 0;

//get date_now
$date_now = date("Y-m-d");

if (!empty($periodeInfo)) {
    foreach ($periodeInfo as $uf) {
        $awal = $uf->tgl_awal_regis_ta;
        $akhir = $uf->tgl_akhir_regis_ta;
        $periode = $uf->status_periode;
        $id_periode = $uf->id_periode;
    }
}

if (!empty($taInfo)) {
    $i = 0;
    $p = 0;
    foreach ($taInfo as $record) {
        if ($record->jenis == "proyek") {
            $pilihan[$p] = $record->pilihan;
            $id_pengajuan_ta[$p] = $record->id_pengajuan_ta;
            $arr_jenis[$i] = $record->jenis;
            // apabila jenis pilihannya = proyek
            $proyek[$p] = $record->id_proyek;
            $p++;
        } else {
            // apabila jenis pilihannya = usulan
            // langsung dikasih indeks yang ke-3 (array mulai dari 0) karna tempatnya adalah dipaling bawah/pilihan ke-3
            $pilihan[$p] = $record->pilihan;
            $id_usulan = $record->id_usulan;
            $id_pengajuan_ta[$p] = $record->id_pengajuan_ta;
            $arr_jenis[$i] = $record->jenis;

            $judul = $record->judul;
            $deskripsi = $record->deskripsi;
            $bisnis_rule = $record->bisnis_rule;
        }
        $i++;
    }
    foreach ($arr_jenis as $value) {
        if ($value == "usul") {
            $active_proyek = 0;
            $active_usulan = 1;
            $jenis = 'usul';
            break;
        } else {
            $active_proyek = 1;
            $jenis = 'proyek';
        }
    }
}
// var_dump($arr_jenis);
// echo "pilihan \n";
// var_dump($pilihan);
// echo "proyek \n";
// var_dump($proyek);
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Tugas Akhir</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <center>
                        <h3>
                            <strong> <?= $taTerplotting['judul_ta'] ?> </strong>
                        </h3>
                        <h5>Dosen Pembimbing <strong><?= $taDosbing[0]->nama ?> <?= (isset($taDosbing[1]->nama)) ? " dan " . $taDosbing[1]->nama : "" ?></strong></h5>
                        <?php if (isset($taTerplotting['file'])) { ?>
                            <h5>Proposal Usulan <strong><a target="_blank" href="<?php echo base_url(); ?>uploads/persetujuan/<?php echo $taTerplotting['file']; ?>"><?php echo $taTerplotting['file'] ?></strong></a></h5>
                            <h5>Mitra <strong><?= $taTerplotting['mitra'] ?></strong></h5>
                        <?php } ?>
                        <h5>Progress <strong><?= $taTerplotting['progress'] ?>%</strong></h5>
                        <?php if (isset($taTerplotting['file'])) { ?>
                            <h5>Deskripsi Usulan <br> <strong><?= $taTerplotting['deskripsi'] ?></strong></h5>
                        <?php } ?>
                    </center>
                    <br>

                    <table id="datatable-nopage" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Ke</th>
                                <th>Tanggal</th>
                                <th>Subject</th>
                                <th>Deskripsi</th>
                                <th>Catatan Dosen</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($taBimbingan) && count($taBimbingan) > 0) {
                                foreach ($taBimbingan as $kBimbingan => $vBimbingan) { ?>
                                    <tr>
                                        <td><?= $kBimbingan + 1 ?></td>
                                        <td><?= date('d-m-Y H:i', strtotime($vBimbingan->created_at)) ?></td>
                                        <td><?= $vBimbingan->subject ?></td>
                                        <td><?= $vBimbingan->description ?></td>
                                        <td><?= $vBimbingan->reason ?></td>
                                        <td>
                                            <?php echo (isset($vBimbingan->file) ? "<a target=\"_blank\" href=\"" . base_url() . "uploads/data_bimbingan/" . $vBimbingan->file . "\">" . $vBimbingan->file . "</a>" : "Tidak ada lampiran"); ?>
                                        </td>
                                        <td><?= ucfirst($vBimbingan->status) ?></td>
                                        <td>
                                            <?= ($taDosbing[0]->id_user == $dosenId && $vBimbingan->reason == null) ? '<a data-toggle="modal" data-target="#progressBimbingan" data-id_bimbingan="' . $vBimbingan->id . '" data-subject="' . $vBimbingan->subject . '" data-description="' . $vBimbingan->description . '" type="button" class="modalProgress btn btn-success"><i class="fa fa-edit"></i> Respon</a>' : "" ?>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                    <a href="<?= base_url() . "dosen/bimbingan" ?>" type="button" class="btn btn-info pull-right">Kembali</a>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Update Bimbingan -->
<div class="modal fade" id="progressBimbingan" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Catatan Bimbingan</h4>
            </div>
            <form action="<?php echo base_url(); ?>dosen/bimbingan/updateProgress" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="x_panel">
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Subject Bimbingan <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="subject" readonly class="form-control col-md-7 col-xs-12" placeholder="Tuliskan subject bimbingan anda">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Deskripsi Bimbingan <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <textarea type="text" id="description" readonly rows="4" class="form-control col-md-7 col-xs-12" placeholder="Tuliskan deskripsi bimbingan anda"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Respon Bimbingan <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <textarea type="text" name="reason" rows="4" class="form-control col-md-7 col-xs-12" placeholder="Tuliskan respon bimbingan mahasiswa"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Progress Bimbingan <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="number" name="progress" rows="4" min="<?php echo $taTerplotting['progress'] ?>" max="100" class="form-control col-md-7 col-xs-12" placeholder="Progress bimbingan mahasiswa">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="status" id="status" value="diterima">
                    <input type="hidden" name="id_bimbingan" id="id_bimbingan">
                    <input type="hidden" name="id_ta" id="id_ta" value=<?php echo $taTerplotting['id_ta'] ?>>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on("click", ".modalProgress", function() {
            var id_bimbingan = $(this).data('id_bimbingan');
            $(".modal-footer #id_bimbingan").val(id_bimbingan);

            var subject = $(this).data('subject');
            $(".modal-body #subject").val(subject);

            var description = $(this).data('description');
            $(".modal-body #description").val(description);
        });

        $("#datatable-nopage_filter").ready(function() {
            $(".dataTables_filter").hide();
        });
    });
</script>