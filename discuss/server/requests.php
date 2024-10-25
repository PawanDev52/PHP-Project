<?php
session_start();
include("../common/db.php");

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, address) VALUES (?, ?, ?, ?)");
    
    if ($stmt === false) {
        // Check if prepare() failed
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("ssss", $username, $email, $hashed_password, $address);

    // Execute the statement
    $result = $stmt->execute();

    if ($result === false) {
        // If execution fails, show an error
        die('Execute failed: ' . $stmt->error);
    }

    // Check if the insert was successful and retrieve the inserted ID
    $user_id = $stmt->insert_id;

    if ($user_id) {
        // Successfully inserted
        $_SESSION["user"] = ["username" => $username, "email" => $email, "user_id" => $user_id];
        header("location: /discuss");
        exit();
    } else {
        echo "New user not registered.";
    }

    // Close the statement
    $stmt->close();

} else if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare a secure query
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify the hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION["user"] = [
                "username" => $row['username'],
                "email" => $email,
                "user_id" => $row['id']
            ];
            session_regenerate_id(true);  // Regenerate session ID on login
            header("location: /discuss");
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }

    // Close the statement
    $stmt->close();
    
} else if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("location: /discuss");
    exit();
}
?>