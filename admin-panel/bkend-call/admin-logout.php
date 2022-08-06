<?php
session_start();

unset($_SESSION["admin_user_id"]);
unset($_SESSION['admin_username']);
unset($_SESSION["admin_user_pass"]);
unset($_SESSION["admin_role"]);

unset($_SESSION['perPageLimit']);


echo "<script type='text/javascript'> document.location = '../login'; </script>";
exit();

?>