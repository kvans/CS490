<!DOCTYPE html>
<html>
<head>
<title>Create Exam</title>
</head>
<body>
<form name="examCreation" id="examCreation-form"
      >

    <?php
        include "../backend/query_db.php";

        $link = connectToDatabase();
        global $questionsTable;
        $query = "SELECT * FROM " . $questionsTable;
        $result = mysqli_query($link, $query);
        if ($result == NULL) {
            echo "Failed";
        }

        echo "<b><center>Select Exam Questions</center></b><br><br>";

        echo "<b>Name of Exam: </b>";
        echo "<input type=\"text\" id=\"examName\" name=\"examName\"><br><br>";

        $i = 0;
        while($row = mysqli_fetch_array($result)){

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
            "<input type=\"checkbox\" id=\"qid$i\" name=\"qid\" value=\"$QID\">
            <fieldset><b>$Question</b>
                <br><br>
                <b>$Input1:</b>$Correct1
                <br>
                <b>$Input2:</b>$Correct2
                <br>
                <b>$Input3:</b>$Correct3
                <br>
            </fieldset>
            <input type=\"number\" class=\"points\" name=\"points\">";
            echo "<br><br>";
            echo "</div>";

            $i++;
        }
        mysqli_close($link);
    ?>
</form>
    <button id="submitButton" type="submit">Submit</button>

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
        console.log(queryString);
        sendPostRequest("../middle/create_exam.php", queryString, onReponse);
    }

    function getCheckedBoxes(checkkboxName) {
        var checkboxes = document.getElementsByName(checkkboxName);
        var checkedBoxes = [];
        for (var i=0; i<checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                checkedBoxes.push(checkboxes[i]);
            }
        }
        return checkedBoxes;
    }

    function onReponse() {

    }

</script>

</body>
</html>
