<?php
#
# This service is responsible for receiving answers submitted
# by the student, evaluating the code, and calculating the grade.
#
# Author: Brian Hernandez
#

include "../backend/query_db.php";

$postedJson = json_decode(file_get_contents("php://input"), true);

$eid = $postedJson["eid"];
$sid = $postedJson["sid"];
$argc = (int) $postedJson["argc"];

for ($i = 0; $i < $argc; $i++) {
    $qid = $postedJson["qid$i"];
    $code = $postedJson["answer$i"];

    $casesPassed = 0;
    if (isCodeCorrectForQuestionTestCase($qid, 1, $code)) { $casesPassed++; }
    if (isCodeCorrectForQuestionTestCase($qid, 2, $code)) { $casesPassed++; }
    if (isCodeCorrectForQuestionTestCase($qid, 3, $code)) { $casesPassed++; }

    $points = ($casesPassed / 3) * getPointsForExamQuestion($eid, $qid);
    putStudentAnswerAndPointsInTable($sid, $eid, $qid, $code, $points);

    echo "Points for question: " . $points . "\n";
}

// TODO Fix assumption that function is called "answer()"
function isCodeCorrectForQuestionTestCase($qid, $caseNum, $code) {
    $questionRow = getRowFromQuestionsTable($qid);
    $expectedOutput = $questionRow["Correct$caseNum"];
    $expectedOutput = trim($expectedOutput);

    $function= "answer";
    $arguments = $questionRow["Input$caseNum"];
    $code .= "\n";
    $code .= "print( $function($arguments) )";

    $actualOutput = shell_exec("python -c \"$code\"");
    $actualOutput = trim($actualOutput);

    return $expectedOutput == $actualOutput;
}