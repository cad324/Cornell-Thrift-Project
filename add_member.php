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
    <div>
        <h2>Add Members</h2>

        <form id="members" method="post" action="add_tag.php">

        <div class = "textbox">
            <label for="input">Profile: </label>
            <input type="file" name="file_input"/>
        </div>

        <div class="textbox">
            <label for="name">Name: </label>
            <input type="text" name="name" />
        </div>

        <div class="textbox">
            <label for="position">Position: </label>
            <input type="text" name="position" />
        </div>

        <div class="add_buttom">
            <input type="submit" name="add" value="Add " class="submit" />
        </div>
    </div>

    </body>
</html>
