<?php
    session_start();
    include "../backend/query_db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Exams Taken By Students</title>
    <link rel="stylesheet" href="boxedStylesheet.css"/>
</head>
<body>

<ul>
    <li><a href="">Examination Nation</a></li>
    <li><a href="">About</a></li>
    <li style="float: right"><a href="../middle/logout.php">Logout</a></li>
</ul>

<h1 align="center">
    <?php echo getExamNameGivenEid($_GET["eid"]); ?>
</h1>

<div class='selectExam'>
    <?php
        foreach (getAllStudentIDs() as $sid) {
            echo "<button class='button' value='$sid'>$sid</button>";
            echo "<br/>";
        }
    ?>
</div>

<script src="../frontend/ajaxUtilities.js"></script>
<script>

    var examButtons = document.getElementsByClassName("button");
    for (var i = 0; i < examButtons.length; i++) {
        var examButton = examButtons[i];
        examButton.addEventListener("click", onExamButtonClicked);
    }

    function onExamButtonClicked(event) {
        var queryString = createQueryParametersString({
            "eid": "<?php echo $_GET["eid"]; ?>",
            "sid": event.target.getAttribute("value")
        });
        window.location.replace("viewStudentExam_Instructor.php?" + queryString);
    }

</script>

</body>
</html>

