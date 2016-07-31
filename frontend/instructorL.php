<!DOCTYPE html>
<html>
<head>
    <title>Welcome Instructor</title>
    <style>
        ul {    
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }
        li {
            float: left;
            border-right: 1px solid #bbb;
        }
        li:last-child {
            border-right: none;
        }
        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        li a:hover {
            background-color: #111;
        }
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <ul>
        <li><a href="">Examination Nation</a></li>
        <li><a href="">About</a></li>
        <li style="float: right"><a href="../middle/logout.php">Logout</a></li>
    </ul>
    <div class="container">
    <h1 align="center">Welcome Instructor</h1>
        <center><a href="addQuestion.html" class="button">Add a Question</a></center>
    <br>
        <center><a href="viewQuestions.php" class="button">View Question Bank</a></center>
    <br>
        <center><a href="examCreation.php" class="button">Create Exam</a></center>
    <br>
        <center><a href="" class="button">View Existing Exams</a></center>
    </div>
</body>
</html>
