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
            <a target="_blank" href="https://www.instagram.com/cornellthrift/?hl=en"><img class="social_img" src="images/instagram.png" alt="instagram icon" /></a>
            <cite>
                <a target="_blank" href="https://www.facebook.com/cornellthrift/"><img class="social_img" src="images/facebook.png" alt="facebook icon" /></a>
                <div>Icons made by <a href="https://www.freepik.com/" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" 			    title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" 			    title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
            </cite>
            <!-- Image sources:
            https://www.flaticon.com/free-icon/facebook_174848#term=facebook&page=1&position=1
            https://www.flaticon.com/free-icon/instagram_733614#term=instagram&page=1&position=3 -->
        </div>
    </div>
    <p id="copyright">Copyright &copy <?php echo date("Y");?>
</footer>
