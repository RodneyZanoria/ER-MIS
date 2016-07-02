<?php
/**
 * Created by PhpStorm.
 * User: Jezriel
 * Date: 2/19/2015
 * Time: 6:14 PM
 */

//
//$arrcategory = array();
//$arrklc = array();
//$arrdept = array();
//
//foreach($membercategory as $cat)
//{
//    $arrcategory += array(
//        $cat->ndex => $cat->classification
//    );
//}
//
//foreach($klcs as $k)
//{
//    $arrklc += array(
//        $k->ndex => $k->klcName
//    );
//}


?>


<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
<div class="page-content">

<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="index.html">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Profiles
                <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Member's Profile</a>
        </li>
    </ul>
    <div class="page-toolbar">

    </div>
</div>


<div class="row">
<div class="col-md-12 portlet light">
<div class="row">
    <div class="col-md-3">
        <ul class="list-unstyled profile-nav">
            <li>
                <!--<img src="<?= base_url() ?>assets/admin/pages/media/profile/profile-img.png" class="img-responsive" alt=""/> -->
                <img src="<?= "http://kjcmis.kojc.net/uploads/".$m['ndex']."/".$m['photoFileName'] ?>" class="img-responsive" alt=""/>
                <!-- <a href="#" class="profile-edit">edit </a>-->
            </li>
        </ul>
    </div>

    <div class="col-md-9">
        <div class="row">
            <div class="col-md-8 profile-info">
                <h1><?= ucfirst(strtolower($m['firstName'])). " ". ucfirst(strtolower($m['middleName'])). " ". ucfirst(strtolower($m['lastName'])) ?></h1>
                <p>
                    <i class="fa fa-qrcode"></i> Centralized ID: <?= $m['misid'] ?> <br/>
                    <i class="fa fa-star"></i> <?= $arrcategory[$m['memberClass']] . " " ?> <?= ($m['memberStatus'] != 0)?" (" . $m['memberStatus'] . ")":"" ?>  |  <i class="fa fa-map-marker"></i><a href="" class="btn popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="KLC Address soon.." data-original-title="KLC of <?= ucfirst(strtolower($arrklc[$m['klc']])) ?>">KLC of <?= ucfirst(strtolower($arrklc[$m['klc']])) ?> </a><br/>
                    <i class="fa fa-male"></i> <?= $m['gender'] ?> - ( <?= $m['civilStatus'] ?> ) <br/>
                    <i class="fa fa-calendar"></i> Birthday: <?php $originalDate = $m['dateOfBirth']; $newDate = date("M d, Y", strtotime($originalDate));  echo $newDate; ?> <br/>
                    <i class="fa fa-calendar"></i> Date Baptized: <?php $originalDate = $m['waterBaptismDate']; $newDate = date("M d, Y", strtotime($originalDate));  echo $newDate; ?>  <br/>
                    <?php if($m['memberClass'] != 9 && $m['memberClass'] !=3 ) {?>
                        <i class="fa fa-briefcase"></i> Department: <?= $m['department'] ?> | <i class="fa fa-lightbulb-o"></i> Ministry: <?= $m['presentMinistry'] ?> <br/>
                    <?php } ?>

                    <i class="fa fa-phone"></i> Email: <a href="mailto:<?= $m['emailAddress'] ?>"><?= $m['emailAddress'] ?></a> | Contact No. : <?= $m['mobileNo'] ?>
                </p>


            </div>
            <!--end col-md-8-->
            <div class="col-md-4">
                <div class="portlet sale-summary">
                    <div class="portlet-title">
                        <div class="caption">
                            Record Details
                        </div>
                        <div class="tools">
                            <a class="reload" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <ul class="list-unstyled">
                            <li>
                                                <span class="sale-info">
                                                    Date Encoded: <i class="fa fa-img-up"></i>
                                                </span>
                                <span class="sale-num"> work in progress.. </span>
                            </li>
                            <li>
                                                <span class="sale-info">
                                                    Date Last Updated: <i class="fa fa-img-down"></i>
                                                </span>
                                <span class="sale-num"> work in progress..  </span>
                            </li>

                            <li>
                                                <span class="sale-info">
                                                    Profile Completeness <i class="fa fa-img-down"></i>
                                                </span>
                                <span class="sale-num"> work in progress..  </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--end col-md-4-->
        </div>
        <!--end row-->

    </div>
