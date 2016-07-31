<?php
#
# Backend service for checking whether the
# given student has taken the given exam.
#

include "../backend/query_db.php";

$eid = $_POST["eid"];
$sid = $_POST["sid"];

if (didStudentTakeExam($eid, $sid)) {
    echo ' { "tookExam" : "true", "eid": "' . $eid .'" } ';
} else {
    echo ' { "tookExam" : "false", "eid": "' . $eid . '" } ';
}

