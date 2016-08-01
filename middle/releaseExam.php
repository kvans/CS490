<?php

include "../backend/query_db.php";

$eid = $_POST["eid"];
$sid = $_POST["sid"];

insertTrueIntoExamReleased($eid, $sid);
