<!DOCTYPE html>
<html>
<head>
<title>Welcome Student</title>
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
        <h1 align="center">Welcome Student</h1>
        <?php
                include "../backend/query_db.php";

                echo "<div class=\"selectExam\">";
                echo "<center><form action=\"takeExam.php\">";
                echo "<input list=\"exams\">";
                echo "<datalist id=\"exams\">";
                foreach ( DisplayEIDs() as $var ) {
                        echo "<option value=\"",$var['0'],"\">",$var['1'],"</option>";
                }
                echo "</datalist>";
                echo "<center><button class=\"button\" type=\"submit\">Take Exam</button></center>";
                echo "</form></center>";
                echo "</div>";
        ?>
        <br>
        <center><a href="" class="button">View Results</a></center>
</body>
</html>

