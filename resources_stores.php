<?php
 // INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
$title = "THRIFT STORES";
$db = new PDO('sqlite:resource.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['category'])) {
  $category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING);
} else {
  // No search provided, so set the product to query to NULL
  $category = NULL;
}

function print_record($record) {
  ?>
  <tr>
    <td><?php echo htmlspecialchars($record["Name"]);?></td>
    <td><?php echo htmlspecialchars($record["Address"]);?></td>
    <td><?php echo htmlspecialchars($record["Description"]);?></td>
    <td><?php echo htmlspecialchars($record["Hours"]);?></td>
    <td><?php echo htmlspecialchars($record["Price"]);?></td>
  </tr>
  <?php
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

  <!-- TODO: This should be your main page for your site. -->
  <?php include("includes/header.php"); ?>
  <div id="content-wrap">
  <div class= "resource_body">

    <h1><u>Thrift Stores in Ithaca</u></h1>
    <p><a target="_blank" href="http://reusetompkins.com/">http://reusetompkins.com/</a></p>
    <p>A comprehensive directory for used furniture, clothing, books & music, computers & electronics, sports & outdoor equipment, art & sewing materials, and antiques for all of Ithaca and Tompkins County.</p>
    <ul>
      <li><a href="/resources_stores.php">All Stores</a></li>
      <li><a href="/resources_stores.php?category=Classic Thrift Stores">Classic Thrift Stores</a></li>
      <li><a href="/resources_stores.php?category=Specialty Clothing">Specialty Clothing</a></li>
      <li><a href="/resources_stores.php?category=Furniture/Books/Other">Furniture/Books/other</a></li>
      <li><a href="/resources_stores.php?category=Sewing and Alteration Supplies">Sewing & Alteration Supplies</a></li>
    </ul>

    <?php
    if ( is_null($category) ) {
      // No store to query, so return everything!
      ?>
      <h2>All Stores</h2>
      <?php

      $sql = "SELECT * FROM stores";
      $params = array();
    } else {
      // We have a specific category of store to query!
      ?>
      <h2><?php echo htmlspecialchars($category) ?></h2>
      <?php

      $sql = "SELECT * FROM stores WHERE Category LIKE '%' || :category || '%'";
      $params = array(':category' => $category);
    }

    try {
      $query = $db->prepare($sql);
      if ($query and $query->execute($params)) {
        $records = $query->fetchAll();
      }
    } catch(PDOException $e) {
      handle_db_error($e);
    }

    if (isset($records) and !empty($records)) {
      ?>
      <table>
        <tr>
          <th width = "20%">Name</th>
          <th width = "20%">Address</th>
          <th width = "40%">Description</th>
          <th width = "12%">Hours</th>
          <th width = "8%">Price</th>
        </tr>
        <?php

        foreach($records as $record) {
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
