<?php
include 'db_connection.php';
// Demand a GET parameter
$conn = OpenCon();

if (isset($_POST['logout'])) {
    header('Location: adminlogin.php');
    return;
}
$fault = false;
if (isset($_POST['area']) && isset($_POST['questionname'])) {
    if (strlen($_POST['area']) < 1) {
        $fault = 'Knowledge area is required';
    } else if (strlen($_POST['questionname']) < 1) {
        $fault = 'Question is required';
    } else {
        $fault = "yes";
        $sql = "INSERT INTO question (area, questionname, sectionid) VALUES (:area,:questionname, :sectionid)";

        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':area' => $_POST['area'],
            ':questionname' => $_POST['questionname'],
            ':sectionid' => $_POST['sectionid']
        ));

        $sql1 = "INSERT INTO answer (sectionid, questionid, rating_1, rating_2, rating_3,  rating_4, rating_5) VALUES (:sectionid, (SELECT questionid from question where questionname = :questionname), :rating_1, :rating_2, :rating_3, :rating_4, :rating_5)";

        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute(array(
            ':questionname' => $_POST['questionname'],
            ':sectionid' => $_POST['sectionid'],
            ':rating_1' => $_POST['rating_1'],
            ':rating_2' => $_POST['rating_2'],
            ':rating_3' => $_POST['rating_3'],
            ':rating_4' => $_POST['rating_4'],
            ':rating_5' => $_POST['rating_5']
        ));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Question</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://img.freepik.com/free-photo/business-partners-handshake-global-corporate-with-technology-concept_53876-102615.jpg?w=1600');
            background-color: #F39C12;

        }


        input[type=text] {
            background-color: white;
            color: black;
            border: 1px solid;
        }

        h1 {
            color: green;
        }

        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            -ms-appearance: none;
            appearance: none;
            outline: 0;
            background: #9FD4E1;
            border: 2px solid black;
        }

        .select {
            position: relative;
            display: block;
            width: 20em;
            height: 3em;
            line-height: 3;
            background: #9FD4E1;
            overflow: hidden;
            border-radius: .25em;
        }

        select {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0 0 0 .5em;
            color: black;
            cursor: pointer;
        }

        select::-ms-expand {
            display: none;
        }

        .select::after {
            content: '\25BC';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            padding: 0 1em;
            background: #34495E;
            pointer-events: none;
        }

        .select:hover::after {
            color: #F39C12;
        }

        .container {
            position: relative;
            width: 70%;
        }

        .container .btn {
            position: right;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            background-color: #f1f1f1;
            color: black;
            font-size: 2px;
            padding: 3px 3px;
            padding-right: 30px;
            border: none;
            cursor: pointer;
            border-radius: 7px;
            text-align: center;
        }

        .container .btn:hover {
            background-color: black;
            color: white;
        }

        .center {
            position: absolute;
            top: 50%;
            width: 100%;
            text-align: center;
            font-size: 18px;
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

        .try {

            bottom: 0px;
            right: 0px;
            padding-left: 36%;

        }
    </style>
</head>

<body>
    <?php
    if ($fault === false) {
    } else if ($fault === 'yes') {
        echo ('<p style="color: green;">' . 'Record inserted' . "</p>\n");
    } else {
        echo ('<p style="color: red;">' . htmlentities($fault) . "</p>\n");
    }
    ?>
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Question</h2>
                    <div class="text-block">
                        <p>Please fill this form and submit to add employee record to the database.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label>Knowledge Area</label>
                                <input type="text" style="width:100%" name="area" value="" class="form-control">
                                <label>Question</label>
                                <input type="text" name="questionname" value="" class="form-control"><br>
                                <label for="sectionid">Section ID</label>
                                <div class="select">
                                    <select name="sectionid" style="width:100%">
                                        <option value="-1"> </option>
                                        <option value="1">1-Project Characteristics</option>
                                        <option value="2">2-Strategic Management</option>
                                        <option value="3">3-Procurement Risks</option>
                                        <option value="4">4-Human Resource Risks</option>
                                        <option value="5">5-Business Risks</option>
                                        <option value="6">6-Project Management Integration Risks</option>
                                        <option value="7">7-Project Requirements Risks</option>
                                    </select>
                                </div>
                                <br>
                                <label>Answer:</label>
                                <input type="text" name="rating_1" value="" class="form-control"><br>
                                <input type="text" name="rating_2" value="" class="form-control"><br>
                                <input type="text" name="rating_3" value="" class="form-control"><br>
                                <input type="text" name="rating_4" value="" class="form-control"><br>
                                <input type="text" name="rating_5" value="" class="form-control"><br>

                            </div>
                    

                            <button type="submit" value="Submit">Add</button>
                            
                        </form>
                    <br>
                    <a href="viewquestion.php"><button position="absolute" left="50%">Back</button></a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</body>

</html>