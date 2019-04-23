<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
$title = "HOME"
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

  <!-- TODO: This should be your main page for your site. -->
  <?php
  $records = exec_sql_query(
    $db,
    "SELECT * FROM images"
  )->fetchAll();

  if (count($records) > 0) { ?>

    <!-- get the images in slideshow -->
    <div class="slideshow-box">
      <div class="slideshow">
        <?php
        foreach ($records as $record) { ?>
          <img alt="<?php echo $record["file_name"] ?>" src="uploads/home/<?php echo ($record["id"] . "." . $record["file_ext"]); ?>">
          <div class="home_img_cap"><?php echo $record["desc"]; ?></div>
        <?php
      }
      ?>
      </div>

      <!-- buttons to move between images. Taken from w3school -->
      <a class="prev" onclick="moveSlides(-1)">&#10094;</a>
      <a class="next" onclick="moveSlides(1)">&#10095;</a>

      <div class="dots">
        <span class="dot" onclick="currentSlide(1)"></span>
        <?php
        foreach ($records as $record) { ?>
          <span class="dot" onclick="currentSlide(<?php echo $record['id']; ?>)"></span>
        <?php } ?>
      </div>
    </div>
  <?php
} else {
  echo '<p>There is no images under home.</p>';
}
?>
  <script src="slideshow.js"></script>

  <?php include("includes/footer.php"); ?>
</body>

</html>
