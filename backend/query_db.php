 <?php
 //Selects the database

//$User = 'kv96';
//$Pass = 'passkv';

function isValidLogin($User, $Pass){
    $link = mysqli_connect('sql2.njit.edu','kv96','PQrAbwHR'); //Creates a connection
     if(!$link){die(' Could not connect: '.mysql_error());}
    mysqli_select_db($link,'kv96') or die(mysqli_error()); //Selects the database
    global $link;
    $query = mysqli_query($link,"SELECT * FROM Log_in WHERE User_ID = '$User' AND Password ='$Pass'"); //Finds the database and chooses the row
    //$result = mysqli_query($query);
    $row = mysqli_fetch_array($query); //Fetches the row
      if($row['User_ID'] != null && $row['Password'] != null){return true;}
      else{return false;}
      mysqli_close($link);
    
}
//echo isValidLogin('kv96','passkv');
function getLoginRole($User){
    $link = mysqli_connect('sql2.njit.edu','kv96','PQrAbwHR'); //Creates a connection
      if(!$link){die(' Could not connect: '.mysql_error());}
    mysqli_select_db($link,'kv96') or die(mysqli_error()); //Selects the database
    global $link;
    $query = mysqli_query($link,"SELECT * FROM Log_in WHERE User_ID = '$User'" ); //Finds the database and chooses the row
    //$result = mysqli_query($query);
    $row = mysqli_fetch_array($query); //Fetches the row
      if($row['Role'] == 't'){echo 'a Teacher';}
      else{echo "Not a Teacher";}
    mysqli_close($link);
}
//echo getLoginRole('kv96');

//echo isValidLogin($User, $Pass);
//mysqli_free_result($query);//Dumps data
?>
