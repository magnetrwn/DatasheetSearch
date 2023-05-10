<?php
  function redirect_js($url) {
    //echo "<script>alert('$url');</script>";
    echo "<script>location.replace('$url');</script>";
  }
?>