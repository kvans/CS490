<!DOCTYPE html>
<html>
<head>
    <title>Create Exam</title>
    <link rel="stylesheet" type="text/css" href="boxedStylesheet.css">
<style>
    fieldset {
        background-color: white;
    }
</style>
</head>
<body>
    <ul>
        <li><a href="instructorL.php">Examination Nation</a></li>
        <li><a href="">About</a></li>
        <li style="float: right"><a href="../logout.php">Logout</a></li>
    </ul>
<form>
    <?php
        include "../backend/query_db.php";

        echo "<h1 align=\"center\">Select Exam Questions</h1><br><br>";
        echo "<b>Name of Exam: </b>";
        echo "<input type=\"text\" id=\"examName\" name=\"examName\"><br><br>";

        $i = 0;
        foreach (getAllQuestions() as $row) {

            $Question = $row['Question'];
            $Input1 = $row['Input1'];
            $Input2 = $row['Input2'];
            $Input3 = $row['Input3'];
            $Correct1 = $row['Correct1'];
            $Correct2 = $row['Correct2'];
            $Correct3 = $row['Correct3'];
            $QID = $row['QID'];

            echo "<div>";
            echo
            "<input id=\"qid$i\" type=\"checkbox\"  name=\"qid\" value=\"$QID\">
            <fieldset><b>$Question</b>
                <br><br>
                <b>$Input1:</b>$Correct1
                <br>
                <b>$Input2:</b>$Correct2
                <br>
                <b>$Input3:</b>$Correct3
                <br>
            </fieldset>
            Point Value: <input type=\"number\" class=\"points\" name=\"points\">";
            echo "<br><br>";
            echo "</div>";

            $i++;
        }
    ?>
</form>
<button class="submitButton" id="submitButton" type="submit">Submit</button>

<script src="ajaxUtilities.js"></script>
<script>

    var submitButton = document.getElementById("submitButton");
    submitButton.addEventListener("click", onSubmission);
    
    function onSubmission() {
        var checkedBoxes = getCheckedBoxes("qid");
        var parametersObject = {
            examName: document.getElementById("examName").value,
            argc: checkedBoxes.length
        };
        for (var i = 0; i < checkedBoxes.length; i++) {
            var parent = checkedBoxes[i].parentNode;
            var points = parent.getElementsByClassName("points")[0].value;
            parametersObject["qid" + i] = checkedBoxes[i].value;
            parametersObject["points" + i] = points;
        }
        var queryString = createQueryParametersString(parametersObject);
        sendPostRequest("../middle/create_exam.php", queryString, onResponse);
        window.location.reload();
    }

    function getCheckedBoxes(checkboxName) {
        var checkboxes = document.getElementsByName(checkboxName);
        var checkedBoxes = [];
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                checkedBoxes.push(checkboxes[i]);
            }
        }
        return checkedBoxes;
    }

    function onResponse() {

    }

</script>

</body>
</html>
