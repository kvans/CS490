<!DOCTYPE html>
<html>
<head>
    <title>Welcome Student</title>
    <style>
         ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }
        li {
            float: left;
            border-right: 1px solid #bbb;
        }
        li:last-child {
            border-right: none;
        }
        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        li a:hover {
            background-color: #111;
        }
        .selectExam {
            text-align: center;
        }
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <ul>
        <li><a href="">Examination Nation</a></li>
        <li><a href="">About</a></li>
        <li style="float: right"><a href="../middle/logout.php">Logout</a></li>
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
        var eid = event.target.getAttribute("value");
        var queryString = createQueryParametersString({ "eid": eid });
        sendPostRequest("../middle/hasStudentTakenExam.php", queryString, onResponse);
    }

    function onResponse(data) {
        if (data.target.readyState === 4) {
            var response = JSON.parse(data.target.response);
            if (response.tookExam === "true") {
                window.location.replace("viewStudentExam.php?eid=" + response.eid);
            } else {
                window.location.replace("takeExam.php?eid=" + response.eid);
            }
        }
    }

</script>

</body>
</html>

