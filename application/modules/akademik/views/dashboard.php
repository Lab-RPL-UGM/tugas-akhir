<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Dashboard - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        /* Rapikan spacing dan tampilan panel */
        .page-title { margin-bottom: 12px; }
        .top_tiles .tile-stats { border: 1px solid #e5e7eb; border-radius: 6px; }
        .tile-stats .count { font-size: 28px; font-weight: 600; }
        .x_panel { border: 1px solid #e5e7eb; border-radius: 8px; padding: 16px; margin-bottom: 20px; background: #fff; }
        .x_title { margin-bottom: 12px; }
        .x_title h3 { margin: 0; font-weight: 700; }
        /* Hindari whitespace berlebih: jangan pakai height:100vh di wrapper */
        #grafik-container { height: 420px; }
        #grafikPengajuanTA { width: 100%; height: 100%; }
        table.table { width: 100%; border-collapse: collapse; }
        table.table th, table.table td { padding: 8px 10px; border: 1px solid #e5e7eb; }
        table.table th { background: #f8fafc; }
        .text-center { text-align: center; }
        .muted { color: #6b7280; }
    </style>
</head>
<body>

<div role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Dashboard</h3>
            </div>
        </div>

        <div class="clearfix"></div>
        <br>

        <div class="text-center">
            <?php if (!empty($dataPeriode) && isset($dataPeriode[0])): ?>
                <h3>
                    Periode Semester
                    <span><strong><?= ucfirst($dataPeriode[0]->semester) . " " . $dataPeriode[0]->tahun_ajaran; ?></strong></span>
                </h3>
            <?php else: ?>
                <h3><strong><i>(Belum ada periode yang aktif)</i></strong></h3>
            <?php endif; ?>
            <p class="muted"><i><?= DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->format('j F Y'); ?></i></p>
        </div>

        <!-- Tiles -->
        <div class="row top_tiles">
            <div class="animated flipInY col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-tasks"></i></div>
                    <div class="count"><?= (int)$countProyek; ?></div>
                    <h3>Judul Proyek</h3>
                    <p>
                        <a href="<?php echo base_url(); ?>akademik/proyek">Cek List Judul Proyek
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </p>
                </div>
            </div>
            <div class="animated flipInY col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <div class="count"><?= (int)$countSidang; ?></div>
                    <h3>Sidang</h3>
                    <p>
                        <a href="<?php echo base_url(); ?>akademik/sidang">Cek List Sidang
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </p>
                </div>
            </div>
            <div class="animated flipInY col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-graduation-cap"></i></div>
                    <div class="count"><?= (int)$countYudisium; ?></div>
                    <h3>Yudisium</h3>
                    <p>
                        <a href="<?php echo base_url(); ?>akademik/yudisium">Cek List Yudisium
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Grafik: Proyek vs Usul (P1) vs Pembimbing ke-2 -->
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3><strong>Grafik Pengajuan / Pemilihan Mahasiswa per Dosen</strong></h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" id="grafik-container">
                        <canvas id="grafikPengajuanTA"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Rekap -->
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3><strong>Rekap Dipilih Mahasiswa per Dosen</strong></h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div style="overflow:auto;">
                            <table id="rekap-dosen" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Dosen</th>
                                        <th>Nama Dosen</th>
                                        <th>Mahasiswa Memilih Proyek</th>
                                        <th>Mahasiswa Membawa Usulan (Pembimbing 1)</th>
                                        <th>Mahasiswa Memilih sebagai Pembimbing ke‑2</th>
                                        <th>Total Dipilih Mahasiswa (unik)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($rekapDipilih)): ?>
                                        <?php foreach ($rekapDipilih as $r): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($r['id_dosen'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?= htmlspecialchars($r['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?= (int)$r['jumlah_mhs_proyek']; ?></td>
                                                <td><?= (int)$r['jumlah_mhs_usul']; ?></td>
                                                <td><?= (int)$r['jumlah_mhs_pembimbing_ke2']; ?></td>
                                                <td><?= (int)$r['total_dipilih_mahasiswa']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="6" class="text-center">Tidak ada data</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.wrapper -->
</div><!-- /role=main -->

<!-- Canvas untuk grafik -->
<canvas id="grafikPengajuanTA" style="height:400px;"></canvas>
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<!-- jQuery & DataTables (opsional) -->
<script src="jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Chart.js -->
<script src="cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
(function () {
  // Data dari controller (DIJAMIN sinkron karena sumbernya dari $rekapDipilih yang sama)
  const labels          = <?= json_encode($chartLabels ?? [], JSON_UNESCAPED_UNICODE); ?>;
  const proyekVals      = <?= json_encode($chartProyekVals ?? [], JSON_NUMERIC_CHECK); ?>;
  const usulVals        = <?= json_encode($chartUsulVals ?? [], JSON_NUMERIC_CHECK); ?>;
  const pembimbing2Vals = <?= json_encode($chartPembimbing2Vals ?? [], JSON_NUMERIC_CHECK); ?>;

  // Inisialisasi Chart
  const ctx = document.getElementById('grafikPengajuanTA').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels,
      datasets: [
        {
          label: 'Mahasiswa Memilih Proyek',
          data: proyekVals,
          backgroundColor: 'rgba(54, 162, 235, 0.55)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        },
        {
          label: 'Mahasiswa Membawa Usulan (Pembimbing 1)',
          data: usulVals,
          backgroundColor: 'rgba(255, 159, 64, 0.55)',
          borderColor: 'rgba(255, 159, 64, 1)',
          borderWidth: 1
        },
        {
          label: 'Mahasiswa Memilih sebagai Pembimbing ke‑2',
          data: pembimbing2Vals,
          backgroundColor: 'rgba(75, 192, 192, 0.55)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false, // gunakan tinggi kontainer (420px)
      plugins: {
        legend: { display: true, position: 'top' },
        tooltip: { enabled: true },
        title: {
          display: true,
          text: 'Mahasiswa Proyek vs Usulan (P1 & P2) per Dosen'
        }
      },
    //   scales: {
    //     x: { ticks: { autoSkip: false, maxRotation: 45, minRotation: 0 }, title: { display: true, text: 'Dosen' } },
    //     y: { beginAtZero: true, title: { display: true, text: 'Jumlah Mahasiswa' }, grace: '5%' }
    //   }
      scales: { x: { stacked: true }, y: { stacked: true, beginAtZero: true } }
    }
  });

  // DataTables untuk tabel (opsional)
  $('#rekap-dosen').DataTable({
    pageLength: 25,
    order: [[5, 'desc']],
    language: {
      search: 'Cari:',
      lengthMenu: 'Tampilkan _MENU_ baris',
      info: 'Menampilkan _START_–_END_ dari _TOTAL_',
      paginate: { first: 'Awal', last: 'Akhir', next: '›', previous: '‹' },
      zeroRecords: 'Tidak ada data yang cocok'
    }
  });
})();
</script>
</body>
</html>