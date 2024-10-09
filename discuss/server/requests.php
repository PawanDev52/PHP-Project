<?php
// signup form 
include("../common/db.php");

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    $user = $conn->prepare("Insert into `users` 
    (`id`, `username`, `email`, `password`, `address`)
    value(Null, '$username', '$email', '$password', '$address')
    ");

    $result = $user->execute();

    if($result){
        echo "new user registered";
    } else{
        echo "new user not registered";
    }

}
?>