
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
                    <a href="#">MyAccount</a>
                    <i class="fa fa-angle-right"></i>
                </li>
            </ul>
        </div>
        <!-- END PAGE HEADER-->
        <div class="portlet light">
            <div class="portlet-body">

                <div class="row">
                    <div class="col-md-3">
                        <h3>My Account</h3>
                    </div>
                    <div class="col-md-9">

                        <?php
                        if((isset($updateresult['status']) && $updateresult['status'] == 'ok') || (isset($updateresult['status']) && $updateresult['status'] == 'nok'))
                        {
                        ?>
                            <div class="<?= ($updateresult['status'] == 'ok')?'alert alert-success':'alert alert-warning' ?> alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                <strong><?=($updateresult['status'] == 'ok')?'Success!':'Oops!' ?></strong> <?= $updateresult['message'] ?>
                            </div>
                        <?php
                        }

                        ?>

                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-12">
                      <p>
                        Dear Users,
                      </p>
                        <p>
                          Starting April 1, 2016. All of your Accounts are being managed by KOJC Google Apps. To update your password or credential login, visit your google account using your official Kingdom Email. Thank you.
                        </p>
                        <p class="help-block">For concerns regarding your account. Please contact our MIS staff at KJCIT or send us an email at support@kojc.net</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
