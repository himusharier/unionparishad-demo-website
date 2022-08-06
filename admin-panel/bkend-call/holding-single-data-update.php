<?php

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['formID']) && !isset($_POST['delete-btn'])) {

    include "../config/database-connection.php";

    $formID = $_POST['formID'];

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


    $n = clean_inputs($_POST['box_count']);
    for($i=1;$i<=$n;$i++) {
        if (isset($_POST['pr'.$i.'FamilyId'])) {
            $prFamilyId = clean_inputs($_POST['pr'.$i.'FamilyId']);

            $prName = clean_inputs($_POST['pr' . $i . 'Name']);

            $prAge = clean_inputs($_POST['pr' . $i . 'Age']);
            $prAge = englishNumber($prAge);

            $pr1Sql = "UPDATE house_holding_database_children SET personName='$prName', personAge='$prAge' WHERE (linkedForm='$formID' AND id='$prFamilyId')";
            mysqli_query($db, $pr1Sql);
        } else {
            if (!empty($_POST['pr'.$i.'Name'])) {
                $prName = clean_inputs($_POST['pr' . $i . 'Name']);

                $prAge = clean_inputs($_POST['pr' . $i . 'Age']);
                $prAge = englishNumber($prAge);

                $pr1Sql = "INSERT INTO house_holding_database_children (linkedForm, personName, personAge) VALUES ('$formID', '$prName', '$prAge')";
                mysqli_query($db, $pr1Sql);
            }
        }

    }



    $sql = "UPDATE house_holding_database SET lastUpdate='$lastUpdate', lastIP='$lastIP', idNumber='$idNumber', pinNumber='$pinNumber', cardStatus='$cardStatus', holdingType='$holdingType', personName='$personName', guardianType='$guardianType', guardianName='$guardianName', motherName='$motherName', gender='$gender', maritalStatus='$maritalStatus', birthDate='$birthDate', idType='$idType', idNo='$idNo', mobile='$mobile', religion='$religion', familyCondition='$familyCondition', maleNumber='$maleNumber', femaleNumber='$femaleNumber', applicationFee='$applicationFee', paymentType='$paymentType', allowanceType='$allowanceType', allowanceAmount='$allowanceAmount', disability='$disability', freedomFighter='$freedomFighter', waterConnection='$waterConnection', nidHolder='$nidHolder', isVoter='$voter', landAmount='$landAmount', holdingNo='$holdingNo', wardNo='$wardNo', village='$village', zip='$zip', post='$post', electricity='$electricity', sanitation='$sanitation', houseType='$houseType', totalHouse='$totalHouse', occupation='$occupation', lastTaxDate='$lastTaxDate', unemployedMember='$unemployedMember', workerMember='$workerMember', voterNumber='$voterNumber', homeLandAmount='$homeLandAmount', agriLandAmount='$agriLandAmount', maleDisabilityNumber='$maleDisabilityNumber', femaleDisabilityNumber='$femaleDisabilityNumber', maleChildNumber='$maleChildNumber', femaleChildNumber='$femaleChildNumber', isAllowance='$isAllowance', allowanceMember='$allowanceMember', disabilityNumber='$disabilityNumber', familyIncome='$familyIncome', isChildEducation='$isChildEducation', childEducationNumber='$childEducationNumber', personAge='$personAge', totalFamilyMember='$totalFamilyMember' WHERE (formID='$formID')";

        if (mysqli_query($db, $sql)) {

            echo "<div class='reg-form-message-green'><br/><i class='fa fa-check'></i> <b>তথ্যটি সংশোধন করা হয়েছে!</b><br/><br/><a href='admin/list-house-holding' class='cancel-btn'><i class='fa fa-arrow-left'></i> মূল তালিকায় ফিরে যান</a></div>
                    
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