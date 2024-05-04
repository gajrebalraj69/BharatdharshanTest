<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form History</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            color: #333;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        li {
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        li strong {
            color: #555;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #0056b3;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            font-style: italic;
            color: #777;
        }

        .loggedin {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
            color: green;
        }
    </style>

<body>
    <h1>Contact Form History</h1>
    <?php if (isset($_SESSION['submitted_data']) && !empty($_SESSION['submitted_data'])): ?>
        <ul>
            <?php foreach ($_SESSION['submitted_data'] as $submission): ?>
                <li>
                    <strong>Name:</strong> <?php echo $submission['name']; ?><br>
                    <strong>Email:</strong> <?php echo $submission['email']; ?><br>
                    <strong>Phone:</strong> <?php echo $submission['phone']; ?><br>
                    <strong>Packages:</strong> <?php echo $submission['packages']; ?><br>
                    <strong>Message:</strong> <?php echo $submission['message']; ?><br>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No forms have been submitted yet.</p>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
        <p>User is logged in.</p>
    <?php else: ?>
    
    <?php endif; ?>

    <a href="index.php#contact">Back to Contact Form</a>
</body>

</html>
