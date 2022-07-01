<!DOCTYPE html>
<html lang="en">

<html>

<head>
  <link rel='stylesheet' type='text/css' href='login.css'>
</head>

<meta charset=utf-8 />
<title>Login</title>

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
  <h1>Login to Test Project Complexity and Risk Assessment Tool</h1>

  <?php
  include 'db_connection.php';
  $conn = OpenCon();
  // $pdo=new PDO('mysql:host=localhost;port=3306;dbname=project','root', '1234');


  if (isset($_POST['uname']) && isset($_POST['pw'])) {
    $uname = $_POST['uname'];
    $pw = $_POST['pw'];
    $stored_hash = md5($_POST['pw']);
    if (strlen($uname) < 1 || strlen($pw) < 1) {
      $msg = "User name and password are required";
      if ($msg !== false) {
        echo ('<p style="color: red;">' . htmlentities($msg) . "</p>\n");
      }
    } else {
      $query1 = "SELECT * FROM user WHERE username='$uname'";
      $result1 = $conn->query($query1);
      if ($result1->rowCount() == 1) {
        $query2 = "SELECT userid,username,password FROM user WHERE username='$uname'";
        $result2 = $conn->query($query2);
        session_start();
        while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
          $_SESSION["uname"] = $row['username'];
          $_SESSION["userid"] = $row['userid'];
          $pwdata = $row["password"];
        }
        //echo $result2; //Testing to see if am getting the hashed password.
        if ($stored_hash == $pwdata) {
          header("Location: home.php");
          return;
        } else {
          $msg = "Incorrect password";
        }
        if ($msg !== false) {
          echo ('<p style="color: red;">' . htmlentities($msg) . "</p>\n");
        }
      } else if ($result1->rowCount() == 0) {
        echo "User does not exist, please redirect to register <a href=\"register.php\">Sign Up</a>";
      }
    }
  }
  if (isset($_POST['register'])) {
    header('Location: register.php');
    return;
  }


  ?>
  <div class="container" onclick="onclick">
    <div class="top"></div>
    <div class="bottom"></div>
    <div class="center">
  <form method="post">
    <span style="color:red; font-weight:bold;"></span>
    <p>User Name <input type="text" name="uname" id="uname" /></p>
    <p>Password <input type="password" name="pw" id="pw" /></p>
    <a href="adminlogin.php" style="text-decoration: none;">Log in as admin</a><br>
    <button type="submit" class="button" id="login">Log In</button>
    <button type="submit" class="button" name="register">Sign Up</button>
    
  </form>
</div>
</body>
</html>