</div>
<!--end row-->
<hr/>
<div class="clearfix"></div>

<div class="tabbable">

<ul class="nav nav-tabs nav-tabs-lg">
    <li class="active">
        <a href="#personalinfo" data-toggle="tab">
            <span class="fa fa-info"></span> <small>Personal Information</small>
        </a>
    </li>
    <li class="">
        <a href="#familybackground" data-toggle="tab">
            <span class="fa fa-users"></span> <small>Family Background</small>
        </a>
    </li>
    <li class="">
        <a href="#spiritualandministry" data-toggle="tab">
            <span class="fa fa-trophy"></span> <small>Spiritual & Ministerial History</small>
        </a>
    </li>
    <li class="">
        <a href="#educationalbackground" data-toggle="tab">
            <span class="fa fa-graduation-cap"></span> <small>Education and Work Exp.</small>
        </a>
    </li>


    <li class="">
        <a href="#travelhistory" data-toggle="tab">
            <span class="fa fa-plane"></span> <small>Travel History</small>
        </a>
    </li>

    <li class="">
        <a href="#otherinfo" data-toggle="tab">
            <span class="fa fa-star"></span> <small>Others</small>
        </a>
    </li>
</ul>

<div class="tab-content">
<div class="tab-pane active" id="personalinfo">

    <div class="row">
        <div class="col-sm-12">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-info font-blue"></i>
                                                 <span class="caption-subject bold font-purple-plum uppercase">
                                                    Personal Information
                                                 </span>
                    </div>

                </div>
                <div class="portlet-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">

                            <tbody>

                            <tr>
                                <td width="20%"> <strong>NickName</strong> </td>
                                <td width="80%"> <?= $m['nickName'] ?> </td>
                            </tr>

                            <tr>
                                <td width="20%"> <strong>Citizenship</strong> </td>
                                <td width="80%"> <?= $m['citizenship'] ?> </td>
                            </tr>


                            <tr>
                                <td width="20%"> <strong>Place of Birth</strong> </td>
                                <td width="80%"> <?= $m['placeOfBirth'] ?> </td>
                            </tr>


                            <tr>
                                <td width="20%"> <strong>Language Spoken</strong> </td>
                                <td width="80%"> <?= $m['languageSpoken'] ?> </td>
                            </tr>


                            <tr>
                                <td width="20%"> <strong>Height (Ft.)</strong> </td>
                                <td width="80%"> <?= $m['height'] ?> </td>
                            </tr>

                            <tr>
                                <td width="20%"> <strong>Weight (Kg.)</strong> </td>
                                <td width="80%"> <?= $m['weight'] ?> </td>
                            </tr>

                            <tr>
                                <td width="20%"> <strong>Blood Type</strong> </td>
                                <td width="80%"> <?= $m['bloodType'] ?> </td>
                            </tr>


                            <tr>
                                <td width="20%"> <strong>SSS No.</strong> </td>
                                <td width="80%"><?= $m['sssNo'] ?> </td>
                            </tr>

                            <tr>
                                <td width="20%"> <strong>GSIS No.</strong> </td>
                                <td width="80%"><?= $m['gsisIdNo'] ?>  </td>
                            </tr>

                            <tr>
                                <td width="20%"> <strong>PHIC No.</strong> </td>
                                <td width="80%"> <?= $m['philHealthNo'] ?>  </td>
                            </tr>

                            <tr>
                                <td width="20%"> <strong>PAG-IBIG No.</strong> </td>
                                <td width="80%"> <?= $m['pagIbigNo'] ?>  </td>
                            </tr>

                            <tr>
                                <td width="20%"> <strong>TAX No.</strong> </td>
                                <td width="80%"> <?= $m['tin'] ?>  </td>
                            </tr>

                            <tr>
                                <td width="20%"> <strong>Senior C. ID</strong> </td>
                                <td width="80%"> <?= $m['seniorCitezenNo'] ?>  </td>
                            </tr>

                            <tr>
                                <td width="20%"> <strong>Driver's License No.</strong> </td>
                                <td width="80%"> <?= $m['driversLicenseNo'] ?>  </td>
                            </tr>

                            <tr>
                                <td width="20%"> <strong>PRC License No.</strong> </td>
                                <td width="80%"> <?= $m['prcLicenceNo'] ?>  </td>
                            </tr>

                            <tr>
                                <td colspan="2" style="text-align: center;"> <strong>PERMANENT ADRESS</strong> </td>
                            </tr>

                            <tr>
                                <td width="20%"> <strong>Address</strong> </td>
                                <td width="80%"> <?= $m['permanentAddress'] ?>  </td>
                            </tr>

                            <tr>
                                <td width="20%"> <strong>Zip Code</strong> </td>
                                <td width="80%"> <?= $m['permanentZip'] ?> </td>
                            </tr>

                            <tr>
                                <td colspan="2" style="text-align: center;"> <strong>PREVIOUS ADDRESS</strong> </td>
                            </tr>

                            <tr>
                                <td width="20%"> <strong>Address</strong> </td>
                                <td width="80%"> <?= $m['formerAddress'] ?> </td>
                            </tr>

                            <tr>
                                <td width="20%"> <strong>Zip Code</strong> </td>
                                <td width="80%"> <?= $m['formerZip'] ?> </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Family Background Tab -->
