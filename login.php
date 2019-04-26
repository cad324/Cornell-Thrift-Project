<?php
 // INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
$title = "LOGIN";

if ( isset($_POST["login"]) ) {
  $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
  $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
  log_in($username, $password);
}

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
      </form>
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
