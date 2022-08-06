<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    include "../config/database-connection.php";

    if (isset($_POST["formID"]) && isset($_POST["holdingID"])) {

        $formID = strip_tags($_POST['formID']);
        $formID = htmlspecialchars($formID);
        $formID = mysqli_real_escape_string($db, $formID);

        $holdingID = strip_tags($_POST['holdingID']);
        $holdingID = htmlspecialchars($holdingID);
        $holdingID = mysqli_real_escape_string($db, $holdingID);

        if ($formID != "" && $holdingID != "") {

            $sql_query = "SELECT * FROM renew_house_holding_database WHERE (linkedForm='$formID' AND renewHoldingID = '$holdingID')";
            $result = mysqli_query($db, $sql_query);
            $count = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);

            if ($count == 1) {

                    echo "
                <div class='dashboard-table-container' style='margin-top: 25px;'>
            <p class='dashboard-table-container-heading'>হোল্ডিং নবায়ন তথ্য সংশোধন</p>
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
                            <label>নবায়নের শুরুর তারিখঃ<i style='color: red;'>*</i></label>
                            <input type='date' name='renewStartDate' id='renewStartDate' autocomplete='off' value='{$row['renewStartDate']}'>
                        </td>
                        <td>
                            <label>নবায়নের শেষের তারিখঃ<i style='color: red;'>*</i></label>
                            <input type='date' name='renewEndDate' id='renewEndDate' autocomplete='off' value='{$row['renewEndDate']}'>
                        </td>
                     </tr>
                     <tr>
                        <td>
                            <label>হোল্ডিং নবায়ন ফীঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='holdingFee' id='holdingFee' autocomplete='off' value='{$row['holdingFee']}'>
                        </td>
                        <td>
                            <label>ডিস্কাউন্টঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='feeDiscount' id='feeDiscount' autocomplete='off' value='{$row['feeDiscount']}'>
                        </td>
                        <td>
                            <label>পরিশোধিত টাকার পরিমাণঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='payableAmount' id='payableAmount' autocomplete='off' value='{$row['payableAmount']}'>
                        </td>
                        </tr>
                    </tbody>
                </table>
        
            <input type='hidden' name='linkedForm' id='linkedForm' value='{$row['linkedForm']}'>
            <input type='hidden' name='renewHoldingID' id='renewHoldingID' value='{$row['renewHoldingID']}'>
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
            var renewStartDate = $('#renewStartDate').val().trim();
            var renewEndDate = $('#renewEndDate').val().trim();
            var holdingFee = $('#holdingFee').val().trim();
            var feeDiscount = $('#feeDiscount').val().trim();
            var payableAmount = $('#payableAmount').val().trim();
            var linkedForm = $('#linkedForm').val().trim();
            var renewHoldingID = $('#renewHoldingID').val().trim();

            if(fullName == '' || mobile == '' || renewStartDate == '' || renewEndDate == '' || holdingFee == '' || feeDiscount == '' || payableAmount == '' || linkedForm == '' || renewHoldingID == '') {

                alert('ফর্মটি সঠিকভাবে পূরণ করুন!');

            } else {

                $.ajax({
                    url: 'script/renew-house-holding-script-step-edit-2',
                    type: 'POST',
                    data: {
                        fullName: fullName,
                        mobile: mobile,
                        renewStartDate: renewStartDate,
                        renewEndDate: renewEndDate,
                        holdingFee: holdingFee,
                        feeDiscount: feeDiscount,
                        payableAmount: payableAmount,
                        linkedForm: linkedForm,
                        renewHoldingID: renewHoldingID
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
            var renewHoldingID = $('#renewHoldingID').val().trim();

            if(linkedForm == '' || renewHoldingID == '') {

                alert('ফর্মটি সঠিকভাবে পূরণ করুন!');

            } else {

                $.ajax({
                    url: 'script/renew-house-holding-script-step-edit-delete',
                    type: 'POST',
                    data: {
                        linkedForm: linkedForm,
                        renewHoldingID: renewHoldingID
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