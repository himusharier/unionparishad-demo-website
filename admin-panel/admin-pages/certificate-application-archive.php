
<?php

$admin_id = $_SESSION["admin_user_id"];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if(isset($_POST['actionSwitch']) && isset($_POST['linkedForm']) && isset($_POST['certificateID']) && isset($_POST['certificateFormType'])){

        $certificateFormType = $_POST['certificateFormType'];
        $databaseTable = $certificateFormType.'_certificate_apply';

        $updateCertificateStatus = "UPDATE `$databaseTable` SET status = '{$_POST['actionSwitch']}', statusBy = '{$admin_id}' WHERE (linkedForm = '{$_POST['linkedForm']}' AND certificateID = '{$_POST['certificateID']}')";

        mysqli_query($db, $updateCertificateStatus);

    }

}



$sqlc = "SELECT * FROM character_certificate_apply WHERE (paymentStatus = 'Paid' AND status != 'Requested') ORDER BY id DESC";
$resultc = mysqli_query($db, $sqlc);
$countc = mysqli_num_rows($resultc);

$sqlu = "SELECT * FROM unmarried_certificate_apply WHERE (paymentStatus = 'Paid' AND status != 'Requested') ORDER BY id DESC";
$resultu = mysqli_query($db, $sqlu);
$countu = mysqli_num_rows($resultu);

$sqld = "SELECT * FROM death_certificate_apply WHERE (paymentStatus = 'Paid' AND status != 'Requested') ORDER BY id DESC";
$resultd = mysqli_query($db, $sqld);
$countd = mysqli_num_rows($resultd);

$sqlb = "SELECT * FROM burial_certificate_apply WHERE (paymentStatus = 'Paid' AND status != 'Requested') ORDER BY id DESC";
$resultb = mysqli_query($db, $sqlb);
$countb = mysqli_num_rows($resultb);

$sqll = "SELECT * FROM legacy_certificate_apply WHERE (paymentStatus = 'Paid' AND status != 'Requested') ORDER BY id DESC";
$resultl = mysqli_query($db, $sqll);
$countl = mysqli_num_rows($resultl);

$sqlr = "SELECT * FROM remarriage_certificate_apply WHERE (paymentStatus = 'Paid' AND status != 'Requested') ORDER BY id DESC";
$resultr = mysqli_query($db, $sqlr);
$countr = mysqli_num_rows($resultr);

$totalCounter = ($countc + $countu + $countd + $countb + $countl + $countr);
?>