<div class="tab-pane" id="familybackground">

<div class="row">
<div class="col-sm-12">
<div class="portlet light">
<div class="portlet-title">
    <div class="caption">
        <i class="icon-users font-blue"></i>
                                                 <span class="caption-subject bold font-purple-plum uppercase">
                                                    Family Background
                                                 </span>
    </div>

</div>
<div class="portlet-body">

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">

<tbody>

<tr>
    <td colspan="2"> <strong>FATHER'S INFORMATION</strong> </td>

</tr>

<tr>
    <td width="20%"> <strong>Lastname</strong> </td>
    <td width="80%"> <?= $m['fathersLastName'] ?> </td>
</tr>

<tr>
    <td width="20%"> <strong>Firstname</strong> </td>
    <td width="80%"> <?= $m['fathersFirstName'] ?> </td>
</tr>

<tr>
    <td width="20%"> <strong>Middlename</strong> </td>
    <td width="80%"> <?= $m['fathersMiddleName'] ?> </td>
</tr>


<tr>
    <td width="20%"> <strong>Kingdom Status</strong> </td>
    <td width="80%"> <?= ($m['fathersKingdomStatus']!=0)?$arrcategory[$m['fathersKingdomStatus']]:"" ?> </td>
</tr>

<tr>
    <td width="20%"> <strong>Contact No.</strong> </td>
    <td width="80%"> <?= $m['fathersPhone'] ?> </td>
</tr>

<tr>
    <td width="20%"> <strong>Occupation</strong> </td>
    <td width="80%"> <?= $m['fathersOccupation'] ?> </td>
</tr>
<tr>
    <td width="20%"> <strong>Address</strong> </td>
    <td width="80%"> <?= $m['fathersAddress'] ?> </td>
</tr>


<tr>
    <td colspan="2"> <strong>MOTHER'S INFORMATION</strong> </td>

</tr>

<tr>
    <td width="20%"> <strong>Lastname</strong> </td>
    <td width="80%"> <?= $m['mothersLastName'] ?> </td>
</tr>

<tr>
    <td width="20%"> <strong>Firstname</strong> </td>
    <td width="80%"> <?= $m['mothersFirstName'] ?> </td>
</tr>

<tr>
    <td width="20%"> <strong>Middlename</strong> </td>
    <td width="80%"> <?= $m['mothersMiddleName'] ?> </td>
</tr>


<tr>
    <td width="20%"> <strong>Kingdom Status</strong> </td>
    <td width="80%"> <?= ($m['mothersKingdomStatus'] != 0)?$arrcategory[$m['mothersKingdomStatus']]:"" ?> </td>
</tr>

<tr>
    <td width="20%"> <strong>Contact No.</strong> </td>
    <td width="80%"> <?= $m['mothersPhone'] ?> </td>
</tr>

<tr>
    <td width="20%"> <strong>Occupation</strong> </td>
    <td width="80%"> <?= $m['mothersOccupation'] ?> </td>
