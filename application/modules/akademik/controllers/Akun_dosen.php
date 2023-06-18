<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_dosen extends BaseController
{
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->isLoggedIn();
        $this->isAkademik();
    }

    public function index(){
        $data['dataTable'] = $this->User_model->getUserDosenTable(ROLE_DOSEN);
        $data['role'] = ROLE_DOSEN;
        $this->global['pageTitle'] = "Elusi : Dashboard User Dosen"; 
        $this->loadViews("dashboard_dosen",$this->global,$data);
    }

    public function add_form(){
        $data['role'] = ROLE_DOSEN;
        $this->global['pageTitle'] = "Elusi : Add New User"; 
        $this->loadViews("add_user",$this->global,$data);
    }

    public function edit_form($id){
        $data['role'] = ROLE_DOSEN;
        $data['dataUser'] = $this->User_model->getUser($id,ROLE_DOSEN);
        $this->global['pageTitle'] = "Elusi : Edit User"; 
        $this->loadViews("edit_user",$this->global,$data);
    }
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Elusi : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}