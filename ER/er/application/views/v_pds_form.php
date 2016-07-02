<?php
$arrcategory = array();
$arrklc = array();
$arrdept = array();
$arrmemstat = array();
$arrministry = array();

foreach($membercategory as $cat)
{
    $arrcategory += array(
        0 => 'Not Specified Please Update!!',
    );
    $arrcategory += array(
        $cat->ndex => $cat->classification
    );
}

foreach($klcs as $k)
{
    $arrklc += array(
        0 => 'Not Specified Please Update!!',
    );
    $arrklc += array(
        $k->ndex => $k->klcName
    );
}

foreach($ministries as $mins)
{
    $arrministry += array(
        0 => 'Not Specified Please Update!!',
    );
    $arrministry += array(
        $mins->ndex => $mins->ministryname
    );
}

foreach($memstatus as $stat)
{
    $arrmemstat += array(
        0 => 'Not Specified Please Update!!',
    );
    $arrmemstat += array(
        $stat->ndex => $stat->statusname,
    );
}

foreach($depts as $d)
{
    $arrdept += array(
        0 => 'Not Specified Please Update!!',
    );

    $arrdept += array(
        $d->id => $d->departmentname
    );
}

$arrmonth = array(

    '1' => 'JANUARY',
    '2' => 'FEBRUARY',
    '3' => 'MARCH',
    '4' => 'APRIL',
    '5' => 'MAY',
    '6' => 'JUNE',
    '7' => 'JULY',
    '8' => 'AUGUST',
    '9' => 'SEPTEMBER',
    '10' => 'OCTOBER',
    '11' => 'NOVEMBER',
    '12' => 'DECEMBER',
    '0' => '-',
);
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
    <!-- Basic View of Profile -->
    <div class="row">
        <div class="col-md-3">
            <ul class="list-unstyled profile-nav">
                <li>
                    <?php
                        if(!empty($m['photoFileName']))
                        {
                    ?>
                            <img src="<?= base_url().'/uploads/'.$m['ndex'].'/'.$m['photoFileName']?>" class="img-responsive" alt=""/>
                    <?php
                        } else {
                    ?>
                            <img src="<?= base_url() ?>assets/admin/pages/media/profile/blank-profile.jpeg" class="img-responsive" alt=""/>
                    <?php
                        }
                    ?>

                    <!--<img src="<?php//"http://kjcmis.kojc.net/uploads/".$m['ndex']."/".$m['photoFileName'] ?>" class="img-responsive" alt=""/>
                    <!-- <a href="#" class="profile-edit">edit </a>-->
                </li>
            </ul>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-8 profile-info">
                    <h1><?= ucfirst(strtolower($m['firstName'])). " ". ucfirst(strtolower($m['middleName'])). " ". ucfirst(strtolower($m['lastName'])) ?></h1>
                    <p>
                        <i class="fa fa-map-marker"></i>
                        <a href="" class=" popovers" data-container="body" data-original-title="KLC of
                            <?php
                           try{
                               if(array_key_exists($m['klc'],$arrklc))
                               {
                                   echo ucfirst(strtolower($arrklc[$m['klc']]));
                               }
                               else
                               {
                                   echo '[unable to load KLC. ]';
                               }

                           }
                           catch(Exception $e)
                           {
                               echo 'unable to load KLC. Pls update this record.';
                           }

                           ?>">KLC of

                            <?php
                            try{
                                if(array_key_exists($m['klc'],$arrklc))
                                {
                                    echo ucfirst(strtolower($arrklc[$m['klc']]));
                                }
                                else
                                {
                                    echo '[Unable to load KLC.]';
                                }

                            }
                            catch(Exception $e)
                            {
                                echo 'unable to load KLC. Pls update this record.';
                            }
                            ?> </a><br/>
                        <i class="fa fa-qrcode"></i> Centralized ID: <?= $m['misid'] ?> <br/>
                        <i class="fa fa-star"></i> <?= $arrcategory[$m['memberClass']] . " " ?>
                        <?php
                            // get no. of service for ftmw
                            if($m['memberClass'] == 1){
                            if(date('Y', strtotime($m['dateEnteredFullTimeMinistry'])) != "-0001") {
                                //$yos =  date('Y') - date('Y', strtotime($m['dateEnteredFullTimeMinistry']));
                                $datetime1 = new DateTime($m['dateEnteredFullTimeMinistry']);
                                $datetime2 = new DateTime(date('Y-m-d'));
                                $interval = $datetime1->diff($datetime2);
                                echo '<small>(' . $interval->format('%y year/s %m month/s ') .' in service)</small>';
                                //  echo " (" . $yos . " year/s in service) ";
                            }
                            else
                            {
                                echo " ";
                            }
                        }

                        if($m['memberClass'] == 2){
                            if(date('Y', strtotime($m['dateEnteredPartTimeMinistry'])) != "-0001") {
                                //$yos =  date('Y') - date('Y', strtotime($m['dateEnteredFullTimeMinistry']));
                                $datetime1 = new DateTime($m['dateEnteredPartTimeMinistry']);
                                $datetime2 = new DateTime(date('Y-m-d'));
                                $interval = $datetime1->diff($datetime2);
                                echo '<small>(' . $interval->format('%y year/s %m month/s ') .' in service)</small>';
                                //  echo " (" . $yos . " year/s in service) ";
                            }
                            else
                            {
                                echo " ";
                            }
                        }
                        ?>

                        <?= ($m['memberStatus'] != 0)?" (" . $arrmemstat[$m['memberStatus']] . ")":"" ?>  <br/>

                        <i class="fa fa-male"></i> <?= $m['gender'] ?> - ( <?= $m['civilStatus'] ?> ) <br/>
                        <i class="fa fa-calendar"></i> Birthday: <?php if($m['dateOfBirth'] == "0000-00-00"){ echo " "; } else { $originalDate = $m['dateOfBirth']; $newDate = date("M d, Y", strtotime($originalDate));  echo $newDate; } ?>
                        <?php
                            if(date('Y', strtotime($m['dateOfBirth'])) != "-0001") {
                                $datetime1 = new DateTime($m['dateOfBirth']);
                                $datetime2 = new DateTime(date('Y-m-d'));
                                $interval = $datetime1->diff($datetime2);
                                echo '<small>(' . $interval->format('%y y/o') .')</small>';
                            }
                        ?>
                            <br/>
                        <i class="fa fa-calendar"></i> Date Baptized: <?php if($m['waterBaptismDate'] == "0000-00-00") { echo " "; } else { $originalDate = $m['waterBaptismDate']; $newDate = date("M d, Y", strtotime($originalDate));  echo $newDate; } ?>  <br/>
                        <?php if($m['memberClass'] != 9 && $m['memberClass'] !=3 ) {?>
                            <i class="fa fa-briefcase"></i> Department: <?= $arrdept[$m['dept']] ?> | <i class="fa fa-lightbulb-o"></i> Ministry: <?= $arrministry[$m['ministry']] ?> <br/>
                        <?php } ?>

                        <i class="fa fa-phone"></i> Email: <a href="mailto:<?= $m['emailAddress'] ?>"><?= strtolower($m['emailAddress']) ?></a> | Contact No. : <?= $m['mobileNo'] ?>
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
                                    <span class="sale-num">

                                        <?php
                                        if($m['datecreated'] == "0000-00-00")
                                        {
                                            echo "-";
                                        }
                                        else
                                        {
                                            $source = $m['datecreated'];
                                            $date = new DateTime($source);
                                            echo '<br/>'.$date->format('m/d/Y h:i:s A');
                                        }

                                        ?>

                                    </span>
                                </li>
                                <li>
                                    <span class="sale-info">
                                        Date Last Updated: <i class="fa fa-img-down"></i>
                                    </span>
                                    <span class="sale-num">
                                         <?php
                                         if($m['dateupdated'] == "0000-00-00")
                                         {
                                             echo "-";
                                         }
                                         else{
                                             $source = $m['dateupdated'];
                                             $date = new DateTime($source);
                                             echo '<br/>'.$date->format('m/d/Y h:i:s A');
                                         }

                                         ?>
                                    </span>
                                </li>
                                <li>
                                    <span class="sale-info">
                                        Last Updated By: <i class="fa fa-img-down"></i>
                                    </span>
                                    <span class="sale-num">
                                         <?php
                                            echo $encoderinfo;
                                         ?>
                                    </span>
                                </li>
                                <li>
                                    <hr>
                                    <button id="btnviewhistory" class="btn btn-primary btn-small" data-toggle="modal" data-target="#viewversionhistory"> <small>View History </small></button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--end col-md-4-->
                <!--    history modal-->
                <div class="modal fade" id="viewversionhistory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class = "modal-header">
                                <h4>Version history</h4>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>DateTime</th>
                                        <th>Encoder</th>
                                        <th>Description</th>
                                    </thead>
                                    <tbody id="tblviewhistory">
                                        <tr>
                                            <td>test</td>
                                            <td>test</td>
                                            <td>test</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary btn-default" data-dismiss = "modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!--   end of  history modal-->
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

        <!-- Personal Information Tab -->

            <!-- Upload Picture Modal -->
            <div class="modal fade" id="uploadpicture" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <?php
                        $this->load->helper('form');
                        echo form_open_multipart("pds/profile/".$mem_id);
                        ?>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Upload A Profile Photo</h4>
                            </div>
                            <div class="modal-body" style="text-align: left;">

                                <strong>Please take note of the following when Uploading a Photo. </strong><br/>
                                <ul>
                                    <li>Photo must be lower than 1MB.</li>
                                    <li>Upload photo using JPG, JPEG or PNG Format Only.</li>
                                    <li>2x2 Picture.</li>
                                    <li>White Background.</li>
                                </ul>
                                <br/><br/>
                                <input type="hidden" name="ndex" value="<?= $m['ndex'] ?>"/>
                                <input type="file" name="userfile" size="20" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="btnuploadphoto" value="uploadphoto">Upload</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- end of upload picture .modal -->

            <div class="tab-pane active" id="personalinfo">
                <?= form_open_multipart("pds/updatepds/".$mem_id) ?>
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
                                    <div class="actions">

                                        <a class="btn btn-circle btn-primary" data-toggle="modal" data-target="#uploadpicture">
                                            <i class="fa fa-upload"></i> Change Photo
                                        </a>

                                    </div>

                                </div>
                                <div class="portlet-body">
                                    <div class="table-responsive">

                                        <?php
                                        if(isset($uploaderror))
                                        {
                                        ?>
                                            <div class="alert alert-warning alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                                <strong>Something went wrong while uploading the Photo</strong> <br/><?= $uploaderror ?>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <table class="table table-striped table-bordered table-hover">

                                            <tbody>
                                            <tr>
                                                <td width="20%"> <strong>Last Name</strong> </td>
                                                <td width="80%"> <input class="form-control input-medium" type="text" name="lastName" value="<?= $m['lastName'] ?>"/> </td>
                                            </tr>
                                            <tr>
                                                <td width="20%"> <strong>First Name</strong> </td>
                                                <td width="80%"> <input class="form-control input-medium" type="text" name="firstName" value="<?= $m['firstName'] ?>"/> </td>
                                            </tr>
                                            <tr>
                                                <td width="20%"> <strong>Middle Name</strong> </td>
                                                <td width="80%"> <input class="form-control input-medium" type="text" name="middleName" value="<?= $m['middleName'] ?>"/> </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Member Type</strong> </td>
                                                <td width="80%">
                                                    <select name="memberClass" id="" class="form-control input-large" required>
                                                        <option value="0"></option>
                                                        <option value="3"  <?= ($m['memberClass'] == 3)?"selected":'' ?>>MEMBER</option>
                                                        <option value="2" <?= ($m['memberClass'] == 2)?"selected":'' ?>>PTMW</option>
                                                        <option value="1" <?= ($m['memberClass'] == 1)?"selected":'' ?>>FTMW</option>
                                                        <option value="4" <?= ($m['memberClass'] == 4)?"selected":'' ?>>GOEF</option>
                                                        <option value="17" <?= ($m['memberClass'] == 17)?"selected":'' ?>>GOE</option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Status</strong> </td>
                                                <td width="80%"><select name="memberStatus" id="memberStatus" class="form-control input-medium">
                                                    <option value="0"  <?=($m['memberStatus'] == 0)?' selected':'' ?>>Please Select</option>
                                                    <?php
                                                        foreach($memstatus as $mstat)
                                                        {
                                                    ?>
                                                            <option value="<?= $mstat->ndex ?>" <?=($m['memberStatus'] == $mstat->ndex)?' selected':'' ?>> <?= $mstat->statusname ?> </option>
                                                    <?php
                                                        }
                                                    ?>
                                                    </select> </td>
                                            </tr>
                                            <tr>
                                                <td width="20%"> <strong>NickName</strong> </td>
                                                <td width="80%"> <input class="form-control input-medium" type="text" name="nickName" value="<?= $m['nickName'] ?>"/> </td>
                                            </tr>
                                            <tr>
                                                <td width="20%"> <strong>Gender</strong> </td>
                                                <td width="80%">
                                                    <select name="gender" id="gender" class="form-control input-small">
                                                        <option value="-">Please Select</option>
                                                        <option value="Male" <?= ($m['gender'] == "Male")?' selected':'' ?>> Male</option>
                                                        <option value="Female" <?= ($m['gender'] == "Female")?' selected':'' ?>> Female</option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Citizenship</strong> </td>
                                                <td width="80%">

                                                    <select name="citizenshipno" class="form-control input-medium" id="">


                                                        <option value="0"> </option>
                                                        <?php

                                                        foreach($citizenships as $ct)
                                                        {
                                                            ?>
                                                            <option value="<?= $ct->ndex ?>" <?=($m['citizenshipno'] == $ct->ndex)?'selected':''?> > <?= ucfirst($ct->citizenship) ?> </option>

                                                        <?php
                                                        }

                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Civil Status</strong> </td>
                                                <td width="80%">
                                                    <select name="civilStatus" id="" class="form-control input-medium" required>
                                                        <option value=""></option>
                                                        <option value="Single" <?= ($m['civilStatus'] == "Single")?'selected':''?>>Single</option>
                                                        <option value="Married" <?= ($m['civilStatus'] == "Married")?'selected':''?>>Married</option>
                                                        <option value="Single Parent" <?= ($m['civilStatus'] == "Single Parent")?'selected':''?>>Single Parent</option>
                                                        <option value="Annulled" <?= ($m['civilStatus'] == "Annulled")?'selected':''?>>Annulled</option>
                                                        <option value="Divorce" <?= ($m['civilStatus'] == "Divorce")?'selected':''?>>Divorce</option>
                                                        <option value="Separated" <?= ($m['civilStatus'] == "Female")?'selected':''?>>Separated</option>
                                                        <option value="Widowed" <?= ($m['civilStatus'] == "Widowed")?'selected':''?>>Widowed</option>

                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Email Address</strong> </td>
                                                <td width="80%">
                                                    <input type="email" class="form-control" name="emailAddress" value="<?= strtolower($m['emailAddress']) ?>"/>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Mobile No.</strong> </td>
                                                <td width="80%">
                                                    <input type="text" class="form-control" name="mobileNo" value="<?= $m['mobileNo'] ?>"/>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Birth Date</strong> </td>
                                                <td width="80%"> <input class="form-control form-control-inline input-small date-picker" type="text" name="dateOfBirth" value="<?php if($m['dateOfBirth'] == "0000-00-00"){ echo "-"; } else{ $originalDate = $m['dateOfBirth']; $newDate = date("m/d/Y", strtotime($originalDate));  echo $newDate; } ?>"/> </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Place of Birth</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="placeOfBirth" value="<?= $m['placeOfBirth'] ?>"/></td>
                                            </tr>


                                            <tr>
                                                <td width="20%"> <strong>Language Spoken</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="languageSpoken" value="<?= $m['languageSpoken'] ?>"/></td>
                                            </tr>


                                            <tr>
                                                <td width="20%"> <strong>Height (Ft.)</strong> </td>
                                                <td width="80%"> <input class="form-control  input-small" type="text" step="0.10"  name="height" value="<?= $m['height'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Weight (Kg.)</strong> </td>
                                                <td width="80%"> <input class="form-control input-small" type="text" step="0.10"  name="weight" value="<?= $m['weight'] ?>"/> </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Blood Type</strong> </td>
                                                <td width="80%">
                                                    <select name="bloodType" class="form-control input-small"  id="bloodType">
                                                        <option value="-" <?= ($m['bloodType'] == '-')?'selected':'' ?>> - </option>
                                                        <option value="O" <?= ($m['bloodType'] == 'O')?'selected':'' ?>>O</option>
                                                        <option value="O-" <?= ($m['bloodType'] == 'O-')?'selected':'' ?>>O-</option>
                                                        <option value="O+" <?= ($m['bloodType'] == 'O+')?'selected':'' ?>>O+</option>
                                                        <option value="A" <?= ($m['bloodType'] == 'A')?'selected':'' ?>>A</option>
                                                        <option value="A-" <?= ($m['bloodType'] == 'A-')?'selected':'' ?>>A-</option>
                                                        <option value="A+" <?= ($m['bloodType'] == 'A+')?'selected':'' ?>>A+</option>
                                                        <option value="B" <?= ($m['bloodType'] == 'B')?'selected':'' ?>>B</option>
                                                        <option value="B-" <?= ($m['bloodType'] == 'B-')?'selected':'' ?>>B-</option>
                                                        <option value="B+" <?= ($m['bloodType'] == 'B+')?'selected':'' ?>>B+</option>
                                                        <option value="AB" <?= ($m['bloodType'] == 'AB')?'selected':'' ?>>AB</option>
                                                        <option value="AB-" <?= ($m['bloodType'] == 'AB-')?'selected':'' ?>>AB-</option>
                                                        <option value="AB+" <?= ($m['bloodType'] == 'AB+')?'selected':'' ?>>AB+</option>
                                                    </select>
                                            </tr>


                                            <tr>
                                                <td width="20%"> <strong>SSS No.</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="sssNo" value="<?= $m['sssNo'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>GSIS No.</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="gsisIdNo" value="<?= $m['gsisIdNo'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>PHIC No.</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="philHealthNo" value="<?= $m['philHealthNo'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>PAG-IBIG No.</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="pagIbigNo" value="<?= $m['pagIbigNo'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>TAX No.</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="tin" value="<?= $m['tin'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Senior C. ID</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="seniorCitezenNo" value="<?= $m['seniorCitezenNo'] ?>"/> </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Driver's License No.</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="driversLicenseNo" value="<?= $m['driversLicenseNo'] ?>"/> </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>PRC License No.</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="prcLicenceNo" value="<?= $m['prcLicenceNo'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td colspan="2" style="text-align: center;"> <strong>PRESENT ADRESS</strong> </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Address</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="presentAddress" value="<?= $m['presentAddress'] ?>"/> </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Zip Code</strong> </td>
                                                <td width="80%"> <input class="form-control  input-small" type="text" name="presentZip" value="<?= $m['presentZip'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td colspan="2" style="text-align: center;"> <strong>PERMANENT ADRESS</strong> </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Address</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="permanentAddress" value="<?= $m['permanentAddress'] ?>"/> </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Zip Code</strong> </td>
                                                <td width="80%"> <input class="form-control  input-small" type="text" name="permanentZip" value="<?= $m['permanentZip'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td colspan="2" style="text-align: center;"> <strong>PREVIOUS ADDRESS</strong> </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Address</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="formerAddress" value="<?= $m['formerAddress'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Zip Code</strong> </td>
                                                <td width="80%"><input class="form-control input-small" type="text" name="formerZip" value="<?= $m['formerZip'] ?>"/> </td>
                                            </tr>

                                            </tbody>
                                        </table>

                                        <table class="table table-striped table-bordered table-hover">

                                            <tbody>
                                                <tr>
                                                    <td width="20%"> <strong>Origin KLC</strong> </td>
                                                    <td width="80%">
                                                        <select name="originklc" id="klc"  class="form-control">
                                                            <option value="0">PLEASE SELECT</option>
                                                            <?php
                                                            foreach($klcs as $k)
                                                            {
                                                                ?>
                                                                <option value="<?= $k->ndex ?>" <?= ($m['originklc'] == $k->ndex)?' selected':''?>> <?= $k->klcName ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="20%"> <strong>Current KLC</strong> </td>
                                                    <td width="80%">
                                                        <select name="klc" id="klc"  class="form-control">
                                                            <option value="0">PLEASE SELECT</option>
                                                            <?php
                                                             foreach($klcs as $k)
                                                             {
                                                             ?>
                                                                 <option value="<?= $k->ndex ?>" <?= ($m['klc'] == $k->ndex)?' selected':''?>> <?= $k->klcName ?></option>
                                                             <?php
                                                             }
                                                            ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="20%"> <strong>Department</strong> </td>
                                                    <td width="80%">
                                                        <select name="dept" id="dept"  class="form-control">
                                                            <option value="0">PLEASE SELECT</option>
                                                            <?php
                                                            foreach($depts as $d)
                                                            {
                                                                ?>
                                                                <option value="<?= $d->id ?>" <?= ($m['dept'] == $d->id)?' selected':''?>> <?= $d->departmentname ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="20%"> <strong>Primary Ministry</strong> </td>
                                                    <td width="80%">
                                                        <select name="ministry" id="ministry"  class="form-control">
                                                            <option value="0">PLEASE SELECT</option>
                                                            <?php
                                                            foreach($ministries as $mn)
                                                            {
                                                                ?>
                                                                <option value="<?= $mn->ndex ?>" <?= ($m['ministry'] == $mn->ndex)?' selected':''?>> <?= $mn->ministryname ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="20%"> <strong>Secondary Ministry</strong> </td>
                                                    <td width="80%">
                                                        <select name="addlministry" id="addlministry"  class="form-control">
                                                            <option value="0">PLEASE SELECT</option>
                                                            <?php
                                                            foreach($ministries as $mn)
                                                            {
                                                                ?>
                                                                <option value="<?= $mn->ndex ?>" <?= ($m['addlministry'] == $mn->ndex)?' selected':''?>> <?= $mn->ministryname ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="20%"> <strong>Ministry Description</strong> </td>
                                                    <td width="80%"><input class="form-control" type="text" name="ministrydescription" value="<?= $m['ministrydescription'] ?>"/> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <hr/>
                                <div style="text-align: right;">
                                    <input type="hidden" name="encodername" value="<?= $this->session->userdata('lastname') . ', ' . $this->session->userdata('firstname') ?>">
                                    <input type="hidden" name="recordndex" value="<?= $m['ndex'] ?>">
                                    <button class="btn btn-large btn-primary" name="btnUpdatePersonalInfo" value="UpdatePersonalInfo" type="submit"><span class="fa fa-floppy-o"></span> Update Personal Information</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


                <?php
                if(isset($uploaderror))
                {
                    ?>
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <strong>Something went wrong while uploading the document.</strong> <br/><?= $fileuploaderror ?>
                    </div>
                <?php
                }
                ?>

                <div class="col-md-12">
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-folder font-blue"></i>
                                             <span class="caption-subject bold font-purple-plum uppercase">
                                                Supporting Documents
                                             </span>
                            </div>
                            <div class="tools">
                                <a href="" class="collapse"></a>
                            </div>
                            <div class="actions">
                                <a href="" class="btn btn-circle btn-icon-only btn-default" data-target="#uploaddocument" data-toggle="modal">
                                    <i class="icon-cloud-upload"></i>
                                </a>
                            </div>

                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover">
                                <tr>
                                    <td><strong>#</strong></td>
                                    <td><strong>File Description</strong></td>
                                    <td><strong>Type</strong></td>
                                    <td><strong>UploadedBy</strong></td>
                                    <td><strong>Action</strong> </td>
                                </tr>
                                <tbody>

                                <?php
                                if(count($files) > 0)
                                {
                                    $ctr = 0;
                                    foreach ($files as $f)
                                    {
                                        $ctr++;
                                        ?>
                                        <tr>
                                            <td><?= $ctr ?></td>
                                            <td><?= $f->filedescription ?></td>
                                            <td><?= $f->ext ?></td>
                                            <td><?= $f->lastName . ', ' . $f->firstName . ' ' . $f->middleName ?></td>
                                            <td>
                                                <form method="POST" target="_blank" action="<?= base_url()."pds/documentactions"?>">
                                                    <input type="hidden" name="misid" value="<?=$m['misid']?>"/>
                                                    <input type="hidden" name="targetfile" value="<?=$f->ndex?>"/>
                                                    <button type="submit" class="btn btn-primary btn-circle" name="btndownloadfile" value="downloadfile"><span
                                                            class="fa fa-download"></span></button>
                                                    <button type="button" class="btn btn-danger btn-circle" data-target="#deletedocument<?= $f->ndex ?>" data-toggle="modal"><span
                                                            class="fa fa-trash-o"></span></button>
                                                </form>

                                                <!-- Upload document Modal -->
                                                <div class="modal fade" id="deletedocument<?= $f->ndex ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <?php
                                                            $this->load->helper('form');
                                                            echo form_open_multipart("pds/profile/".$mem_id);
                                                            ?>
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title" id="myModalLabel">Confirm Remove File</h4>
                                                            </div>
                                                            <div class="modal-body" style="text-align: left;">
                                                                <h4>Are you sure to remove this File?. Action Cannot be undone.</h4>
                                                                <p>FileDescription: <?= $f->filedescription ?></p>
                                                                <input type="hidden" name="misid" value="<?=$m['misid']?>"/>
                                                                <input type="hidden" name="targetfile" value="<?=$f->ndex?>"/>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger" name="btnremovefile" value="removefile"><span class="fa fa-trash"></span> Remove</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- end of upload document .modal -->
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <tr>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Upload document Modal -->
                <div class="modal fade" id="uploaddocument" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <?php
                            $this->load->helper('form');
                            echo form_open_multipart("pds/profile/".$mem_id);
                            ?>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Upload A File / Document</h4>
                            </div>
                            <div class="modal-body" style="text-align: left;">

                                <strong>File Requirements </strong>
                                <ul>
                                    <li>File must be lower than 2MB.</li>
                                    <li>Supported File Types
                                        <ul>
                                            <li>Pictures (JPEG, PNG)</li>
                                            <li>Documents (DOCS, XLS, PPT)</li>
                                        </ul>
                                    </li>
                                </ul>
                                <hr/>
                                <label for="">Description</label>
                                <input type="text" class="form-control" name="filedescription" required=""/>
                                <input type="hidden" name="ndex" value="<?= $m['ndex'] ?>"/>
                                <hr/>
                                <input type="file" name="userfile" size="20" class="form-control"/>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="btnuploaddocument" value="uploaddocument"><span class="fa fa-upload"></span> Upload</button>
                            </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- end of upload document .modal -->
            </div>

        <!-- end of Personal Information Tab -->

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
                                <?= form_open_multipart("pds/updatepds/".$mem_id) ?>
                                    <table class="table table-striped table-bordered table-hover">

                                        <tbody>

                                            <tr>
                                                <td colspan="2"> <strong>FATHER'S INFORMATION</strong> </td>
                                            </tr>


                                            <tr>
                                                <td width="20%"> <strong>Kingdom Membership</strong></td>
                                                <td width="80%">
                                                    <select name="fathersKingdomStatus" id="" class="form-control input-medium" required>
                                                        <option value="0"> Please Select </option>
                                                        <option value="9" <?= ($m['fathersKingdomStatus'] == 9)?"selected":'' ?>>NON-MEMBER</option>
                                                        <option value="3" <?= ($m['fathersKingdomStatus'] == 3)?"selected":'' ?>>MEMBER</option>
                                                        <option value="2" <?= ($m['fathersKingdomStatus'] == 2)?"selected":'' ?>>PTMW</option>
                                                        <option value="1" <?= ($m['fathersKingdomStatus'] == 1)?"selected":'' ?>>FTMW</option>s
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Lastname</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="fathersLastName" value="<?= $m['fathersLastName'] ?>"/> </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Firstname</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="fathersFirstName" value="<?= $m['fathersFirstName'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Middlename</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="fathersMiddleName" value="<?= $m['fathersMiddleName'] ?>"/> </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Birthday</strong> </td>
                                                <td width="80%"> <input id = "txtfathersBirthday" class="form-control inline input-medium date-picker" type="text"  name="fathersBirthday"  value="<?php if($m['fathersBirthday'] == '0000-00-00'){ echo ""; }else{ $originalDate = $m['fathersBirthday']; $newDate = date("m/d/Y", strtotime($originalDate));  echo $newDate;} ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Birth Place</strong> </td>
                                                <td width="80%"> <input id = "txtfathersBirthPlace" class="form-control" type="text"  name="fathersBirthPlace"  value="<?= $m['fathersBirthPlace']?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Citizenship</strong> </td>
                                                <td width="80%">

                                                    <select name="fathersCitizenship" class="form-control input-medium" id="">
                                                        <option value="0"> </option>
                                                        <?php

                                                        foreach($citizenships as $ct)
                                                        {
                                                            ?>
                                                            <option value="<?= $ct->ndex ?>" <?=($m['fathersCitizenship'] == $ct->ndex)?'selected':''?> > <?= ucfirst($ct->citizenship) ?> </option>
                                                        <?php
                                                        }

                                                        ?>
                                                    </select>

                                                </td>

                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Contact No.</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="fathersPhone" value="<?= $m['fathersPhone'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Occupation</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="fathersOccupation" value="<?= $m['fathersOccupation'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Address</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="fathersAddress" value="<?= $m['fathersAddress'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Deceased</strong> </td>
                                                <td width="80%">

                                                    <select name="fathersDeceased" id="fathersDeceased" class="form-control input-small  inline">
                                                        <option value="0" <?= ($m['fathersDeceased']==0)?" selected": " "?>>NO</option>
                                                        <option value="1" <?= ($m['fathersDeceased']==1)?" selected": " "?>>YES</option>
                                                    </select>
                                                    <input id="txtFatherDateDied" class="form-control inline input-medium date-picker" type="text" placeholder="date father died.." name="fathersDateDied" <?= ($m['fathersDeceased']== 0)?' disabled ':'' ?> value="<?php if($m['fathersDateDied'] == '0000-00-00'){ echo ""; }else{ $originalDate = $m['fathersDateDied']; $newDate = date("m/d/Y", strtotime($originalDate));  echo $newDate;} ?>"/>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="2"> <strong>MOTHER'S INFORMATION</strong> </td>

                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Kingdom Status</strong> </td>
                                                <td width="80%">
                                                    <select name="mothersKingdomStatus" id="" class="form-control input-medium" required>
                                                        <option value="0"> Please Select </option>
                                                        <option value="9"  <?= ($m['mothersKingdomStatus'] == 9)?"selected":'' ?>>NON-MEMBER</option>
                                                        <option value="3"  <?= ($m['mothersKingdomStatus'] == 3)?"selected":'' ?>>MEMBER</option>
                                                        <option value="2" <?= ($m['mothersKingdomStatus'] == 2)?"selected":'' ?>>PTMW</option>
                                                        <option value="1" <?= ($m['mothersKingdomStatus'] == 1)?"selected":'' ?>>FTMW</option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Lastname</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="mothersLastName" value="<?= $m['mothersLastName'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Firstname</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="mothersFirstName" value="<?= $m['mothersFirstName'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Middlename</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="mothersMiddleName" value="<?= $m['mothersMiddleName'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Birthday</strong> </td>
                                                <td width="80%"> <input id = "txtmothersBirthday" class="form-control inline input-medium date-picker" type="text"  name="mothersBirthday"  value="<?php if($m['mothersBirthday'] == '0000-00-00'){ echo ""; }else{ $originalDate = $m['mothersBirthday']; $newDate = date("m/d/Y", strtotime($originalDate));  echo $newDate;} ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Birth Place</strong> </td>
                                                <td width="80%"> <input id = "txtmothersBirthPlace" class="form-control" type="text"  name="mothersBirthPlace"  value="<?= $m['mothersBirthPlace']?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Citizenship</strong> </td>
                                                <td width="80%">

                                                    <select name="mothersCitizenship" class="form-control input-medium" id="">
                                                        <option value="0"> </option>
                                                        <?php

                                                        foreach($citizenships as $ct)
                                                        {
                                                            ?>
                                                            <option value="<?= $ct->ndex ?>" <?=($m['mothersCitizenship'] == $ct->ndex)?'selected':''?> > <?= ucfirst($ct->citizenship) ?> </option>
                                                        <?php
                                                        }

                                                        ?>
                                                    </select>

                                                </td>

                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Contact No.</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="mothersPhone" value="<?= $m['mothersPhone'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Occupation</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="mothersOccupation" value="<?= $m['mothersOccupation'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Address</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="mothersAddress" value="<?= $m['mothersAddress'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Deceased</strong> </td>
                                                <td width="80%">

                                                    <select name="mothersDeceased" id="mothersDeceased" class="form-control input-small  inline">
                                                        <option value="0" <?= ($m['mothersDeceased']==0)?" selected": " "?>>NO</option>
                                                        <option value="1" <?= ($m['mothersDeceased']==1)?" selected": " "?>>YES</option>
                                                    </select>
                                                    <input id = "txtMotherDateDied" class="form-control inline input-medium date-picker" type="text" placeholder="date mother died.." name="mothersDateDied" <?= ($m['mothersDeceased']== 0)?' disabled ':'' ?> value="<?php if($m['mothersDateDied'] == '0000-00-00'){ echo ""; }else{ $originalDate = $m['mothersDateDied']; $newDate = date("m/d/Y", strtotime($originalDate));  echo $newDate;} ?>"/>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="2"> <strong>SPOUSE INFORMATION</strong> </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Kingdom Status</strong> </td>
                                                <td width="80%">
                                                    <select name="spouseKingdomStatus" id="" class="form-control input-medium" required>
                                                        <option value="0"> Please Select </option>
                                                        <option value="9"  <?= ($m['spouseKingdomStatus'] == 9)?"selected":'' ?>>NON-MEMBER</option>
                                                        <option value="3"  <?= ($m['spouseKingdomStatus'] == 3)?"selected":'' ?>>MEMBER</option>
                                                        <option value="2" <?= ($m['spouseKingdomStatus'] == 2)?"selected":'' ?>>PTMW</option>
                                                        <option value="1" <?= ($m['spouseKingdomStatus'] == 1)?"selected":'' ?>>FTMW</option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Lastname</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="spouseLastName" value="<?= $m['spouseLastName'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Firstname</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="spouseFirstName" value="<?= $m['spouseFirstName'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Middlename</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="spouseMiddleName" value="<?= $m['spouseMiddleName'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Birthday</strong> </td>
                                                <td width="80%"> <input id = "txtspouseBirthday" class="form-control inline input-medium date-picker" type="text"  name="spouseBirthday"  value="<?php if($m['spouseBirthday'] == '0000-00-00'){ echo ""; }else{ $originalDate = $m['spouseBirthday']; $newDate = date("m/d/Y", strtotime($originalDate));  echo $newDate;} ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Birth Place</strong> </td>
                                                <td width="80%"> <input id = "txtspouseBirthPlace" class="form-control" type="text"  name="spouseBirthPlace"  value="<?= $m['spouseBirthPlace']?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Citizenship</strong> </td>
                                                <td width="80%">
                                                    <select name="spouseCitizenship" class="form-control input-medium" id="">
                                                        <option value="0"> </option>
                                                        <?php

                                                        foreach($citizenships as $ct)
                                                        {
                                                            ?>
                                                            <option value="<?= $ct->ndex ?>" <?=($m['spouseCitizenship'] == $ct->ndex)?'selected':''?> > <?= ucfirst($ct->citizenship) ?> </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>

                                                </td>

                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Contact No.</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="spousePhone" value="<?= $m['spousePhone'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Occupation</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="spouseOccupation" value="<?= $m['spouseOccupation'] ?>"/> </td>
                                            </tr>
                                            <tr>
                                                <td width="20%"> <strong>Address</strong> </td>
                                                <td width="80%"> <input class="form-control" type="text" name="spouseAddress" value="<?= $m['spouseAddress'] ?>"/></td>
                                            </tr>

                                            <tr>
                                                <td width="20%"> <strong>Deceased</strong> </td>
                                                <td width="80%">

                                                    <select name="spouseDeceased" id="spouseDeceased" class="form-control input-small  inline">
                                                        <option value="0" <?= ($m['spouseDeceased']==0)?" selected": " "?>>NO</option>
                                                        <option value="1" <?= ($m['spouseDeceased']==1)?" selected": " "?>>YES</option>
                                                    </select>
                                                    <input id="txtSpouseDateDied" class="form-control inline input-medium date-picker" type="text" placeholder="date spouse died.." name="spouseDateDied" <?= ($m['spouseDeceased']== 0)?' disabled ':'' ?> value="<?php if($m['spouseDateDied'] == '0000-00-00'){ echo ""; }else{ $originalDate = $m['spouseDateDied']; $newDate = date("m/d/Y", strtotime($originalDate));  echo $newDate;} ?>"/>
                                                </td>
                                            </tr>

                                            <tr>
                                                 <td colspan="2" style="text-align: right;">
                                                     <input type="hidden" name="encodername" value="<?= $this->session->userdata('lastname') . ', ' . $this->session->userdata('firstname') ?>">
                                                     <input type="hidden" name="recordndex" value="<?= $m['ndex'] ?>">
                                                     <button type="submit" class="btn btn-primary"  name="btnUpdateFamilyBackground" value="UpdateFamilyBackground">Save Family Background</button>
                                                 </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </form>

                                <hr/>

                                <div class="row">
                                    <div class="col-md-12 ">
                                        <!-- BEGIN Portlet PORTLET-->
                                        <div class="portlet box grey-silver">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-users"></i>Siblings
                                                </div>
                                                <div class="actions">

                                                    <a href="#addsibling" class="btn green" data-toggle="modal">
                                                        <i class="fa fa-plus"></i> Add </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <table width="100%">
                                                    <tbody>
                                                    <tr>
                                                        <td colspan="2">
                                                            <table class="table table-striped table-bordered table-hover">

                                                                <tbody>
                                                                <tr>
                                                                    <th>#</td>
                                                                    <th><strong>Full Name</strong></th>
                                                                    <th><strong>Gender</strong></th>
                                                                    <th><strong>Occupation</strong></th>
                                                                    <th><strong>Member Type</strong></th>
                                                                    <th><strong>Status</strong></th>
                                                                    <th><strong>Action</strong></th>
                                                                </tr>

                                                                <?php
                                                                $ctr = 1;
                                                                if(count($siblings) > 0)
                                                                {
                                                                    foreach($siblings as $sib)
                                                                    {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $ctr++ ?> </td>
                                                                            <td><?= $sib->lastName . ', ' . $sib->firstName . ' ' . $sib->middleName?></td>
                                                                            <td><?= $sib->gender ?></td>
                                                                            <td><?= $sib->occupation ?></td>
                                                                            <td><?= $arrcategory[$sib->memberClass] ?></td>
                                                                            <td><?= $arrmemstat[$sib->memberStatus] ?></td>
                                                                            <td>
                                                                                <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#updateSibling<?= $ctr ?>"><i class="fa fa-edit"></i></button>
                                                                                <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#confirmDeleteSibling<?= $ctr ?>"><i class="fa fa-trash-o"></i></button>

                                                                                <div class="modal fade bs-modal-lg" id="updateSibling<?= $ctr ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                                                    <div class="modal-dialog">
                                                                                        <?= form_open_multipart("pds/updatesibling/".$m['misid']) ?>
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                                                <h4 class="modal-title">Update Sibling</h4>
                                                                                            </div>
                                                                                            <div class="modal-body">

                                                                                                <label for="">Last Name</label>
                                                                                                <input type="text" class="form-control" name="lastName" value="<?= $sib->lastName ?>"/>

                                                                                                <label for="">First Name</label>
                                                                                                <input type="text" class="form-control" name="firstName" value="<?= $sib->firstName ?>"/>

                                                                                                <label for="">Middle Name</label>
                                                                                                <input type="text" class="form-control" name="middleName" value="<?= $sib->middleName ?>"/>

                                                                                                <label for="">Gender</label>
                                                                                                <select name="gender" id="sibsgender" class="form-control">
                                                                                                    <option value="Male" <?= ($sib->gender == "Male")?" selected":"" ?>>Male</option>
                                                                                                    <option value="Female" <?= ($sib->gender == "Female")?" selected":"" ?>>Female</option>
                                                                                                </select>

                                                                                                <label for="">Occupation</label>
                                                                                                <input type="text" class="form-control" name="occupation" value="<?= $sib->occupation ?>"/>

                                                                                                <label for="">Member Type</label>
                                                                                                <select name="memberClass" id="sibsmemberClass" class="form-control" required>
                                                                                                    <option value="0"> Please Select </option>
                                                                                                    <option value="9" <?= ($sib->memberClass == 9)?"selected":'' ?>>NON-MEMBER</option>
                                                                                                    <option value="3" <?= ($sib->memberClass == 3)?"selected":'' ?>>MEMBER</option>
                                                                                                    <option value="2" <?= ($sib->memberClass == 2)?"selected":'' ?>>PTMW</option>
                                                                                                    <option value="1" <?= ($sib->memberClass == 1)?"selected":'' ?>>FTMW</option>
                                                                                                </select>

                                                                                                <input type="hidden" name="siblingId" value="<?= $sib->ndex ?>"/>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <input type="hidden" name="encodername" value="<?= $this->session->userdata('lastname') . ', ' . $this->session->userdata('firstname') ?>">
                                                                                                <input type="hidden" name="recordndex" value="<?= $m['ndex'] ?>">

                                                                                                <button type="submit" class="btn btn-primary" name="btnupdateSibling" value="updateSibling">Update</button>
                                                                                                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- /.modal-content -->

                                                                                        </form>
                                                                                    </div>
                                                                                    <!-- /.modal-dialog -->
                                                                                </div>

                                                                                <div class="modal fade bs-modal-lg" id="confirmDeleteSibling<?= $ctr ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-lg">
                                                                                        <?= form_open_multipart("pds/deletesibling/") ?>
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                                                    <h4 class="modal-title">Confirm</h4>
                                                                                                </div>
                                                                                                <div class="modal-body">
                                                                                                    <p>You are about to delete <?= $sib->firstName . " " . $sib->middleName . " " . $sib->lastName ?></p>
                                                                                                    <p>Are you Sure to Remove this Sibling? You action cannot be undone.</p>
                                                                                                    <input type="hidden" name="memberId" value="<?= $m['ndex'] ?>"/>
                                                                                                    <input type="hidden" name="siblingId" value="<?= $sib->ndex ?>"/>
                                                                                                </div>
                                                                                                <div class="modal-footer">
                                                                                                    <button type="submit" class="btn btn-danger" name="btnDeleteSibling" value="DeleteSibling">Delete</button>
                                                                                                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- /.modal-content -->

                                                                                        </form>
                                                                                    </div>
                                                                                    <!-- /.modal-dialog -->
                                                                                </div>

                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="7" style="text-align: center;">No Siblings Recorded.</td>
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
                                        <!-- END Portlet PORTLET-->
                                    </div>

                                </div>


                                <!-- Add Sibling modal -->
                                <div class="modal fade bs-modal-lg" id="addsibling" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Add Sibling / <small>Make sure to find that member before adding it manually</small></h4>
                                            </div>
                                            <div class="modal-body">

                                                <!-- Modal Content -->
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                                        <ul class="nav nav-tabs tabs-left">
                                                            <li class="active">
                                                                <a href="#AddSiblingFromMember" data-toggle="tab">
                                                                    Find </a>
                                                            </li>
                                                            <li>
                                                                <a href="#NonMemberSibling" data-toggle="tab">
                                                                    Manually Add </a>
                                                            </li>

                                                        </ul>
                                                    </div>

                                                    <div class="col-md-9 col-sm-9 col-xs-9">

                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="AddSiblingFromMember">

                                                                <!-- BEGIN Portlet PORTLET Existing Members -->
                                                                <div class="portlet light">
                                                                    <div class="portlet-title">
                                                                        <div class="caption">
                                                                            <i class="icon-speech"></i>
                                                                            <span class="caption-subject bold uppercase"> Add Sibling from Existing Member</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="portlet-body">

                                                                        <div class="row">

                                                                            <div class="col-md-12">
                                                                                <form id="frmAddSibling">
                                                                                    <div class="input-group">
                                                                                        <input id="txtFindSiblings" type="text" class="form-control input-large" placeholder="Please Enter Lastname or Firstname" name="siblingsearchkey" onkeyup="showRecord(this.value)">
                                                                                    </div>
                                                                                    <!-- /input-group -->

                                                                                </form>


                                                                                <hr/>
                                                                                <div id="matchsiblings" class="scroller" style="height:200px">

                                                                                </div>

                                                                            </div>


                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <!-- END Portlet PORTLET-->

                                                            </div>

                                                            <div class="tab-pane fade" id="NonMemberSibling">

                                                                <!-- BEGIN Portlet PORTLET Non-Member-->
                                                                <div class="portlet light">
                                                                    <div class="portlet-title">
                                                                        <div class="caption">
                                                                            <i class="icon-speech"></i>
                                                                            <span class="caption-subject bold uppercase"> Add a Non-Member Sibling</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="portlet-body">

                                                                        <div class="row">

                                                                            <?= form_open_multipart("pds/addNonMemberSibling/") ?>
                                                                                <div class="row">
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label>Last Name * </label>
                                                                                            <input type="text" required class="form-control" id="txtLastName"  name="txtLastName" onkeyup="showPossibleSiblingRecord(this.value, txtFirstName.value)">
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label>First Name * </label>
                                                                                            <input type="text" required class="form-control" id="txtFirstName" name="txtFirstName" onkeyup="showPossibleSiblingRecord(txtLastName.value, this.value)">
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label>Middle Name</label>
                                                                                            <input type="text" class="form-control" name="txtMiddleName" >
                                                                                        </div>
                                                                                    </div>

                                                                                </div>


                                                                                <div class="row">
                                                                                    <div class="col-md-8">
                                                                                        <div class="form-group">
                                                                                            <label>Occupation</label>
                                                                                            <input type="text" class="form-control" name="txtOccupation" >
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label>Gender</label>
                                                                                            <select name="gender" class="form-control" id="">
                                                                                                <option value="Male">MALE</option>
                                                                                                <option value="Female">FEMALE</option>
                                                                                            </select>
                                                                                            <input type="hidden" name="memberId" value="<?= $m['ndex'] ?>"/>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- /input-group -->
                                                                                    <hr/>
                                                                                    <div class="col-md-12" style="text-align: right;">
                                                                                        <input type="hidden" name="encodername" value="<?= $this->session->userdata('lastname') . ', ' . $this->session->userdata('firstname') ?>">
                                                                                        <input type="hidden" name="recordndex" value="<?= $m['ndex'] ?>">
                                                                                        <button type="submit" class="btn blue">Add Sibling</button>
                                                                                    </div>
                                                                                </div>
                                                                                <hr/>
                                                                                    <p id="findsiblingloading"> </p>
                                                                            </form>
                                                                        </div>
                                                                        <div id="possiblematchsiblings" class="scroller" style="height:200px">

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <!-- END Portlet PORTLET-->

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- end of Modal Content -->

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->

                                <hr/>

                                <div class="row">
                                    <div class="col-md-12 ">
                                        <!-- BEGIN Portlet PORTLET-->
                                        <div class="portlet box grey-silver">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-users"></i>Children
                                                </div>
                                                <div class="actions">

                                                    <a class="btn green" data-toggle="modal" data-target="#addchild">
                                                        <i class="fa fa-plus"></i> Add </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="scroller" style="height:170px">

                                                    <table width="100%">
                                                        <tbody>

                                                        <tr>
                                                            <td colspan="2">
                                                                <table class="table table-striped table-bordered table-hover">

                                                                    <tbody>
                                                                    <tr>
                                                                        <td><strong>#</strong></td>
                                                                        <td><strong>Full Name</strong></td>
                                                                        <td><strong>Gender</strong></td>
                                                                        <td><strong>Occupation</strong></td>
                                                                        <td><strong>Member Type</strong></td>
                                                                        <td><strong>Status</strong></td>
                                                                        <td><strong>Action</strong></td>
                                                                    </tr>

                                                                    <?php
                                                                    $ctr2 = 1;
                                                                    if(count($children) > 0)
                                                                    {
                                                                        foreach($children as $kid)
                                                                        {
                                                                            ?>
                                                                            <tr>
                                                                                <td><?= $ctr2++ ?></td>
                                                                                <td><?= $kid->lastName . ', ' . $kid->firstName . ' ' . $kid->middleName ?></td>
                                                                                <td><?= $kid->gender ?></td>
                                                                                <td><?= $kid->occupation ?></td>
                                                                                <td><?= $arrcategory[$kid->memberClass] ?></td>
                                                                                <td><?= $arrmemstat[$kid->memberStatus] ?></td>
                                                                                <td>
                                                                                    <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#updatechild<?= $ctr2 ?>"><i class="fa fa-edit"></i></button>
                                                                                    <button type="button" class="btn btn-xs btn-danger" data-target="#confirmDeleteChild<?= $ctr2 ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></button>



                                                                                    <div class="modal fade bs-modal-lg" id="updatechild<?= $ctr2 ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                                                        <div class="modal-dialog">
                                                                                            <?= form_open_multipart("pds/updatechild/".$m['misid']) ?>
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                                                    <h4 class="modal-title">Update Child</h4>
                                                                                                </div>
                                                                                                <div class="modal-body">

                                                                                                    <label for="">Last Name</label>
                                                                                                    <input type="text" class="form-control" name="lastName" value="<?= $kid->lastName ?>"/>

                                                                                                    <label for="">First Name</label>
                                                                                                    <input type="text" class="form-control" name="firstName" value="<?= $kid->firstName ?>"/>

                                                                                                    <label for="">Middle Name</label>
                                                                                                    <input type="text" class="form-control" name="middleName" value="<?= $kid->middleName ?>"/>

                                                                                                    <label for="">Gender</label>
                                                                                                    <select name="gender" id="childsgender" class="form-control">
                                                                                                        <option value="Male" <?= ($kid->gender == "Male")?" selected":"" ?>>Male</option>
                                                                                                        <option value="Female" <?= ($kid->gender == "Female")?" selected":"" ?>>Female</option>
                                                                                                    </select>

                                                                                                    <label for="">Occupation</label>
                                                                                                    <input type="text" class="form-control" name="occupation" value="<?= $kid->occupation ?>"/>

                                                                                                    <label for="">Member Type</label>
                                                                                                    <select name="memberClass" id="childsmemberClass" class="form-control" required>
                                                                                                        <option value="0"> Please Select </option>
                                                                                                        <option value="9" <?= ($kid->memberClass == 9)?"selected":'' ?>>NON-MEMBER</option>
                                                                                                        <option value="3" <?= ($kid->memberClass == 3)?"selected":'' ?>>MEMBER</option>
                                                                                                        <option value="2" <?= ($kid->memberClass == 2)?"selected":'' ?>>PTMW</option>
                                                                                                        <option value="1" <?= ($kid->memberClass == 1)?"selected":'' ?>>FTMW</option>
                                                                                                    </select>

                                                                                                    <input type="hidden" name="childId" value="<?= $kid->ndex ?>"/>
                                                                                                </div>
                                                                                                <div class="modal-footer">
                                                                                                    <button type="submit" class="btn btn-primary" name="btnupdateChild" value="updateChild">Update</button>
                                                                                                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- /.modal-content -->

                                                                                            </form>
                                                                                        </div>
                                                                                        <!-- /.modal-dialog -->
                                                                                    </div>



                                                                                    <div class="modal fade bs-modal-lg" id="confirmDeleteChild<?= $ctr2 ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                                                        <div class="modal-dialog modal-lg">
                                                                                            <?= form_open_multipart("pds/deletechild/") ?>
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                                                        <h4 class="modal-title">Confirm</h4>
                                                                                                    </div>
                                                                                                    <div class="modal-body">
                                                                                                        <p>You are about to delete <?= $kid->firstName . " " . $kid->middleName . " " . $kid->lastName  ?> from children.</p>
                                                                                                        <p>Are you Sure to Remove this Sibling? You action cannot be undone.</p>
                                                                                                        <input type="hidden" name="memberId" value="<?= $m['ndex'] ?>"/>
                                                                                                        <input type="hidden" name="childId" value="<?= $kid->ndex ?>"/>
                                                                                                    </div>
                                                                                                    <div class="modal-footer">

                                                                                                        <input type="hidden" name="encodername" value="<?= $this->session->userdata('lastname') . ', ' . $this->session->userdata('firstname') ?>">
                                                                                                        <input type="hidden" name="recordndex" value="<?= $m['ndex'] ?>">


                                                                                                        <button type="submit" class="btn btn-danger" name="btnDeleteChild" value="DeleteChild">Delete</button>
                                                                                                        <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <!-- /.modal-content -->

                                                                                            </form>
                                                                                        </div>
                                                                                        <!-- /.modal-dialog -->
                                                                                    </div>

                                                                                </td>
                                                                            </tr>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    else
                                                                    {
                                                                        ?>
                                                                        <tr>
                                                                            <td colspan="7" style="text-align: center;">No Children Recorded.</td>
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
                                        <!-- END Portlet PORTLET-->
                                    </div>

                                </div>

                                <!-- Add Children modal -->
                                <div class="modal fade bs-modal-lg" id="addchild" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Add Child</h4>
                                            </div>
                                            <div class="modal-body">

                                                <!-- Modal Content -->
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                                        <ul class="nav nav-tabs tabs-left">
                                                            <li class="active">
                                                                <a href="#AddChildromMember" data-toggle="tab">
                                                                    Member </a>
                                                            </li>
                                                            <li>
                                                                <a href="#NonMemberChild" data-toggle="tab">
                                                                    Non-Member </a>
                                                            </li>

                                                        </ul>
                                                    </div>

                                                    <div class="col-md-9 col-sm-9 col-xs-9">

                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="AddChildromMember">

                                                                <!-- BEGIN Portlet PORTLET Existing Members -->
                                                                <div class="portlet light">
                                                                    <div class="portlet-title">
                                                                        <div class="caption">
                                                                            <i class="icon-speech"></i>
                                                                            <span class="caption-subject bold uppercase"> Add Child from Existing Member</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="portlet-body">

                                                                        <div class="row">

                                                                            <div class="col-md-12">
                                                                                <form id="frmAddSibling">
                                                                                    <div class="input-group">
                                                                                        <input id="txtFindChild" type="text" class="form-control input-large" placeholder="Please Enter Lastname or Firstname" name="childsearchkey" onkeyup="showPossibleChildRecord(this.value)">
                                                                                    </div>
                                                                                    <!-- /input-group -->

                                                                                </form>

                                                                                <hr/>
                                                                                <div id="matchchildren" class="scroller" style="height:200px">

                                                                                </div>

                                                                            </div>


                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <!-- END Portlet PORTLET-->

                                                            </div>

                                                            <div class="tab-pane fade" id="NonMemberChild">

                                                                <!-- BEGIN Portlet PORTLET Non-Member-->
                                                                <div class="portlet light">
                                                                    <div class="portlet-title">
                                                                        <div class="caption">
                                                                            <i class="icon-speech"></i>
                                                                            <span class="caption-subject bold uppercase"> Add a Non-Member Child</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="portlet-body">

                                                                        <div class="row">

                                                                            <?= form_open_multipart("pds/addNonMemberChild/") ?>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Last Name * </label>
                                                                                        <input type="text" required class="form-control" id="txtLastName"  name="txtLastName" onkeyup="showPossibleChildRecords(this.value, txtFirstName.value)">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>First Name * </label>
                                                                                        <input type="text" required class="form-control" id="txtFirstName" name="txtFirstName" onkeyup="showPossibleChildRecords(txtLastName.value, this.value)">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Middle Name</label>
                                                                                        <input type="text" class="form-control" name="txtMiddleName" >
                                                                                    </div>
                                                                                </div>

                                                                            </div>


                                                                            <div class="row">
                                                                                <div class="col-md-8">
                                                                                    <div class="form-group">
                                                                                        <label>Occupation</label>
                                                                                        <input type="text" class="form-control" name="txtOccupation" >
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Gender</label>
                                                                                        <select name="gender" class="form-control" id="">
                                                                                            <option value="Male">MALE</option>
                                                                                            <option value="Female">FEMALE</option>
                                                                                        </select>
                                                                                        <input type="hidden" name="memberId" value="<?= $m['ndex'] ?>"/>
                                                                                    </div>
                                                                                </div>

                                                                                <!-- /input-group -->
                                                                                <hr/>
                                                                                <div class="col-md-12" style="text-align: right;">

                                                                                    <input type="hidden" name="encodername" value="<?= $this->session->userdata('lastname') . ', ' . $this->session->userdata('firstname') ?>">
                                                                                    <input type="hidden" name="recordndex" value="<?= $m['ndex'] ?>">

                                                                                    <button type="submit" class="btn blue">Add Child</button>
                                                                                </div>
                                                                            </div>
                                                                            <hr/>
                                                                            <p id="findchildloading"> </p>
                                                                            </form>
                                                                        </div>
                                                                        <div id="possiblematchchild" class="scroller" style="height:200px">

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <!-- END Portlet PORTLET-->

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- end of Modal Content -->

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->

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

                <?= form_open_multipart("pds/updatepds/".$mem_id) ?>

                    <table class="table table-striped table-bordered table-hover">

                        <tbody>
                        <tr>
                            <td colspan="2" style="text-align: center;"> <strong>WATER BAPTISM</strong> </td>
                        </tr>

                        <tr>
                            <td width="20%"> <strong>Date Baptized</strong> </td>
                            <td width="80%"> <input class="form-control form-control-inline input-small date-picker" type="text" name="waterBaptismDate" value="<?php if($m['waterBaptismDate'] == "0000-00-00"){ echo "-"; } else { $originalDate = $m['waterBaptismDate']; $newDate = date("m/d/Y", strtotime($originalDate));  echo $newDate; }?>"/>

                            </td>
                        </tr>

                        <tr>
                            <td width="20%"> <strong>Place of Baptism</strong> </td>
                            <td width="80%"> <input class="form-control" type="text" name="waterBaptismPlace" value="<?= $m['waterBaptismPlace'] ?>"/> </td>
                        </tr>

                        <tr>
                            <td width="20%"> <strong>Presiding Minister</strong> </td>
                            <td width="80%"> <input class="form-control" type="text" name="waterBaptismByWhom" value="<?= $m['waterBaptismByWhom'] ?>"/> </td>

                        <tr>
                            <td width="20%"> <strong>How Member was Converted?</strong> </td>
                            <td width="80%">
                                <div class="form-group">

                                    <input id="howConverted" type="hidden" name="howConverted" value=""/>
                                    <label><input id = "optTv" type="radio" name="optionsRadios"  value="1" onclick="manageopts()" <?= ($m['howConverted'] == 1)?'checked':'' ?>> TV </label>
                                    <label><input id = "optRadio" type="radio" name="optionsRadios" value="2" onclick="manageopts()"  <?= ($m['howConverted'] == 2)?'checked':'' ?>> Radio </label>
                                    <label><input id = "optInvitedByMember" type="radio" name="optionsRadios" value="option2" onclick="manageopts()" <?= ($m['howConverted'] == 3)?"checked":"" ?> >  Invited By A Member | Member Name:  <input <?= ($m['howConverted'] == 3)?"disabled = false":"disabled" ?> id = "txtInvitedBy" class="form-control input-large input-inline" type="text" name="howConvertedByWhom" value="<?= $m['howConvertedByWhom']?>"/> </label>
                                    <label><input id = "optOthers" type="radio" name="optionsRadios"  value="option2" onclick="manageopts()" <?= ($m['howConverted'] == 4)?"checked":"" ?> > Other | Please Specify </label>
                                    <textarea  id = "txtOtherSpecify" class="form-control" name="howConvertedOthers" rows="3"  <?= ($m['howConverted'] == 4)?"disabled = false":"disabled" ?>> <?= $m['howConvertedOthers'] ?></textarea>

                                    <!--  <label><input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled> Disabled </label>-->

                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" style="text-align: center;"> <strong>RE - BAPTISM</strong> </td>
                        </tr>

                        <tr>
                            <td width="20%"> <strong>Date Re-Baptized</strong> </td>
                            <td width="80%"> <input class="form-control form-control-inline input-small date-picker" type="text" name="waterReBaptismDate" value="<?php $originalDate = $m['waterReBaptismDate'];

                                if($originalDate != "0000-00-00")
                                {
                                    $newDate = date("m/d/Y", strtotime($originalDate));
                                    echo $newDate;
                                }
                                else
                                {
                                    echo "";
                                }


                                ?>"/> </td>
                        </tr>

                        <tr>
                            <td width="20%"> <strong>Place of Baptism</strong> </td>
                            <td width="80%"> <input class="form-control" type="text" name="waterReBaptismPlace" value="<?= $m['waterReBaptismPlace'] ?>"/> </td>
                        </tr>

                        <tr>
                            <td width="20%"> <strong>Presiding Minister</strong> </td>
                            <td width="80%"> <input class="form-control" type="text" name="waterReBaptismByWhom" value="<?= $m['waterReBaptismByWhom'] ?>"/> </td>
                        </tr>
                        <tr>
                            <td width="20%"> <strong>Reason For Re-Baptism</strong> </td>
                            <td width="80%"><textarea name="reasonForRebaptism" id="" cols="30" rows="3" class="form-control"><?= $m['reasonForRebaptism']?></textarea> </td>
                        </tr>

                        <tr>
                            <td colspan="2" style="text-align: center;">
                                <strong>KINGDOM EVENTS ATTENDED</strong>
                                <p>Please indicate the number of attendace on the following Events </p>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" style="text-align: center;">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table width="100%">
                                            <tr>
                                                <td>
                                                    <label class="control-label">MOB:</label>
                                                    <input class="form-control input-small input-inline" type="text" name="eventsMOD" value="<?= $m['eventsMOD']?>"/>
                                                </td>
                                                <td>
                                                    <label class="control-label">IYC:</label>
                                                    <input class="form-control input-small input-inline" type="text" name="eventsIYC" value="<?= $m['eventsIYC']?>"/>
                                                </td>
                                                <td>
                                                    <label class="control-label">IKLC:</label>
                                                    <input class="form-control input-small input-inline" type="text" name="eventsIKLC" value="<?= $m['eventsIKLC']?>"/>
                                                </td>
                                                <td>
                                                    <label class="control-label">IKLC: Seminars</label>
                                                    <input class="form-control input-small input-inline" type="text" name="iKLCSeminar" value="<?= $m['iKLCSeminar']?>"/>
                                                </td>
                                                <td>
                                                    <label class="control-label">TRIBUTE:</label>
                                                    <input class="form-control input-small input-inline" type="text" name="tribute" value="<?= $m['tribute']?>"/>

                                                </td>
                                            </tr>
                                        </table>

                                    </div>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"> <strong>Date Entered Part-Time</strong> </td>
                            <td width="80%"> <input class="form-control form-control-inline input-small date-picker" type="text" name="dateEnteredPartTimeMinistry" value="<?php $originalDate = $m['dateEnteredPartTimeMinistry'];

                                if($originalDate != "0000-00-00")
                                {
                                    $newDate = date("m/d/Y", strtotime($originalDate));
                                    echo $newDate;
                                }
                                else
                                {
                                    echo "";
                                }


                                ?>"/></td>
                        </tr>
                        <tr>
                            <td width="20%"> <strong>Date Entered Full-Time</strong> </td>
                            <td width="80%"> <input class="form-control form-control-inline input-small date-picker" type="text" name="dateEnteredFullTimeMinistry" value="<?php $originalDate = $m['dateEnteredFullTimeMinistry'];

                                if($originalDate != "0000-00-00")
                                {
                                    $newDate = date("m/d/Y", strtotime($originalDate));
                                    echo $newDate;
                                }
                                else
                                {
                                    echo "";
                                }


                                ?>"/>
                                <?php
                                if ($m['dateEnteredFullTimeMinistry'] != "0000-00-00"){

                                }
                                ?> <small>(blah blah blah)</small> </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right;">
                                <input type="hidden" name="encodername" value="<?= $this->session->userdata('lastname') . ', ' . $this->session->userdata('firstname') ?>">
                                <input type="hidden" name="recordndex" value="<?= $m['ndex'] ?>">

                                <button type="submit" class="btn btn-primary" name="btnUpdateSpiritualBackground" value="UpdateSpiritualBackground"><span class="fa fa-floppy-o"></span> Save</button>
                            </td>
                        </tr>



                    </table>
                </form>


                <hr/>


                <!-- MOB Participation -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-speech"></i>
                                    <span class="caption-subject bold uppercase"> MOB Participation</span>
                                </div>

                                <div class="actions">
                                    <a class="btn btn-circle btn-default" data-toggle="modal" data-target="#addmobhist">
                                        <i class="fa fa-plus"></i> Add MOB Record </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table width="100%" class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <td><strong>Year</strong></td>
                                        <td><strong>Means / Ways of Contribution</strong></td>
                                        <td><strong>Target Goal</strong></td>
                                        <td><strong>Achieved</strong></td>
                                        <td><strong>Action</strong></td>
                                    </tr>

                                    <?php
                                    if(count($mobs)>0)
                                    {
                                        foreach($mobs as $mob)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $mob->mobyear ?></td>
                                                <td><?= $mob->meansandways ?></td>
                                                <td><?= $mob->goalamount ?></td>
                                                <td><?= ($mob->achievedgoal == 1)?"YES":"NO" ?></td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-target="#updateTraining<?= $mob->ndex ?>" data-toggle="modal"><span class="fa fa-pencil"></span></button>
                                                    <button class="btn btn-danger btn-sm"  data-target="#confirmdeleletemobhist<?= $mob->ndex ?>" data-toggle="modal"><span class="fa fa-trash-o"></span></button>

                                                    <!-- MODAL update training and seminar -->
                                                    <div class="modal fade" id="updateTraining<?= $mob->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <?= form_open_multipart("pds/updatemobhist/".$mem_id) ?>
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title">Update Seminar / Training</h4>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <input type="hidden" name="mobndex" value="<?= $mob->ndex ?>"/>
                                                                    <label>Year of MOB</label>
                                                                    <input required type="number" class="form-control form-control-inline input-small " name="mobyear" value="<?= $mob->mobyear ?>"/>

                                                                    <label>Means / Ways of Participation / Contribution</label>
                                                                    <textarea class="form-control" name="meansandways" id="" cols="30" rows="5">  <?= $mob->meansandways ?> </textarea>

                                                                    <label>Goal Amount</label>
                                                                    <input required type="number" step="0.10" class="form-control form-control-inline input-medium " name="goalamount" value="<?= $mob->goalamount ?>"/>

                                                                    <label>Target Goal Achieved?</label>
                                                                    <select name="achievedgoal" class="form-control form-control-inline input-small">
                                                                        <option value="0" <?= ($mob->achievedgoal == 0)?" selected":"" ?>>NO</option>
                                                                        <option value="1" <?= ($mob->achievedgoal == 1)?" selected":"" ?>>YES</option>
                                                                    </select>


                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn blue">Update</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- end MODAL training and seminar -->

                                                    <!-- confirm deletemobhist-->
                                                    <div class="modal fade" id="confirmdeleletemobhist<?= $mob->ndex ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog ">
                                                            <?= form_open_multipart("pds/deletemobhist/" . $mem_id) ?>
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title">Confirm</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h4>Are you Sure to Delete this MOB History?</h4>
                                                                    <?php $ag = ($mob->achievedgoal == 1)?"YES":"NO"; ?>
                                                                    <p><?= $mob->mobyear . " | " . $mob->meansandways . " | " . $mob->goalamount . " | " . $ag ?></p>
                                                                    <input type="hidden" name="mobndex" value="<?= $mob->ndex ?>"/>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-danger" name="btnDeleteSibling" value="DeleteSibling">Delete</button>
                                                                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->

                                                            </form>
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- end of confirm deletemobhist-->

                                                </td>
                                            </tr>

                                        <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <tr style="text-align: center;">
                                            <td colspan="5"> no recorded participation.. </td>

                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end MOB Participation -->

                <!-- MODAL MOB Participation -->
                <div class="modal fade" id="addmobhist" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <?= form_open_multipart("pds/addmobhist/".$mem_id) ?>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">Add MOB History</h4>
                            </div>
                            <div class="modal-body">

                                <label>Year of MOB</label>
                                <input required type="number" class="form-control form-control-inline input-small " name="mobyear"/>

                                <label>Means / Ways of Participation / Contribution</label>
                                <textarea class="form-control" name="meansandways" id="" cols="30" rows="5"></textarea>


                                <label>Goal Amount</label>
                                <input required type="number" step="0.10" class="form-control form-control-inline input-medium " name="goalamount"/>

                                <label>Target Goal Achieved?</label>
                                <select name="achievedgoal" class="form-control form-control-inline input-small">
                                    <option value="0">NO</option>
                                    <option value="1">YES</option>
                                </select>
                               

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn blue">Add</button>
                            </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- end MODAL training and seminar -->


                <!-- training and seminar -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-speech"></i>
                                    <span class="caption-subject bold uppercase"> TRAININGS AND SEMINARS ATTENDED</span>
                                </div>

                                <div class="actions">
                                    <a class="btn btn-circle btn-default" data-toggle="modal" data-target="#addTraining">
                                        <i class="fa fa-plus"></i> Add Training / Seminar </a>
                                </div>
                            </div>
                            <div class="portlet-body">

                                <table width="100%" class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <td><strong>Date Attended</strong></td>
                                        <td><strong>Name of the Seminar</strong></td>
                                        <td><strong>Description</strong></td>
                                        <td><strong>Remarks</strong></td>
                                        <td><strong>Action</strong></td>
                                    </tr>

                                    <?php
                                     if(count($trainings)>0)
                                     {
                                        foreach($trainings as $t)
                                        {
                                    ?>

                                        <tr>
                                            <td><?php $originalDate = $t->dateTaken; $newDate = date("M d, Y", strtotime($originalDate));  echo $newDate; ?></td>
                                            <td><?= $t->tsName ?></td>
                                            <td><?= $t->description ?></td>
                                            <td><?= $t->remarks ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-target="#updateTraining<?= $t->ndex ?>" data-toggle="modal"><span class="fa fa-pencil"></span></button>
                                                <button class="btn btn-danger btn-sm" onclick="parent.location='<?= base_url().'pds/deletetrainings/'.$mem_id.'/'.$t->ndex ?>'"><span class="fa fa-trash-o"></span></button>

                                                <!-- MODAL update training and seminar -->
                                                <div class="modal fade" id="updateTraining<?= $t->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <?= form_open_multipart("pds/updatetraining/".$mem_id) ?>
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title">Update Seminar / Training</h4>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <input type="hidden" value="<?= $t->ndex ?>" name="trainingid"/>
                                                                    <label>Date Taken</label>
                                                                    <input type="text" class="form-control form-control-inline input-small date-picker" name="dateTaken"
                                                                           value="<?php $newDate = date("m/d/Y", strtotime($t->dateTaken));
                                                                    echo $newDate;?>"/>

                                                                    <label>Title of Seminar / Training</label>
                                                                    <input type="text" class="form-control" name="tsName" value=" <?= $t->tsName ?>"/>

                                                                    <label>Description </label>
                                                                    <textarea class="form-control" name="description" id="" cols="30" rows="5">
                                                                        <?= $t->description ?>
                                                                    </textarea>

                                                                    <label>Remarks</label>
                                                                    <input type="text" class="form-control" name="remarks" value=" <?= $t->remarks ?>"/>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn blue">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- end MODAL training and seminar -->

                                            </td>
                                        </tr>

                                    <?php
                                        }
                                     }
                                    else
                                    {
                                    ?>
                                        <tr style="text-align: center;">
                                            <td colspan="5"> no recorded trainings.. </td>

                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end training and seminar -->

                <!-- MODAL training and seminar -->
                <div class="modal fade" id="addTraining" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <?= form_open_multipart("pds/addtraining/".$mem_id) ?>
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Add Seminar / Training</h4>
                                </div>
                                <div class="modal-body">

                                    <label>Date Taken</label>
                                    <input required type="text" class="form-control form-control-inline input-small date-picker" name="dateTaken"/>

                                    <label>Title of Seminar / Training</label>
                                    <input required type="text" class="form-control" name="tsName"/>

                                    <label>Description </label>
                                    <textarea class="form-control" name="description" id="" cols="30" rows="5"></textarea>


                                    <label>Remarks</label>
                                    <input type="text" class="form-control" name="remarks"/>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn blue">Add</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- end MODAL training and seminar -->

                <!-- soul winning -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-speech"></i>
                                    <span class="caption-subject bold uppercase"> Soul Winning</span>
                                    <span class="caption-helper">Records of Converted Members </span>
                                </div>

                                <div class="actions">
                                    <a class="btn btn-circle btn-default" data-target="#findfruits" data-toggle="modal">
                                        <i class="fa fa-plus"></i> Add Converted Members </a>
                                </div>
                            </div>
                            <div class="portlet-body">

                                <table width="100%" class="table table-striped table-bordered table-hover">

                                    <tr>
                                        <td colspan="2">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <td><strong>#</strong></td>
                                                    <td><strong>Complete Name</strong></td>
                                                    <td><strong>Member Class</strong></td>
                                                    <td><strong>Date Baptized</strong></td>
                                                    <td><strong>Action</strong></td>
                                                </tr>

                                                <?php
                                                $csctr = 1;
                                                if(count($convertedsouls)>0)
                                                {
                                                    foreach($convertedsouls as $cs)
                                                    {
                                                ?>
                                                    <tr>
                                                        <td><?= $csctr ?></td>
                                                        <td><a href="<?= ($cs->misid != "")?base_url().'pds/profile/'.$cs->misid.'" target="_blank"':'#"'?> > <?= $cs->lastName . ', '. $cs->firstName . ' ' . $cs->middleName ?> </a></td>
                                                        <td><?= $arrcategory[$cs->memberClass] ?></td>
                                                        <td>
                                                            <?php
                                                                if($cs->waterBaptismDate != '0000-00-00')
                                                                {
                                                                    $newDate = date("m/d/Y", strtotime($cs->waterBaptismDate));
                                                                    echo $newDate;
                                                                }
                                                               else
                                                               {
                                                                   echo '<small> No baptism date. <br/> Please update immediately! </small>';
                                                               }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?= form_open_multipart("pds/disconnectfruit/".$mem_id) ?>
                                                                <input type="hidden" name="fruitId" value = "<?= $cs->ndex ?>" />
                                                                <input type="hidden" name="requester" value = "<?= $mem_id ?>" />
                                                                <button type="submit" class="btn btn-danger btn-sm"><span class="fa fa-trash-o"></span></button>
                                                            </form>

                                                        </td>
                                                    </tr>
                                                <?php
                                                    $csctr++;
                                                    }
                                                }
                                                else
                                                {
                                                ?>
                                                <tr>
                                                    <td colspan="5"> no recorded members.. </td>
                                                </tr>

                                                <?php
                                                }
                                                ?>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end soul winning -->


                <!-- MODAL Fruited Member Lookup -->
                <div class="modal fade bs-modal-lg" id="findfruits" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title"><span class="fa fa-search"></span> Lookup / Add Fruit</h4>
                            </div>
                            <div class="modal-body">

                                <label class="control-label">Find Baptized Member</label>
                                <input id="fruitedmemberkey" type="text" class="form-control input-large" onkeyup="findfruits(this.value)"/>
                                <div id="fruitedmemberlookup">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- end Fruited Member Lookup-->


                <!-- MODAL Ministry History -->
                <div class="modal fade" id="addministryhistory" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <?= form_open_multipart("pds/addministryhistory/".$mem_id) ?>
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title"><span class="fa fa-search"></span> Ministry History</h4>
                                </div>
                                <div class="modal-body">

                                    <input type="hidden" name="memberndex" value="<?= $m['ndex'] ?>"/>
                                    <label class='control-label'>From: </label>
                                    <input required class="form-control input-inline input-small date-picker" type="text" name="dateFrom"/>
                                    <label class='control-label'>  To: </label>
                                    <input class="form-control input-inline input-small date-picker"  type="text" name="dateTo"/>
                                    <hr/>

                                    <label for="" class='control-label'>Ministry As: </label>
                                    <select name="tag" id="" required class="form-control input-medium">
                                        <option value=""> </option>
                                        <option value="ptmw">Part Time</option>
                                        <option value="ftmw">Full Time</option>
                                    </select>

                                    <label for="" class='control-label'>KLC </label>
                                    <select name="klc" id="" required class="form-control">
                                        <option value="0"> </option>
                                        <?php
                                        foreach($klcs as $k)
                                        {
                                        ?>
                                            <option value=<?= $k->ndex ?>><?= $k->klcName ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>

                                    <label for="" class='control-label'>Department </label>
                                    <select name="dept" id="" required class="form-control">
                                        <option value=0> </option>
                                        <?php
                                        foreach($depts as $d)
                                        {
                                            ?>
                                            <option value=<?= $d->id ?>><?= $d->departmentname ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>

                                    <label for="" class='control-label'>Ministry </label>
                                    <input required class="form-control" type="text" name="ministry"/>

                                    <label for="">Reporting To(Area Leader)</label>
                                    <input class="form-control" type="text" name="deptInCharge"/>


                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" >Add Ministry History</button>
                                </div>
                            </form>

                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- end MODAL Ministry History -->

                <!-- part-time ministry histry -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-speech"></i>
                                    <span class="caption-subject bold uppercase"> Part Time Ministry</span>
                                    <span class="caption-helper">History of Member's Part-Time Ministry </span>
                                </div>

                                <div class="actions">
                                    <a class="btn btn-circle btn-default" data-toggle="modal" data-target="#addministryhistory">
                                        <i class="fa fa-plus"></i> Add Ministry History</a>
                                </div>
                            </div>
                            <div class="portlet-body">

                                <table width="100%" class="table table-striped table-bordered table-hover">

                                    <tr>
                                        <td colspan="2">
                                            <table class="table table-striped table-bordered table-hover">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <tr>
                                                        <td><strong><small>Base KLC</small></strong></td>
                                                        <td><strong><small>Ministry</small></strong></td>
                                                        <td><strong><small>Department</small></strong></td>
                                                        <td><strong><small>From</small></strong></td>
                                                        <td><strong><small>To</small></strong></td>
                                                        <td><strong><small>Area Leader</small></strong></td>
                                                        <td><strong><small>Action</small></strong></td>
                                                    </tr>
                                                    <?php
                                                    if(count($pthistory) > 0 )
                                                    {
                                                        foreach($pthistory as $pt)
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td><small><?= $arrklc[$pt->klc] ?></small></td>
                                                                <td><small><?= $pt->ministry ?> </small></td>
                                                                <td><small><?= array_key_exists($pt->dept, $arrdept)?$arrdept[$pt->dept]:'department not indicated.' ?> </small></td>
                                                                <td>
                                                                    <?php
                                                                    if($pt->dateFrom != '0000-00-00')
                                                                    {
                                                                        $newDate = date("m/d/Y", strtotime($pt->dateFrom));
                                                                        echo '<small>'.$newDate.'</small>';
                                                                    }
                                                                    else
                                                                    {
                                                                        echo '-';
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    if($pt->dateTo != '0000-00-00')
                                                                    {
                                                                        $newDate = date("m/d/Y", strtotime($pt->dateTo));
                                                                        echo '<small>'.$newDate.'</small>';
                                                                    }
                                                                    else
                                                                    {
                                                                        echo ' - ';
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <small><?= $pt->deptInCharge ?></small>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateministryhistory<?=$pt->ndex?>"><span class="fa fa-pencil"></span></button>
                                                                    <button class="btn btn-danger btn-sm"><span class="fa fa-trash-o"></span></button>

                                                                    <!-- MODAL EDIT Ministry History -->
                                                                    <div class="modal fade" id="updateministryhistory<?=$pt->ndex?>" tabindex="-1" role="basic" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">

                                                                                <?= form_open_multipart("pds/updateministryhistory/".$mem_id) ?>
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                                    <h4 class="modal-title"><span class="fa fa-search"></span> Ministry History</h4>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <input type="hidden" name="memberndex" value="<?= $m['ndex'] ?>"/>
                                                                                    <input type="hidden" name="ministryndex" value="<?= $pt->ndex ?>"/>
                                                                                    <label class='control-label'>From: </label>

                                                                                    <?php
                                                                                    if($pt->dateFrom != '0000-00-00')
                                                                                    {
                                                                                        $newDateFrom = date("m/d/Y", strtotime($pt->dateFrom));
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        $newDateFrom = '';
                                                                                    }
                                                                                    ?>

                                                                                    <input required class="form-control input-inline input-small date-picker" type="text" name="dateFrom" value="<?= $newDateFrom ?>"/>

                                                                                    <label class='control-label'>  To: </label>

                                                                                    <?php
                                                                                    if($pt->dateTo != '0000-00-00')
                                                                                    {
                                                                                        $newDate = date("m/d/Y", strtotime($pt->dateTo));
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        $newDate = '';
                                                                                    }
                                                                                    ?>

                                                                                    <input class="form-control input-inline input-small date-picker"  type="text" name="dateTo" value = "<?= $newDate ?>"/>
                                                                                    <hr/>

                                                                                    <label for="" class='control-label'>Ministry As: </label>
                                                                                    <select name="tag" id="" required class="form-control input-medium">
                                                                                        <option value="" <?= ($pt->tag != 'ptmw' && $pt->tag != 'ftmw' )?"selected":"" ?> > </option>
                                                                                        <option value="ptmw" <?= ($pt->tag == 'ptmw')?"selected":"" ?> >Part Time</option>
                                                                                        <option value="ftmw" <?= ($pt->tag == 'ftmw')?"selected":"" ?>>Full Time</option>
                                                                                    </select>

                                                                                    <label for="" class='control-label'>KLC </label>
                                                                                    <select name="klc" id="" required class="form-control">
                                                                                        <option value="0"> </option>
                                                                                        <?php
                                                                                        foreach($klcs as $k)
                                                                                        {
                                                                                            ?>
                                                                                            <option value=<?= $k->ndex ?> <?= ($pt->klc == $k->ndex)?" selected":"" ?>><?= $k->klcName ?></option>
                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </select>

                                                                                    <label for="" class='control-label'>Department </label>
                                                                                    <select name="dept" id="" required class="form-control">
                                                                                        <option value=0> </option>
                                                                                        <?php
                                                                                        foreach($depts as $d)
                                                                                        {
                                                                                            ?>
                                                                                            <option value=<?= $d->id ?> <?= ($pt->dept == $d->id)?" selected":"" ?>><?= $d->departmentname ?></option>
                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </select>

                                                                                    <label for="" class='control-label'>Ministry </label>
                                                                                    <input required class="form-control" type="text" name="ministry" value = "<?= $pt->ministry ?>"/>

                                                                                    <label for="">Area Leader</label>
                                                                                    <input class="form-control" type="text" name="deptInCharge" value = "<?= $pt->deptInCharge ?>"/>


                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" class="btn btn-primary" >Update Ministry History</button>
                                                                                </div>
                                                                                </form>

                                                                            </div>
                                                                            <!-- /.modal-content -->
                                                                        </div>
                                                                        <!-- /.modal-dialog -->
                                                                    </div>
                                                                    <!-- end MODAL EDIT Ministry History -->

                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }

                                                    }
                                                    else
                                                    {
                                                        ?>
                                                        <tr align="center">
                                                            <td colspan="6"> no recorded history of part-time ministry  </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </table>

                                            </table>
                                        </td>
                                    </tr>
                                </table>


                            </div>
                        </div>
                    </div>

                </div>
                <!-- end of part-time ministry histry -->

                <!-- full-time ministry histry -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-speech"></i>
                                    <span class="caption-subject bold uppercase"> Full Time Ministry</span>
                                    <span class="caption-helper">History of Member's Full-Time Ministry </span>
                                </div>

                            </div>
                            <div class="portlet-body">

                                <table width="100%" class="table table-striped table-bordered table-hover">

                                    <tr>
                                        <td colspan="2">
                                            <table class="table table-striped table-bordered table-hover">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <tr>
                                                        <td><strong><small>Base KLC</small></strong></td>
                                                        <td><strong><small>Ministry</small></strong></td>
                                                        <td><strong><small>Department</small></strong></td>
                                                        <td><strong><small>From</small></strong></td>
                                                        <td><strong><small>To</small></strong></td>
                                                        <td><strong><small>Area Leader</small></strong></td>
                                                        <td><strong><small>Action</small></strong></td>
                                                    </tr>

                                                    <?php
                                                    if(count($fthistory) > 0 )
                                                    {
                                                        foreach($fthistory as $ft)
                                                        {
                                                    ?>
                                                        <tr>
                                                            <td><small><?= $arrklc[$ft->klc] ?></small></td>
                                                            <td><small><?= $ft->ministry ?> </small></td>
                                                            <td><small>
                                                                    <?= array_key_exists($ft->dept, $arrdept)?$arrdept[$ft->dept]:'department not indicated.' ?>

                                                                </small></td>
                                                            <td>
                                                                <?php
                                                                if($ft->dateFrom != '0000-00-00')
                                                                {
                                                                    $newDate = date("m/d/Y", strtotime($ft->dateFrom));
                                                                    echo '<small>'.$newDate.'</small>';
                                                                }
                                                                else
                                                                {
                                                                    echo '-';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if($ft->dateTo != '0000-00-00')
                                                                {
                                                                    $newDate = date("m/d/Y", strtotime($ft->dateTo));
                                                                    echo '<small>'.$newDate.'</small>';
                                                                }
                                                                else
                                                                {
                                                                    echo ' - ';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <small><?= $ft->deptInCharge ?></small>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-primary btn-sm"><span class="fa fa-pencil" data-target="#updateministryhistory<?=$ft->ndex?>" data-toggle="modal"></span></button>
                                                                <button class="btn btn-danger btn-sm"><span class="fa fa-trash-o" data-target="#deleteministryhistory<?=$ft->ndex?>" data-toggle="modal"></span></button>

                                                                <!-- MODAL EDIT Ministry History -->
                                                                <div class="modal fade" id="updateministryhistory<?=$ft->ndex?>" tabindex="-1" role="basic" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">

                                                                            <?= form_open_multipart("pds/updateministryhistory/".$mem_id) ?>
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                                <h4 class="modal-title"><span class="fa fa-search"></span> Ministry History</h4>
                                                                            </div>
                                                                            <div class="modal-body">

                                                                                <input type="hidden" name="memberndex" value="<?= $m['ndex'] ?>"/>
                                                                                <input type="hidden" name="ministryndex" value="<?= $ft->ndex ?>"/>
                                                                                <label class='control-label'>From: </label>

                                                                                <?php
                                                                                if($ft->dateFrom != '0000-00-00')
                                                                                {
                                                                                    $newDateFrom = date("m/d/Y", strtotime($ft->dateFrom));
                                                                                }
                                                                                else
                                                                                {
                                                                                    $newDateFrom = '';
                                                                                }
                                                                                ?>

                                                                                <input required class="form-control input-inline input-small date-picker" type="text" name="dateFrom" value="<?= $newDateFrom ?>"/>

                                                                                <label class='control-label'>  To: </label>

                                                                                <?php
                                                                                if($ft->dateTo != '0000-00-00')
                                                                                {
                                                                                    $newDate = date("m/d/Y", strtotime($ft->dateTo));
                                                                                }
                                                                                else
                                                                                {
                                                                                    $newDate = '';
                                                                                }
                                                                                ?>

                                                                                <input class="form-control input-inline input-small date-picker"  type="text" name="dateTo" value = "<?= $newDate ?>"/>
                                                                                <hr/>

                                                                                <label for="" class='control-label'>Ministry As: </label>
                                                                                <select name="tag" id="" required class="form-control input-medium">
                                                                                    <option value="" <?= ($ft->tag != 'ptmw' && $ft->tag != 'ftmw' )?"selected":"" ?> > </option>
                                                                                    <option value="ptmw" <?= ($ft->tag == 'ptmw')?"selected":"" ?> >Part Time</option>
                                                                                    <option value="ftmw" <?= ($ft->tag == 'ftmw')?"selected":"" ?>>Full Time</option>
                                                                                </select>

                                                                                <label for="" class='control-label'>KLC </label>
                                                                                <select name="klc" id="" required class="form-control">
                                                                                    <option value="0"> </option>
                                                                                    <?php
                                                                                    foreach($klcs as $k)
                                                                                    {
                                                                                        ?>
                                                                                        <option value=<?= $k->ndex ?> <?= ($ft->klc == $k->ndex)?" selected":"" ?>><?= $k->klcName ?></option>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>

                                                                                <label for="" class='control-label'>Department </label>
                                                                                <select name="dept" id="" required class="form-control">
                                                                                    <option value=0> </option>
                                                                                    <?php
                                                                                    foreach($depts as $d)
                                                                                    {
                                                                                        ?>
                                                                                        <option value=<?= $d->id ?> <?= ($ft->dept == $d->id)?" selected":"" ?>><?= $d->departmentname ?></option>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>

                                                                                <label for="" class='control-label'>Ministry </label>
                                                                                <input required class="form-control" type="text" name="ministry" value = "<?= $ft->ministry ?>"/>

                                                                                <label for="">Area Leader</label>
                                                                                <input class="form-control" type="text" name="deptInCharge" value = "<?= $ft->deptInCharge ?>"/>


                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" class="btn btn-primary" >Update Ministry History</button>
                                                                            </div>
                                                                            </form>

                                                                        </div>
                                                                        <!-- /.modal-content -->
                                                                    </div>
                                                                    <!-- /.modal-dialog -->
                                                                </div>
                                                                <!-- end MODAL EDIT Ministry History -->

                                                                <!-- MODAL DELETE Ministry History -->
                                                                <div class="modal fade" id="deleteministryhistory<?=$ft->ndex?>" tabindex="-1" role="basic" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">

                                                                            <?= form_open_multipart("pds/removeministryhistory") ?>
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                                <h4 class="modal-title"><span class="fa fa-search"></span> Confirm</h4>

                                                                                <table class="table table-striped table-bordered table-hover">
                                                                                    <table class="table table-striped table-bordered table-hover">
                                                                                        <tr>
                                                                                            <td><strong><small>Base KLC</small></strong></td>
                                                                                            <td><strong><small>Ministry</small></strong></td>
                                                                                            <td><strong><small>Department</small></strong></td>
                                                                                            <td><strong><small>From</small></strong></td>
                                                                                            <td><strong><small>To</small></strong></td>
                                                                                            <td><strong><small>Area Leader</small></strong></td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                        <tr>
                                                                                            <td><small><?= $arrklc[$ft->klc] ?></small></td>
                                                                                            <td><small><?= $ft->ministry ?> </small></td>
                                                                                            <td><small>
                                                                                                    <?= array_key_exists($ft->dept, $arrdept)?$arrdept[$ft->dept]:'department not indicated.' ?>

                                                                                                </small></td>
                                                                                            <td>
                                                                                                <?php
                                                                                                if($ft->dateFrom != '0000-00-00')
                                                                                                {
                                                                                                    $newDate = date("m/d/Y", strtotime($ft->dateFrom));
                                                                                                    echo '<small>'.$newDate.'</small>';
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    echo '-';
                                                                                                }
                                                                                                ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <?php
                                                                                                if($ft->dateTo != '0000-00-00')
                                                                                                {
                                                                                                    $newDate = date("m/d/Y", strtotime($ft->dateTo));
                                                                                                    echo '<small>'.$newDate.'</small>';
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    echo ' - ';
                                                                                                }
                                                                                                ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <small><?= $ft->deptInCharge ?></small>
                                                                                            </td>

                                                                                        </tr>
                                                                                    </table>

                                                                            </div>
                                                                            <div class="modal-body">

                                                                                <input type="hidden" name="ministryndex" value="<?= $ft->ndex ?>"/>
                                                                                <input type="hidden" name="misid" value="<?=$mem_id ?>"/>
                                                                                <h3>Are you Sure to delete This Ministry History?</h3>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" class="btn btn-danger" >Delete</button>
                                                                            </div>
                                                                            </form>

                                                                        </div>
                                                                        <!-- /.modal-content -->
                                                                    </div>
                                                                    <!-- /.modal-dialog -->
                                                                </div>
                                                                <!-- end DELETE EDIT Ministry History -->


                                                            </td>
                                                        </tr>
                                                    <?php
                                                        }

                                                    }
                                                    else
                                                    {
                                                    ?>
                                                        <tr align="center">
                                                            <td colspan="6"> no recorded history of full-time ministry  </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>

                                                </table>

                                            </table>
                                        </td>
                                    </tr>
                                </table>


                            </div>
                        </div>
                    </div>

                </div>
                <!-- end of full-time ministry histry -->

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

                <div class="actions">
                    <a class="btn btn-circle btn-default" data-toggle="modal" data-target="#addeducationhistory">
                        <i class="fa fa-plus"></i> Add Education History</a>
                    <?php
                        if(!ctype_space($m['doctorateNameOfSchool']) || !ctype_space($m['postNameOfSchool'])  || !ctype_space($m['collNameOfSchool'])  || !ctype_space($m['vocNameOfSchool'])  || !ctype_space($m['secNameOfSchool'])  || !ctype_space($m['elemNameOfSchool']))
                        {
                    ?>
                            <a class="btn btn-circle btn-default" href="<?= base_url()."pds/importeduc/".$m['ndex'] ?>">
                                <i class="fa fa-plus"></i> Import Education History From Old Data</a>
                    <?php
                        }
                    ?>

                </div>
            </div>

            <div class="modal fade" id="addeducationhistory" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <?= form_open_multipart("pds/addeducattainment") ?>

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title"><span class="fa fa-graduation-cap"></span> Add Education History</h4>

                            </div>
                            <div class="modal-body">

                                <input type="hidden" name="memberndex" value="<?= $m['ndex'] ?>"/>
                                <input type="hidden" name="misid" value="<?=$mem_id ?>"/>

                                <label for=""> Level</label>
                                <select name="edulevel" id="edulevel" class="form-control input-medium" onchange="manageHigherEdu(this)" required>
                                    <option value=""></option>
                                    <option value="elementary">Elementary</option>
                                    <option value="highschool">High School</option>
                                    <option value="vocational">Diploma / Vocational</option>
                                    <option value="college">College</option>
                                    <option value="masters">Masteral</option>
                                    <option value="doctor">Doctoral</option>
                                </select>

                                <label for="">Name of School</label>
                                <input type="text" name="schoolname" class="form-control" required/>

                                <label for="">School Year</label>
                                <div class="row">
                                    <div class="col-md-1">
                                        <small>From</small>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="frommonth" id="frommonth" class="form-control">
                                            <option value=0><small>MONTH</small></option>
                                            <option value=1>JANUARY</option>
                                            <option value=2>FEBRUARY</option>
                                            <option value=3>MARCH</option>
                                            <option value=4>APRIL</option>
                                            <option value=5>MAY</option>
                                            <option value=6>JUNE</option>
                                            <option value=7>JULY</option>
                                            <option value=8>AUGUST</option>
                                            <option value=9>SEPTEMBER</option>
                                            <option value=10>OCTOBER</option>
                                            <option value=11>NOVEMBER</option>
                                            <option value=12>DECEMBER</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <select name="fromyear" class="form-control" id="">
                                            <option value="0">YEAR</option>
                                            <?php
                                            for($initYear = 1920; $initYear < date('Y') + 5; $initYear++)
                                            {
                                            ?>
                                                <option value="<?= $initYear ?>"><?= $initYear ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <small>To</small>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="tomonth" id="monthto" class="form-control">
                                            <option value=0>MONTH</option>
                                            <option value=1>JANUARY</option>
                                            <option value=2>FEBRUARY</option>
                                            <option value=3>MARCH</option>
                                            <option value=4>APRIL</option>
                                            <option value=5>MAY</option>
                                            <option value=6>JUNE</option>
                                            <option value=7>JULY</option>
                                            <option value=8>AUGUST</option>
                                            <option value=9>SEPTEMBER</option>
                                            <option value=10>OCTOBER</option>
                                            <option value=11>NOVEMBER</option>
                                            <option value=12>DECEMBER</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <select name="toyear" class="form-control" id="">
                                            <option value="0">YEAR</option>
                                            <?php
                                            for($initYear = 1920; $initYear < date('Y')  + 5; $initYear++)
                                            {
                                                ?>
                                                <option value="<?= $initYear ?>"><?= $initYear ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>

                                </div>

                                <label for="">Remarks / <small>(ex. Graduated, Currently Studying, others.)</small></label>
                                <input type="text" name="remarks" class="form-control"/>

                                <div id = 'higheredu' style="visibility: hidden;">
                                    <label for="">Course</label>
                                    <input type="text" name="coursename" class="form-control"/>

                                    <label for="">Earned Units</label>
                                    <input type="text" name="unitscompleted" class="form-control input-small"/>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" >Save</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="portlet-body">

                <!-- elementary -->
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <td " style="text-align: center;"> <strong>ELEMENTARY</strong> </td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(count($education) > 0)
                    {
                        foreach($education as $ed)
                        {
                            if($ed->edulevel == "elementary")
                            {
                    ?>
                                <tr>
                                    <td style="text-align: right;">
                                        <button class="btn btn-xs btn-primary"><span class="fa fa-pencil-square-o" data-toggle="modal" data-target="#updateducationhistory<?= $ed->ndex ?>"></span></button>
                                        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteeduhistory<?= $ed->ndex ?>"><span class="fa fa-trash-o"></span></button>

                                        <!--update educ record-->
                                        <div class="modal fade" id="updateducationhistory<?= $ed->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content" style="text-align: left;">

                                                    <?= form_open_multipart("pds/updateedu") ?>

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title"><span class="fa fa-graduation-cap"></span> Add Education History</h4>

                                                    </div>
                                                    <div class="modal-body">

                                                        <input type="hidden" name="memberndex" value="<?= $m['ndex'] ?>"/>
                                                        <input type="hidden" name="misid" value="<?=$mem_id ?>"/>
                                                        <input type="hidden" name="edundex" value="<?= $ed->ndex ?>"/>

                                                        <label for=""> Level</label>
                                                        <input type="text" name="upedulevel" readonly class="form-control input-small" value="<?= $ed->edulevel ?>"/>

                                                        <label for="">Name of School</label>
                                                        <input type="text" name="schoolname" class="form-control" required value="<?= $ed->schoolname ?>"/>

                                                        <label for="">School Year</label>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <small>From</small>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select name="frommonth" id="frommonth" class="form-control">
                                                                    <option value=0 <?= ($ed->frommonth == 0)?"selected":"" ?>>MONTH</option>
                                                                    <option value=1 <?= ($ed->frommonth == 1)?"selected":"" ?> >JANUARY</option>
                                                                    <option value=2 <?= ($ed->frommonth == 2)?"selected":"" ?>>FEBRUARY</option>
                                                                    <option value=3 <?= ($ed->frommonth == 3)?"selected":"" ?>>MARCH</option>
                                                                    <option value=4 <?= ($ed->frommonth == 4)?"selected":"" ?>>APRIL</option>
                                                                    <option value=5 <?= ($ed->frommonth == 5)?"selected":"" ?>>MAY</option>
                                                                    <option value=6 <?= ($ed->frommonth == 6)?"selected":"" ?>>JUNE</option>
                                                                    <option value=7 <?= ($ed->frommonth == 7)?"selected":"" ?>>JULY</option>
                                                                    <option value=8 <?= ($ed->frommonth == 8)?"selected":"" ?>>AUGUST</option>
                                                                    <option value=9 <?= ($ed->frommonth == 9)?"selected":"" ?>>SEPTEMBER</option>
                                                                    <option value=10 <?= ($ed->frommonth == 10)?"selected":"" ?>>OCTOBER</option>
                                                                    <option value=11 <?= ($ed->frommonth == 11)?"selected":"" ?>>NOVEMBER</option>
                                                                    <option value=12 <?= ($ed->frommonth == 12)?"selected":"" ?>>DECEMBER</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <select name="fromyear" class="form-control" id="">
                                                                    <option value="0">YEAR</option>
                                                                    <?php
                                                                    for($initYear = 1920; $initYear < date('Y'); $initYear++)
                                                                    {
                                                                        ?>
                                                                        <option value="<?= $initYear ?>" <?=($ed->fromyear == $initYear)?"selected":""?>><?= $initYear ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <small>To</small>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select name="tomonth" id="tomonth" class="form-control">
                                                                    <option value=0 <?= ($ed->tomonth == 0)?"selected":"" ?>>MONTH</option>
                                                                    <option value=1 <?= ($ed->tomonth == 1)?"selected":"" ?> >JANUARY</option>
                                                                    <option value=2 <?= ($ed->tomonth == 2)?"selected":"" ?>>FEBRUARY</option>
                                                                    <option value=3 <?= ($ed->tomonth == 3)?"selected":"" ?>>MARCH</option>
                                                                    <option value=4 <?= ($ed->tomonth == 4)?"selected":"" ?>>APRIL</option>
                                                                    <option value=5 <?= ($ed->tomonth == 5)?"selected":"" ?>>MAY</option>
                                                                    <option value=6 <?= ($ed->tomonth == 6)?"selected":"" ?>>JUNE</option>
                                                                    <option value=7 <?= ($ed->tomonth == 7)?"selected":"" ?>>JULY</option>
                                                                    <option value=8 <?= ($ed->tomonth == 8)?"selected":"" ?>>AUGUST</option>
                                                                    <option value=9 <?= ($ed->tomonth == 9)?"selected":"" ?>>SEPTEMBER</option>
                                                                    <option value=10 <?= ($ed->tomonth == 10)?"selected":"" ?>>OCTOBER</option>
                                                                    <option value=11 <?= ($ed->tomonth == 11)?"selected":"" ?>>NOVEMBER</option>
                                                                    <option value=12 <?= ($ed->tomonth == 12)?"selected":"" ?>>DECEMBER</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <select name="toyear" class="form-control" id="">
                                                                    <option value="0">YEAR</option>
                                                                    <?php
                                                                    for($initYear = 1920; $initYear < date('Y'); $initYear++)
                                                                    {
                                                                        ?>
                                                                        <option value="<?= $initYear ?>" <?=($ed->toyear == $initYear)?"selected":""?>><?= $initYear ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </select>
                                                            </div>

                                                        </div>

                                                        <label for="">Remarks / <small>(ex. Graduated, Currently Studying, others.)</small></label>
                                                        <input type="text" name="remarks" class="form-control" value="<?=$ed->remarks?>"/>

                                                        <div id = 'higheredu' style="visibility:
                                                        <?php
                                                            if($ed->edulevel == "vocational" || $ed->edulevel == "college" || $ed->edulevel == "masters" || $ed->edulevel == "doctor" )
                                                                echo 'visible';
                                                            else
                                                                echo 'hidden';
                                                        ?>
                                                        ;">
                                                            <label for="">Course</label>
                                                            <input type="text" name="coursename" class="form-control" value="<?= $ed->coursename ?>"/>

                                                            <label for="">Earned Units</label>
                                                            <input type="text" name="unitscompleted" class="form-control input-small" value="<?= $ed->unitscompleted ?>"/>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" >Update</button>
                                                    </div>
                                                    </form>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                        </div>

                                        <!--end of update educ record-->

                                        <!--remove educ record-->
                                        <div class="modal fade" id="deleteeduhistory<?= $ed->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog" style="text-align: left;">
                                                <div class="modal-content">

                                                    <?= form_open_multipart("pds/deleteeducrecord") ?>

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title"><span class="fa fa-graduation-cap"></span> Confirm Delete</h4>

                                                    </div>
                                                    <div class="modal-body">

                                                        <input type="hidden" name="edurecordndex" value="<?= $ed->ndex ?>"/>
                                                        <input type="hidden" name="misid" value="<?=$mem_id ?>"/>

                                                        <h4><strong><?= $ed->schoolname ?></strong></h4>
                                                        <p> Course : <strong><?= $ed->coursename ?> </strong> <br/>
                                                            From <?= $ed->frommonth . ' ' . $ed->fromyear . ' To ' . $ed->tomonth . ' ' . $ed->toyear  ?> <br/>
                                                            Remarks: <?= $ed->remarks ?>
                                                        </p>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger" >Delete</button>
                                                    </div>
                                                    </form>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!- end of remove educ record -->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4><strong><?= $ed->schoolname ?></strong></h4>
                                        <p>From <?= $arrmonth[$ed->frommonth] . ' ' . $ed->fromyear . ' To ' . $arrmonth[$ed->tomonth] . ' ' . $ed->toyear  ?> <br/>
                                            Remarks: <?= $ed->remarks ?>
                                        </p>
                                    </td>

                                </tr>
                    <?php
                            }
                        }
                    }

                    ?>
                    </tbody>
                </table>
                <!-- end of elementary -->

                <!-- highschool -->
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <td " style="text-align: center;"> <strong>HIGHSCHOOL</strong> </td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(count($education) > 0)
                    {
                        foreach($education as $ed)
                        {
                            if($ed->edulevel == "highschool")
                            {
                                ?>
                                <tr>
                                    <td style="text-align: right;">
                                        <button class="btn btn-xs btn-primary"><span class="fa fa-pencil-square-o" data-toggle="modal" data-target="#updateducationhistory<?= $ed->ndex ?>"></span></button>
                                        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteeduhistory<?= $ed->ndex ?>"><span class="fa fa-trash-o"></span></button>

                                        <!--update educ record-->
                                        <div class="modal fade" id="updateducationhistory<?= $ed->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content" style="text-align: left;">

                                                    <?= form_open_multipart("pds/updateedu") ?>

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title"><span class="fa fa-graduation-cap"></span> Add Education History</h4>

                                                    </div>
                                                    <div class="modal-body">

                                                        <input type="hidden" name="memberndex" value="<?= $m['ndex'] ?>"/>
                                                        <input type="hidden" name="misid" value="<?=$mem_id ?>"/>
                                                        <input type="hidden" name="edundex" value="<?= $ed->ndex ?>"/>

                                                        <label for=""> Level</label>
                                                        <input type="text" name="upedulevel" readonly class="form-control input-small" value="<?= $ed->edulevel ?>"/>

                                                        <label for="">Name of School</label>
                                                        <input type="text" name="schoolname" class="form-control" required value="<?= $ed->schoolname ?>"/>

                                                        <label for="">School Year</label>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <small>From</small>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select name="frommonth" id="frommonth" class="form-control">
                                                                    <option value=0 <?= ($ed->frommonth == 0)?"selected":"" ?>>MONTH</option>
                                                                    <option value=1 <?= ($ed->frommonth == 1)?"selected":"" ?> >JANUARY</option>
                                                                    <option value=2 <?= ($ed->frommonth == 2)?"selected":"" ?>>FEBRUARY</option>
                                                                    <option value=3 <?= ($ed->frommonth == 3)?"selected":"" ?>>MARCH</option>
                                                                    <option value=4 <?= ($ed->frommonth == 4)?"selected":"" ?>>APRIL</option>
                                                                    <option value=5 <?= ($ed->frommonth == 5)?"selected":"" ?>>MAY</option>
                                                                    <option value=6 <?= ($ed->frommonth == 6)?"selected":"" ?>>JUNE</option>
                                                                    <option value=7 <?= ($ed->frommonth == 7)?"selected":"" ?>>JULY</option>
                                                                    <option value=8 <?= ($ed->frommonth == 8)?"selected":"" ?>>AUGUST</option>
                                                                    <option value=9 <?= ($ed->frommonth == 9)?"selected":"" ?>>SEPTEMBER</option>
                                                                    <option value=10 <?= ($ed->frommonth == 10)?"selected":"" ?>>OCTOBER</option>
                                                                    <option value=11 <?= ($ed->frommonth == 11)?"selected":"" ?>>NOVEMBER</option>
                                                                    <option value=12 <?= ($ed->frommonth == 12)?"selected":"" ?>>DECEMBER</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <select name="fromyear" class="form-control" id="">
                                                                    <option value="0">YEAR</option>
                                                                    <?php
                                                                    for($initYear = 1960; $initYear < date('Y'); $initYear++)
                                                                    {
                                                                        ?>
                                                                        <option value="<?= $initYear ?>" <?=($ed->fromyear == $initYear)?"selected":""?>><?= $initYear ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <small>To</small>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select name="tomonth" id="tomonth" class="form-control">
                                                                    <option value=0 <?= ($ed->tomonth == 0)?"selected":"" ?>>MONTH</option>
                                                                    <option value=1 <?= ($ed->tomonth == 1)?"selected":"" ?> >JANUARY</option>
                                                                    <option value=2 <?= ($ed->tomonth == 2)?"selected":"" ?>>FEBRUARY</option>
                                                                    <option value=3 <?= ($ed->tomonth == 3)?"selected":"" ?>>MARCH</option>
                                                                    <option value=4 <?= ($ed->tomonth == 4)?"selected":"" ?>>APRIL</option>
                                                                    <option value=5 <?= ($ed->tomonth == 5)?"selected":"" ?>>MAY</option>
                                                                    <option value=6 <?= ($ed->tomonth == 6)?"selected":"" ?>>JUNE</option>
                                                                    <option value=7 <?= ($ed->tomonth == 7)?"selected":"" ?>>JULY</option>
                                                                    <option value=8 <?= ($ed->tomonth == 8)?"selected":"" ?>>AUGUST</option>
                                                                    <option value=9 <?= ($ed->tomonth == 9)?"selected":"" ?>>SEPTEMBER</option>
                                                                    <option value=10 <?= ($ed->tomonth == 10)?"selected":"" ?>>OCTOBER</option>
                                                                    <option value=11 <?= ($ed->tomonth == 11)?"selected":"" ?>>NOVEMBER</option>
                                                                    <option value=12 <?= ($ed->tomonth == 12)?"selected":"" ?>>DECEMBER</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <select name="toyear" class="form-control" id="">
                                                                    <option value="0">YEAR</option>
                                                                    <?php
                                                                    for($initYear = 1960; $initYear < date('Y'); $initYear++)
                                                                    {
                                                                        ?>
                                                                        <option value="<?= $initYear ?>" <?=($ed->toyear == $initYear)?"selected":""?>><?= $initYear ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </select>
                                                            </div>

                                                        </div>

                                                        <label for="">Remarks / <small>(ex. Graduated, Currently Studying, others.)</small></label>
                                                        <input type="text" name="remarks" class="form-control" value="<?=$ed->remarks?>"/>

                                                        <div id = 'higheredu' style="visibility:
                                                        <?php
                                                        if($ed->edulevel == "vocational" || $ed->edulevel == "college" || $ed->edulevel == "masters" || $ed->edulevel == "doctor" )
                                                            echo 'visible';
                                                        else
                                                            echo 'hidden';
                                                        ?>
                                                            ;">
                                                            <label for="">Course</label>
                                                            <input type="text" name="coursename" class="form-control" value="<?= $ed->coursename ?>"/>

                                                            <label for="">Earned Units</label>
                                                            <input type="text" name="unitscompleted" class="form-control input-small" value="<?= $ed->unitscompleted ?>"/>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" >Update</button>
                                                    </div>
                                                    </form>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                        </div>

                                        <!--end of update educ record-->

                                        <!--remove educ record-->
                                        <div class="modal fade" id="deleteeduhistory<?= $ed->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog" style="text-align: left;">
                                                <div class="modal-content">

                                                    <?= form_open_multipart("pds/deleteeducrecord") ?>

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title"><span class="fa fa-graduation-cap"></span> Confirm Delete</h4>

                                                    </div>
                                                    <div class="modal-body">

                                                        <input type="hidden" name="edurecordndex" value="<?= $ed->ndex ?>"/>
                                                        <input type="hidden" name="misid" value="<?=$mem_id ?>"/>

                                                        <h4><strong><?= $ed->schoolname ?></strong></h4>
                                                        <p> Course : <strong><?= $ed->coursename ?> </strong> <br/>
                                                            From <?= $ed->frommonth . ' ' . $ed->fromyear . ' To ' . $ed->tomonth . ' ' . $ed->toyear  ?> <br/>
                                                            Remarks: <?= $ed->remarks ?>
                                                        </p>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger" >Delete</button>
                                                    </div>
                                                    </form>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!- end of remove educ record -->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4><strong><?= $ed->schoolname ?></strong></h4>
                                        <p>From <?= $arrmonth[$ed->frommonth] . ' ' . $ed->fromyear . ' To ' . $arrmonth[$ed->tomonth] . ' ' . $ed->toyear  ?> <br/>
                                            Remarks: <?= $ed->remarks ?>
                                        </p>
                                    </td>

                                </tr>
                            <?php
                            }
                        }
                    }

                    ?>
                    </tbody>
                </table>
                <!-- end of highschool -->

                <!-- vocational -->
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <td " style="text-align: center;"> <strong>VOCATIONAL</strong> </td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(count($education) > 0)
                    {
                        foreach($education as $ed)
                        {
                            if($ed->edulevel == "vocational")
                            {
                                ?>
                                <tr>
                                    <td style="text-align: right;">
                                        <button class="btn btn-xs btn-primary"><span class="fa fa-pencil-square-o" data-toggle="modal" data-target="#updateducationhistory<?= $ed->ndex ?>"></span></button>
                                        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteeduhistory<?= $ed->ndex ?>"><span class="fa fa-trash-o"></span></button>

                                        <!--update educ record-->
                                        <div class="modal fade" id="updateducationhistory<?= $ed->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content" style="text-align: left;">

                                                    <?= form_open_multipart("pds/updateedu") ?>

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title"><span class="fa fa-graduation-cap"></span> Add Education History</h4>

                                                    </div>
                                                    <div class="modal-body">

                                                        <input type="hidden" name="memberndex" value="<?= $m['ndex'] ?>"/>
                                                        <input type="hidden" name="misid" value="<?=$mem_id ?>"/>
                                                        <input type="hidden" name="edundex" value="<?= $ed->ndex ?>"/>

                                                        <label for=""> Level</label>
                                                        <input type="text" name="upedulevel" readonly class="form-control input-small" value="<?= $ed->edulevel ?>"/>

                                                        <label for="">Name of School</label>
                                                        <input type="text" name="schoolname" class="form-control" required value="<?= $ed->schoolname ?>"/>

                                                        <label for="">School Year</label>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <small>From</small>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select name="frommonth" id="frommonth" class="form-control">
                                                                    <option value=0 <?= ($ed->frommonth == 0)?"selected":"" ?>>MONTH</option>
                                                                    <option value=1 <?= ($ed->frommonth == 1)?"selected":"" ?> >JANUARY</option>
                                                                    <option value=2 <?= ($ed->frommonth == 2)?"selected":"" ?>>FEBRUARY</option>
                                                                    <option value=3 <?= ($ed->frommonth == 3)?"selected":"" ?>>MARCH</option>
                                                                    <option value=4 <?= ($ed->frommonth == 4)?"selected":"" ?>>APRIL</option>
                                                                    <option value=5 <?= ($ed->frommonth == 5)?"selected":"" ?>>MAY</option>
                                                                    <option value=6 <?= ($ed->frommonth == 6)?"selected":"" ?>>JUNE</option>
                                                                    <option value=7 <?= ($ed->frommonth == 7)?"selected":"" ?>>JULY</option>
                                                                    <option value=8 <?= ($ed->frommonth == 8)?"selected":"" ?>>AUGUST</option>
                                                                    <option value=9 <?= ($ed->frommonth == 9)?"selected":"" ?>>SEPTEMBER</option>
                                                                    <option value=10 <?= ($ed->frommonth == 10)?"selected":"" ?>>OCTOBER</option>
                                                                    <option value=11 <?= ($ed->frommonth == 11)?"selected":"" ?>>NOVEMBER</option>
                                                                    <option value=12 <?= ($ed->frommonth == 12)?"selected":"" ?>>DECEMBER</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <select name="fromyear" class="form-control" id="">
                                                                    <option value="0">YEAR</option>
                                                                    <?php
                                                                    for($initYear = 1960; $initYear < date('Y'); $initYear++)
                                                                    {
                                                                        ?>
                                                                        <option value="<?= $initYear ?>" <?=($ed->fromyear == $initYear)?"selected":""?>><?= $initYear ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <small>To</small>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select name="tomonth" id="tomonth" class="form-control">
                                                                    <option value=0 <?= ($ed->tomonth == 0)?"selected":"" ?>>MONTH</option>
                                                                    <option value=1 <?= ($ed->tomonth == 1)?"selected":"" ?> >JANUARY</option>
                                                                    <option value=2 <?= ($ed->tomonth == 2)?"selected":"" ?>>FEBRUARY</option>
                                                                    <option value=3 <?= ($ed->tomonth == 3)?"selected":"" ?>>MARCH</option>
                                                                    <option value=4 <?= ($ed->tomonth == 4)?"selected":"" ?>>APRIL</option>
                                                                    <option value=5 <?= ($ed->tomonth == 5)?"selected":"" ?>>MAY</option>
                                                                    <option value=6 <?= ($ed->tomonth == 6)?"selected":"" ?>>JUNE</option>
                                                                    <option value=7 <?= ($ed->tomonth == 7)?"selected":"" ?>>JULY</option>
                                                                    <option value=8 <?= ($ed->tomonth == 8)?"selected":"" ?>>AUGUST</option>
                                                                    <option value=9 <?= ($ed->tomonth == 9)?"selected":"" ?>>SEPTEMBER</option>
                                                                    <option value=10 <?= ($ed->tomonth == 10)?"selected":"" ?>>OCTOBER</option>
                                                                    <option value=11 <?= ($ed->tomonth == 11)?"selected":"" ?>>NOVEMBER</option>
                                                                    <option value=12 <?= ($ed->tomonth == 12)?"selected":"" ?>>DECEMBER</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <select name="toyear" class="form-control" id="">
                                                                    <option value="0">YEAR</option>
                                                                    <?php
                                                                    for($initYear = 1960; $initYear < date('Y'); $initYear++)
                                                                    {
                                                                        ?>
                                                                        <option value="<?= $initYear ?>" <?=($ed->toyear == $initYear)?"selected":""?>><?= $initYear ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </select>
                                                            </div>

                                                        </div>

                                                        <label for="">Remarks / <small>(ex. Graduated, Currently Studying, others.)</small></label>
                                                        <input type="text" name="remarks" class="form-control" value="<?=$ed->remarks?>"/>

                                                        <div id = 'higheredu' style="visibility:
                                                        <?php
                                                        if($ed->edulevel == "vocational" || $ed->edulevel == "college" || $ed->edulevel == "masters" || $ed->edulevel == "doctor" )
                                                            echo 'visible';
                                                        else
                                                            echo 'hidden';
                                                        ?>
                                                            ;">
                                                            <label for="">Course</label>
                                                            <input type="text" name="coursename" class="form-control" value="<?= $ed->coursename ?>"/>

                                                            <label for="">Earned Units</label>
                                                            <input type="text" name="unitscompleted" class="form-control input-small" value="<?= $ed->unitscompleted ?>"/>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" >Update</button>
                                                    </div>
                                                    </form>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                        </div>

                                        <!--end of update educ record-->

                                        <!--remove educ record-->
                                        <div class="modal fade" id="deleteeduhistory<?= $ed->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog" style="text-align: left;">
                                                <div class="modal-content">

                                                    <?= form_open_multipart("pds/deleteeducrecord") ?>

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title"><span class="fa fa-graduation-cap"></span> Confirm Delete</h4>

                                                    </div>
                                                    <div class="modal-body">

                                                        <input type="hidden" name="edurecordndex" value="<?= $ed->ndex ?>"/>
                                                        <input type="hidden" name="misid" value="<?=$mem_id ?>"/>

                                                        <h4><strong><?= $ed->schoolname ?></strong></h4>
                                                        <p> Course : <strong><?= $ed->coursename ?> </strong> <br/>
                                                            From <?= $ed->frommonth . ' ' . $ed->fromyear . ' To ' . $ed->tomonth . ' ' . $ed->toyear  ?> <br/>
                                                            Remarks: <?= $ed->remarks ?>
                                                        </p>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger" >Delete</button>
                                                    </div>
                                                    </form>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!- end of remove educ record -->
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h4><strong><?= $ed->schoolname ?></strong></h4>
                                        <p> Course : <strong><?= $ed->coursename ?> </strong> <br/>
                                            From <?= $arrmonth[$ed->frommonth] . ' ' . $ed->fromyear . ' To ' . $arrmonth[$ed->tomonth] . ' ' . $ed->toyear  ?> <br/>
                                            Remarks: <?= $ed->remarks ?><br/>
                                            Earned Units: <?= $ed->unitscompleted ?>
                                        </p>
                                    </td>

                                </tr>
                            <?php
                            }
                        }
                    }

                    ?>
                    </tbody>
                </table>
                <!-- end of vocational -->

                <!-- college -->
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <td " style="text-align: center;"> <strong>COLLEGE</strong> </td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(count($education) > 0)
                    {
                        foreach($education as $ed)
                        {
                            if($ed->edulevel == "college")
                            {
                                ?>
                                <tr>
                                    <td style="text-align: right;">
                                        <button class="btn btn-xs btn-primary"><span class="fa fa-pencil-square-o" data-toggle="modal" data-target="#updateducationhistory<?= $ed->ndex ?>"></span></button>
                                        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteeduhistory<?= $ed->ndex ?>"><span class="fa fa-trash-o"></span></button>

                                        <!--update educ record-->
                                        <div class="modal fade" id="updateducationhistory<?= $ed->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content" style="text-align: left;">

                                                    <?= form_open_multipart("pds/updateedu") ?>

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title"><span class="fa fa-graduation-cap"></span> Add Education History</h4>

                                                    </div>
                                                    <div class="modal-body">

                                                        <input type="hidden" name="memberndex" value="<?= $m['ndex'] ?>"/>
                                                        <input type="hidden" name="misid" value="<?=$mem_id ?>"/>
                                                        <input type="hidden" name="edundex" value="<?= $ed->ndex ?>"/>

                                                        <label for=""> Level</label>
                                                        <input type="text" name="upedulevel" readonly class="form-control input-small" value="<?= $ed->edulevel ?>"/>

                                                        <label for="">Name of School</label>
                                                        <input type="text" name="schoolname" class="form-control" required value="<?= $ed->schoolname ?>"/>

                                                        <label for="">School Year</label>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <small>From</small>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select name="frommonth" id="frommonth" class="form-control">
                                                                    <option value=0 <?= ($ed->frommonth == 0)?"selected":"" ?>>MONTH</option>
                                                                    <option value=1 <?= ($ed->frommonth == 1)?"selected":"" ?> >JANUARY</option>
                                                                    <option value=2 <?= ($ed->frommonth == 2)?"selected":"" ?>>FEBRUARY</option>
                                                                    <option value=3 <?= ($ed->frommonth == 3)?"selected":"" ?>>MARCH</option>
                                                                    <option value=4 <?= ($ed->frommonth == 4)?"selected":"" ?>>APRIL</option>
                                                                    <option value=5 <?= ($ed->frommonth == 5)?"selected":"" ?>>MAY</option>
                                                                    <option value=6 <?= ($ed->frommonth == 6)?"selected":"" ?>>JUNE</option>
                                                                    <option value=7 <?= ($ed->frommonth == 7)?"selected":"" ?>>JULY</option>
                                                                    <option value=8 <?= ($ed->frommonth == 8)?"selected":"" ?>>AUGUST</option>
                                                                    <option value=9 <?= ($ed->frommonth == 9)?"selected":"" ?>>SEPTEMBER</option>
                                                                    <option value=10 <?= ($ed->frommonth == 10)?"selected":"" ?>>OCTOBER</option>
                                                                    <option value=11 <?= ($ed->frommonth == 11)?"selected":"" ?>>NOVEMBER</option>
                                                                    <option value=12 <?= ($ed->frommonth == 12)?"selected":"" ?>>DECEMBER</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <select name="fromyear" class="form-control" id="">
                                                                    <option value="0">YEAR</option>
                                                                    <?php
                                                                    for($initYear = 1960; $initYear < date('Y'); $initYear++)
                                                                    {
                                                                        ?>
                                                                        <option value="<?= $initYear ?>" <?=($ed->fromyear == $initYear)?"selected":""?>><?= $initYear ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <small>To</small>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select name="tomonth" id="tomonth" class="form-control">
                                                                    <option value=0 <?= ($ed->tomonth == 0)?"selected":"" ?>>MONTH</option>
                                                                    <option value=1 <?= ($ed->tomonth == 1)?"selected":"" ?> >JANUARY</option>
                                                                    <option value=2 <?= ($ed->tomonth == 2)?"selected":"" ?>>FEBRUARY</option>
                                                                    <option value=3 <?= ($ed->tomonth == 3)?"selected":"" ?>>MARCH</option>
                                                                    <option value=4 <?= ($ed->tomonth == 4)?"selected":"" ?>>APRIL</option>
                                                                    <option value=5 <?= ($ed->tomonth == 5)?"selected":"" ?>>MAY</option>
                                                                    <option value=6 <?= ($ed->tomonth == 6)?"selected":"" ?>>JUNE</option>
                                                                    <option value=7 <?= ($ed->tomonth == 7)?"selected":"" ?>>JULY</option>
                                                                    <option value=8 <?= ($ed->tomonth == 8)?"selected":"" ?>>AUGUST</option>
                                                                    <option value=9 <?= ($ed->tomonth == 9)?"selected":"" ?>>SEPTEMBER</option>
                                                                    <option value=10 <?= ($ed->tomonth == 10)?"selected":"" ?>>OCTOBER</option>
                                                                    <option value=11 <?= ($ed->tomonth == 11)?"selected":"" ?>>NOVEMBER</option>
                                                                    <option value=12 <?= ($ed->tomonth == 12)?"selected":"" ?>>DECEMBER</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <select name="toyear" class="form-control" id="">
                                                                    <option value="0">YEAR</option>
                                                                    <?php
                                                                    for($initYear = 1960; $initYear < date('Y'); $initYear++)
                                                                    {
                                                                        ?>
                                                                        <option value="<?= $initYear ?>" <?=($ed->toyear == $initYear)?"selected":""?>><?= $initYear ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </select>
                                                            </div>

                                                        </div>

                                                        <label for="">Remarks / <small>(ex. Graduated, Currently Studying, others.)</small></label>
                                                        <input type="text" name="remarks" class="form-control" value="<?=$ed->remarks?>"/>

                                                        <div id = 'higheredu' style="visibility:
                                                        <?php
                                                        if($ed->edulevel == "vocational" || $ed->edulevel == "college" || $ed->edulevel == "masters" || $ed->edulevel == "doctor" )
                                                            echo 'visible';
                                                        else
                                                            echo 'hidden';
                                                        ?>
                                                            ;">
                                                            <label for="">Course</label>
                                                            <input type="text" name="coursename" class="form-control" value="<?= $ed->coursename ?>"/>

                                                            <label for="">Earned Units</label>
                                                            <input type="text" name="unitscompleted" class="form-control input-small" value="<?= $ed->unitscompleted ?>"/>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" >Update</button>
                                                    </div>
                                                    </form>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                        </div>

                                        <!--end of update educ record-->

                                        <!--remove educ record-->
                                        <div class="modal fade" id="deleteeduhistory<?= $ed->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog" style="text-align: left;">
                                                <div class="modal-content">

                                                    <?= form_open_multipart("pds/deleteeducrecord") ?>

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title"><span class="fa fa-graduation-cap"></span> Confirm Delete</h4>

                                                    </div>
                                                    <div class="modal-body">

                                                        <input type="hidden" name="edurecordndex" value="<?= $ed->ndex ?>"/>
                                                        <input type="hidden" name="misid" value="<?=$mem_id ?>"/>

                                                        <h4><strong><?= $ed->schoolname ?></strong></h4>
                                                        <p> Course : <strong><?= $ed->coursename ?> </strong> <br/>
                                                            From <?= $ed->frommonth . ' ' . $ed->fromyear . ' To ' . $ed->tomonth . ' ' . $ed->toyear  ?> <br/>
                                                            Remarks: <?= $ed->remarks ?>
                                                        </p>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger" >Delete</button>
                                                    </div>
                                                    </form>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!- end of remove educ record -->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4><strong><?= $ed->schoolname ?></strong></h4>
                                        <p> Course : <strong><?= $ed->coursename ?> </strong> <br/>
                                            From <?= $arrmonth[$ed->frommonth] . ' ' . $ed->fromyear . ' To ' . $arrmonth[$ed->tomonth] . ' ' . $ed->toyear  ?> <br/>
                                            Remarks: <?= $ed->remarks ?><br/>
                                            Earned Units: <?= $ed->unitscompleted ?>
                                        </p>
                                    </td>

                                </tr>
                            <?php
                            }
                        }
                    }

                    ?>
                    </tbody>
                </table>
                <!-- end of college -->

                <!-- masters -->
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <td " style="text-align: center;"> <strong>MASTERAL</strong> </td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(count($education) > 0)
                    {
                        foreach($education as $ed)
                        {
                            if($ed->edulevel == "masters")
                            {
                                ?>
                                <tr>
                                    <td style="text-align: right;">
                                        <button class="btn btn-xs btn-primary"><span class="fa fa-pencil-square-o" data-toggle="modal" data-target="#updateducationhistory<?= $ed->ndex ?>"></span></button>
                                        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteeduhistory<?= $ed->ndex ?>"><span class="fa fa-trash-o"></span></button>

                                        <!--update educ record-->
                                        <div class="modal fade" id="updateducationhistory<?= $ed->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content" style="text-align: left;">

                                                    <?= form_open_multipart("pds/updateedu") ?>

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title"><span class="fa fa-graduation-cap"></span> Add Education History</h4>

                                                    </div>
                                                    <div class="modal-body">

                                                        <input type="hidden" name="memberndex" value="<?= $m['ndex'] ?>"/>
                                                        <input type="hidden" name="misid" value="<?=$mem_id ?>"/>
                                                        <input type="hidden" name="edundex" value="<?= $ed->ndex ?>"/>

                                                        <label for=""> Level</label>
                                                        <input type="text" name="upedulevel" readonly class="form-control input-small" value="<?= $ed->edulevel ?>"/>

                                                        <label for="">Name of School</label>
                                                        <input type="text" name="schoolname" class="form-control" required value="<?= $ed->schoolname ?>"/>

                                                        <label for="">School Year</label>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <small>From</small>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select name="frommonth" id="frommonth" class="form-control">
                                                                    <option value=0 <?= ($ed->frommonth == 0)?"selected":"" ?>>MONTH</option>
                                                                    <option value=1 <?= ($ed->frommonth == 1)?"selected":"" ?> >JANUARY</option>
                                                                    <option value=2 <?= ($ed->frommonth == 2)?"selected":"" ?>>FEBRUARY</option>
                                                                    <option value=3 <?= ($ed->frommonth == 3)?"selected":"" ?>>MARCH</option>
                                                                    <option value=4 <?= ($ed->frommonth == 4)?"selected":"" ?>>APRIL</option>
                                                                    <option value=5 <?= ($ed->frommonth == 5)?"selected":"" ?>>MAY</option>
                                                                    <option value=6 <?= ($ed->frommonth == 6)?"selected":"" ?>>JUNE</option>
                                                                    <option value=7 <?= ($ed->frommonth == 7)?"selected":"" ?>>JULY</option>
                                                                    <option value=8 <?= ($ed->frommonth == 8)?"selected":"" ?>>AUGUST</option>
                                                                    <option value=9 <?= ($ed->frommonth == 9)?"selected":"" ?>>SEPTEMBER</option>
                                                                    <option value=10 <?= ($ed->frommonth == 10)?"selected":"" ?>>OCTOBER</option>
                                                                    <option value=11 <?= ($ed->frommonth == 11)?"selected":"" ?>>NOVEMBER</option>
                                                                    <option value=12 <?= ($ed->frommonth == 12)?"selected":"" ?>>DECEMBER</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <select name="fromyear" class="form-control" id="">
                                                                    <option value="0">YEAR</option>
                                                                    <?php
                                                                    for($initYear = 1960; $initYear < date('Y'); $initYear++)
                                                                    {
                                                                        ?>
                                                                        <option value="<?= $initYear ?>" <?=($ed->fromyear == $initYear)?"selected":""?>><?= $initYear ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <small>To</small>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select name="tomonth" id="tomonth" class="form-control">
                                                                    <option value=0 <?= ($ed->tomonth == 0)?"selected":"" ?>>MONTH</option>
                                                                    <option value=1 <?= ($ed->tomonth == 1)?"selected":"" ?> >JANUARY</option>
                                                                    <option value=2 <?= ($ed->tomonth == 2)?"selected":"" ?>>FEBRUARY</option>
                                                                    <option value=3 <?= ($ed->tomonth == 3)?"selected":"" ?>>MARCH</option>
                                                                    <option value=4 <?= ($ed->tomonth == 4)?"selected":"" ?>>APRIL</option>
                                                                    <option value=5 <?= ($ed->tomonth == 5)?"selected":"" ?>>MAY</option>
                                                                    <option value=6 <?= ($ed->tomonth == 6)?"selected":"" ?>>JUNE</option>
                                                                    <option value=7 <?= ($ed->tomonth == 7)?"selected":"" ?>>JULY</option>
                                                                    <option value=8 <?= ($ed->tomonth == 8)?"selected":"" ?>>AUGUST</option>
                                                                    <option value=9 <?= ($ed->tomonth == 9)?"selected":"" ?>>SEPTEMBER</option>
                                                                    <option value=10 <?= ($ed->tomonth == 10)?"selected":"" ?>>OCTOBER</option>
                                                                    <option value=11 <?= ($ed->tomonth == 11)?"selected":"" ?>>NOVEMBER</option>
                                                                    <option value=12 <?= ($ed->tomonth == 12)?"selected":"" ?>>DECEMBER</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <select name="toyear" class="form-control" id="">
                                                                    <option value="0">YEAR</option>
                                                                    <?php
                                                                    for($initYear = 1960; $initYear < date('Y'); $initYear++)
                                                                    {
                                                                        ?>
                                                                        <option value="<?= $initYear ?>" <?=($ed->toyear == $initYear)?"selected":""?>><?= $initYear ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </select>
                                                            </div>

                                                        </div>

                                                        <label for="">Remarks / <small>(ex. Graduated, Currently Studying, others.)</small></label>
                                                        <input type="text" name="remarks" class="form-control" value="<?=$ed->remarks?>"/>

                                                        <div id = 'higheredu' style="visibility:
                                                        <?php
                                                        if($ed->edulevel == "vocational" || $ed->edulevel == "college" || $ed->edulevel == "masters" || $ed->edulevel == "doctor" )
                                                            echo 'visible';
                                                        else
                                                            echo 'hidden';
                                                        ?>
                                                            ;">
                                                            <label for="">Course</label>
                                                            <input type="text" name="coursename" class="form-control" value="<?= $ed->coursename ?>"/>

                                                            <label for="">Earned Units</label>
                                                            <input type="text" name="unitscompleted" class="form-control input-small" value="<?= $ed->unitscompleted ?>"/>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" >Update</button>
                                                    </div>
                                                    </form>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                        </div>

                                        <!--end of update educ record-->

                                        <!--remove educ record-->
                                        <div class="modal fade" id="deleteeduhistory<?= $ed->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog" style="text-align: left;">
                                                <div class="modal-content">

                                                    <?= form_open_multipart("pds/deleteeducrecord") ?>

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title"><span class="fa fa-graduation-cap"></span> Confirm Delete</h4>

                                                    </div>
                                                    <div class="modal-body">

                                                        <input type="hidden" name="edurecordndex" value="<?= $ed->ndex ?>"/>
                                                        <input type="hidden" name="misid" value="<?=$mem_id ?>"/>

                                                        <h4><strong><?= $ed->schoolname ?></strong></h4>
                                                        <p> Course : <strong><?= $ed->coursename ?> </strong> <br/>
                                                            From <?= $ed->frommonth . ' ' . $ed->fromyear . ' To ' . $ed->tomonth . ' ' . $ed->toyear  ?> <br/>
                                                            Remarks: <?= $ed->remarks ?>
                                                        </p>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger" >Delete</button>
                                                    </div>
                                                    </form>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!- end of remove educ record -->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4><strong><?= $ed->schoolname ?></strong></h4>
                                        <p> Course : <strong><?= $ed->coursename ?> </strong> <br/>
                                            From <?= $ed->frommonth . ' ' . $ed->fromyear . ' To ' . $ed->tomonth . ' ' . $ed->toyear  ?> <br/>
                                            Remarks: <?= $ed->remarks ?><br/>
                                            Earned Units: <?= $ed->unitscompleted ?>
                                        </p>
                                    </td>

                                </tr>
                            <?php
                            }
                        }
                    }

                    ?>
                    </tbody>
                </table>
                <!-- end of masters -->

                <!-- doctors -->
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <td  style="text-align: center;"> <strong>DOCTORS</strong> </td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(count($education) > 0)
                    {
                        foreach($education as $ed)
                        {
                            if($ed->edulevel == "doctor")
                            {
                                ?>
                                <tr>
                                    <td style="text-align: right;">
                                        <button class="btn btn-xs btn-primary"><span class="fa fa-pencil-square-o" data-toggle="modal" data-target="#updateducationhistory<?= $ed->ndex ?>"></span></button>
                                        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteeduhistory<?= $ed->ndex ?>"><span class="fa fa-trash-o"></span></button>

                                        <!--update educ record-->
                                        <div class="modal fade" id="updateducationhistory<?= $ed->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content" style="text-align: left;">

                                                    <?= form_open_multipart("pds/updateedu") ?>

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title"><span class="fa fa-graduation-cap"></span> Add Education History</h4>

                                                    </div>
                                                    <div class="modal-body">

                                                        <input type="hidden" name="memberndex" value="<?= $m['ndex'] ?>"/>
                                                        <input type="hidden" name="misid" value="<?=$mem_id ?>"/>
                                                        <input type="hidden" name="edundex" value="<?= $ed->ndex ?>"/>

                                                        <label for=""> Level</label>
                                                        <input type="text" name="upedulevel" readonly class="form-control input-small" value="<?= $ed->edulevel ?>"/>

                                                        <label for="">Name of School</label>
                                                        <input type="text" name="schoolname" class="form-control" required value="<?= $ed->schoolname ?>"/>

                                                        <label for="">School Year</label>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <small>From</small>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select name="frommonth" id="frommonth" class="form-control">
                                                                    <option value=0 <?= ($ed->frommonth == 0)?"selected":"" ?>>MONTH</option>
                                                                    <option value=1 <?= ($ed->frommonth == 1)?"selected":"" ?> >JANUARY</option>
                                                                    <option value=2 <?= ($ed->frommonth == 2)?"selected":"" ?>>FEBRUARY</option>
                                                                    <option value=3 <?= ($ed->frommonth == 3)?"selected":"" ?>>MARCH</option>
                                                                    <option value=4 <?= ($ed->frommonth == 4)?"selected":"" ?>>APRIL</option>
                                                                    <option value=5 <?= ($ed->frommonth == 5)?"selected":"" ?>>MAY</option>
                                                                    <option value=6 <?= ($ed->frommonth == 6)?"selected":"" ?>>JUNE</option>
                                                                    <option value=7 <?= ($ed->frommonth == 7)?"selected":"" ?>>JULY</option>
                                                                    <option value=8 <?= ($ed->frommonth == 8)?"selected":"" ?>>AUGUST</option>
                                                                    <option value=9 <?= ($ed->frommonth == 9)?"selected":"" ?>>SEPTEMBER</option>
                                                                    <option value=10 <?= ($ed->frommonth == 10)?"selected":"" ?>>OCTOBER</option>
                                                                    <option value=11 <?= ($ed->frommonth == 11)?"selected":"" ?>>NOVEMBER</option>
                                                                    <option value=12 <?= ($ed->frommonth == 12)?"selected":"" ?>>DECEMBER</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <select name="fromyear" class="form-control" id="">
                                                                    <option value="0">YEAR</option>
                                                                    <?php
                                                                    for($initYear = 1960; $initYear < date('Y'); $initYear++)
                                                                    {
                                                                        ?>
                                                                        <option value="<?= $initYear ?>" <?=($ed->fromyear == $initYear)?"selected":""?>><?= $initYear ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <small>To</small>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select name="tomonth" id="tomonth" class="form-control">
                                                                    <option value=0 <?= ($ed->tomonth == 0)?"selected":"" ?>>MONTH</option>
                                                                    <option value=1 <?= ($ed->tomonth == 1)?"selected":"" ?> >JANUARY</option>
                                                                    <option value=2 <?= ($ed->tomonth == 2)?"selected":"" ?>>FEBRUARY</option>
                                                                    <option value=3 <?= ($ed->tomonth == 3)?"selected":"" ?>>MARCH</option>
                                                                    <option value=4 <?= ($ed->tomonth == 4)?"selected":"" ?>>APRIL</option>
                                                                    <option value=5 <?= ($ed->tomonth == 5)?"selected":"" ?>>MAY</option>
                                                                    <option value=6 <?= ($ed->tomonth == 6)?"selected":"" ?>>JUNE</option>
                                                                    <option value=7 <?= ($ed->tomonth == 7)?"selected":"" ?>>JULY</option>
                                                                    <option value=8 <?= ($ed->tomonth == 8)?"selected":"" ?>>AUGUST</option>
                                                                    <option value=9 <?= ($ed->tomonth == 9)?"selected":"" ?>>SEPTEMBER</option>
                                                                    <option value=10 <?= ($ed->tomonth == 10)?"selected":"" ?>>OCTOBER</option>
                                                                    <option value=11 <?= ($ed->tomonth == 11)?"selected":"" ?>>NOVEMBER</option>
                                                                    <option value=12 <?= ($ed->tomonth == 12)?"selected":"" ?>>DECEMBER</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <select name="toyear" class="form-control" id="">
                                                                    <option value="0">YEAR</option>
                                                                    <?php
                                                                    for($initYear = 1960; $initYear < date('Y'); $initYear++)
                                                                    {
                                                                        ?>
                                                                        <option value="<?= $initYear ?>" <?=($ed->toyear == $initYear)?"selected":""?>><?= $initYear ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </select>
                                                            </div>

                                                        </div>

                                                        <label for="">Remarks / <small>(ex. Graduated, Currently Studying, others.)</small></label>
                                                        <input type="text" name="remarks" class="form-control" value="<?=$ed->remarks?>"/>

                                                        <div id = 'higheredu' style="visibility:
                                                        <?php
                                                        if($ed->edulevel == "vocational" || $ed->edulevel == "college" || $ed->edulevel == "masters" || $ed->edulevel == "doctor" )
                                                            echo 'visible';
                                                        else
                                                            echo 'hidden';
                                                        ?>
                                                            ;">
                                                            <label for="">Course</label>
                                                            <input type="text" name="coursename" class="form-control" value="<?= $ed->coursename ?>"/>

                                                            <label for="">Earned Units</label>
                                                            <input type="text" name="unitscompleted" class="form-control input-small" value="<?= $ed->unitscompleted ?>"/>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" >Update</button>
                                                    </div>
                                                    </form>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                        </div>

                                        <!--end of update educ record-->

                                        <!--remove educ record-->
                                        <div class="modal fade" id="deleteeduhistory<?= $ed->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog" style="text-align: left;">
                                                <div class="modal-content">

                                                    <?= form_open_multipart("pds/deleteeducrecord") ?>

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title"><span class="fa fa-graduation-cap"></span> Confirm Delete</h4>

                                                    </div>
                                                    <div class="modal-body">

                                                        <input type="hidden" name="edurecordndex" value="<?= $ed->ndex ?>"/>
                                                        <input type="hidden" name="misid" value="<?=$mem_id ?>"/>

                                                        <h4><strong><?= $ed->schoolname ?></strong></h4>
                                                        <p> Course : <strong><?= $ed->coursename ?> </strong> <br/>
                                                            From <?= $ed->frommonth . ' ' . $ed->fromyear . ' To ' . $ed->tomonth . ' ' . $ed->toyear  ?> <br/>
                                                            Remarks: <?= $ed->remarks ?>
                                                        </p>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger" >Delete</button>
                                                    </div>
                                                    </form>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!- end of remove educ record -->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4><strong><?= $ed->schoolname ?></strong></h4>
                                        <p> Course : <strong><?= $ed->coursename ?> </strong> <br/>
                                            From <?= $arrmonth[$ed->frommonth] . ' ' . $ed->fromyear . ' To ' . $arrmonth[$ed->tomonth] . ' ' . $ed->toyear  ?> <br/>
                                            Remarks: <?= $ed->remarks ?> <br/>
                                            Earned Units: <?= $ed->unitscompleted ?>
                                        </p>
                                    </td>

                                </tr>
                            <?php
                            }
                        }
                    }

                    ?>
                    </tbody>
                </table>
                <!-- end of masters -->

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

                        <div class="actions">
                            <a class="btn btn-circle btn-default" data-toggle="modal" data-target="#addworkexp">
                                <i class="fa fa-plus"></i> Add Work History</a>
                        </div>


                        <!--add workexp record-->
                        <div class="modal fade" id="addworkexp" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog" style="text-align: left;">
                                <div class="modal-content">

                                    <?= form_open_multipart("pds/addworkexp") ?>

                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title"><span class="fa fa-hospital-o"></span> Add Work Experience</h4>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" value="<?= $m['ndex'] ?>" name="memberId"/>
                                            <input type="hidden" name="misid" value="<?=$mem_id ?>"/>
                                            <label for=""> Company Name</label>
                                            <input type="text" class="form-control" name="department"/>
                                            <label for=""> Job Title / Position</label>
                                            <input type="text" class="form-control" name="position"/>
                                            <label for=""> Company Address</label>
                                            <input type="text" class="form-control" name="address"/>
                                            <label for=""> From</label>
                                            <input type="text" class="form-control  input-small date-picker" name="efrom"/>
                                            <label for=""> To</label>
                                            <input type="text" class="form-control  input-small date-picker" name="eto"/>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" >Save</button>
                                        </div>
                                    </form>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!- end of add workexp record -->

                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover">
                            <tbody>
                            <tr>
                                <td><strong>Company</strong></td>
                                <td><strong>Job Title</strong></td>
                                <td><strong>Address</strong></td>
                                <td><strong>From</strong></td>
                                <td><strong>To</strong></td>
                                <td><strong>Action</strong></td>
                            </tr>
                            <?php
                                if(count($workexp) > 0)
                                {
                                    foreach($workexp as $wrk)
                                    {
                            ?>
                                        <tr>
                                            <td><small><?= $wrk->department ?></small> </td>
                                            <td><small><?= $wrk->position ?></small></td>
                                            <td><small><?= $wrk->address ?></small></td>
                                            <td><small>
                                                <?php
                                                if($wrk->efrom != "1970-01-01")
                                                {
                                                    $newDate = date("m-d-Y", strtotime($wrk->efrom));
                                                    echo $newDate;
                                                }
                                                else
                                                {
                                                    echo "";
                                                }
                                                ?>
                                                </small>
                                            </td>
                                            <td><small>
                                                <?php
                                                if($wrk->eto != "1970-01-01")
                                                {
                                                    $newDate = date("m/d/Y", strtotime($wrk->eto));
                                                    echo $newDate;
                                                }
                                                else
                                                {
                                                    echo "";
                                                }
                                                ?>
                                                </small>
                                            </td>
                                            <td>
                                                <button class="btn btn-xs btn-primary"><span class="fa fa-pencil-square-o" data-toggle="modal" data-target="#updateworkexp<?= $wrk->ndex ?>"></span></button>
                                                <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteworkexp<?= $wrk->ndex ?>"><span class="fa fa-trash-o"></span></button>


                                                <!--update workexp record-->
                                                <div class="modal fade" id="updateworkexp<?= $wrk->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                                    <div class="modal-dialog" style="text-align: left;">
                                                        <div class="modal-content">

                                                            <?= form_open_multipart("pds/updateworkexp") ?>

                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <h4 class="modal-title"><span class="fa fa-hospital-o"></span> Update Work Experience</h4>

                                                            </div>
                                                            <div class="modal-body">

                                                                <input type="hidden" name="workndex" value="<?= $wrk->ndex ?>"/>
                                                                <input type="hidden" name="misid" value="<?=$mem_id ?>"/>
                                                                <input type="hidden" value="<?= $m['ndex'] ?>" name="memberId"/>

                                                                <label for=""> Company Name</label>
                                                                <input type="text" class="form-control" name="department" value="<?=  $wrk->department ?>"/>
                                                                <label for=""> Job Title / Position</label>
                                                                <input type="text" class="form-control" name="position" value="<?=  $wrk->position ?>"/>
                                                                <label for=""> Company Address</label>
                                                                <input type="text" class="form-control" name="address" value="<?=  $wrk->address ?>"/>

                                                                <?php
                                                                if($wrk->efrom != '0000-00-00')
                                                                {
                                                                    $newDateEfrom = date("m/d/Y", strtotime($wrk->efrom));
                                                                }
                                                                else
                                                                {
                                                                    $newDateEfrom = ' ';
                                                                }
                                                                ?>

                                                                <label for=""> From</label>
                                                                <input type="text" class="form-control  input-small date-picker" name="efrom" value="<?= $newDateEfrom ?>"/>


                                                                <?php
                                                                if($wrk->eto != '0000-00-00')
                                                                {
                                                                    $newDateEto = date("m/d/Y", strtotime($wrk->eto));

                                                                }
                                                                else
                                                                {
                                                                    $newDateEto = '';
                                                                }
                                                                ?>

                                                                <label for=""> To</label>
                                                                <input type="text" class="form-control  input-small date-picker" name="eto" value="<?= $newDateEto ?>"/>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary" >Update</button>
                                                            </div>
                                                            </form>

                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!- end of update workexp record -->


                                                <!--remove workexp record-->
                                                <div class="modal fade" id="deleteworkexp<?= $wrk->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                                    <div class="modal-dialog" style="text-align: left;">
                                                        <div class="modal-content">

                                                            <?= form_open_multipart("pds/deleteworkexp") ?>

                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <h4 class="modal-title"><span class="fa fa-hospital-o"></span> Confirm Delete</h4>

                                                            </div>
                                                            <div class="modal-body">

                                                                <input type="hidden" name="workndex" value="<?= $wrk->ndex ?>"/>
                                                                <input type="hidden" name="misid" value="<?=$mem_id ?>"/>


                                                                <table class="table table-striped table-bordered table-hover">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td><strong>Company</strong></td>
                                                                            <td><strong>Job Title</strong></td>
                                                                            <td><strong>Address</strong></td>
                                                                            <td><strong>From</strong></td>
                                                                            <td><strong>To</strong></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><small><?= $wrk->department ?></small> </td>
                                                                            <td><small><?= $wrk->position ?></small></td>
                                                                            <td><small><?= $wrk->address ?></small></td>
                                                                            <td><small>
                                                                                    <?php
                                                                                    if($wrk->efrom != "0000-00-00")
                                                                                    {
                                                                                        $newDate = date("m/d/Y", strtotime($wrk->efrom));
                                                                                        echo $newDate;
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo "";
                                                                                    }
                                                                                    ?>
                                                                                </small>
                                                                            </td>
                                                                            <td><small>
                                                                                    <?php
                                                                                    if($wrk->eto != "0000-00-00")
                                                                                    {
                                                                                        $newDate = date("m/d/Y", strtotime($wrk->eto));
                                                                                        echo $newDate;
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo "";
                                                                                    }
                                                                                    ?>
                                                                                </small>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger" >Delete</button>
                                                            </div>
                                                            </form>

                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!- end of remove workexp record -->
                                            </td>

                                        </tr>
                            <?php
                                    }
                                }
                                else
                                {
                            ?>
                                    <tr>
                                        <td colspan="5"> -no record-</td>
                                    </tr>
                            <?php
                                }
                            ?>

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
                                   Passport Information
                                </span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <?= form_open_multipart("pds/updatepds/".$mem_id ) ?>

                                <table class="table table-striped table-bordered table-hover">
                                    <tbody>
                                    <tr>
                                        <td colspan="2" style="text-align: center;"> <strong>PASSPORT AND VISA</strong>
                                           </td>
                                    </tr>

                                    <tr>
                                        <td width="20%"> <strong>Passport ID No.</strong> </td>
                                        <td width="80%"><input type="text" class="form-control input-medium" value="<?= $m['passportNo'] ?> " name="passportNo"/>  </td>
                                    </tr>

                                    <tr>
                                        <td width="20%"> <strong>Date Issued</strong> </td>
                                        <td width="80%">
                                            <input type="text" name ="passportDateIssued" class="form-control  input-small date-picker" value="<?php $passportDateIssued = $m['passportDateIssued']; $newDate = date("M d, Y", strtotime($passportDateIssued));   if($m['passportDateIssued'] != "0000-00-00"){ echo $newDate; } else { echo " " ; } ?>"/>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="20%"> <strong>Expiration Date</strong> </td>
                                        <td width="80%">
                                            <input type="text" name="passportExpiryDate" class="form-control  input-small date-picker" value="<?php $passportExpiryDate = $m['passportExpiryDate']; $newDate = date("M d, Y", strtotime($passportExpiryDate));   if($m['passportExpiryDate'] != "0000-00-00"){ echo $newDate; }  else { echo " " ; } ?>"/>
                                    </tr>
                                    <!---->d
                                    <!--<tr>-->
                                    <!--    <td width="20%"> <strong>Type of Visa</strong> </td>-->
                                    <!--    <td width="80%">  </td>-->
                                    <!--</tr>-->
                                    <!---->
                                    <!--<tr>-->
                                    <!--    <td width="20%"> <strong>Date Granted</strong> </td>-->
                                    <!--    <td width="80%">  </td>-->
                                    <!--</tr>-->
                                    <!---->
                                    <!---->
                                    <!--<tr>-->
                                    <!--    <td width="20%"> <strong>Valid Until</strong> </td  >-->
                                    <!--    <td width="80%">  </td>-->
                                    <!--</tr>-->
                                    <tr>
                                        <td colspan="2" style="text-align: right;">
                                            <button class="btn btn-primary" type="submit" value="updatepassport" name="btnupdatepassport"> Save Passport</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>

                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-plane font-blue"></i>
                                <span class="caption-subject bold font-purple-plum uppercase">
                                   Travel History
                                </span>
                            </div>

                            <div class="actions">
                                <a class="btn btn-circle btn-default" data-toggle="modal" data-target="#addtravel">
                                    <i class="fa fa-plus"></i> Add Travel History</a>
                            </div>


                            <div class="modal fade" id="addtravel" tabindex="-1" role="basic" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <?= form_open_multipart("pds/addtravel") ?>

                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title"><span class="fa fa-plane"></span> Add Travel History</h4>

                                        </div>
                                        <div class="modal-body">

                                            <input type="hidden" name="memberndex" value="<?= $m['ndex'] ?>"/>
                                            <input type="hidden" name="misid" value="<?=$mem_id ?>"/>

                                            <label for=""> From</label>
                                            <input type="text" name="dateFrom" class="form-control input-small date-picker" required  />

                                            <label for=""> To</label>
                                            <input type="text" name="dateTo" class="form-control input-small date-picker"/>

                                            <label for=""> Country</label>
                                            <input type="text" name="country" class="form-control"/>

                                            <label for=""> Purpose</label>
                                            <input type="text" name="purpose" class="form-control"/>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                        </form>

                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                        </div>
                        <div class="portlet-body">

                            <table class="table table-striped table-bordered table-hover">
                                <tbody>
                                <tr>
                                    <td><strong>From</strong></td>
                                    <td><strong>To</strong></td>
                                    <td><strong>Country</strong></td>
                                    <td><strong>Purpose</strong></td>
                                    <td><strong>Action</strong></td>
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
                                            <td>
                                                <button class="btn btn-sm btn-primary"><span class="fa fa-pencil-square-o" data-toggle="modal" data-target="#updatetravel<?= $trv->ndex ?>"></span></button>
                                                <button class="btn btn-sm btn-danger"><span class="fa fa-trash-o" data-target="#deletetravel<?= $trv->ndex ?>" data-toggle="modal"></span></button>

                                                <!--delete travel modal-->
                                                <div class="modal fade" id="deletetravel<?= $trv->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <?= form_open_multipart("pds/deletetravel") ?>

                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <h4 class="modal-title"><span class="fa fa-plane"></span> Confirm Delete Travel History</h4>

                                                            </div>
                                                            <div class="modal-body">

                                                                <input type="hidden" name="memberndex" value="<?= $m['ndex'] ?>"/>
                                                                <input type="hidden" name="misid" value="<?=$mem_id ?>"/>
                                                                <input type="hidden" name="travelid" value="<?= $trv->ndex ?>"/>

                                                                <table class="table table-striped table-bordered table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <td><strong>From</strong></td>
                                                                            <td><strong>To</strong></td>
                                                                            <td><strong>Country</strong></td>
                                                                            <td><strong>Purpose</strong></td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <?php $datetravelfrom = $trv->dateFrom ; $newDate = date("m/d/Y", strtotime($datetravelfrom));   if($newDate != "Jan 01, 1970"){ echo $newDate; } ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php $dateTravelTo = $trv->dateTo ; $newDate = date("m/d/Y", strtotime($dateTravelTo));   if($newDate != "Jan 01, 1970"){ echo $newDate; } ?>
                                                                        </td>
                                                                        <td><?= $trv->country ?></td>
                                                                        <td><?= $trv->purpose ?></td>
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </div>
                                                            </form>

                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- end of delete travel modal-->

                                                <!--update travel modal-->
                                                <div class="modal fade" id="updatetravel<?= $trv->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <?= form_open_multipart("pds/updatetravel") ?>

                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <h4 class="modal-title"><span class="fa fa-plane"></span> Update Travel History</h4>

                                                            </div>
                                                            <div class="modal-body">

                                                                <input type="hidden" name="memberndex" value="<?= $m['ndex'] ?>"/>
                                                                <input type="hidden" name="misid" value="<?=$mem_id ?>"/>
                                                                <input type="hidden" name="travelid" value="<?= $trv->ndex ?>"/>

                                                                <?php
                                                                if($trv->dateFrom != "0000-00-00")
                                                                {
                                                                    $dateFrom = date("m/d/Y", strtotime($trv->dateFrom));
                                                                }
                                                                else
                                                                {
                                                                    $dateFrom = "";
                                                                }
                                                                ?>
                                                                <label for=""> From</label>
                                                                <input type="text" name="dateFrom" class="form-control input-small date-picker" value="<?= $dateFrom ?>" required  />

                                                                <?php
                                                                if($trv->dateTo != "0000-00-00")
                                                                {
                                                                    $dateTo = date("m/d/Y", strtotime($trv->dateTo));
                                                                }
                                                                else
                                                                {
                                                                    $dateTo = "";
                                                                }
                                                                ?>
                                                                <label for=""> To</label>
                                                                <input type="text" name="dateTo" class="form-control input-small date-picker" value="<?= $dateTo ?>"/>

                                                                <label for=""> Country</label>
                                                                <input type="text" name="country" class="form-control" value="<?= $trv->country ?>"/>

                                                                <label for=""> Purpose</label>
                                                                <input type="text" name="purpose" class="form-control" value="<?= $trv->purpose ?>"/>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                            </div>
                                                            </form>

                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- end of update travel modal-->
                                            </td>
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
                        </div>
                    </div>



                </div>
            </div>

        </div>


        <!-- end of Travel History Tab -->


        <div class="tab-pane" id="otherinfo">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-plane font-blue"></i>
                                <span class="caption-subject bold font-purple-plum uppercase">
                                   Talent and Skills
                                </span>
                    </div>

                    <div class="actions">
                        <a class="btn btn-circle btn-default" data-toggle="modal" data-target="#addskill">
                            <i class="fa fa-plus"></i> Add Skills</a>
                    </div>

                    <div class="modal fade" id="addskill" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <?= form_open_multipart("pds/addskill") ?>

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title"><span class="fa fa-star"></span> Skills</h4>

                                </div>
                                <div class="modal-body">

                                    <input type="hidden" name="memberndex" value="<?= $m['ndex'] ?>"/>
                                    <input type="hidden" name="misid" value="<?=$mem_id ?>"/>

                                    <label for=""> Name of Skill</label>
                                    <input type="text" name="skillname" class="form-control"/>

                                    <label for="">Rating</label>
                                    <select name="score" id="score" class="form-control input-small">
                                        <option value=0>0</option>
                                        <?php
                                        for($ctr = 1; $ctr <= 5 ; $ctr++)
                                        {
                                        ?>
                                            <option value=<?=$ctr?>><?=$ctr?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>


                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                                </form>

                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                </div>
                <div class="portlet-body">

                    <table class="table table-striped table-bordered table-hover">
                        <tbody>
                        <tr>
                            <td><strong>Talent / Skills</strong></td>
                            <td><strong>Rating</strong></td>
                            <td><strong>Action</strong></td>
                        </tr>
                        <?php
                        if(count($skills)>0)
                        {
                            foreach($skills as $sk)
                            {
                        ?>
                                <tr>
                                    <td><?= $sk->skillname ?></td>
                                    <td>
                                        <?php
                                            for($ctr = 1; $ctr <= $sk->score; $ctr++)
                                            {
                        ?>
                                                <span class="fa fa-star"></span>
                        <?php
                                            }
                                        ?>

                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#updateskill<?= $sk->ndex ?>"><span class="fa fa-pencil-square-o"></span></button>
                                        <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteskill<?= $sk->ndex ?>"><span class="fa fa-trash-o"></span></button>

                                        <!--update skill modal -->
                                        <div class="modal fade" id="updateskill<?= $sk->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <?= form_open_multipart("pds/updateskill") ?>

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title"><span class="fa fa-star"></span> Skills</h4>

                                                    </div>
                                                    <div class="modal-body">

                                                        <input type="hidden" name="skillid" value="<?= $sk->ndex ?>"/>
                                                        <input type="hidden" name="misid" value="<?=$mem_id ?>"/>

                                                        <label for=""> Name of Skill</label>
                                                        <input type="text" name="skillname" class="form-control" value="<?= $sk->skillname ?>"/>

                                                        <label for="">Rating</label>
                                                        <select name="score" id="score" class="form-control input-small">
                                                            <option value=0>0</option>
                                                            <?php
                                                            for($ctr = 1; $ctr <= 5 ; $ctr++)
                                                            {
                                                                ?>
                                                                <option value=<?=$ctr?> <?= ($sk->score == $ctr)?" selected":"" ?>><?=$ctr?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Update Skill</button>
                                                    </div>
                                                    </form>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!--end of update skill modal -->

                                        <!--remove skill modal -->
                                        <div class="modal fade" id="deleteskill<?= $sk->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <?= form_open_multipart("pds/deleteskill") ?>

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title"><span class="fa fa-star"></span> Cofirm Delete Skill</h4>

                                                    </div>
                                                    <div class="modal-body">

                                                        <input type="hidden" name="skillid" value="<?= $sk->ndex ?>"/>
                                                        <input type="hidden" name="misid" value="<?=$mem_id ?>"/>

                                                        <table class="table table-striped table-bordered table-hover">
                                                            <tbody>
                                                                <tr>
                                                                    <td><strong>Talent / Skills</strong></td>
                                                                    <td><strong>Rating</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><?= $sk->skillname ?></td>
                                                                    <td>
                                                                        <?php
                                                                        for($ctr = 1; $ctr <= $sk->score; $ctr++)
                                                                        {
                                                                            ?>
                                                                            <span class="fa fa-star"></span>
                                                                        <?php
                                                                        }
                                                                        ?>

                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Delete Skill</button>
                                                    </div>
                                                    </form>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- end of remove skill modal -->
                                    </td>

                                </tr>
                        <?php
                            }
                        }
                        else
                        {
                        ?>
                            <tr>
                                <td colspan="3" style="text-align: center;">
                                    <p>-no record-</p>
                                </td>
                            </tr>
                        <?php
                        }

                        ?>


                        </tbody>
                    </table>
                </div>
            </div>

            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bulb font-blue"></i>
                            <span class="caption-subject bold font-purple-plum uppercase">
                               Legal Background
                            </span>
                    </div>
                </div>
                <div class="portlet-body">
                    <?= form_open_multipart("pds/updatepds/".$mem_id ) ?>
                        <table class="table table-striped table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>
                                        <label for="">Have you been convicted of any crime or violation of any law, decree ordinance or regulation by any court or tribunal?</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="convicted" id="convicted" class="form-control input-inline" onchange="legalchange(this, convictedDetails)">
                                            <option value=0 <?= ($m['convicted'] == 0)?" selected":"" ?>>NO</option>
                                            <option value=1 <?= ($m['convicted'] == 1)?" selected":"" ?>>YES</option>
                                        </select>
                                        <input type="text" value="<?= $m['convictedDetails'] ?>" class="form-control input-inline input-xlarge" id="convictedDetails" name="convictedDetails" <?= ($m['convicted'] == 0)?" readonly":"" ?>/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="">Do you have pending civil or criminal case(s)?</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="pendingCriminalCase" id="pendingCriminalCase" class="form-control input-inline" onchange="legalchange(this, pendingCriminalCaseDetails)">
                                            <option value=0 <?= ($m['pendingCriminalCase'] == 0)?" selected":"" ?>>NO</option>
                                            <option value=1 <?= ($m['pendingCriminalCase'] == 1)?" selected":"" ?>>YES</option>
                                        </select>
                                        <input type="text" value="<?= $m['pendingCriminalCaseDetails'] ?>" class="form-control input-inline input-xlarge" id="pendingCriminalCaseDetails" name="pendingCriminalCaseDetails" <?= ($m['pendingCriminalCase'] == 0)?" readonly":"" ?>/>
                                    </td>

                                </tr>

                                <tr>
                                    <td  style="text-align: right;">
                                        <button class="btn btn-primary" type="submit" name="btnupdatelegal" value="updatelegal">Update Legal Background</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>

            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-folder font-blue"></i>
                            <span class="caption-subject bold font-purple-plum uppercase">
                               Medical Background
                            </span>
                    </div>
                </div>
                <div class="portlet-body">
                    <?= form_open_multipart("pds/updatepds/".$mem_id ) ?>
                        <table class="table table-striped table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>
                                        <label for="">
                                            Have you ever been afflicted with a communicable/contagious/infectious diseases?
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="afflictedInfectious" id="afflictedInfectious" class="form-control input-inline" onchange="legalchange(this, afflictedInfectiousDetails)">
                                            <option value=0 <?= ($m['afflictedInfectious'] == 0)?" selected":"" ?>>NO</option>
                                            <option value=1 <?= ($m['afflictedInfectious'] == 1)?" selected":"" ?>>YES</option>
                                        </select>
                                        <input type="text" value="<?= $m['afflictedInfectiousDetails'] ?>" class="form-control input-inline input-xlarge" id="afflictedInfectiousDetails" name="afflictedInfectiousDetails" <?= ($m['afflictedInfectious'] == 0)?" readonly":"" ?>/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">
                                            Have you ever been afflicted with a dangerous physical or mental disorder?
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="afflictedMental" id="afflictedMental" class="form-control input-inline" onchange="mental(this, sufferingDetails)">
                                            <option value=0 <?= ($m['afflictedMental'] == 0)?" selected":"" ?>>NO</option>
                                            <option value=1 <?= ($m['afflictedMental'] == 1)?" selected":"" ?>>YES</option>
                                        </select>
                                        <input type="text" value="<?= $m['afflictedMentalDetails'] ?>" class="form-control input-inline input-xlarge" id="afflictedMentalDetails" name="afflictedMentalDetails" <?= ($m['afflictedMental'] == 0)?" readonly":"" ?>/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">
                                            Have you ever been a drug abuser or addict?
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="drugAbuser" id="drugAbuser" class="form-control input-inline" >
                                            <option value=0 <?= ($m['drugAbuser'] == 0)?" selected":"" ?>>NO</option>
                                            <option value=1 <?= ($m['drugAbuser'] == 1)?" selected":"" ?>>YES</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">
                                            Do you have traumatic experience(s) in the past?
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="traumaticExperience" id="traumaticExperience" class="form-control input-inline" onchange="legalchange(this, traumaticExperienceDetails)">
                                            <option value=0 <?= ($m['traumaticExperience'] == 0)?" selected":"" ?>>NO</option>
                                            <option value=1 <?= ($m['traumaticExperience'] == 1)?" selected":"" ?>>YES</option>
                                        </select>
                                        <input type="text" value="<?= $m['traumaticExperienceDetails'] ?>" class="form-control input-inline input-xlarge" id="afflictedMentalDetails" name="traumaticExperienceDetails" <?= ($m['traumaticExperience'] == 0)?" readonly":"" ?>/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">
                                            Have you been hospitalized?
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="hospitalized" id="hospitalized" class="form-control input-inline" onchange="fhospitalized()">
                                            <option value=0 <?= ($m['hospitalized'] == 0)?" selected":"" ?>>NO</option>
                                            <option value=1 <?= ($m['hospitalized'] == 1)?" selected":"" ?>>YES</option>
                                        </select>

                                        <?php $originalDate = $m['hospitalizedWhen'];

                                        if($originalDate != "0000-00-00")
                                        {
                                            $newDatehospwhen = date("m/d/Y", strtotime($originalDate));

                                        }
                                        else
                                        {
                                            $newDatehospwhen = "";
                                        }
                                        ?>

                                        <input type="text" id = "hospitalizedWhen" name = "hospitalizedWhen" class="form-control input-inline date-picker" value="<?= $newDatehospwhen ?>"  <?= ($m['hospitalized'] == 0)?" readonly":"" ?>/>
                                        <input type="text" value="<?= $m['hospitalizedWhy'] ?>" class="form-control input-inline input-xlarge" id="hospitalizedWhy" name="hospitalizedWhy" <?= ($m['hospitalized'] == 0)?" readonly":"" ?>/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">
                                            Are you presently suffering from any illness or disease?
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="suffering" id="suffering" class="form-control input-inline" onchange="legalchange(this, sufferingDetails)">
                                            <option value=0 <?= ($m['suffering'] == 0)?" selected":"" ?>>NO</option>
                                            <option value=1 <?= ($m['suffering'] == 1)?" selected":"" ?>>YES</option>
                                        </select>
                                        <input type="text" value="<?= $m['sufferingDetails'] ?>" class="form-control input-inline input-xlarge" id="sufferingDetails" name="sufferingDetails" <?= ($m['suffering'] == 0)?" readonly":"" ?>/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">
                                            Do you have physical defects?
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="physicalDefects" id="physicalDefects" class="form-control input-inline" onchange="phydefects()">
                                            <option value=0 <?= ($m['physicalDefects'] == 0)?" selected":"" ?>>NO</option>
                                            <option value=1 <?= ($m['physicalDefects'] == 1)?" selected":"" ?>>YES</option>
                                        </select>
                                        <input type="text" value="<?= $m['physicalDefectsDetails'] ?>" class="form-control input-inline input-xlarge" id="physicalDefectsDetails" name="physicalDefectsDetails" <?= ($m['physicalDefects'] == 0)?" readonly":"" ?>/>
                                    </td>
                                </tr>



                                <tr>
                                    <td  style="text-align: right;">
                                        <button class="btn btn-primary" type="submit" name="btnupdatemedical" value="updatemedical">Update Medical Background</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>


        </div>
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

