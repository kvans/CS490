<?php session_start() ?>

<!DOCTYPE html>
<html>

<head>
    <title>Take Exam</title>
    <link rel="stylesheet" type="text/css" href="boxedStylesheet.css">
</head>
<body>
    <ul>
        <li><a href="studentL.php">Examination Nation</a></li>
        <li><a href="">About</a></li>
        <li style="float: right"><a href="../logout.php">Logout</a></li>
    </ul>
<h1 align="center">Good Luck on the Exam</h1><br/>

<?php
    include "../backend/query_db.php";

    $i = 0;
    $eid = $_GET["eid"];
    foreach (getExamQuestionsRows($eid) as $examRow) {
        $qid = $examRow -> qid;
        $questionTableRow = getRowFromQuestionsTable($qid);
        $Question = $questionTableRow['Question'];
        $QID = $questionTableRow['QID'];
        $Difficulty = $questionTableRow['Difficulty'];

        echo "<div id='$QID' class='answerDiv'>";
        echo "    <b>$Question</b> <br/>";
        echo "    <b>Difficulty: </b>$Difficulty<br>";
        echo "    <textarea class='answer' rows='5' cols='80'></textarea>";
        echo "</div> <br/>";

        $i++;
    }
?>

<button class="submitButton" id="submitButton">Submit</button>

</body>

<script src="../frontend/ajaxUtilities.js"></script>
<script>

    var submitButton = document.getElementById("submitButton");
    submitButton.addEventListener("click", onExamSubmission);

    function onExamSubmission() {
        var answerDivs = document.getElementsByClassName("answerDiv");
        var postObject = {
            "eid": "<?php echo $_GET["eid"] ?>",
            "sid": "<?php echo $_SESSION["username"] ?>",
            "argc": answerDivs.length
        };
        for (var i = 0; i < answerDivs.length; i++) {
            var qid = answerDivs[i].getAttribute("id");
            var answer = answerDivs[i].getElementsByTagName("textarea")[0].value;
            postObject["qid" + i] = qid;
            postObject["answer" + i] = answer;
        }
        var queryString = JSON.stringify(postObject);
        sendPostRequest("../middle/submit_answers.php", queryString, onResponse);
    }

    function onResponse(data) {
        if (data.target.readyState === 4) {
            var response = JSON.parse(data.target.response);
            if (response.successful) {
                window.location.replace("./studentL.php");
            }
        }
    }

</script>

</html>
