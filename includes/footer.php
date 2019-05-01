<?php
 if (isset($_POST["join"])) {
    $email = filter_var($_GET["email"], FILTER_SANITIZE_EMAIL);
    $mail_sql = "INSERT INTO mail_list(email) VALUES(:email);";
    $mail_param = array(
        ':email' => $email
    );
    exec_sql_query($db, $mail_sql, $mail_param);
    $msg_to_user = "&#9745; You successfully added your email to our mailing list";
 }
?>

<footer>
    <div id="footer_content">
        <div>
            <p>Sign up for our mailing list</p>
            <?php echo "<p class='success'>$msg_to_user</p>";?>
            <form method="post" action="">
                <label for="email_list">Email: </label>
                <input name="email" type="email" id="email_list"/>
                <input type="submit" name="join" value="Subscribe"/>
            </form>
        </div>
        <div>
            <p id="footer_contact">Contact Us</p>
            <a href="mailto:cornellthrift@gmail.com">cornellthrift@gmail.com</a>
            <p>Social</p>
            <a href="https://www.facebook.com/cornellthrift/"><img width="25" src="images/facebook.png" alt="facebook icon" /></a>
            <a href="https://www.instagram.com/cornellthrift/?hl=en"><img width="25" src="images/instagram.png" alt="instagram icon" /></a>
        </div>
    </div>
    <p id="copyright">Copyright &copy <?php echo date("Y");?>
</footer>
