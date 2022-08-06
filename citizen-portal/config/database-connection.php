<?php
error_reporting(0);

$db = mysqli_connect("localhost","root","","unionparishad_himusharier_database");
mysqli_set_charset($db, 'utf8');
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL/DB: " . mysqli_connect_error();
  }

?>