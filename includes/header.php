<?php $pages = [
        ["index.php", "HOME"], ["about.php", "ABOUT"], ["events.php", "EVENTS"],
        ["resources_tip.php", "RESOURCE TIP"], ["resources_stores.php", "RESOURCE STORES"],
        ["contact.php", "CONTACT"]
        ]; ?>

<header>
    <nav>
        <ul>
            <?php foreach($pages as $page) {
                $current = trim($_SERVER['PHP_SELF'], "/");
                if ($current === $page[0]) {
                    echo "<li><a class='current' href=$page[0]>$page[1]</a></li>";
                } else {
                    echo "<li><a href=$page[0]>$page[1]</a></li>";
                }
            }
            ?>
        </ul>
    </nav>
</header>
