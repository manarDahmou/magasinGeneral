<!doctype html>
<?php
session_start();
?>
<html lang="en">

<head>
  <title>Hello, world!</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="css/style.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
          <!-- Tabs Titles -->
          <a href="#" class="active">Sign In</a>
          <a href="Sign_in.php" class="inactive underlineHover">Sign Up</a>
          <?php
            if (isset($_GET['erreurcnx'])) {
            $err = $_GET['erreurcnx'];
            if ($err == 1 || $err == 2)
            echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
            }
          ?>
      
          <!-- Login Form -->
          <form action="in.php" method="POST">
            <input type="email" id="email" class="fadeIn second" name="email" placeholder="email">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
            <input type="submit" class="fadeIn fourth" value="Log In">
          </form>
      
          <!-- Remind Passowrd -->
          <div id="formFooter">
            <a class="underlineHover" href="#">Forgot Password?</a>
          </div>
      
        </div>
      </div>
</body>

</html>