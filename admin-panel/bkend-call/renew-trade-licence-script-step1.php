<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    include "../config/database-connection.php";

    if (isset($_POST["citizenCardNo"])) {

        $citizenCardNo = strip_tags($_POST['citizenCardNo']);
        $citizenCardNo = htmlspecialchars($citizenCardNo);
        $citizenCardNo = mysqli_real_escape_string($db, $citizenCardNo);

        if ($citizenCardNo != "") {

            $sql_query = "SELECT * FROM `trade_license_database` WHERE idNumber='$citizenCardNo'";
            $result = mysqli_query($db, $sql_query);
            $count = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);

            if ($count == 1) {


                function banglaNumber($englishToBangla) {
                    $englishNum=array("0","1","2","3","4","5",'6',"7","8","9","-");
                    $banglaNum=array("০","১","২","৩","৪","৫",'৬',"৭","৮","৯","/");
                    return str_replace($englishNum,$banglaNum,$englishToBangla);
                }


                echo "
                <div class='dashboard-table-container' style='margin-top: 25px;'>
            <p class='dashboard-table-container-heading'>ট্রেড লাইসেন্স নবায়ন তথ্য</p>
            <div class='dashboard-table-container-div'>
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <label>নামঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='fullName' id='fullName' autocomplete='off' value='{$row['proprietorName']}' readonly>
                        </td>
                        <td>
                            <label>মোবাইলঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='mobile' id='mobile' autocomplete='off' value='{$row['mobile']}' readonly>
                        </td>
                        <td>
                            <label>নবায়নের শুরুর তারিখঃ<i style='color: red;'>*</i></label>
                            <input type='date' name='renewStartDate' id='renewStartDate' autocomplete='off' value=''>
                        </td>
                        <td>
                            <label>নবায়নের শেষের তারিখঃ<i style='color: red;'>*</i></label>
                            <input type='date' name='renewEndDate' id='renewEndDate' autocomplete='off' value=''>
                        </td>
                     </tr>
                     <tr>
                        <td>
                            <label>ট্রেড লাইসেন্স নংঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='tradeLicNo' id='tradeLicNo' autocomplete='off' value='{$row['tradeLicense']}' readonly>
                        </td>
                        <td>
                            <label>ব্যবসা প্রতিষ্ঠানের নামঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='businessName' id='businessName' autocomplete='off' value='{$row['businessName']}' readonly>
                        </td>
                        <td>
                            <label>ব্যবসার ধরণঃ<i style='color: red;'>*</i></label>
                            <select name='businessType' id='businessType'>
                                <option value='{$row['businessType']}' selected>{$row['businessType']}</option>
                            </select>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>ট্রেড লাইসেন্স ফিঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='tradeLicFee' id='tradeLicFee' autocomplete='off' value=''>
                        </td>
                        <td>
                            <label>সাইনবোর্ড করঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='signboardTax' id='signboardTax' autocomplete='off' value=''>
                        </td>
                        <td>
                            <label>ভ্যাটঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='totalTax' id='totalTax' autocomplete='off' value=''>
                        </td>
                        <td>
                            <label>সর্বমোট টাকাঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='totalAmount' id='totalAmount' autocomplete='off' value=''>
                        </td>
                        </tr>
                    </tbody>
                </table>
        
            <input type='hidden' name='linkedForm' id='linkedForm' value='{$row['formID']}'>
        <button style='margin-bottom: 10px;' type='button' name='submit-btn' id='submit-btn'><i class='fa fa-save'></i> সংরক্ষণ করুন</button>

            </div>
        </div>
        ";



                    echo "
                <div style='margin-top: 25px;'>
                    <h3 style='font-family:Bangla;color: #5e5e5e;border-bottom:1px solid #5e5e5e;'>পূর্বে ট্রেড লাইসেন্স নবায়নের তথ্যঃ</h3>
                    ";

                $sqlPr = "SELECT * FROM renew_trade_licence_database WHERE (linkedForm = '$row[formID]') ORDER BY id ASC";
                $resultPr = mysqli_query($db, $sqlPr);

                if (mysqli_num_rows($resultPr) > 0) {

                    echo "
                <table class='responstable' style='padding: 0;'>
            <tbody>
                <tr>
                    <th>নাম</th>
                    <th class='table-display'>ট্রেড লাইসেন্স নং</th>
                    <th>নবায়নের তারিখ</th>
                    <th class='table-display'>ট্রেড লাইসেন্স ফি</th>
                    <th class='table-display'>সাইনবোর্ড কর</th>
                    <th class='table-display'>ভ্যাট</th>
                    <th>মোট টাকা</th>
                    <th>পেমেন্ট স্ট্যাটাস</th>
                    <th style='width: 40px;' class='table-display'></th>
                </tr>
                ";

                    while ($rowPr = mysqli_fetch_assoc($resultPr)) {

                        $bDate1=$rowPr['renewStartDate'];
                        $format_bDate1=date("d-m-Y",strtotime($bDate1));
                        $format_bDate1 = banglaNumber($format_bDate1);
                        $bDate2=$rowPr['renewEndDate'];
                        $format_bDate2=date("d-m-Y",strtotime($bDate2));
                        $format_bDate2 = banglaNumber($format_bDate2);


                        if ($rowPr['paymentStatus'] == "Paid") {
                            $paymentClass = "paymentDone";
                        } else {
                            $paymentClass = "paymentDue";
                        }

                        $tradeLicFee = banglaNumber($rowPr['tradeLicFee']);
                        $signboardTax = banglaNumber($rowPr['signboardTax']);
                        $totalTax = banglaNumber($rowPr['totalTax']);
                        $totalAmount = banglaNumber($rowPr['totalAmount']);

                        echo "
                    <tr>
                        <td>{$rowPr['fullName']}</td>
                        <td class='table-display'>{$rowPr['tradeLicNo']}</td>
                        <td>{$format_bDate1} হইতে {$format_bDate2}</td>
                        <td class='table-display'>{$tradeLicFee} টাকা</td>
                        <td class='table-display'>{$signboardTax} টাকা</td>
                        <td class='table-display'>{$totalTax} টাকা</td>
                        <td>{$totalAmount} টাকা</td>
                        <td>
                        <a class='{$paymentClass}'>{$rowPr['paymentStatus']}</a>
                        </td>
                        <td style='color: orangered;' class='table-display'>
                        ";


                        if ($rowPr['paymentStatus'] == "Paid") {
                            $recordEditClass = "";
                        } else {
                            $recordEditClass = "<a class='trade-edit' style='cursor:pointer;' data-formid='{$rowPr['linkedForm']}' data-tradeid='{$rowPr['renewTradeID']}'>
                                <i class='fa fa-edit'></i>
                            </a>";
                        }

                        echo "
                            {$recordEditClass}
                        </td>
                    </tr>";

                    }

                        echo "
            </tbody>
        </table>
            </div>
                    ";

                    } else {

                    echo "<p style='font-size: 16px;font-family: Bangla;text-align: left;padding: 20px 0;font-style: italic;color: #ff3333;'><i class='fa fa-warning'></i> কোনো তথ্য পাওয়া যায় নি!</p>";
                }



                echo "
        <script>
    $(document).ready(function () {
        $('#submit-btn').click(function () {
            
            var linkedForm = $('#linkedForm').val().trim();
            var fullName = $('#fullName').val().trim();
            var mobile = $('#mobile').val().trim();
            var renewStartDate = $('#renewStartDate').val().trim();
            var renewEndDate = $('#renewEndDate').val().trim();
            var tradeLicNo = $('#tradeLicNo').val().trim();
            var businessName = $('#businessName').val().trim();
            var businessType = $('#businessType').val().trim();
            var tradeLicFee = $('#tradeLicFee').val().trim();
            var signboardTax = $('#signboardTax').val().trim();
            var totalTax = $('#totalTax').val().trim();
            var totalAmount = $('#totalAmount').val().trim();

            if(linkedForm == '' || fullName == '' || mobile == '' || renewStartDate == '' || renewEndDate == '' || tradeLicNo == '' || businessName == '' || businessType == '' || tradeLicFee == '' || signboardTax == '' || totalTax == '' || totalAmount == '') {

                alert('ফর্মটি সঠিকভাবে পূরণ করুন!');

            } else {

                $.ajax({
                    url: 'script/renew-trade-licence-script-step2',
                    type: 'POST',
                    data: {
                        linkedForm: linkedForm,
                        fullName: fullName,
                        mobile: mobile,
                        renewStartDate: renewStartDate,
                        renewEndDate: renewEndDate,
                        tradeLicNo: tradeLicNo,
                        businessName: businessName,
                        businessType: businessType,
                        tradeLicFee: tradeLicFee,
                        signboardTax: signboardTax,
                        totalTax: totalTax,
                        totalAmount: totalAmount
                    },
                    beforeSend: function () {
                        $('#loader').show();
                    },
                    success: function (data) {
                        $('#response').fadeIn();
                        $('#response').html(data);
                        $('#loader').hide();
                    }
                });
                
                } 
            
        });
    });
        </script>
        ";


                echo "
        <script>
    $(document).ready(function () {
        $('.trade-edit').click(function () {
            
            var formID = $(this).data('formid');
            var tradeID = $(this).data('tradeid');

            if(formID == '' || tradeID == '') {

                alert('পেইজ রিফ্রেশ করে আবার চেষ্টা করুন!');

            } else {

                $.ajax({
                    url: 'script/renew-trade-licence-script-step-edit',
                    type: 'POST',
                    data: {
                        formID: formID,
                        tradeID: tradeID
                    },
                    beforeSend: function () {
                        $('#loader').show();
                    },
                    success: function (data) {
                        $('#response').fadeIn();
                        $('#response').html(data);
                        $('#loader').hide();
                    }
                });
                
                } 
            
        });
    });
        </script>
        ";

                exit();

            } else {
                echo "<br/><br/><div class='error_msg'><i style='font-size: 26px;' class='fa fa-warning'></i><br/>আইডি নাম্বারটি খুঁজে পাওয়া যায় নি!</div>";
                exit();
            }

        } else {
            echo "<br/><br/><div class='error_msg'>সবগুলো তথ্য সঠিকভাবে দিন!</div>";
            exit();
        }

    }


    if (!isset($_POST["citizenCardNo"])) {
        exit();
    }


} else {
    include "../not-found.php";
    exit();
}


?>