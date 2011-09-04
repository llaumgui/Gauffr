<?php

include 'bootstrap.php';

echo '<h1>GauffrUser fetches</h1>';

/*
 * Fetch GauffrUser by id
 */
if ( isset($_POST['gauffruser_id']) && !empty($_POST['gauffruser_id']) )
{
    if ( $_POST['fetch_with_related_objects'] )
    {
        /*
         * You can fetch user with all related objects
         */
		$user = GauffrUser::fetchWithRelatedObjectsUserByID( $_POST['gauffruser_id'] );
		echo "Get all information for an user";
		var_dump($user);
		$user = null;
    }
    else
    {
        $user = GauffrUser::fetchUserByID( $_POST['gauffruser_id'] );
        var_dump( $user );

        // Fetch GauffrUserExtended
        if ( $user instanceof GauffrUser && isset($_POST['fetch_with_extended']) )
            var_dump( $user->getExtended() );

        $user = null;
    }
}

/*
 * Fetch GauffrUser by login
 */
elseif ( isset($_POST['gauffruser_login']) && !empty($_POST['gauffruser_login']) )
{
    $user = GauffrUser::fetchUserByLogin( $_POST['gauffruser_login'] );
    var_dump( $user );

    // Fetch GauffrUserExtended
    $user = GauffrUser::unique($user);
    if ( $user instanceof GauffrUser && isset($_POST['fetch_with_extended']) )
        var_dump( $user->getExtended() );

    $user = null;
}

/*
 * Fetch GauffrUser by email
 */
elseif ( isset($_POST['gauffruser_email']) && !empty($_POST['gauffruser_email']) )
{
    $user = GauffrUser::unique(GauffrUser::fetchUserByMail( $_POST['gauffruser_email'] ));
    var_dump( $user );

    // Fetch GauffrUserExtended
    if ( $user instanceof GauffrUser && isset($_POST['fetch_with_extended']) )
        var_dump( $user->getExtended() );

    $user = null;
}

/*
 * You can get credential for a GauffrUser
 */
elseif ( isset($_POST['gauffruser_login_c']) && !empty($_POST['gauffruser_login_c']) && isset($_POST['credential']) && !empty($_POST['credential']) )
{
    $user = GauffrUser::unique( GauffrUser::fetchUserByLogin($_POST['gauffruser_login_c']) );
    if ( $user instanceof GauffrUser )
    {
        echo 'User: ', $_POST['gauffruser_login_c'];
        var_dump($user);

        echo 'Get credential';
    	var_dump( $user->getCredential() );

    	if ( is_numeric($_POST['credential']) )
    	    $can = $user->hasCredentialByID($_POST['credential']);
	    else
            $can = $user->hasCredentialByIdentifier($_POST['credential']);

        $can = $can ? 'access' : 'no access';
        echo $user->Login, ' has ', $can . "<br />";
    }
    else
    {
        var_dump($user);
        echo $_POST['gauffruser_login_c'], ' is not a GauffrUser';
    }

    $user = null;
}
else
{ ?>

<h2>Fetch GauffrUser by id</h2>
<form method="POST" action="">
    <p>id: <input type="text" name="gauffruser_id" value="1" /></p>
	<input type="submit" name="fetch" value="Fetch" />
	<input type="submit" name="fetch_with_extended" value="Fetch extended" />
	<input type="submit" name="fetch_with_related_objects" value="Fetch  with related objects" />
</form>

<hr />

<h2>Fetch GauffrUser by login</h2>
<form method="POST" action="">
    <p>login: <input type="text" name="gauffruser_login" value="test" /></p>
	<input type="submit" name="fetch" value="Fetch" />
	<input type="submit" name="fetch_with_extended" value="Fetch extended" />
</form>

<hr />

<h2>Fetch GauffrUser by email</h2>
<form method="POST" action="">
    <p>email: <input type="text" name="gauffruser_email" value="test@test.com" /></p>
	<input type="submit" name="fetch" value="Fetch" />
	<input type="submit" name="fetch_with_extended" value="Fetch extended" />
</form>

<hr />

<h2>Get credential for a GauffrUser</h2>
<form method="POST" action="">
    <p>login: <input type="text" name="gauffruser_login_c" value="test" /></p>
    <p>Credential (identifier or id): <input type="text" name="credential" value="gauffr_admin" /></p>
	<input type="submit" value="Fetch" />
</form>

<?php } ?>