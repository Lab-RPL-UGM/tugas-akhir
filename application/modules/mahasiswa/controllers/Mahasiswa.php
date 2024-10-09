<?php
/**
 * Created by nad.
 * Date: 07/03/2018
 * Time: 11:35
 * Description:
 */

class Mahasiswa extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_model');
        $this->isLoggedIn();
        $this->isMahasiswa();
    }
    /**
     * This function is used to load the main page
     */
    public function index() {
        $userId = $this->vendorId;
        $data['pesanInfo'] = $this->Dashboard_model->getPesanList($userId);
        $data['revisiInfo'] = $this->Dashboard_model->getRevisiSidang($userId);
        $this->global['pageTitle'] = "TA-TRPL : Dashboard";
        $this->loadViews("dashboard",$this->global,$data);
    }
    /**
     * This function is used to load the 404 page not found
     */
    function pageNotFound() {
        $this->global['pageTitle'] = 'TA-TRPL : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}