<?php
/**
 * Created by PhpStorm.
 * User: jezrielbajan
 * Date: 4/1/15
 * Time: 5:48 AM
 */

$arrcategory = array();
foreach($membercategory as $cat)
{
    $arrcategory += array(
        $cat->ndex => $cat->classification
    );
}

?>
<!-- Appear only when there is a match child -->

<?php
if(count($members)>0)
{
?>
<table class="table table-striped table-bordered table-hover" id="sample_1">
    <thead>
    <tr>
        <th><small>FULL NAME</small> </th>
        <th><small>MEMBER TYPE</small> </th>
        <th><small>ACTION</small></th>
    </tr>
    </thead>

    <tbody>

    <?php

    foreach($members as $child)
    {
        ?>
        <tr>
            <td>
                <small><?= $child->lastName . ', ' . $child->firstName . ' ' . $child->middleName ?></small>
            </td>

            <td>
                <small><?= $arrcategory[$child->memberClass] ?></small>
            </td>

            <td>
                <?php $this->load->helper('form'); ?>
                <?= form_open_multipart("pds/connectchild/") ?>
                <input type="hidden" name="memberId" value="<?= $requester ?>"/>
                <input type="hidden" name="childId" value="<?= $child->ndex ?>"/>

                <input type="hidden" name="encodername" value="<?= $this->session->userdata('lastname') . ', ' . $this->session->userdata('firstname') ?>">

                <button class="btn btn-sm btn-primary" type="submit"><small>Add To Children</small></button>
                </form>
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
            <td>no record found.. </td>
            <td></td>
        </tr>

    <?php

    }

    ?>

    </tbody>
</table>
