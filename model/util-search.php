<?php
  function mysql_select_all_query($table) {
    include_once("model/mgmt-db-conn.php");
    $conn = open_mysql_conn();
    $result = mysqli_query($conn, "SELECT * FROM ".mysqli_real_escape_string($conn, $table).";");
    close_mysql_conn($conn);
    return $result;
  }

  function mysql_select_all_but_internal($table) {
    // Esclude colonne che dovrebbero rimanere nascoste (vedi model/util-db.php)
    include_once("model/mgmt-db-conn.php");
    $conn = open_mysql_conn();
    $selectall = mysqli_fetch_assoc(mysql_select_all_query($table));
    $colgroup = "";
    foreach($selectall as $colname => $_) {
      if(!is_internal_colname($colname)) {
        if($colgroup != "")
          $colgroup .= ", ";
        $colgroup .= $colname;
      }
    }
    if($colgroup != "") {
      $result = mysqli_query($conn, "SELECT $colgroup FROM ".mysqli_real_escape_string($conn, $table).";");
      close_mysql_conn($conn);
      return $result;
    }
    else
      return null;
  }

  define("STARTS_WITH", 1234);
  define("ENDS_WITH", 2345);
  define("CONTAINS", 3456);

  // TODO: case insensitive
  function mysql_select_like($table, $mode /* STARTS_WITH, ENDS_WITH, CONTAINS */, $string) {
    // Ricerca in tutte le colonne, basata sulla keyword LIKE di MySQL
    include_once("model/mgmt-db-conn.php");
    $conn = open_mysql_conn();

    $cleantable = mysqli_real_escape_string($conn, $table);
    $cleanstring = htmlspecialchars(mysqli_real_escape_string($conn, $string), ENT_COMPAT, "ISO-8859-1", true);
    
    // Seleziona tutte le colonne non nascoste
    $selectall = mysqli_fetch_assoc(mysql_select_all_query($table));

    // Creiamo la query per cercare in tutte le colonne, e memorizziamo anche in che colonna si trovano i "match"
    $bigquery = "";
    foreach($selectall as $colname => $_) {

      if($bigquery != "")
        $bigquery .= "UNION ";
      $bigquery .= "SELECT *, '$colname' AS matched_in_column FROM $cleantable WHERE $colname LIKE '";
      if($mode == STARTS_WITH)    $bigquery .= "$cleanstring%";
      else if($mode == ENDS_WITH) $bigquery .= "%$cleanstring";
      else if($mode == CONTAINS)  $bigquery .= "%$cleanstring%";
      $bigquery .= "' ";
    }
    $bigquery .= ";";

    $result = mysqli_query($conn, $bigquery);
    close_mysql_conn($conn);
    return $result;
  }

  function is_hypertext_link($text) {
    if(strpos(substr($text, 0, 8), "https://") === 0 ||
       strpos(substr($text, 0, 7), "http://") === 0)
      return true;
    return false;
  }
?>