</tr>
<tr>
    <td width="20%"> <strong>Address</strong> </td>
    <td width="80%"> <?= $m['mothersAddress'] ?> </td>
</tr>

<tr>
    <td colspan="2"> <strong>SPOUSE INFORMATION</strong> </td>
</tr>

<tr>
    <td width="20%"> <strong>Lastname</strong> </td>
    <td width="80%"> <?= $m['spouseLastName'] ?> </td>
</tr>

<tr>
    <td width="20%"> <strong>Firstname</strong> </td>
    <td width="80%"> <?= $m['spouseFirstName'] ?> </td>
</tr>

<tr>
    <td width="20%"> <strong>Middlename</strong> </td>
    <td width="80%"> <?= $m['spouseMiddleName'] ?> </td>
</tr>


<tr>
    <td width="20%"> <strong>Kingdom Status</strong> </td>
    <td width="80%"> <?= ($m['spouseKingdomStatus'] != 0)?$arrcategory[$m['spouseKingdomStatus']]:"" ?> </td>
</tr>

<tr>
    <td width="20%"> <strong>Contact No.</strong> </td>
    <td width="80%"> <?= $m['spousePhone'] ?> </td>
</tr>

<tr>
    <td width="20%"> <strong>Occupation</strong> </td>
    <td width="80%"> <?= $m['spouseOccupation'] ?> </td>
</tr>
<tr>
    <td width="20%"> <strong>Address</strong> </td>
    <td width="80%"> <?= $m['spouseAddress'] ?> </td>
</tr>

<tr>
    <td colspan="2" style="text-align: center;"> <strong>SIBLINGS</strong> </td>
</tr>

<tr>
    <td colspan="2">
        <table class="table table-striped table-bordered table-hover">

            <tbody>
            <tr>
                <td><strong>Lastname</strong></td>
                <td><strong>Firstname</strong></td>
                <td><strong>Middlename</strong></td>
                <td><strong>Occupation</strong></td>
                <td><strong>Kingdom Status</strong></td>
            </tr>

            <?php
            if(count($siblings) > 0)
            {
                foreach($siblings as $sib)
                {
                    ?>
                    <tr>
                        <td><?= $sib->lastName ?></td>
                        <td><?= $sib->firstName ?></td>
                        <td><?= $sib->middleName ?></td>
                        <td><?= $sib->occupation ?></td>
                        <td><?= $arrcategory[$sib->memberClass] ?></td>

                    </tr>
                <?php
                }
            }
            else
            {
                ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No Siblings Recorded.</td>
                </tr>
            <?php
            }
            ?>

            </tbody>
        </table>
    </td>

</tr>

<tr>
    <td colspan="2" style="text-align: center;"> <strong>CHILDREN</strong> </td>
</tr>

<tr>
    <td colspan="2">
        <table class="table table-striped table-bordered table-hover">

            <tbody>
            <tr>
                <td><strong>Lastname</strong></td>
                <td><strong>Firstname</strong></td>
                <td><strong>Middlename</strong></td>
                <td><strong>Occupation</strong></td>
                <td><strong>Kingdom Status</strong></td>
            </tr>

            <?php
            if(count($children) > 0)
            {
                foreach($children as $kid)
                {
                    ?>
                    <tr>
                        <td><?= $kid->lastName ?></td>
                        <td><?= $kid->firstName ?></td>
                        <td><?= $kid->middleName ?></td>
                        <td><?= $kid->occupation ?></td>
                        <td><?= $arrcategory[$kid->memberClass] ?></td>

                    </tr>
                <?php
                }
            }
            else
            {
                ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No Children Recorded.</td>
                </tr>
            <?php
            }
            ?>

            </tbody>
        </table>
    </td>

</tr>

</tbody>
</table>
</div>

</div>
</div>
</div>
</div>

</div>
<!-- end of Family Background Tab -->

<!-- Spiritual and Ministerial History Tab -->
<div class="tab-pane" id="spiritualandministry">

