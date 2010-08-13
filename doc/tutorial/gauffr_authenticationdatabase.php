<?php

if ( isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['password']) && !empty($_POST['password']) )
{
    include 'bootstrap.php';

    /*
     * Authentication of user "test" with password "test"
     */
    $user = Gauffr::authenticationDatabase($_POST['login'], $_POST['password']);

    var_dump( $user );
}
else
{ ?>

<form method="POST" action="">
    <p>login : <input type="text" name="login" value="" /></p>
    <p>password : <input type="password" name="password" /></p>
<input type="submit" value="Login" />
</form>

<?php } ?>