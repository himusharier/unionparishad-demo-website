
<?php
if ($_SESSION['user_role'] != "house-holding") {
    echo "<script type='text/javascript'> document.location = 'citizen/dashboard'; </script>";
}
?>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
header('Cache-control: no-cache, must-revalidate, max-age=0');


if($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['submit-btn'])) {

        if (empty($_POST['linkedForm']) || empty($_POST['fullName']) || empty($_POST['guardianName']) || empty($_POST['motherName']) || empty($_POST['nidNo']) || empty($_POST['birthDate']) || empty($_POST['village']) || empty($_POST['wardNo']) || empty($_POST['upozilla']) || empty($_POST['zilla']) || empty($_POST['deathDate']) || empty($_POST['applyType'])) {

            $applyError = "<p class='formApplyError'><i class='fa fa-warning'></i> ফর্মটি সঠিকভাবে পূরণ করে আবার চেষ্টা করুন!</p>";

        } else {

            function clean_inputs($data)
            {
                include "config/database-connection.php";
                $data = htmlspecialchars($data);
                $data = stripslashes($data);
                $data = trim($data);
                $data = mysqli_real_escape_string($db, $data);
                return $data;
            }

            $linkedForm = clean_inputs($_POST['linkedForm']);
            $fullName = clean_inputs($_POST['fullName']);
            $guardianName = clean_inputs($_POST['guardianName']);
            $motherName = clean_inputs($_POST['motherName']);
            $nidNo = clean_inputs($_POST['nidNo']);
            $birthDate = clean_inputs($_POST['birthDate']);
            $village = clean_inputs($_POST['village']);
            $wardNo = clean_inputs($_POST['wardNo']);
            $upozilla = clean_inputs($_POST['upozilla']);
            $zilla = clean_inputs($_POST['zilla']);
            $deathDate = clean_inputs($_POST['deathDate']);
            $applyType = clean_inputs($_POST['applyType']);


            $ipAddress = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');

            date_default_timezone_set('Asia/Dhaka');
            $applyDate = date('d-m-Y');
            $certificateID = substr(str_shuffle("0123456789"), 0, 10);

            $pr1Sql = "INSERT INTO burial_certificate_apply (linkedForm, certificateID, fullName, guardianName, motherName, nidNo, birthDate, village, wardNo, upozilla, zilla, deathDate, regStatus, paymentStatus, applyDate, applyType, ipAddress, status, statusBy) VALUES ('$linkedForm', '$certificateID', '$fullName', '$guardianName', '$motherName', '$nidNo', '$birthDate', '$village', '$wardNo', '$upozilla', '$zilla', '$deathDate', 'Done', 'Unpaid', '$applyDate', '$applyType', '$ipAddress', 'Requested', '')";

            if (mysqli_query($db, $pr1Sql)) {
                $_SESSION['linkedForm'] = $linkedForm;
                $_SESSION['certificateID'] = $certificateID;
                echo "<script type='text/javascript'> document.location = 'citizen/burial-certificate-details'; </script>";
            }

        }

    }
}

if($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['certificate-details'])) {

        $_SESSION['linkedForm'] = $_POST['linkedForm'];
        $_SESSION['certificateID'] = $_POST['certificateID'];
        echo "<script type='text/javascript'> document.location = 'citizen/burial-certificate-details'; </script>";
    }

}


?>


<script>
    document.title = 'দাফন সনদ - ইউনিয়ন পরিষদ';
</script>

<style>
    .responstable table {
        border-collapse: collapse;
        width: 100%;
    }

    .responstable td, .responstable th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        font-family: 'Bangla', arial, sans-serif !important;
        font-size: 16px !important;
    }
    .responstable th {
        background-color: #f5f5f5;
    }
</style>

