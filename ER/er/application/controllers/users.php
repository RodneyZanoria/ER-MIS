<?php
/**
 * Created by PhpStorm.
 * User: Jezriel
 * Date: 4/22/2015
 * Time: 2:18 AM
 */


class users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_klc');
        $this->load->model('m_member');
        $this->load->model('m_user');
        $this->load->library('Datatables');
        $this->load->library('table');
    }

    public function index()
    {
        $data['userlist'] = $this->m_user->getAllUsers();
        $data['view'] = 'v_users';
        $this->load->view('v_main', $data);
    }

    public function newuser()
    {
        try {

            $member = $this->m_member->getMemberByMisid($_POST['misid']);
            if (count($member))
            {
                $userdata = array(
                    'memberId' => $member['ndex'],
                    'username' => $_POST['username'].'@kojc.net',
                    'password' => $this->encrypt->encode($_POST['password']),
                    'hash' =>  hash('sha256', $_POST['password']. ASINPARAT),
                    'attempt' => 0,
                    'status' => 0,  //1-active 0 deactivated
                    'acc_mis' =>  (isset($_POST['acc_mis'])?1:0),
                    'acc_rep' =>  (isset($_POST['acc_rep'])?1:0),
                    'verificationid' => $this->generateRandomString(),
                    'verificationcode' => $this->generatecode(),
                );
                $this->m_user->addnewuser($userdata);
                redirect(base_url()."users");
            }
            else
            {
                //user misid did not exist page
            }

        }
        catch(Exception $e)
        {
            //redirect to 500
            //send sentry stuff
        }
    }

    public function deactivateuser()
    {
        $userdata = array(
            'status' => 0,
            'dateModified' => date('Y/m/d H:i:s')
        );
        $this->m_user->updateuser($_POST['userndex'], $userdata);
        redirect(base_url()."users");
    }

    public function activateuser()
    {
        $userdata = array(
            'status' => 1,
            'activated' => 1,
            'attempt' => 0,
            'dateModified' => date('Y/m/d H:i:s')
        );
        $this->m_user->updateuser($_POST['userndex'], $userdata);
        redirect(base_url()."users");
    }

    public function updatepw()
    {
        $userdata = array(
            'password' => $this->encrypt->encode($_POST['password']),
            'hash' =>  hash('sha256', $_POST['password']. ASINPARAT),
            'acc_mis' =>  (isset($_POST['acc_mis'])?1:0),
            'acc_rep' =>  (isset($_POST['acc_rep'])?1:0),
            'dateModified' => date('Y/m/d H:i:s')
        );
        $this->m_user->updateuser($_POST['userndex'], $userdata);
        redirect(base_url()."users");
    }

    public function deleteuser()
    {
        $this->m_user->deleteuser($_POST['userndex']);
        redirect(base_url()."users");
    }

    function sendverificationcode($code)
    {

    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function generatecode()
    {
        return mt_rand(100000,9999999);
    }



}