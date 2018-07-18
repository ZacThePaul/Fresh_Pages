<?php
session_start();
include 'top.php';
include 'db_conn.php';

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

    if (!empty($email) && !empty($pass)) {

        $query = mysqli_query($conn, "select * from `users` where `email` = '".$email."' and `password` = '".$pass."'");
        // $upass = mysqli_query($conn, "select * from `users` where `password` = '".$pass."'");

        $row_query = mysqli_num_rows($query);
        $row = mysqli_fetch_row($query);

        echo $row;
        

        if ($row_query > 0) {
            $_SESSION['name'] = $row[1];
            $_SESSION['email'] = $row[3];
            $_SESSION['uid'] = $row[0];
            
            header('location:index.php');

        };

    };
};

?>

<h1>Login to your FreshPages account</h1>

<form method='post' class='login'>
    <ul>
        <li>
            <input type='text' name='email' placeholder='email'>
        </li>
        <li>
            <input type='password' name='pass' placeholder='password'>
        </li>
        <li>
            <input type='submit' name='submit'>
        </li>
    </ul>
</form>
