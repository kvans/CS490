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
    $answer = $postedJson["answer$i"];

    $isFirstCorrect  = isCodeCorrectForQuestionTestCase($qid, 1, $answer);
    $isSecondCorrect = isCodeCorrectForQuestionTestCase($qid, 2, $answer);
    $isThirdCorrect  = isCodeCorrectForQuestionTestCase($qid, 3, $answer);

    $casesPassed = 0;
    if ($isFirstCorrect)  { $casesPassed++; }
    if ($isSecondCorrect) { $casesPassed++; }
    if ($isThirdCorrect)  { $casesPassed++; }

    $pointsForExamQuestion = getPointsForExamQuestion($eid, $qid);
    $pointsForExamQuestion *= ($casesPassed / 3);

    echo "Points for question: " . $pointsForExamQuestion . "\n";

}

// TODO Fix assumption that function is called "answer()"
function isCodeCorrectForQuestionTestCase($qid, $caseNum, $code) {
    $questionRow = getRowFromQuestionsTable($qid);
    $expectedOutput = (string) $questionRow["Correct$caseNum"];
    $expectedOutput = trim($expectedOutput);

    $args = $questionRow["Input$caseNum"];
    $code .= "\n";
    $code .= "answer($args)";
    $actualOutput = (string) shell_exec("python -c \"$code\"");
    $actualOutput = trim($actualOutput);

    return $expectedOutput == $actualOutput;
}