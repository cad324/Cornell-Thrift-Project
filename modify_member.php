<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
$title = "Modify Member"
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css">
  <title><?php echo $title; ?></title>
</head>

<?php
    $image_id = $_GET['modify'];
    $image_name = get_image_name($image_id);
    $image_job = get_image_job($image_id);
    $image_ext = get_image_ext($image_id);
    $link = "uploads/images/".$image_id.".".$image_ext;

    if ( isset($_POST["modify"]) && is_user_logged_in() ) {
        $upload_name= $_POST['name_input'];
        $upload_position= $_POST['position_input'];
        $upload_info = $_FILES["file_input"];

    if ($upload_info['error'] == UPLOAD_ERR_OK){

        $upload_name = filter_input(INPUT_POST, 'name_input', FILTER_SANITIZE_STRING);
        $upload_ext = strtolower(pathinfo($upload_info["name"], PATHINFO_EXTENSION));
        $upload_position = filter_input(INPUT_POST, 'position_input', FILTER_SANITIZE_STRING);
        if ($image_name != $upload_name){
            update_name($image_id);
        }
        if ($image_name != $upload_name){
        update_name($image_id);
        }

      ?>

<body>
    <div>
        <h2>Modify Members</h2>

        <form id="members" method="post" action="add_tag.php">

        <div class = "textbox">
            <a href = <?php echo($link);?>><img src = <?php echo($link);?> alt = <?php echo($image_name);?>/></a>
        </div>

        <div class = "textbox">
            <label for="input"> New Profile(Optional): </label>
            <input type="file" name="file_input"/>
        </div>

        <div class="textbox">
            <label for="name">Name: </label>
            <input type="text" name="name" value = "<?php echo($image_name) ?>"/>
        </div>

        <div class="textbox">
            <label for="position">Position: </label>
            <input type="text" name="position" value = "<?php echo($image_job) ?>"/>
        </div>

        <div class="add_buttom">
            <input type="submit" name="modify" value="Modify " class="submit" />
        </div>
    </div>

    </body>
</html>
