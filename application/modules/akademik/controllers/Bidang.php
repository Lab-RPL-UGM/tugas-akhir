<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bidang extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bidang_model');
        $this->isLoggedIn();
        $this->isAkademik();
    }

    public function index()
    {
        $data['dataBidang'] = $this->Bidang_model->getBidang();
        $this->global['pageTitle'] = "TA-TRPL : Bidang";
        $this->loadViews("dashboard_bidang", $this->global, $data);
    }

    public function add_form()
    {
        $this->global['pageTitle'] = "TA-TRPL : Tambah Bidang";
        $this->loadViews("add_bidang", $this->global);
    }

    public function edit_form($id)
    {
        $data['dataBidang'] = $this->Bidang_model->getBidang($id);
        $this->global['pageTitle'] = "TA-TRPL : Edit Bidang";
        $this->loadViews("edit_bidang", $this->global, $data);
    }

    public function add()
    {
        $nama = trim($this->input->post('nama'));
        $data = array(
            'nama' => $nama,
        );

        $result = $this->Bidang_model->insert($data);
        if ($result) {
            $this->session->set_flashdata('success', 'Bidang baru telah ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Bidang gagal ditambahkan. (Masalah database)');
        };

        redirect('akademik/bidang');
    }

    public function edit()
    {
        $id_bidang = trim($this->input->post('id_bidang'));
        $nama = trim($this->input->post('nama'));

        $data = array(
            'nama' => $nama,
        );

        $result = $this->Bidang_model->update($data, $id_bidang);
        if ($result) {
            $this->session->set_flashdata('success', 'Bidang telah diubah');
        } else {
            $this->session->set_flashdata('error', 'Bidang gagal diubah. (Masalah database)');
        };

        redirect('akademik/bidang');
    }

    public function delete()
    {
        $id_bidang = $this->input->post("id_bidang");
        $result = $this->Bidang_model->delete($id_bidang);
        if ($result) {
            $this->session->set_flashdata('success', 'Bidang berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Bidang gagal dihapus. Masalah di database');
        };

        redirect('akademik/bidang');
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Elusi : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}
