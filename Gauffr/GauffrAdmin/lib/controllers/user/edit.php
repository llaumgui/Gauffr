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
        // Get redirection URI
        $redirect = isset($_GET['redirect']) ? 'user/'.$_GET['redirect'] : 'user';
        $redirect = isset($_POST['redirect_after_edit']) ? $_POST['redirect_after_edit'] : $redirect;
        if ( $redirect != 'user/credential' && $redirect != 'user/extended' )
            $redirect = 'user';

        // Redirect on error
        if ( !($gauffrUser = GauffrUser::fetchWithRelatedObjectsUserByID( (int)$this->gauffrUserID )) )
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
            $ret->variables['redirectAfterEdit'] = $redirect;

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
            $gauffrUser->updateCredential( isset( $_POST['GauffrCredential']) ? $_POST['GauffrCredential'] : array() );

            Gauffr::log( 'Update GauffrUser "' . $gauffrUser->Login . '" by ' . $_SESSION['gauffrAuth_id'],
                'GauffrAdmin', GauffrLog::SYSTEM, array( "category" => "GauffrUser", "file" => __FILE__, "line" => __LINE__ ) );

            $ret = new ezcMvcResult;
            $ret->status = new ezcMvcExternalRedirect( GauffrAdmin::buildURL($redirect.'?edit=ok') );
            return $ret;
        }

        // Redirect on error
        $req = new ezcMvcRequest;
        $req->uri = '/ERROR';
        return new ezcMvcInternalRedirect($req);

    }
}
?>