<?php
/**
 * Created by PhpStorm.
 * User: Jezriel
 * Date: 5/13/2015
 * Time: 3:51 AM
 */

class m_logs extends CI_Model {


    function getlogs()
    {
        $this->logsdb =  $this->load->database('logsdb', TRUE);
        $this->logsdb->order_by('ndex', 'desc');
        $q = $this->logsdb->get('logs');
        return $q->result();
    }

    function logevent($event)
    {
        try
        {
            $this->logsdb =  $this->load->database('logsdb', TRUE);
            $eventlog = array(
                'ipaddress' => $this->getUserIP(),
                'user' => $this->session->userdata('uid'),
                'sessionusername' => $this->session->userdata('firstname'). ' ' .$this->session->userdata('lastname'),
                'event' => $event,
            );
            $this->logsdb->insert('logs', $eventlog);
        }
        catch(Exception $e)
        {

        }

    }

    function getUserIP()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }
        return $ip;
    }

}