<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
$title = "Add Member";
const MAX_FILE_SIZE = 1000000;

if ( isset($_POST["add"]) && is_user_logged_in() ) {
    $upload_name= $_POST['name_input'];
    $upload_position= $_POST['position_input'];
    $upload_info = $_FILES["file_input"];

    if ($upload_info['error'] == UPLOAD_ERR_OK){

      $upload_name = filter_input(INPUT_POST, 'name_input', FILTER_SANITIZE_STRING);
      $upload_ext = strtolower(pathinfo($upload_info["name"], PATHINFO_EXTENSION));
      $upload_position = filter_input(INPUT_POST, 'position_input', FILTER_SANITIZE_STRING);

      if ($upload_name == NULL){
        $message = "Upload unsuccessful! Please enter the name of the new member";
      }
      else if ($upload_position == NULL){
        $message = "Upload unsuccessful! Please enter the position of the new member";
      }
      else{
        $sql = "INSERT INTO about_images (image_name, ext, job) VALUES (:upload_name, :upload_ext, :upload_position);";
        $params = array(
            ':upload_name' => $upload_name,
            ':upload_ext' => $upload_ext,
            ':upload_position' => $upload_position
        );
        $result = exec_sql_query($db, $sql, $params);

        $id_number = $db->lastInsertId("id");
        if($result){
            $new_path = "uploads/images/".$id_number.".".$upload_ext;
            move_uploaded_file($upload_info['tmp_name'], $new_path);
        }
        $message = "Upload successful!";
      }
    }
    else if($upload_info['error'] == UPLOAD_ERR_INI_SIZE || $upload_info['error'] == UPLOAD_ERR_FORM_SIZE){
      $message = "Sorry! Your file exceeds the maximum filesize for uploads. Please select a smaller file and try again!";
    }
    else if($upload_info['error'] == UPLOAD_ERR_PARTIAL){
      $message = "Sorry! Your file was uploaded partially. Please try again!";
    }
    else if ($upload_info ['error'] == UPLOAD_ERR_NO_FILE){
        $message = "Upload unsuccessful! Please upload a profile of the new member";
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
    <div>
        <h2>Add Members</h2>

        <form id="members" method="post" action="add_member.php" enctype="multipart/form-data">

        <div class = "textbox">
            <label for="input">Profile: </label>
            <input type="file" name="file_input" value="<?php echo $upload_info;?>"/>
        </div>

        <div class="textbox">
            <label for="name">Name: </label>
            <input type="text" name="name_input" value="<?php echo $upload_name;?>"/>
        </div>

        <div class="textbox">
            <label for="position">Position: </label>
            <input type="text" name="position_input" value="<?php echo $upload_position;?>"/>
        </div>

        <div class="add_buttom">
            <input type="submit" name="add" value="Add " class="submit" />
        </div>
    </div>

    <?php if ($message){
    ?>
    <p class = "message"><?php echo ($message);?></p>
    <?php
  }
  ?>
  <p class = "message">*Back to <a href = "about.php#footor">Members</a> Page</p>

    </body>
</html>
