<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Akademik extends BaseController
{
    public function __construct() {
        parent::__construct();
        $this->isLoggedIn();
        $this->isAkademik();
    }

    public function index(){
        redirect('akademik/dashboard');
        
    }
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Elusi : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}