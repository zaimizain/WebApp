<!DOCTYPE html>

<head>
  <meta charset=UTF-8 />
  <title>SSE3150 Quiz</title>
  <link rel='stylesheet' type='text/css' href='style.css'>
</head>

<style>
  h1 {
    font-family: monospace;
    color: #00BFFF;
  }
  h3{
  font-family: sans-serif;
  color: black;
}

  li {
    font-family: serif;
    color: #008080;
  }

  body {
    background-color: #FFFFE0;
    background-image: url('https://img.freepik.com/free-photo/business-partners-handshake-global-corporate-with-technology-concept_53876-102615.jpg?w=1600');
  }
  
  .text-block {
            position: center;
            bottom: 0px;
            right: 0px;
            background-color: #C9DCE1;
            color: black;
            padding-left: 20px;
            padding-right: 20px;
            border: 1px solid;
            padding: 10px;
            box-shadow: 5px 10px 18px black;
        }
        table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>

<body>
  <div id="page-wrap">
    <h3>Project Complexity and Risk Assessment Tool</h3>
    <form id="myForm" method="POST" action="quizaction1.php">
      <input type="hidden" name="uname" value="<?php echo $_REQUEST['name'] ?>">
      <!--  <input type="hidden" name="id" value="<?php // echo $_REQUEST['id'] 
                                                  ?>"> -->
         <div class="text-block">
      <?php
      session_start();
      // echo $_SESSION['uname'];
      // echo $_SESSION['projectid'];
      include 'db_connection.php';
      $conn = OpenCon();
      // $userid = $_REQUEST["userid"];
      // $projectid = $_REQUEST["projectid"];
      // $uname = $_POST["uname"];
      // $quizresult = $_POST["quizresult"];
      // $questionid = $_POST["questionid"];
      // $sectionid = $_POST["sectionid"];

      // Include connection file
      // $sql1 = "INSERT INTO quiz_result (userid,quizresult,questionid,sectionid,projectid)
      // VALUES (:userid, :quizresult, :questionid, :sectionid, :projectid)";
      // $stmt1 = $conn->prepare("sql1");
      // $stmt1->execute(array(
      //   'userid'=>$_POST['userid'],
      //   'quizresult'=>$_POST['quizresult'],
      //   'questionid'=>$_POST['questionid'],
      //   'sectionid'=>$_POST['sectionid'],
      //   'projectid'=>$_POST['projectid'],

      // )) 
      // $stmt1->bindParam(':userid', $userid);
      // $stmt1->bindParam(':quizresult', $quizresult);
      // $stmt1->bindParam(':questionid', $questionid);
      // $stmt1->bindParam(':sectionid', $sectionid);
      // $stmt1->bindParam(':projectid', $projectid);
      // $stmt1->execute();

      // Attempt select query execution
      $sql = "SELECT * FROM question JOIN answer ON question.questionid = answer.questionid";
      $pdo = new PDO('mysql:host=localhost;port=3306;dbname=project', 'root', '');

      if ($stmt = $pdo->query($sql)) {

        
        echo '<table class="table table-bordered table-striped" border=0>';
        echo "<thead>";
        echo "<tr>";
        echo "<th>No.</th>";
        echo "<th>Question</th>";
        echo "<th> Rating </th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>";
          echo "<td>" . $row['questionid'] . "</td>";
          echo "<td>" . $row['questionname'] . "</td>";
          echo "<td>";
          echo "<input type='radio' name=" . $row['questionid'] . " id='Ans1' value='1' required='required'>";
          echo "<label for='Ans1'>" . $row['rating_1'] . "</label>";
          echo "<br>";
          echo "<input type='radio' name=" . $row['questionid'] . " id='Ans2' value='2'>";
          echo "<label for='Ans2'>" . $row['rating_2'] . "</label>";
          echo "<br>";
          echo "<input type='radio' name=" . $row['questionid'] . " id='Ans3' value='3'>";
          echo "<label for='Ans3'>" . $row['rating_3'] . "</label>";
          echo "<br>";
          echo "<input type='radio' name=" . $row['questionid'] . " id='Ans4' value='4'>";
          echo "<label for='Ans4'>" . $row['rating_4'] . "</label>";
          echo "<br>";
          echo "<input type='radio' name=" . $row['questionid'] . " id='Ans5' value='5'>";
          echo "<label for='Ans5'>" . $row['rating_5'] . "</label>";
          echo "</td>";
        }

        echo "</tr>";

        echo "</tbody>";
        echo "</table>";
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      ?>
</div>
      <input class="btn button5" type="submit" value="Submit" name="submit" />
    </form>

    <a href="home.php" <input class="btn button4" value="Back" name="submit" />Back</a>
    <span></span>
  </div>
</body>

</html>

