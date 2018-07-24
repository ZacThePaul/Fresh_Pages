<?php
session_start();

require 'db_conn.php';

if (isset($_POST['submit'])) {

  $first_name = !empty($_POST['first_name']) ? trim($_POST['first_name']) : null;
  $last_name = !empty($_POST['last_name']) ? trim($_POST['last_name']) : null;
  $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
  $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
  $confirm = !empty($_POST['confirm_pass']) ? trim($_POST['confirm_pass']) : null;


    $sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided username to our prepared statement.
    $stmt->bindValue(':email', $email);
      
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // print_r($row);die();
      if ($row['num'] > 0 ){
          die("That email is already in use. Please use another.");
          }
      else {

              $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
  
              //Prepare our INSERT statement.
              //Remember: We are inserting a new row into our users table.
              $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)";
              $stmt = $pdo->prepare($sql);
              
              //Bind our variables.
              $stmt->bindValue(':first_name', $first_name);
              $stmt->bindValue('last_name', $last_name);
              $stmt->bindValue(':email', $email);
              $stmt->bindValue(':password', $passwordHash);
          
              //Execute the statement and insert the new account.
              $result = $stmt->execute();
              
              //If the signup process is successful.
              if($result){
                  //What you do here is up to you!
                  echo 'Thank you for registering with our website.';
              }
              else {
                echo "what are you a fucking idiot? You can\'t register for a fucking website properly?";
              }
      }
  }
 

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register - FreshPages</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/clean-blog.min.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="index.html">FreshPages</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('https://www.theorganicprepper.com/wp-content/uploads/2014/06/The-Austerity-Diaries.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="page-heading">
              <h1>Register</h1>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <form name="sentMessage" method="post" novalidate>
            <div class ="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>First Name</label>
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" required data-validation-required-message="Please enter your first name.">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class ="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Last Name</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required data-validation-required-message="Please enter your last name.">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required data-validation-required-message="Please enter your email address.">
                        <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required data-validation-required-message="Please enter your preferred password.">
                        <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Confirm Password</label>
                        <input type="password" name="confirm_pass" class="form-control" placeholder="Confirm Password" required data-validation-required-message="Please confirm your password.">
                        <p class="help-block text-danger"></p>
                </div>
            </div>
            <br>
            <div id="success"></div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary" id="sendMessageButton">Register</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <hr>
    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <ul class="list-inline text-center">
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
            </ul>
            <p class="copyright text-muted">Copyright &copy; Your Website 2018</p>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/clean-blog.min.js"></script>

  </body>

</html>



