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

            $sql_query = "SELECT * FROM house_holding_database WHERE idNumber='$userName'";
            $result = mysqli_query($db, $sql_query);
            $count = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);

            if ($count == 1) {

                if ($loginPass == $row['pinNumber']) {

                    if ($row['cardStatus'] == "সক্রিয়") {

                        $_SESSION["user_id"] = $userName;
                        $_SESSION["user_pass"] = $loginPass;
                        $_SESSION["user_role"] = "house-holding";
                        echo 1;
                        exit();

                    } else {
                        echo "<div class='error_msg'>আপনার কার্ডটি সক্রিয় নয়!</div>";
                        exit();
                    }


                } else {
                    echo "<div class='error_msg'>সঠিক পাসওয়ার্ডটি দিন!</div>";
                    exit();
                }

            } else {

                $sql_query = "SELECT * FROM trade_license_database WHERE idNumber='$userName'";
                $result = mysqli_query($db, $sql_query);
                $count = mysqli_num_rows($result);
                $row = mysqli_fetch_assoc($result);

                if ($count == 1) {

                    if ($loginPass == $row['pinNumber']) {

                        if ($row['cardStatus'] == "সক্রিয়") {

                            $_SESSION["user_id"] = $userName;
                            $_SESSION["user_pass"] = $loginPass;
                            $_SESSION["user_role"] = "trade-license";
                            echo 1;
                            exit();

                        } else {
                            echo "<div class='error_msg'>আপনার কার্ডটি সক্রিয় নয়!</div>";
                            exit();
                        }


                    } else {
                        echo "<div class='error_msg'>সঠিক পাসওয়ার্ডটি দিন!</div>";
                        exit();
                    }

                } else {
                    echo "<div class='error_msg'>আইডি নাম্বারটি খুঁজে পাওয়া যায় নি!</div>";
                }



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