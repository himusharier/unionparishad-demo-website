<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    include "../config/database-connection.php";

    if (isset($_POST["citizenCardNo"])) {

        $citizenCardNo = strip_tags($_POST['citizenCardNo']);
        $citizenCardNo = htmlspecialchars($citizenCardNo);
        $citizenCardNo = mysqli_real_escape_string($db, $citizenCardNo);

        if ($citizenCardNo != "") {

            $sql_query = "SELECT * FROM `house_holding_database` WHERE idNumber='$citizenCardNo'";
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
            <p class='dashboard-table-container-heading'>ভাতা প্রেরণ তথ্য</p>
            <div class='dashboard-table-container-div'>
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <label>নামঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='fullName' id='fullName' autocomplete='off' value='{$row['personName']}' readonly>
                        </td>
                        <td>
                            <label>মোবাইলঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='mobile' id='mobile' autocomplete='off' value='{$row['mobile']}' readonly>
                        </td>
                        <td>
                            <label>ভাতা প্রেরণের তারিখঃ<i style='color: red;'>*</i></label>
                            <input type='date' name='givenDate' id='givenDate' autocomplete='off' value=''>
                        </td>
                        </tr>
                        <tr>
                        <td>
                            <label>ভাতার ধরণঃ<i style='color: red;'>*</i></label>
                            <select name='allowanceType' id='allowanceType'>
                                <option value='' selected>-- নির্বাচন করুন --</option>
                                <option value='কোনো ভাতা প্রদান করা হয়নি'>কোনো ভাতা প্রদান করা হয়নি</option>
                                <option value='বয়স্ক ভাতা'>বয়স্ক ভাতা</option>
                                <option value='প্রতিবন্ধী ভাতা'>প্রতিবন্ধী ভাতা</option>
                                <option value='বিধবা ভাতা'>বিধবা ভাতা</option>
                                <option value='মুক্তিযোদ্ধা ভাতা'>মুক্তিযোদ্ধা ভাতা</option>
                                <option value='চাল'>চাল</option>
                                <option value='দৃষ্টি প্রতিবন্ধী'>দৃষ্টি প্রতিবন্ধী</option>
                                <option value='বাকপ্রতিবন্ধী'>বাকপ্রতিবন্ধী</option>
                                <option value='মানসিক প্রতিবন্ধী'>মানসিক প্রতিবন্ধী</option>
                                <option value='পঙ্গু'>পঙ্গু</option>
                                <option value='ধানের বীজ'>ধানের বীজ</option>
                                <option value='শীতের কম্বল'>শীতের কম্বল</option>
                                <option value='নগদ অর্থ প্রদান'>নগদ অর্থ প্রদান</option>
                                <option value='বীজ'>বীজ</option>
                            </select>
                        </td>
                        <td>
                            <label>ভাতার পরিমাণঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='allowanceAmount' id='allowanceAmount' autocomplete='off' value=''>
                        </td>
                        <td>
                            <label>ভাতা সংক্রান্ত বিস্তারিতঃ</label>
                            <input type='text' name='allowanceDetails' id='allowanceDetails' autocomplete='off' value=''>
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
                    <h3 style='font-family:Bangla;color: #5e5e5e;border-bottom:1px solid #5e5e5e;'>পূর্বে প্রেরিত ভাতার তথ্যঃ</h3>
                    ";

                $sqlPr = "SELECT * FROM allowance_given_database WHERE (linkedForm = '$row[formID]') ORDER BY id ASC";
                $resultPr = mysqli_query($db, $sqlPr);

                if (mysqli_num_rows($resultPr) > 0) {

                    echo "
                <table class='responstable' style='padding: 0;'>
            <tbody>
                <tr>
                    <th>নাম</th>
                    <th class='table-display'>মোবাইল</th>
                    <th>ভাতা প্রেরণের তারিখ</th>
                    <th>ভাতার ধরণ</th>
                    <th>ভাতার পরিমাণ</th>
                    <th class='table-display'>ভাতা সংক্রান্ত বিস্তারিত</th>
                    <th style='width: 40px;' class='table-display'></th>
                </tr>
                ";

                    while ($rowPr = mysqli_fetch_assoc($resultPr)) {

                        $bDate1=$rowPr['givenDate'];
                        $format_bDate1=date("d-m-Y",strtotime($bDate1));
                        $format_bDate1 = banglaNumber($format_bDate1);

                        $allowanceAmount = banglaNumber($rowPr['allowanceAmount']);

                        echo "
                    <tr>
                        <td>{$rowPr['fullName']}</td>
                        <td class='table-display'>{$rowPr['mobile']}</td>
                        <td>{$format_bDate1}</td>
                        <td>{$rowPr['allowanceType']}</td>
                        <td>{$allowanceAmount} টাকা</td>
                        <td class='table-display'>{$rowPr['allowanceDetails']}</td>
                        <td style='color: orangered;' class='table-display'>
                            <a class='allowance-edit' style='cursor:pointer;' data-formid='{$rowPr['linkedForm']}' data-allowid='{$rowPr['allowanceID']}'>
                                <i class='fa fa-edit'></i>
                            </a>
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
            var givenDate = $('#givenDate').val().trim();
            var allowanceType = $('#allowanceType').val().trim();
            var allowanceAmount = $('#allowanceAmount').val().trim();
            var allowanceDetails = $('#allowanceDetails').val().trim();

            if(linkedForm == '' || fullName == '' || mobile == '' || givenDate == '' || allowanceType == '' || allowanceAmount == '') {

                alert('ফর্মটি সঠিকভাবে পূরণ করুন!');

            } else {

                $.ajax({
                    url: 'script/allowance-given-script-step2',
                    type: 'POST',
                    data: {
                        linkedForm: linkedForm,
                        fullName: fullName,
                        mobile: mobile,
                        givenDate: givenDate,
                        allowanceType: allowanceType,
                        allowanceAmount: allowanceAmount,
                        allowanceDetails: allowanceDetails
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
        $('.allowance-edit').click(function () {
            
            var formID = $(this).data('formid');
            var allowID = $(this).data('allowid');

            if(formID == '' || allowID == '') {

                alert('পেইজ রিফ্রেশ করে আবার চেষ্টা করুন!');

            } else {

                $.ajax({
                    url: 'script/allowance-given-script-step-edit',
                    type: 'POST',
                    data: {
                        formID: formID,
                        allowID: allowID
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