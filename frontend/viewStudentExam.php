<?php session_start() ?>

<!DOCTYPE html>
<html>

<head>
    <title>Exam Results</title>
    <style>
        body {
            position: relative;
        }
        h1 {
            margin: 0 0 10px;
            font-size: 20pt;
        }
        p {
            padding: 0;
            margin: 0;
        }
        pre {
            margin: 0;
        }
        #totalPoints {
            position: absolute;
            top: 0;
            right: 5px;
        }
        .questionBox {
            position: relative;
            border: 1px solid black;
            padding: 5px;
        }
        .points {
            position: absolute;
            top: 5px;
            right: 5px;
        }
    </style>
</head>
<body>

<!--<b>Exam Results</b>-->

<?php
    include "../backend/query_db.php";

    $sid = $_GET["sid"];
    $eid = $_GET["eid"];

    $examName = getExamNameGivenEid($eid);
    $points = round(100 * calculateStudentsTotalExamGrade($eid, $sid));
    echo "<h1>$examName</h1>";
    echo "<h1 id='totalPoints'>Points: $points%</h1>";

    foreach (getStudentAnswersRows($sid, $eid) as $answerRow) {
        $qid = $answerRow["QID"];
        $question = getQuestionTextGivenQid("qid");
        $answerCode = $answerRow["AnswerCode"];
        $studentPoints = $answerRow["Points"];
        $totalPoints = getPointsPerQuestion($eid, $qid);
        $comment = $answerRow["Comment"];

        echo "<p>$question</p>";
        echo "<div class='questionBox'>";
        echo "    <pre>$answerCode</pre>";
        echo "    <p class='points'>$studentPoints/$totalPoints</p>";
        echo "    <p>Instructor Comment</p>";
        echo "    <p>$comment</p>";
        echo "</div>";
        echo "<br/>";
    }
?>

</body>

</html>