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
        //$colgroup .= "DISTINCT ";
        if($colgroup != "")
          $colgroup .= ", ";
        $colgroup .= $colname; // TODO: problema, prodotto cartesiano genera duplicati
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

  // Valori per $mode di mysql_select_..._like()
  define("EXACT_MATCH", 0);
  define("STARTS_WITH", 1);
  define("ENDS_WITH", 2);
  define("CONTAINS", 3);

  // Valori per $casemode di mysql_select_..._like()
  define("CASE_SENSITIVE", false);
  define("CASE_IGNORE", true);

  function mysql_select_all_like($string, $table, $mode=EXACT_MATCH, $casemode=CASE_SENSITIVE) {
    // Ricerca in tutte le colonne, basata sulla keyword LIKE di MySQL
    include_once("model/mgmt-db-conn.php");
    $conn = open_mysql_conn();

    $cleantable = mysqli_real_escape_string($conn, $table);
    $cleanstring = htmlspecialchars(mysqli_real_escape_string($conn, $string), ENT_COMPAT, "ISO-8859-1", true);
    if($casemode) $cleanstring = strtolower($cleanstring);

    $selectall = mysqli_fetch_assoc(mysql_select_all_but_internal($cleantable));

    // Creiamo la query per cercare in tutte le colonne, e memorizziamo anche in che colonna si trovano i "match"
    $bigquery = "";
    foreach($selectall as $colname => $_) {
      if($bigquery != "")
        $bigquery .= "UNION ";
      $bigquery .= "SELECT *, '$colname' AS matched_in_column FROM $cleantable WHERE ";
      if($casemode) $bigquery .= "LOWER($colname)";
      else          $bigquery .= $colname;
      $bigquery .= " LIKE '";
      switch($mode) {
        case EXACT_MATCH:
          $bigquery .= "$cleanstring";
          break;
        case STARTS_WITH:
          $bigquery .= "$cleanstring%";
          break;
        case ENDS_WITH:
          $bigquery .= "%$cleanstring";
          break;
        case CONTAINS:
          $bigquery .= "%$cleanstring%";
          break;
      }
      $bigquery .= "' ";
    }
    $bigquery .= ";";

    $result = mysqli_query($conn, $bigquery);
    close_mysql_conn($conn);
    return $result;
  }

  function mysql_select_with_field_like($string, $table, $field, $mode=EXACT_MATCH, $casemode=CASE_SENSITIVE) {
    // Ricerca solo nella colonna field
    include_once("model/mgmt-db-conn.php");
    $conn = open_mysql_conn();

    $cleantable = mysqli_real_escape_string($conn, $table);
    $cleanfield = mysqli_real_escape_string($conn, $field);
    $cleanstring = htmlspecialchars(mysqli_real_escape_string($conn, $string), ENT_COMPAT, "ISO-8859-1", true);
    if($casemode) $cleanstring = strtolower($cleanstring);

    $bigquery = "SELECT * FROM $cleantable WHERE ";
    if($casemode) $bigquery .= "LOWER($cleanfield)";
    else          $bigquery .= $cleanfield;
    $bigquery .= " LIKE '";
    switch($mode) {
      case EXACT_MATCH:
        $bigquery .= "$cleanstring";
        break;
      case STARTS_WITH:
        $bigquery .= "$cleanstring%";
        break;
      case ENDS_WITH:
        $bigquery .= "%$cleanstring";
        break;
      case CONTAINS:
        $bigquery .= "%$cleanstring%";
        break;
    }
    $bigquery .= "';";
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