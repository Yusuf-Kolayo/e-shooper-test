<?php session_start();

// establishing a connection to the database in the $connection variable
$connection = mysqli_connect('localhost', 'root', '', 'e_shopper', 3306);

if (isset($_POST['btn_logout'])) {
    // delete all data in the session
    session_destroy();
    // send user to login page
    header('location:login.php');
}



if (count($_SESSION)>0) {
    $user_id = $_SESSION['id'];
}


// initializing the message variable
$msg = '';
