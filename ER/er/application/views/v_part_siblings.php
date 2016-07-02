
        <?php
        $arrcategory = array();
        foreach($membercategory as $cat)
        {
            $arrcategory += array(
                $cat->ndex => $cat->classification
            );
        }

        ?>
        <!-- Appear only when there is a match sibling -->

        <?php
        if(count($loadedsiblings)>0)
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

                        foreach($loadedsiblings as $sib)
                        {
                            ?>
                            <tr>
                                <td>
                                    <small><?= $sib->lastName . ', ' . $sib->firstName . ' ' . $sib->middleName ?></small>
                                </td>

                                <td>
                                    <small><?= $arrcategory[$sib->memberClass] ?></small>
                                </td>

                                <td>
                                    <?php $this->load->helper('form'); ?>
                                    <?= form_open_multipart("pds/connectsibling/") ?>
                                        <input type="hidden" name="memberId" value="<?= $requester ?>"/>
                                        <input type="hidden" name="siblingId" value="<?= $sib->ndex ?>"/>
                                        <input type="hidden" name="encodername" value="<?= $this->session->userdata('lastname') . ', ' . $this->session->userdata('firstname') ?>">
                                        <button class="btn btn-sm btn-primary" type="submit"><small>Add To Sibling</small></button>
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
