<?php
/**
 * Created by nad.
 * Date: 07/03/2018
 * Time: 11:32
 * Description:
 */
// var_dump($id);
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Dashboard</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <br>

    <center>
        <p>
            <?php if (!empty($dataPeriode)) { ?>
                <h3>Periode Semester
                    <span>
                        <strong>
                            <?php echo ucfirst($dataPeriode[0]->semester) . " " . $dataPeriode[0]->tahun_ajaran; ?>
                        </strong>
                    </span>
                </h3>
            <?php } else {
                echo "<h3><strong><i>(Belum ada periode yang aktif)</i></strong></h3>";
            } ?>
        </p>
        <p><?php echo DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->format('j F Y'); ?></p>
    </center>

    <!-- Filter Periode: sama seperti akademik/dashboard -- data di bawah (bimbingan,
         yudisium, daftar permohonan) disaring per periode terpilih. -->
    <?php if (!empty($arrayAllPeriode)) : ?>
        <div class="periode-filter text-center" style="margin: 12px 0 20px;">
            <form method="get" action="<?php echo base_url('dosen'); ?>" id="formFilterPeriode">
                <label for="id_periode" style="font-weight:600; margin-right:8px;">Filter Periode:</label>
                <select name="id_periode" id="id_periode" style="padding:6px 10px; border:1px solid #d1d5db; border-radius:6px; font-size:14px;" onchange="document.getElementById('formFilterPeriode').submit()">
                    <?php foreach ($arrayAllPeriode as $p) : ?>
                        <option value="<?php echo (int)$p->id_periode; ?>" <?php echo ((int)$p->id_periode === (int)$idPeriodeFilter) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars(ucfirst($p->semester) . ' ' . $p->tahun_ajaran, ENT_QUOTES, 'UTF-8'); ?>
                            <?php echo ((int)$p->status_periode === 1) ? ' (Aktif)' : ''; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
    <?php endif; ?>

    <!-- Tiles Ringkasan -->
    <div class="row top_tiles">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="count"><?php echo (int)$countBimbingan; ?> / <?php echo (int)$countKuota; ?></div>
                <h3>Kuota Mahasiswa</h3>
                <p>-</p>
            </div>
        </div>

        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-tasks"></i></div>
                <div class="count"><?php echo (int)$countBimbingan; ?></div>
                <h3>Bimbingan</h3>
                <p>
                    <a href="<?php echo base_url(); ?>dosen/bimbingan">Cek Mahasiswa Bimbingan 
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </p>
            </div>
        </div>

        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="count"><?php echo (int)$countPendadaran; ?></div>
                <h3>Pendadaran</h3>
                <p>
                    <a href="<?php echo base_url(); ?>dosen/pendadaran"> Cek Mahasiswa akan Pendadaran
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </p>
            </div>
        </div>

        <!-- Yudisium (opsional) -->
        <!--
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="count"><?php echo (int)$countYudisium; ?></div>
                <h3>Yudisium</h3>
                <p>
                    <?php echo base_url(); ?>dosen/yudisium
                        Cek Mahasiswa akan Yudisium
                    </a> <i class="fa fa-arrow-right"></i>
                </p>
            </div>
        </div>
        -->

        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-line-chart"></i></div>
                <div class="count"><?php echo (int)$countProyek; ?></div>
                <h3>Project</h3>
                <p>
                    <a href="<?php echo base_url(); ?>dosen/proyek"> Cek Daftar Project
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </p>
            </div>
        </div>
    </div>

    <?php
        // Baris rendering dipakai bareng oleh 2 tabel di bawah (belum & sudah di-ACC)
        // supaya label/warna badge-nya konsisten -- lihat pemanggilannya di masing2 tabel.
        $renderBarisPermohonan = function ($row) {
            $jenis = strtolower(trim($row['jenis'] ?? ''));
            $label = $jenis === 'proyek' ? 'Memilih Proyek Dosen'
                    : ($jenis === 'usul' ? 'Mengusulkan Judul (Pembimbing 1)'
                    : ($jenis === 'usul_pembimbing2' ? 'Diusulkan sebagai Pembimbing 2 (Menunggu Keputusan)'
                    : ($jenis === 'pembimbing_ke2' ? 'Mengusulkan Judul (Pembimbing 2)' : ucfirst($jenis))));

            $badgeClass = $jenis === 'proyek' ? 'label label-primary'
                        : ($jenis === 'usul' ? 'label label-success'
                        : ($jenis === 'usul_pembimbing2' ? 'label label-info'
                        : ($jenis === 'pembimbing_ke2' ? 'label label-warning' : 'label label-default')));

            $namaMhs = $row['nama_mahasiswa'] ?? '—';
            $judul   = $row['judul'] ?? '—';
            $tgl     = $row['tanggal_pengajuan'] ?? null;
            $tglFmt  = $tgl ? date('d M Y', strtotime($tgl)) : '—';
            $idTa    = $row['id_ta'] ?? null;
        ?>
            <tr>
                <td><?php echo ucwords(strtolower(trim($namaMhs))); ?></td>
                <td><span class="<?php echo $badgeClass; ?>"><?php echo $label; ?></span></td>
                <td><?php echo ucwords(strtolower(trim($judul))); ?></td>
                <td><?php echo $tglFmt; ?></td>
                <td class="text-center">
                    <?php if ($idTa) { ?>
                        <a href="<?php echo base_url() . 'dosen/detailPermohonan/' . $idTa; ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Lihat Detail">
                            <i class="fa fa-eye"></i> Lihat
                        </a>
                    <?php } ?>
                </td>
            </tr>
        <?php
        };
    ?>

    <!-- ====== Tabel 1: Mahasiswa MASIH MENGAJUKAN (belum di-ACC) ====== -->
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        Daftar Mahasiswa Masih Mengajukan (Belum Di-ACC)
                        <small>Jenis: Proyek · Usul (Pembimbing ke-1) · Pembimbing ke‑2</small>
                    </h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <table id="rekap-dosen-belum-acc" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Mahasiswa</th>
                                    <th>Jenis Pengajuan</th>
                                    <th>Judul TA/Proyek</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($permohonanBelumAcc)) : ?>
                                    <?php foreach ($permohonanBelumAcc as $row) {
                                        $renderBarisPermohonan($row);
                                    } ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Tidak ada permohonan yang masih menunggu keputusan.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ====== Tabel 2: Mahasiswa SUDAH DI-ACC/DISETUJUI ====== -->
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        Daftar Mahasiswa Sudah Di-ACC (Disetujui)
                        <small>Jenis: Proyek · Usul (Pembimbing ke-1) · Pembimbing ke‑2</small>
                    </h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <table id="rekap-dosen-sudah-acc" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Mahasiswa</th>
                                    <th>Jenis Pengajuan</th>
                                    <th>Judul TA/Proyek</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($permohonanSudahAcc)) : ?>
                                    <?php foreach ($permohonanSudahAcc as $row) {
                                        $renderBarisPermohonan($row);
                                    } ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Belum ada permohonan yang di-ACC.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- jQuery, Bootstrap, dan DataTables SUDAH dimuat sekali lewat includes/header.php
     dan includes/footer.php -- versi CDN yang sebelumnya ada di sini menimpa jQuery
     global dengan versi 3.x, yang bikin bootstrap.min.js (Bootstrap 3, butuh jQuery
     <3) berhenti jalan di seluruh halaman ini ("Bootstrap's JavaScript requires
     jQuery version 1.9.1 or higher, but lower than version 3" di console). -->
<script>
  jQuery(function($){
    // Tooltip dari Bootstrap sekarang aktif
    $('[data-toggle="tooltip"]').tooltip();

    // Inisialisasi DataTables spesifik ke tabelnya -- sekarang 2 tabel terpisah
    // (belum & sudah di-ACC), pakai bahasa & urutan yang sama seperti sebelumnya.
    var dtLanguage = {
      search: "Cari:",
      zeroRecords: "Tidak ditemukan data yang cocok",
      info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
      infoEmpty: "Menampilkan 0 data",
      infoFiltered: "(difilter dari _MAX_ total data)",
      paginate: { next: "Berikutnya", previous: "Sebelumnya" }
    };
    $('#rekap-dosen-belum-acc, #rekap-dosen-sudah-acc').DataTable({
      pageLength: 10,
      lengthChange: false,
      ordering: true,
      order: [[3, 'desc']],
      language: dtLanguage
    });
  });
</script>
