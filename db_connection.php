<?php

function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "project";

 try {
   $conn = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser, $dbpass);
   // set the PDO error mode to exception
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   return $conn;
 } catch(PDOException $e) {
   echo "Connection failed: " . $e->getMessage();
   return null;
 }

}

function CloseCon($conn)
 {
 $conn -> close();
 }