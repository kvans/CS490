<?php
  include "query_db.php";
  $link = connectToDatabase();
  $query = mysqli_query($link, "SELECT * FROM CreateOE");

  echo "<table>";

  while($row = mysql_fetch_array($query)){
    echo "<tr><td>" . $row['Question'] . "</td><td>" . $row['Input1'] . "</td><td>" . $row['Input2'] . "</td><td>" . $row['Input3'] . "</td><td>" . $row['Correct1'] . $row['Correct2'] . "</td><td>" . $row['Correct3'] . "</td></tr>";
  }

  echo "</table>";

  mysql_close();
?>
