<?php
 // INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
$title = "EVENTS"
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

  <!-- Form to update events -->
  <h2>Update an Event?</h2>
  <fieldset>
    <form id = "update_events" action = "events.php" method = "post">
      <label for = "update_event">Select an Event: </label>
      <!-- Will change this to a drop down later-->
      <input id = "update_event" type = "text" name = "update_event">
      <label for = "update_date">Change Date: </label>
      <input id = "update_date" type = "text" name = "update_date">
      <label for = "update_time"> Change Time: </label>
      <input id = "update_time" type = "text" name = "update_time">
      <label for = "update_location"> Change Location: </label>
      <input id = "update_location" type = "text" name = "update_location">
      <button name = "update_event" type = "submit">Update</button>
    </form>
  </fieldset>

  <!--Form to remove events -->
  <h2>Delete an Event?</h2>
  <fieldset>
    <form id = "delete_events" action = "events.php" method = "post">
      <label for = "delete_event">Select an Event: </label>
      <!-- Will change this to a drop down later-->
      <input id = "delete_event" type = "text" name = "delete_event">
      <button name = "delete_event" type = "submit">Delete</button>
    </form>
  </fieldset>

  <!--Form to add events -->
  <h2>Add an Event?</h2>
  <fieldset>
    <form id = "add_events" action = "events.php" method = "post">
      <label for = "new_name"> Event Name: </label>
      <input id = "new_name" type = "text" name = "new_name">
      <label for = "new_date">Date: </label>
      <input id = "new_date" type = "text" name = "new_date">
      <label for = "new_time">Time: </label>
      <input id = "new_time" type = "text" name = "new_time">
      <label for = "new_location">Location: </label>
      <input id = "new_location" type = "text" name = "new_location">
      <button name = "add_event" type = "submit">Add</button>
    </form>
  </fieldset>
  <?php include("includes/footer.php"); ?>
</body>
</html>