<div class="row">
<div class="col-sm-12">
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-trophy font-blue"></i>
                                                    <span class="caption-subject bold font-purple-plum uppercase">
                                                        Spiritual and Ministerial History
                                                    </span>
        </div>
    </div>
    <div class="portlet-body">

        <table class="table table-striped table-bordered table-hover">

            <tbody>
            <tr>
                <td colspan="2" style="text-align: center;"> <strong>WATER BAPTISM</strong> </td>
            </tr>

            <tr>
                <td width="20%"> <strong>Date Baptized</strong> </td>
                <td width="80%">  </td>
            </tr>

            <tr>
                <td width="20%"> <strong>Place of Baptism</strong> </td>
                <td width="80%">  </td>
            </tr>

            <tr>
                <td width="20%"> <strong>Presiding Minister</strong> </td>
                <td width="80%">  </td>
            </tr>

            <tr>
                <td width="20%"> <strong>How Member was Converted?</strong> </td>
                <td width="80%">  </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align: center;"> <strong>RE - BAPTISM</strong> </td>
            </tr>

            <tr>
                <td width="20%"> <strong>Date Baptized</strong> </td>
                <td width="80%">  </td>
            </tr>

            <tr>
                <td width="20%"> <strong>Place of Baptism</strong> </td>
                <td width="80%">  </td>
            </tr>

            <tr>
                <td width="20%"> <strong>Presiding Minister</strong> </td>
                <td width="80%">  </td>
            </tr>
            <tr>
                <td width="20%"> <strong>Reason For Re-Baptism</strong> </td>
                <td width="80%">  </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align: center;"> <strong>KINGDOM EVENTS ATTENDED</strong> </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align: center;">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <td><strong>MOB</strong></td>
                            <td><strong>IYC</strong></td>
                            <td><strong>IKLC</strong></td>
                            <td><strong>IKLC Seminars</strong></td>
                            <td><strong>TRIBUTE</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>


            <tr>
                <td colspan="2" style="text-align: center;"> <strong>TRAININGS AND SEMINARS ATTENDED</strong> </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align: center;">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <td><strong>Date Attended</strong></td>
                            <td><strong>Name of the Seminar</strong></td>
                            <td><strong>Description</strong></td>
                            <td><strong>Remarks</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align: center;"> <strong><i class="fa fa-trophy"></i> SOUL WINNING</strong>
                    <br/>Records of Converted Members </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align: center;">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <td><strong>#</strong></td>
                            <td><strong>Complete Name</strong></td>
                            <td><strong>Member Class</strong></td>
                            <td><strong>Date Baptized</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align: center;"> <strong>MINISTERIAL HISTORY</strong> </td>
            </tr>

            <tr>
                <td colspan="2"> <strong>Part - Time Ministry</strong> </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <td><strong>Base KLC</strong></td>
                            <td><strong>Ministry</strong></td>
                            <td><strong>Section</strong></td>
                            <td><strong>Department</strong></td>
                            <td><strong>From</strong></td>
                            <td><strong>To</strong></td>
                            <td><strong>Reporting To(Area Leader)</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2"> <strong>Full - Time Ministry</strong> </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align: center;">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <td><strong>Base KLC</strong></td>
                            <td><strong>Ministry</strong></td>
                            <td><strong>Section</strong></td>
                            <td><strong>Department</strong></td>
                            <td><strong>From</strong></td>
                            <td><strong>To</strong></td>
                            <td><strong>Reporting To(Area Leader)</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>

            </tbody>
        </table>

    </div>
</div>
</div>
</div>

</div>
<!-- end of Spiritual and Ministerial History Tab -->

<!-- Educational Background and Work Exp. Tab -->
<div class="tab-pane" id="educationalbackground">

