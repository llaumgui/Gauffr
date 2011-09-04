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
    $user = Gauffr::authenticationDatabase($_POST['login_c'], $_POST['password_c'], "gauffr_admin", false );

    var_dump( $user );
}
elseif ( isset($_POST['login_a']) && !empty($_POST['login_a']) && isset($_POST['password_a']) && !empty($_POST['password_a']) )
{
    /*
     * Authentication of user "test" with password "test"
     */
    $user = Gauffr::authenticationDatabase($_POST['login_a'], $_POST['password_a'], false, true );

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
<input type="submit" value="Login with 'gauffr_admin' credential" />
</form>

<hr />

<form method="POST" action="">
    <p>login : <input type="text" name="login_a" value="" /></p>
    <p>password : <input type="password" name="password_a" /></p>
<input type="submit" value="Login with AltLogin" />
</form>

<?php } ?>