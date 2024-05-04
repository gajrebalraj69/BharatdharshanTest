<?php
include ('server.php');

// Initialize $questions variable as an empty array
$questions = array();

// Check if the email is provided in the URL
if (isset($_GET['email'])) {
    $email = mysqli_real_escape_string($db, $_GET['email']);

    // Query to fetch security questions based on the email
    $query = "SELECT security_question FROM users WHERE email='$email'";
    $result = mysqli_query($db, $query);

    // Fetch security questions from the database
    while ($row = mysqli_fetch_assoc($result)) {
        $questions[] = $row['security_question'];
    }
} else {
    // If email is not provided in the URL, redirect back to forgot_password.php
    header('location: forgot_password.php');
    exit();
}

$error = ""; // Initialize error message

// Initialize variable to track whether answers are correct
$answers_correct = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if security question answers are submitted
    if (isset($_POST['security_answer']) && is_array($_POST['security_answer'])) {
        $submitted_answers = $_POST['security_answer'];

        // Check if number of submitted answers matches number of questions
        if (count($submitted_answers) === count($questions)) {
            // Construct the query to fetch correct answers from the database
            $query = "SELECT security_answer FROM users WHERE email='$email'";
            $result = mysqli_query($db, $query);

            // Fetch correct answers from the database
            $correct_answers = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $correct_answers[] = $row['security_answer'];
            }

            // Check if submitted answers match correct answers
            // Check if submitted answers match correct answers
            $correct = true; // Assume answers are correct by default
            foreach ($correct_answers as $index => $correct_answer) {
                if ($submitted_answers[$index] !== $correct_answer) {
                    $correct = false; // If any answer is incorrect, set $correct to false
                    break;
                }
            }

        }

        // If answers are correct, set error message to empty and proceed to the next page
        if ($correct) {
            // $error = "verified"; // Set the error message to "verified"
            header('location: reset_password.php'
        );
            exit();
        } else {
            $error = "<span class='error'>Incorrect answers. Please try again.</span>";
        }
        

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Questions</title>
    <!-- Add your CSS styles here -->
</head>
<style>
    *{
        font-family: Arial, sans-serif;
    }


    .container {
        width: 50%;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    h2 {
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    .input-group {
        margin-bottom: 30px;
    }
    

    input[type="text"],
    select {
        width: 90%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button[type="submit"] {
        display: block;
        width: 40%;
        padding: 10px;
        background-color: #0056b3;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;       
    }

    button[type="submit"]:hover {
        background-color: #4CAF50;
    }
    .error{
        color: red;
    }
</style>

<body>
    <div class="container">
        <h2>Security Questions</h2>
        <p>Please answer the following security questions:</p>
        <form method="post" action="">
            <?php foreach ($questions as $index => $question): ?>
                <div class="form-group">
                    <label>Security Question</label>
                    <select name="security_question[]" required>
                        <option value="">Select a security question</option>
                        <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                        <option value="What is the name of your first pet?">What is the name of your first pet?</option>
                        <option value="What is the name of the city where you were born?">What is the name of the city where
                            you were
                            born?</option>
                        <option value="What is your favorite book?">What is your favorite book?</option>
                        <option value="What is the name of your favorite teacher?">What is the name of your favorite
                            teacher?</option>
                        <option value="What is the make and model of your first car?">What is the make and model of your
                            first car?
                        </option>
                        <option value="What is the name of your childhood best friend?">What is the name of your childhood
                            best
                            friend?</option>
                        <option value="What is the name of the street you grew up on?">What is the name of the street you
                            grew up on?
                        </option>
                        <option value="What is your favorite movie?">What is your favorite movie?</option>
                        <option value="What is the name of your favorite fictional character?">What is the name of your
                            favorite
                            fictional character?</option>
                        <option value="What is the name of your favorite restaurant?">What is the name of your favorite
                            restaurant?
                        </option>
                        <option value="What is the name of your favorite sports team?">What is the name of your favorite
                            sports team?
                        </option>
                    </select>
                </div>
                <div class="input-group">
                    <label>Enter your answer</label><br>
                    <input type="text" name="security_answer[]" required>
                </div>
            <?php endforeach; ?>
            <button type="submit" name="verify_answers" <?php if ($answers_correct)
                echo 'onclick="window.location.href=\'reset_password.php\'"'; ?>>Verify Answers</button>
            <?php if ($error): ?>
                <p><?php echo $error; ?></p>
            <?php endif; ?>

        </form>
    </div>
</body>

</html>