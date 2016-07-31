<?php session_start() ?>

<!DOCTYPE html>
<html>

<head>
    <title>Take Exam</title>
</head>
<body>

<b><center>Good Luck on the Exam</center></b> <br/>

<?php
    include "../backend/query_db.php";

    $i = 0;
    $eid = $_GET["eid"];
    foreach (getExamQuestionsRows($eid) as $examRow) {
        $qid = $examRow -> qid;
        $questionTableRow = getRowFromQuestionsTable($qid);
        $Question = $questionTableRow['Question'];
        $QID = $questionTableRow['QID'];

        echo "<div id='$QID' class='answerDiv'>";
        echo "    <b>$Question</b> <br/>";
        echo "    <textarea class='answer' rows='5' cols='80'></textarea>";
        echo "</div> <br/>";

        $i++;
    }
?>

<button id="submitButton">Submit</button>

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
