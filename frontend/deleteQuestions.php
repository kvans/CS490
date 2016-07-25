<?php
        $link = mysqli_connect('sql2.njit.edu', 'kv96', 'PQrAbwHR');
        if (!$link) {
                die('Could not connect: ' . mysql_error());
        }
        mysqli_select_db($link, 'kv96') or die(mysqli_error());
        $Question = $_GET['id'];
        $query = "DELETE FROM CreateOE WHERE Question = '$Question'";
        $result = mysqli_query($link, $query);
        if($result){
                echo "Deleted Successfully";
                echo "<br>";
                header("refresh:1; url=viewQuestions.php");
        }
        else{
                echo "ERROR";
        }
?>
