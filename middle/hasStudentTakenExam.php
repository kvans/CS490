<?php
#
# Backend service for checking whether the
# given student has taken the given exam.
#
# Author: Brian Hernandez
#

include "../backend/query_db.php";

$eid = $_POST["eid"];
$sid = $_POST["sid"];

if (!didStudentTakeExam($eid, $sid)) {
    echo '{ 
        "eid" : "'.$eid.'",
        "sid" : "'.$sid.'",
        "tookExam" : "false", 
        "isReleased" : "false" 
    }';
}

elseif (!isExamReleased($eid, $sid)) {
    echo '{ 
        "eid" : "'.$eid.'", 
        "sid" : "'.$sid.'", 
        "tookExam" : "true", 
        "isReleased" : "false" 
    }';
}

else {
    echo '{ 
        "eid": "' . $eid .'",
        "sid": "' . $sid .'",
        "tookExam" : "true", 
        "isReleased" : "true" 
    }';
}

