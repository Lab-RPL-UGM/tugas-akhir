<?php
/**
 * Created by nad.
 * Date: 22/03/2018
 * Time: 21:15
 * Description:
 */

class Proyek_model extends CI_Model
{
    /**
     * This function used to get proyek information by id
     * @param number $id : This is project id
     * @return array $result : This is project information
     */
    function getProyekInfo($proyekId=NULL, $dosenId = NULL)
    {
        $this->db->select('proyek.id_proyek, proyek.nama nama_proyek, proyek.klien, 
                           proyek.status, proyek.id_dosen, Dosen.nama nama_dosen');
        $this->db->from('proyek');
        $this->db->join('dosen as Dosen', 'Dosen.id_dosen = proyek.id_dosen','left');
        $this->db->where('proyek.isDeleted', 0);
        if ($proyekId!=null){
            $this->db->where('id_proyek', $proyekId);
        }
        if ($dosenId!=null){
            $this->db->where('Dosen.id_user', $dosenId);
        }
        $query = $this->db->get();
        return $query->result();
    }
    /**
     * This function used to get dosen information
     * @return array $result : This is dosen information
     */
    function getDosen()
    {
        $this->db->select('id_dosen, nama');
        $this->db->from('dosen');
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();

        return $query->result();
    }
    /**
     * This function is used to add new project to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewProject($proyekInfo)
    {
        $this->db->trans_start();
        $this->db->insert('proyek', $proyekInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    /**
     * This function is used to update the user information
     * @param array $proyekInfo : This is project updated information
     * @param number projectId : This is project id
     */
    function editProject($proyekInfo, $proyekId)
    {
        $this->db->where('id_proyek', $proyekId);
        $this->db->update('proyek', $proyekInfo);
        return TRUE;
    }
}