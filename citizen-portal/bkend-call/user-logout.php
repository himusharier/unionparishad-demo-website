<?php
session_start();

unset($_SESSION["user_id"]);
unset($_SESSION['username']);
unset($_SESSION["user_pass"]);
//unset($_SESSION["login_first_msg"]);
unset($_SESSION["user_role"]);


echo "<script type='text/javascript'> document.location = '../login'; </script>";
exit();

?>