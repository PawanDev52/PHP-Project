<?php
session_start();
include("../common/db.php");

// Handle user signup
if (isset($_POST['signup'])) {
    // Get the form input values
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, address) VALUES (?, ?, ?, ?)");
    
    if ($stmt === false) {
        // If prepare() fails, output the error
        die('Prepare failed: ' . $conn->error);
    }

    // Bind the parameters to the prepared statement
    $stmt->bind_param("ssss", $username, $email, $hashed_password, $address);

    // Execute the statement and check for success
    $result = $stmt->execute();

    if ($result === false) {
        // If execution fails, output the error
        die('Execute failed: ' . $stmt->error);
    }

    // Get the user ID of the newly inserted user
    $user_id = $stmt->insert_id;

    // Check if a user ID was returned, meaning the insertion was successful
    if ($user_id) {
        // Store user information in the session
        $_SESSION["user"] = ["username" => $username, "email" => $email, "user_id" => $user_id];
        
        // Regenerate session ID to prevent session fixation attacks
        session_regenerate_id(true);

        // Redirect the user after successful signup
        header("location: /discuss");
        exit();
    } else {
        // If the insertion failed, display an error message
        echo "New user not registered.";
    }

    // Close the prepared statement
    $stmt->close();

// Handle user login
} else if (isset($_POST['login'])) {
    // Get the login input values
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare a secure query to retrieve the user based on the email
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    
    if ($stmt === false) {
        // If prepare() fails, output the error
        die('Prepare failed: ' . $conn->error);
    }

    // Bind the email parameter to the query
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Get the result of the query
    $result = $stmt->get_result();

    // Check if exactly one user was found with that email
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify the hashed password
        if (password_verify($password, $row['password'])) {
            // Set session variables for the logged-in user
            $_SESSION["user"] = [
                "username" => $row['username'],
                "email" => $email,
                "user_id" => $row['id']
            ];

            // Regenerate session ID for security
            session_regenerate_id(true);

            // Redirect to the discuss page after successful login
            header("location: /discuss");
            exit();
        } else {
            // If password verification fails, display an error
            echo "Invalid email or password.";
        }
    } else {
        // If no user is found or multiple users exist with that email, display an error
        echo "Invalid email or password.";
    }

    // Close the statement after execution
    $stmt->close();

// Handle user logout
} else if (isset($_GET['logout'])) {
    // Unset all session variables
    session_unset();
    
    // Destroy the session completely
    session_destroy();

    // Redirect to the discuss page after logging out
    header("location: /discuss");
    exit();
}
?>