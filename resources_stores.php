<?php
 include("includes/init.php");

$title = "THRIFT STORES";
// open connection to database
$db = new PDO('sqlite:resource.sqlite');
// Throw an exception for incorrect SQL
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


function print_record($record)
{
  ?>
  <tr>
    <td><?php echo htmlspecialchars($record["Name"]); ?></td>
    <td><?php echo htmlspecialchars($record["Category"]); ?></td>
    <td><?php echo htmlspecialchars($record["Address"]); ?></td>
    <td><?php echo htmlspecialchars($record["Description"]); ?></td>
    <td><?php echo htmlspecialchars($record["Hours"]); ?></td>
    <td><?php echo htmlspecialchars($record["Price"]); ?></td>
  </tr>
<?php
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include("includes/heads.php"); ?>

<body>

  <!-- TODO: This should be your main page for your site. -->
  <?php include("includes/header.php"); ?>
  <div id="content-wrap">
    <div class="resource_body">

      <h1><u>Thrift Stores in Ithaca</u></h1>
      <p><a target="_blank" href="http://reusetompkins.com/">http://reusetompkins.com/</a></p>
      <p>A comprehensive directory for used furniture, clothing, books & music, computers & electronics, sports & outdoor equipment, art & sewing materials, and antiques for all of Ithaca and Tompkins County.</p>

        <h2>All Stores</h2>
        <?php


      $sql = "SELECT * FROM stores";
      $params = array();
      $result = exec_sql_query($db, $sql, $params);


      $query = $db->prepare($sql);
      if ($query and $query->execute($params)) {
        $records = $query->fetchAll();
      }

      if (isset($records) and !empty($records)) {
        ?>
        <table>
          <tr>
            <th width="20%">Name</th>
            <th width="20%">Category</th>
            <th width="20%">Address</th>
            <th width="40%">Description</th>
            <th width="12%">Hours</th>
            <th width="8%">Price</th>
          </tr>
          <?php

          foreach ($records as $record) {
            print_record($record);
          }
          ?>
        </table>
      <?php
    } else {
      echo "<p>No information about " . htmlspecialchars($category) . ".</p>";
    }
    ?>
    </div>
  </div>

  <?php include("includes/footer.php"); ?>
</body>

</html>
