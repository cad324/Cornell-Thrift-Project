<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
include("includes/heads.php");
include("includes/header.php");
$title = "ABOUT"
?>
<!DOCTYPE html>
<html lang="en">

<body id="about">
  <!-- TODO: This should be your main page for your site. -->
  <h1>Meet Our Members!</h1>

  <?php
  if (is_user_logged_in()) {
    ?>
    <p id="ad">Click <a href="add_member.php">Here</a> to add a new member to the Eboard!</p>
  <?php
  }
  else{
  ?>
    <p id="note">*Login to modify the Members Page if you are an Eboard member.</p>
  <?php
  }
  ?>

  <div class="row">
    <?php
    if (isset($_GET['delete_image']) || isset($_POST['delete_image'])) {
      delete_image($_GET['delete_image']);
    }

    $sql = "SELECT id, image_name, ext, job from about_images";
    $params = array();
    $records = exec_sql_query($db, $sql, $params)->fetchAll();
    if ($records) {
      foreach ($records as $record) {
        $image_id = $record['id'];
        $src = "uploads/images/" . $image_id . "." . $record['ext'];
        $name = $record['image_name'];
        $job = $record['job'];
        $div_id = "img".$image_id;
        $div_link = "about.php#img".$image_id;

        ?>
        <figure id = "<?php echo($div_id) ?>">
          <a href=<?php echo ($src); ?>><img src=<?php echo ($src); ?> class="eboard" alt=<?php echo ($name); ?> /></a>

          <figcaption>
            <p>Name: <?php echo ($name); ?></p>
            <p>Position: <?php echo ($job); ?></p>

            <div>
              <?php
              if (is_user_logged_in()) {
                $delete_image = htmlspecialchars($_SERVER['PHP_SELF']) . '?' . http_build_query(array('delete_image' => $record['id']));
                ?>
                <a href=<?php echo ($delete_image) ?>>Delete Member</a>
              <?php }
            ?>
            </div>

            <div>
              <?php
              if (is_user_logged_in()) {
                $modify_member = 'modify_member.php?' . http_build_query(array('modify' => $image_id));
                ?>
                <a href=<?php echo ($modify_member) ?>>Modify Member's Information</a>
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

  <div id = "end">
  </div>

  <script src="stickyheader.js"></script>
  <?php
  // INCLUDE ON EVERY TOP-LEVEL PAGE!
  include("includes/footer.php");
  ?>
</body>

</html>
