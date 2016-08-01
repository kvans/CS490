<?php session_start() ?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome Instructor</title>
    <link rel="stylesheet" href="boxedStylesheet.css"/>
</head>
<body>

    <ul>
        <li><a href="">Examination Nation</a></li>
        <li><a href="">About</a></li>
        <li style="float: right"><a href="../middle/logout.php">Logout</a></li>
    </ul>

    <h1 align="center">Welcome Instructor</h1>

    <div class="container">
        <center><a href="addQuestion.html" class="button">Add a Question</a></center>
        <br>
        <center><a href="viewQuestions.php" class="button">View Question Bank</a></center>
        <br>
        <center><a href="examCreation.php" class="button">Create Exam</a></center>
        <br>
        <center><a href="viewExistingExams.php" class="button">View Existing Exams</a></center>
    </div>

</body>
</html>
