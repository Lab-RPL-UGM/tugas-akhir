<div role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Detail Tugas Akhir</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <!-- page content -->
        <div role="main">
            <?php //var_dump($dataMahasiswa)
            ?>
            <br>
            <br>
            <?php //var_dump($dataPengajuanTA)
            ?>
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>
                            <a href="<?php echo base_url(); ?>akademik/tugas_akhir">
                                <i class="fa fa-chevron-left"></i>
                            </a> &nbsp;Detail Hasil Plottingan Tugas Akhir
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="x_panel">
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
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <span class="badge">Nama</span>&emsp;
                            <?php echo $dataMahasiswa[0]->nama ?>
                        </p>
                        <p>
                            <span class="badge">NIM</span>&emsp;
                            <?php echo $dataMahasiswa[0]->nim ?>
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <span class="badge">SKS</span>&emsp;
                            <?php echo $dataMahasiswa[0]->jumlah_SKS ?>
                        </p>
                        <p>
                            <span class="badge">IPK</span>&emsp;
                            <?php echo $dataMahasiswa[0]->ipk ?>
                        </p>
                        <p>
                            <span class="badge">TMT</span>&emsp;
                            <?php echo $dataMahasiswa[0]->nim . " " . $dataMahasiswa[0]->tahun_ajaran ?>
                        </p>
                    </div>
                    <div class="col-md-12">
                        <p>
                            <span class="badge">Pengalaman & Kemampuan</span>
                        </p>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Pengalaman </th>
                                    <td>
                                        <?php echo $dataMahasiswa[0]->pengalaman ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kemampuan </th>
                                    <td>
                                        <?php echo $dataMahasiswa[0]->skill ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tampilan jika jenis ta adalah proyek -->
                    <?php if ($dataPengajuanTA['jenis'] == 'proyek') { ?>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>
                                        <strong>PROJECT TERPILIH</strong>
                                    </h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th>Judul</th>
                                                        <th>Dosen Pembimbing 1</th>
                                                        <th>Dosen Pembimbing 2</th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <?php echo $dataPengajuanTA['nama_proyek']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $dataPengajuanTA['nama_dosen']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $dataPengajuanTA['nama_dosen2']; ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>

                        <div class="col-md-12">
                            <p>
                                <span class="badge">Detail Usulan Tugas Akhir oleh Mahasiswa</span>
                            </p>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Usulan Judul </th>
                                        <td>
                                            <?php echo $dataPengajuanTA['judul']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi Sistem</th>
                                        <td>
                                            <?php echo $dataPengajuanTA['deskripsi']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nama Perusahaan Mitra</th>
                                        <td>
                                            <?php echo $dataPengajuanTA['bisnis_rule']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Proposal</th>
                                        <td>
                                            <a target="_blank" href="<?= base_url() . 'uploads/persetujuan/' . $dataPengajuanTA['file'] ?>"><?= $dataPengajuanTA['file'] ?></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align:middle">Dosen Pembimbing 1</th>
                                        <td>
                                            <?php foreach ($dataDosen as $data) {
                                                if (($data->id_dosen == $dataPengajuanTA['id_dosen'])) {
                                                    echo $data->nama;
                                                }
                                            } ?>
                                        </td>
                                        <!-- <td style="vertical-align:middle">
                                            <form action="<?php echo base_url() ?>akademik/tugas_akhir/ubah_dosbing" method="post">
                                                <div class="col-md-6">
                                                    <select disabled name="dosen" id="dosen" class="form-control">
                                                        <?php foreach ($dataDosen as $data) { ?>
                                                            <option value="<?php echo $data->id_dosen ?>" <?php echo ($data->id_dosen == $dataPengajuanTA['id_dosen'] ? 'selected=\"selected\"' :
                                                                                                                "") ?>>
                                                                <?php echo $data->nama; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <a data-toggle="tooltip" title="Edit Dosen Pembimbing" id='editDosbing' class="btn btn-primary">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <div style="display:none" id="editForm">
                                                        <input type="hidden" name="id_mahasiswa" value="<?php echo $dataMahasiswa[0]->id_mahasiswa ?>">
                                                        <input type="hidden" name="id_pengajuan_ta" value="<?php echo $dataPengajuanTA['id_pengajuan_ta'] ?>">
                                                        <input type="hidden" name="id_ta" value="<?php echo $dataPengajuanTA['id_ta'] ?>">
                                                        <input type="submit" class="btn btn-primary" value="Submit">
                                                        <a style="cursor:pointer;" data-toggle="tooltip" title="Cancel" id='cancel'>
                                                            <u>Cancel edit</u>
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>
                                        </td> -->
                                    </tr>
                                    <tr>
                                        <th style="vertical-align:middle">Dosen Pembimbing 2</th>
                                        <td>
                                            <?php if ($dataPengajuanTA['id_dosen2'] == null) {
                                                echo '(Tidak Ada Dosen 2)';
                                            } else {
                                                foreach ($dataDosen2 as $data) {
                                                    if (($data->id_dosen == $dataPengajuanTA['id_dosen2'])) {
                                                        echo $data->nama;
                                                    }
                                                }
                                            } ?>
                                        </td>
                                        <!-- <td style="vertical-align:middle">
                                            <form action="<?php echo base_url() ?>akademik/tugas_akhir/ubah_dosbing" method="post">
                                                <div class="col-md-6">
                                                    <select disabled name="dosen" id="dosen" class="form-control">
                                                        <?php foreach ($dataDosen2 as $data) { ?>
                                                            <option value="<?php echo $data->id_dosen ?>" <?php echo ($data->id_dosen == $dataPengajuanTA['id_dosen2'] ? 'selected=\"selected\"' :
                                                                                                                "") ?>>
                                                                <?php echo $data->nama; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <a data-toggle="tooltip" title="Edit Dosen Pembimbing" id='editDosbing' class="btn btn-primary">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <div style="display:none" id="editForm">
                                                        <input type="hidden" name="id_mahasiswa" value="<?php echo $dataMahasiswa[0]->id_mahasiswa ?>">
                                                        <input type="hidden" name="id_pengajuan_ta" value="<?php echo $dataPengajuanTA['id_pengajuan_ta'] ?>">
                                                        <input type="hidden" name="id_ta" value="<?php echo $dataPengajuanTA['id_ta'] ?>">
                                                        <input type="submit" class="btn btn-primary" value="Submit">
                                                        <a style="cursor:pointer;" data-toggle="tooltip" title="Cancel" id='cancel'>
                                                            <u>Cancel edit</u>
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>
                                        </td> -->
                                    </tr>
                                </tbody>
                            </table>
                        <?php } ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#editDosbing').click(function() {
        $(this).hide();
        $('#editForm').show();
        $('#dosen').removeAttr('disabled');
    })

    $('#cancel').click(function() {
        $('#editForm').hide();
        $('#editDosbing').show();
        $('#dosen').attr('disabled', 'disabled');
    })
</script>