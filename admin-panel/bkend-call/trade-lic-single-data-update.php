<?php

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['formID']) && !isset($_POST['delete-btn'])) {

    include "../config/database-connection.php";

    $formID = $_POST['formID'];

    $idNumber = strip_tags($_POST['idNumber']);
    $pinNumber = strip_tags($_POST['pinNumber']);
    $cardStatus = strip_tags($_POST['cardStatus']);

    $haveLicense = strip_tags($_POST['haveLicense']);
    $tradeLicense = strip_tags($_POST['tradeLicense']);
    $serialNo = strip_tags($_POST['serialNo']);
    $lastRenew = strip_tags($_POST['lastRenew']);
    $tradeLicIntroNo = strip_tags($_POST['tradeLicIntroNo']);
    $businessName = strip_tags($_POST['businessName']);
    $proprietorName = strip_tags($_POST['proprietorName']);
    $fatherName = strip_tags($_POST['fatherName']);
    $motherName = strip_tags($_POST['motherName']);
    $address = strip_tags($_POST['address']);
    $mobile = strip_tags($_POST['mobile']);
    $nidNo = strip_tags($_POST['nidNo']);
    $businessType = strip_tags($_POST['businessType']);
    $tradeLicFee = strip_tags($_POST['tradeLicFee']);
    $signboardTax = strip_tags($_POST['signboardTax']);
    $totalTax = strip_tags($_POST['totalTax']);
    $totalAmount = strip_tags($_POST['totalAmount']);
    $wardNo = strip_tags($_POST['wardNo']);
    $village = strip_tags($_POST['village']);
    $zip = strip_tags($_POST['zip']);
    $post = strip_tags($_POST['post']);


    $idNumber = htmlspecialchars($idNumber);
    $pinNumber = htmlspecialchars($pinNumber);
    $cardStatus = htmlspecialchars($cardStatus);

    $haveLicense = htmlspecialchars($haveLicense);
    $tradeLicense = htmlspecialchars($tradeLicense);
    $serialNo = htmlspecialchars($serialNo);
    $lastRenew = htmlspecialchars($lastRenew);
    $tradeLicIntroNo = htmlspecialchars($tradeLicIntroNo);
    $businessName = htmlspecialchars($businessName);
    $proprietorName = htmlspecialchars($proprietorName);
    $fatherName = htmlspecialchars($fatherName);
    $motherName = htmlspecialchars($motherName);
    $address = htmlspecialchars($address);
    $mobile = htmlspecialchars($mobile);
    $nidNo = htmlspecialchars($nidNo);
    $businessType = htmlspecialchars($businessType);
    $tradeLicFee = htmlspecialchars($tradeLicFee);
    $signboardTax = htmlspecialchars($signboardTax);
    $totalTax = htmlspecialchars($totalTax);
    $totalAmount = htmlspecialchars($totalAmount);
    $wardNo = htmlspecialchars($wardNo);
    $village = htmlspecialchars($village);
    $zip = htmlspecialchars($zip);
    $post = htmlspecialchars($post);


    $idNumber = mysqli_real_escape_string($db, $idNumber);
    $pinNumber = mysqli_real_escape_string($db, $pinNumber);
    $cardStatus = mysqli_real_escape_string($db, $cardStatus);

    $haveLicense = mysqli_real_escape_string($db, $haveLicense);
    $tradeLicense = mysqli_real_escape_string($db, $tradeLicense);
    $serialNo = mysqli_real_escape_string($db, $serialNo);
    $lastRenew = mysqli_real_escape_string($db, $lastRenew);
    $tradeLicIntroNo = mysqli_real_escape_string($db, $tradeLicIntroNo);
    $businessName = mysqli_real_escape_string($db, $businessName);
    $proprietorName = mysqli_real_escape_string($db, $proprietorName);
    $fatherName = mysqli_real_escape_string($db, $fatherName);
    $motherName = mysqli_real_escape_string($db, $motherName);
    $address = mysqli_real_escape_string($db, $address);
    $mobile = mysqli_real_escape_string($db, $mobile);
    $nidNo = mysqli_real_escape_string($db, $nidNo);
    $businessType = mysqli_real_escape_string($db, $businessType);
    $tradeLicFee = mysqli_real_escape_string($db, $tradeLicFee);
    $signboardTax = mysqli_real_escape_string($db, $signboardTax);
    $totalTax = mysqli_real_escape_string($db, $totalTax);
    $totalAmount = mysqli_real_escape_string($db, $totalAmount);
    $wardNo = mysqli_real_escape_string($db, $wardNo);
    $village = mysqli_real_escape_string($db, $village);
    $zip = mysqli_real_escape_string($db, $zip);
    $post = mysqli_real_escape_string($db, $post);

    $lastIP = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');

    date_default_timezone_set('Asia/Dhaka');
    $lastUpdate = date('d-m-Y');


        $sql = "UPDATE trade_license_database SET lastUpdate='$lastUpdate', lastIP='$lastIP', idNumber='$idNumber', pinNumber='$pinNumber', cardStatus='$cardStatus', haveLicense='$haveLicense', tradeLicense='$tradeLicense', serialNo='$serialNo', lastRenew='$lastRenew', tradeLicIntroNo='$tradeLicIntroNo', businessName='$businessName', proprietorName='$proprietorName', fatherName='$fatherName', motherName='$motherName', address='$address', mobile='$mobile', nidNo='$nidNo', businessType='$businessType', tradeLicFee='$tradeLicFee', signboardTax='$signboardTax', totalTax='$totalTax', totalAmount='$totalAmount', wardNo='$wardNo', village='$village', zip='$zip', post='$post' WHERE (formID='$formID')";

        if (mysqli_query($db, $sql)) {

            echo "<div class='reg-form-message-green'><br/><i class='fa fa-check'></i> <b>তথ্যটি সংশোধন করা হয়েছে!</b><br/><br/><a href='admin/list-trade-license' class='cancel-btn'><i class='fa fa-arrow-left'></i> মূল তালিকায় ফিরে যান</a></div>
                    
                    ";

        } else {
            echo "<div class='reg-form-message-error'><br/><i class='fa fa-close'></i> <b>তথ্যটি সংশোধন করা যাচ্ছে না!</b><br/><br/><button type='button' onclick='showForm();' name='renew-btn' class='cancel-btn'>আবার চেষ্টা করুন</button></div>
                    ";
        }


} else {
    include "../not-found.php";
    exit();
}

?>