<?php
/**
 * Created by PhpStorm.
 * User: Jezriel
 * Date: 2/19/2015
 * Time: 6:17 PM
 */

class pds extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_klc');
        $this->load->model('m_member');
        $this->load->model('m_logs');
        $this->load->model('m_user');
        $this->load->model('m_ministry');
        $this->load->library('Datatables');
        $this->load->library('table');
    }

    public function index()
    {
        $data['view'] = 'v_dashboard';
        $data['activepage'] = 'dashboard';
        $this->load->view('v_main', $data);
    }

    //log
    public function addNonMemberSibling()
    {
        //collectdata from post
        try{
            $newId = $this->generateid();
            $nonmember = array (
                "memberClass" => 9,
                "lastName" => $_POST['txtLastName'],
                "firstName" => $_POST['txtFirstName'],
                "middleName" => $_POST['txtMiddleName'],
                "occupation" => $_POST['txtOccupation'],
                "misid" => $newId,
                "memberStatus" => 8,
                "klc" => 0,
                "gender" => $_POST['gender'],
                "dateupdated" => date('Y/m/d H:i:s')

            );

            //inject to db
            $this->m_member->addNewPDS($nonmember);

            //retrieve id
            $siblingid = $this->m_member->getMemberByMisid($newId);

            //connect id and requester
            $sibling = array(
                'memberId' => $_POST['memberId'],
                'siblingId' => $siblingid['ndex']
            );

            //save to siblin
            $this->logversionhistory($_POST['recordndex'],$_POST['encodername'],"Added Non-Member Sibling");
            $this->m_member->addsibling($sibling);
            $misid = $this->m_member->getMisid($_POST['memberId']);

            $recordof = $this->m_member->getMemberByMisid($misid);

            $this->m_logs->logevent("Add Non-Member Sibling named " .$_POST['txtLastName'] . ' ' . $_POST['txtFirstName'] .' - of ' . $recordof['firstName'] . ' '. $recordof['lastName'] );
            $this->goprofile($misid,'#familybackground');
        }
        catch(Exception $e)
        {

        }

    }
    //ajax
    public function findsiblings($key, $requester)
    {
        $data['requester'] = $requester;
        $data['membercategory'] = $this->m_member->getMemberTypes();
        $data['loadedsiblings'] = $this->m_member->getMemberByLastNameAndFirstName($key);
        $this->load->view('v_part_siblings', $data);
    }
//
    public function findpossiblesiblings($key, $requester)
    {
        $data['requester'] = $requester;
        $data['membercategory'] = $this->m_member->getMemberTypes();
        $data['loadedsiblings'] = $this->m_member->getMemberByLastNameAndFirstName($key);
        $this->load->view('v_part_siblings', $data);
    }
//
    public function deletesibling()
    {
        try{
            if($this->input->post('btnDeleteSibling') == 'DeleteSibling')
            {
                $this->m_member->deletesibling($_POST['siblingId'], $_POST['memberId']);
                $misid = $this->m_member->getMisid($_POST['memberId']);
                $this->goprofile($misid, '#familybackground');
            }

        }
        catch(Exception $e)
        {

        }
    }

    //log
    public function connectsibling()
    {

        try
        {
            $sibling = array(
                'memberId' => $_POST['memberId'],
                'siblingId' => $_POST['siblingId']
            );

            $this->m_member->addsibling($sibling);
            $misid = $this->m_member->getMisid($_POST['memberId']);

            $this->logversionhistory($_POST['memberId'],$_POST['encodername'],"Added a Member Sibling");
            $recordof = $this->m_member->getMemberByMisid($misid);
            $this->m_logs->logevent("Added Member Sibling to the PDS of " . $recordof['firstName'] . ' '. $recordof['lastName'] );

            $this->goprofile($misid,'#familybackground');
        }
        catch(Exception $e)
        {

        }

    }

    public function updatesibling($misid)
    {
        try
        {
            $ndex = $_POST['siblingId'];
            $siblingdata = array(
                "lastName" => $_POST['lastName'],
                "firstName" => $_POST['firstName'],
                "middleName" => $_POST['middleName'],
                "occupation" => $_POST['occupation'],
                "gender" => $_POST['gender'],
                "memberClass" => $_POST['memberClass'],
            );

            $this->m_member->update_memberbyid($ndex, $siblingdata);
            $this->logversionhistory($_POST['recordndex'],$_POST['encodername'],"Updated Sibling");
            $this->goprofile($misid,'#familybackground');
        }
       catch(Exception $e)
       {

       }
    }

//
    public function findchild($key, $requester)
    {
        $data['requester'] = $requester;
        $data['membercategory'] = $this->m_member->getMemberTypes();
        $data['members'] = $this->m_member->getMemberByLastNameAndFirstName($key);
        $this->load->view('v_part_children', $data);
    }
