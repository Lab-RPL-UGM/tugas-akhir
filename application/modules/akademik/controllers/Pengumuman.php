<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends BaseController
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Pengumuman_model');
        $this->isLoggedIn();
        $this->isAkademik();
    }

    public function index(){
        $data['dataTable'] = $this->Pengumuman_model->getPengumumanList();
        $this->global['pageTitle'] = "Elusi : Pengumuman"; 
        $this->loadViews("dashboard_pengumuman",$this->global,$data);
    }

    public function add_form(){
        $this->global['pageTitle'] = "Elusi : Publish Pengumuman"; 
        $this->loadViews("add_pengumuman",$this->global);
    }

    public function edit_form($id){
        $data['dataPengumuman'] = $this->Pengumuman_model->getPengumumanList($id);
        $this->global['pageTitle'] = "Elusi : Edit Pengumuman"; 
        $this->loadViews("edit_pengumuman",$this->global,$data);
    }

    public function add(){
        $judul = trim($this->input->post('judul'));
        $deskripsi = trim($this->input->post('deskripsi'));
        if($_FILES["lampiran"]['name']){
            date_default_timezone_set("Asia/Jakarta");
            $new_name = date("YmdHis") . "-" . $_FILES["lampiran"]['name'];
            $config['upload_path']          = './uploads/data_pengumuman';
            $config['allowed_types']        = 'pdf|jpg';
            $config['file_name']            = $new_name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload("lampiran")) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('akademik/pengumuman/add_form');
            } else {
                $lampiran_data = $this->upload->data();
                $data = array(
                    'judul' => $judul,
                    'deskripsi' => $deskripsi,
                    'lampiran' => $config['file_name']
                );
                $result = $this->Pengumuman_model->insert($data);

                if($result){
                    $this->session->set_flashdata('success', 'Pengumuman berhasil dipublish');
                    redirect('akademik/pengumuman/');
                } else {
                    $this->session->set_flashdata('error', 'Pengumuman gagal dipublish. Masalah di database');
                }
            }
        } else {
            $data = array(
                'judul' => $judul,
                'deskripsi' => $deskripsi
            );
            $result = $this->Pengumuman_model->insert($data);

            if($result){
                $this->session->set_flashdata('success', 'Pengumuman berhasil dibuat');
                redirect('akademik/pengumuman/');
            } else {
                $this->session->set_flashdata('error', 'Pengumuman gagal dibuat. Masalah di database');
            }
        }
    }

    public function edit(){
        $id_p = $this->input->post('id_p');
        $judul = trim($this->input->post('judul'));
        $deskripsi = trim($this->input->post('deskripsi'));
        if($_FILES["lampiran"]['name']){
            date_default_timezone_set("Asia/Jakarta");
            $new_name = date("YmdHis") . "-" . $_FILES["lampiran"]['name'];
            $config['upload_path']          = './uploads/data_pengumuman';
            $config['allowed_types']        = 'pdf|jpg';
            $config['file_name']            = $new_name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload("lampiran")) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('akademik/pengumuman/add_form');
            } else {
                $lampiran_data = $this->upload->data();
                $data = array(
                    'judul' => $judul,
                    'deskripsi' => $deskripsi,
                    'lampiran' => $config['file_name']
                );
                $result = $this->Pengumuman_model->update($data,$id_p);

                if($result){
                    $this->session->set_flashdata('success', 'Pengumuman berhasil diubah');
                    redirect('akademik/pengumuman/');
                } else {
                    $this->session->set_flashdata('error', 'Pengumuman gagal diubah. Masalah di database');
                }
            }
        } else {
            $data = array(
                'judul' => $judul,
                'deskripsi' => $deskripsi
            );
            $result = $this->Pengumuman_model->update($data,$id_p);

            if($result){
                $this->session->set_flashdata('success', 'Pengumuman berhasil diubah');
                redirect('akademik/pengumuman/');
            } else {
                $this->session->set_flashdata('error', 'Pengumuman gagal diedit. Masalah di database');
            }
        }
    }

    public function delete(){
        $id_p = $this->input->post("id_p");
        $result = $this->Pengumuman_model->delete($id_p);
        if($result){
            $this->session->set_flashdata('success', 'Pengumuman berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', "Pengumuman gagal dihapus. Masalah di database");
        };

        redirect('akademik/pengumuman');
    }
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Elusi : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}