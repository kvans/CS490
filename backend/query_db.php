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
    $insertQuery= "INSERT INTO " . $questionsTable .
        "(Question, Input1, Input2, Input3, Correct1, Correct2, Correct3) VALUES" .
        "('$Question', '$Input1', '$Input2', '$Input3', '$Correct1', '$Correct2', '$Correct3')";
    mysqli_query($link,$insertQuery);
    mysqli_close($link);
}

function DisplayQuestions() {
    global $questionsTable;
    $link = connectToDatabase();
    $rows = mysqli_query($link, "SELECT * FROM " . $questionsTable);
    while ($row = mysqli_fetch_array($rows)) {
        $oe[] =$row;
    }
    mysqli_close($link);
    return $oe;
}

function DisplayExam($name){
    $link = connectToDatabase();
     $query = mysqli_query($link,"SELECT Question FROM `".$name."`");
     //$info = array();
     while($oe = mysqli_fetch_assoc($query)) {
         $info[] = $oe;
     }
     return $info;

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
        $insert = mysqli_query($link, "UPDATE ".$student." SET Points = '$points' WHERE QuestionID = '$arr'");
    }
    mysqli_close($link);
}

//Insert $student - Student exam name
//Insert $arrays - Arrays of QID from Exam Table or StudentExam table EX:Niaran or Niaranexam
function CalculateGrade($student,$arrays){
    $link = connectToDatabase();
    $query = mysqli_query($link, "SELECT QuestionID FROM ".$student." ORDER BY QuestionID DESC LIMIT 1");
    $fetch =mysqli_fetch_array($query);
    $TotalNumberQuestions = $fetch[0] * 3;
    $point = "";
    foreach($arrays as $arr){
        $query = mysqli_query($link, "SELECT Points FROM ".$student." WHERE QuestionID = '$arr'");
        $fetch = mysqli_fetch_assoc($query);
        $point += $fetch["Points"] * 100;
    }
    $Grade = ($point/$TotalNumberQuestions);
    mysqli_close($link);
    return $Grade;
}

// Creates a new exam in the database by adding an entry
// with the exam name in the Exams table and adding the
// given questions to the ExamsQuestions table.
function createExam($examName, $qidsPoints2DArray) {

}