<?php
/**
 * Created by nad.
 * Date: 27/03/2018
 * Time: 07:10
 * Description:
 */

class Yudisium_model extends CI_Model
{
    /**
     * This function is used to get the yudisium info by id
     * @param number $yudisiumId: This is id needed
     * @return array $result : This is result
     */
    function getYudisiumInfo($yudisiumId=NULL)
    {
        $this->db->select('s.id_yudisium, s.status, s.createdDtm, m.nim, m.nama, m.id_mahasiswa');
        $this->db->from('yudisium s');
        $this->db->join('mahasiswa as m', 'm.id_mahasiswa = s.id_mahasiswa','left');
        $this->db->order_by('s.createdDtm DESC');
        if ($yudisiumId!=null){
            $this->db->where('id_yudisium', $yudisiumId);
        } else {
            $this->db->where('(m.id_mahasiswa IS NULL OR m.isDeleted = 0)', NULL, FALSE);
        }
        $query = $this->db->get();
        return $query->result();
    }
    /**
     * This function is used to get the berkas info
     * @param number $idMhs : This is id mahasiswa having berkas
     * @return array $result : This is result
     */
    function getBerkas($idMhs)
    {
        $this->db->select('*');
        $this->db->from('validasi_berkas_yudisium v');
        $this->db->join('berkas_yudisium b','b.id_berkas_yudisium = v.id_berkas_yudisium');
        $this->db->where('id_yudisium',$idMhs);
        $query = $this->db->get();
        return $query->result();
    }
    /**
     * This function is used to edit status berkas yudisium to accepted
     * @param array $berkasInfo : Status where accepted
     * @param array $idValidYudisium : Where is id wanna change to be accepted
     * @return bool true : where affected row increase
     */
    function accBerkas($berkasInfo, $idValidYudisium)
    {
        $this->db->where('id_valid_yudisium', $idValidYudisium);
        $this->db->update('validasi_berkas_yudisium', $berkasInfo);
        return true;
    }
    /**
     * This function is used to edit status berkas yudisium to declined
     * @param array $berkasInfo : Status where declined
     * @param array $idValidYudisium : Where is id wanna change to be declined
     * @return bool true : where affected row increase
     */
    function decBerkas($berkasInfo, $idValidYudisium)
    {
        $this->db->where('id_valid_yudisium', $idValidYudisium);
        $this->db->update('validasi_berkas_yudisium', $berkasInfo);
        return true;
    }
    /**
     * This function is used to add new pesan to log_pesan
     * @return number $insert_id : This is last inserted id
     */
    function addPesan($pesanInfo)
    {
        $this->db->trans_start();
        $this->db->insert('log_pesan', $pesanInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
    /**
     * This function is used to edit status yudisium to accepted
     * @param array $statusInfo : Status where accepted
     * @param array $idYudisium : Where is id wanna change to be accepted
     * @return bool true : where affected row increase
     */
    function status($statusInfo, $idYudisium)
    {
        $this->db->where('id_yudisium', $idYudisium);
        $this->db->update('yudisium', $statusInfo);
        return true;
    }
//    check berkas yudisium should accepted all, if status yudisium wanna accepted
    function isBerkasYudisiumLengkap($id_mahasiswa){
        $this->db->select('v.*');
        $this->db->from('validasi_berkas_yudisium v');
        $this->db->join('yudisium y','y.id_yudisium = v.id_yudisium', 'left');
        $this->db->where('y.id_yudisium',$id_mahasiswa);
        $query = $this->db->get();
        $result = $query->result();
        $p = 0;
        foreach ($result as $infoResult){
            if ($infoResult->path != ""){
                $p=1;
            }else{
                $p=0;
                break;
            }
        }
        if ($p==1){
            return true;
        }else{
            return false;
        }
    }
}