<?php
# Brian Hernandez
# CS 490 Login Page Alpha
# July 7, 2016

$username = $_GET["username"];
$password = $_GET["password"];

$queryString = "username=" . $username . "," . "password=" . $password;

$curl = curl_init();
$url = "https://web.njit.edu/~kv96/cs490/Back/blank.php";
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $queryString);
curl_close($curl);

echo "Login successful";

?>