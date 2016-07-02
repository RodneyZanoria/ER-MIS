<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Jezriel
 * Date: 3/13/2015
 * Time: 11:43 AM
 */

class m_member extends CI_Model
{


    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    function getpeepswithNoMisid()
    {
        $this->db->where('misid', '');
        $this->db->or_where('misid', '0');
        $q = $this->db->get('members');
        return $q->result();
    }

    function getMemberByKey($name)
    {
        $where = "(ndex = '$name' OR firstName LIKE '%$name%' OR nickName LIKE '%$name%' OR lastName LIKE '%$name%' OR misid LIKE '%$name%' OR CONCAT(firstName,' ',lastName) LIKE '%$name%')";
        $this->db->where('memberClass !=', 9);
        $this->db->where($where);
        $query = $this->db->get('members');
        return $query->result();
    }

    function findExistingMember($lastname, $firstname)
    {
        $where = "firstName LIKE '%$firstname%' AND lastName LIKE '%$lastname%'";
        $this->db->where('memberclass !=', 9);
        $this->db->where('deleted =', 0);
        $this->db->where($where);
        $query = $this->db->get('members');
        return $query->result();
    }

    function getMemberTypes()
    {
        $query = $this->db->get('member_classifications');
        return $query->result();
    }

    function getMemberByNdex($id)
    {

        $this->db->where('ndex', $id);
        $this->db->where('deleted', 0);
        $query = $this->db->get('members');
        return $query->row_array();

    }

    function getMemberByMisid($misid)
    {
        $this->db->where('misid', $misid);
        $this->db->where('deleted', 0);
        $query = $this->db->get('members');
        return $query->row_array();
    }

    function getMisid($ndex)
    {
        $this->db->where('ndex', $ndex);
        $this->db->where('deleted', 0);
        $query = $this->db->get('members');
        $member = $query->row_array();
        return $member['misid'];
    }

    function getMemberStatuses()
    {
        $query = $this->db->get('member_status');
        return $query->result();
    }


    function addNewPDS($data)
    {
        $this->db = $this->load->database('default', TRUE);
        $this->db->insert('members', $data);
    }

    function update_member($id, $data)
    {
        $this->db->where('misid', $id);
        $this->db->update('members', $data);

        $encoderlog = array(
            "dateupdated" => date('Y-m-d H:i:s'),
            'updatedBy' => $this->session->userdata('uid')
        );

        $this->db->where('misid', $id);
        $this->db->update('members', $encoderlog);
    }

    function update_memberbyid($id, $data)
    {
        $this->db->where('ndex', $id);
        $this->db->update('members', $data);
    }

    function getCitizenships()
    {
        $query = $this->db->get('member_citizenships');
        return $query->result();
    }

    function getMemberSiblings($ndex)
    {
        $this->db->select('members.*');
        $this->db->select('siblings.ndex');
        $this->db->select('members.ndex');
        $this->db->select('member_classifications.classification');
        $this->db->from('siblings');
        $this->db->join('members', 'siblings.siblingId = members.ndex', 'left');
        $this->db->join('member_classifications', 'members.memberClass = member_classifications.ndex', 'right');
        $this->db->where('siblings.memberId', $ndex);
        $query = $this->db->get();
        return $query->result();
    }

    function getMemberChildren($ndex)
    {
        $this->db->select('members.*');
        $this->db->select('children.ndex');
        $this->db->select('members.ndex');
        $this->db->select('member_classifications.classification');
        $this->db->from('children');
        $this->db->join('members', 'children.childId = members.ndex', 'left');
        $this->db->join('member_classifications', 'members.memberClass = member_classifications.ndex', 'right');
        $this->db->where('children.memberId', $ndex);
        $query = $this->db->get();
        return $query->result();
    }

    function getMemberByLastNameAndFirstName($name)
    {
        $qwhere = "(ndex = '$name' OR firstName LIKE '%$name%' OR lastName LIKE '%$name%' OR misid LIKE '%$name%' OR CONCAT(firstName,' ',lastName) LIKE '%$name%')";
        $this->db->where($qwhere);
        $this->db->where('deleted',0);
        $query = $this->db->get('members');
        return $query->result();
    }

    function getExclusiveMemberByLastNameAndFirstName($name)
    {
        $qwhere = "(ndex = '$name' OR firstName LIKE '%$name%' OR lastName LIKE '%$name%' OR misid LIKE '%$name%' OR CONCAT(firstName,' ',lastName) LIKE '%$name%')";
        $this->db->where($qwhere);
        $this->db->where('memberClass !=',9);
        $this->db->where('deleted',0);
        $query = $this->db->get('members');
        return $query->result();
    }

    function addsibling($data)
    {
        $this->db->insert('siblings', $data);
    }

    function deletesibling($siblingId, $memberId)
    {
        $this->db->where('siblingId', $siblingId);
        $this->db->where('memberId', $memberId);
        $this->db->delete('siblings');
    }

    function addchild($data)
    {
        $this->db->insert('children', $data);
    }

    function deletechild($childId, $memberId)
    {
        $this->db->where('childId', $childId);
        $this->db->where('memberId', $memberId);
        $this->db->delete('children');
    }

    function getMOBParticipation($id)
    {
        $this->db->where('memberndex', $id);
        $q = $this->db->get('mob_participation');
        return $q->result();
    }

    function addmobparticipation($mobdata)
    {
        $this->db->insert('mob_participation', $mobdata);
    }

    function deletemobparticipation($mobid)
    {
        $this->db->where('ndex', $mobid);
        $this->db->delete('mob_participation');
    }

    function updatemobparticipation($mobid, $mobdata)
    {
        $this->db->where('ndex', $mobid);
        $this->db->update('mob_participation', $mobdata);
    }


