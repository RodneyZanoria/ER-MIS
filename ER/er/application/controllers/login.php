<?php
/**
 * Created by PhpStorm.
 * User: Jezriel
 * Date: 5/2/2015
 * Time: 10:35 AM
 */

class login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_klc');
        $this->load->model('m_logs');
        $this->load->model('m_member');
        $this->load->model('m_user');
        $this->load->library('Datatables');
        $this->load->library('table');

    }

    public function index()
    {

      if (isset($_GET['code'])) {

        $this->googleplus->getAuthenticate();
        $this->session->set_userdata('login',true);
        $userprofile = $this->googleplus->getUserInfo();
        $this->session->set_userdata('user_profile',$this->googleplus->getUserInfo());

        //validate if the user is authorized..
        if($this->m_user->gpluscheckifauthorize($userprofile['email'])){
          $loginArray = array(
              "email" => $userprofile['email'],
              "firstname" => $userprofile['given_name'],
              "lastname" => $userprofile['family_name'],
              "profilepic" => $userprofile['picture'],
          );
          $this->session->set_userdata($loginArray);

          redirect(base_url().'pds/');
        }
        else {
            redirect(base_url().'login/ineligible');
        }

      }
      	$contents['login_url'] = $this->googleplus->loginURL();
        $this->load->view('v_erlogin', $contents);
        $this->m_logs->logevent('HIT LOGIN Page');
    }

    public function ineligible()
    {
      $this->load->view('v_unauthorized');
    }

    public function beginlogin()
    {
        if($this->m_user->login($_REQUEST['username'],$_REQUEST['password']))
        {
            $this->m_logs->logevent('LOGIN SUCCESSFUL -  '. $_REQUEST['username']);
            redirect(base_url().'pds/');
        } else {
            $this->m_logs->logevent('LOGIN ATTEMPT using this login details. '. $_REQUEST['username'] . ' | ' . $_REQUEST['password']);
            redirect(base_url().'login/');
        }
    }

    public function beginlogout()
    {
        $this->m_user->logout();
        redirect(base_url());
    }
}
