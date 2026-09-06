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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
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

        /* Main Container */
        .main-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .content-wrapper {
            width: 100%;
            max-width: 1400px;
            display: grid;
            grid-template-columns: 450px 1fr;
            gap: 30px;
            align-items: start;
        }

        /* Glass Card Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 30px;
            transition: all 0.3s ease;
        }

        .glass-card.table-card {
            padding: 25px;
        }

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
            margin-bottom: 30px;
        }

        .login-header h1 {
            color: white;
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 8px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
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
            margin-bottom: 30px;
        }

        .table-header h2 {
            color: white;
            font-size: 1.6rem;
            font-weight: 600;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .modern-table {
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            font-size: 0.9rem;
        }

        .modern-table thead {
            background: linear-gradient(135deg, #C8B1DB 0%, #F2C4CE 100%);
        }

        .modern-table thead th {
            color: white;
            padding: 14px 12px;
            font-weight: 500;
            text-align: center;
            border: none;
            font-size: 0.95rem;
        }

        .modern-table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .modern-table tbody tr:hover {
            background: rgba(200, 177, 219, 0.08);
            transform: scale(1.01);
        }

        .modern-table tbody td {
            padding: 12px 10px;
            text-align: center;
            border: none;
            font-size: 0.88rem;
        }

        .quota-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
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
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .login-footer h3 {
            color: white;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .login-footer p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .content-wrapper {
                grid-template-columns: 1fr;
                max-width: 800px;
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
            <!-- Login Section -->
            <div class="login-section">
                <div class="glass-card">
                    <div class="login-header">
                        <br/><br/><br/><br/>
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
                    <br/><br/><br/>
                </div>
            </div>

            <!-- Table Section -->
            <div class="table-section">
                <div class="glass-card table-card">
                    <div class="table-header">
                        <h2><i class="fas fa-users" style="font-size: 1.4rem;"></i> Kuota Dosen Pembimbing</h2>
                    </div>

                    <div class="table-responsive">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-user-tie" style="font-size: 0.9rem;"></i> Nama Dosen</th>
                                    <th><i class="fas fa-chart-pie" style="font-size: 0.9rem;"></i> Kuota Bimbingan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataTable as $data) { ?>
                                    <tr data-aos="fade-up" data-aos-delay="100">
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
                                                echo '<span class="quota-badge quota-available"><i class="fas fa-info-circle" style="font-size: 0.8rem;"></i> Tidak ada data</span>';
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

                                                echo '<i class="fas fa-user-graduate" style="font-size: 0.8rem;"></i> ' . $bimbingan . ' / ' . $kuota;
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
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
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
