
<?php
  // error reporting
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  // Starting session
  session_start();
  // Import functions
  require_once('validationLogin.php');

  // Validate form submission
  validate();
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Financial Project</title>

    <link rel="stylesheet" href="style.css">
  
  </head>
  <body style="background-color:#3578E5;">
    <div class="grid-container">
      <div class="header">
        <h1 id="title">Financial Plan</h1>
        <a id="signUp" href="signUp.php">SignUp</a>
        <a id="howToUse" href="howToUse.php">Documentation</a>
      </div>
      
        <div class="container">
          <div class="container2">
            <h2>Login</h2>
          <form action="index.php" method="post">
            <label for="username"><b>Username</b>
              <input type="text" placeholder="Enter Username" name="username" required>
                <!-- Display validation message for username input -->
                <?php the_validation_message('username'); ?>
            </label>
            <label for="password"><b>Password</b>
              <input type="password" placeholder="Enter Password" name="password" required>
                <!-- Display validation message for password input -->
                <?php the_validation_message('password'); ?>
                
            </label>
            <button type="submit">Login</button>
          </form>
          </div>
        </div>
        <div class="back">
      </div>
    </div>
  </body>
</html>