<?php

include "../backend/query_db.php";

$examName = $_POST["examName"];
$argc = (int) $_POST["argc"];

$qidsPoints2DArray = array();
for ($i = 0; $i < $argc; $i++) {
    $qid = $_POST["qid" . $i];
    $points = $_POST["points" . $i];
    $qidsPoints2DArray[$i] = array($qid, $points);
}

createExam($examName, $qidsPoints2DArray);
