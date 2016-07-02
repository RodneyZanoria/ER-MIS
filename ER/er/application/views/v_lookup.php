<?php
$arrcategory = array();
$arrklc = array();
$arrdept = array();
$arrmemstat = array();

foreach($membercategory as $cat)
{
    $arrcategory += array(
        0 => " - "
    );
    $arrcategory += array(
        $cat->ndex => $cat->classification
    );
}

foreach($klcs as $k)
{
    $arrklc += array(
        0  => "No KLC Please Update!!",
    );
    $arrklc += array(
        $k->ndex => $k->klcName
    );
}
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
                    <a href="#">Lookup</a>
                    <i class="fa fa-angle-right"></i>
                </li>
            </ul>
        </div>
        <!-- END PAGE HEADER-->
        <div class="portlet light">
            <div class="portlet-body">

                <div class="row">
                    <div class="col-md-3">
                        <h3>Search</h3>
                        <p>
                            <?php
                            if(isset($_GET['q']))
                            {
                                echo "Viewing Records of " . $_GET['q'];
                            }
                            ?>
                        </p>
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
                                <th><small>Trace #</small></th>
                                <th><small>Member Name</small></th>
                                <th><small>KLC</small></th>
                                <th><small>Type</small></th>
                                <th><small>Date Encoded</small></th>
                                <th><small>Date Updated</small></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(count($searchlist) > 0)
                            {
                                foreach ($searchlist as $s) {
                            ?>
                                    <tr>
                                        <td><small><?= $s->ndex ?></small></td>
                                        <td><small><a href="<?=base_url().'pds/profile/'.$s->misid ?>"><?= $s->lastName .', '. $s->firstName . ' ' . $s->middleName ?></a></small></td>
                                        <td><small><?= $arrklc[$s->klc] ?></small></td>
                                        <td><small><?= $arrcategory[$s->memberClass] ?></small></td>
                                        <td><small><?php
                                                $source = $s->datecreated;
                                                $date = new DateTime($source);
                                                echo $date->format('m/d/Y h:i:s A');
                                                 ?>
                                            </small></td>
                                        <td><small><?php
                                                $source = $s->dateupdated;
                                                $date = new DateTime($source);
                                                if($s->dateupdated != '0000-00-00 00:00:00')
                                                {
                                                    echo $date->format('m/d/Y h:i:s A');
                                                }
                                                 ?>
                                            </small></td>
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
