<header>
  <div class="navbar" id="myHeader">
    <a id="logo_a" href="index.php"><img class="logo" src="images/logo.png" alt="logo" /></a>
    <nav id="nav">
      <a class="home_link" href="index.php">Home</a>
      <a href="about.php">Members</a>
      <a href="events.php">Events</a>
      <div class="dropdown">
        <button class="dropbtn">Resources
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="resources_stores.php">Thrift Stores</a>
          <a href="resources_tip.php">Thrift Tips</a>
        </div>
      </div>
      <a href="contact.php">Contact Us</a>
      <?php if (!is_user_logged_in()) { ?>
        <form action="login.php" >
          <input type="submit" id="login_btn" value="Login">
        </form>
      <?php } else { ?>
        <form method="get" action="index.php" >
          <input type="submit" name="logout" id="login_btn" value="Logout"/>
        </form>
      <?php } ?>
    </nav>
  </div>
</header>
