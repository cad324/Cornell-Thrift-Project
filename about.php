<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
include("includes/header.php");
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

<body id="about">
  <!-- TODO: This should be your main page for your site. -->
  <h1>Meet Our Members!</h1>

  <?php
  if (is_user_logged_in()){
    ?>
    <p id = "ad">Click <a href = "add_member.php">Here</a> to add a new member to the Eboard!</p>
  <?php
  }
  ?>

  <div class = "row">
  <?php
  if (isset($_GET['delete_image']) || isset($_POST['delete_image'])){
    delete_image($_GET['delete_image']);
  }

  $sql = "SELECT id, image_name, ext, job from about_images";
  $params = array();
  $records = exec_sql_query($db, $sql, $params)->fetchAll();
  if ($records) {
    foreach ($records as $record){
      $image_id = $record['id'];
      $src = "uploads/images/".$image_id.".".$record['ext'];
      $name = $record['image_name'];
      $job = $record['job'];

      ?>
      <figure>
        <a href = <?php echo($src);?>><img src = <?php echo($src);?> alt = <?php echo($name);?>/></a>

        <figcaption>
          <p>Name: <?php echo($name);?></p>
          <p>Position: <?php echo($job);?></p>

          <div>
            <?php
            if (is_user_logged_in()){
              $delete_image = htmlspecialchars( $_SERVER['PHP_SELF'] ) . '?' . http_build_query(array('delete_image' => $record['id']) );
            ?>
            <a href = <?php echo($delete_image)?>>Delete Memeber</a>
            <?php }
            ?>
          </div>

          <div>
            <?php
            if (is_user_logged_in()){
              $modify_member = 'modify_member.php?' . http_build_query(array('modify' => $image_id) );
            ?>
            <a class = "<?php echo $modify_memberactive; ?>" href = <?php echo($modify_member)?>>Modify Member's Information</a>
            <?php }
            ?>
          </div>
          </figcaption>
      </figure>
    <?php
    }
  }
  ?>
  </div>

  <script src="stickyheader.js"></script>
  <?php
  // INCLUDE ON EVERY TOP-LEVEL PAGE!
  include("includes/footer.php");
  ?>
</body>

</html>
