<?php
/**
 * File containing the dashboardController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The dashboardController classes.
 *
 * Dashboard of GauffrAdmin
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class dashboardController extends ezcMvcController
{
    private function selectGreeting()
    {
        $greetings = array( 'Hello', 'Hei', 'こんにちわ', 'доброе утро' );
        return $greetings[mt_rand( 0, count( $greetings ) - 1 )];
    }

    public function doDashboard()
    {
        $ret = new ezcMvcResult;
        $ret->variables['greeting'] = $this->selectGreeting();
        return $ret;
    }

    public function doGreetPersonally()
    {
        $ret = new ezcMvcResult;
        $ret->variables['greeting'] = $this->selectGreeting();
        $ret->variables['person'] = $this->name;
        return $ret;
    }
}
?>
