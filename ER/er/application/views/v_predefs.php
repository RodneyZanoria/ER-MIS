<?php
$arrcategory = array();
$arrklc = array();
$arrdept = array();
$arrmemstat = array();


$arrcountry = array();

foreach($country as $cntry)
{
    $arrcountry += array(
        0 => ' ',
    );
    $arrcountry += array(
        $cntry->ndex => $cntry->countryName
    );
}
?>


<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Manage Pre-define Values <small>MIS Predefine / Control Panel</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="index.html"><Control></Control> Panel</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Predefine</a>
                    <i class="fa fa-angle-right"></i>
                </li>
            </ul>
            <!--<div class="page-toolbar">-->
            <!--    <div class="btn-group pull-right">-->
            <!--        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">-->
            <!--            Actions <i class="fa fa-angle-down"></i>-->
            <!--        </button>-->
            <!--        -->
            <!--    </div>-->
            <!--</div>-->
        </div>
        <!-- END PAGE HEADER-->
        <div class="portlet light">
            <div class="portlet-body">

                <div class="row">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Settings.
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse">
                                </a>
                                <a href="#portlet-config" data-toggle="modal" class="config">
                                </a>
                                <a href="javascript:;" class="reload">
                                </a>
                                <a href="javascript:;" class="remove">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="panel-group accordion" id="accordion3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1">
                                                Ministry </a>
                                        </h4>
                                    </div>
                                    <div id="collapse_3_1" class="panel-collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <?= form_open_multipart("predefs/addministry") ?>
                                                <div class="col-md-4">
                                                    <h3>Ministry</h3>
                                                </div>
                                                <div class="col-md-6" style="text-align: right;">
                                                    <input name="ministryname" type="text" placeholder="Enter Ministry Name" class="form-control"/>
                                                </div>
                                                <div class="col-md-2" style="text-align: left;">
                                                    <button class="btn btn-primary btn-circle" type="submit"> <span class="fa fa-plus"></span> Add Ministry </button>
                                                </div>
                                                </form>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <hr/>
                                                    <table class="table table-striped table-bordered table-hover" id="sample_6">
                                                        <thead>
                                                        <tr>
                                                            <th><small>#</small></th>
                                                            <th><small>Ministry Name</small></th>
                                                            <th><small>Action</small></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        if(count($ministries)>0)
                                                        {
                                                            $ctr = 0;
                                                            foreach($ministries as $m)
                                                            {
                                                                $ctr++;
                                                                ?>
                                                                <tr>
                                                                    <td><?= $ctr ?></td>
                                                                    <td><?= $m->ministryname?></td>
                                                                    <td>

                                                                        <button class="btn btn-primary btn-circle" data-target="#updateministry<?= $m->ndex ?>" data-toggle="modal"><span class="fa fa-edit"></span></button>
                                                                        <button class="btn btn-danger btn-circle" data-target="#deleteministry<?= $m->ndex ?>" data-toggle="modal"><span class="fa fa-trash-o"></span></button>

                                                                        <!--update ministry modal-->
                                                                        <div class="modal fade" id="updateministry<?= $m->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                                                            <div class="modal-dialog" style="text-align: left;">
                                                                                <div class="modal-content">

                                                                                    <?= form_open_multipart("predefs/updateministry") ?>
                                                                                    <div class="modal-header">
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                                        <h4 class="modal-title"><span class="fa fa-user"></span> Update Ministry</h4>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <input type="hidden" value="<?= $m->ndex ?>" name="ministryndex"/>
                                                                                        <label for=""> Ministry Name</label>
                                                                                        <input  type="text" class="form-control" name="ministryname" value="<?= $m->ministryname ?>"/>
                                                                                        <p>Note: Be Careful when updating Pre-define Values. It will affect all users attached to it.</p>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button id="btnupdateministry" type="submit" class="btn btn-primary" >Update</button>
                                                                                    </div>
                                                                                    </form>
                                                                                </div>
                                                                                <!-- /.modal-content -->
                                                                            </div>
                                                                            <!-- /.modal-dialog -->
                                                                        </div>
                                                                        <!-- end of update ministry modal -->

                                                                        <!--delete ministry modal-->
                                                                        <div class="modal fade" id="deleteministry<?= $m->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                                                            <div class="modal-dialog" style="text-align: left;">
                                                                                <div class="modal-content">

                                                                                    <?= form_open_multipart("predefs/deleteministry") ?>
                                                                                    <div class="modal-header">
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                                        <h4 class="modal-title"><span class="fa fa-user"></span> Confirm Delete</h4>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <input type="hidden" value="<?= $m->ndex ?>" name="ministryndex"/>
                                                                                        <label for=""> Ministry Name</label>
                                                                                        <input type="text" class="form-control" name="ministryname" value="<?= $m->ministryname ?>" disabled/>
                                                                                        <p>Note: Be Careful when updating Pre-define Values. It will affect all users attached to it.</p>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button id="btndeleteministry" type="submit" class="btn btn-danger" >Delete!</button>
                                                                                    </div>
                                                                                    </form>
                                                                                </div>
                                                                                <!-- /.modal-content -->
                                                                            </div>
                                                                            <!-- /.modal-dialog -->
                                                                        </div>
                                                                        <!-- end of delete ministry modal -->

                                                                    </td>

                                                                </tr>
                                                            <?php
                                                            }
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
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

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#klc">
                                                KLCs </a>
                                        </h4>
                                    </div>
                                    <div id="klc" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="portlet light">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="icon-speech"></i>
                                                        <span class="caption-subject bold uppercase"> KLCs</span>
                                                        <span class="caption-helper">Kingdom Light Congregations</span>
                                                    </div>
                                                    <div class="actions">
                                                        <a href="#" class="btn btn-circle btn-default" data-target="#addklc" data-toggle="modal">
                                                            <i class="fa fa-plus"></i> Add </a>
                                                    </div>

                                                    <!--add KLC modal-->
                                                    <div class="modal fade" id="addklc" tabindex="-1" role="basic" aria-hidden="true">
                                                        <div class="modal-dialog" style="text-align: left;">
                                                            <div class="modal-content">

                                                                <?= form_open_multipart("predefs/addklc") ?>
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title"><span class="fa fa-user"></span> Add KLC </h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <label for=""> KLC Name</label>
                                                                    <input required  type="text" class="form-control" name="klcName"/>
                                                                    <label for=""> Address</label>
                                                                    <input  type="text" class="form-control" name="address"/>
                                                                    <label for=""> City</label>
                                                                    <input  type="text" class="form-control" name="city"/>
                                                                    <label for=""> State / Province</label>
                                                                    <input  type="text" class="form-control" name="stateprovince"/>
                                                                    <label for=""> Country</label>
                                                                    <select name="countryid" id="countryid" class="form-control">
                                                                        <option value=""> Select Country</option>
                                                                        <?php
                                                                            foreach($country as $c)
                                                                            {
                                                                        ?>
                                                                        <option value="<?= $c->ndex?>"> <?= $c->countryName?> </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button id="btnaddklc" type="submit" class="btn btn-primary" name="btnaddklc" value="addklc">Add KLC</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- end of add KLC modal -->

                                                </div>
                                                <div class="portlet-body">
                                                    <div class="col-md-12">
                                                        <table class="table table-striped table-bordered table-hover" id="predefklc">
                                                            <thead>
                                                            <tr>
                                                                <th><small>#</small></th>
                                                                <th><small>KLC Name</small></th>
                                                                <th><small>Address</small></th>
                                                                <th><small>City</small></th>
                                                                <th><small>State/Province</small></th>
                                                                <th><small>Country</small></th>
                                                                <th><small>Action</small></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            if(count($klcs)>0)
                                                            {
                                                                $ctr = 0;
                                                                foreach($klcs as $k)
                                                                {
                                                                    $ctr++;
                                                                    ?>
                                                                    <tr>
                                                                        <td><?= $ctr ?></td>
                                                                        <td><small><?= $k->klcName ?></small></td>
                                                                        <td><small><?= $k->address ?></small></td>
                                                                        <td><small><?= $k->city ?></small></td>
                                                                        <td><small><?= $k->stateprovince ?></small></td>
                                                                        <td><small><?= $arrcountry[$k->countryid] ?></small></td>
                                                                        <td>
                                                                            <button class="btn btn-xs btn-primary" data-target="#updateklc<?= $k->ndex ?>" data-toggle="modal">
                                                                                <span class="fa fa-edit" title="Edit KLC"></span>
                                                                            </button>

                                                                            <!--update KLC modal-->
                                                                            <div class="modal fade" id="updateklc<?= $k->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                                                                <div class="modal-dialog" style="text-align: left;">
                                                                                    <div class="modal-content">

                                                                                        <?= form_open_multipart("predefs/updateklc/".$k->ndex) ?>
                                                                                        <div class="modal-header">
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                                            <h4 class="modal-title"><span class="fa fa-user"></span> Update KLC </h4>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <label for=""> KLC Name</label>
                                                                                            <input required  type="text" class="form-control" name="klcName" value="<?= $k->klcName ?>"/>
                                                                                            <label for=""> Address</label>
                                                                                            <input  type="text" class="form-control" name="address" value="<?= $k->address ?>"/>
                                                                                            <label for=""> City</label>
                                                                                            <input  type="text" class="form-control" name="city" value="<?= $k->city ?>"/>
                                                                                            <label for=""> State / Province</label>
                                                                                            <input  type="text" class="form-control" name="stateprovince" value="<?= $k->stateprovince ?>"/>
                                                                                            <label for=""> Country</label>
                                                                                            <select name="countryid" id="countryid" class="form-control">
                                                                                                <option value=0 <?= ($k->countryid == 0)?" selected":"" ?>> Select Country</option>
                                                                                                <?php
                                                                                                foreach($country as $c)
                                                                                                {
                                                                                                    ?>
                                                                                                    <option value=<?= $c->ndex?> <?= ($c->ndex == $k->countryid)?" selected":"" ?> > <?= $c->countryName?> </option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button id="btnaddklc" type="submit" class="btn btn-primary" name="btnaddklc" value="addklc">Update KLC</button>
                                                                                        </div>
                                                                                        </form>
                                                                                    </div>
                                                                                    <!-- /.modal-content -->
                                                                                </div>
                                                                                <!-- /.modal-dialog -->
                                                                            </div>
                                                                            <!-- end of update KLC modal -->

                                                                        </td>

                                                                    </tr>
                                                                <?php
                                                                }
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
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
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#department">
                                                Departments</a>
                                        </h4>
                                    </div>
                                    <div id="department" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="portlet light">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="icon-speech"></i>
                                                        <span class="caption-subject bold uppercase"> Departments</span>
                                                        <span class="caption-helper">Kingdom Departments</span>
                                                    </div>
                                                    <div class="actions">
                                                        <a href="#" class="btn btn-circle btn-default" data-target="#add_dept" data-toggle="modal">
                                                            <i class="fa fa-plus"></i> Add New Department </a>
                                                    </div>

                                                    <!--add KLC modal-->
                                                    <div class="modal fade" id="add_dept" tabindex="-1" role="basic" aria-hidden="true">
                                                        <div class="modal-dialog" style="text-align: left;">
                                                            <div class="modal-content">

                                                                <?= form_open_multipart("predefs/addnewdepartment") ?>
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title"><span class="fa fa-user"></span> Add Department </h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <label for=""> Department Name</label>
                                                                    <input required  type="text" class="form-control" name="departmentname"/>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button id="btnadd_department" type="submit" class="btn btn-primary" name="btnadd_department" value="add_department">Add Department</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- end of add KLC modal -->

                                                </div>
                                                <div class="portlet-body">
                                                    <div class="col-md-12">
                                                        <table class="table table-striped table-bordered table-hover" id="departments">
                                                            <thead>
                                                            <tr>
                                                                <th><small>#</small></th>
                                                                <th><small>Department Name</small></th>
                                                                <th><small>Action</small></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            if(count($departments)>0)
                                                            {
                                                                $ctr = 0;
                                                                foreach($departments as $d)
                                                                {
                                                                    $ctr++;
                                                                    ?>
                                                                    <tr>
                                                                        <td><?= $ctr ?></td>
                                                                        <td><small><?= $d->departmentname ?></small></td>
                                                                        <td>
                                                                            <button class="btn btn-xs btn-primary" data-target="#updatedept<?= $d->id ?>" data-toggle="modal">
                                                                                <span class="fa fa-edit" title="Edit Department"></span>
                                                                            </button>

                                                                            <!--update department modal-->
                                                                            <div class="modal fade" id="updatedept<?= $d->id ?>" tabindex="-1" role="basic" aria-hidden="true">
                                                                                <div class="modal-dialog" style="text-align: left;">
                                                                                    <div class="modal-content">

                                                                                        <?= form_open_multipart("predefs/updatedepartment/") ?>
                                                                                        <div class="modal-header">
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                                            <h4 class="modal-title"><span class="fa fa-user"></span> Update KLC </h4>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <label for=""> KLC Name</label>
                                                                                            <input type="hidden" name="deptndex" value="<?= $d->id ?>"/>
                                                                                            <input required  type="text" class="form-control" name="departmentname" value="<?= $d->departmentname ?>"/>

                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button id="btneditdepartment" type="submit" class="btn btn-primary" name="btneditdepartment" value="editdepartment">Update Department</button>
                                                                                        </div>
                                                                                        </form>
                                                                                    </div>
                                                                                    <!-- /.modal-content -->
                                                                                </div>
                                                                                <!-- /.modal-dialog -->
                                                                            </div>
                                                                            <!-- end of update department modal -->

                                                                        </td>

                                                                    </tr>
                                                                <?php
                                                                }
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
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
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_4">
                                                Command Structure </a>
                                        </h4>
                                    </div>
                                    <div id="collapse_3_4" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            Command Structure
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
