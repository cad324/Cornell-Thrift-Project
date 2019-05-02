<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
$title = "CONTACT"
?>
<!DOCTYPE html>
<html lang="en">

<?php include("includes/heads.php"); ?>

<body>

  <!-- TODO: This should be your main page for your site. -->
  <?php include("includes/header.php"); ?>

  <div class="wrapper">
    <h1>Get In Touch</h1>
    <p>Write us a message and someone on our team will get back to you as soon as possible.</p>

    <div id="contact_wrapper">
      <form>
        <div>
          <label for="contact_name">Name: </label>
          <input type="text" id="contact_name" />
        </div>
        <div>
          <label for="contact_email">Email: </label>
          <input type="email" id="contact_email" />
        </div>
        <div>
          <label for="contact_message">Message: </label>
          <textarea id="contact_message"></textarea>
        </div>
        <div>
          <input type="submit" id="msg_submit" value="Send" />
        </div>
      </form>
    </div>
  </div>

  <?php include("includes/footer.php"); ?>
</body>

</html>
