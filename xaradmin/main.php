<?php
/**
 * Main admin page
 *
 * @package Xaraya
 * @copyright (C) 2004 by Jason Judge
 * @license GPL <http://www.gnu.org/licenses/gpl.html>
 * @link http://www.academe.co.uk/
 * @author Jason Judge
 *
 * @subpackage Xarigami xarPages Module
 * @copyright (C) 2007-2010 2skies.com
 * @link http://xarigami.com/project/xarigami_xarpages
 * @author Xarigami team
 */

function xarpages_admin_main()
{
    // Need admin priv to view the info page.
    if (!xarSecurityCheck('EditXarpagesPage')) {
        $msg = xarML('You have no permission to edit page');
        xarResponseForbidden($msg);
    }

    // Redirect to the view page.
    xarResponseRedirect(xarModURL('xarpages', 'admin', 'viewpages'));
    return true;
}

?>