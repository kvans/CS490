<?php session_start() ?>

<!DOCTYPE html>
<html>

<head>
    <title><?php $_GET["sid"]; ?> Results</title>
    <link rel="stylesheet" href="boxedStylesheet.css"/>
</head>
<body>

<!--<b>Exam Results</b>-->

<?php
include "../backend/query_db.php";

$sid = $_GET["sid"];
$eid = $_GET["eid"];

$examName = getExamNameGivenEid($eid);
echo "<h1>$examName</h1>";
echo "<h1 id='totalPoints'>Points: 100%</h1>";

foreach (getStudentAnswersRows($sid, $eid) as $answerRow) {
    $qid = $answerRow["QID"];
    $question = getQuestionTextGivenQid("qid");
    $answerCode = $answerRow["AnswerCode"];
    $studentPoints = $answerRow["Points"];
    $totalPoints = "100";
    $comment = $answerRow["Comment"];

    echo "<p>$question</p>";
    echo "<div class='questionBox'>";
    echo "    <pre>$answerCode</pre>";
    echo "    <p class='points'>$studentPoints/$totalPoints</p>";
    echo "</div>";
    echo "<br/>";
}
?>

</body>

</html>