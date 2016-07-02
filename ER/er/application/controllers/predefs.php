x<?php
/**
 * Created by PhpStorm.
 * User: Jezriel
 * Date: 5/5/2015
 * Time: 6:25 PM
 */

class predefs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_klc');
        $this->load->model('m_department');
        $this->load->model('m_member');
        $this->load->model('m_user');
        $this->load->model('m_ministry');
        $this->load->library('Datatables');
    }

    public function index()
    {
        $data['ministries'] = $this->m_ministry->getministry();
        $data['klcs'] =$this->m_klc->getklcs();
        $data['country'] = $this->m_klc->getcountry();
        $data['departments'] = $this->m_department->getdepartments();

        $data['view'] = 'v_predefs';
        $this->load->view('v_main', $data);
    }

    public function updateministry()
    {
        $m = array(
            'ministryname' => $_POST['ministryname'],
        );

        $this->m_ministry->updateministry($_POST['ministryndex'], $m);
        redirect(base_url().'predefs');
    }

    public function addministry()
    {
        $m = array(
            'ministryname' => $_POST['ministryname'],
         );

        $this->m_ministry->addministry($m);
        redirect(base_url().'predefs');
    }

    public function deleteministry()
    {
       $this->m_ministry->addministry($_POST['ministryndex']);
        redirect(base_url().'predefs');
    }

    public function addklc()
    {
        $newklc = array(
            'klcName' => $_POST['klcName'],
            'address' => $_POST['address'],
            'city' => $_POST['city'],
            'stateprovince' => $_POST['stateprovince'],
            'countryid' => $_POST['countryid'],
        );
        $this->m_klc->addklc($newklc);
        redirect(base_url().'predefs#klc');
    }

    public function updateklc($ndex)
    {
        $newklc = array(
            'klcName' => $_POST['klcName'],
            'address' => $_POST['address'],
            'city' => $_POST['city'],
            'stateprovince' => $_POST['stateprovince'],
            'countryid' => $_POST['countryid'],
        );
        $this->m_klc->updateklc($ndex, $newklc);
        redirect(base_url().'predefs#klc');
    }

    public function addnewdepartment()
    {
        $dept = array(
            'departmentname' => $_POST['departmentname'],
        );
        $this->m_department->add_department($dept);
        redirect(base_url().'predefs#department');
    }

    public function updatedepartment()
    {
        $dept = array(
            'departmentname' => $_POST['departmentname'],
        );
        $ndex = $_POST['deptndex'];
        $this->m_department->updatedepartent($ndex, $dept);
        redirect(base_url().'predefs#department');
    }
//    public function deactivateklc()
//    {
//        $data = array(
//            'deactivated' => 1,
//        );
//        $ndex  = $_POST['klcndex'];
//        $this->m_klc->updateklc($ndex, $data);
//        redirect(base_url().'predefs#klc');
//    }
//
//
//    public function activateklc()
//    {
//        $data = array(
//            'deactivated' => 0,
//        );
//        $ndex  = $_POST['klcndex'];
//        $this->m_klc->updateklc($ndex, $data);
//        redirect(base_url().'predefs#klc');
//    }
}