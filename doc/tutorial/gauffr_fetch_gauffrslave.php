<?php

include 'bootstrap.php';

echo '<h1>GauffrSlave fetches</h1>';

if ( isset($_POST['slave_identifier']) && !empty($_POST['slave_identifier']) )
{
    /*
     * You can fetch GauffrSlave by Identifier
     */
    $slave = GauffrSlave::unique(GauffrSlave::fetchSlaveByIdentifier( $_POST['slave_identifier'] ));

    echo '<h2>Get GauffrSlave by identifier</h2>';
    var_dump( $slave );
    $slave = null;
}
else
{
    /*
     * GauffrSlave is a eZC Persistent Object
     */
    $persistentSession = GauffrSlave::getPersistentSessionInstance();
    $q = $persistentSession->createFindQuery('GauffrSlave' );
    $slave = $persistentSession->find( $q, 'GauffrSlave' );

    echo '<h2>All GauffrSlaves</h2>';
    var_dump( $slave );
    $slave = null;
?>

    <hr />
    <h2>Fetch GauffrSlave by identifier</h2>
    <form method="POST" action="">
        <p>GauffrSlave identifier: <input type="text" name="slave_identifier" value="gauffr_admin" /></p>
		<input type="submit" value="Fetch GauffrSlave by identifier" />
    </form>
<?php } ?>