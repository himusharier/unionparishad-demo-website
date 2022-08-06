<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    include "../config/database-connection.php";

    $entryPersonId = $_SESSION["admin_user_id"];
    if (!isset($entryPersonId)) {
        $_SESSION["admin_login_first_msg"] = "<div class='error_msg'>প্রথমে নিজ একাউন্টে প্রবেশ করুন!</div>";
        include ('bkend-call/admin-logout.php');
        echo "<script type='text/javascript'> document.location = 'login'; </script>";
        exit();
    }

    function clean_inputs($data)
    {
        include "../config/database-connection.php";
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        $data = mysqli_real_escape_string($db, $data);
        return $data;
    }

    function englishNumber($BanglaToEnglish) {
        $banglaNum=array("০","১","২","৩","৪","৫",'৬',"৭","৮","৯","/");
        $englishNum=array("0","1","2","3","4","5",'6',"7","8","9","-");
        return str_replace($banglaNum,$englishNum,$BanglaToEnglish);
    }

    $idNumber = clean_inputs($_POST['idNumber']);
    $idNumber = englishNumber($idNumber);
    $idNumber = preg_replace("/\s+/", "", $idNumber);

    $pinNumber = clean_inputs($_POST['pinNumber']);
    $pinNumber = englishNumber($pinNumber);
    $pinNumber = preg_replace("/\s+/", "", $pinNumber);

    $cardStatus = clean_inputs($_POST['cardStatus']);
    $holdingType = clean_inputs($_POST['holdingType']);
    $personName = clean_inputs($_POST['personName']);
    $guardianType = clean_inputs($_POST['guardianType']);
    $guardianName = clean_inputs($_POST['guardianName']);
    $motherName = clean_inputs($_POST['motherName']);
    $gender = clean_inputs($_POST['gender']);
    $maritalStatus = clean_inputs($_POST['maritalStatus']);
    $birthDate = clean_inputs($_POST['birthDate']);
    $idType = clean_inputs($_POST['idType']);

    $idNo = clean_inputs($_POST['idNo']);
    $idNo = englishNumber($idNo);
    $idNo = preg_replace("/\s+/", "", $idNo);

    $mobile = clean_inputs($_POST['mobile']);
    $mobile = englishNumber($mobile);
    $mobile = preg_replace("/\s+/", "", $mobile);

    $religion = clean_inputs($_POST['religion']);
    $familyCondition = clean_inputs($_POST['familyCondition']);

    $maleNumber = clean_inputs($_POST['maleNumber']);
    $maleNumber = englishNumber($maleNumber);

    $femaleNumber = clean_inputs($_POST['femaleNumber']);
    $femaleNumber = englishNumber($femaleNumber);

    $applicationFee = clean_inputs($_POST['applicationFee']);
    $applicationFee = englishNumber($applicationFee);

    $paymentType = clean_inputs($_POST['paymentType']);
    $allowanceType = clean_inputs($_POST['allowanceType']);

    $allowanceAmount = clean_inputs($_POST['allowanceAmount']);
    $allowanceAmount = englishNumber($allowanceAmount);

    $disability = clean_inputs($_POST['disability']);
    $freedomFighter = clean_inputs($_POST['freedomFighter']);
    $waterConnection = clean_inputs($_POST['waterConnection']);
    $nidHolder = clean_inputs($_POST['nidHolder']);
    $voter = clean_inputs($_POST['voter']);

    $landAmount = clean_inputs($_POST['landAmount']);
    $landAmount = englishNumber($landAmount);

    $holdingNo = clean_inputs($_POST['holdingNo']);
    $holdingNo = englishNumber($holdingNo);

    $wardNo = clean_inputs($_POST['wardNo']);
    $wardNo = englishNumber($wardNo);

    $village = clean_inputs($_POST['village']);

    $zip = clean_inputs($_POST['zip']);
    $zip = englishNumber($zip);

    $post = clean_inputs($_POST['post']);
    $electricity = clean_inputs($_POST['electricity']);
    $sanitation = clean_inputs($_POST['sanitation']);
    $houseType = clean_inputs($_POST['houseType']);

    $totalHouse = clean_inputs($_POST['totalHouse']);

    $occupation = clean_inputs($_POST['occupation']);
    $lastTaxDate = clean_inputs($_POST['lastTaxDate']);


    $unemployedMember = clean_inputs($_POST['unemployedMember']);
    $workerMember = clean_inputs($_POST['workerMember']);
    $voterNumber = clean_inputs($_POST['voterNumber']);

    $homeLandAmount = clean_inputs($_POST['homeLandAmount']);
    $homeLandAmount = englishNumber($homeLandAmount);

    $agriLandAmount = clean_inputs($_POST['agriLandAmount']);
    $agriLandAmount = englishNumber($agriLandAmount);

    $maleDisabilityNumber = clean_inputs($_POST['maleDisabilityNumber']);
    $femaleDisabilityNumber = clean_inputs($_POST['femaleDisabilityNumber']);


    $maleChildNumber = clean_inputs($_POST['maleChildNumber']);
    $femaleChildNumber = clean_inputs($_POST['femaleChildNumber']);
    $isAllowance = clean_inputs($_POST['isAllowance']);
    $allowanceMember = clean_inputs($_POST['allowanceMember']);
    $disabilityNumber = clean_inputs($_POST['disabilityNumber']);

    $familyIncome = clean_inputs($_POST['familyIncome']);
    $familyIncome = englishNumber($familyIncome);

    $isChildEducation = clean_inputs($_POST['isChildEducation']);
    $childEducationNumber = clean_inputs($_POST['childEducationNumber']);

    $personAge = clean_inputs($_POST['personAge']);
    $personAge = englishNumber($personAge);

    $totalFamilyMember = clean_inputs($_POST['totalFamilyMember']);


    $lastIP = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');

    date_default_timezone_set('Asia/Dhaka');
    $lastUpdate = date('d-m-Y');
    $formID = rand(0001,9999).date('dmYGis');

