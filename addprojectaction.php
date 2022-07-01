<!DOCTYPE html>
<html>

<head>
  <title>Insert Page page</title>
</head>

<body>
  <center>
    <?php

    // servername => localhost
    // username => root
    // password => empty
    // database name => staff
    $conn = mysqli_connect("localhost", "root", "", "project");

    // Check connection
    if ($conn === false) {
      die("ERROR: Could not connect. "
        . mysqli_connect_error());
    }

    // Taking all 5 values from the form data(input)
    //$projectname =  $_REQUEST['projectname'];
    //$owner= $_REQUEST['owner'];
    //$financial =  $_REQUEST['financial'];
    //$duration = $_REQUEST['duration'];
    //$mode = $_REQUEST['mode'];

    // Performing insert query execution
    // here our table name is college
    //$sql = "INSERT INTO addproject (projectname, owner, financial, duration, mode) VALUES ('$projectname',
    //    '$owner','$financial','$duration','$mode')";
    session_start();
    $pdo=new PDO('mysql:host=localhost;port=3306;dbname=project',
          'root', '');
    $userid = $_SESSION["userid"];
    $uname = $_POST["uname"];
    $projectname = $_POST["projectname"];
    $owner = $_POST["owner"];
    $financial = $_POST["financial"];
    $duration = $_POST["duration"];
    $mode = $_POST["mode"];

    $query = "SELECT projectid FROM addproject WHERE userid = '$userid' ";

$result = $pdo->query($query);
while($row = $result->fetch(PDO::FETCH_ASSOC)){
   $projectid=$row['projectid'];
}

    include 'db_connection.php';
    $conn = OpenCon();
    // $pdo=new PDO('mysql:host=localhost;port=3306;dbname=project',
    //      'root', '1234');
    $stmt = $conn->prepare("INSERT INTO addproject (projectname,owner,financial,duration,mode, userid)
             VALUES (:projectname, :owner, :financial, :duration, :mode, :userid)");
    $stmt->bindParam(':projectname', $projectname);
    $stmt->bindParam(':owner', $owner);
    $stmt->bindParam(':financial', $financial);
    $stmt->bindParam(':duration', $duration);
    $stmt->bindParam(':mode', $mode);
    $stmt->bindParam(':userid', $userid);
    //$stmt->execute();

    if ($stmt->execute()) {
      $stmt2 = $conn->prepare("SELECT projectid FROM addproject where userid=:userid AND projectname=:projectname");
      $stmt2->bindParam(':userid', $userid);
      $stmt2->bindParam(':projectname', $projectname);

      $rows = $stmt2->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows as $row) {
        $projectid = $row['projectid'];
      }
      $_SESSION['projectid'] = $projectid;
    }
    echo "Data succesfully added. ";

    $projectid = '';
        $stmt = $conn->query("SELECT projectid FROM addproject where userid = $userid and projectname = '$projectname' ");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          $projectid = $row['projectid'];
}
    // Please head to <a href='home.php?name=$uname'>Home</a> or <a href='login.php'>Logout</a>

    //  if(mysqli_query($conn, $stmt)){
    //      echo "<h3>data stored in a database successfully.</h3>";


    //  } else{
    //      echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
    //  }

    // Close connection
    //  mysqli_close($conn);

    if (isset($_POST['submit'])) {
      header("Location: quiz.php?name=" . urlencode($uname) . "&userid=" . urlencode($userid) . "&projectid=" . urlencode($projectid));
      return;
    }
    ?>
    <html>

    <head>
      <title>Save Result</title>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>

      <script type="text/javascript" language="javascript">
        $(document).ready(function() {
          setTimeout(function() {
            window.location.href = "quiz.php?name=<?php echo $uname ?>"
          }, 3000);
        });
      </script>
    </head>

    <style>
      body {
        background: #007bff;
        background: linear-gradient(to right, #0062E6, #33AEFF);
        background-image: url('https://img.freepik.com/free-photo/business-partners-handshake-global-corporate-with-technology-concept_53876-102615.jpg?w=1600');
        background-color: #F39C12;
        text-align: center;
        font-family: serif;
      }
    </style>

    <body>
      <p>Click <a href='quiz.php?name=<?php $uname ?>'>here</a> if you are not redirected. </p>

    </body>

    </html>

  </center>
</body>

</html>