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
function InsertintoExamBank($arr){
    $link = connectToDatabase();
    //$ExamName = mysqli_query($link, "INSERT INTO ExamBank(ExamName) VALUES ($name)");
    $sizeAr = count($arr);
//    foreach($arr as $ar){
        switch($sizeAr){
            case 1:
                $a0 = mysqli_query($link, "INSERT INTO ExamBank(Q1,ExamName) VALUES ($arr[0])");
                break;
            case 2:
                $a1 = mysqli_query($link, "INSERT INTO ExamBank(Q1, Q2) VALUES ($arr[0],$arr[1])");
                break;
            case 3:
                $a2 = mysqli_query($link, "INSERT INTO ExamBank(Q1, Q2, Q3) VALUES ($arr[0], $arr[1], $arr[2])");
                break;
            case 4:
                $a3 = mysqli_query($link, "INSERT INTO ExamBank(Q1, Q2, Q3, Q4) VALUES ($arr[0], $arr[1], $arr[2],$arr[3])");
                break;
            case 5:
                $a4 = mysqli_query($link, "INSERT INTO ExamBank(Q1, Q2, Q3, Q4, Q5) VALUES ($arr[0], $arr[1], $arr[2],$arr[3] ,$arr[4])");
                break;
            case 6:
                $a5 = mysqli_query($link, "INSERT INTO ExamBank(Q1, Q2, Q3, Q4, Q5, Q6) VALUES ($arr[0], $arr[1], $arr[2],$arr[3] ,$arr[4], $arr[5])");
                break;
            case 7:
                $a6 = mysqli_query($link, "INSERT INTO ExamBank(Q1, Q2, Q3, Q4, Q5, Q6, Q7) VALUES ($arr[0], $arr[1], $arr[2],$arr[3] ,$arr[4], $arr[5], $arr[6])");
                break;
            case 8:
                $a7 = mysqli_query($link, "INSERT INTO ExamBank(Q1, Q2, Q3, Q4, Q5, Q6, Q7, Q8) VALUES ($arr[0], $arr[1], $arr[2],$ar[3] ,$arr[4], $arr[5], $arr[6], $arr[7])");
                break;
            case 9:
                $a8 = mysqli_query($link, "INSERT INTO ExamBank(Q1, Q2, Q3, Q4, Q5, Q6, Q7, Q8, Q9) VALUES ($arr[0], $arr[1], $arr[2],$arr[3] ,$arr[4], $arr[5], $arr[6], $arr[7], $arr[8])");
                break;
            case 10:
                $a9 = mysqli_query($link, "INSERT INTO ExamBank(Q1, Q2, Q3, Q4, Q5, Q6, Q7, Q8, Q9, Q10) VALUES ($arr[0], $arr[1], $arr[2],$arr[3] ,$arr[4], $arr[5], $arr[6], $arr[7], $arr[8], $arr[9])");
                break;
            case 11:
                $a10 = mysqli_query($link, "INSERT INTO ExamBank(Q1, Q2, Q3, Q4, Q5, Q6, Q7, Q8, Q9, Q10, Q11) VALUES ($arr[0], $arr[1], $arr[2],$arr[3] ,$arr[4], $arr[5], $arr[6], $arr[7], $arr[8], $arr[9], $arr[10])");
                break;
            case 12:
                $a11 = mysqli_query($link, "INSERT INTO ExamBank(Q1, Q2, Q3, Q4, Q5, Q6, Q7, Q8, Q9, Q10, Q11, Q12) VALUES ($arr[0], $arr[1], $arr[2],$arr[3] ,$arr[4], $arr[5], $arr[6], $arr[7], $arr[8], $arr[9], $arr[10], $arr[11])");
                break;
            case 13:
                $a12 = mysqli_query($link, "INSERT INTO ExamBank(Q1, Q2, Q3, Q4, Q5, Q6, Q7, Q8, Q9, Q10, Q11, Q12, Q13) VALUES ($arr[0], $arr[1], $arr[2],$ar[3] ,$arr[4], $arr[5], $arr[6], $arr[7], $arr[8], $arr[9], $arr[10], $arr[11], $arr[12])");
                break;
            case 14:
                $a13 = mysqli_query($link, "INSERT INTO ExamBank(Q1, Q2, Q3, Q4, Q5, Q6, Q7, Q8, Q9, Q10, Q11, Q12, Q13, Q14) VALUES ($arr[0], $arr[1], $arr[2],$arr[3] ,$arr[4], $arr[5], $arr[6], $arr[7], $arr[8], $arr[9], $arr[10], $arr[11], $arr[12], $arr[13])");
                break;
            case 15:
                $a14 = mysqli_query($link, "INSERT INTO ExamBank(Q1, Q2, Q3, Q4, Q5, Q6, Q7, Q8, Q9, Q10, Q11, Q12, Q13, Q14, Q15) VALUES ($arr[0], $arr[1], $arr[2],$arr[3] ,$arr[4], $arr[5], $arr[6], $arr[7], $arr[8], $arr[9], $arr[10], $arr[11], $arr[12], $arr[13], $arr[14])");
                break;
        }

        
//    }
mysqli_close($link);
}
function GetQuestions($arraytest){
    $link = connectToDatabase();
    foreach($arraytest as $num){
        $id = mysqli_query($link, "SELECT Question FROM CreateOE WHERE QID = '$num'");
        $oe[] = mysqli_fetch_array($id);
    }
    return $oe;
    mysqli_close($link);
}
