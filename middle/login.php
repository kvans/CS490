<?php

#
# Service allowing authentication of users login given
# a username and password. Clients of this service can
# authenticate users using an HTTP POST with the username
# and password given as part of the request body. 
#
# Author: Brian Hernandez
#

include "../backend/query_db.php";

$username = $_POST["username"];
$password = $_POST["password"];

if (isValidLogin($username, $password)) {
    echo "{ isValid: true, role: " . getLoginRole($username) . " }";
}
else {
    echo "{ isValid: false }";
}