<?php
 // INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
$title = "LOGIN";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css">
  <title><?php echo $title; ?></title>
</head>

<body>

  <!-- TODO: This should be your main page for your site. -->
  <?php include("includes/header.php"); ?>

  <div id="login_main">
    <h1>Login</h1>

    <div id="login_wrapper">
      <?php if (!is_user_logged_in()) { ?>
      <form method="post" action="login.php">
        <div>
          <label for="username">Username: </label>
          <input type="text" name="user" id="username"/>
        </div>
        <div>
          <label for="contact_email">Password: </label>
          <input type="password" name="password" id="password"/>
        </div>
        <div>
          <input type="submit" name="login" id="login_submit" value="LOGIN"/>
        </div>
      </form> <?php }  else { ?>
        <p>You are logged in as <?php echo $current_user["username"]; ?></p>
        <button><a href="index.php">Go to Homepage</a></button>
      <?php } ?>
    </div>
  </div>
  <?php
    foreach ($session_messages as $sm) {
      echo "<li><strong>" . htmlspecialchars($sm) . "</strong></li>\n";
    }
  ?>
  <?php include("includes/footer.php"); ?>
</body>
</html>
