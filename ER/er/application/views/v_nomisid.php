<?php
$arrcategory = array();
$arrklc = array();
$arrdept = array();
$arrmemstat = array();

foreach($membercategory as $cat)
{
    $arrcategory += array(
       0 => '-'
    );
    $arrcategory += array(
        $cat->ndex => $cat->classification
    );
}

foreach($klcs as $k)
{
    $arrklc += array(
        0 => ' - '
    );
    $arrklc += array(
        $k->ndex => $k->klcName
    );
}

foreach($memstatus as $stat)
{
    $arrmemstat += array(
       0 => '-',
    );
    $arrmemstat += array(
        $stat->ndex => $stat->statusname,
    );
}


?>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Generate Seeds <small>Member's withouth MISID / Control Panel</small>
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
                    <div class="col-md-10">
                        <h3>No Seeds / Total ( <?= count($nomisidsmember) ?> )</h3>
                    </div>
                    <div class="col-md-2" style="text-align: right;">
<!--                        <button class="btn btn-primary btn-circle" data-target="#addnewuser" data-toggle="modal"> <span class="fa fa-plus"></span> New User </button>-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                        <table class="table table-striped table-bordered table-hover" id="sample_6">
                            <thead>
                            <tr>
                                <th><small> #</small></th>
                                <th><small><span class="fa fa-user"></span> Member Information</small></th>
                                <th><small>Category</small></th>
                                <th><small>Status</small></th>
                                <th><small>KLC</small></th>
                                <th><small>Action</small></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(count($nomisidsmember)>0)
                            {
                                foreach ($nomisidsmember as $n) {
                                    if((strlen($n->misid) < 5) || empty($n->misid)){
                            ?>
                                <tr>
                                    <td><?= $n->ndex ?></td>
                                    <td><?= $n->lastName. ', ' . $n->firstName . ' '. $n->middleName ?></td>
                                    <td><?= $arrcategory[$n->memberClass] ?></td>
                                    <td><?= $arrmemstat[$n->memberStatus] ?></td>
                                    <td><?= $arrklc[$n->klc] ?></td>
                                    <td>
                                        <a href="<?= base_url()."pds/spawnmisid/".$n->ndex ?>" class="btn btn-primary" target="_blank"><span class="fa fa-lightbulb-o"></span> Spawn MISID</a>

                                    </td>
                                </tr>
                            <?php
                                }}
                            } else {
                            ?>

                            <?php
                            }
                            ?>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>

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
<!-- END CONTENT -->
