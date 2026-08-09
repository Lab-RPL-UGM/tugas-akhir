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

    <!-- ====== Tabel: Mahasiswa Mengajukan Permohonan TA ====== -->
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        Daftar Mahasiswa yang Mengajukan Permohonan TA
                        <small>Jenis: Proyek · Usul (Pembimbing ke-1) · Pembimbing ke‑2</small>
                    </h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <table id="rekap-dosen" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Mahasiswa</th>
                                    <th>Jenis Pengajuan</th>
                                    <th>Judul TA/Proyek</th>
                                    <th>Tanggal Pengajuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($permohonanTA)) : ?>
                                    <?php foreach ($permohonanTA as $row) : ?>
                                        <?php
                                            $jenis = strtolower(trim($row['jenis'] ?? ''));
                                            $label = $jenis === 'proyek' ? 'Memilih Proyek Dosen'
                                                    : ($jenis === 'usul' ? 'Mengusulkan Judul (Pembimbing 1)'
                                                    : ($jenis === 'pembimbing_ke2' ? 'Mengusulkan Judul (Pembimbing 2)' : ucfirst($jenis)));

                                            $badgeClass = $jenis === 'proyek' ? 'label label-primary'
                                                        : ($jenis === 'usul' ? 'label label-success'
                                                        : ($jenis === 'pembimbing_ke2' ? 'label label-warning' : 'label label-default'));

                                            $namaMhs = $row['nama_mahasiswa'] ?? '—';
                                            $judul   = $row['judul'] ?? '—';
                                            $tgl     = $row['tanggal_pengajuan'] ?? null;
                                            $tglFmt  = $tgl ? date('d M Y', strtotime($tgl)) : '—';
                                        ?>
                                        <tr>
                                            <td><?php echo ucwords(strtolower(trim($namaMhs))); ?></td>
                                            <td><span class="<?php echo $badgeClass; ?>"><?php echo $label; ?></span></td>
                                            <td><?php echo ucwords(strtolower(trim($judul))); ?></td>
                                            <td><?php echo $tglFmt; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Belum ada permohonan TA.</td>
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


<!-- jQuery & DataTables (opsional) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" src="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- jQuery versi kompatibel dengan Bootstrap lama -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<!-- Inisialisasi yang aman -->
<script>
  jQuery(function($){
    // Tooltip dari Bootstrap sekarang aktif
    $('[data-toggle="tooltip"]').tooltip();

    // Inisialisasi DataTables spesifik ke tabelnya
    $('#rekap-dosen').DataTable({
      pageLength: 10,
      lengthChange: false,
      ordering: true,
      order: [[3, 'desc']],
      language: {
        search: "Cari:",
        zeroRecords: "Tidak ditemukan data yang cocok",
        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
        infoEmpty: "Menampilkan 0 data",
        infoFiltered: "(difilter dari _MAX_ total data)",
        paginate: { next: "Berikutnya", previous: "Sebelumnya" }
      }
    });
  });
</script>
