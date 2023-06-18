<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Periode_model extends CI_Model{
    public function getPeriodeAktif(){
        $this->db->select("*");
        $this->db->from('periode');
        $this->db->where('status_periode',1);
        $query = $this->db->get();
        if( $query->num_rows() > 0 ){ return $query->result(); } else { return FALSE; }
    }

    public function insert($data){
        $this->db->trans_start();
        $this->db->set('status_periode', 0);
        $this->db->update('periode');


        $this->db->insert('periode', $data);
        $this->db->trans_complete();
        $result = $this->db->trans_status();
        
        return $result;
    }

    public function edit_status($id_periode,$jenis,$status){
        $this->db->trans_start();
        
        $this->db->where('id_periode',$id_periode);
        if($jenis == 'ta') {
            $this->db->set('status_ta',$status);
        } else {
            $this->db->set('status_yudisium',$status);
            
        }
        $this->db->update('periode');
        
        $this->db->trans_complete();
        $result = $this->db->trans_status();
        
        return $result;
    }

    public function update($data,$id){
        $this->db->trans_start();
        $this->db->where('id_periode',$id);
        $this->db->update('periode',$data);
        $this->db->trans_complete();
        $result = $this->db->trans_status();
        
        return $result;
    }
}