<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by nad.
 * Date: 23/03/2018
 * Time: 18:21
 * Description:
 */

class Change_password_model extends CI_Model
{
    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getUserRoles()
    {
        $this->db->select('id_user_role, role');
        $this->db->from('user_role');
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */
    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('id_user, password');
        $this->db->from('user');
        $this->db->where('id_user', $userId);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();

        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function changePassword($userId, $userInfo)
    {
        $this->db->where('id_user', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('user', $userInfo);

        return $this->db->affected_rows();
    }
}