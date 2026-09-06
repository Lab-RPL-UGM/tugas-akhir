<div class="page-title">
    <div class="title_left">
        <h3><a href="<?php echo base_url(); ?>akademik/proyek"><i class="fa fa-chevron-left"></i></a> Pendaftar Proyek</h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h4><?php echo $proyek->nama_proyek; ?></h4>
                <p class="text-muted">Penanggung jawab: <?php echo $proyek->nama_dosen; ?></p>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php
                $error = $this->session->flashdata('error');
                if ($error) {
                ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $error; ?>
                    </div>
                <?php }
                $success = $this->session->flashdata('success');
                if ($success) {
                ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $success; ?>
                    </div>
                <?php } ?>

                <?php if ($sudahDiterima) { ?>
                    <div class="alert alert-info">Proyek ini sudah ditetapkan untuk salah satu mahasiswa di bawah -- mahasiswa lain yang juga memilih proyek ini tidak bisa diterima lagi.</div>
                <?php } ?>

                <div style="overflow:auto;">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Pilihan ke-</th>
                                <th>Status</th>
                                <th>Profil</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($dataPendaftar)) { ?>
                                <?php foreach ($dataPendaftar as $d) { ?>
                                    <tr>
                                        <td><?php echo $d->nim; ?></td>
                                        <td><?php echo $d->nama_mahasiswa; ?></td>
                                        <td class="text-center"><?php echo $d->pilihan; ?></td>
                                        <td class="text-center">
                                            <?php if ($d->status == 'diterima') { ?>
                                                <span class="label label-success">DITERIMA</span>
                                            <?php } else { ?>
                                                <span class="label label-warning">MENUNGGU</span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url(); ?>akademik/daftar_mahasiswa/detail_mahasiswa/<?php echo $d->id_mahasiswa; ?>" target="_blank" class="btn btn-sm btn-default" data-toggle="tooltip" title="Lihat profil lengkap mahasiswa">
                                                <i class="fa fa-user"></i> Lihat Profil
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($d->status == 'diterima') { ?>
                                                <span class="text-muted"><i>Sudah diterima</i></span>
                                            <?php } elseif ($sudahDiterima) { ?>
                                                <button type="button" class="btn btn-sm btn-default" disabled title="Proyek ini sudah diambil mahasiswa lain">Terima</button>
                                            <?php } else { ?>
                                                <form action="<?php echo base_url(); ?>akademik/proyek/terimaPendaftar" method="post" onsubmit="return confirm('Terima <?php echo addslashes($d->nama_mahasiswa); ?> untuk proyek ini? Pilihan lain mahasiswa ini akan otomatis dibatalkan.');">
                                                    <input type="hidden" name="id_proyek" value="<?php echo $proyek->id_proyek; ?>">
                                                    <input type="hidden" name="id_pengajuan_ta" value="<?php echo $d->id_pengajuan_ta; ?>">
                                                    <input type="hidden" name="id_ta" value="<?php echo $d->id_ta; ?>">
                                                    <input type="hidden" name="id_mahasiswa" value="<?php echo $d->id_mahasiswa; ?>">
                                                    <button type="submit" class="btn btn-sm btn-success">Terima</button>
                                                </form>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="6" class="text-center"><i>Belum ada mahasiswa yang memilih proyek ini</i></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
