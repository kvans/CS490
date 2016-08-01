<?php
    include "../backend/query_db.php";
    $link = connectToDatabase();
    global $questionsTable;
    $QID = $_GET['id'];
    $query = "DELETE FROM $questionsTable WHERE QID = '$QID'";
    $result = mysqli_query($link, $query);
    if ($result) {
        echo "Deleted Successfully";
        echo "<br>";
        header("refresh:1; url=viewQuestions.php");
    }
    else {
        echo "ERROR";
    }
