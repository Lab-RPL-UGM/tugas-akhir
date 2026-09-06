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
                                <div class="col-md-2 col-sm-3 col-xs-12">
                                    <img class="img-responsive img-circle" style="width:120px; height:120px; object-fit:cover;"
                                         src="<?php echo base_url() . 'uploads/foto/mahasiswa/' . $dataTA[0]->foto ?>"
                                         onerror="this.src='<?php echo base_url(); ?>elusistatic/build/images/default.jpg'"
                                         alt="Foto <?php echo $dataTA[0]->nama ?>">
                                </div>
                                <div class="col-md-5 col-sm-4 col-xs-12">
                                    <p>
                                        <span class="badge">Nama</span>&emsp;
                                        <?php echo $dataTA[0]->nama ?>
                                    </p>
                                    <p>
                                        <span class="badge">NIM</span>&emsp;
                                        <?php echo $dataTA[0]->nim ?>
                                    </p>
                                    <p>
                                        <span class="badge">Email</span>&emsp;
                                        <?php echo $dataTA[0]->email ?: '(belum diisi)' ?>
                                    </p>
                                    <p>
                                        <span class="badge">No. HP</span>&emsp;
                                        <?php echo $dataTA[0]->mobile ?: '(belum diisi)' ?>
                                    </p>
                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-12">
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
                                <div class="clearfix"></div>
                                <br>
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
                                            <span class="badge">Pilihan Tugas Akhir Mahasiswa</span>
                                        </p>
                                        <p class="text-muted">Mahasiswa bisa mengajukan sampai 3 pilihan sekaligus (proyek dan/atau usulan sendiri) -- pilih salah satu di bawah ini untuk disetujui.</p>

                                        <?php foreach ($dataPengajuanTA as $data) {
                                            $sudahDiambil = ($data['jenis'] == 'proyek') && !empty($data['sudah_diambil']);
                                        ?>
                                            <div class="x_panel" style="border:1px solid #e5e7eb; margin-bottom:15px; <?php echo $sudahDiambil ? 'opacity:0.6; background:#f9fafb;' : ''; ?>">
                                                <div class="x_title">
                                                    <h4 style="margin:0;">
                                                        <label style="font-weight:normal; margin:0; <?php echo $sudahDiambil ? 'cursor:not-allowed;' : 'cursor:pointer;'; ?>">
                                                            <?php if ($data['jenis'] == 'proyek') { ?>
                                                                <input type="radio" name="terima" class="radio-terima" data-jenis="proyek"
                                                                       <?php echo $sudahDiambil ? 'disabled' : ''; ?>
                                                                       value="<?php echo $data['id_pengajuan_ta'] . ' ' . $data['id_proyek'] ?>">
                                                            <?php } else { ?>
                                                                <input type="radio" name="terima" class="radio-terima" data-jenis="usul"
                                                                       data-dosen1="<?php echo $data['id_dosen'] ?>" data-dosen2="<?php echo $data['id_dosen2'] ?>"
                                                                       value="<?php echo $data['id_pengajuan_ta'] . ' ' . 'usulan' ?>">
                                                            <?php } ?>
                                                            <strong>Pilihan ke-<?php echo $data['pilihan'] ?></strong>
                                                            &mdash; <?php echo $data['jenis'] == 'proyek' ? 'Memilih Proyek' : 'Usulan Mandiri'; ?>
                                                            <?php if ($sudahDiambil) { ?>
                                                                <span class="label label-danger">Sudah ada mahasiswa lain yang diterima di proyek ini</span>
                                                            <?php } ?>
                                                        </label>
                                                    </h4>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                    <?php if ($data['jenis'] == 'proyek') { ?>
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <p>
                                                                <span class="badge">Judul Proyek</span>&emsp;
                                                                <?php echo $data['nama_proyek']; ?>
                                                            </p>
                                                            <p>
                                                                <span class="badge">Deskripsi</span>&emsp;
                                                                <?php echo $data['deskripsi']; ?>
                                                            </p>
                                                            <p>
                                                                <span class="badge">Tools</span>&emsp;
                                                                <?php echo $data['tools']; ?>
                                                            </p>
                                                            <p>
                                                                <span class="badge">Dosen</span>&emsp;
                                                                <?php echo $data['nama_dosen']; ?>
                                                            </p>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p>
                                                                <span class="badge">Usulan Judul</span>&emsp;
                                                                <?php echo $data['judul']; ?>
                                                            </p>
                                                            <p>
                                                                <span class="badge">Deskripsi Sistem</span>&emsp;
                                                                <?php echo $data['deskripsi']; ?>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p>
                                                                <span class="badge">Nama Perusahaan Mitra</span>&emsp;
                                                                <?php echo $data['bisnis_rule'] ?: '(tidak diisi)'; ?>
                                                            </p>
                                                            <p>
                                                                <span class="badge">Proposal</span>&emsp;
                                                                <a target="_blank" href="<?= base_url() . 'uploads/persetujuan/' . $data['file'] ?>"><?= $data['file'] ?></a>
                                                            </p>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <!-- Jalur manual: dipakai kalau SEMUA pilihan di atas sudah tidak tersedia
                                             lagi (proyeknya keburu diambil mhs lain / usulan tidak disetujui) --
                                             akademik tetap bisa mengeplot mahasiswa ini ke proyek lain yang masih
                                             tersedia beserta dosen pembimbingnya. -->
                                        <div class="x_panel" style="border:1px dashed #d1d5db; margin-bottom:15px;">
                                            <div class="x_title">
                                                <h4 style="margin:0;">
                                                    <label style="font-weight:normal; margin:0; cursor:pointer;">
                                                        <input type="radio" name="terima" class="radio-terima" data-jenis="manual" value="manual">
                                                        <strong>Plot Manual</strong> &mdash; pilih proyek lain, atau tentukan Dosen Pembimbing langsung kalau proyek sudah habis
                                                    </label>
                                                </h4>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content" id="panel-manual-proyek" style="display:none;">
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <label>Pilih Proyek <small>(opsional)</small></label>
                                                    <select name="proyek" id="proyek-manual" class="form-control">
                                                        <option value="">-- Tidak pilih proyek, tentukan Dosen Pembimbing saja di bawah --</option>
                                                        <?php if (!empty($dataProyek)) {
                                                            foreach ($dataProyek as $pr) { ?>
                                                                <option value="<?php echo $pr->id_proyek ?>" data-dosen="<?php echo $pr->id_dosen ?>"><?php echo $pr->nama_proyek ?> (<?php echo $pr->nama_dosen ?>)</option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                    <p class="help-block">Cuma menampilkan proyek yang sudah disetujui &amp; belum diambil mahasiswa lain. Kalau proyek yang tersedia sudah habis, biarkan kosong dan tentukan Dosen Pembimbing 1 di bawah -- proyek akan diprioritaskan kalau keduanya diisi.</p>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tentukan dosen pembimbing -- baru muncul setelah salah satu pilihan di atas
                                         di-radio. Dosen 1 cuma relevan untuk pilihan usulan (dosen pembimbing pada
                                         pilihan proyek sudah otomatis dari proyeknya); nilainya di-prefill dari yang
                                         diusulkan mahasiswa sendiri saat mendaftar, tapi akademik masih bebas mengganti. -->
                                    <div id="panel-dosen" class="col-md-12 col-sm-12 col-xs-12" style="display:none; margin-bottom:20px;">
                                        <div class="col-md-6 mb-5" id="field-dosen1">
                                            Tentukan Dosen Pembimbing 1
                                            <select name="dosen" id="dosen" class="form-control">
                                                <option value="">Pilih Dosen pembimbing 1..</option>
                                                <?php foreach ($dataDosen as $dd) { ?>
                                                    <option value="<?php echo $dd->id_dosen ?>"><?php echo $dd->nama; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-5">
                                            Tentukan Dosen Pembimbing 2 <small>(opsional)</small>
                                            <select name="dosen2" id="dosen2" class="form-control">
                                                <option value="">Pilih Dosen pembimbing 2..</option>
                                                <?php foreach ($dataDosen as $dd) { ?>
                                                    <option value="<?php echo $dd->id_dosen ?>"><?php echo $dd->nama; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
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
    // Begitu akademik memilih salah satu pilihan (radio "terima"), tampilkan panel
    // penentuan dosen pembimbing. Dosen 1 cuma dipakai untuk pilihan usulan --
    // di-prefill dari dosen yang diusulkan mahasiswa sendiri saat mendaftar.
    $(document).on('change', '.radio-terima', function() {
        var jenis = $(this).data('jenis');
        $('#panel-dosen').show();
        if (jenis === 'usul') {
            // pilihan usulan mahasiswa sendiri -- prefill dosen yang sudah diusulkan
            $('#field-dosen1').show();
            $('#dosen').val($(this).data('dosen1') || '');
            $('#dosen2').val($(this).data('dosen2') || '');
        } else if (jenis === 'manual') {
            // jalur manual: dosen 1 dipakai kalau akademik tidak memilih proyek
            // (proyek yang tersedia sudah habis), jadi tetap ditampilkan tapi kosong
            $('#field-dosen1').show();
            $('#dosen').prop('disabled', false).val('');
            $('#dosen2').val('');
        } else {
            $('#field-dosen1').hide();
            $('#dosen').prop('disabled', false).val('');
            $('#dosen2').val('');
        }

        // panel pilih proyek manual cuma muncul kalau jalur "Plot Manual" yang dipilih
        // -- proyek pilihan mahasiswa sendiri sudah otomatis bawa dosennya, jadi tidak
        // perlu pilih proyek lagi di panel ini. Proyek di sini OPSIONAL (lihat help-text):
        // kalau proyek yang tersedia sudah habis, akademik tinggal isi Dosen Pembimbing 1
        // di panel dosen tanpa pilih proyek -- makanya tidak pernah di-set 'required'.
        if (jenis === 'manual') {
            $('#panel-manual-proyek').show();
        } else {
            $('#panel-manual-proyek').hide();
            $('#proyek-manual').val('');
        }
    });

    // Kalau proyek dipilih di panel manual, dosennya sudah otomatis ikut proyek itu --
    // "Dosen Pembimbing 1" langsung disamakan & dikunci (tidak masuk akal akademik
    // pilih dosen lain untuk proyek yang bukan miliknya). Kosongkan lagi proyeknya ->
    // field dosen kembali bisa diisi manual.
    $(document).on('change', '#proyek-manual', function() {
        var idDosenProyek = $(this).find(':selected').data('dosen');
        if ($(this).val() && idDosenProyek) {
            $('#dosen').val(idDosenProyek).prop('disabled', true);
        } else {
            $('#dosen').prop('disabled', false).val('');
        }
    });
</script>