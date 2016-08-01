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
    <ul>
        <li><a href="instructorL.php">Examination Nation</a></li>
        <li><a href="">About</a></li>
        <li style="float: right"><a href="../middle/logout.php">Logout</a></li>
    </ul>

<?php
include "../backend/query_db.php";

$sid = $_GET["sid"];
$eid = $_GET["eid"];

$examName = getExamNameGivenEid($eid);
//$points = calculateStudentsTotalExamGrade()
echo "<h1>$examName</h1>";
echo "<h1 id='totalPoints'>Points: %</h1>";

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
    echo "    <textarea></textarea>";
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
        var queryString = createQueryParametersString({
            eid: "<?php echo $_GET["eid"]; ?>",
            sid: "<?php echo $_GET["sid"]; ?>"
        });
        sendPostRequest("../middle/releaseExam.php", queryString, null);
    }

</script>

</body>

</html>
