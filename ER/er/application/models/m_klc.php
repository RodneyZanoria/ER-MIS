<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Jezriel
 * Date: 3/13/2015
 * Time: 11:43 AM
 */

class m_klc extends CI_Model
{
    function getklcs()
    {
        $this->db->order_by("klcName", "asc");
        $query = $this->db->get('klcs');
        return $query->result();
    }

    function addklc($data)
    {
        $this->db->insert('klcs',$data);
    }

    function updateklc($ndex, $data)
    {
        $this->db->where('ndex', $ndex);
        $this->db->update('klcs', $data);
    }

    function getcountry()
    {
        $this->db->order_by('ndex', "ASC");
        $q = $this->db->get('countries');
        return $q->result();
    }
}