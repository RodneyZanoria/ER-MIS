
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>KJCMIS PDS Encoding</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url() ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url() ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url() ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url() ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url() ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?= base_url() ?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url() ?>assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/global/plugins/clockface/css/clockface.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/global/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/global/plugins/typeahead/typeahead.css">

    <!-- BEGIN:File Upload Plugin CSS files-->
    <link href="<?= base_url() ?>assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
    <link href="<?= base_url() ?>assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
    <link href="<?= base_url() ?>assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>
    <!-- END:File Upload Plugin CSS files-->
    <!-- END PAGE LEVEL STYLES -->


    <!-- BEGIN THEME STYLES -->
    <link href="<?= base_url() ?>assets/global/css/components.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url() ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url() ?>assets/admin/layout2/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url() ?>assets/admin/layout2/css/themes/grey.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url() ?>assets/admin/layout2/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
    <link href="<?= base_url() ?>assets/animate.css" rel="stylesheet" type="text/css"/>

    <?php
    // $this->load->helper('url');
    // if(!$this->session->userdata('uid') )
    // {
    //     redirect("login/");
    // }

    $this->load->helper('url');
  	if(!$this->session->userdata('login') == true)
    {
        redirect("login/");
    }
    else {
      # code...
       if(!$this->session->userdata('email'))
       {
           redirect("login/beginlogout");
       }
    }
    if(!isset($activepage))
    {
        $activepage = "";
    }
    ?>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-boxed page-header-fixed page-container-bg-solid page-sidebar-closed-hide-logo ">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner container">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="<?= base_url() ?>">
                <img src="<?= base_url() ?>assets/admin/layout2/img/logo-default.png" alt="logo" class="logo-default"/>
            </a>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->

        <!-- BEGIN PAGE ACTIONS -->
        <!-- DOC: Remove "hide" class to enable the page header actions -->
        <div class="page-actions hide">
            <div class="btn-group">
                <button type="button" class="btn btn-circle red-pink dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-bar-chart"></i>&nbsp;<span class="hidden-sm hidden-xs">New&nbsp;</span>&nbsp;<i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="#">
                            <i class="icon-user"></i> New User </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-present"></i> New Event <span class="badge badge-success">4</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-basket"></i> New order </a>
                    </li>
                    <li class="divider">
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-flag"></i> Pending Orders <span class="badge badge-danger">4</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-users"></i> Pending Users <span class="badge badge-warning">12</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-circle green-haze dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-bell"></i>&nbsp;<span class="hidden-sm hidden-xs">Post&nbsp;</span>&nbsp;<i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="#">
                            <i class="icon-docs"></i> New Post </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-tag"></i> New Comment </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-share"></i> Share </a>
                    </li>
                    <li class="divider">
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-flag"></i> Comments <span class="badge badge-success">4</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-users"></i> Feedbacks <span class="badge badge-danger">2</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- END PAGE ACTIONS -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
            <!-- BEGIN HEADER SEARCH BOX -->
            <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
            <form class="search-form search-form-expanded" action="<?= base_url().'pds/look' ?>" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search..." name="query">
					<span class="input-group-btn">
					<a type="submit" class="btn submit"><i class="icon-magnifier"></i></a>
					</span>
                </div>
            </form>
            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">

                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <li class="dropdown dropdown-quick-sidebar-toggler hide">
                        <a href="javascript:;" class="dropdown-toggle">
                            <i class="icon-logout"></i>
                        </a>
                    </li>
                    <!-- END QUICK SIDEBAR TOGGLER -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown dropdown-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle hide1" src="<?= $this->session->userdata('profilepic')?>"/>
						<span class="username username-hide-on-mobile">
						<?= $this->session->userdata('firstname'). ' ' . $this->session->userdata('lastname')?> </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?= base_url()."pds/myaccount" ?>">
                                    <i class="icon-user"></i> My Account </a>
                            </li>

                            <li class="divider">
                            </li>
                            <li>
                                <a href="extra_lock.html">
                                    <i class="icon-lock"></i> Lock Screen </a>
                            </li>
                            <li>
                                <a href="<?= base_url()."login/beginlogout" ?>">
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<div class="container">
<!-- BEGIN CONTAINER -->
<div class="page-container">
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<div class="page-sidebar navbar-collapse collapse">
<!-- BEGIN SIDEBAR MENU -->
<ul class="page-sidebar-menu page-sidebar-menu-hover-submenu page-sidebar-menu-closed" data-auto-scroll="true" data-slide-speed="200">
<li class="start <?= ($activepage == 'dashboard')?' active open':'' ?>">
    <a href="<?= base_url() ?>">
        <i class="icon-home"></i>
        <span class="title">Dashboard</span>
        <?= ($activepage == 'dashboard')?'  <span class="selected"></span>  <span class="arrow open"></span>':''?>
    </a>
</li>

<li class="<?= ($activepage == 'newpds')?' active open':'' ?>">
    <a href="<?= base_url().'pds/newpds' ?>">
        <i class="icon-docs"></i>
        <span class="title">
            New PDS
        </span>
        <?= ($activepage == 'newpds')?'  <span class="selected"></span>  <span class="arrow open"></span>':''?>
    </a>
</li>
<!-- END FRONTEND THEME LINKS -->
<li  class="<?= ($activepage == 'updatepds')?' active open':'' ?>">
    <a href="javascript:;">
        <i class="icon-pencil"></i>
        <span class="title">Update Record</span>
        <?= ($activepage == 'updatepds')?'  <span class="selected"></span>  <span class="arrow open"></span>':''?>
    </a>

</li>
<li class="<?= ($activepage == 'myaccount')?' active open':'' ?>">
    <a href="<?= base_url()."pds/myaccount" ?>">
        <i class="icon-user"></i>
        <span class="title">My Account</span>
        <span class="arrow "></span>
        <?= ($activepage == 'myaccount')?'  <span class="selected"></span>  <span class="arrow open"></span>':''?>
    </a>
</li>


<li>
    <a href="<?= base_url()."login/beginlogout" ?>">
        <i class="icon-logout"></i>
        <span class="title">Logout</span>
    </a>

</li>
</ul>
<!-- END SIDEBAR MENU -->
</div>
</div>
<!-- END SIDEBAR -->


<?php $this->load->view($view); ?>