<div class="dashboard-table-container">
    <p class="dashboard-table-container-heading">সনদপত্র আবেদন আর্কাইভঃ</p>


    <table class="responstable">
        <tbody>
        <?php

        if ($totalCounter > 0) {
            ?>
            <tr>
                <th class="table-display">সার্টিফিকেট নাম্বার</th>
                <th>সনদপত্রের ধরণ</th>
                <th>আবেদনের তারিখ / ধরণ</th>
                <th>আবেদনকারীর নাম</th>
                <th>অন্যান্য</th>
                <th>অ্যাকশন</th>
            </tr>
            <!-- ------------------------------------------ -->
            <?php
            while ($rowc = mysqli_fetch_array($resultc, MYSQLI_ASSOC)) {

                if ($rowc['status'] == "Approved") {
                    $statusDisply = "অনুমোদিত";
                    $textHilight = "";
                }
                if ($rowc['status'] == "Rejected") {
                    $statusDisply = "বাতিলকৃত";
                    $textHilight = "color: red;font-weight:bold;";
                }

                ?>
                <tr>
                    <td class="table-display" style="<?php echo $textHilight; ?>">
                        <?php
                        if ($rowc['paymentStatus'] == 'Paid') {
                            echo $rowc['certificateID'];
                        } else {
                            echo "---";
                        }
                        ?>
                    </td>
                    <td>চারিত্রিক সনদপত্র</td>
                    <td>
                        <?php
                        $bDate1=$rowc['applyDate'];
                        $format_bDate=date("d-m-Y",strtotime($bDate1));
                        echo "$format_bDate / ";
                        echo "$rowc[applyType]";
                        ?>
                    </td>
                    <td><?php echo $rowc['fullName']; ?></td>
                    <td>
                        <?php
                        if ($rowc['paymentStatus'] == 'Paid') {
                            echo "
<a class='table-display'><button class='view-window' data-formid='{$rowc['certificateID']}' data-formtype='character' style='cursor: pointer; color: #007CC7; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>দেখুন</button> |</a>
<button class='view-window' data-formid='{$rowc['certificateID']}' data-formtype='character' style='cursor: pointer; color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'><i class='fa fa-print'></i> প্রিন্ট করুন</button>";
                        } else {
                            echo "";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($rowc['paymentStatus'] == 'Paid') {
                            echo "
                        <form method='POST' enctype='multipart/form-data' onsubmit='LoaderShow()'>
                            <input type='hidden' name='linkedForm' value='{$rowc['linkedForm']}'>
                            <input type='hidden' name='certificateID' value='{$rowc['certificateID']}'>
                            <input type='hidden' name='certificateFormType' value='character'>
                            <select name='actionSwitch' onchange='this.form.submit()'>
                                <option value='{$rowc['status']}' hidden selected>{$statusDisply}</option>
                                <option value='Approved'><b>অনুমোদন দিন</b></option>
                                <option value='Rejected'>বাতিল করুন</option>
                            </select>
                        </form>
                        ";
                        } else {
                            echo "";
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>

            <!-- ------------------------------------------ -->
            <?php
            while ($rowu = mysqli_fetch_array($resultu, MYSQLI_ASSOC)) {

                if ($rowu['status'] == "Approved") {
                    $statusDisply = "অনুমোদিত";
                    $textHilight = "";
                }
                if ($rowu['status'] == "Rejected") {
                    $statusDisply = "বাতিলকৃত";
                    $textHilight = "color: red;font-weight:bold;";
                }

                ?>
                <tr>
                    <td class="table-display" style="<?php echo $textHilight; ?>">
                        <?php
                        if ($rowu['paymentStatus'] == 'Paid') {
                            echo $rowu['certificateID'];
                        } else {
                            echo "---";
                        }
                        ?>
                    </td>
                    <td>অবিবাহিত সনদপত্র</td>
                    <td>
                        <?php
                        $bDate1=$rowu['applyDate'];
                        $format_bDate=date("d-m-Y",strtotime($bDate1));
                        echo "$format_bDate / ";
                        echo "$rowu[applyType]";
                        ?>
                    </td>
                    <td><?php echo $rowu['fullName']; ?></td>
                    <td>
                        <?php
                        if ($rowu['paymentStatus'] == 'Paid') {
                            echo "
<a class='table-display'><button class='view-window' data-formid='{$rowu['certificateID']}' data-formtype='unmarried' style='cursor: pointer; color: #007CC7; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>দেখুন</button> |</a>
<button class='view-window' data-formid='{$rowu['certificateID']}' data-formtype='unmarried' style='cursor: pointer; color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'><i class='fa fa-print'></i> প্রিন্ট করুন</button>";
                        } else {
                            echo "";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($rowu['paymentStatus'] == 'Paid') {
                            echo "
                        <form method='POST' enctype='multipart/form-data' onsubmit='LoaderShow()'>
                            <input type='hidden' name='linkedForm' value='{$rowu['linkedForm']}'>
                            <input type='hidden' name='certificateID' value='{$rowu['certificateID']}'>
                            <input type='hidden' name='certificateFormType' value='unmarried'>
                            <select name='actionSwitch' onchange='this.form.submit()'>
                                <option value='{$rowu['status']}' hidden selected>{$statusDisply}</option>
                                <option value='Approved'><b>অনুমোদন দিন</b></option>
                                <option value='Rejected'>বাতিল করুন</option>
                            </select>
                        </form>
                        ";
                        } else {
                            echo "";
                        }
                        ?>
                    </td>
                </tr>
                </tr>
                <?php
            }
            ?>

            <!-- ------------------------------------------ -->
            <?php
            while ($rowd = mysqli_fetch_array($resultd, MYSQLI_ASSOC)) {

                if ($rowd['status'] == "Approved") {
                    $statusDisply = "অনুমোদিত";
                    $textHilight = "";
                }
                if ($rowd['status'] == "Rejected") {
                    $statusDisply = "বাতিলকৃত";
                    $textHilight = "color: red;font-weight:bold;";
                }

                ?>
                <tr>
                    <td class="table-display" style="<?php echo $textHilight; ?>">
                        <?php
                        if ($rowd['paymentStatus'] == 'Paid') {
                            echo $rowd['certificateID'];
                        } else {
                            echo "---";
                        }
                        ?>
                    </td>
                    <td>মৃত্যু তারিখের সনদপত্র</td>
                    <td>
                        <?php
                        $bDate1=$rowd['applyDate'];
                        $format_bDate=date("d-m-Y",strtotime($bDate1));
                        echo "$format_bDate / ";
                        echo "$rowd[applyType]";
                        ?>
                    </td>
                    <td><?php echo $rowd['fullName']; ?></td>
                    <td>
                        <?php
                        if ($rowd['paymentStatus'] == 'Paid') {
                            echo "
<a class='table-display'><button class='view-window' data-formid='{$rowd['certificateID']}' data-formtype='death' style='cursor: pointer; color: #007CC7; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>দেখুন</button> |</a>
<button class='view-window' data-formid='{$rowd['certificateID']}' data-formtype='death' style='cursor: pointer; color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'><i class='fa fa-print'></i> প্রিন্ট করুন</button>";
                        } else {
                            echo "";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($rowd['paymentStatus'] == 'Paid') {
                            echo "
                        <form method='POST' enctype='multipart/form-data' onsubmit='LoaderShow()'>
                            <input type='hidden' name='linkedForm' value='{$rowd['linkedForm']}'>
                            <input type='hidden' name='certificateID' value='{$rowd['certificateID']}'>
                            <input type='hidden' name='certificateFormType' value='death'>
                            <select name='actionSwitch' onchange='this.form.submit()'>
                                <option value='{$rowd['status']}' hidden selected>{$statusDisply}</option>
                                <option value='Approved'><b>অনুমোদন দিন</b></option>
                                <option value='Rejected'>বাতিল করুন</option>
                            </select>
                        </form>
                        ";
                        } else {
                            echo "";
                        }
                        ?>
                    </td>
                </tr>
                </tr>
                <?php
            }
            ?>

            <!-- ------------------------------------------ -->
            <?php
            while ($rowb = mysqli_fetch_array($resultb, MYSQLI_ASSOC)) {

                if ($rowb['status'] == "Approved") {
                    $statusDisply = "অনুমোদিত";
                    $textHilight = "";
                }
                if ($rowb['status'] == "Rejected") {
                    $statusDisply = "বাতিলকৃত";
                    $textHilight = "color: red;font-weight:bold;";
                }

                ?>
                <tr>
                    <td class="table-display" style="<?php echo $textHilight; ?>">
                        <?php
                        if ($rowb['paymentStatus'] == 'Paid') {
                            echo $rowb['certificateID'];
                        } else {
                            echo "---";
                        }
                        ?>
                    </td>
                    <td>দাফন সনদপত্র</td>
                    <td>
                        <?php
                        $bDate1=$rowb['applyDate'];
                        $format_bDate=date("d-m-Y",strtotime($bDate1));
                        echo "$format_bDate / ";
                        echo "$rowb[applyType]";
                        ?>
                    </td>
                    <td><?php echo $rowb['fullName']; ?></td>
                    <td>
                        <?php
                        if ($rowb['paymentStatus'] == 'Paid') {
                            echo "
<a class='table-display'><button class='view-window' data-formid='{$rowb['certificateID']}' data-formtype='burial' style='cursor: pointer; color: #007CC7; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>দেখুন</button> |</a>
<button class='view-window' data-formid='{$rowb['certificateID']}' data-formtype='burial' style='cursor: pointer; color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'><i class='fa fa-print'></i> প্রিন্ট করুন</button>";
                        } else {
                            echo "";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($rowb['paymentStatus'] == 'Paid') {
                            echo "
                        <form method='POST' enctype='multipart/form-data' onsubmit='LoaderShow()'>
                            <input type='hidden' name='linkedForm' value='{$rowb['linkedForm']}'>
                            <input type='hidden' name='certificateID' value='{$rowb['certificateID']}'>
                            <input type='hidden' name='certificateFormType' value='burial'>
                            <select name='actionSwitch' onchange='this.form.submit()'>
                                <option value='{$rowb['status']}' hidden selected>{$statusDisply}</option>
                                <option value='Approved'><b>অনুমোদন দিন</b></option>
                                <option value='Rejected'>বাতিল করুন</option>
                            </select>
                        </form>
                        ";
                        } else {
                            echo "";
                        }
                        ?>
                    </td>
                </tr>
                </tr>
                <?php
            }
            ?>

            <!-- ------------------------------------------ -->
            <?php
            while ($rowl = mysqli_fetch_array($resultl, MYSQLI_ASSOC)) {

                if ($rowl['status'] == "Approved") {
                    $statusDisply = "অনুমোদিত";
                    $textHilight = "";
                }
                if ($rowl['status'] == "Rejected") {
                    $statusDisply = "বাতিলকৃত";
                    $textHilight = "color: red;font-weight:bold;";
                }

                ?>
                <tr>
                    <td class="table-display"style="<?php echo $textHilight; ?>">
                        <?php
                        if ($rowl['paymentStatus'] == 'Paid') {
                            echo $rowl['certificateID'];
                        } else {
                            echo "---";
                        }
                        ?>
                    </td>
                    <td>ওয়ারিশনামা সনদপত্র</td>
                    <td>
                        <?php
                        $bDate1=$rowl['applyDate'];
                        $format_bDate=date("d-m-Y",strtotime($bDate1));
                        echo "$format_bDate / ";
                        echo "$rowl[applyType]";
                        ?>
                    </td>
                    <td><?php echo $rowl['fullName']; ?></td>
                    <td>
                        <?php
                        if ($rowl['paymentStatus'] == 'Paid') {
                            echo "
<a class='table-display'><button class='view-window' data-formid='{$rowl['certificateID']}' data-formtype='legacy' style='cursor: pointer; color: #007CC7; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>দেখুন</button> |</a>
<button class='view-window' data-formid='{$rowl['certificateID']}' data-formtype='legacy' style='cursor: pointer; color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'><i class='fa fa-print'></i> প্রিন্ট করুন</button>";
                        } else {
                            echo "";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($rowl['paymentStatus'] == 'Paid') {
                            echo "
                        <form method='POST' enctype='multipart/form-data' onsubmit='LoaderShow()'>
                            <input type='hidden' name='linkedForm' value='{$rowl['linkedForm']}'>
                            <input type='hidden' name='certificateID' value='{$rowl['certificateID']}'>
                            <input type='hidden' name='certificateFormType' value='legacy'>
                            <select name='actionSwitch' onchange='this.form.submit()'>
                                <option value='{$rowl['status']}' hidden selected>{$statusDisply}</option>
                                <option value='Approved'><b>অনুমোদন দিন</b></option>
                                <option value='Rejected'>বাতিল করুন</option>
                            </select>
                        </form>
                        ";
                        } else {
                            echo "";
                        }
                        ?>
                    </td>
                </tr>
                </tr>
                <?php
            }
            ?>

            <!-- ------------------------------------------ -->
            <?php
            while ($rowr = mysqli_fetch_array($resultr, MYSQLI_ASSOC)) {

                if ($rowr['status'] == "Approved") {
                    $statusDisply = "অনুমোদিত";
                    $textHilight = "";
                }
                if ($rowr['status'] == "Rejected") {
                    $statusDisply = "বাতিলকৃত";
                    $textHilight = "color: red;font-weight:bold;";
                }

                ?>
                <tr>
                    <td class="table-display"style="<?php echo $textHilight; ?>">
                        <?php
                        if ($rowr['paymentStatus'] == 'Paid') {
                            echo $rowr['certificateID'];
                        } else {
                            echo "---";
                        }
                        ?>
                    </td>
                    <td>পুনঃবিবাহ না হওয়া সনদপত্র</td>
                    <td>
                        <?php
                        $bDate1=$rowr['applyDate'];
                        $format_bDate=date("d-m-Y",strtotime($bDate1));
                        echo "$format_bDate / ";
                        echo "$rowr[applyType]";
                        ?>
                    </td>
                    <td><?php echo $rowr['fullName']; ?></td>
                    <td>
                        <?php
                        if ($rowr['paymentStatus'] == 'Paid') {
                            echo "
<a class='table-display'><button class='view-window' data-formid='{$rowr['certificateID']}' data-formtype='remarriage' style='cursor: pointer; color: #007CC7; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>দেখুন</button> |</a>
<button class='view-window' data-formid='{$rowr['certificateID']}' data-formtype='remarriage' style='cursor: pointer; color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'><i class='fa fa-print'></i> প্রিন্ট করুন</button>";
                        } else {
                            echo "";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($rowr['paymentStatus'] == 'Paid') {
                            echo "
                        <form method='POST' enctype='multipart/form-data' onsubmit='LoaderShow()'>
                            <input type='hidden' name='linkedForm' value='{$rowr['linkedForm']}'>
                            <input type='hidden' name='certificateID' value='{$rowr['certificateID']}'>
                            <input type='hidden' name='certificateFormType' value='remarriage'>
                            <select name='actionSwitch' onchange='this.form.submit()'>
                                <option value='{$rowr['status']}' hidden selected>{$statusDisply}</option>
                                <option value='Approved'><b>অনুমোদন দিন</b></option>
                                <option value='Rejected'>বাতিল করুন</option>
                            </select>
                        </form>
                        ";
                        } else {
                            echo "";
                        }
                        ?>
                    </td>
                </tr>
                </tr>
                <?php
            }
            ?>


            <?php
        } else {
            echo "<p style='font-size: 16px;font-family: Bangla;text-align: center;padding: 50px 20px;font-style: italic;color: #ff3333;'><i class='fa fa-warning'></i> কোনো তথ্য পাওয়া যায় নি!</p>";
        }
        ?>
        </tbody>
    </table>

</div>





<div class="modal" id="modal">
    <div class="modal-form">
        <a class="modal-title" style="padding: 5px"><p style="margin-top: 5px; padding: 0 5px; display: inline-block; color: #5b86e5; font-weight: 600;font-size: 16px; font-family: 'Bangla';">সার্টিফিকেট বিস্তারিতঃ</p>
            <div class="close-btn">X</div>
        </a>
        <div class="ajax_loader" style="margin-top: 15%;">
            <img src="assets/images/loading.gif" alt="loading icon">
        </div>
        <div id="details">

        </div>
    </div>
</div>




<script type="text/javascript">
    $(document).on("click", ".view-window", function() {
        document.body.style.overflow = "hidden";
        $(".modal").fadeIn('fast');
        var formID = $(this).data("formid");
        var formType = $(this).data("formtype");

        $.ajax({
            url: "script/certificate-single-data-show",
            type: "POST",
            data: {
                formID: formID,
                formType: formType
            },
            beforeSend: function() {
                $('.ajax_loader').show();
                $('#details').hide();
            },
            success: function(data) {
                $(".modal-form #details").html(data);
                $('.ajax_loader').hide();
                $('#details').show();
            }
        })
    });

    $(".close-btn").on("click", function() {
        $(".modal").fadeOut('fast');
        document.body.style.overflow = "auto";
    });


    var modal = document.querySelector('.modal')
    window.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            $(".modal").fadeOut('fast');
            document.body.style.overflow = "auto";
        }
    });

</script>

