<?php

// Globals specifying the table names
$logInTable = "LogIn";
$questionsTable = "Questions";
$examsTable = "Exams";
$examsQuestionsTable = "ExamsQuestions";
$studentsAnswersTable = "StudentsAnswers";

function connectToDatabase() {
     $link = mysqli_connect('127.0.0.1', 'kv96', 'PQrAbwHR');
     if (!$link) { die('Could not connect: ' . mysql_error()); }
     mysqli_select_db($link, 'kv96') or die(mysql_error());
     return $link;
}

function isValidLogin($User, $Pass) {
    global $logInTable;
    $link = connectToDatabase();
    $query = mysqli_query($link,"SELECT * FROM " . $logInTable .
        " WHERE User_ID = '$User' AND Password ='$Pass'"); //Finds the database and chooses the row
    $row = mysqli_fetch_array($query); //Fetches the row
    mysqli_close($link);
    if($row['User_ID'] != null && $row['Password'] != null){return true;}
    else{return false;}
}

function getLoginRole($User) {
    global $logInTable;
    $link = connectToDatabase();
    $query = mysqli_query($link,"SELECT * FROM " . $logInTable . " WHERE User_ID = '$User'" ); //Finds the database and chooses the row
    //$result = mysqli_query($query);
    $row = mysqli_fetch_array($query); //Fetches the row
    mysqli_close($link);
    if($row['Role'] == 't'){return 't';}
    if($row['Role'] == 's'){return 's';}
    else{return "s";}
}

function createNewQuestion($Question, $Input1, $Input2, $Input3, $Correct1, $Correct2, $Correct3) {
    global $questionsTable;
    $link = connectToDatabase();
    $insertQuery= "INSERT INTO $questionsTable" .
        " (Question, Input1, Input2, Input3, Correct1, Correct2, Correct3) VALUES " .
        "('$Question', '$Input1', '$Input2', '$Input3', '$Correct1', '$Correct2', '$Correct3')";
    mysqli_query($link,$insertQuery);
    mysqli_close($link);
}

function getExamsTableRows() {
    global $examsTable;
    $link = connectToDatabase();
    $result = mysqli_query($link, "SELECT EID, ExamName FROM $examsTable");
    $rows = array();
    while ($row = mysqli_fetch_array($result)) {
        array_push($rows, $row);
    }
    return $rows;
}


//INSERT $NAME of exam that teacher created
//INSERT $STUDENT the name of the exam created in function TAKEEXAM
// INSERT an array with with QID's from createOE, which are on the exam
function GetQuestionandAnswer($name, $student, $arraytest){
    global $questionTables;
    $link = connectToDatabase();
    //$sql2 = mysqli_query($link, "SELECT QuestionID  FROM ".$name."");
     foreach($arraytest as $arr){
         echo $arr;
       $CorrectAns = mysqli_query($link, "SELECT * FROM " . $questionTables . " WHERE QID = '$arr'");
        $fetch = mysqli_fetch_array($CorrectAns);
         print_r($fetch);

        $Correct1 = $fetch["Correct1"];
        $Correct2 = $fetch["Correct2"];
        $Correct3 = $fetch["Correct3"];
        $Question = $fetch["Question"];
        //$QuestionID = $fetch["QID"];
        $query = mysqli_query($link, "INSERT INTO ".$student."(Correct1, Correct2, Correct3, Question) VALUES ( '$Correct1','$Correct2', '$Correct3', '$Question')");

     }

    mysqli_close($link);
}

//INSERT an $array of the students inputs
//Insert $name of table that is created in Takeexam function
//INSERT $questionid from table that is created in takeexam function
function AddStudentsAns($array, $student, $qid){
    $link = connectToDatabase();
    mysqli_query($link,"UPDATE ".$student." SET StudAnswer = '$array[0]', StudAnswer2 = '$array[1]', StudAnswer3 = '$array[2]' WHERE QuestionID =  '$qid[0]'");
        //"INSERT INTO ".$student."(StudAnswer, StudAnswer2, StudAnswer3) VALUES ('$array[0]','$array[1]','$array[2]'
    //"UPDATE ".$student." SET StudAnswer = '$array[0]', StudAnswer2 = '$array[1]', StudAnswer3 = '$array[2]' WHERE QuestionID =  '$qid'"

mysqli_close($link);
}

