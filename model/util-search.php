<?php
  include_once("model/mgmt-db-conn.php");
  function mysql_select_all_query($table) {
    $conn = open_mysql_conn();
    $result = mysqli_query($conn, "SELECT * FROM $table;");
    close_mysql_conn($conn);
    return $result;
  }
?>