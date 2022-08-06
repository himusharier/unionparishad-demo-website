<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    include "../config/database-connection.php";

    if (isset($_POST["userName"]) && isset($_POST["loginPass"])) {

        $userName = strip_tags($_POST['userName']);
        $userName = htmlspecialchars($userName);
        $userName = mysqli_real_escape_string($db, $userName);

        $loginPass = strip_tags($_POST['loginPass']);
        $loginPass = htmlspecialchars($loginPass);
        $loginPass = mysqli_real_escape_string($db, $loginPass);

        if ($userName != "" && $loginPass != "") {

            $sql_query = "SELECT * FROM user_admin WHERE username='$userName'";
            $result = mysqli_query($db, $sql_query);
            $count = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);

            if ($userName == $row['username']) {

                //$verify = password_verify($loginPass, $row['password']);
                if ($loginPass == $row['password']) {

                    if ($row["activation_status"] == "active") {

                        $_SESSION["admin_user_id"] = $row['user_id'];
                        $_SESSION["admin_username"] = $userName;
                        $_SESSION["admin_user_pass"] = $loginPass;
                        $_SESSION["admin_role"] = $row['role'];
                        echo 1;
                        exit();

                    } else {
                        echo "<div class='error_msg'>আপনার একাউন্টটি ডিএক্টিভেট করা হয়েছে!</div>";
                        exit();
                    }

                } else {
                    echo "<div class='error_msg'>সঠিক পাসওয়ার্ডটি দিন!</div>";
                    exit();
                }

            } else {
                echo "<div class='error_msg'>ইউজারনেইমটি খুঁজে পাওয়া যায় নি!</div>";
            }

        } else {
            echo "<div class='error_msg'>সবগুলো তথ্য সঠিকভাবে দিন!</div>";
            exit();
        }

    }


    if (!isset($_POST["userName"]) && !isset($_POST["loginPass"])) {
        exit();
    }


} else {
    include "../not-found.php";
    exit();
}


?>