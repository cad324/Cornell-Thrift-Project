<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
$title = "CONTACT";

// messages is an array
$messages = array();

// Max file size is 1 MB = 1000000 bytes
const MAX_FILE_SIZE = 1000000;

// User must be logged in to upload
if (isset($_POST["uploadHome"])) {

  // Filtering
  $upload_info = $_FILES["file_data"];
  var_dump($upload_info);

  //if upload sucessful then get filename and file extension
  if ($upload_info['error'] == UPLOAD_ERR_OK) {
    $filename = basename($upload_info["name"]);
    var_dump("the filename is " . $filename);
    $upload_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));


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
      $new_path = "uploads/home/" . $input_id . "." . $upload_ext;
      move_uploaded_file($upload_info["tmp_name"], $new_path);
    } else {
      array_push($messages, "Not new record.");
    }

    // upload is not successful
  } else {
    array_push($messages, "You must log in to upload an image!!");
  }
}

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
  <?php include("includes/header.php"); ?>
  <div class=wrapper>

    <div id="mission">
      <h2> WHAT WE DO </h2>
      <p> Cornell Thrift’s mission is to reduce campus‐wide waste through redistribution of reusable personal items. The initiative was inspired by the concept of “free‐piles” seen in university co‐operative housing, along with the annual Dump‐and‐Run sale. We want to see reusable clothes, homeware, electronics, and small furniture going into homes and not trashcans ‐ all year round. <p>
    </div>

    <div id="row">

      <div id="colm1">
        <figure class="homebox">
          <h3>OUR EVENTS</h3>
          <p> Find out how you can donate unused items and make a difference to the Ithaca community! </p>
          <a href="events.php"><img src="images/r2.jpg" alt="team" class="static_img" /></a>
        </figure>

        <figure class="homebox">
          <h3>JOIN US</h3>
          <p> Join our team! Get to know the eboard and how you can help out.</p>
          <a href="about.php"><img src="images/r3.jpg" alt="team" class="static_img" /> </a>
        </figure>
      </div>

      <div id="colm2">
        <figure class="homebox">
          <h3>OTHER THRIFT ACTVITIES</h3>
          <p> There are many more ways to help out! Cornell is surrounded by thrift stores. </p>
          <a href="resources_stores.php"><img src="images/r4.jpg" alt="team" class="static_img" /></a>
        </figure>

        <figure class="homebox">
          <h3>CONTACT US/FAQS</h3>
          <p> Have any more questions? Join our mailing list in the footer below or ask us a question! </p>
          <a href="contact.php"><img src="images/r2.jpg" alt="team" class="static_img" /></a>
        </figure>
      </div>
    </div>


    <div class="slideshow">
      <h2> Upcoming Event </h2>
      <?php
      $records = exec_sql_query(
        $db,
        "SELECT * FROM images"
      )->fetchAll();


      foreach ($records as $record) { ?>
        <img alt="<?php echo $record["file_name"] ?>" src="uploads/slideshow/<?php echo ($record["id"] . "." . $record["file_ext"]); ?>" class="slides">
      <?php
    }
    ?>
      <form id="home_form" action="index.php" method="post" enctype="multipart/form-data">
        <!-- Image cannot excede MAX_FILE_SIZE  -->
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
        <label for="file_data">Upload</label>
        <input id="file_data" type="file" name="file_data">
        <button name="uploadHome" type="submit">Upload to Slideshow</button>
      </form>
    </div>

  </div>

  <?php include("includes/footer.php"); ?>


</body>
<script src="scripts/jquery-3.4.0.min.js"></script>
<script src="scripts/slideshow.js"></script>

</html>
