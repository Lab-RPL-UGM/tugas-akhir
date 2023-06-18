<?php
/**
 * Created by nad.
 * Date: 23/03/2018
 * Time: 14:17
 * Description:
 */

class Pengumuman extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Pengumuman_model');
        $this->isLoggedIn();
        $this->isMahasiswa();
    }
    /**
     * This function is used to load the main page
     */
    public function index(){
        $data['dataTable'] = $this->Pengumuman_model->getPengumumanList();
        $this->global['pageTitle'] = "Elusi : Pengumuman";
        $this->loadViews("pengumuman",$this->global,$data);
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