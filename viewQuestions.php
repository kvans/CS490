<!DOCTYPE html>
<html>
<head>
        <title>View Questions</title>
</head>
<body>
<?php
        $link = mysqli_connect('sql2.njit.edu', 'kv96', 'PQrAbwHR');
        if (!link) {
                die('Could not Connect: ' . mysql_error());
        }
        mysqli_select_db($link, 'kv96') or die(mysqli_error());
        $query = "SELECT * FROM CreateOE";
        $result = mysqli_query($query);

        $num = mysqli_numrows($result);

        mysqli_close();

        echo "<b><center>Database Output</center></b><br><br>";

        $i = 0;
        while ($i < $num) {
                $Question = mysql_result($result, $i, "Question");
                $Input1 = mysql_result($result, $i, "Input1");
                $Input2 = mysql_result($result, $i, "Input2");
                $Input3 = mysql_result($result, $i, "Input3");
                $Correct1 = mysql_result($result, $i, "Correct1");
                $Correct2 = mysql_result($result, $i, "Correct2");
                $Correct3 = mysql_result($result, $i, "Correct3");

                echo "<b>$Question</b><br>$Input1 $Correct1<br>$Input2 $Correct2<br>$Input3 $correct3<br>";

                $i++;
        }       
?>
</body>
</html>
