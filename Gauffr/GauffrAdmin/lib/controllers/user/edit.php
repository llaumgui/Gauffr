<?php
/**
 * File containing the GauffrAdminUserCredentialController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminUserCredentialController classes.
 *
 * Gauffr users management
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminUserEditController extends ezcMvcController
{

	/**
	 * Do users
	 */
	public function doUserEdit()
    {
        $gauffrUser = GauffrUser::fetchWithRelatedObjectsUserByID( (int)$this->gauffrUserID );

        // Redirect on error
        if ( !$gauffrUser )
        {
            $req = new ezcMvcRequest;
            $req->uri = '/ERROR';
            return new ezcMvcInternalRedirect($req);
        }

        // Form
        if ( empty($_POST) )
        {
            $ret = new ezcMvcResult;

            $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/user/credential', 'User credential' );
            $ret->variables['gauffrUser'] = $gauffrUser;
            $ret->variables['gauffrSlaves'] = GauffrSlave::fetch( array( 'filter' => array( array( 'HasCredential', '=', 1 )) ));

            return $ret;
        }
        // Edition
        else
        {
            // Save GauffrUserExtended
            $session = GauffrUserExtended::getPersistentSessionInstance();
            $altLogin = ($_POST['GauffrUserExtended_AltLogin'] != '' ?  $_POST['GauffrUserExtended_AltLogin'] : null );
            if ( !($gauffrUserExtended = $gauffrUser->Extended) )
            {
                $gauffrUserExtended = new GauffrUserExtended();
                $gauffrUserExtended->setID( $gauffrUser->getID() );
                $gauffrUserExtended->AltLogin = $altLogin;
                $session->save($gauffrUserExtended);
            }
            else
            {
                $gauffrUserExtended->AltLogin = $altLogin;
                $session->update($gauffrUserExtended);
            }

            // Save credentials
            $gauffrUser->updateCredential( $_POST['GauffrCredential'] );

            Gauffr::log( 'Update GauffrUser "' . $gauffrUser->Login . '" by ' . $_SESSION['gauffrAuth_id'],
                'GauffrAdmin', GauffrLog::SYSTEM, array( "category" => "GauffrUser", "file" => __FILE__, "line" => __LINE__ ) );

            $ret = new ezcMvcResult;
            $ret->status = new ezcMvcExternalRedirect( GauffrAdmin::buildURL('user?edit=ok') );
            return $ret;
        }

        // Redirect on error
        $req = new ezcMvcRequest;
        $req->uri = '/ERROR';
        return new ezcMvcInternalRedirect($req);

    }
}
?>