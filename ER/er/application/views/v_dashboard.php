<?php
/**
 * Created by PhpStorm.
 * User: Jezriel
 * Date: 4/20/2015
 * Time: 8:49 PM
 */

?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
<div class="page-content">



<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Dashboard <small>Personal Data Sheet Encoding</small>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="index.html">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
    </ul>
    <div class="page-toolbar">

    </div>
</div>
<!-- END PAGE HEADER-->
<div class="portlet light">
    <div class="portlet-body">

      <!-- stats -->
      <!-- BEGIN DASHBOARD STATS -->
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue-madison">
          <div class="visual">
            <i class="fa fa-comments"></i>
          </div>
          <div class="details">
            <div class="number">
               1349
            </div>
            <div class="desc">
              FTMW
            </div>
          </div>
          <a class="more" href="#">
          View more <i class="m-icon-swapright m-icon-white"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat red-intense">
          <div class="visual">
            <i class="fa fa-bar-chart-o"></i>
          </div>
          <div class="details">
            <div class="number">
               12,5M$
            </div>
            <div class="desc">
               PTMW
            </div>
          </div>
          <a class="more" href="#">
          View more <i class="m-icon-swapright m-icon-white"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green-haze">
          <div class="visual">
            <i class="fa fa-shopping-cart"></i>
          </div>
          <div class="details">
            <div class="number">
               549
            </div>
            <div class="desc">
               GOEF
            </div>
          </div>
          <a class="more" href="#">
          View more <i class="m-icon-swapright m-icon-white"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple-plum">
          <div class="visual">
            <i class="fa fa-globe"></i>
          </div>
          <div class="details">
            <div class="number">
               +89%
            </div>
            <div class="desc">
              MEMBERS
            </div>
          </div>
          <a class="more" href="#">
          View more <i class="m-icon-swapright m-icon-white"></i>
          </a>
        </div>
      </div>
    </div>
    <!-- END DASHBOARD STATS -->
      <!-- end of stats   -->

        <hr/>
        <div class="row">
            <div class="col-md-6">
                <div class="tiles" >
                    <div id="newpds" class="tile bg-blue" onclick="parent.location='<?= base_url().'pds/newpds' ?>'" >
                        <div class="tile-body">
                            <i class="fa fa-pencil-square-o"></i>
                        </div>
                        <div class="tile-object">
                            <div class="name">
                                New PDS
                            </div>
                            <div class="number">
                            </div>
                        </div>
                    </div>
                    <div class="tile bg-blue" data-target="#lookpds" data-toggle="modal">
                        <div class="tile-body">
                            <i class="fa fa-search"></i>
                        </div>
                        <div class="tile-object">
                            <div class="name">
                                PDS LookUp
                            </div>
                            <div class="number">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
            <!--<!-- BEGIN PORTLET-->
            <!--<div class="portlet">-->
            <!--    <div class="portlet-title line">-->
            <!--        <div class="caption">-->
            <!--            <i class="fa fa-comments"></i>Messages.-->
            <!--        </div>-->
            <!--        <div class="tools">-->
            <!--            <a href="" class="collapse">-->
            <!--            </a>-->
            <!--            <a href="#portlet-config" data-toggle="modal" class="config">-->
            <!--            </a>-->
            <!--            <a href="" class="reload">-->
            <!--            </a>-->
            <!--            <a href="" class="remove">-->
            <!--            </a>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="portlet-body" id="chats">-->
            <!--        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 435px;"><div class="scroller" style="overflow: hidden; width: auto; height: 435px;" data-always-visible="1" data-rail-visible1="1" data-initialized="1">-->
            <!--                <ul class="chats">-->
            <!--                    <li class="in">-->
            <!--                        <img class="avatar" alt="" src="../../assets/admin/layout/img/avatar1.jpg">-->
            <!--                        <div class="message">-->
            <!--                        <span class="arrow">-->
            <!--                        </span>-->
            <!--                            <a href="#" class="name">-->
            <!--                                Bob Nilson </a>-->
            <!--                        <span class="datetime">-->
            <!--                        at 20:09 </span>-->
            <!--                        <span class="body">-->
            <!--                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>-->
            <!--                        </div>-->
            <!--                    </li>-->
            <!--                    <li class="out">-->
            <!--                        <img class="avatar" alt="" src="../../assets/admin/layout/img/avatar2.jpg">-->
            <!--                        <div class="message">-->
            <!--                        <span class="arrow">-->
            <!--                        </span>-->
            <!--                            <a href="#" class="name">-->
            <!--                                Lisa Wong </a>-->
            <!--                        <span class="datetime">-->
            <!--                        at 20:11 </span>-->
            <!--                        <span class="body">-->
            <!--                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>-->
            <!--                        </div>-->
            <!--                    </li>-->
            <!--                    <li class="in">-->
            <!--                        <img class="avatar" alt="" src="../../assets/admin/layout/img/avatar1.jpg">-->
            <!--                        <div class="message">-->
            <!--                        <span class="arrow">-->
            <!--                        </span>-->
            <!--                            <a href="#" class="name">-->
            <!--                                Bob Nilson </a>-->
            <!--                        <span class="datetime">-->
            <!--                        at 20:30 </span>-->
            <!--                        <span class="body">-->
            <!--                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>-->
            <!--                        </div>-->
            <!--                    </li>-->
            <!--                    <li class="out">-->
            <!--                        <img class="avatar" alt="" src="../../assets/admin/layout/img/avatar3.jpg">-->
            <!--                        <div class="message">-->
            <!--                        <span class="arrow">-->
            <!--                        </span>-->
            <!--                            <a href="#" class="name">-->
            <!--                                Richard Doe </a>-->
            <!--                        <span class="datetime">-->
            <!--                        at 20:33 </span>-->
            <!--                        <span class="body">-->
            <!--                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>-->
            <!--                        </div>-->
            <!--                    </li>-->
            <!--                    <li class="in">-->
            <!--                        <img class="avatar" alt="" src="../../assets/admin/layout/img/avatar3.jpg">-->
            <!--                        <div class="message">-->
            <!--                        <span class="arrow">-->
            <!--                        </span>-->
            <!--                            <a href="#" class="name">-->
            <!--                                Richard Doe </a>-->
            <!--                        <span class="datetime">-->
            <!--                        at 20:35 </span>-->
            <!--                        <span class="body">-->
            <!--                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>-->
            <!--                        </div>-->
            <!--                    </li>-->
            <!--                    <li class="out">-->
            <!--                        <img class="avatar" alt="" src="../../assets/admin/layout/img/avatar1.jpg">-->
            <!--                        <div class="message">-->
            <!--                        <span class="arrow">-->
            <!--                        </span>-->
            <!--                            <a href="#" class="name">-->
            <!--                                Bob Nilson </a>-->
            <!--                        <span class="datetime">-->
            <!--                        at 20:40 </span>-->
            <!--                        <span class="body">-->
            <!--                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>-->
            <!--                        </div>-->
            <!--                    </li>-->
            <!--                    <li class="in">-->
            <!--                        <img class="avatar" alt="" src="../../assets/admin/layout/img/avatar3.jpg">-->
            <!--                        <div class="message">-->
            <!--                        <span class="arrow">-->
            <!--                        </span>-->
            <!--                            <a href="#" class="name">-->
            <!--                                Richard Doe </a>-->
            <!--                        <span class="datetime">-->
            <!--                        at 20:40 </span>-->
            <!--                        <span class="body">-->
            <!--                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>-->
            <!--                        </div>-->
            <!--                    </li>-->
            <!--                    <li class="out">-->
            <!--                        <img class="avatar" alt="" src="../../assets/admin/layout/img/avatar1.jpg">-->
            <!--                        <div class="message">-->
            <!--                        <span class="arrow">-->
            <!--                        </span>-->
            <!--                            <a href="#" class="name">-->
            <!--                                Bob Nilson </a>-->
            <!--                        <span class="datetime">-->
            <!--                        at 20:54 </span>-->
            <!--                        <span class="body">-->
            <!--                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. sed diam nonummy nibh euismod tincidunt ut laoreet. </span>-->
            <!--                        </div>-->
            <!--                    </li>-->
            <!--                </ul>-->
            <!--            </div><div class="slimScrollBar" style="width: 7px; position: absolute; opacity: 0.4; border-radius: 7px; z-index: 99; right: 1px; top: 152px; height: 283.270958083832px; display: block; background: rgb(187, 187, 187);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>-->
            <!--        <div class="chat-form">-->
            <!--            <div class="input-cont">-->
            <!--                <input class="form-control" type="text" placeholder="Type a message here...">-->
            <!--            </div>-->
            <!--            <div class="btn-cont">-->
            <!--                <span class="arrow">-->
            <!--                </span>-->
            <!--                <a href="" class="btn blue icn-only">-->
            <!--                    <i class="fa fa-check icon-white"></i>-->
            <!--                </a>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!-- END PORTLET-->

            </div>


            <!-- lookup modal -->
            <div class="modal fade" id="lookpds" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog" style="text-align: left;">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title"><span class="fa fa-user"></span> Look For PDS</h4>
                        </div>
                        <div class="modal-body">
                            <form class="search-form search-form-expanded" action="<?= base_url().'pds/look' ?>" method="POST">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search..." name="query">
                                <span class="input-group-btn">
                                <a type="submit" class="btn submit"><i class="icon-magnifier"></i></a>
                                </span>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">

                        </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!- end of lookup modal -->

        </div>
    </div>
</div>
</div>
</div>
<!-- END CONTENT -->
