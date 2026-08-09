<?php
/**
 * Created by nad.
 * Date: 07/03/2018
 * Time: 11:32
 * Description:
 */

class Dosen extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model');
        $this->load->model('profil_model');
        $this->isLoggedIn(); // pastikan user sudah login
        // CATATAN: jangan redirect di sini; cukup set flag/role di session
    }

    /**
     * Dashboard dosen
     */
    public function index()
    {
        // ✅ Jika BUKAN dosen → tampilkan 404 bawaan CI (bukan view error_404.php)

        // Ambil id_user dari BaseController (vendorId) atau dari session
        $userId = isset($this->vendorId) ? (int)$this->vendorId
                                         : (int)$this->session->userdata('id_user');

        // Judul halaman (dipakai oleh loadViews)
        $this->global['pageTitle'] = "TA-TRPL : Dashboard";

        // --- Ringkasan & periode (sesuai model yang sudah ada) ---
        $data['dataPeriode']     = $this->dashboard_model->getPeriodeAktif();
        $data['countBimbingan']  = $this->dashboard_model->getCountBimbingan($userId);
        $data['countPendadaran'] = $this->dashboard_model->getCountPendadaran($userId);
        $data['countYudisium']   = $this->dashboard_model->getCountYudisium($userId);
        $data['countProyek']     = $this->dashboard_model->getCountProyek($userId);

        // Kuota mahasiswa (aman jika profil kosong, tidak bikin fatal)
        $profil = $this->profil_model->getDosen($userId);
        $data['countKuota'] = (!empty($profil) && isset($profil[0]->kuota_mahasiswa))
                            ? (int)$profil[0]->kuota_mahasiswa
                            : 0;

        // --- Tabel permohonan TA (judul dari proyek/usulan) ---
        // Pastikan Dashboard_model sudah punya getPermohonanTAListByUser($userId) (SQL final kita tadi)
        $data['permohonanTA'] = $this->dashboard_model->getPermohonanTAListByUser($userId);

        // Render view dashboard
        // CATATAN: pastikan file ini ada → application/views/dashboard.php
        $this->loadViews("dashboard", $this->global, $data, NULL);
    }

    /**
     * 404 manual (jika butuh)
     */
    public function pageNotFound()
    {
        // Jangan memanggil view error_404.php yang tidak ada; pakai mekanisme CI
        show_404();
    }
}