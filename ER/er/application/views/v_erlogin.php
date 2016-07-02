<!DOCTYPE html>
<html lang="en">
<head>
    <title>Material Admin - Login</title>

    <!-- BEGIN META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="your,keywords">
    <meta name="description" content="Short explanation about this website">
    <!-- END META -->
    <?php $styleref = base_url()."assets/mtrl/"; ?>
    <!-- BEGIN STYLESHEETS -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
    <link type="text/css" rel="stylesheet" href="<?= $styleref ?>css/theme-default/bootstrap.css?1422792965" />
    <link type="text/css" rel="stylesheet" href="<?= $styleref ?>css/theme-default/materialadmin.css?1425466319" />
    <link type="text/css" rel="stylesheet" href="<?= $styleref ?>css/theme-default/font-awesome.min.css?1422529194" />
    <link type="text/css" rel="stylesheet" href="<?= $styleref ?>css/theme-default/material-design-iconic-font.min.css?1421434286" />
    <!-- END STYLESHEETS -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="<?= $styleref ?>js/libs/utils/html5shiv.js?1403934957"></script>
    <script type="text/javascript" src="<?= $styleref ?>js/libs/utils/respond.min.js?1403934956"></script>
    <![endif]-->
</head>
<body class="menubar-hoverable header-fixed ">

<!-- BEGIN LOGIN SECTION -->
<section class="section-account">
    <div class="img-backdrop" style="background-image: url('<?= $styleref ?>img/img16.jpg')"></div>
    <div class="spacer"></div>
    <div class="card contain-sm style-transparent">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2 col-sm-offset-1 text-right"></div>
                <div class="col-sm-6 col-sm-offset-1 text-right" style="text-align: center;">
                    <br><br>
                    <h3 class="text-light">
                        Evangelism Information System
                    </h3>
                    <br><br>
                    <p>
                        <a href="<?php echo $login_url;?>" class="btn btn-block btn-raised btn-info"><i class="fa fa-google pull-left"></i>Login with Authorized Email</a>
                    </p>
                </div><!--end .col -->
                <div class="col-sm-3 col-sm-offset-1 text-right"></div>
            </div><!--end .row -->
        </div><!--end .card-body -->
    </div><!--end .card -->
</section>
<!-- END LOGIN SECTION -->

<!-- BEGIN JAVASCRIPT -->
<script src="<?= $styleref ?>js/libs/jquery/jquery-1.11.2.min.js"></script>
<script src="<?= $styleref ?>js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
<script src="<?= $styleref ?>js/libs/bootstrap/bootstrap.min.js"></script>
<script src="<?= $styleref ?>js/libs/spin.js/spin.min.js"></script>
<script src="<?= $styleref ?>js/libs/autosize/jquery.autosize.min.js"></script>
<script src="<?= $styleref ?>js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
<script src="<?= $styleref ?>js/core/source/App.js"></script>
<script src="<?= $styleref ?>js/core/source/AppNavigation.js"></script>
<script src="<?= $styleref ?>js/core/source/AppOffcanvas.js"></script>
<script src="<?= $styleref ?>js/core/source/AppCard.js"></script>
<script src="<?= $styleref ?>js/core/source/AppForm.js"></script>
<script src="<?= $styleref ?>js/core/source/AppNavSearch.js"></script>
<script src="<?= $styleref ?>js/core/source/AppVendor.js"></script>
<script src="<?= $styleref ?>js/core/demo/Demo.js"></script>
<!-- END JAVASCRIPT -->

</body>
</html>
