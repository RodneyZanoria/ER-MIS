
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Users <small>Manage Users / Control Panel</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="index.html">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Users</a>
                    <i class="fa fa-angle-right"></i>
                </li>
            </ul>

        </div>
        <!-- END PAGE HEADER-->
        <div class="portlet light">
            <div class="portlet-body">

                <div class="row">
                    <div class="col-md-10">
                        <h3>Manage PDS Users</h3>
                    </div>
                    <div class="col-md-2" style="text-align: right;">
                        <button class="btn btn-primary btn-circle" data-target="#addnewuser" data-toggle="modal"> <span class="fa fa-plus"></span> New User </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                        <table class="table table-striped table-bordered table-hover" id="sample_6">
                            <thead>
                            <tr>
                                <th><small><span class="fa fa-user"></span> User Information</small></th>
                                <th><small>Status</small></th>
                                <th><small>Date Created</small></th>
                                <th><small>Date Modified</small></th>
                                <th><small>Last Login</small></th>
                                <th><small>Action</small></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            if(count($userlist) > 0)
                            {
                                foreach($userlist as $u)
                                {
                            ?>
                                <tr>
                                    <td><strong><?= $u->lastName . ', ' . $u->firstName . ' ' . $u->middleName ?></strong> <br/> <?= $u->username ?> <br/> <?= $u->misid ?> </td>
                                    <td><small><?= ($u->status == 1)?'ACTIVE':'DEACTIVATED' ?></small></td>
                                    <td><small><?php if($u->dateCreated == '0000-00-00 00:00:00') { echo ' '; } else { $originalDate = $u->dateCreated; $newDate = date("M/d/Y h:i:s A", strtotime($originalDate));  echo $newDate; }?></small></td>
                                    <td><small><?php if($u->dateModified == '0000-00-00 00:00:00') { echo ' '; } else {  $originalDate = $u->dateModified; $newDate = date("M/d/Y h:i:s A", strtotime($originalDate));  echo $newDate; } ?></small></td>
                                    <td><small><?php if($u->dateLastLogin == '0000-00-00 00:00:00') { echo ' '; } else {  $originalDate = $u->dateLastLogin; $newDate = date("M/d/Y h:i:s A", strtotime($originalDate));  echo $newDate; } ?></small></td>
                                    <td>

                                        <input type="hidden" name="misid" value="<?= $u->misid ?>"/>
                                        <button title="Activate (PLAY) or Deactivate(STOP) user. " class="btn btn-xs btn-primary btn-circle <?= ($u->status==1)?'btn-danger':'btn-success' ?>" data-toggle="modal" data-target="<?= ($u->status==1)?'#deactivateuser'.$u->ndex:'#activateuser'.$u->ndex ?>"><span class="fa <?= ($u->status==1)?'fa-stop':'fa-play' ?>"></span></button>
                                        <button title="Change Password"  class=" btn-circle btn btn-xs btn-primary" data-toggle="modal" data-target="#updatepassword<?= $u->ndex ?>"><span class="fa fa-pencil-square-o"></span></button>
                                        <button title="Permanently Remove User." class = " btn-circle btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteuser<?=$u->ndex?>"><span class="fa fa-trash-o"></span></button>

                                        <!--activate user modal-->
                                        <div class="modal fade" id="activateuser<?= $u->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog" style="text-align: left;">
                                                <div class="modal-content">
s
                                                    <?= form_open_multipart("users/activateuser") ?>
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title"><span class="fa fa-user"></span> Confirm Activate</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="userndex" value="<?= $u->ndex ?>"/>
                                                        <h3>Are you sure you want to Activate this User?</h3>
                                                        <strong><?= $u->lastName . ', ' . $u->firstName . ' ' . $u->middleName ?></strong> <br/> <?= $u->username ?> <br/> <?= $u->misid ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button id="btnactivateuser" type="submit" class="btn btn-primary">Activate</button>
                                                    </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!- end of activate user modal -->

                                        <!--de-activate user modal-->
                                        <div class="modal fade" id="deactivateuser<?= $u->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog" style="text-align: left;">
                                                <div class="modal-content">

                                                    <?= form_open_multipart("users/deactivateuser") ?>
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title"><span class="fa fa-user"></span> Confirm Deactivate</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="userndex" value="<?= $u->ndex ?>"/>
                                                        <h3>Are you sure you want to Deactivate this User?</h3>
                                                        <strong><?= $u->lastName . ', ' . $u->firstName . ' ' . $u->middleName ?></strong> <br/> <?= $u->username ?> <br/> <?= $u->misid ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button id="btndeactivateuser" type="submit" class="btn btn-danger">Deactivate!</button>
                                                    </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!- end of de-activate user modal -->

                                        <!--confirm delete user-->
                                        <div class="modal fade" id="deleteuser<?= $u->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog" style="text-align: left;">
                                                <div class="modal-content">

                                                    <?= form_open_multipart("users/deleteuser") ?>
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title"><span class="fa fa-user"></span> Confirm Delete!</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="userndex" value="<?= $u->ndex ?>"/>
                                                        <h3>Are you sure you want to Permanently Delete this User? Action Cannot be Undone</h3>
                                                        <strong><?= $u->lastName . ', ' . $u->firstName . ' ' . $u->middleName ?></strong> <br/> <?= $u->username ?> <br/> <?= $u->misid ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button id="btndeactivateuser" type="submit" class="btn btn-danger">Remove Please!</button>
                                                    </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!- end of confirm delete modal -->


                                        <!--update password modal-->
                                        <div class="modal fade" id="updatepassword<?= $u->ndex ?>" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog" style="text-align: left;">
                                                <div class="modal-content">

                                                    <?= form_open_multipart("users/updatepw") ?>
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title"><span class="fa fa-user"></span> Update Password</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="userndex" value="<?= $u->ndex ?>">
                                                        <label for=""> KOJC Email ID</label>
                                                        <input id="updateemail" type="text" class="form-control" name="username" value="<?= $u->username ?>" required readonly/>
                                                        <span class="help-block" style="text-align: right">@kojc.net</span>
                                                        <label for=""> MIS ID</label>
                                                        <input id="updatemisid" type="text" class="form-control" name="misid" value="<?= $u->misid ?>" required readonly/>
                                                        <span class="help-block" style="text-align: right">MIS Unique Membership ID</span>
                                                        <label for=""> Password</label>
                                                        <input id="updateinputpassword<?= $u->ndex ?>" type="password" class="form-control"  name="password" required/>
                                                        <label for=""> Confirm Password</label>
                                                        <input id="updateconfirmpassword<?= $u->ndex ?>" type="password" class="form-control" name="confirmpassword" data required/>
                                                        <span class="help-block" style="text-align: right" id="updatepasswordnotif<?= $u->ndex ?>"></span>
                                                        <hr>
                                                        <div class="text-center">
                                                            <h4>Access Level</h4>
                                                        </div>
                                                        <input id="chkmis" type="checkbox" name="acc_mis" placeholder="MIS" <?= ($u->acc_mis)?" checked":" " ?>>
                                                        <label for="chkmis">MIS</label>
                                                        <input id="chkreportportal" type="checkbox" name="acc_rep" placeholder="MIS Reporting" <?= ($u->acc_rep)?" checked":" " ?>>
                                                        <label for="chkreportportal">Reporting Portal</label>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button id="btnupdatepassword<?= $u->ndex ?>" type="submit" class="btn btn-primary" disabled>Update Password</button>
                                                    </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!- end of updatepassword -->



                                    </td>
                                </tr>
                            <?php
                                }
                            }
                            else
                            {
                            ?>
                                <tr>
                                    <td colspan="6"> no users </td>
                                </tr>
                            <?php
                            }
                            ?>

                            </tbody>
                        </table>

                        <!--add user modal-->
                        <div class="modal fade" id="addnewuser" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog" style="text-align: left;">
                                <div class="modal-content">

                                    <?= form_open_multipart("users/newuser") ?>
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title"><span class="fa fa-user"></span> Add New User</h4>
                                    </div>
                                    <div class="modal-body">
                                        <label for=""> KOJC Email ID</label>
                                        <input id="email" type="text" class="form-control" name="username" required/>
                                        <span class="help-block" style="text-align: right">@kojc.net</span>
                                        <label for=""> MIS ID</label>
                                        <input id="misid" type="text" class="form-control" name="misid" required/>
                                        <span class="help-block" style="text-align: right">MIS Unique Membership ID</span>
                                        <label for=""> Password</label>
                                        <input id="inputpassword" type="password" class="form-control"  name="password" required/>
                                        <label for=""> Confirm Password</label>
                                        <input id="confirmpassword" type="password" class="form-control" name="confirmpassword" data required/>
                                        <span class="help-block" style="text-align: right" id="passwordnotif"></span>
                                        <hr>
                                        <div class="text-center">
                                            <h4>Access Level</h4>
                                        </div>
                                        <input id="chkmis" type="checkbox" name="acc_mis" placeholder="MIS" <?= ($u->acc_mis)?" checked":" " ?>>
                                        <label for="chkmis">MIS</label>
                                        <input id="chkreportportal" type="checkbox" name="acc_rep" placeholder="MIS Reporting" <?= ($u->acc_rep)?" checked":" " ?>>
                                        <label for="chkreportportal">Reporting Portal</label>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="btnadduser" type="submit" class="btn btn-primary" disabled>Add User</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!- end of add user record -->

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- END CONTENT -->
