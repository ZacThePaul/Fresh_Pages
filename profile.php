<?php
include 'top.php';
include 'db_conn.php';

$uid = mysqli_real_escape_string($conn,$_SESSION['uid']);

$query = mysqli_query($conn, "select * from `entries` where `user_id` = '".$uid."' order by post_id DESC");

?>

<h1>Hello <?php echo $_SESSION['name']?></h1>

<p>Your journal entries</p>


<?php


if (isset($_POST['delete'])){
    $id = mysqli_real_escape_string($conn,$_POST['deleted_id']);
    echo 'holea';
    mysqli_query($conn, "delete from `entries` where `post_id` = '".$id."'");
    header('location:profile.php');
}

while ($row = mysqli_fetch_array($query)) {

    $timestamp = strtotime($row['date']);
    


}