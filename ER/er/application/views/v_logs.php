
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="index.html">Control Panel</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">User Logs</a>
                    <i class="fa fa-angle-right"></i>
                </li>
            </ul>
        </div>
        <!-- END PAGE HEADER-->
        <div class="portlet light">
            <div class="portlet-body">

                <div class="row">
                    <div class="col-md-3">
                        <h3>User Logs</h3>

                    </div>
                    <div class="col-md-9">

                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered table-hover" id="sample_6">
                            <thead>
                            <tr>
                                <th><small>#</small></th>
                                <th><small>Date and Time</small></th>
                                <th><small>IP Address</small></th>
                                <th><small>UID</small></th>
                                <th><small>User</small></th>
                                <th><small>Event</small></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(count($logs) > 0)
                            {
                                $ctr = 1;
                                foreach ($logs as $l) {
                                    ?>
                                    <tr>
                                        <td><small><?= $ctr++ ?></small></td>
                                        <td><small><?php
                                                $source = $l->datetime;
                                                $date = new DateTime($source);
                                                if($l->datetime != '0000-00-00 00:00:00')
                                                {
                                                    echo $date->format('m/d/Y h:i:s A');
                                                }
                                                ?>
                                            </small>
                                        </td>
                                        <td><small><?= $l->ipaddress ?></small></td>
                                        <td><small><?= $l->user ?></small></td>
                                        <td><small><?= $l->sessionusername ?></small></td>
                                        <td><small><?= $l->event ?></small></td>

                                    </tr>
                                <?php
                                }

                            }
                            else
                            {
                                ?>
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
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
<!-- END CONTENT -->
