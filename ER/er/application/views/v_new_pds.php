<?php
/**
 * Created by PhpStorm.
 * User: Jezriel
 * Date: 3/13/2015
 * Time: 10:08 AM
 */


$arrmembertypes = array();
$arrmemberstatuses = array();
$arrklc = array();
//$arrdept = array();



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
            <a href="#">New PDS
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
    </ul>
    <div class="page-toolbar">

    </div>
</div>


<div class="row">
    <div class="col-md-12 portlet light">
    <!-- Basic View of Profile -->
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8 ">
                    <h3 class="page-title" >New PDS Record</h3>
                    <p>Note: All fields are Required.</p>
               </div>
            </div>
            <!--end row-->
            <?= form_open_multipart("pds/newpds") ?>
                <div class="portlet-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">

                            <tbody>
                                <tr>
                                    <td width="20%"> <strong>Member Type</strong> </td>
                                    <td width="80%">
                                        <select name="membertype" id="newpdsmembertype" class="form-control input-large" required>
                                            <option value="0"></option>
                                            <option value="3"  <?= ($membertype == 3)?"selected":'' ?>>MEMBER</option>
                                            <option value="2" <?= ($membertype == 2)?"selected":'' ?>>PTMW</option>
                                            <option value="1" <?= ($membertype == 1)?"selected":'' ?>>FTMW</option>
                                            <option value="4" <?= ($membertype == 4)?"selected":'' ?>>GOEF</option>
                                            <option value="17" <?= ($membertype == 17)?"selected":'' ?>>GOE</option>
                                        </select>

                                </tr>
                                <tr>
                                    <td width="20%"> <strong>Date Baptized </strong> </td>
                                    <td width="80%"> <input id="newpdsdatebaptized" class="form-control form-control-inline input-large date-picker" type="text" name="waterBaptismDate" required value="<?= $waterBaptismDate ?>"/></td>
                                </tr>



                                <tr>
                                    <td width="20%"> <strong>Current KLC</strong> </td>
                                    <td width="80%">
                                        <select name="currentklc" id="" class="form-control input-large" required>
                                            <option value=""></option>
                                            <?php
                                            if(count($klcs) > 0)
                                            {
                                                foreach($klcs  as $klc)
                                                {
                                            ?>
                                                    <option value="<?= $klc->ndex ?>"  <?= ($klc->ndex == $currentklc)?"selected":'' ?>><?= $klc->klcName ?></option>

                                            <?php
                                                }
                                            }
                                            ?>

                                        </select>

                                </tr>

                                <tr>
                                    <td width="20%"> <strong>Date of Birth </strong> </td>
                                    <td width="80%"> <input class="form-control form-control-inline input-large date-picker" type="text" name="dateOfBirth" value="<?= $dateOfBirth ?>"/></td>
                                </tr>

                                <tr>
                                    <td width="20%"> <strong>Gender</strong> </td>
                                    <td width="80%">
                                        <select name="gender" id="" class="form-control input-large" required>
                                            <option value=""></option>
                                            <option value="Male" <?= ($gender == "Male")?'selected':''?>>MALE</option>
                                            <option value="Female" <?= ($gender == "Female")?'selected':''?>>FEMALE</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="20%"> <strong>Civil Status</strong> </td>
                                    <td width="80%">
                                        <select name="civilStatus" id="" class="form-control input-large" required>
                                            <option value=""></option>
                                            <option value="Single" <?= ($civilStatus == "Single")?'selected':''?>>Single</option>
                                            <option value="Married" <?= ($civilStatus == "Married")?'selected':''?>>Married</option>
                                            <option value="Single Parent" <?= ($civilStatus == "Single Parent")?'selected':''?>>Single Parent</option>
                                            <option value="Annulled" <?= ($civilStatus == "Annulled")?'selected':''?>>Annulled</option>
                                            <option value="Divorce" <?= ($civilStatus == "Divorce")?'selected':''?>>Divorce</option>
                                            <option value="Separated" <?= ($civilStatus == "Female")?'selected':''?>>Separated</option>
                                            <option value="Widowed" <?= ($civilStatus == "Widowed")?'selected':''?>>Widowed</option>

                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="20%"> <strong>Last Name</strong> </td>
                                    <td width="80%"> <input class="form-control" type="text" name="lastname"  required value="<?= $lastname ?>"/> </td>
                                </tr>

                                <tr>
                                    <td width="20%"> <strong>First Name</strong> </td>
                                    <td width="80%"> <input class="form-control" type="text" name="firstname"  required value="<?= $firstname ?>"/> </td>
                                </tr>

                                <tr>
                                    <td width="20%"> <strong>Middle Name</strong> </td>
                                    <td width="80%"> <input class="form-control" type="text" name="middlename" required value="<?= $middlename ?>"/> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php if(count($existingrecs) > 0)
                    {
                    ?>
                    <div>
                        <hr/>
                        <h3 style="color: #ff0000;"> <strong>A record with the same name was found Are you sure to add this Record?</strong></h3>
                        <hr/>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">

                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>KLC</th>
                                        <th>Member Type</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php

                                foreach($membertypes as $cat)
                                {
                                    $arrmembertypes += array(
                                        $cat->ndex => $cat->classification
                                    );
                                }

                                foreach($memberstatuses as $status)
                                {
                                    $arrmemberstatuses += array(
                                        $status->ndex => $status->statusname
                                    );
                                }


                                foreach($klcs as $klc)
                                {
                                    $arrklc += array(
                                        $klc->ndex => $klc->klcName
                                    );
                                }

                                foreach($existingrecs as $rec)
                                {

                                ?>
                                    <tr>
                                       <td><?= $rec->lastName . ", " . $rec->firstName . " " . $rec->middleName ?></td>
                                       <td><?= $arrklc[$rec->klc] ?></td>
                                       <td><?= $arrmembertypes[$rec->memberClass] ?></td>
                                       <td><?= ($rec->memberClass != 0)?$arrmemberstatuses[$rec->memberClass]:" " ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php } ?>
                    <hr/>

                    <div style="text-align: right;">
                        <?php if(count($existingrecs) > 0){ ?>
                            <button type="submit" class="btn btn-primary" name="btnForceSavePds" value="ForceSavePds">Yes. Please Save and Proceed </button>
                        <?php } else {?>
                            <button type="submit" class="btn btn-primary" name="btnAddNewPds" value="AddNewPds">Save and Proceed </button>
                        <?php } ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--end row-->
    <hr/>
    <div class="clearfix"></div>

    </div>
</div>





<div class="row">


</div>

</div>
<!-- END CONTENT -->

