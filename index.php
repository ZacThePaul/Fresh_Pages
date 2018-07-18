<?php
// include 'top.php';
session_start();
include 'db_conn.php';
// if(!isset($_SESSION['name'])) {
//   header("Location: http://localhost/fresh-pages/views/index.php");
//   die();
// }

if (isset($_SESSION['name'])) {

  $uid = mysqli_real_escape_string($conn, $_SESSION['uid']);
  $query = mysqli_query($conn, "select * from `entries` where `user_id` = '".$uid."' order by post_id DESC");
}

if (isset($_POST['delete'])){
    $id = mysqli_real_escape_string($conn,$_POST['deleted_id']);
    mysqli_query($conn, "delete from `entries` where `post_id` = '".$id."'");
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
    <link href="css/clean-blog.css" rel="stylesheet">

  </head>

  <body>

  <?php include 'top.php'; ?>

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('img/home-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>Fresh Pages</h1>
              <span class="subheading">A no frills journal option</span>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- //http://getbootstrap.com/docs/4.1/components/ -->
    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-10 mx-auto">
          <?php 
          if (isset($_SESSION['name'])) {
            while ($row = mysqli_fetch_array($query)) {     $timestamp = strtotime($row['date']); ?>
              <div class="post-preview">
                <a href="viewpost.php?pid=<?php echo $row['post_id']; ?>">
                  <h1 class="post-title">
                    <?php echo $row['title']; ?>
                  </h1>
                </a>
                <div>
                  <a href="editpost.php?pid=<?php echo $row['post_id']; ?>" class="d-inline-block btn btn-primary btn">Edit</a>
                  <form method ="post" class="d-inline-block">
                    <input type="submit" name="delete" value="Delete Post" class="d-inline-block btn btn-danger btn">
                    <input type="hidden" name="deleted_id" value="<?php echo $row['post_id']; ?> ">
                  </form>
                </div>
                <p class="post-meta">on <?php echo date("F dS, Y", strtotime($row['date'])); ?></p>
              </div>
              <hr>  
         <?php } 
          
          } ?>
          
          <!-- Pager -->
          <div class="clearfix">
            <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
          </div>
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
