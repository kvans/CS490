 <?php

 function connectToDatabase() {
     $link = mysqli_connect('sql2.njit.edu', 'kv96', 'PQrAbwHR');
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
    if($row['Role'] == 't'){return "t";}
    else{return "s";}
}