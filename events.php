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
          <img src = "images/exchangeclosets.jpg" alt = "WSH exchange closet" class = "static_img">
        </div>

        <div>
        <p>Ezra's Exchange is a closet space open in the browsing library in Willard Straight Hall. The closet's slogan is "Free to Give, Free to Take." Here you can donate clothes and find new ones for free! Open whenever Willard Straight is! </br> </br>Come check out our newest location, open as of Spring 2018... Ezra's Exchange 2.0 located in Carl Becker House on West Campus!</p>
        </div>

        <div>
        <h3>Locations</h3>
         <!-- Insert database info here-->
         <table>
            <?php
            $sql = "SELECT * FROM events WHERE type = 1;";
            $params = array ();
            $closets = exec_sql_query($db, $sql, $params)->fetchAll();

            foreach($closets as $closet) {
              echo "<tr>";
              echo "<td>";
              echo $closet["location"];
              echo "</td>";
              echo "</tr>";
            }
          ?>
        </table>
        </div>

      </div>
      <div id = "pop_up">
        <div>
          <h2> Pop-Up Shops</h2>
        </div>

        <div>
          <img src = "images/popup_shop.jpg" alt = "scene of a pop-up shop" class = "static_img">
        </div>

        <div>
          <p>Want to start shopping sustainably? Stop by one of our pop-up shops and you'll find free or low-price clothing from other Cornell students and local thrift shops!</p>
        </div>

        <div>
          <table>
            <thead>
              <th>Event</th>
              <th>Date</th>
              <th>Time</th>
              <th>Location</th>
            </thead>

            <?php
            $sql = "SELECT * FROM events WHERE type = 2 ORDER BY date DESC;";
            $params = array ();
            $popups = exec_sql_query($db, $sql, $params)->fetchAll();

            foreach($popups as $popup) {
              echo "<tr>";
              echo "<td>".$popup["name"]. "</td>";
              echo "<td>".date(F,strtotime($popup["date"]))." ".date(j,strtotime($popup["date"])). ", ".date(Y,strtotime($popup["date"]))."</td>";
              echo "<td>".$popup["time"]. "</td>";
              echo "<td>".$popup["location"]. "</td>";
              echo "</tr>";
            }
          ?>
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
          <img src = "images/behindtheseams.png" alt = "behind the seams logo" class = "static_img">
        </div>

        <div>
        <p>Behind the Seams is a photo campaign to get people thinking about the value of clothes by sharing the stories they hold. We're hoping to reduce waste by having people rethink the way they see their clothes. We hold an open photo shoot every other Friday from 12 - 2pm at Temple of Zeus, and new photos go up on our Behind the Seams Facebook page every Tuesday and Friday. </p>
        </div>

      </div>
      <div id = "sewing_workshops">
        <h2> Sewing Workshops</h2>

          <img src = "images/sewingworkshop.png" alt = "sewing workshop pic" class = "static_img">

        <p>We'll teach you how to sew on that missing button, fix a tear, or hem your dress! Come find us in the Willard Straight Hall International Lounge from 4:30 - 6:30pm every other Wednesday.</p>

        <table>
          <thead>
            <th>Event</th>
            <th>Date</th>
            <th>Time</th>
            <th>Location</th>
          </thead>

          <?php
            $sql = "SELECT * FROM events WHERE type = 3 ORDER BY date DESC;";
            $params = array ();
            $workshops = exec_sql_query($db, $sql, $params)->fetchAll();

            foreach($workshops as $workshop) {
              echo "<tr>";
              echo "<td>".$workshop["name"]. "</td>";
              echo "<td>".date(F,strtotime($workshop["date"]))." ".date(j,strtotime($workshop["date"])). ", ".date(Y,strtotime($workshop["date"]))."</td>";
              echo "<td>".$workshop["time"]. "</td>";
              echo "<td>".$workshop["location"]. "</td>";
              echo "</tr>";
            }
          ?>
        <table>
      </div>
    </div>
    <?php
    if (is_user_logged_in()) { ?>
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
    <?php
        }
        ?>
  </div>

  <?php include("includes/footer.php"); ?>
</body>
</html>
