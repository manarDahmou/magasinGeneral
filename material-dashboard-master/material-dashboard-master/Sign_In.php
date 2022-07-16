<!doctype html>
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
          <a href="index.php" class="inactive underlineHover">Sign In</a>
          <a href="#" class="active">Sign Up</a>
          <?php
                		if(isset($_GET['erreurins'])){
                    	$err = $_GET['erreurins'];
                    	if($err==1){
                        echo "<p style='color:green'>New records created successfully</p>";
                    	} elseif ($err==2) {
                        echo "<p style='color:red'>Login already exists:</p>";
                    	}
                		}
                		?>
          <!-- Login Form -->
          <form action="up.php" method="POST">
            <input type="text" id="nom" class="fadeIn second" name="nom" placeholder="name">
            <input type="text" id="prenom" class="fadeIn second" name="prenom" placeholder="prenom">
            <input type="email" id="email" class="fadeIn second" name="email" placeholder="email">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
            <input type="submit" class="fadeIn fourth" value="Sign In">
          </form>
      
          <!-- Remind Passowrd -->
          <div id="formFooter">
            <a class="underlineHover" href="#">Forgot Password?</a>
          </div>
      
        </div>
      </div>
</body>

</html>