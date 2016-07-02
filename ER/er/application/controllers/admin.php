<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Jezriel
 * Date: 1/29/2015
 * Time: 10:49 PM
 */

class admin extends CI_Controller {


    public function index()
    {
        $data['view'] = 'temp';
        $this->load->view('v_main', $data);
    }

    public function profile()
    {
        $data['view'] = 'v_pds_form';
        $this->load->view('v_main', $data);
    }

}
