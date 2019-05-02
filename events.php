<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
$title = "EVENTS";

//handling submissions for the update events form
if (isset($_POST["update_event"]) && is_user_logged_in()) {
  $update_event = TRUE;

  $original = filter_input(INPUT_POST, 'event_options', FILTER_VALIDATE_INT);
  $name = filter_input(INPUT_POST, 'update_name', FILTER_SANITIZE_STRING);
  $date = filter_input(INPUT_POST, 'update_date', FILTER_SANITIZE_STRING);
  $time = filter_input(INPUT_POST, 'update_time', FILTER_SANITIZE_STRING);
  $location = filter_input(INPUT_POST, 'update_location', FILTER_SANITIZE_STRING);

  if ($name != '') {
    $sql = "UPDATE events SET name = :name WHERE id = :original;";

    $params = array(
      ':name' => $name,
      ':original' => $original
    );
    $names = exec_sql_query($db, $sql, $params)->fetchAll();

  }

  if ($date != '') {
    $sql = "UPDATE events SET date = :date WHERE id = :original;";

    $params = array(
      ':date' => $date,
      ':original' => $original
    );
    $dates = exec_sql_query($db, $sql, $params);

  }

  if ($time != '') {
    $sql = "UPDATE events SET time = :time WHERE id = :original;";

    $params = array(
      ':time' => $time,
      ':original' => $original
    );
    $times = exec_sql_query($db, $sql, $params);

  }

  if ($location != '') {
    $sql = "UPDATE events SET location = :location WHERE id = :original;";

    $params = array(
      ':location' => $location,
      ':original' => $original
    );
    $locations = exec_sql_query($db, $sql, $params);

  }

  if ($name == '' && $date == "" && $time == "" && $location == ""){
    $update_event = FALSE;
  }
}

//handling submissions for the delete events form
if (isset($_POST["delete_event"]) && is_user_logged_in()) {
  $valid_delete = TRUE;
  $events = filter_input(INPUT_POST, 'delete_events', FILTER_VALIDATE_INT);

  $sql = "DELETE FROM events WHERE id = :events";
  $params = array(
    ':events'=> $events
  );
  $deleting_events = exec_sql_query($db, $sql, $params);

  $sql = "DELETE FROM event_categories WHERE event_id = :events";
  $params = array(
    ':events'=> $events
  );
  $deleting_event_categories = exec_sql_query($db, $sql, $params);

} else {
  $valid_delete = FALSE;
}
//handling submissions for the add events form
if (isset($_POST["add_event"]) && is_user_logged_in()) {
  $type = filter_input(INPUT_POST, 'pick_type', FILTER_VALIDATE_INT);
  $other = filter_input(INPUT_POST, 'other', FILTER_VALIDATE_INT);
  $name = filter_input(INPUT_POST, 'new_name', FILTER_SANITIZE_STRING);
  $date = 'new_date'; //will work on filtering date input later
  $time = filter_input(INPUT_POST, 'new_time', FILTER_SANITIZE_STRING);
  $location = filter_input(INPUT_POST, 'new_location', FILTER_SANITIZE_STRING);

  if ($other != "") {
    //make array of all the other existing type values and compare
    //probably should dynamically render type categories
  }

  $sql = "INSERT INTO events (type, name, date, time, location) VALUES (:type, :name, :date, :time, :location)";

  $params = array(
    ':type' => $type,
    ':name' => $name,
    ':date' => $date,
    ':time' => $time,
    ':location' => $location
  );

  $result = exec_sql_query($db, $sql, $params);
}

?>
<!DOCTYPE html>
<html lang="en">

<?php include("includes/heads.php"); ?>

