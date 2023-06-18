<?php
/**
 * Created by nad.
 * Date: 22/03/2018
 * Time: 21:10
 * Description:
 */

class Proyek extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('proyek_model');
        $this->isLoggedIn();
        $this->isDosen();
    }

    function index()
    {
        if($this->isDosen() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $userId = $this->vendorId;
            $this->load->model('proyek_model');
            $data['proyekInfo'] = $this->proyek_model->getProyekInfo(null, $userId);
            $this->global['pageTitle'] = "Elusi : Proyek";

            $this->loadViews("proyek", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if($this->isDosen() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('proyek_model');
            $data['dosenInfo'] = $this->proyek_model->getDosen();

            $this->loadViews("proyekadd", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used to add new project to the system
     */
    function addNewProject()
    {
        if($this->isDosen() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('id_dosen','Penanggung Jawab','trim|required|numeric');
            $this->form_validation->set_rules('nama-proyek','Nama Proyek','trim|required|max_length[128]');
            $this->form_validation->set_rules('klien','Instansi','trim|required|max_length[128]');

            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $dosenId = $this->input->post('id_dosen');
                $name = ucwords(strtolower($this->input->post('nama-proyek')));
                $klien = ucwords(strtolower($this->input->post('klien')));

                $proyekInfo = array('id_dosen'=>$dosenId, 'nama'=>$name, 'klien'=>$klien);

                $result = $this->proyek_model->addNewProject($proyekInfo);

                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Berhasil mengajukan, status = waiting');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Gagal mengajukan proyek');
                }
                redirect('dosen/proyek/addNew');
            }
        }
    }
    /**
     * This function is used load project edit information
     * @param number $proyekId: This is project id
     */
    function editOld($proyekId = NULL)
    {
        if($this->isDosen() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($proyekId == null)
            {
                redirect('dosen/proyek');
            }
            $data['proyekInfo'] = $this->proyek_model->getProyekInfo($proyekId);
            $data['dosenInfo'] = $this->proyek_model->getDosen();
            $this->loadViews("proyekedit", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used to edit the project information
     */
    function editProject()
    {
        if($this->isDosen() == TRUE)
        {
            $this->loadThis();
        }
        else {
            $this->load->library('form_validation');

            $proyekId = $this->input->post('id-proyek');

            $this->form_validation->set_rules('id_dosen','Penanggung Jawab','trim|required|numeric');
            $this->form_validation->set_rules('nama-proyek','Nama Proyek','trim|required|max_length[128]');
            $this->form_validation->set_rules('klien','Instansi','trim|required|max_length[128]');

            if ($this->form_validation->run() == FALSE) {
                $this->editOld();
            } else {
                $dosenId = $this->input->post('id_dosen');
                $name = ucwords(strtolower($this->input->post('nama-proyek')));
                $klien = ucwords(strtolower($this->input->post('klien')));

                if (!empty($proyekId)) {
                    $proyekInfo = array(
                        'id_proyek' => $proyekId,
                        'id_dosen' => $dosenId,
                        'nama' => $name,
                        'klien' => $klien
                    );

                    $result = $this->proyek_model->editProject($proyekInfo, $proyekId);

                    if ($result == true) {
                        $this->session->set_flashdata('success', 'Proyek berhasil diperbaharui');
                    } else {
                        $this->session->set_flashdata('error', 'Proyek gagal diperbaharui');
                    }
                    redirect('dosen/proyek');
                }else{echo "Alhamdulillah";}
            }
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