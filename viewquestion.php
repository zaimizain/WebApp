<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* .wrapper {
            width: 100%;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 120px;
        } */
        body {
            background-image: url('https://img.freepik.com/free-photo/business-partners-handshake-global-corporate-with-technology-concept_53876-102615.jpg?w=1600');
            background-color: #F39C12;
            

        }
        .wrapper{
            width: 100%;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
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
            box-shadow: 5px 10px 18px #888888;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <div class="table">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">List of Question</h2>
                        <a href="addquestion.php" class="btn btn-secondary pull-right"><i class="fa fa-plus"></i> Add New Question</a>
                    </div>
                    <div class="text-block">
                    <?php
                    // Include connection file
                    include 'db_connection.php';
                    $conn = OpenCon();
                  
                    // Attempt select query execution
                    $sql = "SELECT * FROM question";
                    $pdo=new PDO('mysql:host=localhost;port=3306;dbname=project','root', '');

                    if ($stmt = $pdo->query("SELECT * FROM question")) {
                        
                        echo '<table class="table">';
                        echo '<thead class="thead-dark">';
                        echo "<tr>";
                        echo "<th>No.</th>";
                        echo "<th>Question</th>";
                        echo "<th> Area </th>";
                        echo "<th>Action</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . $row['questionid'] . "</td>";
                            echo "<td>" . $row['questionname'] . "</td>";
                            echo "<td>" . $row['area'] . "</td>";
                           
                            echo "<td>";
                            echo '<a href="updquestion.php?questionid=' . $row['questionid'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                            echo '<a href="delquestion.php?questionid=' . $row['questionid'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    ?>
                    </div>
                    <br>
                    <form method="post">
                        <a href="adminhome.php" input type="submit" name="back" value="back" class="btn btn-secondary pull-right">Back</a>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>