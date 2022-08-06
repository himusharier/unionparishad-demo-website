<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    include "../config/database-connection.php";

    if (isset($_POST["certificateType"]) && isset($_POST["certificateNumber"])) {

        $certificateType = strip_tags($_POST['certificateType']);
        $certificateType = htmlspecialchars($certificateType);
        $certificateType = mysqli_real_escape_string($db, $certificateType);

        $certificateNumber = strip_tags($_POST['certificateNumber']);
        $certificateNumber = htmlspecialchars($certificateNumber);
        $certificateNumber = mysqli_real_escape_string($db, $certificateNumber);

        if ($certificateType != "" && $certificateNumber != "") {

            if ($certificateType == "character") {
                $certificateType2 = "চারিত্রিক সনদপত্র";
            }
            if ($certificateType == "unmarried") {
                $certificateType2 = "অবিবাহিত সনদপত্র";
            }
            if ($certificateType == "death") {
                $certificateType2 = "মৃত্যু তারিখের সনদপত্র";
            }
            if ($certificateType == "burial") {
                $certificateType2 = "দাফন সনদপত্র";
            }
            if ($certificateType == "legacy") {
                $certificateType2 = "ওয়ারিশনামা সনদপত্র";
            }
            if ($certificateType == "remarriage") {
                $certificateType2 = "পুনঃবিবাহ না হওয়া সনদপত্র";
            }

            $tableQuery = $certificateType.'_certificate_apply';

            $sql_query = "SELECT * FROM `$tableQuery` WHERE certificateID='$certificateNumber'";
            $result = mysqli_query($db, $sql_query);
            $count = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);

            if ($count == 1) {

                $paymentLog = ($row['paymentStatus'] == 'Paid' ? 'paymentDone' : 'paymentDue');
                if ($row['status'] == 'Requested') {
                    $verifyLog = "<a style='color: darkgoldenrod;font-weight: bold;'><i class='fa fa-warning'></i> সনদপত্রটি অনুমোদিত হয় নি!</a>";
                }
                if ($row['status'] == 'Approved'){
                    $verifyLog = "<a style='color: #23b14d;font-weight: bold;'><i class='fa fa-check'></i> ভেরিফিকেশন সম্পন্ন হয়েছে!</a>";
                }
                if ($row['status'] == 'Rejected'){
                    $verifyLog = "<a style='color: #ff3333;font-weight: bold;'><i class='fa fa-close'></i> সনদপত্রটি বাতিল করা হয়েছে!</a>";
                }

                echo "
                <table class='responstable' style='max-width: 900px;border: 1px solid #5b86e5;'>
            <tbody>
                <tr>
                    <td style='font-weight: bold;'>ভেরিফিকেশন স্ট্যাটাস</td>
                    <td>{$verifyLog}</td>
                </tr>
                <tr>
                    <td style='font-weight: bold;'>সনদপত্রের ধরণ</td>
                    <td>{$certificateType2}</td>
                </tr>
                <tr>
                    <td style='font-weight: bold;'>সার্টিফিকেট নাম্বার</td>
                    <td>{$row['certificateID']}</td>
                </tr>
                <tr>
                    <td style='font-weight: bold;'>আবেদনকারীর নাম</td>
                    <td>{$row['fullName']}</td>
                </tr>
                <tr>
                    <td style='font-weight: bold;'>আবেদনের তারিখ</td>
                    <td>{$row['applyDate']}</td>
                </tr>
                <tr>
                    <td style='font-weight: bold;'>আবেদনের ধরণ</td>
                    <td>{$row['applyType']}</td>
                </tr>
                <tr>
                    <td style='font-weight: bold;'>পেমেন্ট স্ট্যাটাস</td>
                    <td>
                    <a style='display: inline-block;' class='{$paymentLog}'>{$row['paymentStatus']}</a>
                    </td>
                </tr>
            </tbody>
        </table>
                ";
                exit();

            } else {
                echo "<div class='error_msg'><i style='font-size: 26px;' class='fa fa-warning'></i><br/>সার্টিফিকেটটি খুঁজে পাওয়া যায় নি!</div>";
            }

        } else {
            echo "<div class='error_msg'>সবগুলো তথ্য সঠিকভাবে দিন!</div>";
            exit();
        }

    }


    if (!isset($_POST["certificateType"]) && !isset($_POST["certificateNumber"])) {
        exit();
    }


} else {
    include "../not-found.php";
    exit();
}


?>