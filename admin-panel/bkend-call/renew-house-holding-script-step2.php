<?php
session_start();

$user_id = $_SESSION["admin_user_id"];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

        include "../config/database-connection.php";

        if (empty($_POST['linkedForm']) || empty($_POST['fullName']) || empty($_POST['mobile']) || empty($_POST['renewStartDate']) || empty($_POST['renewEndDate']) || empty($_POST['holdingFee']) || empty($_POST['feeDiscount']) || empty($_POST['payableAmount'])) {

            echo "<p class='formApplyError'><i class='fa fa-warning'></i> ফর্মটি সঠিকভাবে পূরণ করে আবার চেষ্টা করুন!</p>";

        } else {

            function clean_inputs($data)
            {
                include "../config/database-connection.php";
                $data = htmlspecialchars($data);
                $data = stripslashes($data);
                $data = trim($data);
                $data = mysqli_real_escape_string($db, $data);
                return $data;
            }

            $linkedForm = clean_inputs($_POST['linkedForm']);
            $fullName = clean_inputs($_POST['fullName']);
            $mobile = clean_inputs($_POST['mobile']);
            $renewStartDate = clean_inputs($_POST['renewStartDate']);
            $renewEndDate = clean_inputs($_POST['renewEndDate']);
            $holdingFee = clean_inputs($_POST['holdingFee']);
            $feeDiscount = clean_inputs($_POST['feeDiscount']);
            $payableAmount = clean_inputs($_POST['payableAmount']);


            $ipAddress = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');

            date_default_timezone_set('Asia/Dhaka');
            $applyDate = date('d-m-Y');
            $renewHoldingID = substr(str_shuffle("0123456789"), 0, 10);

            $pr1Sql = "INSERT INTO renew_house_holding_database (linkedForm, renewHoldingID, fullName, mobile, renewStartDate, renewEndDate, holdingFee, feeDiscount, payableAmount, paymentStatus, entryBy, entryDate, ipAddress) VALUES ('$linkedForm', '$renewHoldingID', '$fullName', '$mobile', '$renewStartDate', '$renewEndDate', '$holdingFee', '$feeDiscount', '$payableAmount', 'Unpaid', '$user_id', '$applyDate', '$ipAddress')";

            if (mysqli_query($db, $pr1Sql)) {

                // success message
                echo "<div style='margin-top: 100px;' class='reg-form-message-green'><br/><i class='fa fa-check'></i> <b>হোল্ডিং নবায়ন সম্পন্ন হয়েছে!</b><br/><br/></div>
                    
                    ";

            } else {
                echo "<div style='margin-top: 100px;' class='reg-form-message-error'><br/><i class='fa fa-close'></i> <b>হোল্ডিং নবায়ন করা যাচ্ছে না!</b><br/><br/></div>
                    ";
            }

        }




}


?>