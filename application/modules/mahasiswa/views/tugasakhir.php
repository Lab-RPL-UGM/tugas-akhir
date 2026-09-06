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
// get periode
$periode = '';
$awal = '';
$akhir = '';
$id_periode = '';

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

// dipakai tab ringkasan status di bawah -- status_pengambilan sama untuk semua
// baris pilihan jadi cukup ambil dari yang pertama.
$record = !empty($taInfo) ? $taInfo[0] : null;

// dari controller: kosong kalau belum pernah mendaftar sama sekali, atau berisi
// 1-3 entri (keyed by nomor pilihan) hasil pengajuan yang sudah ada -- dipakai untuk
// pre-fill form Edit di bawah.
$existingPilihan = isset($existingPilihan) ? $existingPilihan : [];

/**
 * Render satu blok "Pilihan ke-n". Dipakai bareng oleh form Daftar (pertama kali,
 * $existingPilihan kosong sehingga semua blok kosong) dan form Edit (pre-filled
 * dari $existingPilihan) supaya keduanya konsisten & tidak duplikat kode/JS.
 */
$renderPilihanBlock = function ($n) use ($dataDosen, $proyekInfo, $existingPilihan) {
    $prefill = isset($existingPilihan[$n]) ? $existingPilihan[$n] : null;
    $jenisBlok = $prefill ? $prefill['jenis'] : 'usul';
    $judulBlok = $prefill ? (string) $prefill['judul'] : '';
    $mitraBlok = $prefill ? (string) $prefill['mitra'] : '';
    $idDosenBlok = $prefill ? $prefill['id_dosen'] : '';
    $idDosen2Blok = ($prefill && !empty($prefill['id_dosen2'])) ? $prefill['id_dosen2'] : '';
    $idProyekBlok = $prefill ? $prefill['id_proyek'] : '';
    $fileLamaBlok = ($prefill && $jenisBlok == 'usul') ? $prefill['file_persetujuan'] : '';
    $tampilkanBlok = ($n == 1) || $prefill;

    $deskripsiAwal = '';
    $toolsAwal = '';
    if ($jenisBlok == 'proyek' && $idProyekBlok && !empty($proyekInfo)) {
        foreach ($proyekInfo as $pr) {
            if ($pr->id_proyek == $idProyekBlok) {
                $deskripsiAwal = $pr->deskripsi;
                $toolsAwal = $pr->tools;
                break;
            }
        }
    }
?>
    <div class="x_panel pilihan-block" id="pilihan-block-<?= $n ?>" data-has-file="<?= $fileLamaBlok ? 1 : 0 ?>" style="<?= $tampilkanBlok ? '' : 'display:none;' ?>">
        <div class="x_title">
            <h4>Pilihan <?= $n ?><?= $n == 1 ? ' <span class="required">*</span>' : ' <small>(opsional)</small>'; ?>
                <?php if ($n > 1) { ?>
                    <button type="button" class="btn btn-xs btn-danger pull-right btn-hapus-pilihan" data-target="<?= $n ?>">Hapus</button>
                <?php } ?>
            </h4>
            <div class="clearfix"></div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default<?= $jenisBlok == 'usul' ? ' active' : '' ?>">
                        <input type="radio" name="jenis_<?= $n ?>" value="usul" class="jenis-radio" data-target="<?= $n ?>" <?= $jenisBlok == 'usul' ? 'checked' : '' ?>> Usul Ide
                    </label>
                    <label class="btn btn-default<?= $jenisBlok == 'proyek' ? ' active' : '' ?>">
                        <input type="radio" name="jenis_<?= $n ?>" value="proyek" class="jenis-radio" data-target="<?= $n ?>" <?= $jenisBlok == 'proyek' ? 'checked' : '' ?>> Pilih Proyek
                    </label>
                </div>
            </div>
        </div>

        <!-- sub-form: usulan sendiri -->
        <div class="usul-fields" id="usul-fields-<?= $n ?>" style="<?= $jenisBlok == 'usul' ? '' : 'display:none;' ?>">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Usulan Judul <span class="required wajib-usul-<?= $n ?>">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="judul_<?= $n ?>" class="form-control" placeholder="Tuliskan judul anda" value="<?= htmlspecialchars($judulBlok, ENT_QUOTES) ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Perusahaan Mitra</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="mitra_<?= $n ?>" class="form-control" placeholder="Nama perusahaan mitra anda (opsional)"><?= htmlspecialchars($mitraBlok, ENT_QUOTES) ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">File Proposal <span class="required wajib-file-<?= $n ?>" <?= $fileLamaBlok ? 'style="display:none;"' : '' ?>>*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="file_persetujuan_<?= $n ?>" class="form-control">
                    <?php if ($fileLamaBlok) { ?>
                        <input type="hidden" name="existing_file_<?= $n ?>" value="<?= htmlspecialchars($fileLamaBlok, ENT_QUOTES) ?>">
                        <p class="help-block">File saat ini: <a target="_blank" href="<?php echo base_url(); ?>uploads/persetujuan/<?= $fileLamaBlok ?>"><?= $fileLamaBlok ?></a>. Kosongkan supaya file lama tetap dipakai.</p>
                    <?php } ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Usulan Dosen Pembimbing Pertama <span class="required wajib-usul-<?= $n ?>">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="dosen_<?= $n ?>" class="form-control dosen1-select" data-target="<?= $n ?>">
                        <option value="">Pilih Dosen pembimbing pertama..</option>
                        <?php foreach ($dataDosen as $data) { ?>
                            <option value="<?php echo $data->id_dosen ?>" <?= ($idDosenBlok == $data->id_dosen) ? 'selected' : '' ?>><?php echo $data->nama; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Usulan Dosen Pembimbing Kedua <small>(opsional)</small></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="dosen2_<?= $n ?>" class="form-control dosen2-select" data-target="<?= $n ?>">
                        <option value="">Pilih Dosen pembimbing kedua..</option>
                        <?php foreach ($dataDosen as $data) { ?>
                            <option value="<?php echo $data->id_dosen ?>" <?= ($idDosen2Blok == $data->id_dosen) ? 'selected' : '' ?>><?php echo $data->nama; ?></option>
                        <?php } ?>
                    </select>
                    <small>Harus berbeda dengan Dosen Pembimbing Pertama</small>
                </div>
            </div>
        </div>

        <!-- sub-form: pilih dari katalog proyek existing -->
        <div class="proyek-fields" id="proyek-fields-<?= $n ?>" style="<?= $jenisBlok == 'proyek' ? '' : 'display:none;' ?>">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul Proyek <span class="required wajib-proyek-<?= $n ?>" style="<?= $jenisBlok == 'proyek' ? '' : 'display:none;' ?>">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="proyek_<?= $n ?>" class="form-control proyek-select" data-target="<?= $n ?>">
                        <option value="">Pilih ..</option>
                        <?php if (!empty($proyekInfo)) {
                            foreach ($proyekInfo as $record2) { ?>
                                <option data-deskripsi="<?= $record2->deskripsi ?>" data-tools="<?= $record2->tools ?>" value="<?php echo $record2->id_proyek ?>" <?= ($idProyekBlok == $record2->id_proyek) ? 'selected' : '' ?>><?php echo $record2->nama_proyek ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea cols="4" readonly class="form-control" id="deskripsi-proyek-<?= $n ?>"><?= htmlspecialchars($deskripsiAwal, ENT_QUOTES) ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tools</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input readonly class="form-control" id="tools-proyek-<?= $n ?>" value="<?= htmlspecialchars($toolsAwal, ENT_QUOTES) ?>">
                </div>
            </div>
        </div>
    </div>
<?php
};
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Tugas Akhir</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <!-- validasi berdasarkan periode-->
    <div class="row">
        <div class="col-md-12">
            <?php
            $this->load->helper('form');
            $error = $this->session->flashdata('error');
            if ($error) {
            ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>
            <?php
            $success = $this->session->flashdata('success');
            if ($success) {
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
    <?php if ($periode == 1 && $date_now >= $awal && $date_now <= $akhir && isset($taTerplotting) && empty($taTerplotting)) { ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x-panel">
                    <?php if (!empty($taInfo)) { ?>
                        <div class="x_panel">
                            <div class="x_title">
                                <h3><strong>STATUS : <?= strtoupper($record->status_pengambilan) ?></strong></h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="tab-content">
                                <!-- <button class="btn btn-warning pull-right"><i class="fa fa-edit"></i> Ganti Judul</button>-->
                                <!-- form info-->
                                <div class="tab-pane active fade in" id="content">
                                    <a class="btn btn-primary pull-right" data-toggle="tab" href="#edit"><i class="fa fa-edit"></i> Edit</a>
                                    <div class="x_content">
                                        <div class="form-group">
                                            <?php
                                            foreach ($taInfo as $record) {
                                                $labelStatus = ($record->status_pengajuan == 'diterima')
                                                    ? '<span class="label label-success">DITERIMA</span>'
                                                    : '<span class="label label-warning">MENUNGGU KEPUTUSAN</span>';
                                                if ($record->jenis == "proyek") {
                                            ?>
                                                    <!--proyek-->
                                                    <div class="row">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pilihan ke-<?= $record->pilihan ?></label>
                                                        <div class="well col-md-8">
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12"><?= $labelStatus ?></div>
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul Proyek</label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                <span>
                                                                    <?php echo $record->nama ?>
                                                                </span>
                                                            </div>
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi Proyek</label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                <span>
                                                                    <?php echo $record->deskripsi_proyek ?>
                                                                </span>
                                                            </div>
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tools Proyek</label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                <span>
                                                                    <?php echo $record->tools ?>
                                                                </span>
                                                            </div>
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Dosen Pembimbing Proyek</label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                <span>
                                                                    <?php echo $record->nama_dosen_proyek ?>
                                                                </span>
                                                            </div>
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                        </div>
                                                    </div>
                                                <?php } else { ?>
                                                    <!--usulan-->
                                                    <div class="row">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pilihan ke-<?= $record->pilihan ?></label>
                                                        <div class="well col-md-8">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12"><?= $labelStatus ?></div>
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Usulan Judul</label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <span><?php echo $record->judul ?></span>
                                                            </div>
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Perusahaan Mitra</label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                <span>
                                                                    <?php echo $record->mitra ?: '(tidak diisi)' ?>
                                                                </span>
                                                            </div>
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">File Proposal</label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <a target="_blank" href="<?php echo base_url(); ?>uploads/persetujuan/<?php echo $record->file_persetujuan; ?>"><?php echo $record->file_persetujuan ?></a>
                                                            </div>
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Usulan Dosen Pembimbing Pertama</label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                <span>
                                                                    <?php echo $record->nama_dosen_usulan ?: '(tidak ditentukan)' ?>
                                                                </span>
                                                            </div>
                                                            <div class="clearfix" style="margin-bottom: 2%"></div>
                                                            <?php if (!empty($record->nama_dosen2_usulan)) { ?>
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Usulan Dosen Pembimbing Kedua</label>
                                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                                    <span><?php echo $record->nama_dosen2_usulan ?></span>
                                                                </div>
                                                                <div class="clearfix" style="margin-bottom: 2%"></div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                            <?php
                                                }
                                            }

                                            ?>
                                            <?php if ($record->status_pengambilan == "revisi") { ?>
                                                <div class="row">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi Revisi</label>
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $record->reason ?></label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- end tab pane-->
                                <div class="tab-pane fade in" id="edit">
                                    <a href="#content" data-toggle="tab" class="btn btn-round btn-primary"><i class="fa fa-chevron-left"></i> Back</a>

                                    <div class="x_content">
                                        <form role="form" id="daftar" action="<?php echo base_url() ?>mahasiswa/pengajuan/edit_ta" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                            <input type="hidden" name="id_periode" value="<?php echo $id_periode ?>">
                                            <input type="hidden" name="id_ta" value="<?php echo isset($id_ta_edit) ? $id_ta_edit : '' ?>">
                                            <center><span class="badge" style="margin-bottom:15px">UBAH PENGAJUAN TUGAS AKHIR</span></center>
                                            <p class="text-center text-muted">Ubah 1 sampai 3 pilihan Anda -- tiap pilihan bebas: pilih proyek yang sudah ada, atau usulkan judul/proyek sendiri.</p>

                                            <div id="pilihan-list">
                                                <?php for ($n = 1; $n <= 3; $n++) {
                                                    $renderPilihanBlock($n);
                                                } ?>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-9 col-md-offset-3">
                                                    <button type="button" id="btn-tambah-pilihan" class="btn btn-default"><i class="fa fa-plus"></i> Tambah Pilihan (maks. 3)</button>
                                                    <input type="submit" class="btn btn-success pull-right" value="Simpan Perubahan">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!--end tab pane-->
                                <!--form edit-->

                                <!-- end tab pane-->
                            </div>
                        </div>
                    <?php } elseif ($taTerplotting) { ?>
                        <!-- start bila sudah terplotting di TA-->
                        <div class="x_panel">
                            <div class="alert alert-warning">
                                <h4><i class="fa fa-warning"></i> PERHATIAN!</h4>
                                Anda telah terplotting pada tugas akhir yang tertera di bawah ini.

                                Jika anda ingin mengubah tugas akhir, anda bisa menekan tombol "Ganti tugas akhir" dengan konsekuensi tugas akhir yang sudah anda ganti akan menjadi nonaktif dan
                                digantikan dengan tugas akhir baru yang telah anda pilih.
                            </div>
                            <h3><strong>STATUS : <span class="label label-success">AKTIF</span></strong></h3>
                            <div class="clearfix"></div>
                            <center>
                                <h4><span class="label label-default">Judul Tugas Akhir</span></h4><br>
                                <h3><?php echo $taTerplotting['judul_ta']; ?></h3><br>
                                <h4><span class="label label-default">Dosen Pembimbing</h4><br>
                                <h3><?php echo $taTerplotting['dosbing']; ?></h3><br>
                            </center>

                            <a data-toggle="modal" data-target="#ubahTA" type="button" class="btn btn-default pull-right"><i class="fa fa-edit"></i> Ganti Tugas Akhir</a>

                        </div>
                        <!-- end bila sudah terplotting di TA-->
                    <?php } else { ?>
                        <div class="x_panel">
                            <?php if (empty($isProfilLengkap)) { ?>
                                <div class="x_title">
                                    <h5 class="badge bg-orange">Pastikan Anda telah melengkapi
                                        <a href="<?php echo base_url() ?>mahasiswa/profil" style="color: white"><u>PROFIL</u></a>
                                        dengan benar sebelum mendaftar
                                    </h5>
                                    <div class="clearfix"></div>
                                </div>
                            <?php } ?>
                            <div class="x_content">
                                <br>
                                <form role="form" id="daftar" action="<?php echo base_url() ?>mahasiswa/pengajuan/daftar_ta" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                    <input type="hidden" name="id_periode" value="<?php echo $id_periode ?>">
                                    <center><span class="badge" style="margin-bottom:15px">DAFTAR TUGAS AKHIR</span></center>
                                    <p class="text-center text-muted">Ajukan 1 sampai 3 pilihan -- tiap pilihan bebas: pilih proyek yang sudah ada, atau usulkan judul/proyek sendiri.</p>

                                    <div id="pilihan-list">
                                        <?php for ($n = 1; $n <= 3; $n++) {
                                            $renderPilihanBlock($n);
                                        } ?>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                            <button type="button" id="btn-tambah-pilihan" class="btn btn-default"><i class="fa fa-plus"></i> Tambah Pilihan (maks. 3)</button>
                                            <input type="submit" class="btn btn-success pull-right" value="Submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php } elseif (isset($taTerplotting) && !empty($taTerplotting)) { ?>
        <!--    end validasi berdasarkan periode-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <center>
                            <h3>
                                <strong> <?= $taTerplotting['judul_ta'] ?> </strong>
                            </h3>
                            <h5>Dosen Pembimbing <strong><?= $taDosbing[0]->nama ?> <?= (isset($taDosbing[1]->nama)) ? " dan " . $taDosbing[1]->nama : "" ?></strong></h5>
                            <h5>Progress <strong><?= $taTerplotting['progress'] ?>%</strong></h5>
                        </center>
                        <br>

                        <a data-toggle="modal" data-target="#tambahBimbingan" type="button" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Bimbingan</a>

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
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <!--    end validasi berdasarkan periode-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <center>
                            <h4>
                                <strong>BUKAN PERIODE </strong>PENDAFTARAN TUGAS AKHIR
                            </h4>
                            <br>
                            <h5>Silahkan tunggu informasi selanjutnya</h5>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<!-- Modal Update Bimbingan -->
<div class="modal fade" id="tambahBimbingan" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Catatan Bimbingan</h4>
            </div>
            <form action="<?php echo base_url(); ?>mahasiswa/pengajuan/updateBimbingan" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="x_panel">
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Subject Bimbingan <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" name="subject" class="form-control col-md-7 col-xs-12" placeholder="Tuliskan subject bimbingan anda">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">File Bimbingan <small>(pdf, opsional)</small>
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <div style="border:2px dashed #E0E0E0">
                                    <input type="file" class="form-control-file" id="file" name="file">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Deskripsi Bimbingan <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <textarea type="text" name="description" rows="4" class="form-control col-md-7 col-xs-12" placeholder="Tuliskan deskripsi bimbingan anda"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="status" id="status" value="pengajuan">
                    <input type="hidden" name="id_ta" id="id_ta" value=<?php echo $taTerplotting['id_ta'] ?>>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Ubah Tanggal Yudisium-->
<div class="modal fade" id="ubahTA" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ganti Tugas Akhir</h4>
            </div>
            <div class="modal-body">
                <center>
                    <h5><strong>Apakah anda yakin ingin mengganti tugas akhir?</strong></h5>
                </center>
            </div>
            <form action="<?php echo base_url(); ?>mahasiswa/pengajuan/setNonaktifTA" method="post">
                <div class="modal-footer">
                    <input type="hidden" name="is_ubah" id="is_ubah" value="1">
                    <input type="hidden" name="judul_ta" id="judul_ta" value="<?php echo $taTerplotting['judul_ta']; ?>">
                    <input type="hidden" name="id_ta" id="id_ta" value=<?php echo $taTerplotting['id_ta'] ?>>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        // ==== Form pendaftaran / edit (1-3 pilihan bebas, usul atau proyek existing) ====
        // Dipakai untuk DUA form yang saling eksklusif di halaman ini (Daftar & Edit --
        // cuma salah satu yang ada di DOM sekaligus, tergantung mahasiswa sudah pernah
        // mendaftar atau belum), jadi logikanya harus berjalan sama baik saat semua blok
        // kosong (Daftar) maupun saat sebagian/semua blok sudah pre-filled (Edit).
        var MAKS_PILIHAN = 3;

        function setRequiredPilihan(n, jenis) {
            var $block = $('#pilihan-block-' + n);
            var sudahAdaFile = $block.data('has-file') == 1;
            var $usul = $('#usul-fields-' + n);
            var $proyek = $('#proyek-fields-' + n);
            if (jenis === 'usul') {
                $usul.show();
                $proyek.hide();
                $usul.find('[name="judul_' + n + '"]').prop('required', true);
                // kalau sudah ada file dari sebelumnya (mode Edit), tidak wajib upload ulang
                $usul.find('[name="file_persetujuan_' + n + '"]').prop('required', !sudahAdaFile);
                $usul.find('[name="dosen_' + n + '"]').prop('required', true);
                $('.wajib-usul-' + n).show();
                $('.wajib-file-' + n).toggle(!sudahAdaFile);
                $proyek.find('[name="proyek_' + n + '"]').prop('required', false);
                $('.wajib-proyek-' + n).hide();
            } else {
                $usul.hide();
                $proyek.show();
                $usul.find('[name="judul_' + n + '"]').prop('required', false);
                $usul.find('[name="file_persetujuan_' + n + '"]').prop('required', false);
                $usul.find('[name="dosen_' + n + '"]').prop('required', false);
                $('.wajib-usul-' + n).hide();
                $('.wajib-file-' + n).hide();
                $proyek.find('[name="proyek_' + n + '"]').prop('required', true);
                $('.wajib-proyek-' + n).show();
            }
        }

        // Blok "Pilihan ke-n" di form Edit ada di dalam tab Bootstrap yang TIDAK aktif
        // secara default (tab "Edit" baru aktif setelah tombolnya diklik) -- selama tab
        // itu belum aktif, jQuery :visible SELALU mengembalikan false untuk semua elemen
        // di dalamnya (ikut ancestor-nya yang display:none), padahal blok itu sendiri
        // sudah kita render/tandai tampil lewat style-nya sendiri. Makanya pengecekan
        // "apakah blok ini tampil" TIDAK BOLEH pakai :visible (ikut status tab) -- harus
        // baca display milik elemennya sendiri saja, supaya benar baik saat tab lagi
        // tersembunyi (baru dibuka pertama kali) maupun sudah aktif.
        function blokTampil(n) {
            return $('#pilihan-block-' + n).css('display') !== 'none';
        }

        // Cari blok tersembunyi PALING KECIL nomornya -- dipakai tombol "+Tambah Pilihan"
        // supaya benar menemukan slot kosong sekalipun bukan urutan buntut (mis. pilihan 1
        // & 3 tampil tapi pilihan 2 sempat dihapus -- kasus nyata di form Edit yang semua
        // blok pre-filled-nya bisa dihapus dalam urutan bebas, bukan cuma dari belakang).
        function cariBlokTersembunyi() {
            for (var i = 1; i <= MAKS_PILIHAN; i++) {
                if (!blokTampil(i)) return i;
            }
            return null;
        }

        function jumlahBlokTampil() {
            var jumlah = 0;
            for (var i = 1; i <= MAKS_PILIHAN; i++) {
                if (blokTampil(i)) jumlah++;
            }
            return jumlah;
        }

        function sinkronkanTombolTambah() {
            if (jumlahBlokTampil() >= MAKS_PILIHAN) {
                $('#btn-tambah-pilihan').hide();
            } else {
                $('#btn-tambah-pilihan').show();
            }
        }

        // init: blok yang tampil ditentukan dari server-render -- 1 untuk Daftar, atau
        // sebanyak pilihan yang sudah ada untuk Edit (bisa 1-3, tidak selalu berurutan
        // penuh dari 1). Blok yang tersembunyi field-nya HARUS dilepas required-nya, karena
        // browser (Chrome dkk) tetap ikut memvalidasi elemen required yang "tidak
        // focusable" itu lalu diam-diam menolak submit tanpa pesan apapun kalau kosong
        // ("not focusable" di console).
        for (var i = 1; i <= MAKS_PILIHAN; i++) {
            if (blokTampil(i)) {
                var jenisAwal = $('input[name="jenis_' + i + '"]:checked').val() || 'usul';
                setRequiredPilihan(i, jenisAwal);
            } else {
                $('#pilihan-block-' + i).find('input, select, textarea').prop('required', false);
            }
        }
        sinkronkanTombolTambah();
        // Mode Edit bisa memuat beberapa blok proyek yang sudah terisi sekaligus --
        // pengecualian harus dihitung sejak awal, jangan menunggu event pertama.
        recomputeProyekExclusion();

        $(document).on('change', '.jenis-radio', function() {
            var n = $(this).data('target');
            setRequiredPilihan(n, $(this).val());
            // pindah ke "Pilih Proyek" baru memunculkan select proyek blok ini --
            // segarkan pengecualian supaya proyek yang sudah dipilih di blok lain
            // langsung ke-disable begitu select ini kelihatan, bukan menunggu event lain.
            recomputeProyekExclusion();
        });

        // Jaring pengaman: tombol Bootstrap (data-toggle="buttons") kadang tidak
        // konsisten memicu event "change" murni di semua browser. Tepat sebelum
        // submit, sinkronkan ulang required untuk semua blok berdasarkan jenis yang
        // BENERAN aktif sekarang -- supaya tidak ada field ke-skip required-nya (atau
        // sebaliknya, field di blok tersembunyi kelupaan masih required).
        $('#daftar input[type=submit]').on('click', function () {
            for (var i = 1; i <= MAKS_PILIHAN; i++) {
                if (blokTampil(i)) {
                    var jenisAktif = $('input[name="jenis_' + i + '"]:checked').val() || 'usul';
                    setRequiredPilihan(i, jenisAktif);
                } else {
                    $('#pilihan-block-' + i).find('input, select, textarea').prop('required', false);
                }
            }
        });

        // tombol tambah pilihan: buka blok berikutnya yang masih tersembunyi --
        // begitu ditampilkan, baru pasang required sesuai jenis yang aktif di blok itu
        // (default "Usul Ide" kalau belum ada radio yang ke-checked), dan segarkan
        // pengecualian proyek yang sudah dipilih.
        $('#btn-tambah-pilihan').click(function() {
            var n = cariBlokTersembunyi();
            if (n === null) return;
            var $block = $('#pilihan-block-' + n);
            $block.show();
            var jenisAktif = $('input[name="jenis_' + n + '"]:checked').val();
            if (!jenisAktif) {
                var $radioUsul = $block.find('input[name="jenis_' + n + '"][value="usul"]');
                $radioUsul.prop('checked', true);
                $block.find('.btn-group[data-toggle="buttons"] label').removeClass('active');
                $radioUsul.closest('label').addClass('active');
                jenisAktif = 'usul';
            }
            setRequiredPilihan(n, jenisAktif);
            recomputeProyekExclusion();
            sinkronkanTombolTambah();
        });

        // tombol hapus pilihan: sembunyikan blok, kosongkan isinya (termasuk penanda
        // file lama supaya tidak ke-anggap "masih ada file" kalau blok ini dipakai lagi
        // untuk pilihan baru), lepas required
        $(document).on('click', '.btn-hapus-pilihan', function() {
            var n = $(this).data('target');
            var $block = $('#pilihan-block-' + n);
            $block.find('input[type=text], textarea, input[type=file], input[name="existing_file_' + n + '"]').val('');
            $block.find('select').val('');
            $block.find('input[type=radio]').prop('checked', false);
            $block.find('.btn-group[data-toggle="buttons"] label').removeClass('active');
            $block.data('has-file', 0);
            $block.find('input, select, textarea').prop('required', false);
            $block.hide();
            sinkronkanTombolTambah();
            recomputeProyekExclusion();
        });

        // Select proyek yang "aktif" = blok-nya sedang tampil DAN jenisnya sedang "Pilih
        // Proyek" (bukan :visible biasa, dengan alasan sama seperti blokTampil() di atas).
        function proyekSelectAktif($select) {
            var n = $select.data('target');
            return blokTampil(n) && $('#proyek-fields-' + n).css('display') !== 'none';
        }

        // pilih proyek existing: tampilkan deskripsi/tools proyek itu, & jangan biarkan
        // proyek yang sama muncul lagi di pilihan lain (SOP: sudah dipilih tidak boleh dobel)
        function recomputeProyekExclusion() {
            var $aktif = $('.proyek-select').filter(function() {
                return proyekSelectAktif($(this));
            });
            var dipilih = [];
            $aktif.each(function() {
                if ($(this).val()) dipilih.push($(this).val());
            });
            $aktif.each(function() {
                var current = $(this).val();
                $(this).find('option').each(function() {
                    var v = $(this).val();
                    if (!v) return;
                    $(this).prop('disabled', dipilih.indexOf(v) !== -1 && v !== current);
                });
            });
        }

        $(document).on('change', '.proyek-select', function() {
            var n = $(this).data('target');
            var selected = $(this).find(':selected');
            $('#deskripsi-proyek-' + n).val(selected.data('deskripsi'));
            $('#tools-proyek-' + n).val(selected.data('tools'));
            recomputeProyekExclusion();
        });

        // Usulan Dosen Pembimbing Pertama & Kedua dalam SATU pilihan yang sama tidak
        // boleh dosen yang sama -- exclude timbal-balik: dosen yang lagi ke-pilih di satu
        // sisi jadi disabled di sisi lainnya, supaya tidak bisa kepilih dobel dari awal.
        function recomputeDosenExclusion(n) {
            var $dosen1 = $('[name="dosen_' + n + '"]');
            var $dosen2 = $('[name="dosen2_' + n + '"]');
            var v1 = $dosen1.val();
            var v2 = $dosen2.val();
            $dosen2.find('option').each(function() {
                var v = $(this).val();
                if (!v) return;
                $(this).prop('disabled', v === v1);
            });
            $dosen1.find('option').each(function() {
                var v = $(this).val();
                if (!v) return;
                $(this).prop('disabled', v === v2);
            });
        }

        $(document).on('change', '.dosen1-select, .dosen2-select', function() {
            recomputeDosenExclusion($(this).data('target'));
        });

        for (var dn = 1; dn <= MAKS_PILIHAN; dn++) {
            recomputeDosenExclusion(dn);
        }

        $("#datatable-nopage_filter").ready(function() {
            $(".dataTables_filter").hide();
        });

        $('#datatable').dataTable({
            /* No ordering applied by DataTables during initialisation */
            "order": []
        });
    });
</script>