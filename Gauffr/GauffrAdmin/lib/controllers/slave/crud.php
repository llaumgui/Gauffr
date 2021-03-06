<?php
/**
 * File containing the GauffrAdminGauffrSlaveCRUDController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminGauffrSlaveCRUDController classes.
 *
 * GauffrSlave CRUD
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminGauffrSlaveCRUDController extends ezcMvcController
{

	/**
	 * Do GauffrSlave edition
	 */
	public function doGauffrSlaveEdit()
    {
        // Redirect on error
        if ( !($gauffrSlave = GauffrSlave::fetchGauffrSlaveByID( (int)$this->gauffrSlaveID ) ) )
        {
            $req = new ezcMvcRequest;
            $req->uri = '/ERROR';

            return new ezcMvcInternalRedirect($req);
        }

        // Form
        if ( empty($_POST) )
        {
            $ret = new ezcMvcResult;
            $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/slave/crud', 'Edit GauffrSlave "%slave_name"', array('slave_name' => $gauffrSlave->Name) );
            $ret->variables['gauffrSlave'] = $gauffrSlave;

            return $ret;
        }
        // Edition
        else
        {
            $session = GauffrSlave::getPersistentSessionInstance();
            $gauffrSlave->Name = $_POST['GauffrSlave']['Name'];
            $gauffrSlave->Identifier = $_POST['GauffrSlave']['Identifier'];
            $gauffrSlave->Location = $_POST['GauffrSlave']['Location'];
            $gauffrSlave->HasCredential = isset($_POST['GauffrSlave']['HasCredential']) ? $_POST['GauffrSlave']['HasCredential'] : 0;

            $session->update($gauffrSlave);

            Gauffr::log( 'Update GauffrSlave "' . $gauffrSlave->Name . '" by ' . $_SESSION['gauffrAuth_id'],
            	'GauffrAdmin', GauffrLog::SYSTEM, array( "category" => "GauffrSlave", "file" => __FILE__, "line" => __LINE__ ) );

            $ret = new ezcMvcResult;
            $ret->status = new ezcMvcExternalRedirect( GauffrAdmin::buildURL('gauffrslave?edit=ok') );

            return $ret;
        }
    }



    /**
     * Do a GauffrSlave addition
     */
	public function doGauffrSlaveAdd()
    {
        $gauffrSlave = new GauffrSlave();

        // Form
        if ( empty($_POST) )
        {
            // Create an empty GauffrSlave
            $gauffrSlave->Identifier = '';
            $gauffrSlave->Name = '';
            $gauffrSlave->Location = '';
            $gauffrSlave->HasCredential = '';

            $ret = new ezcMvcResult;
            $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/slave/crud', 'Add a GauffrSlave');
            $ret->variables['gauffrSlave'] = $gauffrSlave;

            return $ret;
        }
        // Edition
        else
        {
            $session = GauffrSlave::getPersistentSessionInstance();
            $gauffrSlave->Name = $_POST['GauffrSlave']['Name'];
            $gauffrSlave->Identifier = $_POST['GauffrSlave']['Identifier'];
            $gauffrSlave->Location = $_POST['GauffrSlave']['Location'];
            $gauffrSlave->HasCredential = isset($_POST['GauffrSlave']['HasCredential']) ? $_POST['GauffrSlave']['HasCredential'] : 0;

            $session->save($gauffrSlave);

            Gauffr::log( 'Add GauffrSlave "' . $gauffrSlave->Name . '" by ' . $_SESSION['gauffrAuth_id'],
            	'GauffrAdmin', GauffrLog::SYSTEM, array( "category" => "GauffrSlave", "file" => __FILE__, "line" => __LINE__ ) );

            $ret = new ezcMvcResult;
            $ret->status = new ezcMvcExternalRedirect( GauffrAdmin::buildURL('gauffrslave?add=ok') );

            return $ret;
        }
    }



    /**
     * Do a GauffrSlave deletion
     */
    public function doGauffrSlaveDelete()
    {
        // Redirect on error
        if ( !($gauffrSlave = GauffrSlave::fetchGauffrSlaveByID( (int)$this->gauffrSlaveID ) ) )
        {
            $req = new ezcMvcRequest;
            $req->uri = '/ERROR';

            return new ezcMvcInternalRedirect($req);
        }
                // Form
        if ( empty($_POST) )
        {
            $ret = new ezcMvcResult;
            $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/slave/crud', 'Delete a GauffrSlave');
            $ret->variables['gauffrSlave'] = $gauffrSlave;

            return $ret;
        }
        else
        {
            if ( $_POST['gauffrSlaveID'] = $this->gauffrSlaveID )
            {
                $name = $gauffrSlave->Name;
                $session = GauffrSlave::getPersistentSessionInstance();
                $session->delete( $gauffrSlave );

                Gauffr::log( 'Remove GauffrSlave "' . $name . '" by ' . $_SESSION['gauffrAuth_id'],
    				'GauffrAdmin', GauffrLog::SYSTEM, array( "category" => "GauffrSlave", "file" => __FILE__, "line" => __LINE__ ) );

                $ret = new ezcMvcResult;
                $ret->status = new ezcMvcExternalRedirect( GauffrAdmin::buildURL('gauffrslave?delete=ok') );

                return $ret;
            }
        }
    }



    /**
     * Messages management
     *
     * @return array
     */
    public static function message()
    {
    	// Confirmation message
    	$messages = array(
    	    'misc' => array(),
    	    'ok' => array(),
    		'ko' => array()
    	);

    	$edit = isset( $_GET['edit'] ) ? $_GET['edit'] : false;
    	$add = isset( $_GET['add'] ) ? $_GET['add'] : false;
    	$delete = isset( $_GET['delete'] ) ? $_GET['delete'] : false;

    	if ( $edit == 'ok' )
    	    $messages['ok'][] = GauffrAdminI18n::getTranslation( 'view/slave/crud', 'The GauffrSlave has been edited.' );
    	if ( $add == 'ok' )
    	    $messages['ok'][] = GauffrAdminI18n::getTranslation( 'view/slave/crud', 'The GauffrSlave has been added.' );
    	if ( $delete == 'ok' )
    	    $messages['ok'][] = GauffrAdminI18n::getTranslation( 'view/slave/crud', 'The GauffrSlave has been deleted.' );

	    return $messages;
    }

}

?>