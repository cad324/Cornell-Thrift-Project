<header>
  <a href="index.php"><img class="logo" src="images/logo.png" alt="logo"/></a>
  <div class="navbar" id="myHeader">
    <nav id="nav">
      <a class="home_link" href="index.php">Home</a>
      <a href="about.php">Members</a>
      <a href="events.php">Events</a>
      <a href="resources_stores.php">Stores Near By</a>
      <a href="contact.php">Contact Us</a>
      <?php if (!is_user_logged_in()) { ?>
        <!-- <form action="login.php" >
          <input type="submit" id="login_btn" value="Login">
        </form> -->
        <a class="login_btn" href="login.php">Login</a>
      <?php } else { ?>
        <form method="get" action="index.php" >
          <button class="logout_btn" type="submit" name="logout" class="login_btn" value="Logout">Logout</button>
        </form>
      <?php } ?>
    </nav>
  </div>
</header>
