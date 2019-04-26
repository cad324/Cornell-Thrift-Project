<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
$title = "CONTACT"
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
  <div class="slideshow"></div>

  <!-- Slideshow container -->
  <div class="slideshow-container">

    <!-- Full-width images with number and caption text -->
    <div class="mySlides">
      <img src="uploads/home/1.jpg" class="h_img">
      <div class="text">Caption Text</div>
    </div>

    <div class="mySlides">
      <img src="uploads/home/2.jpg" class="h_img">
      <div class="text">Caption Two</div>
    </div>

    <div class="mySlides">
      <img src="uploads/home/5.jpg" class="h_img">
      <div class="text">Caption Three</div>
    </div>

    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>
  <br>

  <div id="mission">
    <h1> WHAT WE DO </h1>
    <p> Cornell Thrift’s mission is to reduce campus‐wide waste through redistribution of reusable personal items. The initiative was inspired by the concept of “free‐piles” seen in university co‐operative housing, along with the annual Dump‐and‐Run sale. We want to see reusable clothes, homeware, electronics, and small furniture going into homes and not trashcans ‐ all year round. <p>
  </div>
  <script src="slideshow.js"></script>
  <script src="stickyheader.js"></script>

  <?php include("includes/footer.php"); ?>
</body>

</html>
