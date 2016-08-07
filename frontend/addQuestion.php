<!DOCTYPE html>
<html>

<head>
    <title>Add Questions</title>
    <link rel="stylesheet" type="text/css" href="boxedStylesheet.css">
    <style>
        .addQuestion {
            background-color: white;
            float:left;
            width:50%;
            overflow:hidden;
            border: 4px groove;
            border-radius: 5px;
            padding: 5px;
            margin-top: 5px;
        }
        .viewQuestions {
            background-color: white;
            float: right;
            width: 45%;
            overflow:hidden;
            border: 4px groove;
            border-radius: 5px;
            padding: 5px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <ul>
        <li><a href="instructorL.php">Examination Nation</a></li>
        <li><a href="">About</a></li>
        <li style="float: right"><a href="../logout.php">Logout</a></li>
    </ul>
    <h1 align="center">Add Questions</h1>
<section>
<div class="addQuestion">
<form id="addQuestion-form" method="post" accept-charset="utf-8">
    <br><label for="functionName">Function Name:</label><input type="text" id="functionName" name="functionName"><br><br>
    <label for="question">Enter Question:</label><br>
    <textarea id="question" rows="5" cols="80" name="question"></textarea>
    <br>
        <fieldset>
            <legend>Test Case 1:</legend>
            <label for="input1">Input 1 (Separate arguments with a comma):</label><br>
            <input type="text" id="input1" name="input1"><br>
            <label for="correct1"> Answer 1:</label><br>
            <input type="text" id="correct1" name="correct1"><br>
        </fieldset>
        <fieldset>
            <legend>Test Case 2:</legend>
            <label for="input2">Input 2 (Separate arguments with a comma):</label> <br>
            <input type="text" id="input2" name="input2"><br>
            <label for="correct2">Answer 2:</label><br>
            <input type="text" id="correct2" name="correct2"><br>
        </fieldset>
        <fieldset>
            <legend>Test Case 3:</legend>
            <label for="input3">Input 3 (Separate arguments with a comma):</label><br>
            <input type="text" id="input3" name="input3"><br>
            <label for="correct3">Answer 3:</label><br>
            <input type="text" id="correct3" name="correct3"><br>
        </fieldset>
        <label for="difficulty">Difficulty (Easy, Medium, Hard):<input type="text" id="difficulty" name="difficulty"><br>
</form>
<button id="submitButton" class="submitButton" type="submit">Submit</button>
</div>
<div class="viewQuestions">
    <?php
        include "../backend/query_db.php";

        $link = connectToDatabase();
        global $questionsTable;
        $query = "SELECT * FROM $questionsTable";
        $result = mysqli_query($link, $query);
        if ($result == NULL) {
            echo "Failed";
        }

        echo "<h1 align=\"center\">Question Bank</h1><br>";

        while($row = mysqli_fetch_array($result)){
            $Question = $row['Question'];
            $Input1 = $row['Input1'];
            $Input2 = $row['Input2'];
            $Input3 = $row['Input3'];
            $Correct1 = $row['Correct1'];
            $Correct2 = $row['Correct2'];
            $Correct3 = $row['Correct3'];
            $Difficulty = $row['Difficulty'];

            echo "<fieldset><b>$Question</b><br><br><b>$Input1:</b>$Correct1<br><b>$Input2:</b>$Correct2<br><b>$Input3:</b>$Correct3<br><br>$Difficulty</fieldset>";
            echo "<br><br>";
        }
        mysqli_close($link);
    ?>
</div>
</section>
<script src="ajaxUtilities.js"></script>
<script>

    var submitButton = document.getElementById("submitButton");
    submitButton.addEventListener("click", onSubmit);

    function onSubmit() {
        var params = getFormFieldValuesObject();
        var queryString = createQueryParametersString(params);
        console.log(queryString);
        sendPostRequest("../middle/add_question.php", queryString, onResponse);
        window.location.reload();
        
    }

    function getFormFieldValuesObject() {
        return {
            "functionName": document.getElementById("functionName").value,
            "question"    : document.getElementById("question").value,
            "input1"      : document.getElementById("input1").value,
            "input2"      : document.getElementById("input2").value,
            "input3"      : document.getElementById("input3").value,
            "correct1"    : document.getElementById("correct1").value,
            "correct2"    : document.getElementById("correct2").value,
            "correct3"    : document.getElementById("correct3").value,
            "difficulty"  : document.getElementById("difficulty").value
        };
    }

    function onResponse(data) {
        if (data.target.readyState === 4) {
            console.log(data);
        }
    }

</script>

</body>
</html>
