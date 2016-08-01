<!DOCTYPE html>
<html>
<head>
        <title>View Questions</title>
        <link rel="stylesheet" type="text/css" href="boxedStylesheet.css">
<style>
        fieldset {
                background-color: white;
        }
</style>
</head>
<body>
        <ul>
                <li><a href="instructorL.php">Examination Nation</a></li>
                <li><a href="">About</a></li>
                <li style="float: right"><a href="../logout.php">Logout</a></li>
        </ul>
<?php
        include "../backend/query_db.php";
        $link = connectToDatabase();
        global $questionsTable;
        $query = "SELECT * FROM " . $questionsTable;
        $result = mysqli_query($link, $query);
        if ($result == NULL) {
            echo "Failed";
        }

        echo "<b><center>Database Output</center></b><br><br>";

        while($row = mysqli_fetch_array($result)){
            $QID = row['QID'];
            $Question = $row['Question'];
            $Input1 = $row['Input1'];
            $Input2 = $row['Input2'];
            $Input3 = $row['Input3'];
            $Correct1 = $row['Correct1'];
            $Correct2 = $row['Correct2'];
            $Correct3 = $row['Correct3'];
            $Difficulty = $row['Difficulty'];

            echo "<fieldset><b>$Question</b><br><br><b>$Input1:</b> $Correct1<br><b>$Input2:</b> $Correct2<br><b>$Input3:</b> $Correct3<br><br>$Difficulty</fieldset>";
            echo "<a href=\"deleteQuestions.php?id=$QID\" class=\"deleteButton\">Delete</a>";
            echo "<br><br>";
        }    
        mysqli_close($link);
?>
</body>
</html>
