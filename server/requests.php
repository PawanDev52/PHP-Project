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
    $user->insert_id;

    if ($result) {
        $_SESSION["user"] = ["username" => $username, "email" => $email, "user_id" => $user->insert_id];
        header("location: /phpprojectdiscuss");
    } else {
        echo "new user not registered";
    }
} else if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = "";
    $user_id = 0;

    $query = "select * from users where email='$email' and password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        foreach ($result as $row) {
            $username = $row['username'];
            $user_id = $row['id'];
        }
        $_SESSION["user"] = ["username" => $username, "email" => $email, "password" => $password, "user_id" => $user_id];
        header("location: /phpprojectdiscuss");
    } else {
        echo "user not logged in";
    }
} else if (isset($_GET['logout'])) {
    session_unset();
    header("location: /phpprojectdiscuss");
} else if (isset($_POST['ask'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category'];
    $user_id = $_SESSION['user']['user_id'];

    $question = $conn->prepare("Insert into `questions`
    (`title`, `description`, `category_id`, `user_id`)
    values('$title', '$description', '$category_id', '$user_id')
    ");

    $result = $question->execute();
    $question->insert_id;
    if ($result) {
        header("location: /phpprojectdiscuss");
    } else {
        echo "Question not added";
    }
}
?>