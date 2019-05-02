<?php

include("includes/init.php");

$messages = array();

// get image data
$records3 = exec_sql_query(
  $db,
  "SELECT * FROM images"
)->fetchAll();


//Delete Images
if (isset($_POST["delt_img"])) {
  $id = $_POST["id"];
  $params_for_delt = array(
    ':id' => $id
  );
  $sql_for_delt = "DELETE FROM images WHERE id = :id;";
  $result = exec_sql_query($db, $sql_for_delt, $params_for_delt);
  $file_path = " uploads/slideshow/" . $id . $sql_for_delt[0]['file_ext'];

  unlink($file_path);

  // get image data
  $records3 = exec_sql_query(
    $db,
    "SELECT * FROM images"
  )->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include("includes/heads.php"); ?>

<body>
  <?php include("includes/header.php"); ?>

  <div class="wrapper">

    <?php
    foreach ($records3 as $record) { ?>
      <img alt="<?php echo $record["file_name"] ?>" src="uploads/slideshow/<?php echo ($record["id"] . "." . $record["file_ext"]); ?>" class="slides">

      <form id="deleteImage" method="POST" action="home_delt.php">
        <input type="hidden" name="id" value="<?php echo $record[0]["id"] ?>">
        <button name="delt_img" type="submit">Delete Image from slideshow</button>
      </form>

    <?php
  }
  ?>

  </div>

  <?php include("includes/footer.php"); ?>
</body>

</html>
