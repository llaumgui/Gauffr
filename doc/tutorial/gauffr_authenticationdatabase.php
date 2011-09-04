<?php

include 'bootstrap.php';

echo '<h1>Gauffr AuthenticationDatabase</h1>';

/*
 * Authentication of user "test" with password "test"
 */
if ( isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['password']) && !empty($_POST['password']) )
{
    $user = Gauffr::authenticationDatabase($_POST['login'], $_POST['password']);
    var_dump( $user );
    $user = null;
}

/*
 * Authentication of user "test" with password "test"
 */
elseif ( isset($_POST['login_c']) && !empty($_POST['login_c']) && isset($_POST['password_c']) && !empty($_POST['password_c']) )
{
    $user = Gauffr::authenticationDatabase($_POST['login_c'], $_POST['password_c'], "gauffr_admin", false );
    var_dump( $user );
    $user = null;
}

/*
 * Authentication of user "test" with password "test"
 */
elseif ( isset($_POST['login_a']) && !empty($_POST['login_a']) && isset($_POST['password_a']) && !empty($_POST['password_a']) )
{
    $user = Gauffr::authenticationDatabase($_POST['login_a'], $_POST['password_a'], false, true );
    var_dump( $user );
    $user = null;
}
else
{ ?>

<h2>Login with login / password</h2>
<form method="POST" action="">
    <p>login: <input type="text" name="login" value="" /></p>
    <p>password: <input type="password" name="password" /></p>
	<input type="submit" value="Login" />
</form>

<hr />

<h2>Login with login / password and "gauffr_admin" credential</h2>
<form method="POST" action="">
    <p>login: <input type="text" name="login_c" value="" /></p>
    <p>password: <input type="password" name="password_c" /></p>
	<input type="submit" value="Login with 'gauffr_admin' credential" />
</form>

<hr />

<h2>Login with AltLogin / password</h2>
<form method="POST" action="">
    <p>login: <input type="text" name="login_a" value="" /></p>
    <p>password: <input type="password" name="password_a" /></p>
	<input type="submit" value="Login with AltLogin" />
</form>

<?php } ?>