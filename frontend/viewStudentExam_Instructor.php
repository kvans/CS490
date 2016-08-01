<?php session_start() ?>

<!DOCTYPE html>
<html>

<head>
    <title><?php $_GET["sid"]; ?> Results</title>
    <link rel="stylesheet" href="boxedStylesheet.css"/>
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
        textarea {
            width: 350px;
            height: 65px;
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
    $totalQuestionPoints = getPointsPerQuestion($eid, $qid);
    $comment = $answerRow["Comment"];

    echo "<p>$question</p>";
    echo "<div class='questionBox'>";
    echo "    <pre>$answerCode</pre>";
    echo "    <p class='points'>$studentPoints/$totalQuestionPoints</p>";
    echo "    <p>Instructor Comments</p>";
    echo "    <textarea id='comment$qid' $qid' class='comment'></textarea>";
    echo "</div>";
    echo "<br/>";
}
?>

<button id="releaseButton" class="button">Release Exam</button>
<script src="ajaxUtilities.js"></script>
<script>

    var releaseButton = document.getElementById("releaseButton");
    releaseButton.addEventListener("click", onReleaseButtonClick);

    function onReleaseButtonClick(event) {
        releaseExam();
        submitInstructorsComments();
    }

    function releaseExam() {
        var queryString = createQueryParametersString({
            eid: "<?php echo $_GET["eid"]; ?>",
            sid: "<?php echo $_GET["sid"]; ?>"
        });
        sendPostRequest("../middle/releaseExam.php", queryString, null);
    }

    function submitInstructorsComments() {

    }

</script>

</body>

</html>
