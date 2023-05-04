<div class="flex mb-9">
<table class="flex-col grow">
  <thead>
    <?php 
      // NON USARE PER RICERCA, autolist STAMPA TUTTI I VALORI, POTREBBE CAUSARE DUPLICATI PER matched_in_column

      // Usa il $goto ottenuto da index.php per scegliere la pagina, quindi solo alcuni valori
      $table = mysql_select_all_but_internal($goto);
      $getcols = mysqli_fetch_assoc($table);
      if($getcols != false) {
        echo "<tr>";
        foreach($getcols as $colname => $_)
          echo "<th class='p-4 bg-gray-900 text-gray-100'>".strtoupper(str_replace("_", " ", $colname))."</th>";
        echo "</tr>";
      }
    ?>
  </thead>
  <tbody>
    <?php
      $table = mysql_select_all_but_internal($goto);
      if($getcols != false) {
        while($row = mysqli_fetch_assoc($table)) {
          echo "<tr class='odd:bg-gray-200'>";
          foreach($row as $colname => $column) {
            $cleancolumn = htmlspecialchars($column, ENT_COMPAT, "ISO-8859-1", true);
            if(is_hypertext_link($column))
              echo "<td class='px-10 py-4'><a href='$cleancolumn' class='text-blue-600'>$cleancolumn</a></td>";
            else
              echo "<td class='px-10 py-4'>$cleancolumn</td>";
          }
          echo "</tr>";
        }
      }
    ?>
  </tbody>
</table>
</div>
