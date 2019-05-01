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
    <p>Sign up for our mailing list</p>
    <?php echo "<p class='success'>$msg_to_user</p>";?>
    <form method="post" action="">
        <label for="email_list">Email: </label>
        <input name="email" type="email" id="email_list"/>
        <input type="submit" name="join" value="Subscribe"/>
    </form>
    <p id="copyright">Copyright &copy <?php echo date("Y");?>
</footer>
