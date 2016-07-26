<?php

#
# Users of this service endpoint can add a new
# question to the question bank by posting the
# query parameters specified below.
#

include "../backend/query_db.php";

$question = $_POST["question"];
$input1   = $_POST["input1"];
$input2   = $_POST["input2"];
$input3   = $_POST["input3"];
$correct1 = $_POST["correct1"];
$correct2 = $_POST["correct2"];
$correct3 = $_POST["correct3"];

createNewQuestion(
    $question,
    $input1, $input2, $input3,
    $correct1, $correct2, $correct3
);
