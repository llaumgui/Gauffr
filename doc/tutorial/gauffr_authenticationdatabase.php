<?php

if ( isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['password']) && !empty($_POST['password']) )
{
    if ( !isset($GLOBALS['GAUFFR_INIT']) || !$GLOBALS['GAUFFR_INIT'] )
    {
        if ( !@include 'Gauffr/gauffr.php' )
            include '../Gauffr/gauffr.php';
    }

    /*
     * Authentication of user "test" with password "test"
     */
    $user = Gauffr::authenticationDatabase($_POST['login'], $_POST['password']);

    echo "<XMP>";

    print_r( $user );

    echo "</XMP>";
}
else
{ ?>

<form method="POST" action="">
    <p>login : <input type="text" name="login" value="" /></p>
    <p>password : <input type="password" name="password" /></p>
<input type="submit" value="Login" />
</form>

<?php } ?>