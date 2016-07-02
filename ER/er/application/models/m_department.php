<?php
/**
 * Created by PhpStorm.
 * User: Jezriel
 * Date: 6/18/2015
 * Time: 1:08 AM
 */

class m_department extends CI_Model
{
    function add_department($data)
    {
        $this->db->insert('kjc_departments',$data);
    }

    function updatedepartent($ndex, $data)
    {
        $this->db->where('id', $ndex);
        $this->db->update('kjc_departments', $data);
    }

    function deletedepartment($ndex)
    {
        $this->db->where('id', $ndex);
        $this->db->delete('kjc_departments');
    }

    function getdepartments()
    {
        $this->db->order_by('departmentname', 'asc');
        $q = $this->db->get('kjc_departments');
        return $q->result();
    }

}