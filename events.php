<?php
 // INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Events</title>
</head>

<body>

  <!-- TODO: This should be your main page for your site. -->
  <?php include("includes/header.php"); ?>

  <!--Form to add events -->
  <fieldset>
    <form id = "add_events" action = "events.php" method = "post">
      <label for = "image_file">Add an image: </label>
      <input id = "image_file" type = "file" name = "image_file">
      <button name = "upload_image" type = "submit">Upload</button>
    </form>
  </fieldset>
  <?php include("includes/footer.php"); ?>

</body>
</html>
