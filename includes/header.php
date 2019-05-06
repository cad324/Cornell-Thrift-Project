<header>
  <img class="logo" src="images/logo.png" alt="logo"/>
  <div class="navbar" id="myHeader">
    <nav id="nav">
      <a class="home_link" href="index.php">Home</a>
      <a href="about.php">Members</a>
      <a href="events.php">Events</a>
      <a href="resources_stores.php">Stores Near By</a>
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
