<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
$title = "CONTACT";


if (isset($_POST["submit"])) {
  $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
  $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
  $msg_sql = "INSERT INTO messages(name, email, message) VALUES(:name, :email, :message);";
  $msg_param = array(
      ':name' => $name,
      ':email' => $email,
      ':message' => $message
  );
  exec_sql_query($db, $msg_sql, $msg_param);
  $confirmation = "&#9745; We received your message. Someone will be getting back to you shortly";
  $sent = TRUE;
}

?>
<!DOCTYPE html>
<html lang="en">

<?php include("includes/heads.php"); ?>

<body>

  <!-- TODO: This should be your main page for your site. -->
  <?php include("includes/header.php"); ?>

  <div class="wrapper">
    <h1>Get In Touch</h1>
    <div id="contact_wrapper">
      <div>
        <?php if ($sent) { ?>
          <p class='success dark'><?php echo $confirmation; ?></p>
        <?php } else { ?>
        <form method="post" id="contactForm">
          <p>Write us a message and someone on our team will get back to you as soon as possible.</p>
          <div>
            <label for="contact_name">Name: </label>
            <input name="name" type="text" id="contact_name" required/>
          </div>
          <div>
            <label for="contact_email">Email: </label>
            <input name="email" type="email" id="contact_email" required/>
          </div>
          <div>
            <label for="contact_message">Message: </label>
            <textarea name="message" id="contact_message" required></textarea>
          </div>
          <div id="contact_submit_wrapper">
            <input type="submit" name="submit" id="msg_submit" value="Send" />
          </div>
        </form>
        <?php } ?>
      </div>
      <div>
        <h2>EMAIL</h2>
        <a href="mailto:cornellthrift@gmail.com"><img src="images/email-icon.png" alt="email icon"></a>
        <h2>FACEBOOK</h2>
        <a target="_blank" href="https://www.facebook.com/cornellthrift/"><img src="images/fb-icon.png" alt="facebook icon"></a>
        <h2>INSTAGRAAM</h2>
        <a target="_blank" href="https://www.instagram.com/cornellthrift/?hl=en"><img src="images/ig-icon.png" alt="instagram icon"></a>
      </div>
    </div>
  </div>

  <?php include("includes/footer.php"); ?>
</body>

</html>
