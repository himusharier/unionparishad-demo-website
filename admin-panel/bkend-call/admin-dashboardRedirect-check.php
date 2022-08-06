<?php

include "config/database-connection.php";

$user_id = strip_tags($_SESSION["admin_user_id"]);
$user_id = htmlspecialchars($user_id);
$user_id = mysqli_real_escape_string($db, $user_id);

$userName = strip_tags($_SESSION["admin_username"]);
$userName = htmlspecialchars($userName);
$userName = mysqli_real_escape_string($db, $userName);

$user_pass = strip_tags($_SESSION["admin_user_pass"]);
$user_pass = htmlspecialchars($user_pass);
$user_pass = mysqli_real_escape_string($db, $user_pass);

$user_role = strip_tags($_SESSION["admin_role"]);
$user_role = htmlspecialchars($user_role);
$user_role = mysqli_real_escape_string($db, $user_role);


if (!empty($user_id) && !empty($userName) && !empty($user_pass) && !empty($user_role)) {

    $sql_queryChk = "SELECT * FROM user_admin WHERE (user_id='$user_id' AND username='$userName' AND role='$user_role')";
    $resultChk = mysqli_query($db, $sql_queryChk);
    $countChk = mysqli_num_rows($resultChk);
    $rowChk = mysqli_fetch_assoc($resultChk);

    if ($countChk == 1) {

        //$verify = password_verify($user_pass, $rowChk['password']);
        if ($user_pass == $rowChk['password']) {

            //echo "you are ok to stay. welcome home.";
            header('Location: admin/dashboard');
            exit();

        } else {
            //$_SESSION["login_first_msg"] = "<div class='error_msg'>you are not welcome here.</div>";
            $_SESSION["admin_login_first_msg"] = "<div class='error_msg'>প্রথমে নিজ একাউন্টে প্রবেশ করুন!</div>";
            include ('bkend-call/admin-logout.php');
            header('Location: ../login');
            exit();
        }

    } else {
        //$_SESSION["login_first_msg"] = "<div class='error_msg'>multiple matches found. you are prohibited</div>";
        $_SESSION["admin_login_first_msg"] = "<div class='error_msg'>প্রথমে নিজ একাউন্টে প্রবেশ করুন!</div>";
        include ('bkend-call/admin-logout.php');
        header('Location: ../login');
        exit();
    }

} else {
    $_SESSION["admin_login_first_msg"] = "<div class='error_msg'>প্রথমে নিজ একাউন্টে প্রবেশ করুন!</div>";
    include ('bkend-call/admin-logout.php');
    header('Location: ../login');
    exit();
}


?>