<?php

include 'bootstrap.php';

if ( isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['password']) && !empty($_POST['password']) )
{
    /*
     * Authentication of user "test" with password "test"
     */
    $user = Gauffr::authenticationDatabase($_POST['login'], $_POST['password']);

    var_dump( $user );
}
elseif ( isset($_POST['login_c']) && !empty($_POST['login_c']) && isset($_POST['password_c']) && !empty($_POST['password_c']) )
{
    /*
     * Authentication of user "test" with password "test"
     */
    $user = Gauffr::authenticationDatabase($_POST['login_c'], $_POST['password_c'], false, "gauffradmin");

    var_dump( $user );
}
else
{ ?>

<form method="POST" action="">
    <p>login : <input type="text" name="login" value="" /></p>
    <p>password : <input type="password" name="password" /></p>
<input type="submit" value="Login" />
</form>

<hr />

<form method="POST" action="">
    <p>login : <input type="text" name="login_c" value="" /></p>
    <p>password : <input type="password" name="password_c" /></p>
<input type="submit" value="Login with 'gauffradmin' credential" />
</form>

<?php } ?>