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
        $this->load->model('profil_model');
        $this->isLoggedIn();
        $this->isDosen();
    }
    /**
     * This function is used to load the profil list
     */
    function index()
    {
        if($this->isDosen() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $userId = $this->vendorId;
            $userRole = $this->role;

            $data['profilInfo'] = $this->profil_model->getDosen($userId);
            $data['userId'] = $userId;
            $data['userRole'] = $userRole;
            $this->global['pageTitle'] = "Elusi : Profil";

            $this->loadViews("profil", $this->global, $data, NULL);
        }
    }
    function checkNidExists(){
        $idDosen = $this->input->post("id_dosen");
        $nid = $this->input->post("nid");

        if(empty($idDosen)){
            $result = $this->profil_model->checkNid($nid);
        } else {
            $result = $this->profil_model->checkNid($nid, $idDosen);
        }

        if ($result) {
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
        }
    }
    function checkEmailExists(){
        $idDosen = $this->input->post("id_dosen");
        $email = $this->input->post("email");

        if(empty($idDosen)){
            $result = $this->profil_model->checkEmail($email);
        } else {
            $result = $this->profil_model->checkEmail($email, $idDosen);
        }

        if ($result) {
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
        }
    }
    /**
     * This function is used to edit the profil information
     */
    function editProfil()
    {
        if($this->isDosen() == TRUE){$this->loadThis();}
        else
        {   $this->load->library('form_validation');
            $this->form_validation->set_rules('nid','NID','trim|required|xss_clean');
            $this->form_validation->set_rules('nama','Nama Dosen','trim|required|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('mobile','Mobile','trim|required|xss_clean');

            if($this->form_validation->run() != FALSE)
            {$this->session->set_flashdata('success', 'Data yang dimasukkan harus benar');
                redirect('dosen/profil');}
            else{
                $id_user = $this->input->post('id_user');
                $id_dosen = $this->input->post('id_dosen');
                $nid = $this->input->post('nid');
                $nama = $this->input->post('nama');
                $email = $this->input->post('email');
                $mobile = $this->input->post('mobile');
                $skill = $this->input->post('skill');
                if (empty($cekNid)) {
                    $dosenInfo = array(
                        'nid'=>$nid,
                        'nama'=>$nama,
                        'email'=>$email,
                        'mobile'=>$mobile,
                        'skill'=>$skill);
                    $userInfo = array('nama'=>$nama);
                    $resultUser = $this->profil_model->editUser($userInfo, $id_user);
                    $result = $this->profil_model->editProfil($dosenInfo, $id_dosen);
                    if($result > 0){$this->session->set_flashdata('success', 'Profil berhasil diperbaharui');}
                    else{$this->session->set_flashdata('error', 'Profil gagal diperbaharui');}
                } else {$this->session->set_flashdata('error', 'NID sudah ada');}
                redirect('dosen/profil');
            }
        }
    }
    /**
     * This function is used to edit the photo information
     */
    function editPhoto () {
        if($this->isDosen() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('id_dosen','ID','required');

            $id_dosen = $this->input->post('id_dosen');

            $config['upload_path'] = 'uploads/foto/dosen';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 4000;
            $config['max_width'] = 1024;
            $config['max_height'] = 1024;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('foto')){
                // bila uplod foto error
                $error = array('error' => $this->upload->display_errors());
                // echo $error['error'];
                $this->session->set_flashdata('error', 'Maksimum 4mb dan 1024x1024');
            }else{
                // bila upload foto berhasil
                $terupload = $this->upload->data();
                $dosenInfo = array('foto'=>$terupload['file_name'], 'updatedDtm'=>date('Y-m-d H:i:s'));

                $result = $this->profil_model->editProfil($dosenInfo, $id_dosen);

                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Foto berhasil diperbaharui!');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Foto gagal diperbaharui!');
                }
            }
            redirect('dosen/profil');
        }
    }
    /**
     * This function is used to load the 404 page not found
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Elusi : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}
?>
