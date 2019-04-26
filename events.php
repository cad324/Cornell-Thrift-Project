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
  <div id = "events_main">
    <div class = "events_row">
      <h1><u>Current Events</u></h1>
    </div>
    <div class = "events_row">
      <div id = "thrift_exchange">

        <div>
        <h2>Thrift Exchange Closets</h2>
        </div>

        <div>
        <p>Insert description here</p>
        </div>

        <div>
        <h3>Locations</h3>
         <!-- Insert database info here-->
        </div>

      </div>
      <div id = "pop_up">
        <div>
          <h2> Pop-Up Shops</h2>
        </div>

        <div>
          <p>Insert description here</p>
        </div>

        <div>
          <table>
            <thead>
              <th>Date</th>
              <th>Time</th>
              <th>Location</th>
            </thead>
          <table>
        </div>
      </div>
    </div>

    <div class = "events_row">
      <div id = "behind_seams">

        <div>
        <h2> Behind the Seams Photo Campaign</h2>
        </div>

        <div>
        <p>Behind the Seams is a photo campaign to get people thinking about the value of clothes by sharing the stories they hold. We're hoping to reduce waste by having people rethink the way they see their clothes. We hold an open photo shoot every other Friday from 12 - 2pm at Temple of Zeus, and new photos go up on our Behind the Seams Facebook page every Tuesday and Friday. </p>
        </div>
        <!-- Update description and get instagram link from client-->
      </div>
      <div id = "sewing_workshops">
        <h2> Sewing Workshops</h2>
        <p>We'll teach you how to sew on that missing button, fix a tear, or hem your dress! Come find us in the Willard Straight Hall International Lounge from 4:30 - 6:30pm every other Wednesday.</p>
        <!--Ask client about updating description-->
        <table>
          <thead>
            <th>Date</th>
            <th>Time</th>
            <th>Location</th>
          </thead>
        <table>
      </div>
    </div>

    <div class = "events_row">
      <div id = "updating_events">
         <!-- Form to update events -->
      <fieldset>
      <h2>Update an Event?</h2>
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
      </div>
      <div id = "delete_add">
        <fieldset>
        <!--Form to remove events -->
        <h2>Delete an Event?</h2>
          <form id = "delete_events" action = "events.php" method = "post">
            <label for = "delete_event">Select an Event: </label>
            <!-- Will change this to a drop down later-->
            <input id = "delete_event" type = "text" name = "delete_event">
            <button name = "delete_event" type = "submit">Delete</button>
          </form>
        </fieldset>

        <fieldset>
        <!--Form to add events -->
        <h2>Add an Event?</h2>
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
      </div>
    </div>
  </div>

  <?php include("includes/footer.php"); ?>
</body>
</html>