<div class="row">
<div class="col-sm-12">
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-graduation font-blue"></i>
                                                    <span class="caption-subject bold font-purple-plum uppercase">
                                                        Educational Background
                                                    </span>
        </div>
    </div>
    <div class="portlet-body">

        <table class="table table-striped table-bordered table-hover">
            <tbody>
            <tr>
                <td colspan="2" style="text-align: center;"> <strong>ELEMENTARY</strong> </td>
            </tr>
            <tr>
                <td width="20%"> <strong>School Name</strong> </td>
                <td width="80%"> <?= $m['elemNameOfSchool'] ?> </td>
            </tr>
            <tr>
                <td width="20%"> <strong>From</strong> </td>
                <td width="80%">
                    <?php $elemInclusiveDatesOfAttendanceFrom = $m['elemInclusiveDatesOfAttendanceFrom'] ; $newDate = date("M d, Y", strtotime($elemInclusiveDatesOfAttendanceFrom));   if($newDate != "Jan 01, 1970"){ echo $newDate; } ?>
                </td>

            </tr>
            <tr>
                <td width="20%"> <strong>To</strong> </td>
                <td width="80%">
                    <?php $elemInclusiveDatesOfAttendanceTo = $m['elemInclusiveDatesOfAttendanceTo'] ; $newDate = date("M d, Y", strtotime($elemInclusiveDatesOfAttendanceTo));   if($newDate != "Jan 01, 1970"){ echo $newDate; } ?>
                </td>
            </tr>
            <tr>
                <td width="20%"> <strong>Remarks</strong> </td>
                <td width="80%"><?= ($m['elementarygraduate'] == 1)?"Graduated":"" ?>  </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align: center;"> <strong>HIGHSCHOOL</strong> </td>
            </tr>
            <tr>
                <td width="20%"> <strong>School Name</strong> </td>
                <td width="80%"> <?= $m['secNameOfSchool'] ?> </td>
            </tr>
            <tr>
                <td width="20%"> <strong>From</strong> </td>
                <td width="80%">
                    <?php $secInclusiveDatesOfAttendanceFrom = $m['secInclusiveDatesOfAttendanceFrom'] ; $newDate = date("M d, Y", strtotime($secInclusiveDatesOfAttendanceFrom));   if($newDate != "Jan 01, 1970"){ echo $newDate; } ?>
                </td>

            </tr>
            <tr>
                <td width="20%"> <strong>To</strong> </td>
                <td width="80%">
                    <?php $secInclusiveDatesOfAttendanceTo = $m['secInclusiveDatesOfAttendanceTo'] ; $newDate = date("M d, Y", strtotime($secInclusiveDatesOfAttendanceTo));   if($newDate != "Jan 01, 1970"){ echo $newDate; } ?>
                </td>
            </tr>
            <tr>
            <tr>
                <td width="20%"> <strong>Remarks</strong> </td>
                <td width="80%"><?= ($m['highschoolgraduate'] == 1)?"Graduated":"" ?>  </td>
            </tr>
            </tr>

            <tr>
                <td colspan="2" style="text-align: center;"> <strong>VOCATIONAL</strong> </td>
            </tr>
            <tr>
                <td width="20%"> <strong>School Name</strong> </td>
                <td width="80%"> <?= $m['vocNameOfSchool'] ?> </td>
            </tr>
            <tr>
                <td width="20%"> <strong>Course</strong> </td>
                <td width="80%"> <?= $m['vocCourse'] ?> </td>
            </tr>
            <tr>
                <td width="20%"> <strong>From</strong> </td>
                <td width="80%">
                    <?php $vocInclusiveDatesOfAttendanceFrom = $m['vocInclusiveDatesOfAttendanceFrom'] ; $newDate = date("M d, Y", strtotime($vocInclusiveDatesOfAttendanceFrom));   if($newDate != "Jan 01, 1970"){ echo $newDate; } ?>
                </td>

            </tr>
            <tr>
                <td width="20%"> <strong>To</strong> </td>
                <td width="80%">
                    <?php $vocInclusiveDatesOfAttendanceTo = $m['vocInclusiveDatesOfAttendanceTo'] ; $newDate = date("M d, Y", strtotime($vocInclusiveDatesOfAttendanceTo));   if($newDate != "Jan 01, 1970"){ echo $newDate; } ?>
                </td>
            </tr>
            <tr>
                <td width="20%"> <strong>Units Completed</strong> </td>
                <td width="80%">  </td>
            </tr>
            <tr>
                <td width="20%"> <strong>Remarks</strong> </td>
                <td width="80%"><?= ($m['vocationalgraduate'] == 1)?"Graduated":"" ?>  </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align: center;"> <strong>COLLEGE</strong> </td>
            </tr>
            <tr>
                <td width="20%"> <strong>School Name</strong> </td>
                <td width="80%"> <?= $m['collNameOfSchool'] ?> </td>
            </tr>
            <tr>
                <td width="20%"> <strong>Course</strong> </td>
                <td width="80%"> <?= $m['collCourse'] ?> </td>
            </tr>
            <tr>
                <td width="20%"> <strong>From</strong> </td>
                <td width="80%">
                    <?php $collInclusiveDatesOfAttendanceFrom = $m['collInclusiveDatesOfAttendanceFrom'] ; $newDate = date("M d, Y", strtotime($collInclusiveDatesOfAttendanceFrom));   if($newDate != "Jan 01, 1970"){ echo $newDate; } ?>
                </td>

            </tr>
            <tr>
                <td width="20%"> <strong>To</strong> </td>
                <td width="80%">
                    <?php $collInclusiveDatesOfAttendanceTo = $m['collInclusiveDatesOfAttendanceTo'] ; $newDate = date("M d, Y", strtotime($collInclusiveDatesOfAttendanceTo));   if($newDate != "Jan 01, 1970"){ echo $newDate; } ?>
                </td>
            </tr>
            <tr>
                <td width="20%"> <strong>Units Completed</strong> </td>
                <td width="80%">  </td>
            </tr>
            <tr>
                <td width="20%"> <strong>Remarks</strong> </td>
                <td width="80%"><?= ($m['collegegraduate'] == 1)?"Graduated":"" ?>  </td>
            </tr>


            <tr>
                <td colspan="2" style="text-align: center;"> <strong>MASTERAL</strong> </td>
            </tr>
            <tr>
                <td width="20%"> <strong>School Name</strong> </td>
                <td width="80%"> <?= $m['postNameOfSchool'] ?> </td>
            </tr>
            <tr>
                <td width="20%"> <strong>Course</strong> </td>
                <td width="80%"> <?= $m['postCourse'] ?> </td>
            </tr>
            <tr>
                <td width="20%"> <strong>From</strong> </td>
                <td width="80%">
                    <?php $postInclusiveDatesOfAttendanceFrom = $m['postInclusiveDatesOfAttendanceFrom'] ; $newDate = date("M d, Y", strtotime($postInclusiveDatesOfAttendanceFrom));   if($newDate != "Jan 01, 1970"){ echo $newDate; } ?>
                </td>

            </tr>
            <tr>
                <td width="20%"> <strong>To</strong> </td>
                <td width="80%">
                    <?php $postInclusiveDatesOfAttendanceTo = $m['postInclusiveDatesOfAttendanceTo'] ; $newDate = date("M d, Y", strtotime($postInclusiveDatesOfAttendanceTo));   if($newDate != "Jan 01, 1970"){ echo $newDate; } ?>
                </td>
            </tr>
            <tr>
                <td width="20%"> <strong>Units Completed</strong> </td>
                <td width="80%">  </td>
            </tr>
            <tr>
                <td width="20%"> <strong>Remarks</strong> </td>
                <td width="80%"><?= ($m['masteralgraduate'] == 1)?"Graduated":"" ?>  </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align: center;"> <strong>DOCTORAL</strong> </td>
            </tr>
            <tr>
                <td width="20%"> <strong>School Name</strong> </td>
                <td width="80%"> <?= $m['doctorateNameOfSchool'] ?> </td>
            </tr>
            <tr>
                <td width="20%"> <strong>Course</strong> </td>
                <td width="80%"> <?= $m['doctorateCourse'] ?> </td>
            </tr>
            <tr>
                <td width="20%"> <strong>From</strong> </td>
                <td width="80%">
                    <?php $doctorateInclusiveDatesOfAttendanceFrom = $m['doctorateInclusiveDatesOfAttendanceFrom'] ; $newDate = date("M d, Y", strtotime($doctorateInclusiveDatesOfAttendanceFrom));   if($newDate != "Jan 01, 1970"){ echo $newDate; } ?>
                </td>

            </tr>
            <tr>
                <td width="20%"> <strong>To</strong> </td>
                <td width="80%">
                    <?php $doctorateInclusiveDatesOfAttendanceTo = $m['doctorateInclusiveDatesOfAttendanceTo'] ; $newDate = date("M d, Y", strtotime($doctorateInclusiveDatesOfAttendanceTo));   if($newDate != "Jan 01, 1970"){ echo $newDate; } ?>
                </td>
            </tr>
            <tr>
                <td width="20%"> <strong>Units Completed</strong> </td>
                <td width="80%">  </td>
            </tr>
            <tr>
                <td width="20%"> <strong>Remarks</strong> </td>
                <td width="80%"><?= ($m['doctoralgraduate'] == 1)?"Graduated":"" ?>  </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-briefcase font-blue"></i>
                        <span class="caption-subject bold font-purple-plum uppercase">
                           Industry Experiences
                        </span>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover">
                    <tbody>
                    <tr>
                        <td><strong>Job Title</strong></td>
                        <td><strong>Company</strong></td>
                        <td><strong>Address</strong></td>
                        <td><strong>From</strong></td>
                        <td><strong>To</strong></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>
