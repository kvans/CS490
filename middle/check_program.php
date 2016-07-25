<?php

include "../backend/query_db.php";

$qid = $_POST["qid"];
$program = $_POST["program"];

$output = shell_exec("python -c \"" . $program . "\"" );
echo $output;

$numOfQuestions = $_POST["numOfQuestions"];

for ($i = 0; $i < $numOfQuestions; $i++) {
    $qid = $_POST["qid" . $i];

}