<?php

/**
 * Created by nad.
 * Date: 23/03/2018
 * Time: 14:11
 * Description:
 */

class Bimbingan extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bimbingan_model');
        $this->isLoggedIn();
        $this->isDosen();
    }
    /**
     * This function is used to load the main page
     */
    function index()
    {
        if ($this->isDosen() == TRUE) {
            $this->loadThis();
        } else {
            $userId = $this->vendorId;
            $userRole = $this->role;
            $data['bimbinganInfo'] = $this->bimbingan_model->getBimbingan($userId);
            $data['userId'] = $userId;
            $data['userRole'] = $userRole;
            $this->global['pageTitle'] = "Elusi : Bimbingan";
            $this->loadViews("bimbingan", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used load detail mahasiswa information
     * @param number $idMhs : This is mahasiswa id
     */
    function detail($idMhs = NULL)
    {
        if ($this->isDosen() == TRUE) {
            $this->loadThis();
        } else {
            if ($idMhs == null) {
                redirect('dosen/bimbingan');
            }
            $data['bimbinganInfo'] = $this->bimbingan_model->getBimbinganMahasiswa($idMhs);
            $data['mhsInfo'] = $this->bimbingan_model->getMahasiswa($idMhs);
            $this->loadViews("profil-mhs", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used load detail mahasiswa information
     * @param number $idMhs : This is mahasiswa id
     */
    function progress($idMhs = NULL)
    {
        if ($this->isDosen() == TRUE) {
            $this->loadThis();
        } else {
            if ($idMhs == null) {
                redirect('dosen/bimbingan');
            }
            $data['bimbinganInfo'] = $this->bimbingan_model->getBimbinganMahasiswa($idMhs);
            $data['mhsInfo'] = $this->bimbingan_model->getMahasiswa($idMhs);
            $data['taTerplotting'] = $this->bimbingan_model->getTATerplotting($idMhs);
            $data['taDosbing'] = $this->bimbingan_model->getDosbing($idMhs);
            $data['taBimbingan'] = $this->bimbingan_model->getBimbinganProgress($data['bimbinganInfo'][0]->id_ta);
            $data['dosenId'] = $this->vendorId;
            $this->loadViews("bimbingan-mhs", $this->global, $data, NULL);
        }
    }

    function updateProgress()
    {
        if ($this->isDosen() == TRUE) {
            $this->loadThis();
        } else {

            $updateBimbingan = array(
                'reason' => $this->input->post('reason'),
                'progress_percentage' => $this->input->post('progress'),
                'status' => $this->input->post('status')
            );
            $this->db->where('id', $this->input->post('id_bimbingan'));
            $this->db->update('bimbingan', $updateBimbingan);

            $updateTA = array(
                'progress' => $this->input->post('progress')
            );
            $this->db->where('id_ta', $this->input->post('id_ta'));
            $this->db->update('tugas_akhir', $updateTA);

            redirect('dosen/bimbingan');
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
