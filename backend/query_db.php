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
