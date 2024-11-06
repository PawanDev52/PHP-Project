<?php
// start session
session_start();

// including db connection
include("../common/db.php");

// signup form
if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    $user = $conn->prepare("Insert into `users`
    (`username`, `email`, `password`, `address`)
    values('$username', '$email', '$password', '$address')
    ");

    $result = $user->execute();

    if ($result) {
        $_SESSION["user"] = ["username"=>$username, "email"=>$email];
        header("location: /phpprojectdiscuss");
    } else {
        echo "new user not registered";
    }
}

?>