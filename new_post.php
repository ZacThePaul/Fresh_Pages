<?php

session_start();
require 'db_conn.php';

if (isset($_POST['submit'])) {
  
    $body = !empty($_POST['body']) ? trim($_POST['body']) : null;
    $title = !empty($_POST['title']) ? trim($_POST['title']) : null;
    $uid = !empty($_SESSION['uid']) ? trim($_SESSION['uid']) : null;
        
    $sql = "INSERT INTO `entries` (title, body, user_id) VALUES (:title, :body, :user_id)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':title', $title);
    $stmt->bindValue('body', $body);
    $stmt->bindValue(':user_id', $uid);

    $result = $stmt->execute();

    header('location:index.php');
    }


?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FreshPages - Inutuitive Journaling</title>

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

  <?php include 'top.php'; ?>
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('img/home-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading py-3">
              <h1>New post</h1>
              <hr>
              <form method='POST'>
              <input type="text" name="title" class="form-control mb-3" placeholder="Post title">
              <textarea name="body" class="form-control" id="" cols="30" rows="10" placeholder="Tell 'em how you really feel"></textarea>
              <input type="submit" name="submit" class="btn btn-primary mt-4 d-block mx-auto" value="Save">
            </form>
            </div>
          </div>
        </div>
      </div>
    </header>


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
            <p class="copyright text-muted">Copyright &copy; FreshPages <?php echo date('Y');?></p>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/clean-blog.min.js"></script>

  </body>

</html>

