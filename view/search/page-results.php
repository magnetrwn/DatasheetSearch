<div class="container flex py-9">
<table class="flex-col grow">
  <thead>
    <?php include("view/search/page-th-$goto.html"); ?>
  </thead>
  <tbody>
    <?php
      $table = mysql_select_all_query($goto);
      while($row = mysqli_fetch_assoc($table)) {
        echo "<tr class='odd:bg-gray-100'>";
        foreach($row as $column) {
          echo "<td class='px-10 py-4'>".$column."</td>";
        }
        echo "</tr>";
      }
    ?>
  </tbody>
</table>
</div>