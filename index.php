<!DOCTYPE html> 
<html> 

<head> 
    <title>Login Screen</title> 
</head> 

<body> 
<form name="login" id="login-form" action="CS490/middle/login.php" method="post" accept-charset="utf-8"> 
    <label for="username">Username: </label> 
    <input type="username" id="username" name="username" placeholder="username" required><br> 
    <label for="password">Password: </label> 
    <input type="password" id="password" name="password" placeholder="password" required><br> 
    <button id="loginButton" type="submit">Login</button>
    <br>
    <?php
        $reasons = array("password" => "Wrong Username or PAssword");
            if ($_GET["loginFailed"]){
                echo $reasons[$_GET["reason']];
            }
    ?>
</form> 
</body> 
</html> 
