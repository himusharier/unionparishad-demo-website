<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    include "../config/database-connection.php";

    if (isset($_POST["formID"]) && isset($_POST["allowID"])) {

        $formID = strip_tags($_POST['formID']);
        $formID = htmlspecialchars($formID);
        $formID = mysqli_real_escape_string($db, $formID);

        $allowID = strip_tags($_POST['allowID']);
        $allowID = htmlspecialchars($allowID);
        $allowID = mysqli_real_escape_string($db, $allowID);

        if ($formID != "" && $allowID != "") {

            $sql_query = "SELECT * FROM `allowance_given_database` WHERE (linkedForm='$formID' AND allowanceID = '$allowID')";
            $result = mysqli_query($db, $sql_query);
            $count = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);

            if ($count == 1) {

                    echo "
                <div class='dashboard-table-container' style='margin-top: 25px;'>
            <p class='dashboard-table-container-heading'>ভাতা প্রেরণ তথ্য সংশোধন</p>
            <div class='dashboard-table-container-div'>
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <label>নামঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='fullName' id='fullName' autocomplete='off' value='{$row['fullName']}' readonly>
                        </td>
                        <td>
                            <label>মোবাইলঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='mobile' id='mobile' autocomplete='off' value='{$row['mobile']}' readonly>
                        </td>
                        <td>
                            <label>ভাতা প্রেরণের তারিখঃ<i style='color: red;'>*</i></label>
                            <input type='date' name='givenDate' id='givenDate' autocomplete='off' value='{$row['givenDate']}'>
                        </td>
                        </tr>
                        <tr>
                        <td>
                            <label>ভাতার ধরণঃ<i style='color: red;'>*</i></label>
                            <select name='allowanceType' id='allowanceType'>
                                <option value='{$row['allowanceType']}' selected>{$row['allowanceType']}</option>
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
                            <input type='text' name='allowanceAmount' id='allowanceAmount' autocomplete='off' value='{$row['allowanceAmount']}'>
                        </td>
                        <td>
                            <label>ভাতা সংক্রান্ত বিস্তারিতঃ</label>
                            <input type='text' name='allowanceDetails' id='allowanceDetails' autocomplete='off' value='{$row['allowanceDetails']}'>
                        </td>
                    </tr>
                    </tbody>
                </table>
        
            <input type='hidden' name='linkedForm' id='linkedForm' value='{$row['linkedForm']}'>
            <input type='hidden' name='allowanceID' id='allowanceID' value='{$row['allowanceID']}'>
        <button style='margin-bottom: 10px;' type='button' name='submit-btn' id='submit-btn'><i class='fa fa-save'></i> সংশোধন করুন</button>
        <button style='margin-bottom: 10px;' type='button' name='delete-btn' id='delete-btn' class='delete-btn'><i class='fa fa-trash'></i> বাতিল করুন</button>

            </div>
        </div>
        ";






                echo "
        <script>
    $(document).ready(function () {
        $('#submit-btn').click(function () {
            
            var fullName = $('#fullName').val().trim();
            var mobile = $('#mobile').val().trim();
            var givenDate = $('#givenDate').val().trim();
            var allowanceType = $('#allowanceType').val().trim();
            var allowanceAmount = $('#allowanceAmount').val().trim();
            var allowanceDetails = $('#allowanceDetails').val().trim();
            var linkedForm = $('#linkedForm').val().trim();
            var allowanceID = $('#allowanceID').val().trim();

            if(fullName == '' || mobile == '' || givenDate == '' || allowanceType == '' || allowanceAmount == '' || linkedForm == '' || allowanceID == '') {

                alert('ফর্মটি সঠিকভাবে পূরণ করুন!');

            } else {

                $.ajax({
                    url: 'script/allowance-given-script-step-edit-2',
                    type: 'POST',
                    data: {
                        fullName: fullName,
                        mobile: mobile,
                        givenDate: givenDate,
                        allowanceType: allowanceType,
                        allowanceAmount: allowanceAmount,
                        allowanceDetails: allowanceDetails,
                        linkedForm: linkedForm,
                        allowanceID: allowanceID
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
        $('#delete-btn').click(function () {
            
            
            var conf = confirm('আপনি কি এই তথ্যটি বাতিল করতে চান?');
            
            if (conf === true) {
            
            var linkedForm = $('#linkedForm').val().trim();
            var allowanceID = $('#allowanceID').val().trim();

            if(linkedForm == '' || allowanceID == '') {

                alert('ফর্মটি সঠিকভাবে পূরণ করুন!');

            } else {

                $.ajax({
                    url: 'script/allowance-given-script-step-edit-delete',
                    type: 'POST',
                    data: {
                        linkedForm: linkedForm,
                        allowanceID: allowanceID
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


    if (!isset($_POST["formID"]) && !isset($_POST["allowID"])) {
        exit();
    }


} else {
    include "../not-found.php";
    exit();
}


?>