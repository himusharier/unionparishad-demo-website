<?php
session_start();

include "config/database-connection.php";

$user_id = strip_tags($_SESSION["user_id"]);
$user_id = htmlspecialchars($user_id);
$user_id = mysqli_real_escape_string($db, $user_id);

$user_pass = strip_tags($_SESSION["user_pass"]);
$user_pass = htmlspecialchars($user_pass);
$user_pass = mysqli_real_escape_string($db, $user_pass);

$user_role = strip_tags($_SESSION["user_role"]);
$user_role = htmlspecialchars($user_role);
$user_role = mysqli_real_escape_string($db, $user_role);


if (!empty($user_id) && !empty($user_pass) && !empty($user_role)) {

    $sql_queryChk = "SELECT * FROM house_holding_database WHERE (idNumber='$user_id' AND pinNumber='$user_pass')";
    $resultChk = mysqli_query($db, $sql_queryChk);
    $countChk = mysqli_num_rows($resultChk);
    $rowChk = mysqli_fetch_assoc($resultChk);

    if ($countChk == 1) {

        if ($rowChk['cardStatus'] == "সক্রিয়") {

            //echo "you are ok to stay. welcome home.";

        } else {
            //$_SESSION["login_first_msg"] = "<div class='error_msg'>multiple matches found. you are prohibited</div>";
            $_SESSION["login_first_msg"] = "<div class='error_msg'>প্রথমে নিজ একাউন্টে প্রবেশ করুন!</div>";
            include ('bkend-call/user-logout.php');
            header('Location: ../login');
            exit();
        }


        } else {



        $sql_queryChk = "SELECT * FROM trade_license_database WHERE (idNumber='$user_id' AND pinNumber='$user_pass')";
        $resultChk = mysqli_query($db, $sql_queryChk);
        $countChk = mysqli_num_rows($resultChk);
        $rowChk = mysqli_fetch_assoc($resultChk);

        if ($countChk == 1) {

            if ($rowChk['cardStatus'] == "সক্রিয়") {

                //echo "you are ok to stay. welcome home.";

            } else {
                //$_SESSION["login_first_msg"] = "<div class='error_msg'>multiple matches found. you are prohibited</div>";
                $_SESSION["login_first_msg"] = "<div class='error_msg'>প্রথমে নিজ একাউন্টে প্রবেশ করুন!</div>";
                include ('bkend-call/user-logout.php');
                header('Location: ../login');
                exit();
            }


        } else {
            //$_SESSION["login_first_msg"] = "<div class='error_msg'>multiple matches found. you are prohibited</div>";
            $_SESSION["login_first_msg"] = "<div class='error_msg'>প্রথমে নিজ একাউন্টে প্রবেশ করুন!</div>";
            include ('bkend-call/user-logout.php');
            header('Location: ../login');
            exit();
        }



        }

    } else {
    $_SESSION["login_first_msg"] = "<div class='error_msg'>প্রথমে নিজ একাউন্টে প্রবেশ করুন!</div>";
    include ('bkend-call/user-logout.php');
    header('Location: ../login');
    exit();
    }


?>