<div class="flex mb-9">
<table class="flex-col grow">
  <thead>
    <?php 
      $table = mysql_select_all_query($goto);
      $getcols = mysqli_fetch_assoc($table);
      echo "<tr>";
      foreach($getcols as $colname => $_)
        if(!is_internal_colname($colname))
          echo "<th class='p-4 bg-gray-900 text-gray-100'>".strtoupper(str_replace("_", " ", $colname))."</th>";
      echo "</tr>";
    ?>
  </thead>
  <tbody>
    <?php
      while($row = mysqli_fetch_assoc($table)) {
        echo "<tr class='odd:bg-gray-100'>";
        foreach($row as $colname => $column)
          if(!is_internal_colname($colname))
            echo "<td class='px-10 py-4'>".$column."</td>";
        echo "</tr>";
      }
    ?>
  </tbody>
</table>
</div>