<div class="content-body-main-div">

    <p class="page-direction"><i class="fa fa-link"></i> নাগরিক পোর্টাল / দাফন সনদ /</p>

    <div class="admin-dashboard-content-div">

        <h2 style="font-family:'Bangla';color: #5e5e5e;border-bottom:1px solid #5e5e5e;">দাফন সনদ আবেদনপত্রঃ</h2>

        <?php
        if (isset($applyError)) {
            echo $applyError;
        }
        ?>

        <form method="post" enctype="multipart/form-data" onsubmit="LoaderShow()">
        <div class="dashboard-table-container" style="margin-top: 15px;">
            <p class="dashboard-table-container-heading">দাফন সনদ তথ্য</p>
            <div class="dashboard-table-container-div">

                <table>
                    <tbody>
                    <tr>
                        <td>
                            <label>নামঃ<i style="color: red;">*</i></label>
                            <input type="text" name="fullName" autocomplete="off" value="<?php echo $rowChk['personName']; ?>" required readonly>
                        </td>
                        <td>
                            <label>পিতা/স্বামীঃ<i style="color: red;">*</i></label>
                            <input type="text" name="guardianName" autocomplete="off" value="<?php echo $rowChk['guardianName']; ?>" required readonly>
                        </td>
                        <td>
                            <label>মাতাঃ<i style="color: red;">*</i></label>
                            <input type="text" name="motherName" autocomplete="off" value="<?php echo $rowChk['motherName']; ?>" required readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>জাতীয় পরিচয়পত্রঃ<i style="color: red;">*</i></label>
                            <input type="text" name="nidNo" autocomplete="off" value="<?php echo $rowChk['idNo']; ?>" required readonly>
                        </td>
                        <td>
                            <label>জন্ম তারিখঃ<i style="color: red;">*</i></label>
                            <input type="date" name="birthDate" autocomplete="off" value="" required>
                        </td>
                        <td>
                            <label>মৃত্যু তারিখঃ<i style="color: red;">*</i></label>
                            <input type="date" name="deathDate" autocomplete="off" value="" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>গ্রাম/মহল্লাঃ<i style="color: red;">*</i></label>
                            <input type="text" name="village" autocomplete="off" value="<?php echo $rowChk['village']; ?>" required readonly>
                        </td>
                        <td>
                            <label>ওয়ার্ডঃ<i style="color: red;">*</i></label>
                            <input type="text" name="wardNo" autocomplete="off" value="<?php echo $rowChk['wardNo']; ?>" required readonly>
                        </td>
                        <td>
                            <label>উপজেলাঃ<i style="color: red;">*</i></label>
                            <input type="text" name="upozilla" autocomplete="on" value="" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>জেলাঃ<i style="color: red;">*</i></label>
                            <input type="text" name="zilla" autocomplete="on" value="" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>আবেদনের ধরণঃ<i style="color: red;">*</i></label>
                            <select name="applyType" required>
                                <option value="" selected>-- নির্বাচন করুন --</option>
                                <option value="সাধারণ">সাধারণ (ফী ৩০০ টাকা)</option>
                                <option value="জরুরী">জরুরী (ফী ৫০০ টাকা)</option>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>

            <input type="hidden" name="linkedForm" value="<?php echo $rowChk['formID'] ?>">
        <button type="submit" name="submit-btn" id="submit-btn"><i class="fa fa-upload"></i> আবেদন করুন</button>
        </form>

    </div>


    <br/><br/>
    <div>
        <h2 style="font-family:'Bangla';color: #5e5e5e;border-bottom:1px solid #5e5e5e;">পূর্বে আবেদনকৃত সনদঃ</h2>

        <table class="responstable">
            <tbody>
            <?php
            $formID = $rowChk['formID'];
            $sqlr = "SELECT * FROM burial_certificate_apply WHERE linkedForm = '$formID' ORDER BY id ASC";
            $resultr = mysqli_query($db, $sqlr);
            $countr = mysqli_num_rows($resultr);
            if ($countr > 0) {
                ?>
                <tr>
                    <th>সার্টিফিকেট নাম্বার</th>
                    <th>আবেদনের তারিখ</th>
                    <th class="table-display">পেমেন্ট স্ট্যাটাস</th>
                    <th>অন্যান্য</th>
                </tr>
                <?php
                while ($rowr = mysqli_fetch_array($resultr, MYSQLI_ASSOC)) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            if ($rowr['paymentStatus'] == 'Paid') {
                                echo $rowr['certificateID'];
                            } else {
                                echo "---";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            $bDate1=$rowr['applyDate'];
                            $format_bDate=date("d-m-Y",strtotime($bDate1));
                            echo $format_bDate;
                            ?>
                        </td>
                        <td class="table-display">
                            <a class="<?php echo(($rowr['paymentStatus'] == 'Paid' ? 'paymentDone' : 'paymentDue')) ?>"><?php echo $rowr['paymentStatus'] ?></a>
                        </td>
                        <td>
                            <form method="post" enctype="multipart/form-data" style="display: inline-block;">
                                <input type="hidden" name="linkedForm" value="<?php echo $rowr['linkedForm'] ?>">
                                <input type="hidden" name="certificateID" value="<?php echo $rowr['certificateID'] ?>">
                                <?php
                                if ($rowr['status'] != "Rejected") {
                                    ?>
                                    <a class='table-display'><button onclick='LoaderShow()' type='submit' name='certificate-details' class='view-window' style='cursor: pointer; color: #007CC7; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>দেখুন</button> | </a>
                                    <?php
                                    if ($rowr['paymentStatus'] == 'Paid') {
                                        echo "<button onclick='LoaderShow()' type='submit' name='certificate-details' class='edit-window' style='cursor: pointer; color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>ডাউনলোড করুন</button>";
                                    } else {
                                        echo "<button onclick='LoaderShow()' type='submit' name='certificate-details' class='edit-window' style='cursor: pointer; color: #ff3333; background: none; height: auto; border: 1px solid #ff3333; margin: 0; padding: 0 10px; width: auto; font-weight: bold;'>পেমেন্ট করুন</button>";
                                    }
                                    ?>
                                    <?php
                                } else {
                                    echo "<a style='color: #ff3333;font-weight: bold;'><i class='fa fa-close'></i> সনদপত্রটি বাতিল করা হয়েছে!</a>";
                                }
                                ?>


                            </form>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<p style='font-size: 16px;font-family: Bangla;text-align: left;padding: 20px 0;font-style: italic;color: #ff3333;'><i class='fa fa-warning'></i> কোনো তথ্য পাওয়া যায় নি!</p>";
            }
            ?>
            </tbody>
        </table>
    </div>

</div>
