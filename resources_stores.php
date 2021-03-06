<?php
 include("includes/init.php");

$title = "THRIFT STORES";
// open connection to database
$db = new PDO('sqlite:secure/site.sqlite');
// Throw an exception for incorrect SQL
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['category'])) {
  $category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING);
} else {
  // No search provided, so set the category to query to NULL
  $category = NULL;
}

function print_record($record)
{
  ?>
  <tr>
    <td><?php echo htmlspecialchars($record["Name"]); ?></td>
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

      <h1>Thrift Stores in Ithaca</h1>
      <!-- <p><a target="_blank" href="http://reusetompkins.com/">http://reusetompkins.com/</a></p> -->
      <p>A <a class="text_link" target="_blank" href="http://reusetompkins.com/">comprehensive directory</a> for used furniture, clothing, books & music, computers & electronics, sports & outdoor equipment, art & sewing materials, and antiques for all of Ithaca and Tompkins County.</p>

      <!-- <ul>
      <li><a href="/resources_stores.php">All Stores </a></li>
      <li><a href="/resources_stores.php?category=Classic Thrift Stores#filter">Classic Thrift Stores</a></li>
      <li><a href="/resources_stores.php?category=Specialty Clothing">Specialty Clothing</a></li>
      <li><a href="/resources_stores.php?category=Furniture/Books/Other">Furniture/Books/Other</a></li>
      <li><a href="/resources_stores.php?category=Sewing and Alteration Supplies">Sewing and Alteration Supplies</a></li>
    </ul> -->

    <form method="get" id="filter">
        <label for="storeID">Filter by: </label>
        <select name="category">
            <option value="">All Stores</option>
            <option value="Classic Thrift Stores">Classic Thrift Stores</option>
            <option value="Specialty Clothing">Specialty Clothing</option>
            <option value="Furniture/Books/Other">Furniture/Books/Other</option>
            <option value="Sewing and Alteration Supplies">Sewing and Alteration Supplies</option>
        </select>
        <input type="submit" value="Filter"/>
    </form>

    <?php
    if (!$category) {
      // No store to query, so return everything!
      ?>
        <h2>All Stores</h2>
        <?php
      $sql = "SELECT * FROM stores";
      $params = array();
      $result = exec_sql_query($db, $sql, $params);
      } else {

      ?>
      <h2> <?php echo htmlspecialchars($category) ?></h2>
      <?php

      $sql = "SELECT * FROM stores WHERE Category LIKE '%' || :category || '%'";
      $params = array(':category' => $category);
    }



      $query = $db->prepare($sql);
      if ($query and $query->execute($params)) {
        $records = $query->fetchAll();
      }

      if (isset($records) and !empty($records)) {
        ?>
        <table>
          <tr>
            <th width="20%">Name</th>
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
