<?php
  function is_internal_colname($colname) {
    if(strpos($colname, "fk") === 0)
      // Chiave esterna
      return true;
    else if($colname == "logo" || $colname == "icona")
      // Immagine, non vogliamo stampare il percorso
      return true;
    return false;
  }
?>