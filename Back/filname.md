```
<?php
$link = mysqli_connect('sql2.njit.edu','kv96','PQrAbwHR'); //Creates a connection
    if(!$link){
       die(' Could not connect: '.mysql_error());
    }
mysqli_select_db($link,'kv96') or die(mysqli_error()); //Selects the database
$request = file_get_contents('php://input'); //Gets raw informations
$recieve = json_decode($request); //Converts that raw infromation into php variable

$User = $recieve->username; //Gets User Id
$Pass = $recieve->password; // Gets password
//$User = 'kv963';
//$Pass = 'passkv';
$query = mysqli_query($link,"SELECT * FROM Log_in WHERE Password = '$Pass' AND User_ID ='$User'"); //Finds the database and chooses the row
$row = mysqli_fetch_assoc($query); //Fetches the row
if($row['Role']=='t'){
    echo "Successful Log in";
}
else{
    echo 'failed Logi';
}
mysqli_free_result($query);//Dumps data
mysqli_close($link);
?>
```
