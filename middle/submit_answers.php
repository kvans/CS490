<?php

#
#
#

include "../backend/query_db.php";

$eid = $_POST["eid"];
$sid = $_POST["sid"];
$argc = (int) $_POST["argc"];

$qids = array();
$answers = array();
for ($i = 0; $i < $argc; $i++) {
    array_push($qids, $_POST["qid$i"]);
    array_push($answers, $answer = $_POST["answer$i"]);
}



$answer0 = $_POST["answer0"];
echo shell_exec("python -c \"$answer0\"");

function checkStudentAnswer($sid, $eid, $qid) {

}