//Insert $arrayquestions - Array of QIDS from STUDENT EXAM TABLE ex:If you were looking at NIARAN table in phpmyadmin you would send me an arrray cosisting of 1,2,3
//Insert $student- StudentExamname which is created in takeexamfunction
function CompareAns($arrayquestions, $student){
   $link = connectToDatabase();
    $totalcounter = 0;
    foreach($arrayquestions as $arr){
        $counter = 0;
        $query = mysqli_query($link, "SELECT Correct1, Correct2, Correct3, StudAnswer, StudAnswer2, StudAnswer3 FROM ".$student." WHERE QuestionID = '$arr'");
        $fetch = mysqli_fetch_assoc($query);
        $cor1 = $fetch['Correct1'];
        $cor2 =$fetch['Correct2'];
        $cor3 =$fetch['Correct3'];
        $stud1 =$fetch['StudAnswer'];
        $stud2 =$fetch['StudAnswer2'];
        $stud3 =$fetch['StudAnswer3'];
        if($cor1 == $stud1){$counter++;}
        $totalcounter++;
        if($cor2 == $stud2){$counter++;}
        $totalcounter++;
        if($cor3 == $stud3){$counter++;}
        $totalcounter++;
        $points = $counter;
        mysqli_query($link, "UPDATE ".$student." SET Points = '$points' WHERE QuestionID = '$arr'");
    }
    mysqli_close($link);
}

//Insert $student - Student exam name
//Insert $arrays - Arrays of QID from Exam Table or StudentExam table EX:Niaran or Niaranexam
function CalculateGrade($student,$arrays) {
    $link = connectToDatabase();
    $query = mysqli_query($link, "SELECT QuestionID FROM ".$student." ORDER BY QuestionID DESC LIMIT 1");
    $fetch =mysqli_fetch_array($query);
    $TotalNumberQuestions = $fetch[0] * 3;
    $point = "";
    foreach($arrays as $arr) {
        $query = mysqli_query($link, "SELECT Points FROM ".$student." WHERE QuestionID = '$arr'");
        $fetch = mysqli_fetch_assoc($query);
        $point += $fetch["Points"] * 100;
    }
    $Grade = ($point/$TotalNumberQuestions);
    mysqli_close($link);
    return $Grade;
}

function createExam($examName, $qidsPoints2DArray) {
    $link = connectToDatabase();
    mysqli_query($link, "INSERT INTO Exams (ExamName) VALUES('$examName')");
    $query = mysqli_query($link, "SELECT EID FROM Exams WHERE ExamName = '$examName'");
    $fetch = mysqli_fetch_assoc($query);
    $EID = $fetch["EID"];
    foreach ($qidsPoints2DArray as $qid) {
        mysqli_query($link, "INSERT INTO ExamsQuestions(EID, QID, Points) VALUES ('$EID','$qid[0]', '$qid[1]')");
    }
    populateIsReleasedTableForExams($EID);
     mysqli_close($link);
}

class ExamQuestion {
    public $qid;
    public $points;
    public $question;
    public $difficulty;
}

function getAllQuestions() {
    global $questionsTable;
    $link = connectToDatabase();
    $query = "SELECT * FROM $questionsTable";
    $result = mysqli_query($link, $query);
    $rows = array();
    while ($row = mysqli_fetch_array($result)) {
        array_push($rows, $row);
    }
    return $rows;
}

function getStudentAnswersRows($sid, $eid) {
    global $studentsAnswersTable;
    $link = connectToDatabase();
    $query = "SELECT * FROM $studentsAnswersTable " .
             "WHERE SID = $sid AND EID = $eid";
    $results = mysqli_query($link, $query);
    $rows = array();
    while ($row = mysqli_fetch_array($results)) {
        array_push($rows, $row);
    }
    return $rows;
}

function getExamQuestionsRows($eid) {
    global $examsQuestionsTable;
    $link = connectToDatabase();
    $query = "SELECT * FROM $examsQuestionsTable WHERE EID = '$eid'";
    $result = mysqli_query($link, $query);
    $returnExamQuestions = array();
    while ($row = mysqli_fetch_array($result)) {
        $examQuestion = new ExamQuestion();
        $qid = $row["QID"];
        $questionRow = getRowFromQuestionsTable($qid);
        $examQuestion -> qid        = $qid;
        $examQuestion -> points     = $row["Points"];
        $examQuestion -> question   = $questionRow["Question"];
        $examQuestion -> difficulty = $questionRow["Difficulty"];
        array_push($returnExamQuestions, $examQuestion);
    }
    mysqli_close($link);
    return $returnExamQuestions;
}

function getRowFromQuestionsTable($qid) {
    global $questionsTable;
    $link = connectToDatabase();
    $query = "SELECT * FROM $questionsTable WHERE QID = '$qid'";
    $result = mysqli_query($link, $query);
    mysqli_close($link);
    return mysqli_fetch_array($result);
}

