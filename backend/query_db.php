 <?php

 function connectToDatabase() {
     $link = mysqli_connect('127.0.0.1', 'kv96', 'PQrAbwHR');
     if (!$link) { die('Could not connect: ' . mysql_error()); }
     mysqli_select_db($link, 'kv96') or die(mysqli_error());
     return $link;
 }

function isValidLogin($User, $Pass){
    $link = connectToDatabase();
    $query = mysqli_query($link,"SELECT * FROM Log_in WHERE User_ID = '$User' AND Password ='$Pass'"); //Finds the database and chooses the row
    //$result = mysqli_query($query);
    $row = mysqli_fetch_array($query); //Fetches the row
    mysqli_close($link);
    if($row['User_ID'] != null && $row['Password'] != null){return true;}
    else{return false;}

}

function getLoginRole($User){
    $link = connectToDatabase();
    $query = mysqli_query($link,"SELECT * FROM Log_in WHERE User_ID = '$User'" ); //Finds the database and chooses the row
    //$result = mysqli_query($query);
    $row = mysqli_fetch_array($query); //Fetches the row
    mysqli_close($link);
    if($row['Role'] == 't'){return 't';}
    if($row['Role'] == 's'){return 's';}
    else{return "s";}
}
function CreateOE($Question, $Input1, $Input2, $Input3, $Correct1, $Correct2, $Correct3){
    $link = connectToDatabase();
    $OE= "INSERT INTO CreateOE (Question, Input1, Input2, Input3, Correct1, Correct2, Correct3) VALUES ('$Question', '$Input1', '$Input2', '$Input3', '$Correct1', '$Correct2', '$Correct3')";
    mysqli_query($link,$OE);
    mysqli_close($link);
}
function DisplayOE(){
    $link = connectToDatabase();
    $rows = mysqli_query($link, "SELECT * FROM CreateOE"); 
    while ($row = mysqli_fetch_array($rows)) {
        $oe[] =$row;
    }
        return $oe;
        mysqli_close($link);
    }
function CreateExamDB($arr, $name){
    $link = connectToDatabase();
    $sql = "CREATE TABLE `".$name."` (
    QuestionNum INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    QuestionID INT(255) NOT NULL,  
    Question TEXT NOT NULL
    )";
    mysqli_query($link, $sql);
    foreach($arr as $ar){
        $questions = mysqli_query($link, "SELECT QID, Question FROM CreateOE WHERE QID = '$ar'");
        $fetch = mysqli_fetch_assoc($questions);
        $qid =$fetch['QID'];
        $quest = $fetch['Question'];
        $OE = mysqli_query($link, "INSERT INTO ".$name."(QuestionID, Question) VALUES ('$qid', '$quest')");
        
    }
    mysqli_close($link);
    
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
