<?php
// Include config file
require_once "db_connection.php";
//session_start();

// Define variables and initialize with empty values
$questionid = $sectionid = $questionname = $area = "";
$questionid_err = $sectionid_err = $questionname_err = $area_err = "";
$conn = OpenCon();
//$userID = $_SESSION['userID'];
// Processing form data when form is submitted
if (isset($_POST['questionid']) && !empty($_POST['questionid'])) {
    $questionid = $_POST['questionid'];
    $sectionid = $_POST['sectionid'];
    $area = $_POST['area'];
    $questionname = $_POST['questionname'];
    //echo $questionid.$criteria.$question;

    // Validate sectionid
    $input_sectionid = trim($sectionid);
    if (empty($input_criteria)) {
        $criteria_err = "Please enter a criteria.";
    } else {
        $criteria = $input_criteria;
    }

    // Validate area
    $input_area = trim($area);
    if (empty($input_area)) {
        $area_err = "Please enter knowledge area.";
    } else {
        $area = $input_area;
    }

    // Validate question
    $input_questionname = trim($questionname);
    if (empty($input_questionname)) {
        // echo $input_category;
        $questionname_err = "Please enter a question.";
    }else {
        $questionname = $input_questionname;
    }

    

    // Check input errors before inserting in database
    if (empty($questionid_err) && empty($sectionid_err) && empty($area_err) && empty($questionname_err)) {
        // Prepare an update statement
        $sql = "UPDATE question SET questionid=:questionid, sectionid=:sectionid, area=:area, questionname=:questionname WHERE questionid=:questionid";
       

        if ($stmt = $conn->prepare($sql)) {
            // Set parameters
            $param_questionid = $questionid;
            $param_sectionid = $sectionid;
            $param_area = $area;
            $param_questionname = $questionname;

            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":questionid", $param_questionid);
            $stmt->bindParam(":sectionid", $param_sectionid);
            $stmt->bindParam(":area", $param_area);
            $stmt->bindParam(":questionname", $param_questionname);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                header("location: viewquestion.php");
                exit();
             //echo $questionid.$criteria.$question;
             //  echo "Oops! Something went wrong. Please try again later.";
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($conn);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["questionid"]) && !empty(trim($_GET["questionid"]))) {
        // Get URL parameter
        $questionid =  trim($_GET["questionid"]);

        // Prepare a select statement
        $sql = "SELECT * FROM question WHERE questionid = :questionid";
        if ($stmt = $conn->prepare($sql)) {
            // Set parameters
            $param_questionid = $questionid;
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":questionid", $param_questionid);

            // Set parameters
            $param_questionid = $questionid;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Retrieve individual field value
                    $questionid = $row["questionid"];
                    $sectionid = $row["sectionid"];
                    $area = $row["area"];
                    $questionname = $row["questionname"];
                    
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);

        // Close connection
        unset($conn);
    } //else {
    //     // URL doesn't contain id parameter. Redirect to error page
    //     header("location: error.php");
    //     exit();
    // }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Question</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
        body {
  background-image: url('3.png');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
            <div style="background-color:blue; padding: 20px; background: rgba(202, 222, 238, 0.6)" >
                <div class="col-md-12">
                    <h2 class="mt-5">Update Question</h2>
                    <p>Please edit the input values and submit to update the question.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        
                        <!-- <div class="form-group">
                            <label>Question ID</label>
                            <input type="text" name="questionid" class="form-control <?php echo (!empty($questionid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $questionid; ?>">
                            <span class="invalid-feedback"><?php echo $questionid_err; ?></span>
                        </div> -->
                        <div class="form-group">
                            <label>Knowledge Area</label>
                            <input type="text" name="area" class="form-control <?php echo (!empty($area_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $area; ?>">
                            <span class="invalid-feedback"><?php echo $area_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Question</label>
                            <input type="text" name="questionname" class="form-control <?php echo (!empty($questionname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $questionname; ?>">
                            <span class="invalid-feedback"><?php echo $questionname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Section ID</label><br>
                            <select name="sectionid" style=padding:6px; required>
                            <option value="<?php echo $sectionid; ?>"><?php echo $sectionid; ?></option>
                                <option value="-1"> </option>
                                <option value="1">1-Project Characteristics</option>
                                <option value="2">2-Strategic Management</option>
                                <option value="3">3-Procurement Risks</option>
                                <option value="4">4-Human Resource Risks</option>
                                <option value="5">5-Business Risks</option>
                                <option value="6">6-Project Management Integration Risks</option>
                                <option value="7">7-Project Requirements Risks</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $area_err; ?></span>
                        </div>
                        
                        <input type="hidden" name="questionid" value="<?php echo $questionid; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="viewquestion.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>