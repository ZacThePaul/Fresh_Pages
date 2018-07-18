<?php
session_start();
include 'db_conn.php';

$pid = mysqli_real_escape_string($conn,$_GET['pid']);

if (isset($_POST['delete'])){
    $id = mysqli_real_escape_string($conn,$_POST['deleted_id']);
    echo 'holea';
    mysqli_query($conn, "delete from `entries` where `post_id` = '".$id."'");
    header('location:profile.php');
}

$query = mysqli_query($conn, "select * from `entries` where `post_id` = '".$pid."'");

$row = mysqli_fetch_array($query);

// echo "<h3>".$row['title']."</h3>";
// echo "<p class='pretty'>".$row['body']."</p>";
// echo "<p>".date("F dS, Y", strtotime($row['date']))."</p>";
// echo "<form method='POST'>";
// echo "<input type='submit' name='delete' value='delete post'>";
// echo "<input type='hidden' name='deleted_id' value='".$row['post_id']."'>";
// echo "<a href='editpost.php?pid=".$row['post_id']."'>edit post</a>";
// echo "</form>";
// echo "<hr>";

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
    <header class="masthead" style="background-image: url('https://cauldronsandcupcakes.files.wordpress.com/2012/03/journal.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-heading">
              <h1><?php echo $row['title']; ?></h1>
              <span class="meta">on <?php echo date("F dS, Y", strtotime($row['date'])); ?></span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Post Content -->
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
              <?php echo $row['body']; ?>
        </div>
      </div>
    </article>

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
