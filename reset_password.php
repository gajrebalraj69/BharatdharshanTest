<?php
include('server.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $newPassword = mysqli_real_escape_string($db, $_POST['newPassword']);
    $confirmPassword = mysqli_real_escape_string($db, $_POST['confirmPassword']);

    // Check if the email exists in the database
    $checkEmailQuery = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($db, $checkEmailQuery);
    if (mysqli_num_rows($result) == 0) {
        echo "<div class='error'>Invalid email. Please enter the email associated with your account.</div>";
    } else {
        // Validate if passwords match
        if ($newPassword !== $confirmPassword) {
            echo "<div class='error'>New password and confirm password do not match.</div>";
        } else {
            // Update the password
            $updateQuery = "UPDATE users SET password='$newPassword' WHERE email='$email'";
            if (mysqli_query($db, $updateQuery)) {
                echo "<div class='success'>Password updated successfully!</div>";
            } else {
                echo "<div class='error'>Error updating password: " . mysqli_error($db) . "</div>";
            }
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Clear errors array on page refresh
    echo "<script>document.getElementById('message').innerHTML = '';</script>";
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reset password</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: black;

    }

    .container {
        width: 50%;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-bottom: 5px;
        color: #333;
    }

    input[type="email"],
    input[type="password"] {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    input[type="submit"] {
        padding: 10px 20px;
        background-color: #0056b3;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #004080;
    }

    a {
        text-align: center;
        color: #0056b3;
        text-decoration: none;
        margin-top: 10px;
        font-size: 14px;
    }

    .error {
    color: #ff0000;
    margin-top: 50px;
    text-align: center;
}


    .success {
        color: #008000;
        margin-top: 10px;
    }
</style>
</head>
<body>
<div class="container">
    <h2>Reset password</h2>
    <form id="passwordForm" method="post" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="newPassword">New Password:</label>
        <input type="password" id="newPassword" name="newPassword" required>
        <label for="confirmPassword">Confirm New Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>
        <input type="submit" value="Change Password">
        <a href="login.php">Back to login</a>
    </form>
    <div id="message" class="error"></div>
</div>
<script>
    // Clear error message when the page loads
    window.onload = function() {
        document.getElementById("message").innerHTML = "";
    };
</script>
</body>
</html>

