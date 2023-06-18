<?php

/**
 * Created by nad.
 * Date: 23/03/2018
 * Time: 14:11
 * Description:
 */

class Bimbingan extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bimbingan_model');
        $this->isLoggedIn();
        $this->isDosen();
    }
    /**
     * This function is used to load the main page
     */
    function index()
    {
        if ($this->isDosen() == TRUE) {
            $this->loadThis();
        } else {
            $userId = $this->vendorId;
            $userRole = $this->role;
            $data['bimbinganInfo'] = $this->bimbingan_model->getBimbingan($userId);
            $data['userId'] = $userId;
            $data['userRole'] = $userRole;
            $this->global['pageTitle'] = "Elusi : Bimbingan";
            $this->loadViews("bimbingan", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used load detail mahasiswa information
     * @param number $idMhs : This is mahasiswa id
     */
    function detail($idMhs = NULL)
    {
        if ($this->isDosen() == TRUE) {
            $this->loadThis();
        } else {
            if ($idMhs == null) {
                redirect('dosen/bimbingan');
            }
            $data['bimbinganInfo'] = $this->bimbingan_model->getBimbingan($idMhs);
            $data['mhsInfo'] = $this->bimbingan_model->getMahasiswa($idMhs);
            $this->loadViews("profil-mhs", $this->global, $data, NULL);
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
