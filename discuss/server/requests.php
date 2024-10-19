<?php
// signup form 
session_start();

include("../common/db.php");

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    $user = $conn->prepare("Insert into `users` 
    (`id`, `username`, `email`, `password`, `address`)
    values(Null, '$username', '$email', '$password', '$address')
    ");

    $result = $user->execute();

    if ($result) {
        $_SESSION["user"] = ["username"=>$username, "email"=>$email];
        header("location: /phpprojects/discuss");
    } else {
        echo "new user not registered";
    }
} else if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "select * from users where email='$email' and password='$password'";
    $result = $conn->query($query);
    if ($result->num_rows==1) {
        $_SESSION["user"] = ["username" => $username, "email"=> $email];
        header("location: /phpprojects/discuss");
    } else{
        
    }
}
?>