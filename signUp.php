
<?php
  // error reporting
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  // Import functions
  require_once('validationSignUp.php');

  //Validate form submission
  validate();
 ?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
  <body>
        <div class="containerSignUp">
        
        <h2>Sign Up</h2>
          <form action="signUp.php" method="post">
            <label for="name"><b>Name</b>
              <input type="text" placeholder="Enter Name" name="name" >
                <!-- Display validation message for username input -->
                <?php the_validation_message('name'); ?>
            </label>
            <label for="username"><b>Username</b>
              <input type="text" placeholder="Enter Username" name="username" >
                <!-- Display validation message for username input -->
                <?php the_validation_message('username'); ?>
            </label>
            <label for="email"><b>Email</b>
              <input type="text" placeholder="Enter email@email.com" name="email" >
                <!-- Display validation message for email input -->
                <?php the_validation_message('email'); ?>
            </label>
            <label for="password"><b>Password</b>
              <input type="password" placeholder="Enter Password" name="password" >
                <!-- Display validation message for password input -->
                <?php the_validation_message('password'); ?>
            </label>
            <button type="submit">Login</button>
          </form>

    </div>
  </body>
</html>