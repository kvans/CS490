<?php session_start() ?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome Student</title>
    <link rel="stylesheet" href="boxedStylesheet.css">
</head>
<body>

    <ul>
        <li><a href="studentL.php">Examination Nation</a></li>
        <li><a href="">About</a></li>
        <li style="float: right"><a href="../logout.php">Logout</a></li>
    </ul>

    <h1 align="center">Welcome Student</h1>

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
            "eid": event.target.getAttribute("value"),
            "sid": "<?php echo $_SESSION["username"] ?>"
        });
        sendPostRequest("../middle/hasStudentTakenExam.php", queryString, onResponse);
    }

    function onResponse(data) {
        if (data.target.readyState === 4) {
            var response = JSON.parse(data.target.response);
            var queryString = createQueryParametersString({
                eid: response.eid, sid: response.sid
            });
            if (response.tookExam !== "true") {
                window.location.replace("takeExam.php?" + queryString);
            } else if (response.isReleased !== "true") {
                window.location.replace("examNotReleased.html");
            } else {
                window.location.replace("viewStudentExam.php?" + queryString);
            }
        }
    }

</script>

</body>
</html>

