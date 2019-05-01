<header>

  <div class="navbar" id="myHeader">
    <nav id="nav">
      <a href="index.php">Home</a>
      <a href="about.php">About</a>
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
      <a href="contact.php">Contact</a>
    </nav>
    <?php if (!is_user_logged_in()) { ?>
      <button id="login_btn"><a href="login.php">Login</a></button>
    <?php } else { ?>
      <button id="login_btn"><a href='index.php?logout'>Logout</a></button>
    <?php } ?>
  </div>
</header>
