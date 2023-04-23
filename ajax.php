<?php
  // Controller per AJAX

  if(isset($_GET["usrchk"]))
    include("model/ajax/handler-ajax-exists.php");

  if(isset($_GET["mlchk"]))
    include("model/ajax/handler-ajax-exists.php");
?>