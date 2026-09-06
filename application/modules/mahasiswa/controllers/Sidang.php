<?php

/**
 * Created by nad.
 * Date: 23/03/2018
 * Time: 14:27
 * Description:
 */

class Sidang extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sidang_model');
        $this->load->model('pendadaran_model');
        $this->load->model('Pengajuan_model');
        $this->isLoggedIn();
        $this->isMahasiswa();
    }
    /**
     * This function is used to load main page
     */
    function index()
    {
        if ($this->isMahasiswa() == TRUE) {
            $this->loadThis();
        } else {
            $userId = $this->vendorId;
            $data['berkasInfo'] = $this->Sidang_model->getBerkasInfo($userId);
            $data['idBerkas'] = $this->Sidang_model->getIdBerkas();
            $data['idPeriode'] = $this->Sidang_model->getIdPeriode();
            $data['totalSyarat'] = $this->Sidang_model->getCountBerkas();
            $data['ta'] = $this->Sidang_model->getTa($userId);

            $data['idMahasiswa'] = $this->Sidang_model->cekMahasiswa($userId);

            $userId = $this->vendorId;
            $data['sidangInfo'] = $this->pendadaran_model->getSidang($userId);

            $this->global['pageTitle'] = "TA-TRPL : Sidang";
            // echo "<pre>";
            // print_r($data);
            // exit;
            $this->loadViews("sidang", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used to registration Sidang
     */
    function daftar()
    {
        //          get id user who is logged in
        $id_user = $this->vendorId;
        //            get id_periode
        $id_periode = $this->input->post('id_periode');
        //            get id_mahasiswa based on who is logged in
        $cek = $this->Sidang_model->cekMahasiswa($id_user);
        $id_mahasiswa = $cek[0]->id_mahasiswa;
        $infoSidang = array("id_mahasiswa" => $id_mahasiswa, "id_periode" => $id_periode);
        //            insert to table sidang / registration sidang new
        $idSidang = $this->Sidang_model->addNewSidang($infoSidang);
        //            insert to validasi_berkas_sidang table, satu baris per syarat AKTIF --
        //            query ulang daftar ID-nya (bukan nebak lewat id_syarat++) supaya tidak
        //            salah pasang kalau ada syarat yang dinonaktifkan di tengah urutan ID.
        $daftarBerkas = $this->Sidang_model->getIdBerkas();
        $result = 0;
        foreach ($daftarBerkas as $berkas) {
            $daftarId = array(
                "id_sidang" => $idSidang,
                "id_berkas_sidang" => $berkas->id_berkas_sidang
            );
            $result = $this->Sidang_model->addNewValidasi($daftarId);
        }
        //            lebih dari 0 berarti ada data yg masuk
        if ($result > 0) {
            $this->session->set_flashdata('success', 'Daftar sidang berhasil!');
        } else {
            $this->session->set_flashdata('error', 'Daftar sidang gagal!');
        }

        redirect('mahasiswa/sidang');
    }

    function daftarUlang()
    {
        //get id user who is logged in
        $id_user = $this->vendorId;
        //        get id_sidang_lama
        $id_sidang_lama = $this->input->post('id_sidang_lama');
        //            get id_periode
        $id_periode = $this->input->post('id_periode');
        //            get id_mahasiswa based on who is logged in
        $cek = $this->Sidang_model->cekMahasiswa($id_user);
        $id_mahasiswa = $cek[0]->id_mahasiswa;
        $infoSidang = array(
            "id_mahasiswa" => $id_mahasiswa,
            "id_periode" => $id_periode,
        );
        //            insert to table sidang / registration sidang new
        $idSidang = $this->Sidang_model->addNewSidang($infoSidang);
        $berkasInfo = array(
            "id_sidang" => $idSidang
        );
        $result = $this->Sidang_model->editBerkasSidang($berkasInfo, $id_sidang_lama);

        //            lebih dari 0 berarti ada data yg masuk
        if ($result > 0) {
            $this->session->set_flashdata('success', 'Daftar ulang sidang berhasil!');
        } else {
            $this->session->set_flashdata('error', 'Daftar ulang sidang gagal!');
        }
        redirect('mahasiswa/sidang');
    }
    /**
     * This function is used to edit files upload requirement files
     */
    function editBerkas()
    {
        if ($this->isMahasiswa() == TRUE) {
            $this->loadThis();
        } else {
            //            get id berkas where to edit by folder
            $id_folder = $this->input->post('id_berkas_sidang');
            $nim = $this->input->post('id_mahasiswa');
            $cekMhs = $this->Sidang_model->cekMahasiswa($nim);
            if (!$cekMhs)
                $this->load->library('form_validation');
            $this->form_validation->set_rules('id_valid_sidang', 'ID', 'required');
            $id_berkas = $this->input->post('id_valid_sidang');
            //            get total syarat
            $total_syarat = $this->input->post('total_syarat');
            //          upload based on each folders
            for ($i = 1; $i <= $total_syarat; $i++) {
                $config['upload_path'] = 'uploads/sidang/' . $id_folder;
                $new_name = "sidang-" . $id_folder . "-" . time();
                $config['file_name'] = $new_name;
            }
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 10000;
            $config['max_width'] = 1024;
            $config['max_height'] = 1024;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('path')) {
                // if upload path not match
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', 'Berkas tidak sesuai ketentuan');
            } else {
                // if upload success, isValid = 1 = proses
                $terupload = $this->upload->data();
                $berkasInfo = array(
                    'path' => $terupload['file_name'],
                    'isValid' => 1
                );
                $result = $this->Sidang_model->editBerkas($berkasInfo, $id_berkas);
                if ($result == true) {
                    $this->session->set_flashdata('success', 'Berkas berhasil diunggah');
                } else {
                    $this->session->set_flashdata('error', 'Berkas gagal diunggah');
                }
            }
            redirect('mahasiswa/sidang');
        }
    }

    function downloadBerkasSidang()
    {
        if ($this->isMahasiswa() == TRUE) {
            $this->loadThis();
        } else {
            $userId = $this->vendorId;
            $data['mahasiswaInfo'] = $this->Pengajuan_model->getIdMahasiswa($userId);
            $data['sidangInfo'] = $this->pendadaran_model->getSidang($userId);
            $taInfo = $this->Pengajuan_model->getTa($data['sidangInfo'][0]->id_mahasiswa);
            $data['judulTa'] = "";
            if ($taInfo[0]->jenis == 'usul') {
                $data['judulTa'] = $taInfo[0]->judul;
            } else {
                $data['judulTa'] = $taInfo[0]->nama;
            }

            $data['ketuaInfo'] = $this->pendadaran_model->getKetuaSidang($data['sidangInfo'][0]->id_sidang);
            $data['sekreInfo'] = $this->pendadaran_model->getSekreSidang($data['sidangInfo'][0]->id_sidang);
            $data['anggotaInfo'] = $this->pendadaran_model->getAnggotaSidang($data['sidangInfo'][0]->id_sidang);

            $data['dataDosbing'] = $this->Pengajuan_model->getDosbing($data['sidangInfo'][0]->id_mahasiswa);

            // echo "<pre>";
            // print_r($data);
            // exit;
            $this->loadViewPdf("sidangberkas", NULL, $data, NULL);
        }
    }
    /**
     * This function is used to load the 404 page not found
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'TA-TRPL : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}
