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
$user = GauffrUser::fetchUserByID( 1 );

echo "Get credential for an user";
var_dump($user);

if ( $user instanceof GauffrUser )
{
    $can1 = $user->hasCredentialByID(1);
    //$can2 = $user->hasCredentialByIdentifier('svn');

    $can1 = $can1 ? 'access' : 'no access';
    $can2 = $can2 ? 'access' : 'no access';
    echo $user->Login . ' has ' . $can1 . "\n";
    echo $user->Login . ' has ' . $can2 . "\n";
}
else
{
    echo "Not a GauffrUser";
}
/*
echo "</XMP>";

echo "<hr />";

$user = null;
$can1 = null;
$can2 = null;



/*
 * You can get extended information for a GauffrUser
 * /
echo "<XMP>";
$user = GauffrUser::fetchUserByID( 1 );
print_r($user);

if ( $user instanceof GauffrUser )
{
    print_r( $user->getExtended() );
}
else
{
    echo "Not a GauffrUser";
}

echo "</XMP>";
echo "<hr />";

$user = null;



/*
 * You can fetch user with all related objects
 * /
$user = GauffrUser::fetchWithRelatedObjectsUserByID( 1 );
echo "<XMP>";
print_r($user);
echo "</XMP>";
echo "<hr />";

$user = null;*/

?>