<?php

include 'bootstrap.php';


/*
 * You can fetch user by different attributs
 */
$user1 = GauffrUser::fetchUserByID( 1 );
$user2 = GauffrUser::unique(GauffrUser::fetchUserByLogin( 'test' ));
$user3 = GauffrUser::unique(GauffrUser::fetchUserByMail( 'test@test.com' ));

echo "Gauffr user by id";
var_dump($user1);
echo "Gauffr user by login";
var_dump($user2);
echo "Gauffr user by mail";
var_dump($user3);

echo "<hr />";
$user1 = null; $user2 = null; $user3 = null;



/*
 * You can get credential for a GauffrUser
 */
$user = GauffrUser::fetchUserByID( 347 );

echo "Get credential for an user";
var_dump($user);

if ( $user instanceof GauffrUser )
{
	var_dump( $user->getCredential() );
    $can1 = $user->hasCredentialByID(1);
    $can2 = $user->hasCredentialByIdentifier('svn');

    $can1 = $can1 ? 'access' : 'no access';
    $can2 = $can2 ? 'access' : 'no access';
    echo $user->Login . ' has ' . $can1 . "<br />";
    echo $user->Login . ' has ' . $can2 . "<br />";
}
else
{
    echo "Not a GauffrUser";
}

echo "<hr />";
$user = null; $can1 = null; $can2 = null;


/*
 * You can get extended information for a GauffrUser
 */
$user = GauffrUser::fetchUserByID( 347 );
echo "Get extended information for an user";
var_dump($user);

if ( $user instanceof GauffrUser )
    var_dump( $user->getExtended() );
else
    echo "Not a GauffrUser";

echo "<hr />";
$user = null;



/*
 * You can fetch user with all related objects
 */
$user = GauffrUser::fetchWithRelatedObjectsUserByID( 347 );
echo "Get all information for an user";
var_dump($user);

$user = null;

?>