<?php
 // INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
include("includes/header.php");
include("includes/footer.php");
$title = "ABOUT"
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css">
  <title><?php echo $title; ?></title>
</head>

<body id = "about">

  <!-- TODO: This should be your main page for your site. -->
  <p id = "ad">Meet Our Members!</p>
  <h1>E-Board Members</h1>
  <p>Description:</p>
  <div class = "row">
    <div>
        <a><img src = "uploads/images/img-placeholder.jpg" alt = "placeholder image"/></a>

        <figcaption>
          <p>Name:</p>
          <p>Position:</p>
          <p>Description:</p>
        </figcaption>

    </div>

    <div>
        <a><img src = "uploads/images/img-placeholder.jpg" alt = "placeholder image"/></a>

        <figcaption>
          <p>Name:</p>
          <p>Position:</p>
          <p>Description:</p>
        </figcaption>

    </div>

    <div>
        <a><img src = "uploads/images/img-placeholder.jpg" alt = "placeholder image"/></a>

        <figcaption>
          <p>Name:</p>
          <p>Position:</p>
          <p>Description:</p>
        </figcaption>

    </div>
  </div>

  <h1>Committees</h1>
  <p>Description:</p>
  <div class = "row">
    <div>
        <a><img src = "uploads/images/img-placeholder.jpg" alt = "placeholder image"/></a>

        <figcaption>
          <p>Name:</p>
          <p>Position:</p>
          <p>Description:</p>
        </figcaption>

    </div>

    <div>
        <a><img src = "uploads/images/img-placeholder.jpg" alt = "placeholder image"/></a>

        <figcaption>
          <p>Name:</p>
          <p>Position:</p>
          <p>Description:</p>
        </figcaption>

    </div>

    <div>
        <a><img src = "uploads/images/img-placeholder.jpg" alt = "placeholder image"/></a>

        <figcaption>
          <p>Name:</p>
          <p>Position:</p>
          <p>Description:</p>
        </figcaption>

    </div>
  </div>

  <div>
    <h2>Add/Modify Members</h2>

    <form id = "members" method="post" action="add_tag.php">

    <div class = "textbox">
      <label for = "category_branch">Branch:</label>
      <select name="category_branch">
        <option value="E-Board">E-Board</option>
        <option value="Commitees">Commitees</option>
      </select>
    </div>

    <div class = "textbox">
      <label for="name">Name: </label>
      <input type="text" name="name"/>
    </div>

    <div class = "textbox">
      <label for="position">Position: </label>
      <input type="text" name="position"/>
    </div>

    <div class = "textbox">
      <label for="intro">Description: </label>
      <input type="textfield" name="intro"/>
    </div>

    <div id="add_buttom" >
      <input type="submit" name="addmodify" value="Add/Modify " class = "submit"/>
    </div>
  </div>

</body>
</html>
