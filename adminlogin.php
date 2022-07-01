<!DOCTYPE html>
<html lang="en">

<html>

<head>
  <link rel='stylesheet' type='text/css' href='login.css'>
</head>

<meta charset=utf-8 />
<title>Admin Login</title>

<style>
h1{
  color: #DA70D6;
}
body{
  text-align: center;
}

.button {
    margin-top: 10px;
    background-color: #e46569;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
</style>

<body>
  <h1>Admin Login</h1>
<?php

if ( isset($_POST['cancel'] ) ) {
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Pw is php123
$failure = false;
$contains = '@';
if ( isset($_POST['who']) && isset($_POST['pass'])  ) {
    //echo("<p>Handling POST data...</p>\n");
    $contains = strstr($_POST['who'], '@');
    if ( strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1 ) {
        $failure = "Email and password are required";
    } else if($contains === false){
        $failure = 'Email must have an at-sign (@)';
    } else {
      $check = hash('md5', $salt.$_POST['pass']);
      if ( $check == $stored_hash ) {
           error_log("Login success ".$_POST['who']);//login success
           header("Location: adminhome.php");
           return;
        } else {
           $failure = "Incorrect password";
           error_log("Login fail ".$_POST['who']." $check");//login fail due to bad pw
        }
    }
  }
?>
<body>
<div class="container">
<?php

if ( $failure !== false ) {
    // Look closely at the use of single and double quotes
    echo('<p style="color: red;">'.htmlentities($failure)."</p>\n");
}
?>
<div class="container" onclick="onclick">
    <div class="top"></div>
    <div class="bottom"></div>
    <div class="center">
  <form method="post">
    <span style="color:red; font-weight:bold;"></span>
    <p>User Name <input type="text" name="who" id="uname" /></p>
    <p>Password <input type="password" name="pass" id="pw" /></p>
    <a href="login.php" style="text-decoration: none;">Log in as project manager</a><br>
    <button type="submit" class="button" id="login">Log In</button>
  </form>
</div>
</body>
</html>