<!DOCTYPE html>
<html>
<head>
<title>Create Exam</title>
</head>
<body>
<form name="examCreation" id="examCreation-form" method="post"
accept-charset="utf-8">
        
        
        <?php
                include "../query_db.php";

                $link = connectToDatabase();
                $query = "SELECT * FROM CreateOE";
                $result = mysqli_query($link, $query);
                if($result == NULL){
                        echo "Failed";
                }

                echo "<b><center>Select Exam Questions</center></b><br><br>";

                echo "<b>Name of Exam: </b>";
                echo "<input type=\"text\" id=\"examName\" name=\"examName\"><br><br>";

                while($row = mysqli_fetch_array($result)){
                
                        $Question = $row['Question'];
                        $Input1 = $row['Input1'];
                        $Input2 = $row['Input2'];
                        $Input3 = $row['Input3'];
                        $Correct1 = $row['Correct1'];
                        $Correct2 = $row['Correct2'];
                        $Correct3 = $row['Correct3'];
                        $QID = $row['Qid'];

                        echo "<input type=\"checkbox\" name=\"$QID\"
                        value=\"$QID\"><fieldset><b>$Question</b><br><br><b>$Input1:</b>$Correct1<br><b>$Input2:</b>$Correct2<br><b>$Input3:</b>$Correct3<br></fieldset>";
                        echo "<br><br>";
                }
                mysql_close($link);
        ?>
        <button type="submit">Submit</button>
</form>
</body>
</html>
