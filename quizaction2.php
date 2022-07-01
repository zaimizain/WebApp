<?php
$userid = $_REQUEST["userid"];
$projectid = $_REQUEST["projectid"];
$uname = $_POST["uname"];
$quizresult = $_POST["quizresult"];
$questionid = $_POST["questionid"];
$sectionid = $_POST["sectionid"];

include 'db_connection.php';
$conn = OpenCon();
// $pdo=new PDO('mysql:host=localhost;port=3306;dbname=project',
//      'root', '1234');
$stmt = $conn->prepare("INSERT INTO quiz_result (userid,quizresult,questionid,sectionid,projectid)
     VALUES (:userid, :quizresult, :questionid, :sectionid, :projectid)");
$stmt->bindParam(':userid', $userid);
$stmt->bindParam(':quizresult', $quizresult);
$stmt->bindParam(':questionid', $questionid);
$stmt->bindParam(':sectionid', $sectionid);
$stmt->bindParam(':projectid', $projectid);
$stmt->execute();

echo "Succesfully registered. ";
// Please head to <a href='home.php?name=$uname'>Home</a> or <a href='login.php'>Logout</a>
?>
<?php
function custom_scripts()
{

}
?>

<html>
   <head>
      <title>Save Result</title>
      <script type = "text/javascript"
         src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>

      <script type = "text/javascript" language = "javascript">
        $(document).ready(function(){
          setTimeout(function() {
           window.location.href = "home.php?name=<?php echo $uname ?>"
          }, 3000);
        });
      </script>
   </head>

   <style>
   body{
     background-color: #F0FFF0;
   	 color: #8B008B;
     text-align: center;
     font-family: serif;
   }
   </style>
   <body>
      <p>Redirecting to Home in 3 seconds. </p>
      <p>Click <a href='home.php?name=$uname'>here</a> if you are not redirected. </p>

   </body>
</html>