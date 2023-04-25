<?php
  function is_internal_colname($colname) {
    if(strpos(substr($colname, 0, 2), "fk") === 0)
      // Chiave esterna
      return true;
    if(strpos(substr($colname, 0, 2), "id") === 0)
      // ID usato dal DB
      return true;
    switch ($colname) {
      case "logo":
      case "icona":
        // Immagine (non vogliamo il percorso stampato)
      case "matched_in_column":
        // Nome della colonna in cui si trova un "match" della ricerca (vedi model/util-search.php)
        return true;
    }
    return false;
  }
?>