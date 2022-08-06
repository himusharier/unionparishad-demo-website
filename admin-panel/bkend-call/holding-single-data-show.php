<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (empty($_POST["formID"])) {
        die();
    }

    include "../config/database-connection.php";

    $formID = $_POST["formID"];

    $sql = "SELECT * FROM house_holding_database WHERE formID = {$formID}";
    $result = mysqli_query($db, $sql) or die("Not Found!");
    $output = '';

    function banglaNumber($englishToBangla) {
        $englishNum=array("0","1","2","3","4","5",'6',"7","8","9","-");
        $banglaNum=array("০","১","২","৩","৪","৫",'৬',"৭","৮","৯","/");
        return str_replace($englishNum,$banglaNum,$englishToBangla);
    }

    $year = banglaNumber(date("Y"));
    $date = banglaNumber(date("d/m/Y"));

    if (mysqli_num_rows($result) == 1) {

        while ($row = banglaNumber(mysqli_fetch_assoc($result))) {

            if (!empty($row['birthDate'])) {
                $bDate1 = $row['birthDate'];
                $format_bDate = date("d/m/Y", strtotime($bDate1));
            } else {
                $format_bDate = "";
            }

            $output .= "
            <style>
            input {font-family:'Bangla';}
            </style>
            <img style='display:none;' src='assets/images/watermark.png' />
            <div class='print-header'>
            <img src='assets/images/logo-site.jpg' height='80' />
            <div style='margin-left:20%;'>
                <p style='font-size:24px;font-weight:bold;'>ইউনিয়ন পরিষদ<br/>
                    <div style='font-size:14px;font-weight:400;text-align:center;'>
                    </div>
                </p>
            </div>
            </div>
            <div class='print-header-bottom'>
                <p>স্মারক নংঃ ইউ/পরি/২০</p>
                <p>তারিখঃ {$date} ইং</p>
            </div>
            
            <h3 style='font-family: Bangla; text-decoration: underline;'>কার্ড সংক্রান্ত তথ্যঃ</h3>
            <table style='margin-top: -5px;'>
                 <tbody>
                <tr>
                    <td>
                        <label>কার্ড নাম্বারঃ</label>
                        <input type='text' name='idNumber' id='idNumber' autocomplete='off' disabled value='{$row['idNumber']}'>
                    </td>
                    <td>
                        <label>পিন নাম্বারঃ</label>
                        <input type='text' name='pinNumber' id='idNumber' autocomplete='off' disabled value='{$row['pinNumber']}'>
                    </td>
                    <td>
                        <label>কার্ড স্ট্যাটাসঃ</label>
                        <input type='text' name='cardStatus' id='cardStatus' autocomplete='off' disabled value='{$row['cardStatus']}'>
                    </td>
                </tr>
                </tbody>
            </table>
            
            <br/>
            
            <h3 style='font-family: Bangla; text-decoration: underline;'>ঠিকানাঃ</h3>
            <table style='margin-top: -5px;'>
                 <tbody>
                <tr>
                    <td>
                        <label>হোল্ডিং নংঃ</label>
                        <input type='text' name='holdingNo' disabled value='{$row['holdingNo']}'>
                    </td>
                    <td>
                        <label>ওয়ার্ড নংঃ</label>
                        <input type='text' name='wardNo' disabled value='{$row['wardNo']}'>
                    </td>
                    <td>
                        <label>গ্রামঃ</label>
                        <input type='text' name='village' disabled value='{$row['village']}'>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>পোস্টাল কোড / জিপ কোডঃ</label>
                        <input type='text' name='zip' disabled value='{$row['zip']}'>
                    </td>
                    <td>
                        <label>ডাকঘরঃ</label>
                        <input type='text' name='post' disabled value='{$row['post']}'>
                    </td>
                    <td></td>
                </tr>
                </tbody>
            </table>
            
            <br/>
            
            <h3 style='font-family: Bangla; text-decoration: underline;'>সাধারণ তথ্যঃ</h3>
            <table style='margin-top: -5px;'>
                
                <tbody>
                <tr>
                    <td>
                        <label>হোল্ডিং এর ধরণঃ</label>
                        <select name='holdingType' id='holdingType'>
                            <option value='{$row['holdingType']}' selected>{$row['holdingType']}</option>
                        </select>
                    </td>
                    <td>
                        <label>সুবিধাভোগীর নামঃ</label>
                        <input type='text' name='personName' id='personName' autocomplete='off' disabled value='{$row['personName']}'>
                    </td>
                    <td>
                        <label>পিতা/ স্বামীর নামঃ</label>
                        <input type='text' name='guardianName' autocomplete='off' disabled value='{$row['guardianName']}'>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>মায়ের নামঃ</label>
                        <input type='text' name='motherName' autocomplete='off' disabled value='{$row['motherName']}'>
                    </td>
                    <td>
                        <label>লিঙ্গঃ</label>
                        <select name='gender'>
                            <option value='{$row['gender']}' selected>{$row['gender']}</option>
                        </select>
                    </td>
                    <td>
                        <label>মোবাইল নাম্বারঃ</label>
                        <input type='text' name='mobile' autocomplete='off' disabled value='{$row['mobile']}'>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>পরিচয় পত্রের নাম্বারঃ (এনআইডি/ জন্ম সনদ)</label>
                        <input type='text' name='idNo' autocomplete='off' disabled value='{$row['idNo']}'>
                    </td>
                    <td>
                        <label>বয়সঃ</label>
                        <input type='text' name='personAge' autocomplete='off' disabled value='{$row['personAge']}'>
                    </td>
                    <td>
                        <label>ধর্মঃ</label>
                        <select name='religion'>
                            <option value='{$row['religion']}' selected>{$row['religion']}</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>পরিবারে মোট সদস্য সংখ্যাঃ</label>
                        <input type='text' name='totalFamilyMember' autocomplete='off' disabled value='{$row['totalFamilyMember']}'>
                    </td>
                    <td>
                        <label>পুরুষ সদস্য সংখ্যাঃ</label>
                        <input type='text' name='maleNumber' autocomplete='off' disabled value='{$row['maleNumber']}'>
                    </td>
                    <td>
                        <label>মহিলা সদস্য সংখ্যাঃ</label>
                        <input type='text' name='femaleNumber' autocomplete='off' disabled value='{$row['femaleNumber']}'>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>ছেলে সন্তান কতজন?</label>
                        <input type='text' name='maleChildNumber' autocomplete='off' disabled value='{$row['maleChildNumber']}'>
                    </td>
                    <td>
                        <label>মেয়ে সন্তান কতজন?</label>
                        <input type='text' name='femaleChildNumber' autocomplete='off' disabled value='{$row['femaleChildNumber']}'>
                    </td>
                    <td>
                        <label>নিবন্ধন ফিঃ</label>
                        <input type='text' name='applicationFee' autocomplete='off' disabled value='{$row['applicationFee']}'>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>পেমেন্টের ধরনঃ</label>
                        <select name='paymentType'>
                            <option value='{$row['paymentType']}' selected>{$row['paymentType']}</option>
                        </select>
                    </td>
                    <td>
                        <label>আপনি কি ভাতা পান?</label>
                        <select name='isAllowance'>
                            <option value='{$row['isAllowance']}' selected>{$row['isAllowance']}</option>
                        </select>
                    </td>
                    <td>
                        <label>ভাতা নির্বাচন করুনঃ</label>
                        <select name='allowanceType'>
                            <option value='{$row['allowanceType']}' selected>{$row['allowanceType']}</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>ভাতার পরিমানঃ (টাকা/অন্যান্য)</label>
                        <input type='text' name='allowanceAmount' autocomplete='off' disabled value='{$row['allowanceAmount']}'>
                    </td>
                    <td>
                        <label>পরিবারে কতজন ভাতা পান?</label>
                        <input type='text' name='allowanceMember' autocomplete='off' disabled value='{$row['allowanceMember']}'>
                    </td>
                    <td>
                        <label>পরিবারে কেউ প্রতিবন্ধী আছে?</label>
                        <select name='disability'>
                            <option value='{$row['disability']}' disabled selected>{$row['disability']}</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>প্রতিবন্ধী কতজন?</label>
                        <input type='text' name='disabilityNumber' disabled value='{$row['disabilityNumber']}'>
                    </td>
                    <td>
                        <label>ছেলে প্রতিবন্ধী সংখ্যাঃ</label>
                        <input type='text' name='maleDisabilityNumber' disabled value='{$row['maleDisabilityNumber']}'>
                    </td>
                    <td>
                        <label>মেয়ে প্রতিবন্ধী সংখ্যাঃ</label>
                        <input type='text' name='femaleDisabilityNumber' disabled value='{$row['femaleDisabilityNumber']}'>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>আপনি কি মুক্তিযোদ্ধা?</label>
                        <select name='freedomFighter'>
                            <option value='{$row['freedomFighter']}' selected>{$row['freedomFighter']}</option>
                        </select>
                    </td>
                    <td>
                        <label>পানির সংযোগ আছে কিনা?</label>
                        <select name='waterConnection'>
                            <option value='{$row['waterConnection']}' selected>{$row['waterConnection']}</option>
                        </select>
                    </td>
                    <td>
                        <label>আপনি কি ভোটার?</label>
                        <select name='voter'>
                            <option value='{$row['isVoter']}' selected>{$row['isVoter']}</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>পরিবারে ভোটার সংখ্যাঃ</label>
                        <input type='text' name='voterNumber' disabled value='{$row['voterNumber']}'>
                    </td>
                    <td>
                        <label>পরিবারে বেকার সদস্য সংখ্যাঃ</label>
                        <input type='text' name='unemployedMember' disabled value='{$row['unemployedMember']}'>
                    </td>
                    <td>
                        <label>পরিবারে কর্মজীবী সদস্য সংখ্যাঃ</label>
                        <input type='text' name='workerMember' disabled value='{$row['workerMember']}'>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>পরিবারের বার্ষিক আয় কত?</label>
                        <input type='text' name='familyIncome' disabled value='{$row['familyIncome']}'>
                    </td>
                    <td>
                        <label>পারিবারিক অবস্থার ধরনঃ</label>
                        <select name='familyCondition'>
                            <option value='{$row['familyCondition']}' selected>{$row['familyCondition']}</option>
                        </select>
                    </td>
                    <td>
                        <label>ছেলে-মেয়ে কি লেখাপড়া করে?</label>
                        <select name='isChildEducation'>
                            <option value='{$row['isChildEducation']}' selected>{$row['isChildEducation']}</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>কতজন লেখাপড়া করে?</label>
                        <input type='text' name='childEducationNumber' disabled value='{$row['childEducationNumber']}'>
                    </td>
                    <td>
                        <label>জমির পরিমাণঃ (শতাংশে)</label>
                        <input type='text' name='landAmount' autocomplete='off' disabled value='{$row['landAmount']}'>
                    </td>
                    <td>
                        <label>বসত বাড়ি জমির পরিমাণঃ</label>
                        <input type='text' name='homeLandAmount' disabled value='{$row['homeLandAmount']}'>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>আবাদী জমির পরিমাণঃ</label>
                        <input type='text' name='agriLandAmount' disabled value='{$row['agriLandAmount']}'>
                    </td>
                </tr>
                </tbody>
            </table>
            
            <br/>
            
            <h3 style='font-family: Bangla; text-decoration: underline;'>সন্তানাদি সংক্রান্ত তথ্যঃ</h3>
            
            <table style='margin-top: -5px;margin-bottom: 20px'>
                <tbody>
            ";

            $sqlPr = "SELECT * FROM house_holding_database_children WHERE linkedForm = {$formID} ORDER BY id ASC";
            $resultPr = mysqli_query($db, $sqlPr);

            if (mysqli_num_rows($resultPr) > 0) {

                while ($rowPr = banglaNumber(mysqli_fetch_assoc($resultPr))) {

                    $output .= "
            
            
                    <tr>
                        <td>
                            <label>সন্তানের নামঃ</label>
                            <input type='text' name='prName' disabled value='{$rowPr['personName']}'>
                        </td>
                        <td>
                            <label>সন্তানের বয়সঃ</label>
                            <input type='text' name='prAge' disabled value='{$rowPr['personAge']}'>
                        </td>
                    </tr>
        
        
        ";

                }
         
            } else {
                $output .= "<p style='font-family: Bangla; font-size: 16px; font-style: italic;margin-bottom: 20px;'>(কোনো তথ্য খুঁজে পাওয়া যায় নি!)</p>";
            }

            $output .= "
                </tbody>
            </table>
            <h3 style='font-family: Bangla; text-decoration: underline;'>অন্যান্য তথ্যঃ</h3>
            <table style='margin-top: -5px;'>
                <tbody>
                <tr>
                    <td>
                        <label>বৈদ্যুতিক অবস্থাঃ</label>
                        <select name='electricity'>
                            <option value='{$row['electricity']}' selected>{$row['electricity']}</option>
                        </select>
                    </td>
                    <td>
                        <label>স্যানিটেশনের অবস্থাঃ</label>
                        <select name='sanitation'>
                            <option value='{$row['sanitation']}' selected>{$row['sanitation']}</option>
                        </select>
                    </td>
                    <td>
                        <label>বাড়ির ধরনঃ</label>
                        <select name='houseType'>
                            <option value='{$row['houseType']}' selected>{$row['houseType']}</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>পেশাঃ</label>
                        <select name='occupation'>
                            <option value='{$row['occupation']}' selected>{$row['occupation']}</option>
                        </select>
                    </td>
                    <td>
                        <label>শেষ ট্যাক্স প্রদানের অর্থবছরঃ</label>
                        <select name='lastTaxDate'>
                            <option value='{$row['lastTaxDate']}' selected>{$row['lastTaxDate']}</option>
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>
            
            <br/>
            
            
        ";


        }

        echo $output;
    } else {
        echo "<div style='margin-top: 200px; text-align: center;'><p style='font-size: 24px; color: #cccccc;'><i class='fa fa-warning fa-2x''></i><br/>Empty</p></div>";
        exit();
    }


} else {
    exit();
}


?>