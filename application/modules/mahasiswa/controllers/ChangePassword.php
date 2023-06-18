<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
/**
 * Created by nad.
 * Date: 23/03/2018
 * Time: 18:22
 * Description:
 */

class ChangePassword extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Change_password_model');
        $this->isLoggedIn();
        $this->isMahasiswa();
    }

    /**
     * This function is used to load the main page
     */
    function index()
    {
        if($this->isMahasiswa() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = 'Elusi : Change Password';
            $this->loadViews("change_password", $this->global, NULL, NULL);
        }
    }


    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {
        if($this->isMahasiswa() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]|min_length[5]');
            $this->form_validation->set_rules('newPassword','New password','required|max_length[20]|min_length[5]');
            $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]|min_length[5]');

            if($this->form_validation->run() == FALSE)
            {
                $this->index();
            }
            else
            {
                $oldPassword = $this->input->post('oldPassword');
                $newPassword = $this->input->post('newPassword');

                $resultPas = $this->Change_password_model->matchOldPassword($this->vendorId, $oldPassword);

                if(empty($resultPas))
                {
                    $this->session->set_flashdata('nomatch', 'Tidak sesuai dengan password lama anda');
                    redirect('mahasiswa/changepassword');
                }
                else
                {
                    $usersData = array('password'=>getHashedPassword($newPassword), 'updatedDtm'=>date('Y-m-d H:i:s'));

                    $result = $this->Change_password_model->changePassword($this->vendorId, $usersData);

                    if($result > 0) { $this->session->set_flashdata('success', 'Ubah password berhasil!'); }
                    else { $this->session->set_flashdata('error', 'Ubah password gagal!'); }

                    redirect('mahasiswa/changepassword');
                }
            }
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