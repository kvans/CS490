<?php
#
# Backend service allowing instructor comments to be submitted.
#

include "../backend/query_db.php";

$postedJson = json_decode(file_get_contents("php://input"), true);

$eid = $postedJson["eid"];
$sid = $postedJson["sid"];
$argc = (int) $postedJson["argc"];

for ($i = 0; $i < $argc; $i++) {
    $qid = $postedJson["qid$i"];
    $comment = $postedJson["comment$i"];
    addInstructorCommentForExamAnswer($eid, $sid, $qid, $comment);
}

echo ' { "successful": "true" }';