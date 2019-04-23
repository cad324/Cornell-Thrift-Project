<?php
 // INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
$title = "LOGIN"
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
      <form>
        <div>
          <label for="username">Username: </label>
          <input type="text" name="username" id="username"/>
        </div>
        <div>
          <label for="contact_email">Email: </label>
          <input type="email" name="email" id="email"/>
        </div>
        <div>
          <input type="submit" name="login" id="login_submit" value="LOGIN"/>
        </div>
      </form>
    </div>
  </div>

  <?php include("includes/footer.php"); ?>
</body>
</html>
