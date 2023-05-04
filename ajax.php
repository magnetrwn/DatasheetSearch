<?php
  // Controller per AJAX

  // delay vs. possibili bot in cerca di username ed email in uso, bypassabile con più connessioni
  usleep(250000);

  if(isset($_GET["usrchk"]))
    include("model/ajax/handler-ajax-exists.php");

  if(isset($_GET["mlchk"]))
    include("model/ajax/handler-ajax-exists.php");

  // TODO: infinite scrolling
?>