<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Profil extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Profil_model');
        $this->isLoggedIn();
        $this->isMahasiswa();
    }

    /**
     * This function is used to load the profil list
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
            $userRole = $this->role;

            $data['profilInfo'] = $this->Profil_model->getMahasiswa($userId);
            $data['userId'] = $userId;
            $data['userRole'] = $userRole;
            $this->global['pageTitle'] = "TA-TRPL : Profil";

            $this->loadViews("profil", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used to edit the profil information
     */
    function editProfil()
    {
        if($this->isMahasiswa() == TRUE)
        {$this->loadThis();}
        else
        {
            $id_user = $this->input->post('id_user');
            $id_mahasiswa = $this->input->post('id_mahasiswa');
            $nim = $this->input->post('nim');
            $nama = $this->input->post('nama');
            $jumlah_SKS = $this->input->post('jumlah_SKS');
            $ipk = $this->input->post('ipk');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobile');
            $skill = $this->input->post('skill');
            $pengalaman = $this->input->post('pengalaman');

            $mahasiswaInfo = array(
                'nim'=>$nim,
                'nama'=>$nama,
                'jumlah_SKS'=>$jumlah_SKS,
                'ipk'=>$ipk,
                'email'=>$email,
                'mobile'=>$mobile,
                'skill'=>$skill,
                'pengalaman'=>$pengalaman);

            $userInfo = array('nama'=>$nama);
            $resultUser = $this->Profil_model->editUser($userInfo,$id_user);
            $result = $this->Profil_model->editProfil($mahasiswaInfo, $id_mahasiswa);

            if($result > 0)
            {$this->session->set_flashdata('success', 'Profil berhasil diubah!');}
            else{$this->session->set_flashdata('error', 'Profil gagal diubah!');}
            redirect('mahasiswa/profil');
        }
    }
    /**
     * This function is used to edit the photo information
     */
    function editPhoto () {
        if($this->isMahasiswa() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('id_mahasiswa','ID','required');

            $id_mahasiswa = $this->input->post('id_mahasiswa');

            $config['upload_path'] = 'uploads/foto/mahasiswa';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 4000;
            $config['max_width'] = 1024;
            $config['max_height'] = 1024;
            $new_name = "Foto-".time();
            $config['file_name'] = $new_name;

            $this->load->library('upload', $config);

            if (empty($_FILES['foto']['name'])) {
                // belum pilih file sama sekali -- jangan disamakan dengan error
                // ukuran/tipe file, supaya jelas apa yang perlu diperbaiki
                $this->session->set_flashdata('error', 'Pilih foto terlebih dahulu sebelum menekan Save');
            } else if ( ! $this->upload->do_upload('foto')){
                // if upload foto tidak sesuai -- tampilkan alasan aslinya (tipe file,
                // ukuran, dimensi, dll) daripada pesan generik yang bisa menyesatkan
                $this->session->set_flashdata('error', strip_tags($this->upload->display_errors('', '')));
            }else{
                // bila upload foto berhasil
                $terupload = $this->upload->data();
                $mahasiswaInfo = array('foto'=>$terupload['file_name']);

                $result = $this->Profil_model->editProfil($mahasiswaInfo, $id_mahasiswa);
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Ubah foto berhasil!');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Ubah foto gagal!');
                }
            }
            redirect('mahasiswa/profil');
        }
    }
//    email can't be same
    function checkEmailExists(){
        $idMhs = $this->input->post("id_mahasiswa");
        $email = $this->input->post("email");

        if(empty($idMhs)){
            $result = $this->Profil_model->checkEmail($email);
        } else {
            $result = $this->Profil_model->checkEmail($email, $idMhs);
        }

        if ($result) {
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
        }
    }
//      nim is unique
    function checkNimExists(){
        //if (array_key_exists('email', $_POST)) {
        $idMhs = $this->input->post("id_mahasiswa");
        $nim = $this->input->post("nim");

        if(empty($idMhs)){
            $result = $this->Profil_model->checkNim($nim);
        } else {
            $result = $this->Profil_model->checkNim($nim, $idMhs);
        }

        if ($result) {
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
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

?>
