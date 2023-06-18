<?php
/**
 * Created by nad.
 * Date: 07/03/2018
 * Time: 11:32
 * Description:
 */

class Dosen extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model');
        $this->load->model('profil_model');
        $this->isLoggedIn();
        $this->isDosen();
    }
    /**
     * This function is used to load the dashboard items
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

            $this->global['pageTitle'] = "Elusi : Dashboard";
            $data['countBimbingan'] = $this->dashboard_model->getCountBimbingan($userId);
            $data['countPendadaran'] = $this->dashboard_model->getCountPendadaran($userId);
            $data['countYudisium'] = $this->dashboard_model->getCountYudisium($userId);
            $data['countProyek'] = $this->dashboard_model->getCountProyek($userId);
            $data['countKuota'] = $this->profil_model->getDosen($userId)[0]->kuota_mahasiswa;

            $this->loadViews("dashboard", $this->global, $data, NULL);
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