<body>

  <!-- TODO: This should be your main page for your site. -->
  <?php include("includes/header.php"); ?>
  <div id="events_main">
    <div class="events_row">
      <h1><u>Current Events</u></h1>
    </div>
    <div class="events_row">
      <div id="thrift_exchange">

        <div>
          <h2>Thrift Exchange Closets</h2>
        </div>

        <div>
          <img src="images/exchangeclosets.jpg" alt="WSH exchange closet" class="static_img">
        </div>

        <div>
          <p>Ezra's Exchange is a closet space open in the browsing library in Willard Straight Hall. The closet's slogan is "Free to Give, Free to Take." Here you can donate clothes and find new ones for free! Open whenever Willard Straight is! </br> </br>Come check out our newest location, open as of Spring 2018... Ezra's Exchange 2.0 located in Carl Becker House on West Campus!</p>
        </div>

        <div>
          <h3>Locations</h3>
          <!-- Insert database info here-->
          <table>
            <?php
            $sql = "SELECT events.location FROM events INNER JOIN event_categories ON events.id = event_categories.event_id WHERE event_categories.category_id = 1;";
            $params = array();
            $closets = exec_sql_query($db, $sql, $params)->fetchAll();

            foreach ($closets as $closet) {
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
      <div id="pop_up">
        <div>
          <h2> Pop-Up Shops</h2>
        </div>

        <div>
          <img src="images/popup_shop.jpg" alt="scene of a pop-up shop" class="static_img">
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
            $sql = "SELECT events.name, events.date, events.time, events.location FROM events INNER JOIN event_categories ON events.id = event_categories.event_id WHERE event_categories.category_id = 2 ORDER BY events.date DESC;";

            $params = array();
            $popups = exec_sql_query($db, $sql, $params)->fetchAll();

            foreach ($popups as $popup) {
              echo "<tr>";
              echo "<td>" . $popup["name"] . "</td>";
              echo "<td>" . date(F, strtotime($popup["date"])) . " " . date(j, strtotime($popup["date"])) . ", " . date(Y, strtotime($popup["date"])) . "</td>";
              echo "<td>" . $popup["time"] . "</td>";
              echo "<td>" . $popup["location"] . "</td>";
              echo "</tr>";
            }
            ?>
            <table>
        </div>
      </div>
    </div>

    <div class="events_row">
      <div id="behind_seams">

        <div>
          <h2> Behind the Seams Photo Campaign</h2>
        </div>

        <div>
          <img src="images/behindtheseams.png" alt="behind the seams logo" class="static_img">
        </div>

        <div>
          <p>Behind the Seams is a photo campaign to get people thinking about the value of clothes by sharing the stories they hold. We're hoping to reduce waste by having people rethink the way they see their clothes. We hold an open photo shoot every other Friday from 12 - 2pm at Temple of Zeus, and new photos go up on our Behind the Seams Facebook page every Tuesday and Friday. </p>
        </div>

      </div>
      <div id="sewing_workshops">
        <h2> Sewing Workshops</h2>

        <img src="images/sewingworkshop.png" alt="sewing workshop pic" class="static_img">

        <p>We'll teach you how to sew on that missing button, fix a tear, or hem your dress! Come find us in the Willard Straight Hall International Lounge from 4:30 - 6:30pm every other Wednesday.</p>

        <table>
          <thead>
            <th>Event</th>
            <th>Date</th>
            <th>Time</th>
            <th>Location</th>
          </thead>

          <?php
          $sql = "SELECT events.name, events.date, events.time, events.location FROM events INNER JOIN event_categories ON events.id = event_categories.event_id WHERE event_categories.category_id = 3 ORDER BY events.date DESC;";

          $params = array();
          $workshops = exec_sql_query($db, $sql, $params)->fetchAll();

          foreach ($workshops as $workshop) {
            echo "<tr>";
            echo "<td>" . $workshop["name"] . "</td>";
            echo "<td>" . date(F, strtotime($workshop["date"])) . " " . date(j, strtotime($workshop["date"])) . ", " . date(Y, strtotime($workshop["date"])) . "</td>";
            echo "<td>" . $workshop["time"] . "</td>";
            echo "<td>" . $workshop["location"] . "</td>";
            echo "</tr>";
          }
          ?>
          <table>
      </div>
    </div>
    <?php
    if (is_user_logged_in()) { ?>
      <div class="events_row">
        <div id="updating_events">
          <!-- Form to update events -->
          <fieldset>
            <h2>Update an Event?</h2>
            <?php
            if (isset($_POST["update_event"])&& $update_event == TRUE) {
              echo "<p> You have successfully updated your event! Please click on the Events tab in the navigation bar above if you would like to update another event.</p>";
            } else {
            ?>
            <form id="update_events" action="events.php" method="post">

              <label for="event_options">Select an Event: </label>
              <!-- Will change this to a drop down later-->
              <select id = "event_options" name = "event_options">
                <?php
                $sql = "SELECT * FROM events";
                $params = array();
                $events = exec_sql_query($db, $sql, $params) -> fetchAll();

                foreach ($events as $event) {
                  echo "<option value = '" . $event["id"] . "'>" . $event["name"] . "</option>";
                }
                ?>
              </select>
              <?php
              if (isset($_POST["update_event"])&& $update_event == FALSE) {
                echo "<p> Please add a change to at least one field before submitting the form</p>";
              }
              ?>
              <label for="update_name">Change Name: </label>
              <input id="update_name" type="text" name="update_name">

              <label for="update_date">Change Date: </label>
              <input id="update_date" type="date" name="update_date">

              <label for="update_time"> Change Time: </label>
              <input id="update_time" type="text" name="update_time">

              <label for="update_location"> Change Location: </label>
              <input id="update_location" type="text" name="update_location">

              <button name="update_event" type="submit">Update</button>

            </form>
            <?php } ?>
          </fieldset>
        </div>
        <div id="delete_add">
          <fieldset>
            <!--Form to remove events -->
            <h2>Delete an Event?</h2>
            <?php
            if (isset($_POST["delete_event"])&& $valid_delete == TRUE) {
              echo "<p> You have successfully deleted your event! Please click on the Events tab in the navigation bar above if you would like to delete another event.</p>";
            } else {
            ?>
            <form id="delete_events" action="events.php" method="post">
              <label for="delete_events">Select an Event: </label>
              <!-- Will change this to a drop down later-->
              <select id = "delete_events" name = "delete_events">
                <?php
                $sql = "SELECT * FROM events";
                $params = array();
                $events = exec_sql_query($db, $sql, $params) -> fetchAll();

                foreach ($events as $event) {
                  echo "<option value = '" . $event["id"] . "'>" . $event["name"] . "</option>";
                }
                ?>
              </select>
              <button name="delete_event" type="submit">Delete</button>
            </form>
            <?php } ?>
          </fieldset>

          <fieldset>
            <!--Form to add events -->
            <h2>Add an Event?</h2>
            <form id="add_events" action="events.php" method="post">

              <label for="pick_type">Categorize this event as a: </label>

              <?php
                $sql = "SELECT * FROM categories";
                $params = array();
                $categories = exec_sql_query($db, $sql, $params) -> fetchAll();

                foreach ($categories as $category) {
                  echo "<input id = 'pick_type' type = 'radio' name='type' value = '". $category['id'] . "'>" . $category['category'] . "<br>";
                }
              ?>

                <input id="pick_type" type = "radio" name = "type" value = "other"> Other:<br>
                <input id="other" type="text" name="new_type">

                <label for="new_name"> Event Name: </label>
                <input id="new_name" type="text" name="new_name">

                <label for="new_date">Date: </label>
                <input id="new_date" type="date" name="new_date">

                <label for="new_time">Time: </label>
                <input id="new_time" type="text" name="new_time">

                <label for="new_location">Location: </label>
                <input id="new_location" type="text" name="new_location">

                <button name="add_event" type="submit">Add</button>

            </form>
          </fieldset>
        </div>
      <?php
    }
    ?>
    </div>

    <?php include("includes/footer.php"); ?>
</body>

</html>
