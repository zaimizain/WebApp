<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home Page</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<style>

h3{
  font-family: sans-serif;
  color: black;
}
body{
  background-image: url('https://img.freepik.com/free-photo/business-partners-handshake-global-corporate-with-technology-concept_53876-102615.jpg?w=1600');
  text-align: center;
  background-color: #FFF0F5;
  font-family: sans-serif;
}
</style>

<body>
  <!-- <h1>Welcome User!</h1> -->
  <?php
  session_start();
  if (!isset($_SESSION['uname']) || strlen($_SESSION['uname']) < 1) {
    die("Please head to <a href='login.php'>Login</a>");
  }
  ?>
  <table class="table" id="data">
  <thead class="thead-dark">
    <tr>
      <!-- <th>ID</th> -->
      <th>No. </th>
      <th>Project Name</th>
      <th>Score (/175)</th>
    </tr>
    <?php
    include 'db_connection.php';
    $conn = OpenCon();
    // $pdo=new PDO('mysql:host=localhost;port=3306;dbname=project','root', '1234');
    $uname = $_SESSION['uname'];
    $userid = $_SESSION['userid'];

    if ($_SESSION['uname']) {
      echo "<h3>Welcome, ";
      echo htmlentities($_SESSION['uname']);
      echo "!</h3>\n";
    }
    $sql = "SELECT DISTINCT result1,result2,result3,result4,result5,result6,result7, projectname FROM user_result JOIN addproject on user_result.projectid=addproject.projectid where user_result.userid=$userid ";
    $pdo=new PDO('mysql:host=localhost;port=3306;dbname=project','root', '');
    $query1 = $conn->query("SELECT * FROM user_result JOIN addproject where user_result.userid = addproject.userid");
     while($r1 = $query1->fetch(PDO::FETCH_ASSOC)){

    $userid =  $r1['userid'];

    }
//SELECT quiz_result.id, projectname, quiz time_access FROM quiz_result JOIN addproject on quiz_result.userid=addproject.userid where quiz_result.userid = '$userid' and quiz_result.id=addproject.quizid
$stmt = $conn->query($sql);    
// $stmt = $conn->prepare($sql);
//     $stmt->bindParam(':userid', $userid);
    $stmt->execute();
    $resultJSON = json_encode($stmt->fetchAll());
    if (!json_decode($resultJSON, true) ) {
      echo "<tr>";
      echo "<td colspan=\"4\" style=\"text-align: center;\">No Records Available</td>";
      echo "</tr>";
    } else {
      foreach (json_decode($resultJSON, true) as $index => $row) {
        echo "<tr>";
        // echo "<td>" . $row['id'] . "\t </td>";
        echo "<td>" . ($index + 1) . "\t </td>";
        echo "<td>" . $row['projectname'] . "\t </td>";
        echo "<td>" . $row['result1'] + $row['result2'] + $row['result3'] + $row['result4'] + $row['result5'] + $row['result6'] + $row['result7'] . "\t </td>";
        echo "</tr>";
      }
    }

    if (isset($_POST['logout'])) {
      unset($SESSION['uname']);
      header("Location: login.php");
      return;
    }
    if (isset($_POST['play'])) {
      header("Location: addproject.php?name=" . urlencode($uname) . "&userid=" . urlencode($userid));
      return;
    }


    ?>
</thead >
  </table>
  <form method="post">
    <button type="submit" name="play" class="btn btn-secondary ">Start Evaluation</button>
    <button type="submit" name="logout" class="btn btn-danger">Logout</button>

  </form>
