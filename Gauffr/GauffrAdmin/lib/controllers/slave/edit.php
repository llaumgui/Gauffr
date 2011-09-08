<?php
/**
 * File containing the GauffrAdminGauffrSlaveEditController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminGauffrSlaveEditController classes.
 *
 * GauffrSlave edition
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminGauffrSlaveEditController extends ezcMvcController
{

	/**
	 * Do users
	 */
	public function doGauffrSlaveEdit()
    {
        $gauffrSlave = false;

        // Redirect on error
        if ( (int)$this->gauffrSlaveID > 0 && !($gauffrSlave = GauffrSlave::fetchGauffrSlaveByID( (int)$this->gauffrSlaveID ) ) )
        {
            $req = new ezcMvcRequest;
            $req->uri = '/ERROR';
            return new ezcMvcInternalRedirect($req);
        }

        // Form
        if ( empty($_POST) )
        {
            $ret = new ezcMvcResult;
            $ret->variables['pageName'] = $gauffrSlave !== false ?
                GauffrAdminI18n::getTranslation( 'view/slave/edit', 'Edit GauffrSlave "%slave_name"', array('slave_name' => $gauffrSlave->Name) ) :
                GauffrAdminI18n::getTranslation( 'view/slave/edit', 'Add a GauffrSlave');
            $ret->variables['gauffrSlave'] = $gauffrSlave;

            return $ret;
        }
        // Edition
        else
        {
            if ( (int)$this->gauffrSlaveID == 0 )
                $gauffrSlave = new GauffrSlave();

            $session = GauffrSlave::getPersistentSessionInstance();
            $gauffrSlave->Name = $_POST['GauffrSlave']['Name'];
            $gauffrSlave->Identifier = $_POST['GauffrSlave']['Identifier'];
            $gauffrSlave->Location = $_POST['GauffrSlave']['Location'];
            $gauffrSlave->HasCredential = isset($_POST['GauffrSlave']['HasCredential']) ? $_POST['GauffrSlave']['HasCredential'] : 0;

            if ( (int)$this->gauffrSlaveID == 0 )
            {
                $session->save($gauffrSlave);

                Gauffr::log( 'Add GauffrSlave "' . $gauffrSlave->Name . '" by ' . $_SESSION['gauffrAuth_id'],
                	'GauffrAdmin', GauffrLog::SYSTEM, array( "category" => "GauffrSlave", "file" => __FILE__, "line" => __LINE__ ) );
            }
            else
            {
                $session->update($gauffrSlave);
                Gauffr::log( 'Update GauffrSlave "' . $gauffrSlave->Name . '" by ' . $_SESSION['gauffrAuth_id'],
                	'GauffrAdmin', GauffrLog::SYSTEM, array( "category" => "GauffrSlave", "file" => __FILE__, "line" => __LINE__ ) );
            }

            $ret = new ezcMvcResult;
            $ret->status = new ezcMvcExternalRedirect( GauffrAdmin::buildURL('gauffrslave?edit=ok') );

            return $ret;
        }
    }
}

?>