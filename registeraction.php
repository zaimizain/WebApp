<?php
session_start();
$name = $_SESSION['name'];
$position = $_SESSION['position'];
$uname = $_SESSION['uname'];
$pw = md5($_SESSION['pw']);


include 'db_connection.php';
include 'register.php';
$conn = OpenCon();
// $conn=new PDO('mysql:host=localhost;port=3306;dbname=project','root', '1234');
$stmt = $conn->prepare("INSERT INTO user (name,position,username,password)
VALUES (:name, :position, :username, :password)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':username', $uname);
    $stmt->bindParam(':password', $pw);
    $stmt->execute();
    session_destroy();
    echo "Succesfully registered. Please head to ";



?>
<a href="login.php">Login</a>