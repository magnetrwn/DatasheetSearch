<?php
  include_once("model/mgmt-db-conn.php");

  function ajax_column_exists($columnname, $columnvalue) {
    $conn = open_mysql_conn();
    $isuser = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM utente WHERE $columnname='".mysqli_real_escape_string($conn, $columnvalue)."';"));
    close_mysql_conn($conn);
    if($isuser == 0)
      return false;
    else
      return true;
  }

  if(isset($_GET["usrchk"]))
    echo ajax_column_exists("username", $_GET["usrchk"]);

  if(isset($_GET["mlchk"]))
    echo ajax_column_exists("email", $_GET["mlchk"]);
?>