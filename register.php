<?php
include 'top.php';
include 'db_conn.php';

if (isset($_POST['submit'])) {

    $fname = mysqli_real_escape_string($conn, $_POST['first_name']);
    $lname = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm = $_POST['confirm_pass'];


    if (!empty($fname) && !empty($lname) && !empty($email) && !empty($pass)) {
        if ($confirm === $pass) {
            mysqli_query($conn, "insert into `users` (first_name, last_name, email, password) values ('".$fname."', '".$lname."', '".$email."', '".$pass."')");
            echo 'much success';
            echo $conn->error;
        }
        else {
            echo 'WRONG';
        }

    }

}

?>

<h1>Register your FreshPages account</h1>

<form method='post'>
    <ul>
        <li>
            <input type='text' name='first_name' placeholder='first name'>
        </li>
        <li>
            <input type='text' name='last_name' placeholder='last name'>
        </li>
        <li>
            <input type='text' name='email' placeholder='email'>
        </li>
        <li>
            <input type='password' name='password' placeholder='password'>
        </li>
        <li>
            <input type='password' name='confirm_pass' placeholder='confirm password'>
        </li>
        <li>
            <input type='submit' name='submit'>
        </li>
    </ul>
</form>


