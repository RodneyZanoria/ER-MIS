<?php
/**
 * Created by PhpStorm.
 * User: Jezriel
 * Date: 4/27/2015
 * Time: 1:14 AM
 */

class m_user extends CI_Model
{
    function addnewuser($data)
    {
        $this->db->insert('users', $data);
    }

    function getAttempts($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        if($query->num_rows() > 0)
        {
            return $query->row('attempt');

        } else
        {
            return 0;
        }

    }


    function resetAttempts($id)
    {
        $this->db->where('ndex', $id);
        $this->db->set('attempt', '0', FALSE);
        $this->db->update('users');
    }

    function getAllUsers()
    {
        $this->db->order_by('members.ndex' , "desc");
        $this->db->from('members');
        $this->db->join('users','members.ndex = users.memberId', 'inner');
        $q = $this->db->get();
        return $q->result();
    }

    function updateuser($userndex, $data)
    {
        $this->db->where('ndex', $userndex);
        $this->db->update('users', $data);
    }

    function deleteuser($userndex)
    {
        $this->db->where('ndex', $userndex);
        $this->db->delete('users');
    }

    function gpluscheckifauthorize($username)
    {
        $this->db->where('username', $username);
        $q = $this->db->get('users');
        $userexst = $q->first_row('array');
        return (count($userexst) > 0) ? true : false;
    }

    function login($username,$password)
    {
        if(!$username || !$password)
        {
            $this->session->set_flashdata('loginError', 'Username or Password must not be empty.');
            return false;
        }

        if($this->getAttempts($username)>=3)
        {
            $thisuser = array(
                'activated' => 0,
                'status' => 0,
            );

            $this->db->where('username', $username);
            $this->db->update('users', $thisuser);
            $this->session->set_flashdata('loginError', 'Account is deactivated due to several attempts. Please contact system administrator.');
            return false;
        }

        $this->db->select('memberId, ndex, password, hash, dateCreated');
        $this->db->where('username', $username);
        $this->db->where('status', 1);
        $this->db->where('acc_mis', 1);
        $q = $this->db->get('users');
        $userexst = $q->first_row('array');

        //verifying the username
        $retpass = $this->encrypt->decode($userexst['password']);

        if( (count($userexst) > 0) && ($retpass == $password) &&  (hash('sha256', $password. ASINPARAT) == $userexst['hash']))
        {

            $row = $q->row();
            $this->db->where('ndex',$row->memberId);
            $memquery = $this->db->get('members');
            $membr = $memquery->first_row('array');

            $loginArray = array(
                "uid" => $row->memberId,
                "misid" => $membr['misid'],
                "email" => $username,
                "firstname" => $membr['firstName'],
                "lastname" => $membr['lastName'],
                "profilepic" => $membr['photoFileName'],
                "datecreated" => $userexst['dateCreated'],
                "userndex" => $userexst['ndex'],
            );


            $lastlogin = array(
                "dateLastLogin" => date('Y/m/d H:i:s')
            );

            $this->db->where('ndex', $userexst['ndex']);
            $this->db->update('users', $lastlogin);

            $this->session->set_userdata($loginArray);

            $this->resetAttempts($q->row('ndex'));
            //createTrail($row->memberId,0,'Login');
            return true;
        }

        else
        {
            $this->db->where('username', $username);
            $this->db->set('attempt', 'attempt+1', FALSE);
            $this->db->update('users');
            $this->session->set_flashdata('loginError', 'Invalid Login Credentials');
            //createTrail(0,0,'Login Failed by: '.$username);
            return false;
        }
    }

    function logout()
    {
        // createTrail($this->session->userdata('uid'),0,'Logout');
        $this->session->sess_destroy();
        $this->session->set_flashdata('loginError', 'Successfully logged out.');
    }

}
