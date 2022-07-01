<!DOCTYPE html>

<head>
  <meta charset=UTF-8 />
  <title>SSE3150 Quiz</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<style>
  body {
    background: #007bff;
    background: linear-gradient(to right, #0062E6, #33AEFF);
    background-image: url('https://img.freepik.com/free-photo/business-partners-handshake-global-corporate-with-technology-concept_53876-102615.jpg?w=1600');
    background-color: #F39C12;
  }

  .card-img-left {
    width: 45%;
    /* Link to your background image using in the property below! */
    background: scroll center url('https://www.wallpaperuse.com/wallp/42-427302_m.jpg');
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
            <h3 class="card-title text-center mb-5 fw-light fs-5">Add Your Project Detail</h3>
            <div id="page-wrap">
              <form id="myForm" method="POST" action="addprojectaction.php">
                
              <input type="hidden" name="uname" value="<?php echo $_REQUEST['name'] ?>">
                <input type="hidden" name="userid" value="<?php echo $_REQUEST['userid'] ?>"> 

                <div class="form-floating mb-3">
                <p><label for="projectName">Project Name:</label>
                <br><input type="text" name="projectname" id="projectName" class="form-control">
                </p>
                </div>

                <div class="form-floating mb-3">
                <p><label for="Owner">Owner:</label>
                <br> <input type="text" name="owner" id="Owner" class="form-control">
                </p>
                </div>

                <div class="form-floating mb-3">
                <p><label for="Financial">Financial:</label>
                <br><input type="text" name="financial" id="Financial" class="form-control">
                </p>
                </div>

                <div class="form-floating mb-3">
                <p><label for="Duration">Project Duration:</label>
                <br><input type="text" name="duration" id="Duration" class="form-control">
                </p>
                </div>

                <p><label for="Mode">Mode:</label>
                <br><input type="text" name="mode" id="Mode" class="form-control">
                </p>
                </div>

                <div class="form-floating mb-3">
                <br><input class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit" value="Submit" name="submit" />
                </div>
              </form>
              <a href="home.php" <input class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" value="Back" name="submit" />Back</a>
              </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>