<?php
#
#
#

include "../backend/query_db.php";

//$sid = $_POST["sid"];
$eid = $_POST["eid"];

//if (didStudentTakeExam) {
//
//}

echo ' { "tookExam" : "true", "eid": "' . $eid .'" } ';