    function getTrainingsAndSeminars($id)
    {
        $this->db->where('memberId', $id);
        $q = $this->db->get('trainingsseminars');
        return $q->result();
    }

    function addtraining($training)
    {
        $this->db->insert('trainingsseminars', $training);
    }

    function deletetraining($trainingId)
    {
        $this->db->where('ndex', $trainingId);
        $this->db->delete('trainingsseminars');
    }

    function updatetraining($training, $trainingId)
    {
        $this->db->where('ndex', $trainingId);
        $this->db->update('trainingsseminars', $training);
    }


    function getFruits($id)
    {
        $this->db->select('members.*');
        $this->db->select('fruits.ndex');
        $this->db->select('member_classifications.classification');
        $this->db->from('fruits');
        $this->db->join('members','fruits.fruitId = members.ndex', 'left');
        $this->db->join('member_classifications','members.memberClass = member_classifications.ndex', 'left');
        $this->db->where('fruits.memberId', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function connectfruit($data)
    {
        $this->db->set($data);
        $this->db->insert('fruits');
        return $this->db->insert_id();
    }

    function deleteFruit($id)
    {
        $this->db->where('ndex', $id);
        $this->db->delete('fruits');
    }

    function getMinistryHistory($memberid, $tag)
    {
        $this->db->where('memberId', $memberid);
        $this->db->where('tag', $tag);
        $q = $this->db->get('ministryhistory');
        return $q->result();
    }

    function getAllDepartments()
    {
        $q = $this->db->get('kjc_departments');
        return $q->result();
    }

    function addministryhistory($data)
    {
        $this->db->insert('ministryhistory',$data);
    }

    function updateminitryhistory($ndex, $data)
    {
        $this->db->where('ndex', $ndex);
        $this->db->update('ministryhistory', $data);
    }

    function removeministryhistory($mhistoryid)
    {
        $this->db->where('ndex', $mhistoryid);
        $this->db->delete('ministryhistory');
    }

    function add_educ_attainment($data)
    {
        $this->db->insert('member_educ_attainment', $data);
    }

    function update_educ_attainment($ndex, $data)
    {
        $this->db->where('ndex', $ndex);
        $this->db->update('member_educ_attainment', $data);
    }

    function get_educ_attainment($memberndex)
    {
        $this->db->where('memberndex', $memberndex);
        $q = $this->db->get('member_educ_attainment');
        return $q->result();
    }

    function remove_educ_attainment($ndex)
    {
        $this->db->where('ndex', $ndex);
        $this->db->delete('member_educ_attainment');
    }

    function addworkexp($data)
    {
        $this->db->insert('works',$data);
    }

    function updateworkexp($ndex, $data)
    {
        $this->db->where('ndex', $ndex);
        $this->db->update('works', $data);
    }

    function deleteworkexp($workid)
    {
        $this->db->where('ndex', $workid);
        $this->db->delete('works');
    }

    function getWorks($ndex)
    {
        $this->db->where('memberId', $ndex);
        $q = $this->db->get('works');
        return $q->result();
    }

    function getTravels($memberid)
    {
        $this->db->where('memberId', $memberid);
        $q = $this->db->get('travelhistory');
        return $q->result();
    }

    function addTravel($data)
    {
        $this->db->insert('travelhistory', $data);
    }

    function updateTravel($travelndex, $data)
    {
        $this->db->where('ndex', $travelndex);
        $this->db->update('travelhistory', $data);
    }

    function deleteTravel($travelid)
    {
        $this->db->where('ndex', $travelid);
        $this->db->delete('travelhistory');
    }

    function addskill($data)
    {
        $this->db->insert('memberskills', $data);
    }

    function updateskill($skillid, $data)
    {
        $this->db->where('ndex', $skillid);
        $this->db->update('memberskills', $data);
    }

    function deleteskill($skillid)
    {
        $this->db->where('ndex', $skillid);
        $this->db->delete('memberskills');
    }

    function getmemberskills($memberId)
    {
        $this->db->where('memberId', $memberId);
        $q = $this->db->get('memberskills');
        return $q->result();
    }

    function logencoderviamisid($misid)
    {

        $encoderlog = array(
            "dateupdated" => date('Y-m-d H:i:s'),
            'updatedBy' => $this->session->userdata('uid')
        );

        $this->db->where('misid', $misid);
        $this->db->update('members', $encoderlog);
    }

    function logencoderviandex($ndex)
    {

        $encoderlog = array(
            "dateupdated" => date('Y-m-d H:i:s'),
            'updatedBy' => $this->session->userdata('uid')
        );

        $this->db->where('ndex', $ndex);
        $this->db->update('members', $encoderlog);
    }

    function getthatdoc($ndex)
    {
        $this->db->where('ndex', $ndex);
        $q = $this->db->get('documents');
        return $q->row_array();
    }

    function add_document($data)
    {
        $this->db->insert('documents', $data);
    }

    function delete_document($ndex, $data)
    {
        $this->db->where('ndex', $ndex);
        $this->db->update('documents', $data);
    }

    function getdocuments($ndex)
    {
        $this->db = $this->load->database('default', TRUE);
        $this->db->select('members.ndex, members.lastName, members.firstName, members.middleName');
        $this->db->select('documents.*');
        $this->db->join('members','members.ndex = documents.uploadby','left');
        $this->db->where('documents.deleted', 0);
        $this->db->where('documents.memberId', $ndex);
        $this->db->from('documents');
        $q = $this->db->get();
        return $q->result();
    }

    function logevent($ip, $username, $event)
    {

    }

    //version history
    function logversionhistory($data)
    {
        $this->db->insert('versionhistory', $data);
    }
}
?>