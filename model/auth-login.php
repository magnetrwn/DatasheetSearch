<?php
  // Implementazione salted md5 (salt vs. Rainbow tables, ma md5 rimane comunque vulnerabile)

  include_once("model/mgmt-db-conn.php");
  function mysql_user_login($plainusr, $plainpwd) {
    $conn = open_mysql_conn();

    // Caratteri speciali tradotti nell'username (con htmlspecialchars vs. PHP Code Injection)
    $cleanusr = htmlspecialchars($plainusr, ENT_COMPAT, "ISO-8859-1", true);

    // Cerchiamo l'utente per ottenere il suo salt, poi calcoliamo md5 password+salt
    $usrsalt = mysqli_query($conn, "SELECT salt FROM utente WHERE username='$cleanusr';");
    if(mysqli_num_rows($usrsalt) != 1)
      return false;
    $usrsalt = mysqli_fetch_assoc($usrsalt)["salt"];
    $md5saltedpwd = md5($plainpwd.$usrsalt);

    // Diamo valido il login se la password è giusta (con hash_equals vs. PHP Timing Attack)
    $correctmd5saltedpwd = mysqli_fetch_assoc(mysqli_query($conn, "SELECT password_md5_salt FROM utente WHERE username='$cleanusr';"))["password_md5_salt"];
    close_mysql_conn($conn);
    if(hash_equals($correctmd5saltedpwd, $md5saltedpwd)) {
      $_SESSION["user"]=$cleanusr;
      return true;
    }
    else
      return false;
  }
?>