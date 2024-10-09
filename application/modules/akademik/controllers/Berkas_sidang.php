<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by nad.
 * Date: 02/04/2018
 * Time: 19:15
 * Description:
 */

class Berkas_sidang extends BaseController
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Berkas_model');
        $this->isLoggedIn();
        $this->isAkademik();
    }
    public function index(){
        if($this->isAkademik() == TRUE)
        {
            $this->loadThis();
        }
        else {
            $data['dataTable'] = $this->Berkas_model->getBerkas();
            $this->global['pageTitle'] = "TA-TRPL : Berkas Sidang";
            $this->loadViews("dashboard_berkas_sidang", $this->global, $data);
        }
    }
//    tambah syarat berkas sidang
    public function add(){
        if($this->isAkademik() == TRUE)
        {$this->loadThis();}
        else {
            $nama_berkas = trim($this->input->post('nama_berkas'));
            $data = array('nama_berkas' => $nama_berkas);
            $id_berkas_sidang = $this->Berkas_model->insert($data);
//            mkdir if !dir
            if (!is_dir('uploads/sidang/' . $id_berkas_sidang)) {
                mkdir('./uploads/sidang/' . $id_berkas_sidang, 0777, TRUE);
            }
            if ($id_berkas_sidang) {
                $this->session->set_flashdata('success', 'Syarat berkas berhasil dibuat');
            } else {
                $this->session->set_flashdata('error', 'Syarat berkas gagal dibuat. Masalah database');
            };

            redirect('akademik/berkas_sidang');
        }
    }
//    edit syarat berkas sidang
    public function edit(){
        if($this->isAkademik() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $id_berkas_sidang = $this->input->post('id_berkas_sidang_edit');
            $nama_berkas = trim($this->input->post('nama_berkas_edit'));
            $data = array('nama_berkas' => $nama_berkas);
            $result = $this->Berkas_model->update($data, $id_berkas_sidang);
            if ($result) {
                $this->session->set_flashdata('success', 'Berkas berhasil diubah');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate berkas');
            };
            redirect('akademik/berkas_sidang');
        }
    }

//    non-aktif syarat berkas sidang
    public function off(){
        if($this->isAkademik() == TRUE)
        {$this->loadThis();}
        else {
            $id_berkas_sidang = $this->input->post("id_berkas_sidang");
            $result = $this->Berkas_model->off($id_berkas_sidang);
            if ($result) {
                $this->session->set_flashdata('success', 'Berkas berhasil non-aktif');
            } else {
                $this->session->set_flashdata('error', 'Berkas gagal non-aktif. Masalah database');
            };
            redirect('akademik/berkas_sidang');
        }
    }
//    aktif syarat berkas sidang
    public function on(){
        if($this->isAkademik() == TRUE)
        {
            $this->loadThis();
        }
        else {
            $id_berkas_sidang = $this->input->post("id_berkas_sidang");
            $result = $this->Berkas_model->on($id_berkas_sidang);
            if ($result) {
                $this->session->set_flashdata('success', 'Berkas berhasil diaktifkan');
            } else {
                $this->session->set_flashdata('error', 'Berkas gagal diaktifkan. Masalah database');
            };

            redirect('akademik/berkas_sidang');
        }
    }
//    page not found
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'TA-TRPL : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}