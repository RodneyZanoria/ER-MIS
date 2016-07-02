<?php
/**
 * Created by PhpStorm.
 * User: jezrielbajan
 * Date: 4/3/15
 * Time: 10:29 PM
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

    foreach($members as $fruit)
    {
        ?>
        <tr>
            <td>
                <small><?= $fruit->lastName . ', ' . $fruit->firstName . ' ' . $fruit->middleName ?></small>
            </td>

            <td>
                <small><?= $arrcategory[$fruit->memberClass] ?></small>
            </td>

            <td>
                <?php $this->load->helper('form'); ?>
                <?= form_open_multipart("pds/connectfruit/") ?>
                <input type="hidden" name="memberId" value="<?= $requester ?>"/>
                <input type="hidden" name="fruitId" value="<?= $fruit->ndex ?>"/>
                <button class="btn btn-sm btn-primary" type="submit"><small>Add This Member</small></button>
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
