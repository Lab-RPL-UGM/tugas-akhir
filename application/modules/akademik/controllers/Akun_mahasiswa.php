<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_mahasiswa extends BaseController
{
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->isLoggedIn();
        $this->isAkademik();
    }

    public function index(){
        $data['dataTable'] = $this->User_model->getUserTableWithTA();
        $data['role'] = ROLE_MAHASISWA;
        $this->global['pageTitle'] = "TA-TRPL : Dashboard User Mahasiswa";
        $this->loadViews("dashboard_mahasiswa",$this->global,$data);
    }

    public function add_form(){
        $data['role'] = ROLE_MAHASISWA;
        $this->global['pageTitle'] = "TA-TRPL : Add New User";
        $this->loadViews("add_user",$this->global,$data);
    }

    public function edit_form($id){
        $data['role'] = ROLE_MAHASISWA;
        $data['dataUser'] = $this->User_model->getUser($id,ROLE_MAHASISWA);
        $data['ta'] = $this->User_model->getTA($id);
        $data['status_pengambilan'] = $data['ta'][0]->status_pengambilan;
        $this->global['pageTitle'] = "TA-TRPL : Edit User";
        $this->loadViews("edit_user",$this->global,$data);
    }
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'TA-TRPL : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}