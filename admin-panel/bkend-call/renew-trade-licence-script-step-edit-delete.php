<?php
session_start();

$user_id = $_SESSION["admin_user_id"];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

        include "../config/database-connection.php";

        if (empty($_POST['linkedForm']) || empty($_POST['renewTradeID'])) {

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
            $renewTradeID = clean_inputs($_POST['renewTradeID']);


            $pr1Sql = "DELETE FROM renew_trade_licence_database WHERE (linkedForm='$linkedForm' AND renewTradeID='$renewTradeID')";

            if (mysqli_query($db, $pr1Sql)) {

                // success message
                echo "<div style='margin-top: 100px;' class='reg-form-message-green'><br/><i class='fa fa-check'></i> <b>ট্রেড লাইসেন্স নবায়ন তথ্যটি বাতিল করা হয়েছে!</b><br/><br/></div>
                    
                    ";

            } else {
                echo "<div style='margin-top: 100px;' class='reg-form-message-error'><br/><i class='fa fa-close'></i> <b>ট্রেড লাইসেন্স নবায়ন তথ্যটি বাতিল করা যাচ্ছে না!</b><br/><br/></div>
                    ";
            }

        }




}


?>