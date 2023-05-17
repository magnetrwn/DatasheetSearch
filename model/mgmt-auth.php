<?php
  include_once("model/mgmt-db-conn.php");

  // Implementazione salted md5 (salt vs. Rainbow tables, ma md5 rimane comunque vulnerabile)
  
  function mysql_user_login($plainusr, $plainpwd) {
    $conn = open_mysql_conn();

    // Caratteri speciali tradotti nell'username (con htmlspecialchars vs. PHP Code Injection)
    $cleanusr = htmlspecialchars($plainusr, ENT_COMPAT, "ISO-8859-1", true);

    // Cerchiamo l'utente per ottenere il suo salt, poi calcoliamo md5 password+salt (con mysqli_real_escape_string vs. SQL Injection)
    $usrsalt = mysqli_query($conn, "SELECT salt FROM utente WHERE username='".mysqli_real_escape_string($conn, $cleanusr)."' LIMIT 1;");
    if(mysqli_num_rows($usrsalt) != 1)
      return false;
    $usrsalt = mysqli_fetch_assoc($usrsalt)["salt"];
    $md5saltedpwd = md5($plainpwd.$usrsalt);

    // Diamo valido il login se la password è giusta (con hash_equals e mysqli_real_escape_string vs. PHP Timing Attack e SQL Injection)
    $correctmd5saltedpwd = mysqli_fetch_assoc(mysqli_query($conn, "SELECT password_md5_salt FROM utente WHERE username='".mysqli_real_escape_string($conn, $cleanusr)."'LIMIT 1;"))["password_md5_salt"];
    close_mysql_conn($conn);
    if(hash_equals($correctmd5saltedpwd, $md5saltedpwd)) {
      $_SESSION["user"]=$cleanusr;
      return true;
    }
    else
      return false;
  }

  function mysql_user_register($plainusr, $plainmail, $plainpwd) {
    $conn = open_mysql_conn();

    // Caratteri speciali tradotti (con htmlspecialchars e filter_var vs. PHP Code Injection)
    $cleanusr = htmlspecialchars($plainusr, ENT_COMPAT, "ISO-8859-1", true);
    $cleanmail = filter_var($plainmail, FILTER_SANITIZE_EMAIL);

    // Controlla se l'utente usa la parola "admin" all'inizio username
    if(strpos($cleanusr, "admin") === 0)
      return false;

    // Controlla se la mail è valida
    if(!filter_var($cleanmail, FILTER_VALIDATE_EMAIL))
      return false;

    // Generazione salt e md5 pass+salt
    // TODO: il salt usa solo caratteri esadecimali per ora
    $usrsalt = bin2hex(openssl_random_pseudo_bytes(16));
    $md5saltedpwd = md5($plainpwd.$usrsalt);

    // Registra il nuovo utente (con mysqli_real_escape_string vs. SQL Injection)
    $regstate = mysqli_query($conn, "INSERT INTO utente VALUES ('"
      .mysqli_real_escape_string($conn, $cleanusr)."', '"
      .mysqli_real_escape_string($conn, $cleanmail)."', '"
      ."$md5saltedpwd', '$usrsalt', 0);");
    close_mysql_conn($conn);

    return $regstate;
  }
?>