<?php session_start() ?>

<!DOCTYPE html>
<html>

<head>
    <title>Take Exam</title>
    <meta name='username'
          content='<?php echo $_SESSION["username"] ?>' />
</head>
<body>

<b><center>Good Luck on the Exam</center></b> <br/>

<?php
    include "../backend/query_db.php";

    $i = 0;
    foreach (getAllQuestions() as $question){
        $Question = $question['Question'];
        $QID = $question['QID'];

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
            "eid": "9", // TODO Swap this out for variable eid
            "sid": document.getElementsByTagName("meta")[0].getAttribute("content"),
            "argc": answerDivs.length
        };
        for (var i = 0; i < answerDivs.length; i++) {
            var qid = answerDivs[i].getAttribute("id");
            var answer = answerDivs[i].getElementsByTagName("textarea")[0].value;
            postObject["qid" + i] = qid;
            postObject["answer" + i] = answer;
        }
        var queryString = createQueryParametersString(postObject);
        sendPostRequest("../middle/submit_answers.php", queryString, onResponse);
    }

    function onResponse(data) {
        if (data.target.readyState === 4) {
            console.log(data.target.response);
        }
    }

</script>

</html>