/*
    if (!empty($_POST['pr1Name'])) {
        $prName = $_POST['pr1Name'];
        $prReletion = $_POST['pr1Reletion'];
        $prDisability = $_POST['pr1Disability'];
        $prId = $_POST['pr1Id'];
        $prName = htmlspecialchars($prName);
        $prReletion = htmlspecialchars($prReletion);
        $prDisability = htmlspecialchars($prDisability);
        $prId = htmlspecialchars($prId);
        $pr1Sql = "INSERT INTO house_holding_database_family (linkedForm, personName, relationType, disability, personId) VALUES ('$formID', '$prName', '$prReletion', '$prDisability', '$prId')";
        mysqli_query($db, $pr1Sql);
    }
*/



// check db table if similar card id found or not!

    $sql_query_holding = "SELECT * FROM house_holding_database WHERE idNumber='$idNumber'";
    $result_holding = mysqli_query($db, $sql_query_holding);
    $count_holding = mysqli_num_rows($result_holding);

    $sql_query_trade = "SELECT * FROM trade_license_database WHERE idNumber='$idNumber'";
    $result_trade = mysqli_query($db, $sql_query_trade);
    $count_trade = mysqli_num_rows($result_trade);

    if ($count_holding == 0 && $count_trade == 0) {

        if (empty($idNo)) {
            $countIdNo = 0;
        } else {
            $checkIdNo = "SELECT * FROM house_holding_database WHERE idNo='$idNo'";
            $checkIdNoResult = mysqli_query($db, $checkIdNo);
            $countIdNo = mysqli_num_rows($checkIdNoResult);
        }

        if ($countIdNo == 0) {

            $n = clean_inputs($_POST['box_count']);
            for ($i = 1; $i <= $n; $i++) {
                if (!empty($_POST['pr' . $i . 'Name'])) {

                    $prName = clean_inputs($_POST['pr' . $i . 'Name']);

                    $prAge = clean_inputs($_POST['pr' . $i . 'Age']);
                    $prAge = englishNumber($prAge);

                    $pr1Sql = "INSERT INTO house_holding_database_children (linkedForm, personName, personAge) VALUES ('{$formID}', '{$prName}', '{$prAge}')";
                    mysqli_query($db, $pr1Sql);
                }
            }


            $sql = "INSERT INTO house_holding_database (formID, lastUpdate, lastIP, idNumber, pinNumber, cardStatus, holdingType, personName, guardianType, guardianName, motherName, gender, maritalStatus, birthDate, idType, idNo, mobile, religion, familyCondition, maleNumber, femaleNumber, applicationFee, paymentType, allowanceType, allowanceAmount, disability, freedomFighter, waterConnection, nidHolder, isVoter, landAmount, holdingNo, wardNo, village, zip, post, electricity, sanitation, houseType, totalHouse, occupation, lastTaxDate, unemployedMember, workerMember, voterNumber, homeLandAmount, agriLandAmount, maleDisabilityNumber, femaleDisabilityNumber, maleChildNumber, femaleChildNumber, isAllowance, allowanceMember, disabilityNumber, familyIncome, isChildEducation, childEducationNumber, personAge, totalFamilyMember, dataEntryBy) VALUES ('{$formID}', '{$lastUpdate}', '{$lastIP}', '{$idNumber}', '{$pinNumber}', '{$cardStatus}', '{$holdingType}', '{$personName}', '{$guardianType}', '{$guardianName}', '{$motherName}', '{$gender}', '{$maritalStatus}', '{$birthDate}', '{$idType}', '{$idNo}', '{$mobile}', '{$religion}', '{$familyCondition}', '{$maleNumber}', '{$femaleNumber}', '{$applicationFee}', '{$paymentType}', '{$allowanceType}', '{$allowanceAmount}', '{$disability}', '{$freedomFighter}', '{$waterConnection}', '{$nidHolder}', '{$voter}', '{$landAmount}', '{$holdingNo}', '{$wardNo}', '{$village}', '{$zip}', '{$post}', '{$electricity}', '{$sanitation}', '{$houseType}', '{$totalHouse}', '{$occupation}', '{$lastTaxDate}', '{$unemployedMember}', '{$workerMember}', '{$voterNumber}', '{$homeLandAmount}', '{$agriLandAmount}', '{$maleDisabilityNumber}', '{$femaleDisabilityNumber}', '{$maleChildNumber}', '{$femaleChildNumber}', '{$isAllowance}', '{$allowanceMember}', '{$disabilityNumber}', '{$familyIncome}', '{$isChildEducation}', '{$childEducationNumber}', '{$personAge}', '{$totalFamilyMember}', '{$entryPersonId}')";

            // check if mobile inputted
            if (!empty($mobile)) {
                $mobileLength = strlen($mobile); // count digit
            } else {
                $mobileLength = 11; // if empty then sudo length
            }

            if ($mobileLength == 11) {

                // check if nid inputted
                if (!empty($idNo)) {
                    $idNoLength = strlen($idNo); // count digit
                } else {
                    $idNoLength = 10; // if empty then sudo length
                }

                if ($idNoLength == 10 OR $idNoLength == 13 OR $idNoLength == 17) {

                    if (mysqli_query($db, $sql)) {

                        echo "<div class='reg-form-message-green'><br/><i class='fa fa-check'></i> <b>তথ্যটি সংরক্ষণ করা হয়েছে!</b><br/><br/><button type='button' onclick='showForm();' name='renew-btn' class='cancel-btn'>আরেকটি তথ্য সংরক্ষণ করুন</button></div>
                        
                        ";

                    } else {
                        echo "<div class='reg-form-message-error'><br/><i class='fa fa-close'></i> <b>তথ্যটি সংরক্ষণ করা যাচ্ছে না!</b><br/><br/><button type='button' onclick='showForm();' name='renew-btn' class='cancel-btn'><i class='fa fa-refresh'></i> আবার চেষ্টা করুন</button></div>
                        ";
                    }

                } else {
                    echo "<div class='reg-form-message-error'><br/><i class='fa fa-close'></i> <b>পরিচয় পত্র নাম্বারটি সঠিকভাবে দিন!</b><br/><br/><p>(১০, ১৩ অথবা ১৭ সংখ্যার পরিচয় পত্র নাম্বার গ্রহণযোগ্য)</p><br/><button type='button' onclick='reTryForm();' name='renew-btn' class='cancel-btn'><i class='fa fa-refresh'></i> আবার চেষ্টা করুন</button></div>
                    ";
                }

            } else {
                echo "<div class='reg-form-message-error'><br/><i class='fa fa-close'></i> <b>১১ সংখ্যার মোবাইল নাম্বারটি সঠিকভাবে দিন!</b><br/><br/><button type='button' onclick='reTryForm();' name='renew-btn' class='cancel-btn'><i class='fa fa-refresh'></i> আবার চেষ্টা করুন</button></div>
                    ";
            }

        } else {
            echo "<div class='reg-form-message-error'><br/><i class='fa fa-close'></i> <b>পরিচয় পত্র নাম্বারটি পূর্বেই ব্যবহৃত হয়েছে!</b><br/><br/><button type='button' onclick='reTryForm();' name='renew-btn' class='cancel-btn'><i class='fa fa-refresh'></i> আবার চেষ্টা করুন</button></div>
                    ";
        }

    } else {
        echo "<div class='reg-form-message-error'><br/><i class='fa fa-close'></i> <b>কার্ড আইডিটি পূর্বেই ব্যবহৃত হয়েছে!</b><br/><br/><button type='button' onclick='reTryForm();' name='renew-btn' class='cancel-btn'><i class='fa fa-refresh'></i> আবার চেষ্টা করুন</button></div>
                    ";
    }

// end of checking!



} else {
    include "../not-found.php";
    exit();
}

?>