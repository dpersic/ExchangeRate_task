<?php

function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "my_database";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 //echo "Connected Successfully"."<br>";
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>