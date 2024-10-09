<?php
/**
 * Created by nad.
 * Date: 03/04/2018
 * Time: 11:32
 * Description:
 */

class Penilaian extends BaseController
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Penilaian_model');
        $this->isLoggedIn();
        $this->isAkademik();
    }
    public function index(){
        if($this->isAkademik() == TRUE)
        {
            $this->loadThis();
        }
        else {
            $data['dataTable'] = $this->Penilaian_model->getKomponen();
            $this->global['pageTitle'] = "TA-TRPL : Berkas Penilaian";
            $this->loadViews("dashboard_penilaian", $this->global, $data);
        }
    }
//    add new syarat penilaian
    public function add(){
        if($this->isAkademik() == TRUE)
        {$this->loadThis();}
        else {
            $nama = trim($this->input->post('nama'));
            $data = array('nama' => $nama);
            $result = $this->Penilaian_model->insert($data);
            if ($result) {
                $this->session->set_flashdata('success', 'Penilaian berhasil dibuat');
            } else {
                $this->session->set_flashdata('error', 'Penilaian gagal dibuat. Masalah database');
            };
            redirect('akademik/penilaian');
        }
    }
//  update syarat penilaian
    public function edit(){
        if($this->isAkademik() == TRUE)
        {$this->loadThis();}
        else {
            $id_komponen = $this->input->post('id_komponen_edit');
            $nama = trim($this->input->post('nama_komponen_edit'));
            $data = array('nama' => $nama,);
            $result = $this->Penilaian_model->update($data, $id_komponen);
            if ($result) {
                $this->session->set_flashdata('success', 'Penilaian berhasil diubah');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate penilaian');
            };
            redirect('akademik/penilaian');
        }
    }
//    change status be off
    public function off(){
        if($this->isAkademik() == TRUE)
        {$this->loadThis();}
        else {
            $id_komponen = $this->input->post("id_komponen");
            $result = $this->Penilaian_model->off($id_komponen);
            if ($result) {
                $this->session->set_flashdata('success', 'Penilaian berhasil non-aktif');
            } else {
                $this->session->set_flashdata('error', 'Penilaian gagal non-aktif. Masalah database');
            };
            redirect('akademik/penilaian');
        }
    }
//    change status be on
    public function on(){
        if($this->isAkademik() == TRUE)
        {$this->loadThis();}
        else {
            $id_komponen = $this->input->post("id_komponen");
            $result = $this->Penilaian_model->on($id_komponen);
            if ($result) {
                $this->session->set_flashdata('success', 'Penilaian berhasil diaktifkan');
            } else {
                $this->session->set_flashdata('error', 'Penilaian gagal diaktifkan. Masalah database');
            };
            redirect('akademik/penilaian');
        }
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Elusi : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}