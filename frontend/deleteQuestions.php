<?php
    include "../backend/query_db.php";
    $link = connectToDatabase();
    global $questionsTable;
    $Question = $_GET['id'];
    $query = "DELETE FROM " . $questionsTable . " WHERE Question = '$Question'";
    $result = mysqli_query($link, $query);
    if ($result) {
        echo "Deleted Successfully";
        echo "<br>";
        header("refresh:1; url=viewQuestions.php");
    }
    else {
        echo "ERROR";
    }
