<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
$title = "CONTACT";

// messages is an array
$messages = array();

// Max file size is 1 MB = 1000000 bytes
const MAX_FILE_SIZE = 1000000;

$records = exec_sql_query(
  $db,
  "SELECT * FROM images"
)->fetchAll();


// User must be logged in to upload to image gallery
if (isset($_POST["uploadHome"]) && is_user_logged_in()) {

  // Filtering
  $upload_info = $_FILES["file_data"];
  var_dump($upload_info);

  //if upload sucessful then get filename and file extension
  if ($upload_info['error'] == UPLOAD_ERR_OK) {
    $filename = trim(filter_var(basename($upload_info["name"]), FILTER_SANITIZE_STRING));
    var_dump("the filename is " . $filename);
    $upload_ext = trim(filter_var(strtolower(pathinfo($filename, PATHINFO_EXTENSION)), FILTER_SANITIZE_STRING));

    $character_name = filter_input(INPUT_POST, 'character_name', FILTER_SANITIZE_STRING);


    // Upload sucessful!
    // Insert new record into images table
    $sql = "INSERT INTO images (file_name, file_ext)
     VALUES (:filename, :upload_ext);";
    $params = array(
      ':filename' => $filename,
      ':upload_ext' => $upload_ext,
    );
    $new_record = exec_sql_query($db, $sql, $params);

    // Move uploaded file to uploads/images
    if ($new_record) {
      var_dump("is it getting the database?");
      $input_id = $db->lastInsertId();
      var_dump("what is the last id?" . $input_id);
      $new_path = "uploads/slideshow/" . $input_id . "." . $upload_ext;
      move_uploaded_file($upload_info["tmp_name"], $new_path);
    } else {
      array_push($messages, "Not new record.");
    }

    $sql2 = "UPDATE images SET file_name = :input_id WHERE id = :input_id";
    $new_record = exec_sql_query(
      $db,
      $sql2,
      $params2 = array(
        ':filename' => $filename,
        ':upload_ext' => $upload_ext,
      )
    );

    // upload is not successful
  } else {
    array_push($messages, "You must log in to upload an image!!");
  }
}

?>
<!DOCTYPE html>
<html lang="en">


<?php

include("includes/heads.php"); ?>

<body>
  <?php include("includes/header.php"); ?>
  <div>

    <div id="mission">
      <h2> WHAT WE DO </h2>
      <p> Cornell Thrift’s mission is to reduce campus‐wide waste through redistribution of reusable personal items. The initiative was inspired by the concept of “free‐piles” seen in university co‐operative housing, along with the annual Dump‐and‐Run sale. We want to see reusable clothes, homeware, electronics, and small furniture going into homes and not trashcans ‐ all year round. <p>
    </div>

    <div id="color_event">
      <div id="event_slideshow_wrap">
        <h3 class="home_titles"> <a href="about.php">EVENTS</a></h3>
        </a>
        <div id="home_events_box">
          <p>Cornell Thrift hosts events around campus, from a photo campaign at the Temple of Zeus to
            a clothing exchange slot at Willard Straight to mending workshops at the Willard Straight
            International Lounge. Some of these activities are year long, while others are workshops and
            partnered events. Thrift with us and check out our upcoming events!
          </p>
        </div>

        <div class="slidebox">
          <?php
          foreach ($records as $record) { ?>
            <img alt="<?php echo $record["file_name"] ?>" src="uploads/slideshow/<?php echo ($record["id"] . "." . $record["file_ext"]); ?>" class="slides">
          <?php
        }
        ?> </div>
        <div id="log_in_form">
          <?php
          if (is_user_logged_in()) { ?>
            <form id="home_upload_form" action="index.php" method="post" enctype="multipart/form-data">
              <!-- Image cannot excede MAX_FILE_SIZE  -->
              <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
              <label for="file_data">Upload</label>
              <input id="file_data" type="file" name="file_data">
              <button name="uploadHome" type="submit">Upload to Slideshow</button>
            </form>

            <form id="home_delete_form" action="home_delt.php" method="post" enctype="multipart/form-data">
              <label name="delete_lab">Delete </label>
              <button name="delete_butn" type="submit">Click here to delete</button>
            </form>
          <?php } ?>
        </div>
      </div>
    </div>

    <div id="home_resource_box">
      <h3 class="home_titles"> <a href="resources_stores.php">THRIFT RESOURCES</a></h3>
      </a>
      <!-- Source: //res.cloudinary.com/hrscywv4p/image/upload/c_limit,fl_lossy,h_9000,w_1200,f_auto,q_auto/v1/798878/banner_geb13y.png -->
      <img src="//res.cloudinary.com/hrscywv4p/image/upload/c_limit,fl_lossy,h_9000,w_1200,f_auto,q_auto/v1/798878/banner_geb13y.png" alt="resource" id="home_resource_pic" alt="resource" />
      <p>Ithaca is home to a variety of second hand stores, many which are close to campus. Explore these
        stores and find out other ways in which you can help support the Cornell and Ithaca community
        through recycling used items.
      </p>
    </div>

    <div id="color_mem">
      <div id="home_members_box">
        <h3 class="home_titles"> <a href="about.php">JOIN US!</a></h3>
        <p>Do you also love Cornell Thrift? Join us at our Gbody meetings and get to know
          the Cornell Thrift team.
        </p>
        <!-- Source: https://www.google.com/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=2ahUKEwju7rLi_oniAhVFp1kKHbRPBewQjRx6BAgBEAU&url=https%3A%2F%2Fwww.cantonga.gov%2Fgov%2Fdepartments%2Frecycling.htm&psig=AOvVaw1eHfaPl2PaWQ6dSiwd4KlN&ust=1557338074524599 -->
        <img src="images/recycle.png" alt="recycles" id="recycle_pic" />
      </div>
    </div>

    <div id="home_contact_box">
      <h3 class="home_titles"><a href="contact.php">CONTACT US/FAQS</a></h3>
      <p> Have any more questions? Join our mailing list in the footer below or ask us a question! </p>
    </div>


    </figure>
  </div>
  </div>


  </div>

  <?php include("includes/footer.php"); ?>


</body>
<script src="scripts/jquery-3.4.0.min.js"></script>
<script src="scripts/slideshow.js"></script>

</html>
