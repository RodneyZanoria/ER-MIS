<?php
/**
 * Created by PhpStorm.
 * User: Jezriel
 * Date: 5/5/2015
 * Time: 6:20 PM
 */

class m_ministry extends CI_Model
{
    function addministry($data)
    {
        $this->db->insert('ministries',$data);
    }

    function updateministry($ndex, $data)
    {
        $this->db->where('ndex', $ndex);
        $this->db->update('ministries', $data);
    }

    function deleteministry($ndex)
    {
        $this->db->where('ndex', $ndex);
        $this->db->delete('ministries');
    }


    function getministry()
    {
        $this->db->order_by('ministryname', 'asc');
       $q = $this->db->get('ministries');
        return $q->result();
    }


}