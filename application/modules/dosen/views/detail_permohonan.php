<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><a href="<?php echo base_url() ?>dosen"><i class="fa fa-chevron-left"></i></a> Detail Permohonan TA</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <!--profil mahasiswa-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Profil Mahasiswa</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-2 col-sm-3 col-xs-12">
                        <img class="img-responsive img-circle" style="width:120px; height:120px; object-fit:cover;"
                             src="<?php echo base_url() . 'uploads/foto/mahasiswa/' . $dataMahasiswa->foto ?>"
                             onerror="this.src='<?php echo base_url(); ?>elusistatic/build/images/default.jpg'"
                             alt="Foto <?php echo $dataMahasiswa->nama ?>">
                    </div>
                    <div class="col-md-5 col-sm-4 col-xs-12">
                        <p><span class="badge">Nama</span>&emsp; <?php echo $dataMahasiswa->nama ?></p>
                        <p><span class="badge">NIM</span>&emsp; <?php echo $dataMahasiswa->nim ?></p>
                        <p><span class="badge">Email</span>&emsp; <?php echo $dataMahasiswa->email ?: '(belum diisi)' ?></p>
                        <p><span class="badge">No. HP</span>&emsp; <?php echo $dataMahasiswa->mobile ?: '(belum diisi)' ?></p>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <p><span class="badge">SKS</span>&emsp; <?php echo $dataMahasiswa->jumlah_SKS ?></p>
                        <p><span class="badge">IPK</span>&emsp; <?php echo $dataMahasiswa->ipk ?></p>
                        <p>
                            <span class="badge">Status TA</span>&emsp;
                            <?php
                            $statusLabel = [
                                'proses' => '<span class="label label-warning">Proses</span>',
                                'terplotting' => '<span class="label label-success">Terplotting Bimbingan</span>',
                                'revisi' => '<span class="label label-danger">Revisi</span>',
                                'lulus' => '<span class="label label-primary">Lulus</span>',
                            ];
                            echo $statusLabel[$dataMahasiswa->status_pengambilan] ?? $dataMahasiswa->status_pengambilan;
                            ?>
                        </p>
                        <?php if ($dataMahasiswa->status_pengambilan == 'revisi' && $dataMahasiswa->reason) { ?>
                            <p><span class="badge">Alasan Revisi</span>&emsp; <?php echo $dataMahasiswa->reason ?></p>
                        <?php } ?>
                    </div>
                    <div class="clearfix"></div>
                    <?php if ($dataMahasiswa->pengalaman || $dataMahasiswa->skill) { ?>
                        <br>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <p><span class="badge">Pengalaman & Kemampuan</span></p>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Pengalaman</th>
                                            <td><?php echo $dataMahasiswa->pengalaman ?: '-' ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kemampuan</th>
                                            <td><?php echo $dataMahasiswa->skill ?: '-' ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!--daftar pilihan TA-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Pilihan Tugas Akhir yang Diajukan</h2>
                    <p class="text-muted">Mahasiswa bisa mengajukan sampai 3 pilihan sekaligus (proyek dan/atau usulan sendiri).</p>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php if (empty($dataPilihan)) { ?>
                        <p class="text-center text-muted"><i>Belum ada pilihan yang diajukan.</i></p>
                    <?php } else { ?>
                        <?php foreach ($dataPilihan as $p) { ?>
                            <div class="x_panel" style="border:1px solid #e5e7eb; margin-bottom:15px;">
                                <div class="x_title">
                                    <h4 style="margin:0;">
                                        <strong>Pilihan ke-<?php echo $p->pilihan ?></strong>
                                        &mdash; <?php echo strtolower(trim($p->jenis)) == 'proyek' ? 'Memilih Proyek' : 'Usulan Mandiri'; ?>
                                        <?php if ($p->status == 'diterima') { ?>
                                            <span class="label label-success">Diterima</span>
                                        <?php } else { ?>
                                            <span class="label label-warning">Menunggu Keputusan</span>
                                        <?php } ?>
                                    </h4>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <?php if (strtolower(trim($p->jenis)) == 'proyek') { ?>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <p><span class="badge">Judul Proyek</span>&emsp; <?php echo $p->nama_proyek; ?></p>
                                            <p><span class="badge">Deskripsi</span>&emsp; <?php echo $p->deskripsi_proyek; ?></p>
                                            <p><span class="badge">Tools</span>&emsp; <?php echo $p->tools_proyek; ?></p>
                                            <p><span class="badge">Dosen Pemilik Proyek</span>&emsp; <?php echo $p->nama_dosen_proyek; ?></p>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <p><span class="badge">Usulan Judul</span>&emsp; <?php echo $p->judul ?: '(belum ada judul)'; ?></p>
                                            <p><span class="badge">Deskripsi Sistem</span>&emsp; <?php echo $p->deskripsi_usulan; ?></p>
                                            <p><span class="badge">Nama Perusahaan Mitra</span>&emsp; <?php echo $p->mitra ?: '(tidak diisi)'; ?></p>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <p><span class="badge">Dosen Pembimbing 1</span>&emsp; <?php echo $p->nama_dosen_usulan ?: '-'; ?></p>
                                            <p><span class="badge">Dosen Pembimbing 2</span>&emsp; <?php echo $p->nama_dosen_usulan2 ?: '-'; ?></p>
                                            <p>
                                                <span class="badge">Lampiran Proposal</span>&emsp;
                                                <?php if ($p->file_persetujuan) { ?>
                                                    <a target="_blank" href="<?php echo base_url() . 'uploads/persetujuan/' . $p->file_persetujuan; ?>" class="btn btn-xs btn-primary">
                                                        <i class="fa fa-file-pdf-o"></i> <?php echo $p->file_persetujuan; ?>
                                                    </a>
                                                <?php } else { ?>
                                                    <i>(tidak ada lampiran)</i>
                                                <?php } ?>
                                            </p>
                                        </div>
                                    <?php } ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <a href="<?php echo base_url() ?>dosen" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
