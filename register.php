<!DOCTYPE html>
<html lang="en">

<html>

<head>
  <link rel='stylesheet' type='text/css' href='style.css'>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- <script>
    function goBack() {
      window.location.href = "login.php";
    }
  </script> -->
</head>

<meta charset=utf-8 />
<title>Register</title>

<style>
  /* h1{
  font-family: serif;
  color: #CD5C5C;
}

.header img {
  float: center;
  width: 100px;
  height: 100px;
  background: #FFE4E1;
}

.header h1 {
  position: center;
  top: 20px;
  left: 15px;
}

body{
  background-color: #FFE4E1;
  text-align: center;
  font-family: sans-serif;
  color: #E9967A;
} */
  body {
    background: #007bff;
    background: linear-gradient(to right, #0062E6, #33AEFF);
    background-image: url('https://img.freepik.com/free-photo/business-partners-handshake-global-corporate-with-technology-concept_53876-102615.jpg?w=1600');
    background-color: #F39C12;
  }

  .card-img-left {
    width: 45%;
    /* Link to your background image using in the property below! */
    background: scroll center url('https://images.pexels.com/photos/3194519/pexels-photo-3194519.jpeg?cs=srgb&dl=pexels-canva-studio-3194519.jpg&fm=jpg');
    background-size: cover;
  }

  .btn-login {
    font-size: 0.9rem;
    letter-spacing: 0.05rem;
    padding: 0.75rem 1rem;

    border-color: black;
    background-color: blue;

  }
</style>

<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
          <div class="card-img-left d-none d-md-flex">
            <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Register</h5>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
              <?php
              if (isset($_POST['uname']) && isset($_POST['pw']) && isset($_POST['name']) && isset($_POST['position'])) {
                $uname = $_POST['uname'];
                $pw = $_POST['pw'];
                $name = $_POST['name'];
                $position = $_POST['position'];

                if (strlen($_POST['uname']) < 1 || strlen($_POST['pw']) < 1 || strlen($_POST['name']) < 1 || strlen($_POST['position']) < 1) {
                  $msg = "Forms are required";
                } else {
                  header("Location: registeraction.php");
                  session_start();
                  $_SESSION['name'] = $name;
                  $_SESSION['position'] = $position;
                  $_SESSION['uname'] = $uname;
                  $_SESSION['pw'] = $pw;
                }
                if ($msg !== false) {
                  echo ('<p style="color: #C71585;">' . htmlentities($msg) . "</p>\n");
                }
              }


              ?>
              <div class="form-floating mb-3">
                <p><label for "name">Project Manager Name: <input name="name" type="text" /></label></p>
              </div>
              <div class="form-floating mb-3">
                <p><label for "position">Position: <br><input name="position" type="text" /></label></p>
              </div>
              <div class="form-floating mb-3">
                <p><label for "uname">Username: <br><input name="uname" type="text" /></label></p>
              </div>
              <div class="form-floating mb-3">
                <p><label for "pw">Password: <br><input name="pw" type="password" /></label></p>
              </div>

              <div class="d-grid mb-2">
                <input type="submit" value="Submit" class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" />
              </div>
              <!-- <button type="button" class="btn button3" onclick="goBack()">Back</button> -->
            </form>

            <hr class="my-4">
            <a class="d-block text-center mt-2 small" href="login.php">Have an account? Sign In</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>