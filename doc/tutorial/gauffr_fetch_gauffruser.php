<?php

if ( !isset($GLOBALS['GAUFFR_INIT']) || !$GLOBALS['GAUFFR_INIT'] )
{
    if ( !@include 'Gauffr/gauffr.php' )
        include '../Gauffr/gauffr.php';
}

$user = GauffrUser::fetchUserByID( 1 );
$can1 = $user->hasCredentialByID(1);
$can2 = $user->hasCredentialByIdentifier('svn');

echo "<XMP>";
print_r($user);
print_r($can1);
print_r($can2);
echo "</XMP>";
$user = null;
$can1 = null;

echo "<hr />";

$user = GauffrUser::fetchUserByID( 1 );
if ( $user instanceof GauffrUser ) $credential = GauffrUser::getCredential( $user );
echo "<XMP>";
print_r($user);
print_r($credential);
echo "</XMP>";
$user = null;
$credential = null;

echo "<hr />";

$user = GauffrUser::unique(GauffrUser::fetchUserByLogin( 'test' ));
if ( $user instanceof GauffrUser ) $credential = GauffrUser::getCredential( $user );
echo "<XMP>";
print_r($user);
print_r($credential);
echo "</XMP>";
$user = null;
$credential = null;

echo "<hr />";

$user = GauffrUser::fetchUserByMail( 'test@test.com' );
echo "<XMP>";
print_r($user);
echo "</XMP>";
$user = null;

echo "<hr />";

?>