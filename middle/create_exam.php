<?php

include "../backend/query_db.php";

$examName = $_POST["examName"];
$qName = $_POST["qName"];

CreateExamDB($qName, $examName);
