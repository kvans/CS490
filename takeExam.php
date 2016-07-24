<!DOCTYPE html>
<html>
<head>
<title>Take Exam</title>
</head>
<body>
<form name="examTake" id="examTake-form" method="post"
action="" accept-charset="utf-8">
        
        
        <?php
                include "../query_db.php";

                $link = connectToDatabase();
                $query = "SELECT * FROM ExamQues";
                $result = mysqli_query($link, $query);
                if($result == NULL){
                        echo "Failed";
                }

                echo "<b><center>Good Luck on the Exam</center></b><br><br>";

                echo "<b>Student ID: </b>";
                echo "<input type=\"text\" id=\"studentID\" name=\"studentID\"><br><br>";

                while($row = mysqli_fetch_array($result)){
                
                        $Question = $row['Question'];
                        $QID = $row['Qid'];

                        echo "<fieldset><b>$Question</b></fieldset>";
                        echo "<br><br>";
                        
                        echo "<b>Student Response</b><br>";
                        echo "<textarea rows=\"5\" cols=\"80\" name=\"response\" id=\"response\"></textarea>";
                }
                mysql_close($link);
        ?>
        <button type="submit">Submit</button>
</form>
</body>
</html>
