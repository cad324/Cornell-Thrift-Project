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
  $valid_add = TRUE;

  $type = filter_input(INPUT_POST, 'type', FILTER_VALIDATE_INT);
  $other = filter_input(INPUT_POST, 'new_type', FILTER_SANITIZE_STRING);
  $name = filter_input(INPUT_POST, 'new_name', FILTER_SANITIZE_STRING);
  $date = filter_input(INPUT_POST, 'new_date', FILTER_SANITIZE_STRING);
  $time = filter_input(INPUT_POST, 'new_time', FILTER_SANITIZE_STRING);
  $location = filter_input(INPUT_POST, 'new_location', FILTER_SANITIZE_STRING);


  if ($type == 999999 && $other == '') {
    $need_new_category = TRUE;
    $valid_add = FALSE;
    //tell the user below that they must name this new category if they wish to select other
  }

  if ($name == "") {
    //create an error message below so the user knows that every event needs at least a name
    $need_name = TRUE;
    $valid_add = FALSE;
  }

  if ($type == "") {
    //create an error message below so the user knows that every event needs a category
    $need_category = TRUE;
    $valid_add = FALSE;
  }

  if ($valid_add) {
  $sql = "INSERT INTO events (name, date, time, location) VALUES (:name, :date, :time, :location)";
  $params = array (
    ':name' => $name,
    ':date' => $date,
    ':time' => $time,
    ':location' => $location
  );

  $new_event = exec_sql_query($db, $sql, $params);

  }
  //add the new category, add the new event and make its category equal to this new category
  if ($type == 999999 && $other != '') {
    //add a new category to the categories table
    $sql = "INSERT INTO categories (category) VALUES (:category)";
    $params = array (
      ':category' => $other
    );
    $result = exec_sql_query($db, $sql, $params);

    //access id of new cateory
    $sql = "SELECT id FROM categories WHERE category IS :category";
    $params = array (
      ':category' => $other
    );
    $category_result = exec_sql_query($db, $sql, $params) -> fetchAll();
    $category_result = $category_result[0];
    $category_result = $category_result['id'];


    //access id of new event
    $sql = "SELECT id FROM events WHERE name IS :name";
    $params = array (
      ':name' => $name
    );
    $event_result = exec_sql_query($db, $sql, $params) -> fetchAll();
    $event_result = $event_result[0];
    $event_result = $event_result['id'];

    //insert new category id into event_categories table
    $sql = "INSERT INTO event_categories (event_id, category_id) VALUES (:event_id, :category_id)";
    $params = array(
      ':event_id' => $event_result,
      ':category_id' => $category_result
    );
    $result = exec_sql_query($db, $sql, $params);
  }

  if ($type != 999999 && $type != NULL) {
  //access event id of this new event
    $sql = "SELECT id FROM events WHERE name IS :name";
    $params = array (
      ':name' => $name
    );
    $event_result = exec_sql_query($db, $sql, $params) -> fetchAll();
    $event_result = $event_result[0];
    $event_result = $event_result['id'];
  //add this event to the event_categories table
    $sql = "INSERT INTO event_categories (event_id, category_id) VALUES (:event_id, :category_id)";
    $params = array (
      ':event_id' => $event_result,
      ':category_id' => $type
    );
    $new_event = exec_sql_query($db, $sql, $params);
  }

} else {
  $valid_add = FALSE;
}

?>
<!DOCTYPE html>
<html lang="en">

<?php include("includes/heads.php"); ?>

<body class = "events_page">

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
          <p>Behind the Seams is a photo campaign to get people thinking about the value of clothes by sharing the stories they hold. We're hoping to reduce waste by having people rethink the way they see their clothes. We hold an open photo shoot every other Friday from 12 - 2pm at Temple of Zeus, and new photos go up on our <a href = "https://www.facebook.com/behindtheseamscornellthrift/" target = "_blank"> Behind the Seams Facebook page </a>every Tuesday and Friday.</p>
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
          <fieldset class = "event_forms">
            <h2>Update an Event?</h2>
            <?php
            if (isset($_POST["update_event"])&& $update_event == TRUE) {
              echo "<p> You have successfully updated your event! Please click on the Events tab in the navigation bar above if you would like to update another event.</p>";
            } else {
            ?>
            <form id="update_events" action="events.php" method="post">
              <div>
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
              </div>
              <?php
              if (isset($_POST["update_event"])&& $update_event == FALSE) {
                echo "<p class = 'error'> Please add a change to at least one field before submitting the form</p>";
              }
              ?>
              <div>
              <label for="update_name">Change Name: </label>
              <input id="update_name" type="text" name="update_name">
              </div>

              <div>
              <label for="update_date">Change Date: </label>
              <input id="update_date" type="date" name="update_date">
              </div>

              <div>
              <label for="update_time"> Change Time: </label>
              <input id="update_time" type="text" name="update_time">
              </div>

              <div>
              <label for="update_location"> Change Location: </label>
              <input id="update_location" type="text" name="update_location">
              </div>

              <div>
              <button name="update_event" type="submit">Update</button>
              </div>
            </form>
            <?php } ?>
          </fieldset>
        </div>
        <div id="delete_add">
          <fieldset class = event_forms>
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

          <fieldset class = "event_forms">
            <!--Form to add events -->
            <h2>Add an Event?</h2>
            <?php
            if (isset($_POST["add_event"])&& $valid_add == TRUE) {
              echo "<p> You have successfully added an event! Please click on the Events tab in the navigation bar above if you would like to add another event.</p>";
            } else {
            ?>
            <form id="add_events" action="events.php" method="post">
              <div>
              <label for="pick_type">Categorize this event as a: </label>
              </div>

              <div>
              <?php
                $sql = "SELECT * FROM categories";
                $params = array();
                $categories = exec_sql_query($db, $sql, $params) -> fetchAll();

                foreach ($categories as $category) {
                  echo "<input type = 'radio' name='type' value = '". $category['id'] . "'>" . $category['category'] . "<br>";
                }
              ?>
              </div>

              <div>
                <input type = "radio" name = "type" value = "999999"> Other:<br>
                <input id="other" type="text" name="new_type">
              </div>

              <div>
                <?php
                  if (isset($_POST["add_event"])&& $need_category == TRUE) {
                    echo "<p class = 'error'> You must select a category or add one of your own.</p>";
                  }
                ?>

                <?php
                  if (isset($_POST["add_event"])&& $need_new_category == TRUE) {
                    echo "<p class = 'error'> If you wish to select Other, you must name this new category.</p>";
                  }
                ?>
              </div>

                <div>
                <label for="new_name"> Event Name: </label>
                <input id="new_name" type="text" name="new_name">

                <?php
                  if (isset($_POST["add_event"])&& $need_name == TRUE) {
                    echo "<p class = 'error'> You must provide a name for this event.</p>";
                  }
                ?>
                </div>

                <div>
                <label for="new_date">Date: </label>
                <input id="new_date" type="date" name="new_date">
                </div>

                <div>
                <label for="new_time">Time: </label>
                <input id="new_time" type="text" name="new_time">
                </div>

                <div>
                <label for="new_location">Location: </label>
                <input id="new_location" type="text" name="new_location">
                </div>

                <div>
                <button name="add_event" type="submit">Add</button>
                </div>

            </form>
            <?php } ?>
          </fieldset>
        </div>
      <?php
    }
    ?>
    </div>
  </div>
    <?php include("includes/footer.php"); ?>
</body>

</html>
