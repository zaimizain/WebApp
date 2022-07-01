<?php
// Process delete operation after confirmation
if(isset($_POST["questionid"]) && !empty($_POST["questionid"])){
    // Include config file
    require_once "db_connection.php";
    $conn = OpenCon();
    // Prepare a delete statement
    $sqlans = "DELETE FROM answer WHERE questionid = (:questionid)";
    $sql = "DELETE FROM question WHERE questionid = (:questionid)";
    
    if($stmt = $conn->prepare($sqlans)){
        $stmt->execute(array(':questionid' => $_POST['questionid']));
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            //mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            //$param_id = trim($_POST["id"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute(array(':questionid' => $_POST['questionid']))){
                // Records deleted successfully. Redirect to landing page
                header("location: viewquestion.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        //mysqli_stmt_close($stmt);
        
        // Close connection
        $conn = NULL;
    }
    
} else{
    // Check existence of id parameter
    /*if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }*/
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Question</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Delete Question</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="questionid" value="<?php echo trim($_GET["questionid"]); ?>"/>
                            <p>Are you sure you want to delete this question?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="viewquestion.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>