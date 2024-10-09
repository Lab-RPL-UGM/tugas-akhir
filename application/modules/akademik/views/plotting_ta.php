<?php
$array_usulan = [];

?>

<div role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Persetujuan Tugas Akhir</h3>
            </div>
        </div>

        <!-- page content -->
        <div role="main">
            <?php //var_dump($dataTA)
            ?>
            <br>
            <br>
            <?php //var_dump($dataPengajuanTA)
            ?>
            <?php //var_dump($dataProyek)
            ?>
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>
                            <a href="<?php echo base_url(); ?>akademik/tugas_akhir">
                                <i class="fa fa-chevron-left"></i>
                            </a> &nbsp;Pengajuan
                        </h3>
                    </div>
                </div>
                <div class="clearfix"></div>

                <!--berkas mahasiswa-->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Detail Pengajuan
                                </h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
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
                            </div>

                            <div class="x_content">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <p>
                                        <span class="badge">Nama</span>&emsp;
                                        <?php echo $dataTA[0]->nama ?>
                                    </p>
                                    <p>
                                        <span class="badge">NIM</span>&emsp;
                                        <?php echo $dataTA[0]->nim ?>
                                    </p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <p>
                                        <span class="badge">SKS</span>&emsp;
                                        <?php echo $dataTA[0]->jumlah_SKS ?>
                                    </p>
                                    <p>
                                        <span class="badge">IPK</span>&emsp;
                                        <?php echo $dataTA[0]->ipk ?>
                                    </p>
                                    <p>
                                        <span class="badge">TMT</span>&emsp;
                                        <?php echo "Semester " . ucfirst($dataTA[0]->semester) . " " . $dataTA[0]->tahun_ajaran ?>
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <p>
                                            <span class="badge">Pengalaman & Kemampuan</span>
                                        </p>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Pengalaman </th>
                                                    <td>
                                                        <?php echo $dataTA[0]->pengalaman ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Kemampuan </th>
                                                    <td>
                                                        <?php echo $dataTA[0]->skill ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <form action="<?php echo base_url(); ?>akademik/tugas_akhir/plotting_ta" method="post" onSubmit="return confirm('Apakah anda yakin dengan pilihan anda? (Aksi yang sudah dilakukan tidak bisa dikembalikan lagi)');">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <p>
                                            <span class="badge">Pengajuan Tugas Akhir</span>
                                        </p>
                                        <?php
                                        $i = 1;
                                        foreach ($dataPengajuanTA as $data) {
                                            if ($data['jenis'] == 'usul') {
                                                $array_usulan = [
                                                    'judul' => $data['judul'],
                                                    'deskripsi' => $data['deskripsi'],
                                                    'bisnis_rule' => $data['bisnis_rule'],
                                                    'file' => $data['file']
                                                ];
                                        ?>

                                                <input type="text" hidden class="flat" name="terima" id="terima_usulan" value="<?php echo $data['id_pengajuan_ta'] . ' ' . 'usulan' ?>" />
                                            <?php } else {
                                                $array_proyek = [
                                                    'judul' => $data['nama_proyek'],
                                                    'dosen' => $data['nama_dosen'],
                                                    'deskripsi' => $data['deskripsi'],
                                                    'tools' => $data['tools'],
                                                ]; ?>
                                                <input type="text" hidden class="flat" name="terima" id="terima_proyek" value="<?php echo $data['id_pengajuan_ta'] . ' ' . $data['id_proyek'] ?>" />
                                            <?php } ?>

                                        <?php $i++;
                                        } ?>
                                    </div>

                                    <!-- Tampilan pilih usulan -->

                                    <?php if ($data['jenis'] == 'proyek') { ?>
                                        <div id="proyek" style="margin-bottom: 25px;" class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <p>
                                                    <span class="badge">Jenis</span>&emsp;
                                                    Proyek
                                                </p>
                                                <p>
                                                    <span class="badge">Judul</span>&emsp;
                                                    <?php echo $array_proyek['judul']; ?>
                                                </p>
                                                <p>
                                                    <span class="badge">Deskripsi</span>&emsp;
                                                    <?php echo $array_proyek['deskripsi']; ?>
                                                </p>
                                                <p>
                                                    <span class="badge">Tools</span>&emsp;
                                                    <?php echo $array_proyek['tools']; ?>
                                                </p>
                                                <p>
                                                    <span class="badge">Dosen</span>&emsp;
                                                    <?php echo $array_proyek['dosen']; ?>
                                                </p>
                                            </div>
                                            <div class="col-md-6 mb-5">
                                                Tentukan dosen pembimbing 2
                                                <select name="dosen2" id="dosen2" class="form-control">
                                                    <option value="">Pilih Dosen pembimbing..</option>
                                                    <?php foreach ($dataDosen as $data) { ?>
                                                        <option <?= (isset($dataDosbing[1]->id_dosen) && $dataDosbing[1]->id_dosen == $data->id_dosen) ? "selected" : "" ?> value="<?php echo $data->id_dosen ?>">
                                                            <?php echo $data->nama; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div id="usulan" style="margin-bottom: 25px;" class="col-md-12 col-sm-12 col-xs-12">

                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <p>
                                                    <span class="badge">Jenis</span>&emsp;
                                                    Usulan
                                                </p>
                                                <p>
                                                    <span class="badge">Usulan Judul</span>&emsp;
                                                    <?php echo $array_usulan['judul']; ?>
                                                </p>
                                                <p>
                                                    <span class="badge">Deskripsi Sistem</span>&emsp;
                                                    <?php echo $array_usulan['deskripsi']; ?>
                                                </p>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <p>
                                                    <span class="badge">Nama Perusahaan Mitra</span>&emsp;
                                                    <?php echo $array_usulan['bisnis_rule']; ?>
                                                </p>
                                                <p>
                                                    <span class="badge">Proposal</span>&emsp;
                                                    <a target="_blank" href="<?= base_url() . 'uploads/persetujuan/' . $array_usulan['file'] ?>"><?= $array_usulan['file'] ?></a>
                                                </p>
                                            </div>
                                        </div>
                                        <div id="usulan" style="margin-bottom: 25px;" class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-6 mb-5">
                                                Tentukan dosen pembimbing 1
                                                <select name="dosen" id="dosen" class="form-control">
                                                    <option value="">Pilih Dosen pembimbing..</option>
                                                    <?php foreach ($dataDosen as $data) { ?>
                                                        <option <?= (isset($dataDosbing[0]->id_dosen) && $dataDosbing[0]->id_dosen == $data->id_dosen) ? "selected" : "" ?> value="<?php echo $data->id_dosen ?>">
                                                            <?php echo $data->nama; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-5">
                                                Tentukan dosen pembimbing 2
                                                <select name="dosen2" id="dosen2" class="form-control">
                                                    <option value="">Pilih Dosen pembimbing..</option>
                                                    <?php foreach ($dataDosen as $data) { ?>
                                                        <option <?= (isset($dataDosbing[1]->id_dosen) && $dataDosbing[1]->id_dosen == $data->id_dosen) ? "selected" : "" ?> value="<?php echo $data->id_dosen ?>">
                                                            <?php echo $data->nama; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalRevisi" tabindex="-1" role="dialog" aria-labelledby="modalRevisiLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Revisi Tugas Akhir</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Alasan Revisi:</label>
                                                        <textarea class="form-control" rows="4" name="reason" id="message-text"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <input type="submit" name="pilihan" value="Revisi" class="btn btn-danger">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id_ta" value="<?php echo $dataTA[0]->id_ta; ?>">
                                    <input type="hidden" name="id_mahasiswa" value="<?php echo $dataTA[0]->id_mahasiswa; ?>">
                                    <?php if ($dataTA[0]->status_pengambilan == 'revisi') {?>
                                        <h4><i>(Tugas Akhir di Revisi dengan Alasan : </i><b><?= $dataTA[0]->reason ?></b><i>)</i></h4>
                                    <?php } ?>
                                    <a href="<?php echo base_url() ?>akademik/tugas_akhir" class="btn btn-warning pull-right">Kembali</a>
                                        <input class="btn btn-success pull-right" name="pilihan" value="Setujui" type="submit">
                                        <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#modalRevisi" type="button">
                                            Revisi
                                        </button>
                                    <!--
                                    <?php if (!$isMasaRegis) { ?>
                                        <input class="btn btn-success pull-right" name="pilihan" value="Setujui" type="submit">
                                        <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#modalRevisi" type="button">
                                            Revisi
                                        </button>
                                    <?php } elseif ($dataTA[0]->status_pengambilan == 'revisi') { ?>
                                        <h4><i>(Tugas Akhir di Revisi dengan Alasan : </i><b><?= $dataTA[0]->reason ?></b><i>)</i></h4>
                                    <?php } else { ?>
                                        <input class="btn btn-success pull-right" name="pilihan" value="Setujui" type="submit">
                                        <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#modalRevisi" type="button">
                                            Revisi
                                        </button>
                                        -->
                                        <!-- <center>
                                            <h4><i>(Periode registrasi tugas akhir masih berlangsung, plotting tugas akhir belum bisa dilakukan)</i></h4>
                                        </center> -->
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                        <!-- /page content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // $('input').iCheck('check', function(){
    //   alert('Well done, Sir');
    // });
    $('input#terima_usulan').on('ifChecked', function(event) {
        $("#usulan").show();
        $("#dipilihkan").hide();
    });
    $('input#terima_proyek').on('ifChecked', function(event) {
        $("#usulan").hide();
        $("#dipilihkan").hide();
    });
    $('input#terima_dipilihkan').on('ifChecked', function(event) {
        $("#usulan").hide();
        $("#dipilihkan").show();
    });
</script>