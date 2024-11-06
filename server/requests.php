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
        $_SESSION["user"] = ["username" => $username, "email" => $email];
        header("location: /phpprojectdiscuss");
    } else {
        echo "new user not registered";
    }
} else if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = "";
    $query = "select * from users where email='$email' and password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        foreach ($result as $row) {
            // print_r($row);
            $username = $row['username'];
        }
        $_SESSION["user"] = ["username" => $username, "email" => $email, "password" => $password];
        header("location: /phpprojectdiscuss");
    } else {
        echo "user not logged in";
    }
}
?>