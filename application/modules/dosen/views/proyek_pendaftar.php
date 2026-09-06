<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><a href="<?php echo base_url() ?>dosen/proyek"><i class="fa fa-chevron-left"></i></a> Pendaftar Proyek</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h4><?php echo $proyek->nama_proyek; ?></h4>
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
                    <?php } ?>

                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Pilihan ke-</th>
                                <th>Status</th>
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
                                            <a href="<?php echo base_url(); ?>dosen/bimbingan/detail/<?php echo $d->id_mahasiswa; ?>" class="btn btn-sm btn-primary">
                                                <i class="fa fa-user"></i> Lihat Profil
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="5" class="text-center"><i>Belum ada mahasiswa yang memilih proyek ini</i></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