function getPointsForExamQuestion($eid, $qid) {
    global $examsQuestionsTable;
    $link = connectToDatabase();
    $query = "SELECT * FROM $examsQuestionsTable " .
             "WHERE EID = $eid AND QID = $qid";
    $result = mysqli_query($link, $query);
    mysqli_close($link);
    return mysqli_fetch_array($result)["Points"];
}

function putStudentAnswerAndPointsInTable($sid, $eid, $qid, $code, $points) {
    global $studentsAnswersTable;
    $link = connectToDatabase();
    $query = "INSERT INTO $studentsAnswersTable(SID, EID, QID, AnswerCode, Points) " .
             "VALUES ('$sid', '$eid', '$qid', '$code', '$points')";
    mysqli_query($link, $query);
    mysqli_close($link);
}

function getTeachersAnswer($qids){
    $link = connectToDatabase(); 
    foreach($qids as $qid){
        $query = mysqli_query($link, "SELECT Correct1, Correct2, Correct3 FROM Questions WHERE QID = '$qid'");
        while($row = mysqli_fetch_array($query)){
            print_r($row);
        }      
    }
    return $fetch;
}
function getAllStudentIDs(){
    $link = connectToDatabase();
    $collectSIDs = mysqli_query($link, "SELECT User_ID FROM LogIn WHERE Role = 's'");
    $SIDs = array();
    while($rows = mysqli_fetch_assoc($collectSIDs)){
        $fetch = $rows['User_ID'];
        array_push($SIDs, $fetch);
    }
    return $SIDs;
}
function populateIsReleasedTableForExams($eid){
    $link = connectToDatabase();
    $SIDs = getAllStudentIDs();
    
    for($i = 0; $i < sizeof($SIDs); $i++){
        $sid = $SIDs[$i];
        $insert = mysqli_query($link, "INSERT INTO isExamReleased(EID, SID) VALUES('$eid', '$SIDs[$i]')");
    }
}
function didStudentTakeExam($eid, $sid){
    $link = connectToDatabase();
    $query = mysqli_query($link, "SELECT AnswerCode FROM StudentsAnswers WHERE SID = '$sid' AND EID = '$eid'");
    $fetc = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $fetch = $row['AnswerCode'];
        array_push($fetc, $fetch);
        if($fetc != null){return true;}
    }
    return false;
}
function insertTrueIntoExamReleased($eid, $sid){
    $link = connectToDatabase();
    $checkIfTrue = didStudentTakeExam($eid, $sid);
    if($checkIfTrue == 1){
        $insert = mysqli_query($link, "UPDATE isExamReleased SET isReleased = '1' WHERE SID = '$sid' AND EID = '$eid'");
    }
}
function isExamReleased($eid, $sid){
    $link = connectToDatabase();
    $check = mysqli_query($link, "SELECT isReleased FROM isExamReleased WHERE SID = '$sid' AND EID = '$eid'");
    $getCheck = mysqli_fetch_assoc($check);
    $fetch = $getCheck['isReleased'];
    if($fetch == 1){return true;}
    else {return false;}
    mysqli_close($link);
}
function calculateTotalPointsForExam($eid){
    $link = connectToDatabase();
    $collectPoints = mysqli_query($link, "SELECT Points FROM ExamsQuestions WHERE EID = '$eid'");
    $collect = array();
    while($rows = mysqli_fetch_assoc($collectPoints)){
        $fetch += $rows['Points'];
        //array_push()
    }
    return $fetch;
}
function calculateTotalPointsForStudentExamAttempt($eid, $sid, $qid){
    $link = connectToDatabase();
    for($i = 0; $i < sizeof($qid); $i++){
        $collectPoints = mysqli_query($link, "SELECT Points FROM StudentsAnswers WHERE SID = '$sid' AND EID = '$eid' AND QID = $qid[$i]");
        $rows = mysqli_fetch_assoc($collectPoints);
        $fetch += $rows['Points'];
    }
    return $fetch;
}
function calculateStudentsTotalExamGrade($eid, $sid, $qid){
    $link = connectToDatabase();
    $totalPointsPossible = calculateTotalPointsForExam($eid);
    $studentsTotalPoints = calculateTotalPointsForStudentExamAttempt($eid, $sid, $qid);
    $finalGrade = $studentsTotalPoints / $totalPointsPossible;
    return $finalGrade;
}

function addInstructorCommentForExamAnswer($eid, $sid, $qid, $comment){
    $link = connectToDatabase();
    $insert = mysqli_query($link, "UPDATE StudentsAnswers SET Comment = '$comment' WHERE SID = '$sid' AND EID = '$eid' AND QID = '$qid'");
}
