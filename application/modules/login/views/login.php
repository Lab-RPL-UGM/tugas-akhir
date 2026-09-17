<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TA-TRPL | Modern Dashboard</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #E8D5F2 0%, #FCD2D1 25%, #FFE5E5 50%, #FFEDD1 75%, #E8F3F5 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            overflow-x: hidden;
            position: relative;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Animated Background Orbs */
        .bg-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.7;
            animation: float 20s infinite;
        }

        .orb1 {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #FFE5E5 0%, #FCD2D1 100%);
            top: -200px;
            left: -200px;
            animation-delay: 0s;
        }

        .orb2 {
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, #E8F3F5 0%, #D4E6F1 100%);
            bottom: -150px;
            right: -150px;
            animation-delay: 5s;
        }

        .orb3 {
            width: 350px;
            height: 350px;
            background: linear-gradient(135deg, #F7E2F7 0%, #E8D5F2 100%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: 10s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(50px, -50px) rotate(90deg); }
            50% { transform: translate(-30px, 30px) rotate(180deg); }
            75% { transform: translate(-50px, -30px) rotate(270deg); }
        }

        /* Main Container -- tinggi dikunci ke layar (bukan min-height) supaya 3 kolom
           di bawah (login/grafik/tabel) muat dalam 1 layar tanpa scroll di monitor
           desktop; di layar sempit (lihat media query di bawah) dikembalikan jadi
           scrollable karena 1 layar tidak realistis untuk 3 panel ditumpuk vertikal. */
        .main-container {
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 16px;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        /* 2 kolom: kiri = Login + Kuota Dosen ditumpuk jadi 1 kolom (login sendirian
           kelihatan kosong/kurang bagus), kanan = Grafik (dapat ruang lebih lega).
           TIDAK dipaksa height:100%/max-height lagi -- tinggi 1 baris grid ini
           sekarang mengikuti tinggi ASLI kolom kiri (login+gap+kuota), lalu kartu
           Grafik di kanan otomatis diregangkan menyamainya (default grid
           align-items: stretch) -- dulu grafik dipaksa penuh 1 layar (94vh) padahal
           kolom kiri isinya jauh lebih pendek, jadi kelihatan tidak sama tinggi. */
        .content-wrapper {
            width: 100%;
            max-width: 1500px;
            max-height: 94vh;
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 20px;
        }

        .left-column {
            min-height: 0;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        /* Glass Card Effect -- background dulunya rgba(255,255,255,0.1) (nyaris putih
           bening), jadi teks putih di dalamnya (judul, footer, label grafik) nabrak
           background gradient halaman yang terang -- nyaris tidak kebaca. Diganti tint
           gelap supaya teks putih kontras, tetap efek "glass" (blur + border tipis). */
        .glass-card {
            background: rgba(45, 28, 62, 0.55);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            padding: 24px;
            transition: all 0.3s ease;
        }

        .glass-card.table-card {
            padding: 20px;
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: 0;
        }

        /* Login secukupnya (natural height, tidak diregangkan) -- Kuota Dosen mengisi
           SISA tinggi kolom kiri lewat flex:1 (lihat .left-column di atas), dengan
           scroll internal sendiri kalau datanya panjang. Grafik (kolom kanan) tetap
           diregangkan penuh 1 baris grid seperti sebelumnya. */
        .login-section { display: flex; }
        .login-section .glass-card { width: 100%; }

        /* Tabel Kuota TIDAK di-flex:1 lagi -- kalau dipaksa mengisi SISA tinggi kolom
           kiri, di layar besar (mis. laptop 16") isinya cuma segelintir dosen jadi
           nyisa ruang kosong panjang di bawah baris terakhir. Sekarang secukupnya
           (auto height sampai batas max-height), dan .left-column men-tengahkan
           pasangan login+tabel ini kalau sisa ruangnya masih ada (lihat justify-content
           di atas). Kalau dosennya BANYAK, dibatasi max-height & scroll sendiri. */
        .table-section {
            min-height: 0;
            max-height: 65vh;
            display: flex;
        }
        .table-section .glass-card {
            width: 100%;
            height: auto;
            max-height: 100%;
        }

        .chart-section {
            height: 100%;
            min-height: 0;
            display: flex;
        }
        .chart-section .glass-card { width: 100%; }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Login Section */
        .login-section {
            animation: slideInLeft 0.8s ease;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 16px;
        }

        .login-header h1 {
            color: white;
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
        }

        .login-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid transparent;
            border-radius: 12px;
            padding: 12px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .form-control:focus {
            background: white;
            border-color: #C8B1DB;
            box-shadow: 0 0 0 3px rgba(200, 177, 219, 0.1);
            outline: none;
        }

        .input-group {
            position: relative;
            margin-bottom: 25px;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 19px;
            color: #9B8AA6;
            z-index: 10;
            font-size: 14px;
        }

        .form-control-icon {
            padding-left: 45px;
        }

        .btn-login {
            background: linear-gradient(135deg, #C8B1DB 0%, #F2C4CE 100%);
            border: none;
            border-radius: 12px;
            color: white;
            padding: 14px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(200, 177, 219, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(200, 177, 219, 0.4);
            background: linear-gradient(135deg, #B59FCA 0%, #E6B3BD 100%);
        }

        .forgot-password {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: white;
            text-decoration: underline;
        }

        /* Table Section */
        .table-section {
            animation: slideInRight 0.8s ease;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .table-header {
            text-align: center;
            margin-bottom: 10px;
            flex-shrink: 0;
        }

        .table-header h2 {
            color: white;
            font-size: 1.3rem;
            font-weight: 700;
            letter-spacing: -0.01em;
            margin-bottom: 4px;
        }

        /* Filter mode pilihan (dipakai grafik) & subtitle -- sama pola dengan
           akademik/dashboard: <select> auto-submit, bukan checkbox, supaya nilainya
           SELALU ikut terkirim di query string (checkbox yang tidak dicentang tidak
           terkirim sama sekali, jadi tidak bisa dibedakan dari "belum pernah disentuh"
           kalau defaultnya justru true). */
        .chart-subtitle {
            color: rgba(255, 255, 255, 0.75);
            font-size: 0.8rem;
            margin-bottom: 8px;
        }

        .filter-mode-pilihan select {
            padding: 4px 10px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            font-size: 0.82rem;
        }

        .filter-mode-pilihan select option {
            color: #2d1c3e;
        }

        .chart-canvas-wrap {
            position: relative;
            flex: 1;
            min-height: 320px;
        }

        .table-responsive {
            flex: 1;
            min-height: 0;
            overflow-y: auto;
        }

        /* Tabel Kuota Dosen dikecilkan (font & padding) -- kolomnya sekarang lebih
           sempit (berbagi dengan kartu Login di .left-column), jadi nama dosen +
           badge kuota perlu pas tanpa bikin baris terlalu tinggi/lebar. */
        /* table-layout:fixed + lebar kolom pasti supaya nama dosen SELALU wrap di
           dalam kolomnya sendiri (bukan meluber/kepotong ke kanan) di lebar layar
           manapun -- table-layout:auto (default) bisa bikin tabel melebar ngikutin
           teks terpanjang, dan itu yang bikin nama & kolom Kuota kepotong di layar
           yang lebih sempit. */
        .modern-table {
            width: 100%;
            table-layout: fixed;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            font-size: 0.76rem;
        }

        .modern-table th:first-child, .modern-table td:first-child {
            width: 74%;
            text-align: left;
        }

        .modern-table th:last-child, .modern-table td:last-child {
            width: 26%;
        }

        /* Nama dosen dipaksa 1 baris (bukan wrap ke bawah seperti sebelumnya) --
           font-size-nya di-auto-shrink lewat JS (lihat script di bawah) supaya nama
           yang kepanjangan tetap muat tanpa bikin baris tabel jadi tinggi/berantakan.
           text-overflow:ellipsis cuma jaring pengaman kalau JS gagal jalan atau nama
           masih kepanjangan walau sudah di-shrink sampai batas minimum. */
        .modern-table tbody td:first-child {
            overflow: hidden;
        }

        .modern-table tbody td:first-child strong {
            display: inline-block;
            max-width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            vertical-align: middle;
        }

        .modern-table thead {
            background: linear-gradient(135deg, #C8B1DB 0%, #F2C4CE 100%);
        }

        .modern-table thead th {
            color: white;
            padding: 8px 8px;
            font-weight: 500;
            text-align: center;
            border: none;
            font-size: 0.72rem;
            white-space: nowrap;
        }

        .modern-table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .modern-table tbody tr:hover {
            background: rgba(200, 177, 219, 0.08);
        }

        .modern-table tbody td {
            padding: 6px 8px;
            text-align: center;
            border: none;
            font-size: 0.74rem;
            line-height: 1.25;
        }

        .quota-badge {
            display: inline-block;
            padding: 3px 9px;
            border-radius: 14px;
            font-weight: 500;
            font-size: 0.7rem;
            white-space: nowrap;
        }

        .quota-available {
            background: linear-gradient(135deg, #D4E6F1 0%, #E8F3F5 100%);
            color: #5A7A8C;
            border: 1px solid rgba(212, 230, 241, 0.5);
        }

        .quota-full {
            background: linear-gradient(135deg, #FCD2D1 0%, #FFE5E5 100%);
            color: #A66B6B;
            border: 1px solid rgba(252, 210, 209, 0.5);
        }

        .quota-partial {
            background: linear-gradient(135deg, #FFEDD1 0%, #FFF4E6 100%);
            color: #B89968;
            border: 1px solid rgba(255, 237, 209, 0.5);
        }

        /* Alert Styles */
        .custom-alert {
            border-radius: 12px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 20px;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-danger {
            background: linear-gradient(135deg, #FCD2D1 0%, #FFE5E5 100%);
            color: #8B5A5A;
            border: 1px solid rgba(252, 210, 209, 0.3);
        }

        .alert-success {
            background: linear-gradient(135deg, #D4E6F1 0%, #E8F3F5 100%);
            color: #5A7A8C;
            border: 1px solid rgba(212, 230, 241, 0.3);
        }

        /* Footer */
        .login-footer {
            text-align: center;
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .login-footer h3 {
            color: white;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: -0.01em;
            margin-bottom: 10px;
        }

        .login-footer p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        /* Responsive Design -- di bawah 1200px, 3 kolom ditumpuk jadi 1 kolom vertikal.
           Muat semuanya dalam 1 layar (height:100vh, overflow:hidden di .main-container)
           tidak realistis lagi untuk 3 panel bertumpuk, jadi dikembalikan scrollable. */
        @media (max-width: 1200px) {
            .main-container {
                height: auto;
                min-height: 100vh;
                overflow: visible;
                padding: 20px;
            }

            .content-wrapper {
                grid-template-columns: 1fr;
                max-width: 800px;
                height: auto;
                max-height: none;
            }

            .left-column {
                height: auto;
            }

            .login-section, .chart-section, .table-section {
                height: auto;
            }

            .glass-card.table-card {
                height: auto;
            }

            .table-responsive {
                max-height: 45vh;
            }
        }

        @media (max-width: 576px) {
            .glass-card {
                padding: 20px;
            }

            .glass-card.table-card {
                padding: 15px;
            }

            .login-header h1 {
                font-size: 1.8rem;
            }

            .table-header h2 {
                font-size: 1.3rem;
            }

            .modern-table {
                font-size: 0.85rem;
            }

            .modern-table thead th,
            .modern-table tbody td {
                padding: 8px 5px;
            }
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #C8B1DB 0%, #F2C4CE 100%);
            border-radius: 10px;
        }

        /* Loading Animation */
        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }
    </style>
</head>

<body>
    <!-- Animated Background Orbs -->
    <div class="bg-orb orb1"></div>
    <div class="bg-orb orb2"></div>
    <div class="bg-orb orb3"></div>

    <div class="main-container">
        <div class="content-wrapper">
            <!-- Kolom kiri: Login + Kuota Dosen ditumpuk -->
            <div class="left-column">
                <div class="login-section">
                    <div class="glass-card">
                        <div class="login-header">
                            <h1>LOGIN</h1>
                            <p><i class="fas fa-graduation-cap" style="font-size: 1rem;"></i> Masuk pakai akun UGM Anda</p>
                        </div>

                        <!-- Alerts -->
                        <?php
                        $error = $this->session->flashdata('error');
                        if ($error) {
                        ?>
                            <div class="custom-alert alert-danger">
                                <button type="button" class="btn-close btn-close-white float-end" data-bs-dismiss="alert"></button>
                                <?php echo $error; ?>
                            </div>
                        <?php }
                        $success = $this->session->flashdata('success');
                        if ($success) {
                        ?>
                            <div class="custom-alert alert-success">
                                <button type="button" class="btn-close btn-close-white float-end" data-bs-dismiss="alert"></button>
                                <?php echo $success; ?>
                            </div>
                        <?php } ?>

                        <a href="<?php echo base_url(); ?>login/ssoLogin" class="btn-login" style="display:block; text-align:center; text-decoration:none;">
                            <i class="fas fa-shield-alt"></i> Login dengan SSO TRPL
                        </a>

                        <div class="login-footer">
                            <h3><i class="fas fa-graduation-cap pulse" style="font-size: 1rem;"></i> Proyek Akhir TRPL</h3>
                            <p>©2022 All Rights Reserved.</p>
                        </div>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="table-section">
                    <div class="glass-card table-card">
                        <div class="table-header">
                            <h2><i class="fas fa-users" style="font-size: 1.1rem;"></i> Kuota Dosen Pembimbing</h2>
                        </div>

                        <div class="table-responsive">
                            <table class="modern-table">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-user-tie" style="font-size: 0.7rem;"></i> Nama Dosen</th>
                                        <th><i class="fas fa-chart-pie" style="font-size: 0.7rem;"></i> Kuota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataTable as $data) { ?>
                                        <tr>
                                            <td>
                                                <strong>
                                                    <?php echo $data['gelar_depan']; ?>
                                                    <?php echo $data['nama_dosen']; ?>
                                                    <?php echo $data['gelar_belakang']; ?>
                                                </strong>
                                            </td>
                                            <td>
                                                <?php
                                                if (!isset($data['bimbingan']) || is_null($data['bimbingan'])) {
                                                    echo '<span class="quota-badge quota-available"><i class="fas fa-info-circle" style="font-size: 0.65rem;"></i> N/A</span>';
                                                } else {
                                                    $bimbingan = intval($data['bimbingan']);
                                                    $kuota = intval($data['kuota_mahasiswa']);
                                                    $percentage = ($kuota > 0) ? ($bimbingan / $kuota * 100) : 0;

                                                    if ($percentage >= 100) {
                                                        echo '<span class="quota-badge quota-full">';
                                                    } elseif ($percentage >= 50) {
                                                        echo '<span class="quota-badge quota-partial">';
                                                    } else {
                                                        echo '<span class="quota-badge quota-available">';
                                                    }

                                                    echo $bimbingan . ' / ' . $kuota;
                                                    echo '</span>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik Pemilihan Dosen -->
            <div class="chart-section">
                <div class="glass-card table-card">
                    <div class="table-header">
                        <h2><i class="fas fa-chart-column" style="font-size: 1.2rem;"></i> Grafik Pemilihan Dosen</h2>
                        <p class="chart-subtitle">Mahasiswa yang bimbingannya masih berjalan (belum lulus)</p>
                        <form method="get" action="<?php echo base_url(); ?>" class="filter-mode-pilihan">
                            <select name="mode_pilihan" onchange="this.form.submit()">
                                <option value="pertama" <?php echo $hanyaPilihanPertama ? 'selected' : ''; ?>>Hanya Pilihan ke-1</option>
                                <option value="semua" <?php echo !$hanyaPilihanPertama ? 'selected' : ''; ?>>Semua Pilihan (1-3)</option>
                            </select>
                        </form>
                    </div>
                    <div class="chart-canvas-wrap">
                        <canvas id="grafikPemilihDosen"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });

        // Nama dosen dipaksa 1 baris (CSS: white-space:nowrap) -- kalau nama+gelarnya
        // kepanjangan buat muat di kolomnya, kecilkan font bertahap sampai pas,
        // dibatasi font minimum biar tetap kebaca. text-overflow:ellipsis di CSS jadi
        // jaring pengaman terakhir kalau masih kepanjangan walau sudah di font minimum.
        //
        // HARUS nunggu document.fonts.ready dulu -- kalau langsung jalan, lebar teks
        // masih dihitung pakai font fallback (Google Font "Plus Jakarta Sans" belum
        // selesai dimuat), jadi hasil shrink-nya cocok buat font fallback tapi jadi
        // kependekan lagi begitu font aslinya masuk & teks melebar ulang.
        function shrinkNamaDosenAgarMuat() {
            document.querySelectorAll('.modern-table tbody td:first-child strong').forEach(function (el) {
                var fontSize = parseFloat(getComputedStyle(el).fontSize);
                var minFontSize = 7;
                while (el.scrollWidth > el.clientWidth && fontSize > minFontSize) {
                    fontSize -= 0.5;
                    el.style.fontSize = fontSize + 'px';
                }
            });
        }
        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(shrinkNamaDosenAgarMuat);
        } else {
            shrinkNamaDosenAgarMuat();
        }

        // Grafik Pemilihan Dosen -- data dari controller (Login::isLoggedIn()), sama
        // sumbernya (getRekapDipilihMahasiswaPerDosen) dengan grafik di akademik/dashboard,
        // cuma dikunci ke "hanya pilihan ke-1" karena ini halaman publik/sekilas info.
        const grafikLabels          = <?= json_encode($chartLabels ?? [], JSON_UNESCAPED_UNICODE); ?>;
        const grafikProyekVals      = <?= json_encode($chartProyekVals ?? [], JSON_NUMERIC_CHECK); ?>;
        const grafikUsulVals        = <?= json_encode($chartUsulVals ?? [], JSON_NUMERIC_CHECK); ?>;
        const grafikPembimbing2Vals = <?= json_encode($chartPembimbing2Vals ?? [], JSON_NUMERIC_CHECK); ?>;

        new Chart(document.getElementById('grafikPemilihDosen').getContext('2d'), {
            type: 'bar',
            data: {
                labels: grafikLabels,
                datasets: [
                    {
                        label: 'Mahasiswa Memilih Proyek',
                        data: grafikProyekVals,
                        backgroundColor: 'rgba(200, 177, 219, 0.7)',
                        borderColor: 'rgba(200, 177, 219, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Mengusulkan Judul (Pembimbing 1)',
                        data: grafikUsulVals,
                        backgroundColor: 'rgba(242, 196, 206, 0.7)',
                        borderColor: 'rgba(242, 196, 206, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Diusulkan sbg Pembimbing 2',
                        data: grafikPembimbing2Vals,
                        backgroundColor: 'rgba(212, 230, 241, 0.7)',
                        borderColor: 'rgba(212, 230, 241, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                // Beri sedikit ruang ekstra di bawah supaya nama dosen yang dirotasi
                // di sumbu-x punya tempat cukup -- tanpa ini Chart.js bisa memotong
                // labelnya dengan "..." kalau ruangnya pas-pasan.
                layout: { padding: { bottom: 8 } },
                plugins: {
                    legend: { display: true, position: 'top', labels: { color: '#fff' } },
                    tooltip: { enabled: true }
                },
                scales: {
                    x: {
                        stacked: true,
                        // autoSkip:false + rotasi tetap 60° supaya SEMUA nama dosen
                        // selalu ditampilkan penuh (bukan di-skip/dipotong "...")
                        // walau jumlah dosennya banyak.
                        ticks: { color: '#fff', autoSkip: false, maxRotation: 60, minRotation: 60 },
                        grid: { color: 'rgba(255,255,255,0.15)' }
                    },
                    y: { stacked: true, beginAtZero: true, ticks: { color: '#fff', precision: 0 }, grid: { color: 'rgba(255,255,255,0.15)' } }
                }
            }
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.custom-alert');
            alerts.forEach(alert => {
                alert.style.animation = 'slideDown 0.5s ease reverse';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Add ripple effect to login button
        document.querySelector('.btn-login').addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');

            this.appendChild(ripple);

            setTimeout(() => ripple.remove(), 600);
        });

        // Password visibility toggle
        const passwordInput = document.querySelector('input[name="password"]');
        const lockIcon = passwordInput.previousElementSibling;

        lockIcon.style.cursor = 'pointer';
        lockIcon.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.classList.remove('fa-lock');
                this.classList.add('fa-lock-open');
            } else {
                passwordInput.type = 'password';
                this.classList.remove('fa-lock-open');
                this.classList.add('fa-lock');
            }
        });
    </script>
</body>
</html>