//
    public function findfruits($key, $requester)
    {
        $data['requester'] = $requester;
        $data['membercategory'] = $this->m_member->getMemberTypes();
        $data['members'] = $this->m_member->getExclusiveMemberByLastNameAndFirstName($key);
        $this->load->view('v_part_fruits', $data);
    }

    //log
    public function connectchild()
    {
        try
        {
            $child = array(
                'memberId' => $_POST['memberId'],
                'childId' => $_POST['childId']
            );

            $this->m_member->addchild($child);
            $misid = $this->m_member->getMisid($_POST['memberId']);

            $this->logversionhistory($_POST['memberId'],$_POST['encodername'],"Added Child");

            $recordof = $this->m_member->getMemberByMisid($misid);
            $this->m_logs->logevent("Added Member Child to the PDS record of " . $recordof['firstName'] . ' '. $recordof['lastName'] );

            $this->goprofile($misid,'#familybackground');
        }
        catch(Exception $e)
        {

        }
    }


    public function updatechild($misid)
    {

            $childdata = array(
                "lastName" => $_POST['lastName'],
                "firstName" => $_POST['firstName'],
                "middleName" => $_POST['middleName'],
                "occupation" => $_POST['occupation'],
                "gender" => $_POST['gender'],
                "memberClass" => $_POST['memberClass'],
            );
            $this->m_member->update_memberbyid($_POST['childId'], $childdata);
            $this->goprofile($misid,'#familybackground');


    }


    //log
    public function addNonMemberChild()
    {
        //collectdata from post
        try{
            $newId = $this->generateid();
            $nonmember = array (
                "memberClass" => 9,
                "lastName" => $_POST['txtLastName'],
                "firstName" => $_POST['txtFirstName'],
                "middleName" => $_POST['txtMiddleName'],
                "occupation" => $_POST['txtOccupation'],
                "misid" => $newId,
                "memberStatus" => 8 ,
                "klc" => 0,
                "gender" => $_POST['gender'],
                "dateupdated" => date('Y/m/d H:i:s')

            );

            //inject to db
            $this->m_member->addNewPDS($nonmember);

            //retrieve id
            $childid = $this->m_member->getMemberByMisid($newId);


            $child = array(
                'memberId' => $_POST['memberId'],
                'childId' => $childid['ndex']
            );

            $this->m_member->addchild($child);
            $misid = $this->m_member->getMisid($_POST['memberId']);

            $recordof = $this->m_member->getMemberByMisid($misid);
            $this->logversionhistory($_POST['recordndex'],$_POST['encodername'],"Added Non-Member Child");
            $this->m_logs->logevent("Added Non-Member Child named " .$_POST['txtLastName'] . ' ' . $_POST['txtFirstName'] .' - for PDS record of ' . $recordof['firstName'] . ' '. $recordof['lastName'] );

            $this->goprofile($misid,'#familybackground');
        }
        catch(Exception $e)
        {

        }

    }


    public function deletechild()
    {
        try{
            if($this->input->post('btnDeleteChild') == 'DeleteChild')
            {
                $this->m_member->deletechild($_POST['childId'], $_POST['memberId']);
                $misid = $this->m_member->getMisid($_POST['memberId']);

                $recordof = $this->m_member->getMemberByMisid($misid);
                $this->logversionhistory($_POST['recordndex'],$_POST['encodername'],"Deleted  Child");
                $this->m_logs->logevent("Removed a child " .$_POST['txtLastName'] . ' ' . $_POST['txtFirstName'] .' - for PDS record of ' . $recordof['firstName'] . ' '. $recordof['lastName'] );

                $this->goprofile($misid, '#familybackground');
            }

        }
        catch(Exception $e)
        {

        }
    }

    public function connectfruit()
    {
        try
        {
            $bunga = array(
                'memberId' => $_POST['memberId'],
                'fruitId' => $_POST['fruitId']
            );

            $this->m_member->connectfruit($bunga);
            $misid = $this->m_member->getMisid($_POST['memberId']);
            $this->goprofile($misid,'#spiritualandministry');
        }
        catch(Exception $e)
        {

        }
    }

    public function disconnectfruit()
    {
        $fruitId = $_POST['fruitId'];
        $this->m_member->deletefruit($fruitId);
        $this->goprofile($_POST['requester'], "#spiritualandministry");
    }

    public function addministryhistory($id)
    {
        $dateFromRaw = explode('/',$_POST['dateFrom']);
        $dateFrom= $dateFromRaw[2].'-'.$dateFromRaw[0].'-'.$dateFromRaw[1];

        $dateToRaw = explode('/',$_POST['dateTo']);
        $dateTo = $dateToRaw[2].'-'.$dateToRaw[0].'-'.$dateToRaw[1];


        $ministryhist = array(
            'ministry' => $_POST['ministry'],
            'dept' => $_POST['dept'],
            'tag' => $_POST['tag'],
            'memberId' => $_POST['memberndex'],
            'klc' => $_POST['klc'],
            'deptInCharge' => $_POST['deptInCharge'],
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo
        );

        $this->m_member->addministryhistory($ministryhist);
        $this->goprofile($id, "#spiritualandministry");

    }

    public function updateministryhistory($id)
    {

        $dateFromRaw = explode('/',$_POST['dateFrom']);
        $dateFrom= $dateFromRaw[2].'-'.$dateFromRaw[0].'-'.$dateFromRaw[1];

        $dateToRaw = explode('/',$_POST['dateTo']);
        $dateTo = $dateToRaw[2].'-'.$dateToRaw[0].'-'.$dateToRaw[1];


        $ministryhist = array(
            'ministry' => $_POST['ministry'],
            'dept' => $_POST['dept'],
            'tag' => $_POST['tag'],
            'memberId' => $_POST['memberndex'],
            'klc' => $_POST['klc'],
            'deptInCharge' => $_POST['deptInCharge'],
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo
        );

        $this->m_member->updateminitryhistory($_POST['ministryndex'], $ministryhist);
        $this->goprofile($id, "#spiritualandministry");

    }

    public function removeministryhistory()
    {
        try{
            $mhistoryid = $_POST['ministryndex'];
            $this->m_member->removeministryhistory($mhistoryid);
            $this->goprofile($_POST['misid'], "#spiritualandministry");
        }
        catch(Exception $e)
        {

        }
    }


    public function importeduc($ndex)
    {

        $mem = $this->m_member->getMemberByNdex($ndex);

        //import elementary
        if (!empty($mem['elemNameOfSchool']))
        {
            $dateFrom = $mem['elemInclusiveDatesOfAttendanceFrom'];
            $fromMonth = date("m", strtotime($dateFrom));
            $fromYear = date("Y", strtotime($dateFrom));

            $dateTo = $mem['elemInclusiveDatesOfAttendanceTo'];
            $toMonth = date("m", strtotime($dateTo));
            $toYear = date("Y", strtotime($dateTo));

            if($mem['elementarygraduate'] == 1)
            {
                $remarks = "Graduated.";
            }
            else
            {
                $remarks = ".";
            }

            $educ = array(
                'memberndex' => $ndex,
                'edulevel' => "elementary",
                'schoolname' => $mem['elemNameOfSchool'],
                'frommonth' => $fromMonth,
                'fromyear' => $fromYear,
                'tomonth' => $toMonth,
                'toyear' => $toYear,
                'remarks' => $remarks,
            );
            $this->m_member->add_educ_attainment($educ);
        }

        //import highschool

        if (!empty($mem['secNameOfSchool']))
        {
            $dateFrom = $mem['secInclusiveDatesOfAttendanceFrom'];
            $fromMonth = date("m", strtotime($dateFrom));
            $fromYear = date("Y", strtotime($dateFrom));

            $dateTo = $mem['secInclusiveDatesOfAttendanceTo'];
            $toMonth = date("m", strtotime($dateTo));
            $toYear = date("Y", strtotime($dateTo));


            if($mem['highschoolgraduate'] == 1)
            {
                $remarks = "Graduated.";
            }

            $educ = array(
                'memberndex' => $ndex,
                'edulevel' => "highschool",
                'schoolname' => $mem['secNameOfSchool'],
                'frommonth' => $fromMonth,
                'fromyear' => $fromYear,
                'tomonth' => $toMonth,
                'toyear' => $toYear,
                'remarks' => $remarks,
            );
            $this->m_member->add_educ_attainment($educ);
        }


        //import vocational

        if (!empty($mem['vocNameOfSchool']))
        {
            $dateFrom = $mem['vocInclusiveDatesOfAttendanceFrom'];
            $fromMonth = date("m", strtotime($dateFrom));
            $fromYear = date("Y", strtotime($dateFrom));

            $dateTo = $mem['vocInclusiveDatesOfAttendanceTo'];
            $toMonth = date("m", strtotime($dateTo));
            $toYear = date("Y", strtotime($dateTo));

            if($mem['vocationalgraduate'] == 1)
            {
                $remarks = "Graduated.";
            }

            $educ = array(
                'memberndex' => $ndex,
                'edulevel' => "vocational",
                'schoolname' => $mem['vocNameOfSchool'],
                'frommonth' => $fromMonth,
                'fromyear' => $fromYear,
                'tomonth' => $toMonth,
                'toyear' => $toYear,
                'coursename' => $mem['vocCourse'],
                'remarks' => $remarks,
            );
            $this->m_member->add_educ_attainment($educ);
        }

        //import college
        if (!empty($mem['collNameOfSchool']))
        {
            $dateFrom = $mem['collInclusiveDatesOfAttendanceFrom'];
            $fromMonth = date("m", strtotime($dateFrom));
            $fromYear = date("Y", strtotime($dateFrom));

            $dateTo = $mem['collInclusiveDatesOfAttendanceTo'];
            $toMonth = date("m", strtotime($dateTo));
            $toYear = date("Y", strtotime($dateTo));


            if($mem['collegegraduate'] == 1)
            {
                $remarks = "Graduated.";
            }

            $educ = array(
                'memberndex' => $ndex,
                'edulevel' => "college",
                'schoolname' => $mem['collNameOfSchool'],
                'frommonth' => $fromMonth,
                'fromyear' => $fromYear,
                'tomonth' => $toMonth,
                'toyear' => $toYear,
                'coursename' => $mem['collCourse'],
                'remarks' => $remarks,

            );
            $this->m_member->add_educ_attainment($educ);
        }


        //import masteral
        if (!empty($mem['postNameOfSchool']))
        {
            $dateFrom = $mem['postInclusiveDatesOfAttendanceFrom'];
            $fromMonth = date("m", strtotime($dateFrom));
            $fromYear = date("Y", strtotime($dateFrom));

            $dateTo = $mem['postInclusiveDatesOfAttendanceTo'];
            $toMonth = date("m", strtotime($dateTo));
            $toYear = date("Y", strtotime($dateTo));


            if($mem['masteralgraduate'] == 1)
            {
                $remarks = "Graduated.";
            }

            $educ = array(
                'memberndex' => $ndex,
                'edulevel' => "masters",
                'schoolname' => $mem['postNameOfSchool'],
                'frommonth' => $fromMonth,
                'fromyear' => $fromYear,
                'tomonth' => $toMonth,
                'toyear' => $toYear,
                'coursename' => $mem['postCourse'],
                'remarks' => $remarks,
            );
            $this->m_member->add_educ_attainment($educ);
        }

        //import doctoral

        if (!empty($mem['doctorateNameOfSchool']))
        {
            $dateFrom = $mem['doctorateInclusiveDatesOfAttendanceFrom'];
            $fromMonth = date("m", strtotime($dateFrom));
            $fromYear = date("Y", strtotime($dateFrom));

            $dateTo = $mem['doctorateInclusiveDatesOfAttendanceTo'];
            $toMonth = date("m", strtotime($dateTo));
            $toYear = date("Y", strtotime($dateTo));

            if($mem['doctoralgraduate'] == 1)
            {
                $remarks = "Graduated.";
            }

            $educ = array(
                'memberndex' => $ndex,
                'edulevel' => "doctor",
                'schoolname' => $mem['doctorateNameOfSchool'],
                'frommonth' => $fromMonth,
                'fromyear' => $fromYear,
                'tomonth' => $toMonth,
                'toyear' => $toYear,
                'coursename' => $mem['doctorateCourse'],
                'remarks' => $remarks,
            );
            $this->m_member->add_educ_attainment($educ);
        }

        //update record that it is imported, and clear edu data..
        $data = array(
            'doctorateNameOfSchool' => " ",
            'postNameOfSchool' => " ",
            'collNameOfSchool' => " ",
            'vocNameOfSchool' => " ",
            'secNameOfSchool' => " ",
            'elemNameOfSchool' => " ",
        );

        $this->m_member->update_memberbyid($ndex, $data);

        $this->goprofile($mem['misid'], "#educationalbackground");
    }


    public function addeducattainment()
    {
        try{
            if($_POST['edulevel'] == "elementary" || $_POST['edulevel'] == "highschool")
            {
                $educ = array(
                    'memberndex' => $_POST['memberndex'],
                    'edulevel' => $_POST['edulevel'],
                    'schoolname' => $_POST['schoolname'],
                    'remarks' => $_POST['remarks'],
                    'frommonth' => $_POST['frommonth'],
                    'fromyear' => $_POST['fromyear'],
                    'tomonth' => $_POST['tomonth'],
                    'toyear' => $_POST['toyear'],
                );

            }

            if($_POST['edulevel'] == "vocational" || $_POST['edulevel'] == "college" || $_POST['edulevel'] == "masters" || $_POST['edulevel'] == "doctor")
            {
                $educ = array(
                    'memberndex' => $_POST['memberndex'],
                    'edulevel' => $_POST['edulevel'],
                    'schoolname' => $_POST['schoolname'],
                    'remarks' => $_POST['remarks'],
                    'frommonth' => $_POST['frommonth'],
                    'fromyear' => $_POST['fromyear'],
                    'tomonth' => $_POST['tomonth'],
                    'toyear' => $_POST['toyear'],
                    'coursename' => $_POST['coursename'],
                    'unitscompleted' => $_POST['unitscompleted'],
                );

            }

            $this->m_member->add_educ_attainment($educ);
            $this->goprofile($_POST['misid'], "#educationalbackground");
        }
        catch(Exception $e)
        {

        }
    }

    public function updateedu()
    {
        try{
            if($_POST['upedulevel'] == "elementary" || $_POST['upedulevel'] == "highschool")
            {
                $educ = array(
                    'memberndex' => $_POST['memberndex'],
                    'edulevel' => $_POST['upedulevel'],
                    'schoolname' => $_POST['schoolname'],
                    'remarks' => $_POST['remarks'],
                    'frommonth' => $_POST['frommonth'],
                    'fromyear' => $_POST['fromyear'],
                    'tomonth' => $_POST['tomonth'],
                    'toyear' => $_POST['toyear'],
                    'coursename' => '',
                    'unitscompleted' => 0,
                );

            }

            if($_POST['upedulevel'] == "vocational" || $_POST['upedulevel'] == "college" || $_POST['upedulevel'] == "masters" || $_POST['upedulevel'] == "doctor")
            {
                $educ = array(
                    'memberndex' => $_POST['memberndex'],
                    'edulevel' => $_POST['upedulevel'],
                    'schoolname' => $_POST['schoolname'],
                    'remarks' => $_POST['remarks'],
                    'frommonth' => $_POST['frommonth'],
                    'fromyear' => $_POST['fromyear'],
                    'tomonth' => $_POST['tomonth'],
                    'toyear' => $_POST['toyear'],
                    'coursename' => $_POST['coursename'],
                    'unitscompleted' => $_POST['unitscompleted'],
                );
            }

            $this->m_member->update_educ_attainment($_POST['edundex'],$educ);
            $this->goprofile($_POST['misid'], "#educationalbackground");
        }
        catch(Exception $e)
        {

        }
    }

    public function deleteeducrecord()
    {
        try
        {
            $this->m_member->remove_educ_attainment($_POST['edurecordndex']);
            $this->goprofile($_POST['misid'], "#educationalbackground");
        }
        catch(Exception $e)
        {

        }

    }


    public function addworkexp()
    {
        try
        {
            $dateEFROMRaw = explode('/',$_POST['efrom']);
            $dateEFrom = $dateEFROMRaw[2].'-'.$dateEFROMRaw[0].'-'.$dateEFROMRaw[1];

            $dateETORaw = explode('/',$_POST['eto']);
            $dateETO = $dateETORaw[2].'-'.$dateETORaw[0].'-'.$dateETORaw[1];

            $wrk = array(
                'memberId' => $_POST['memberId'],
                'department' => $_POST['department'],
                'address' => $_POST['address'],
                'position' => $_POST['position'],
                'efrom' => $dateEFrom,
                'eto' => $dateETO,
            );

            $this->m_member->addworkexp($wrk);
            $this->goprofile($_POST['misid'], "#educationalbackground");

        }
        catch(Exception $e)
        {

        }
    }

    public function updateworkexp()
    {
        try{
            $dateEFROMRaw = explode('/',$_POST['efrom']);
            $dateEFrom = $dateEFROMRaw[2].'-'.$dateEFROMRaw[0].'-'.$dateEFROMRaw[1];

            $dateETORaw = explode('/',$_POST['eto']);
            $dateETO = $dateETORaw[2].'-'.$dateETORaw[0].'-'.$dateETORaw[1];

            $wrk = array(
                'memberId' => $_POST['memberId'],
                'department' => $_POST['department'],
                'address' => $_POST['address'],
                'position' => $_POST['position'],
                'efrom' => $dateEFrom,
                'eto' => $dateETO,
            );

            $this->m_member->updateworkexp($_POST['workndex'],$wrk);
            $this->goprofile($_POST['misid'], "#educationalbackground");
        }
        catch(Exception $e)
        {

        }
    }

    public function deleteworkexp()
    {
        try{
            $this->m_member->deleteworkexp($_POST['workndex']);
            $this->goprofile($_POST['misid'], "#educationalbackground");
        }
        catch(Exception $e)
        {

        }
    }

    public function addtravel()
    {
        try
        {
            $dateFromRaw = explode('/',$_POST['dateFrom']);
            $dateFrom = $dateFromRaw[2].'-'.$dateFromRaw[0].'-'.$dateFromRaw[1];

            $dateToRaw = explode('/',$_POST['dateTo']);
            $dateTo = $dateToRaw[2].'-'.$dateToRaw[0].'-'.$dateToRaw[1];

            $travs = array(
                'country' => $_POST['country'],
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'purpose' => $_POST['purpose'],
                'memberId' => $_POST['memberndex'],
            );

            $this->m_member->addTravel($travs);
            $this->goprofile($_POST['misid'], "#travelhistory");
        }
        catch(Exception $e)
        {

        }
    }

    public function updatetravel()
    {
        try
        {
            $dateFromRaw = explode('/',$_POST['dateFrom']);
            $dateFrom = $dateFromRaw[2].'-'.$dateFromRaw[0].'-'.$dateFromRaw[1];

            $dateToRaw = explode('/',$_POST['dateTo']);
            $dateTo = $dateToRaw[2].'-'.$dateToRaw[0].'-'.$dateToRaw[1];

            $travs = array(
                'country' => $_POST['country'],
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'purpose' => $_POST['purpose'],
                'memberId' => $_POST['memberndex'],
            );

            $this->m_member->updateTravel($_POST['travelid'], $travs);
            $this->goprofile($_POST['misid'], "#travelhistory");
        }
        catch(Exception $e)
        {

        }
    }

    public function deletetravel()
    {
        try
        {
            $this->m_member->deleteTravel($_POST['travelid']);
            $this->goprofile($_POST['misid'], "#travelhistory");
        }
        catch(Exception $e)
        {

        }
    }

    public function addskill()
    {
        try{
            $skill = array(
                'skillname' => $_POST['skillname'],
                'score' => $_POST['score'],
                'memberId' => $_POST['memberndex']
            );

            $this->m_member->addskill($skill);
            $this->goprofile($_POST['misid'], "#otherinfo");
        }
        catch(Exception $e)
        {

        }
    }


    public function updateskill()
    {
        try{
            $skill = array(
                'skillname' => $_POST['skillname'],
                'score' => $_POST['score'],
            );

            $this->m_member->updateskill($_POST['skillid'],$skill);
            $this->goprofile($_POST['misid'], "#otherinfo");
        }
        catch(Exception $e)
        {

        }
    }
    public function deleteskill()
    {
        try{
            $this->m_member->deleteskill($_POST['skillid']);
            $this->goprofile($_POST['misid'], "#otherinfo");
        }
        catch(Exception $e)
        {

        }
    }

    public function nomisid()
    {
        $data['membercategory'] = $this->m_member->getMemberTypes();
        $data['memstatus'] = $this->m_member->getMemberStatuses();
        $data['klcs'] =$this->m_klc->getklcs();
        $data['nomisidsmember'] = $this->m_member->getpeepswithNoMisid();
        $data['view'] = 'v_nomisid';
        $this->load->view('v_main', $data);
    }

    public function spawnmisid($ndex)
    {
        $injectmisid = array(
            'misid' => $this->generateid(),
        );
        $this->m_member->update_memberbyid($ndex, $injectmisid);
        redirect(base_url()."pds/nomisid");
    }

    public function pagenotfound()
    {
        $this->load->view('v_404');
    }

    public function lock()
    {
        $this->load->view('v_lock');
    }

    public function profile($id)
    {
        $targetndex = $id;
        $data['mem_id'] = $id; // for posting purposes
        $data['klcs'] =$this->m_klc->getklcs();
        $data['membercategory'] = $this->m_member->getMemberTypes();
        $data['memstatus'] = $this->m_member->getMemberStatuses();
        $data['citizenships'] = $this->m_member->getCitizenships();
        $data['ministries'] = $this->m_ministry->getministry();

        $member = $this->m_member->getMemberByMisid($targetndex);
        $data['m'] = $member;
        $data['siblings'] = $this->m_member->getMemberSiblings($member['ndex']);
        $data['children'] = $this->m_member->getMemberChildren($member['ndex']);

        $data['pthistory'] = $this->m_member->getMinistryHistory($member['ndex'], 'ptmw');
        $data['fthistory'] = $this->m_member->getMinistryHistory($member['ndex'], 'ftmw');

        $data['mobs'] = $this->m_member->getMOBParticipation($member['ndex']);

        $data['trainings'] = $this->m_member->getTrainingsAndSeminars($member['ndex']);

        $data['convertedsouls'] = $this->m_member->getFruits($member['ndex']);

        $data['education'] = $this->m_member->get_educ_attainment($member['ndex']);

        $data['workexp'] = $this->m_member->getWorks($member['ndex']);

        $data['travels'] = $this->m_member->getTravels($member['ndex']);

        $data['skills'] = $this->m_member->getmemberskills($member['ndex']);

        $data['depts'] = $this->m_member->getAllDepartments();

        $encoder = $this->m_member->getMemberByNdex($member['updatedBy']);
        if(count($encoder)>0)
        {
            $data['encoderinfo'] = '<br/>'. $encoder['lastName'].', '. $encoder['firstName'];
        }
        else
        {
            $data['encoderinfo'] = '<br/>'.'Encoders Before new System..';
        }


        $loadedsiblings = null;
        $data['loadchildren'] = null;

        if($this->input->post('btnFindSiblingFromMember') == 'FindSiblingFromMember')
        {
            $loadedsiblings = $this->m_member->getMemberByLastNameAndFirstName($_POST['siblingsearchkey']);
        }

        //updating profile Pic
        if($this->input->post('btnuploadphoto') == 'uploadphoto')
        {
            $ndex = $_POST['ndex'];
            if(!is_dir('uploads/'.$ndex)) //check if folder exist
            {
                mkdir('uploads/'.$ndex, 0777, true); //creates folder if not exist
            }

            $config['upload_path'] = 'uploads/'.$ndex;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '1000';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $config['overwrite'] = TRUE;
            $config['file_name']= $ndex;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload())
            {
                if ( ! $this->upload->do_upload()) // if uploading went wrong
                {
                    $data['uploaderror'] = $this->upload->display_errors();
                }
            }
            else
            {
                $photodata = array('upload_data' => $this->upload->data());
                $photoupdate = array(
                    'photoFileName' => $photodata['upload_data']['file_name'],
                );
                $this->m_member->update_memberbyid($ndex, $photoupdate);
                $this->goprofile($targetndex,"");
            }
        }


        //uploading documents
        if($this->input->post('btnuploaddocument') == 'uploaddocument')
        {

            if(empty($member['documentkey']))
            {
                $dirname = $this->generateFilename(7);
            }
            else
            {
                $dirname = $this->encrypt->decode($member['documentkey']);
            }

            $ndex = $_POST['ndex'];
            if(!is_dir('uploads/'.$dirname)) //check if folder exist
            {
                mkdir('uploads/'.$dirname, 0777, true); //creates folder if not exist
            }

            $docconfig['upload_path'] = 'uploads/'.$dirname.'/';
            $docconfig['allowed_types'] = 'gif|jpg|png|xls|xlsx|doc|docx|pdf|rar|zip|ppt|pptx';
            $docconfig['max_size']	= '2000';
            $docconfig['overwrite'] = false;
            $docconfig['file_name']= $this->generateFilename(7);

            $this->load->library('upload', $docconfig);

            if (!$this->upload->do_upload())
            {
                if ( ! $this->upload->do_upload()) // if uploading went wrong
                {
                    $data['fileuploaderror'] = $this->upload->display_errors();
                }
            }
            else
            {
                $filedata = array('upload_data' => $this->upload->data());
                $documentdata = array(
                    'fileName' => $filedata['upload_data']['file_name'],
                    'ext' => $filedata['upload_data']['file_ext'],
                    'filedescription' => $_POST['filedescription'],
                    'memberId' => $member['ndex'],
                    'uploadby' => $this->session->userdata('uid'),
                );
                $this->m_member->add_document($documentdata);

                $documentkey = array(
                    'documentkey' => $this->encrypt->encode($dirname)
                );
                $this->m_member->update_memberbyid($ndex, $documentkey);
            }
        }

        if($this->input->post('btnremovefile') == 'removefile')
        {
            $filetodelete = array(
                'deleted' => 1
            );
            $this->m_member->delete_document($_POST['targetfile'], $filetodelete);
        }

        $this->m_logs->logevent("Opened Record of " . $member['firstName'] . ' ' . $member['lastName'] .' - ' . $id);

        $data['files'] = $this->m_member->getdocuments($member['ndex']);

        $data['loadedsiblings'] = $loadedsiblings;
        $data['activepage'] = 'updatepds';
        $data['view'] = 'v_pds_form';
        $this->load->view('v_main', $data);
    }

    public function documentactions()
    {
        if($this->input->post('btndownloadfile') == 'downloadfile')
        {
            $requester = $_POST['misid'];
            $member = $this->m_member->getMemberByMisid($requester);
            $locdir = $this->encrypt->decode($member['documentkey']);
            $file = $this->m_member->getthatdoc($_POST['targetfile']);
            redirect(base_url().UPLOAD_FOLDER.'/'.$locdir.'/'.$file['fileName']);
        }

    }


    public function addmobhist($misid)
    {
        $member = $this->m_member->getMemberByMisid($misid);

        $mob = array(
            'memberndex' => $member['ndex'],
            'mobyear' => $_POST['mobyear'],
            'meansandways' => $_POST['meansandways'],
            'goalamount' => $_POST['goalamount'],
            'achievedgoal' => $_POST['achievedgoal']
        );

        $this->m_member->addmobparticipation($mob);
        $this->goprofile($misid, '#spiritualandministry');
    }

    public function deletemobhist($misid)
    {
        $mobid = $_POST['mobndex'];
        $this->m_member->deletemobparticipation($mobid);
        $this->goprofile($misid, '#spiritualandministry');
    }

    public function updatemobhist($misid)
    {
        $member = $this->m_member->getMemberByMisid($misid);
        $mobndex = $_POST['mobndex'];

        $mob = array(
            'memberndex' => $member['ndex'],
            'mobyear' => $_POST['mobyear'],
            'meansandways' => $_POST['meansandways'],
            'goalamount' => $_POST['goalamount'],
            'achievedgoal' => $_POST['achievedgoal']
        );

        $this->m_member->updatemobparticipation($mobndex, $mob);
        $this->goprofile($misid, '#spiritualandministry');
    }

    public function addtraining($misid)
    {

        $dateTakenRaw = explode('/',$_POST['dateTaken']);
        $dateTaken = $dateTakenRaw[2].'-'.$dateTakenRaw[0].'-'.$dateTakenRaw[1];

        $member = $this->m_member->getMemberByMisid($misid);
        $training = array(
            'tsName' => $_POST['tsName'],
            'description' => $_POST['description'],
            'remarks' => $_POST['remarks'],
            'dateTaken' => $dateTaken,
            'memberId' => $member['ndex']
        );

        $this->m_member->addtraining($training);

        $this->goprofile($misid, '#spiritualandministry');
    }

    function deletetrainings($memberMisid, $trainingId)
    {
        $this->m_member->deletetraining($trainingId);
        $this->goprofile($memberMisid, "#spiritualandministry");

    }

    function updatetraining($misid)
    {
        $trainingId = $_POST['trainingid'];
        $dateTakenRaw = explode('/',$_POST['dateTaken']);
        $dateTaken = $dateTakenRaw[2].'-'.$dateTakenRaw[0].'-'.$dateTakenRaw[1];

        $member = $this->m_member->getMemberByMisid($misid);
        $training = array(
            'tsName' => $_POST['tsName'],
            'description' => $_POST['description'],
            'remarks' => $_POST['remarks'],
            'dateTaken' => $dateTaken,
            'memberId' => $member['ndex']
        );

        $this->m_member->updatetraining($training, $trainingId);
        $this->goprofile($misid, '#spiritualandministry');
    }

    public function updatepds($id)
    {
        $targetndex = $id;
        //udpates personal info
        if($this->input->post('btnUpdatePersonalInfo') == "UpdatePersonalInfo")
        {
            $data = array(
                'lastName' => $_POST['lastName'],
                'firstName' => $_POST['firstName'],
                'middleName' => $_POST['middleName'],
                'memberClass' => $_POST['memberClass'],
                'memberStatus' => $_POST['memberStatus'],
                'nickName' => $_POST['nickName'],
                'citizenshipno' => $_POST['citizenshipno'],
                'civilStatus' => $_POST['civilStatus'],
                'emailAddress' => $_POST['emailAddress'],
                'mobileNo' => $_POST['mobileNo'],
                'dateOfBirth' => $this->bangthisdate($_POST['dateOfBirth']),
                'placeOfBirth' => $_POST['placeOfBirth'],
                'languageSpoken' => $_POST['languageSpoken'],
                'height' => $_POST['height'],
                'weight' => $_POST['weight'],
                'bloodType' => $_POST['bloodType'],
                'sssNo' => $_POST['sssNo'],
                'gsisIdNo' => $_POST['gsisIdNo'],
                'philHealthNo' => $_POST['philHealthNo'],
                'pagIbigNo' => $_POST['pagIbigNo'],
                'tin' => $_POST['tin'],
                'seniorCitezenNo' => $_POST['seniorCitezenNo'],
                'driversLicenseNo' => $_POST['driversLicenseNo'],
                'prcLicenceNo' => $_POST['prcLicenceNo'],
                'presentAddress' => $_POST['presentAddress'],
                'presentZip' => $_POST['presentZip'],
                'permanentAddress' => $_POST['permanentAddress'],
                'permanentZip' => $_POST['permanentZip'],
                'formerAddress' => $_POST['formerAddress'],
                'formerZip' => $_POST['formerZip'],
                'ministry' => $_POST['ministry'],
                'addlministry' => $_POST['addlministry'],
                'ministrydescription' => $_POST['ministrydescription'],
                'klc' => $_POST['klc'],
                'originklc' => $_POST['originklc'],
                'dept' => $_POST['dept'],
                'gender' => $_POST['gender'],
                'dateupdated' => date('Y/m/d H:i:s',time())
            );


            $this->logversionhistory($_POST['recordndex'],$_POST['encodername'],"Updated Personal Information");
            $this->m_member->update_member($targetndex, $data);
            $this->goprofile($targetndex,"");
        }


        //passport information
        if($this->input->post('btnupdatepassport') == "updatepassport")
        {
            try{
                $passport = array(
                    'passportNo' => $_POST['passportNo'],
                    'passportDateIssued' => $this->bangthisdate($_POST['passportDateIssued']),
                    'passportExpiryDate' => $this->bangthisdate($_POST['passportExpiryDate']),
                );

                $this->m_member->update_member($targetndex, $passport);
                $this->goprofile($targetndex, "#travelhistory");
            }
            catch(Exception $e)
            {

            }
        }

        //legal background
          if($this->input->post('btnupdatelegal') == "updatelegal")
          {
              try{
                  $legal = array(
                    'convicted' => $_POST['convicted'],
                    'convictedDetails' => $_POST['convictedDetails'],
                    'pendingCriminalCase' => $_POST['pendingCriminalCase'],
                    'pendingCriminalCaseDetails' => $_POST['pendingCriminalCaseDetails'],
                  );

                  $this->m_member->update_member($targetndex, $legal);
                  $this->goprofile($targetndex, "#otherinfo");
              }
              catch(Exception $e)
              {

              }
          }

        // update medical background
        if($this->input->post('btnupdatemedical') == "updatemedical")
        {
            try{
                $medical = array(
                    'afflictedInfectious' => $_POST['afflictedInfectious'],
                    'afflictedInfectiousDetails' => $_POST['afflictedInfectiousDetails'],
                    'afflictedMental' => $_POST['afflictedMental'],
                    'afflictedMentalDetails' => $_POST['afflictedMentalDetails'],
                    'drugAbuser' => $_POST['drugAbuser'],
                    'traumaticExperience' => $_POST['traumaticExperience'],
                    'traumaticExperienceDetails' => $_POST['traumaticExperienceDetails'],
                    'hospitalized' => $_POST['hospitalized'],
                    'hospitalizedWhen' => $this->bangthisdate($_POST['hospitalizedWhen']),
                    'hospitalizedWhy' => $_POST['hospitalizedWhy'],
                    'suffering' => $_POST['suffering'],
                    'sufferingDetails' => $_POST['sufferingDetails'],
                    'physicalDefects' => $_POST['physicalDefects'],
                    'physicalDefectsDetails' => $_POST['physicalDefectsDetails'],


                );

                $this->m_member->update_member($targetndex, $medical);
                $this->goprofile($targetndex, "#otherinfo");
            }
            catch(Exception $e)
            {

            }
        }

        //family background
        if($this->input->post('btnUpdateFamilyBackground') == "UpdateFamilyBackground")
        {

            $data = array(
                'fathersLastName' => $_POST['fathersLastName'],
                'fathersFirstName' => $_POST['fathersFirstName'],
                'fathersMiddleName' => $_POST['fathersMiddleName'],
                'fathersBirthday' => $this->bangthisdate($_POST['fathersBirthday']),
                'fathersBirthPlace' => $_POST['fathersBirthPlace'],
                'fathersCitizenship' => $_POST['fathersCitizenship'],
                'fathersKingdomStatus' => $_POST['fathersKingdomStatus'],
                'fathersPhone' => $_POST['fathersPhone'],
                'fathersOccupation' => $_POST['fathersOccupation'],
                'fathersAddress' => $_POST['fathersAddress'],
                'fathersDeceased' => $_POST['fathersDeceased'],
                'fathersDateDied' => $this->bangthisdate($_POST['fathersDateDied']),

                'mothersLastName' => $_POST['mothersLastName'],
                'mothersFirstName' => $_POST['mothersFirstName'],
                'mothersMiddleName' => $_POST['mothersMiddleName'],
                'mothersBirthday' => $this->bangthisdate($_POST['mothersBirthday']),
                'mothersBirthPlace' => $_POST['mothersBirthPlace'],
                'mothersCitizenship' => $_POST['mothersCitizenship'],
                'mothersKingdomStatus' => $_POST['mothersKingdomStatus'],
                'mothersPhone' => $_POST['mothersPhone'],
                'mothersOccupation' => $_POST['mothersOccupation'],
                'mothersAddress' => $_POST['mothersAddress'],
                'mothersDeceased' => $_POST['mothersDeceased'],
                'mothersDateDied' => $this->bangthisdate($_POST['mothersDateDied']),

                'spouseLastName' => $_POST['spouseLastName'],
                'spouseFirstName' => $_POST['spouseFirstName'],
                'spouseMiddleName' => $_POST['spouseMiddleName'],
                'spouseBirthday' => $this->bangthisdate($_POST['spouseBirthday']),
                'spouseBirthPlace' => $_POST['spouseBirthPlace'],
                'spouseCitizenship' => $_POST['spouseCitizenship'],
                'spouseKingdomStatus' => $_POST['spouseKingdomStatus'],
                'spousePhone' => $_POST['spousePhone'],
                'spouseOccupation' => $_POST['spouseOccupation'],
                'spouseAddress' => $_POST['spouseAddress'],
                'spouseDeceased' => $_POST['spouseDeceased'],
                'spouseDateDied' => $this->bangthisdate($_POST['spouseDateDied']),


                'dateupdated' => date('Y/m/d H:i:s',time())
            );

            $this->m_member->update_member($targetndex, $data);
            $this->logversionhistory($_POST['recordndex'],$_POST['encodername'],"Updated Family Background");
            $this->goprofile($targetndex,"#familybackground");
        }

        if($this->input->post('btnUpdateSpiritualBackground') == "UpdateSpiritualBackground")
        {
            $waterBaptismDateRaw = explode('/',$_POST['waterBaptismDate']);
            $waterBaptismDate = $waterBaptismDateRaw[2].'-'.$waterBaptismDateRaw[0].'-'.$waterBaptismDateRaw[1];

            $waterReBaptismDate = null;
            if(empty($_POST['waterReBaptismDate']) == false) //means may laman
            {
                $waterReBaptismDateRaw = explode('/',$_POST['waterReBaptismDate']);
                $waterReBaptismDate = $waterReBaptismDateRaw[2].'-'.$waterReBaptismDateRaw[0].'-'.$waterReBaptismDateRaw[1];
            }

            if(isset($_POST['howConvertedByWhom']))
            {
                $howConvertedByWhom = $_POST['howConvertedByWhom'];

            }
            else
            {
                $howConvertedByWhom = "";
            }

            if(isset($_POST['howConvertedOthers']))
            {
                $howConvertedOthers = $_POST['howConvertedOthers'];
            }
            else
            {
                $howConvertedOthers = "";
            }
            $data = array(
                'waterBaptismDate' => $waterBaptismDate,
                'waterBaptismPlace' => $_POST['waterBaptismPlace'],
                'waterBaptismByWhom' => $_POST['waterBaptismByWhom'],
                'waterReBaptismDate' => $waterReBaptismDate,
                'waterReBaptismPlace' => $_POST['waterReBaptismPlace'],
                'waterReBaptismByWhom' => $_POST['waterReBaptismByWhom'],
                'reasonForRebaptism' => $_POST['reasonForRebaptism'],
                'eventsMOD' => $_POST['eventsMOD'],
                'eventsIYC' => $_POST['eventsIYC'],
                'eventsIKLC' => $_POST['eventsIKLC'],
                'iKLCSeminar' => $_POST['iKLCSeminar'],
                'tribute' => $_POST['tribute'],
                'howConverted' => $_POST['howConverted'],
                'howConvertedByWhom' => $howConvertedByWhom,
                'howConvertedOthers' => $howConvertedOthers,
                'dateEnteredPartTimeMinistry' => $this->bangthisdate($_POST['dateEnteredPartTimeMinistry']),
                'dateEnteredFullTimeMinistry' => $this->bangthisdate($_POST['dateEnteredFullTimeMinistry']),
                'dateReEnteredFullTimeMinistry' => $this->bangthisdate($_POST['dateReEnteredFullTimeMinistry']),
            );
            $this->logversionhistory($_POST['recordndex'],$_POST['encodername'],"Update Sipiritual Background");
            $this->m_member->update_member($targetndex, $data);
            $this->goprofile($targetndex,"#spiritualandministry");
        }
    }

    public function myaccount()
    {
        if(isset($_POST['username']) && isset($_POST['currentpassword']))
        {
            $data['updateresult'] = $this->updatepasswordfrommyaccount($_POST['username'], $_POST['uid'],  $_POST['currentpassword'], $_POST['password']);
        }
        else
        {
            $data['updateresult'] = null;
        }
        $data['view'] = 'v_myaccount';
        $data['activepage'] = 'myaccount';
        $this->load->view('v_main', $data);
    }

    function updatepasswordfrommyaccount($username, $uid, $currentpassword, $newpassword)
    {
        $boolconfirmlogin = $this->m_user->login($username, $currentpassword);
        if($boolconfirmlogin)
        {
            $userdata = array(
                'password' => $this->encrypt->encode($newpassword),
                'hash' =>  hash('sha256',$newpassword . ASINPARAT),
            );
            $this->m_user->updateuser($uid, $userdata);

            $tups = array
            (
                'status' => 'ok',
                'message' => 'Password Successfully Changed'
            );
            return $tups;
        }
        else
        {
            $tups = array
            (
                'status' => 'nok',
                'message' => 'Password Incorrect. Note that you only have limited attempt to changes your password. <br/> Invalid attempts will cause your account to be deactivated.'
            );
            return $tups;
        }

    }

    public function look()
    {
        redirect(base_url().'pds/lookup?q='.$_POST['query']);
    }
    public function lookup()
    {
        if(isset($_GET['q']))
        {
            $data['searchlist'] = $this->m_member->getMemberByKey($_GET['q']);
        }
        else
        {
            $data['searchlist'] = null;
        }

        $data['klcs'] =$this->m_klc->getklcs();
        $data['membercategory'] = $this->m_member->getMemberTypes();
        $data['activepage'] = 'dashboard';
        $data['view'] = 'v_lookup';
        $this->load->view('v_main', $data);
    }


    public function newpds()
    {
        $data['membertype'] = null;
        $data['existingrecs'] = null;
        $data['lastname'] = null;
        $data['firstname'] = null;
        $data['middlename'] = null;
        $data['dateOfBirth'] = null;
        $data['datebaptized'] = null;
        $data['currentklc'] = null;
        $data['gender'] = null;
        $data['waterBaptismDate'] = null;
        $data['civilStatus'] = null;
        $data['activepage'] = 'newpds';

        if($this->input->post('btnAddNewPds') == "AddNewPds")
        {
            $existingrecords = $this->m_member->findExistingMember($_POST['lastname'], $_POST['firstname']);

            $data['membertype'] = $_POST['membertype'];
            $data['lastname'] = $_POST['lastname'];
            $data['firstname'] = $_POST['firstname'];
            $data['middlename'] = $_POST['middlename'];
            $data['dateOfBirth'] = $_POST['dateOfBirth'];
            $data['waterBaptismDate'] = $_POST['waterBaptismDate'];
            $data['currentklc'] = $_POST['currentklc'];
            $data['gender'] = $_POST['gender'];
            $data['civilStatus'] = $_POST['civilStatus'];

            if(count($existingrecords)>0) //there is the same name somewhere
            {
                $data['membertypes'] = $this->m_member->getMemberTypes();
                $data['memberstatuses'] = $this->m_member->getMemberStatuses();
                $data['existingrecs'] = $existingrecords;
                $data['klcs'] = $this->m_klc->getklcs();
                $data['view'] = 'v_new_pds';
                $this->load->view('v_main', $data);
            }
            else
            {
                $this->savepds($data);
            }

        }
        elseif($this->input->post('btnForceSavePds') == "ForceSavePds") { //this means user intend to save the record regardless of warning notification

            $data['membertype'] = $_POST['membertype'];
            $data['lastname'] = $_POST['lastname'];
            $data['firstname'] = $_POST['firstname'];
            $data['middlename'] = $_POST['middlename'];
            $data['dateOfBirth'] = $_POST['dateOfBirth'];
            $data['waterBaptismDate'] = $_POST['waterBaptismDate'];
            $data['currentklc'] = $_POST['currentklc'];
            $data['gender'] = $_POST['gender'];
            $data['civilStatus'] = $_POST['civilStatus'];

            $this->savepds($data);
        }
        else
        {
            $data['klcs'] = $this->m_klc->getklcs();
            $data['view'] = 'v_new_pds';
            $this->load->view('v_main', $data);
        }

    }

    function savepds($pdsdata)
    {
        $date_of_birth = explode('/',$pdsdata['dateOfBirth']);
        $birthdate = $date_of_birth[2].'-'.$date_of_birth[0].'-'.$date_of_birth[1];

        $waterbap_birth = explode('/',$pdsdata['waterBaptismDate']);
        $baptdate = $waterbap_birth[2].'-'.$waterbap_birth[0].'-'.$waterbap_birth[1];

        $newId = $this->generateid();
        $data = array (
            "memberClass" =>$pdsdata['membertype'],
            "lastName" => $pdsdata['lastname'],
            "firstName" => $pdsdata['firstname'],
            "middleName" => $pdsdata['middlename'],
            "misid" => $newId,
            "memberStatus" => "1" ,
            "klc" => $pdsdata['currentklc'],
            "dateOfBirth" => $birthdate,
            "waterBaptismDate" => $baptdate,
            "gender" => $pdsdata['gender'],
            'civilStatus' => $pdsdata['civilStatus'],
            "dateupdated" => date('Y/m/d H:i:s'),
            "encodedBy" => $this->session->userdata('uid')

        );
        $this->m_logs->logevent("Created New PDS Record For " . $pdsdata['firstname'] . ' ' . $pdsdata['lastname'] . ' - ' . $newId);
        $this->m_member->addNewPDS($data);
        $this->goprofile($newId,"");

    }


    function goprofile($id, $tab)
    {
        redirect(base_url().'pds/profile/'.$id.$tab);
    }

    function myKey()
    {
        return "pdskey";
    }


    function creepIn($q)
    {
        $cryptKey  = $this->myKey();
        $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
        return( $qEncoded );
    }

    function creepOut($q )
    {
        $cryptKey  = $this->myKey();
        $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
        return( $qDecoded );
    }

    function generateid()
    {
        return "KJC".time() * 100;
    }

    function bangthisdate($date)
    {
        $dateRaw = explode('/',$date);
        $datefinished = $dateRaw[2].'-'.$dateRaw[0].'-'.$dateRaw[1];
        return $datefinished;
    }

    function generateFilename($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function logversionhistory($recordndex, $encodername, $event)
    {
        $data = array (
            "recordndex" => $recordndex,
            "encodername" => $encodername,
            "event" => $event,
        );
        //$this->m_member->logversionhistory($data);
    }

}