<?php

if ( !@include 'Gauffr/gauffr.php' )
    include '../Gauffr/gauffr.php';


$object = GauffrUser::fetchUserByID( 1 );
echo "<XMP>";
print_r($object);
echo "</XMP>";
$object = null;

echo "<hr />";

$object = GauffrUser::unique(GauffrUser::fetchUserByLogin( 'test' ));
echo "<XMP>";
print_r($object);
echo "</XMP>";
$object = null;

echo "<hr />";

$object = GauffrUser::fetchUserByMail( 'test@test.com' );
echo "<XMP>";
print_r($object);
echo "</XMP>";
$object = null;

echo "<hr />";

?>