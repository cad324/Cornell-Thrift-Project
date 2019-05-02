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
    $image_id = $_GET["modify"];
    $image_name = get_image_name($image_id);
    $image_job = get_image_job($image_id);
    $image_ext = get_image_ext($image_id);
    $link = "uploads/images/".$image_id.".".$image_ext;
    $success = TRUE;
    $modify_member = 'modify_member.php?' . http_build_query(array('modify' => $image_id) );

    if ( isset($_POST["modify"]) && is_user_logged_in() ) {
        $upload_name= $_POST['name'];
        $upload_position= $_POST['position'];
        $upload_info = $_FILES["file_input"];
        var_dump($upload_info);
        $image_name = $upload_name;
        $image_job = $upload_position;

        if ($upload_name == NULL){
            $message = "Modify unsuccessful! Please enter the name of the new member";
            $success = FALSE;
        }
        elseif ($upload_position == NULL){
            $message = "Modify unsuccessful! Please enter the position of the new member";
            $success = FALSE;
        }
        else {
            update_name($image_id,$upload_name);
            update_position($image_id,$upload_position);
        }

        if($upload_info['error'] == UPLOAD_ERR_INI_SIZE || $upload_info['error'] == UPLOAD_ERR_FORM_SIZE){
            $message = "Sorry! Your file exceeds the maximum filesize for uploads. Please select a smaller file and try again!";
            $success = FALSE;
        }
        else if($upload_info['error'] == UPLOAD_ERR_PARTIAL){
            $message = "Sorry! Your file was uploaded partially. Please try again!";
            $success = FALSE;
        }
        else if ($upload_info != NULL){
            $upload_info = $_FILES["file_input"];
            $upload_ext = strtolower(pathinfo($upload_info["name"], PATHINFO_EXTENSION));
            var_dump($upload);
            update_ext($image_id,$upload_ext);
            $new_path = "uploads/images/".$image_id.".".$upload_ext;
            move_uploaded_file($upload_info['tmp_name'], $new_path);
        }

        if ($success){
            $message = "Upload successful!";
        }
    }

      ?>

<body>
    <div>
        <h2>Modify Members</h2>

        <form id="members" method="post" action="<?php $modify_member ?>">

        <div class = "textbox">
            <a href = <?php echo($link);?>><img id = "pic" src = <?php echo($link);?> alt = <?php echo($image_name);?>/></a>
        </div>

        <div class = "textbox">
            <label for="input">Profile(Optional): </label>
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

    <?php if ($message){
    ?>
    <p class = "message"><?php echo ($message);?></p>
    <?php
  }
  ?>
  <p class = "message">*Back to <a href = "about.php#footor">Members</a> Page</p>

    </body>
</html>
