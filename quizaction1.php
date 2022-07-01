<!DOCTYPE html>
<html>

<head>
    <meta charset=UTF-8 />

    <title>PHP Quiz</title>

    <link rel='stylesheet' type='text/css' href='style.css'>
</head>

<style>
    body {
        background-color: #F0FFF0;
        color: #8B008B;
        background-image: url('https://img.freepik.com/free-photo/business-partners-handshake-global-corporate-with-technology-concept_53876-102615.jpg?w=1600');
    }
</style>

<body>

    <div id="page-wrap">

        <h1>Result of the Project Complexity and Risk Assessment Tool</h1>

        <?php
        session_start();
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=project', 'root', '');
        $userid = $_SESSION["userid"];
        $uname = $_SESSION["uname"];
        $query = "SELECT projectid FROM addproject WHERE userid = '$userid' ";
        $result = $pdo->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $projectid = $row['projectid'];
        }
        $projectid = $_SESSION["projectid"];
        // Include connection file
        include 'db_connection.php';
        $conn = OpenCon();
        $userid = $_SESSION["userid"];
        //$uname = $_POST["uname"];



        // Attempt select query execution
        $sql = "SELECT * FROM quiz_result where userid =$userid ";
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=project', 'root', '');
        $sum1 = $sum2 = $sum3 = $sum4 = $sum5 = $sum6 = $sum7 = 0;
        $stmt = $pdo->query($sql);
         
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    if ($row['sectionid'] == 1) {
                        $sum1 = $sum1 + $row['quizresult'];
                    } else if ($row['sectionid'] == 2) {
                        $sum2 = $sum2 + $row['quizresult'];
                    } else if ($row['sectionid'] == 3) {
                        $sum3 = $sum3 + $row['quizresult'];
                    } else if ($row['sectionid'] == 4) {
                        $sum4 = $sum4 + $row['quizresult'];
                    } else if ($row['sectionid'] == 5) {
                        $sum5 = $sum5 + $row['quizresult'];
                    } else if ($row['sectionid'] == 6) {
                        $sum6 = $sum6 + $row['quizresult'];
                    } else if ($row['sectionid'] == 7) {
                        $sum7 = $sum7 + $row['quizresult'];
                    }
                }
                $sql2 = "SELECT projectid FROM addproject";
							$stmt2 = $pdo->query($sql2);
								while ( $row = $stmt2->fetch(PDO::FETCH_ASSOC) ) {
									$projectid = $row['projectid'];
                                }
                    $stmt1 = $conn->prepare("INSERT INTO user_result (userid,projectid,result1, result2, result3, result4, result5, result6, result7)
													     VALUES (:userid,:projectid, :result1, :result2, :result3, :result4, :result5, :result6, :result7)");

                    $stmt1->execute(array(
                        ':userid' => $userid,
                        ':projectid' => $projectid,
                        ':result1' => $sum1,
                        ':result2' => $sum2,
                        ':result3' => $sum3,
                        ':result4' => $sum4,
                        ':result5' => $sum5,
                        ':result6' => $sum6,
                        ':result7' => $sum7
                    ));
                    echo "Succesfully registered. ";
                    // echo "Section ID = $sectionid ";
                    echo '<table class="table table-bordered table-striped" border=1>';
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th><div id='section1'>Project Characteristics <th> $sum1/ 25 </div></th></th>";
                    echo "<tr>";
                    echo "<th><div id='section2'>Strategic Management Risks <th> $sum2 / 25 </div></th></th>";
                    echo "<tr>";
                    echo "<th><div id='section3'>Procurement Risks <th> $sum3 / 25 </div></th></th>";
                    echo "<tr>";
                    echo "<th><div id='section4'>Human Resources Risks <th> $sum4 / 25 </div></th></th>";
                    echo "<tr>";
                    echo "<th><div id='section5'>Business Risks <th> $sum5 / 25 </div></th></th>";
                    echo "<tr>";
                    echo "<th><div id='section6'>Project Management Integration Risks <th> $sum6 / 25 </div></th></th>";
                    echo "<tr>";
                    echo "<th><div id='section7'>Project Requirements Risks <th> $sum7 / 25 </div></th></th>";
                    $totalAns = $sum1 + $sum2 + $sum3 + $sum4 + $sum5 + $sum6 + $sum7;
                    echo "<tr>";
                    echo "<th><div id='total'>Total Score <th>  $totalAns/ 175 </div></th></th>";
                    // $stmt1->bindParam(':userid', $userid);
                    // $stmt1->bindParam(':sectionid', $sectionid);
                    // $stmt1->bindParam(':result1', $sum1);
                    // $stmt1->bindParam(':result2', $sum2);
                    // $stmt1->bindParam(':result3', $sum3);
                    // $stmt1->bindParam(':result4', $sum4);
                    // $stmt1->bindParam(':result5', $sum5);
                    // $stmt1->bindParam(':result6', $sum6);
                    // $stmt1->bindParam(':result7', $sum7);
                    // $stmt1->execute();

                // $sectionid =  trim($_GET["sectionid"]);

                // $stmt1 = $conn->prepare("INSERT INTO user_result (userid,sectionid,result1, result2, result3, result4, result5, result6, result7)
                // 									     VALUES (:userid, :sectionid, :result1, :result2, :result3, :result4, :result5, :result6, :result7)");
                // $stmt1->bindParam(':userid', $userid);
                // $stmt1->bindParam(':sectionid', $sectionid);
                // $stmt1->bindParam(':result1', $sum1);
                // $stmt1->bindParam(':result2', $sum2);
                // $stmt1->bindParam(':result3', $sum3);
                // $stmt1->bindParam(':result4', $sum4);
                // $stmt1->bindParam(':result5', $sum5);
                // $stmt1->bindParam(':result6', $sum6);
                // $stmt1->bindParam(':result7', $sum7);
                // $stmt1->execute();

                // echo "Succesfully registered. ";
            
            // echo "<div id='section1'>Project Characteristics = $sum1 / 5 correct</div>";
            // echo "<div id='section2'>Strategic Management Risks = $sum2 / 5 correct</div>";
            // echo "<div id='section3'>Procurement Risks = $sum3 / 5 correct</div>";
            // echo "<div id='section4'>Human Resources Risks = $sum4 / 5 correct</div>";
            // echo "<div id='section5'>Business Risks = $sum5 / 5 correct</div>";
            // echo "<div id='section6'>Project Management Integration Risks = $sum6 / 5 correct</div>";
            // echo "<div id='section7'>Project Requirements Risks = $sum7 / 5 correct</div>";
            // echo "<div id='total'>Total Score = $sum1 + $sum2 + $sum3 + $sum4 + $sum5 + $sum6 +$sum7 / 175 correct</div>";
            echo "</tbody>";
            echo "</table>";
            if($row < 0) {
            echo "Oops! Something went wrong. Please try again later.";
        }

        ?>
        <div class="button">
            <form class="form" method="POST" action="home.php">
                <input type="hidden" name="uname" value="<?php echo $_POST['uname'] ?>">
                <!--	<input type="hidden" name="id" value="<?php //echo $_POST['id'] 
                                                                ?>"> -->
                <!-- <input type="hidden" name="percentage" value="<?php //echo $percent 
                                                                    ?>"> -->
                <input class="btn button3" type="submit" value="Save Attempt" name="save" />
            </form>
            <form class="form" method="GET" action="home.php">
                <input type="hidden" name="name" value="<?php echo $_POST['uname'] ?>">
                <input class="btn button2" type="submit" value="Cancel" name="cancel" />
            </form>
        </div>

    </div>

</body>

</html>