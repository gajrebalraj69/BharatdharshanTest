<?php include ('server.php') ?>
<!DOCTYPE html>
<html>

<head>
  <title>Register Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('image/adventure/login_page.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      background-color: rgba(255, 255, 255, 0.2);
    }

    .container {
      width: 400px;
      margin: 120px auto 0 auto;
      margin-right: 230px;
      border: 2px solid black;
      padding: 25px;
      border-radius: 5px;
      background-color: rgba(0, 0, 0, 0.2);
    }

    .header {
      text-align: center;
    }

    .input-group {
      margin-bottom: 5px;
      background-color: transparent;
      
    }

    .input-group label {
      display: block;
      margin-bottom: 5px;
      color: whitesmoke;
    }

    .input-group input {
      width: 90%;
      height: 30px;
      padding: 5px;
      border-radius: 3px;
      border: 1px solid;
      background-color: transparent;
      font-size: larger;
      color: black;
    }

    .input-group select {
      width: 93%;
      height: 30px;
      padding: 5px;
      border-radius: 3px;
      border: 1px solid;
      background-color: transparent;
      font-size: 15px;
      color: whitesmoke;
    }

    .input-group option {
      background-color: whitesmoke;
      color: black;
    }

    .input-group h2 {
      color: black;
    }

    .btn {
      width: 40%;
      padding: 10px;
      border: 1px solid black;
      background-color: whitesmoke;
      color: black;
      border-radius: 3px;
      cursor: pointer;
      margin-top: 35px;
      text-align: center;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    .btn:hover {
      background-color: #0056b3;
    }

    .footer {
      text-align: center;
      margin-top: 20px;
    }

    .member {
      margin: 35px auto;
      color: whitesmoke;
      text-align: center;
    }

    .link {
      color: whitesmoke;
    }

    .main {
      position: absolute;
      top: -10px;
      right: 270px;
      margin: 60px auto 0 auto;
    }

    /* Style for input group */
    .input-group {
        position: relative;
        margin-bottom: 0px;
    }
    /* Style for the checkbox */
    #showPasswordCheckbox {
        transform: scale(0.4); /* Adjust the scale to make the checkbox smaller */
        margin-right: 10px; /* Add some margin to separate checkbox from label */
        right: 10px;
        top: 10px;
        
    }
    
  </style>
</head>

<body>
  <h1 class="main">welcome to Bharatdarshan </h1>
  <div class="container">
    <div class="header">
      <h2>Register Page</h2>
    </div>
    <form method="post" action="register.php">
      <?php include ('errors.php'); ?>
      <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" id="username" required>
        <span id="usernameError" style="color: red;"></span>
      </div>
      <div class="input-group">
    <label>Email</label>
    <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
    <span id="emailError" style="color: red;"></span>
</div>
<div class="input-group">
    <label>Password</label>
    <input type="password" name="password" id="password" required>
    <input type="checkbox" id="showPasswordCheckbox">
    <label for="showPasswordCheckbox"></label>
    <span id="passwordError" style="color: red;"></span>
</div>
      <div class="input-group">
        <label>Security Question</label>
        <select name="security_question" required class="transparent-bg>
          <option value=">Select a security question</option>
          <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
          <option value="What is the name of your first pet?">What is the name of your first pet?</option>
          <option value="What is the name of the city where you were born?">What is the name of the city where you were
            born?</option>
          <option value="What is your favorite book?">What is your favorite book?</option>
          <option value="What is the name of your favorite teacher?">What is the name of your favorite teacher?</option>
          <option value="What is the make and model of your first car?">What is the make and model of your first car?
          </option>
          <option value="What is the name of your childhood best friend?">What is the name of your childhood best
            friend?</option>
          <option value="What is the name of the street you grew up on?">What is the name of the street you grew up on?
          </option>
          <option value="What is your favorite movie?">What is your favorite movie?</option>
          <option value="What is the name of your favorite fictional character?">What is the name of your favorite
            fictional character?</option>
          <option value="What is the name of your favorite restaurant?">What is the name of your favorite restaurant?
          </option>
          <option value="What is the name of your favorite sports team?">What is the name of your favorite sports team?
          </option>

        </select>
      </div>
      <div class="input-group">
        <label>Answer</label>
        <input type="text" name="security_answer" required>
      </div>
      <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Register</button>
      </div>
      <p class="member">Already a member? <a class="link" href="login.php">Login</a></p>
    </form>

</body>
<script>


    // Function to validate username input
    function validateUsername() {
        var usernameInput = document.getElementById('username').value;
        var usernameRegex = /^[a-zA-Z0-9_]*$/; // Regular expression to allow letters, numbers, and underscore

        if (!usernameRegex.test(usernameInput)) {
            document.getElementById('usernameError').innerText = "special characters are not allowed.";
            return false;
        } else {
            document.getElementById('usernameError').innerText = "";
            return true;
        }
    }
// Event listener to validate input on change
    document.getElementById('username').addEventListener('input', validateUsername);

    // Function to validate email input  Email
    function validateEmail() {
        var emailInput = document.getElementById('email').value;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(emailInput)) {
            document.getElementById('emailError').innerText = "Email should not contain special characters except '@' and should not have spaces.";
            return false;
        } else {
            document.getElementById('emailError').innerText = "";
            return true;
        }
    }

    // Function to toggle password visibility
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById('password');
        var showPasswordCheckbox = document.getElementById('showPasswordCheckbox');

        if (showPasswordCheckbox.checked) {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }

    // Event listener to toggle password visibility
    document.getElementById('showPasswordCheckbox').addEventListener('change', togglePasswordVisibility);

    // Event listener to validate input on change
    document.getElementById('email').addEventListener('input', validateEmail);

    
    
    // Function to validate password input
    function validatePassword() {
        var passwordInput = document.getElementById('password').value;
        var passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]*$/;

        if (!passwordRegex.test(passwordInput)) {
            document.getElementById('passwordError').innerText = "Password must contain at least one special character and one number.";
            return false;
        } else {
            document.getElementById('passwordError').innerText = "";
            return true;
        }
    }
// Event listener to validate input on change
    document.getElementById('password').addEventListener('input', validatePassword);


    

</script>

</html>