<!-- end of Educational Background and Work Exp. Tab -->

<!-- Travel History Tab -->
<div class="tab-pane" id="travelhistory">
    <div class="row">
        <div class="col-sm-12">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-plane font-blue"></i>
                                                    <span class="caption-subject bold font-purple-plum uppercase">
                                                       Travel History
                                                    </span>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover">
                        <tbody>
                        <tr>
                            <td colspan="2" style="text-align: center;"> <strong>PASSPORT AND VISA</strong> </td>
                        </tr>
                        <?php
                        if(!empty($m['passportNo']))
                        {

                            ?>

                            <tr>
                                <td width="20%"> <strong>Passport ID No.</strong> </td>
                                <td width="80%"> <?= $m['passportNo'] ?>  </td>
                            </tr>

                            <tr>
                                <td width="20%"> <strong>Date Issued</strong> </td>
                                <td width="80%">
                                    <?php $passportDateIssued = $m['passportDateIssued']; $newDate = date("M d, Y", strtotime($passportDateIssued));   if($newDate != "Jan 01, 1970"){ echo $newDate; } ?>
                                </td>
                            </tr>

                            <tr>
                                <td width="20%"> <strong>Expiration Date</strong> </td>
                                <td width="80%">
                                    <?php $passportExpiryDate = $m['passportExpiryDate']; $newDate = date("M d, Y", strtotime($passportExpiryDate));   if($newDate != "Jan 01, 1970"){ echo $newDate; } ?>
                            </tr>

                            <tr>
                                <td width="20%"> <strong>Type of Visa</strong> </td>
                                <td width="80%">  </td>
                            </tr>

                            <tr>
                                <td width="20%"> <strong>Date Granted</strong> </td>
                                <td width="80%">  </td>
                            </tr>


                            <tr>
                                <td width="20%"> <strong>Valid Until</strong> </td>
                                <td width="80%">  </td>
                            </tr>

                        <?php
                        }
                        else
                        {
                            ?>
                            <tr>
                                <td colspan="2" style="text-align: center;">No Passport Recorded.</td>
                            </tr>
                        <?php
                        }
                        ?>

                        <tr>
                            <td colspan="2" style="text-align: center;"><strong><i class="fa fa-plane"></i> TRAVEL HISTORY</strong> </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <table class="table table-striped table-bordered table-hover">
                                    <tbody>
                                    <tr>
                                        <td><strong>From</strong></td>
                                        <td><strong>To</strong></td>
                                        <td><strong>Country</strong></td>
                                        <td><strong>Purpose</strong></td>
                                    </tr>

                                    <?php
                                    if(count($travels) > 0)
                                    {
                                        foreach($travels as $trv)
                                        {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php $datetravelfrom = $trv->dateFrom ; $newDate = date("M d, Y", strtotime($datetravelfrom));   if($newDate != "Jan 01, 1970"){ echo $newDate; } ?>
                                                </td>
                                                <td>
                                                    <?php $dateTravelTo = $trv->dateTo ; $newDate = date("M d, Y", strtotime($dateTravelTo));   if($newDate != "Jan 01, 1970"){ echo $newDate; } ?>
                                                </td>
                                                <td><?= $trv->country ?></td>
                                                <td><?= $trv->purpose ?></td>
                                            </tr>
                                        <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <tr>
                                            <td colspan="4" style="text-align: center;" > No Travel History Recorded.</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                    </tbody>
                                </table>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- end of Travel History Tab -->

<div class="tab-pane" id="otherinfo">Under Construction...</div>
</div>

</div>

</div>
</div>

<hr/>




<div class="row">


</div>

</div>
<!-- END CONTENT -->
</div>
