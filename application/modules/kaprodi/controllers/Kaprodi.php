<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kaprodi extends BaseController
{
    public function __construct() {
        parent::__construct();
        $this->isLoggedIn();
        $this->isKaprodi();
    }

    public function index(){
        $this->load->view('kaprodi_view');
    }

    public function switch_akademik(){
        $this->session->set_userdata('role', ROLE_AKADEMIK);
        $this->session->set_userdata('isKaprodi', TRUE);
        redirect('akademik');
    }

    public function switch_dosen(){
        $this->session->set_userdata('role', ROLE_DOSEN);
        $this->session->set_userdata('isKaprodi', TRUE);
        redirect('dosen');
    }
}