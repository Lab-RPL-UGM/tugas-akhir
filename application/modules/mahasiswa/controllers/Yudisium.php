<?php
/**
 * Created by nad.
 * Date: 23/03/2018
 * Time: 14:28
 * Description:
 */

class Yudisium extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Yudisium_model');
        $this->isLoggedIn();
        $this->isMahasiswa();
    }
    /**
     * This function is used to load main page
     */
    function index()
    {
        if($this->isMahasiswa() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $userId = $this->vendorId;
            $this->global['pageTitle'] = "TA-TRPL : Yudisium";

            $data['berkasInfo'] = $this->Yudisium_model->getBerkasInfo($userId);
            $data['periodeInfo'] = $this->Yudisium_model->getPeriode();
            $data['idBerkas'] = $this->Yudisium_model->getIdBerkas();
            $data['totalSyarat'] = $this->Yudisium_model->getCountBerkas();
            $data['sidang'] = $this->Yudisium_model->getSidang($userId);
            $data['idMahasiswa'] = $this->Yudisium_model->cekMahasiswa($userId);

            $this->loadViews("yudisium", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used to registration Yudisium
     */
    function daftar(){
        //get id user who is logged in
        $id_user = $this->vendorId;
//            get id_mahasiswa based on who is logged in
        $cek = $this->Yudisium_model->cekMahasiswa($id_user);
        $id_mahasiswa = $cek[0]->id_mahasiswa;
//        get id_periode
        $id_periode = $this->input->post('id_periode');

        $infoYudisium = array(
            "id_mahasiswa"=>$id_mahasiswa,
            "id_periode"=>$id_periode
        );
//            insert to table yudisium / registration yudisium new
        $idYudisium = $this->Yudisium_model->addNewYudisium($infoYudisium);
//            insert to validasi yudisium table, satu baris per syarat AKTIF -- query ulang
//            daftar ID-nya (bukan nebak lewat id_syarat++) supaya tidak salah pasang kalau
//            ada syarat yang dinonaktifkan di tengah urutan ID.
        $daftarBerkas = $this->Yudisium_model->getIdBerkas();
        $result = 0;
        foreach ($daftarBerkas as $berkas) {
            $daftarId = array(
                "id_yudisium"=>$idYudisium,
                "id_berkas_yudisium"=>$berkas->id_berkas_yudisium
            );
            $result = $this->Yudisium_model->addNewValidasi($daftarId);
        }
//            lebih dari 0 berarti ada data yg masuk
        if ($result>0)
        {
            $this->session->set_flashdata('success','Berhasil daftar yudisium');
        }
        else
        {
            $this->session->set_flashdata('error','Gagal daftar yudisium');
        }

        redirect('mahasiswa/yudisium');
    }
    /**
     * This function is used to edit files upload requirement files
     */
    function editBerkas () {
        if($this->isMahasiswa() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $id_folder = $this->input->post('id_berkas_yudisium');
            $nim = $this->input->post('id_mahasiswa');
            $cekMhs = $this->Yudisium_model->cekMahasiswa($nim);

            if (!$cekMhs)
                $this->load->library('form_validation');
            $this->form_validation->set_rules('id_valid_yudisium','ID','required');
            $id_berkas = $this->input->post('id_valid_yudisium');
            //            get total syarat
            $total_syarat = $this->input->post('total_syarat');
// upload files based on each folder in uploads folder
            for ($i=1;$i<=$total_syarat;$i++)
            {
                $config['upload_path'] = 'uploads/yudisium/'.$id_folder;
                $new_name = "yudisium-".$id_folder."-".time();
                $config['file_name'] = $new_name;
            }
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 10000;
            $config['max_width'] = 1024;
            $config['max_height'] = 1024;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('path')){
                // if upload path error
                $error = array('error' => $this->upload->display_errors());
                // echo $error['error'];
                $this->session->set_flashdata('error', 'Berkas tidak sesuai ketentuan');
            }else{
                // if upload path success
                $terupload = $this->upload->data();
                $berkasInfo = array(
                    'path'=>$terupload['file_name'],
                    'isValid'=>1
                );

                $result = $this->Yudisium_model->editBerkas($berkasInfo, $id_berkas);

                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Berkas berhasil diunggah');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Berkas gagal diunggah');
                }
            }
            redirect('mahasiswa/yudisium');
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