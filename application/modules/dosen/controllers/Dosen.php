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
        $data['arrayAllPeriode'] = $this->dashboard_model->getAllPeriode();

        // Filter Periode: dari dropdown (?id_periode=), default ke periode aktif --
        // sama seperti akademik/dashboard (lihat Akademik\Dashboard::index()).
        $idPeriodeFilter = $this->input->get('id_periode');
        if (empty($idPeriodeFilter) && $data['dataPeriode']) {
            $idPeriodeFilter = $data['dataPeriode'][0]->id_periode;
        }
        $data['idPeriodeFilter'] = $idPeriodeFilter;
        $isPeriodeAktif = $data['dataPeriode'] && (int)$idPeriodeFilter === (int)$data['dataPeriode'][0]->id_periode;

        $data['countBimbingan']  = $this->dashboard_model->getCountBimbingan($userId, $idPeriodeFilter, $isPeriodeAktif);
        $data['countPendadaran'] = $this->dashboard_model->getCountPendadaran($userId);
        $data['countYudisium']   = $this->dashboard_model->getCountYudisium($userId, $idPeriodeFilter, $isPeriodeAktif);
        $data['countProyek']     = $this->dashboard_model->getCountProyek($userId);

        // Kuota mahasiswa (aman jika profil kosong, tidak bikin fatal)
        $profil = $this->profil_model->getDosen($userId);
        $data['countKuota'] = (!empty($profil) && isset($profil[0]->kuota_mahasiswa))
                            ? (int)$profil[0]->kuota_mahasiswa
                            : 0;

        // --- Tabel permohonan TA (judul dari proyek/usulan) ---
        // Dipisah jadi 2 tabel di view: yang masih menunggu keputusan ('proses') dan
        // yang sudah di-ACC/disetujui ('diterima') -- lebih jelas dibanding 1 tabel
        // campur seperti sebelumnya.
        $permohonanTA = $this->dashboard_model->getPermohonanTAListByUser($userId, $idPeriodeFilter, $isPeriodeAktif);
        $data['permohonanBelumAcc'] = array_values(array_filter($permohonanTA, function ($row) {
            return $row['status_pengajuan'] === 'proses';
        }));
        $data['permohonanSudahAcc'] = array_values(array_filter($permohonanTA, function ($row) {
            return $row['status_pengajuan'] === 'diterima';
        }));

        // Render view dashboard
        // CATATAN: pastikan file ini ada → application/views/dashboard.php
        $this->loadViews("dashboard", $this->global, $data, NULL);
    }

    /**
     * Detail 1 mahasiswa yang mengajukan/sudah di-ACC -- tombol "Lihat Detail" di
     * tabel permohonan pada dashboard. Menampilkan profil mahasiswa, SEMUA pilihan
     * (proyek/usulan) yang diajukan untuk id_ta ini, dan lampiran proposal usulan.
     */
    public function detailPermohonan($id_ta)
    {
        $userId = isset($this->vendorId) ? (int)$this->vendorId
                                         : (int)$this->session->userdata('id_user');

        // Cegah dosen intip detail mahasiswa/proposal punya dosen lain cuma dengan
        // menebak-nebak id_ta di url -- harus benar2 terkait ke pengajuan ini.
        if (!$this->dashboard_model->isDosenTerkaitTa($id_ta, $userId)) {
            show_404();
            return;
        }

        $dataMahasiswa = $this->dashboard_model->getDetailMahasiswaTa($id_ta);
        if (empty($dataMahasiswa)) {
            show_404();
            return;
        }

        $data['dataMahasiswa'] = $dataMahasiswa;
        $data['dataPilihan'] = $this->dashboard_model->getPilihanTa($id_ta);

        $this->global['pageTitle'] = "TA-TRPL : Detail Permohonan TA";
        $this->loadViews("detail_permohonan", $this->global, $data, NULL);
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