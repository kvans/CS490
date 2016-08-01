<?php session_start() ?>

<!DOCTYPE html>
<html>
<head>
    <title>Created Exams</title>
    <link rel="stylesheet" type="text/css" href="boxedStylesheet.css">
</head>
<body>

<ul>
    <li><a href="instructorL.php">Examination Nation</a></li>
    <li><a href="">About</a></li>
    <li style="float: right"><a href="../logout.php">Logout</a></li>
</ul>

<h1 align="center">Created Exams</h1>

<div class='selectExam'>
    <?php
    include "../backend/query_db.php";
    foreach (getExamsTableRows() as $row ) {
        $id = $row["EID"];
        $name = $row["ExamName"];
        echo "<button class='button examButton' value='$id'>$name</button>";
        echo "<br/>";
    }
    ?>
</div>

<script src="../frontend/ajaxUtilities.js"></script>
<script>

    var examButtons = document.getElementsByClassName("examButton");
    for (var i = 0; i < examButtons.length; i++) {
        var examButton = examButtons[i];
        examButton.addEventListener("click", onExamButtonClicked);
    }

    function onExamButtonClicked(event) {
        var queryString = createQueryParametersString({
            "eid": event.target.getAttribute("value")
        });
        window.location.replace("viewExamsTakenByStudents.php?" + queryString);
    }

</script>

</body>
</html>

