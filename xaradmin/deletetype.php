<?php
/**
 * Delete a page type
 *
 * @package Xaraya
 * @copyright (C) 2004 by Jason Judge
 * @license GPL <http://www.gnu.org/licenses/gpl.html>
 * @link http://www.academe.co.uk/
 *
 * @subpackage Xarigami xarPages Module
 * @copyright (C) 2007-2011 2skies.com
 * @link http://xarigami.com/project/xarigami_xarpages
 * @author Jason Judge
 * @author Xarigami team
 */

function xarpages_admin_deletetype($args)
{
    extract($args);

    if (!xarVarFetch('ptid', 'id', $ptid)) return;
    if (!xarVarFetch('confirm', 'str:1', $confirm, '', XARVAR_NOT_REQUIRED)) return;

    // Security check
    if (!xarSecurityCheck('AdminXarpagesPagetype', 1)) {
        $msg = xarML('You have no permission to administrate page type');
        return xarResponseForbidden($msg);
    }
    $data['menulinks'] = xarModAPIFunc('xarpages','admin','getmenulinks');
    // Get page type information
    $type = xarModAPIFunc('xarpages', 'user', 'gettype', array('ptid' => $ptid));

    if (empty($type)) {
        $msg = xarML('The page type "#(1)" to be deleted does not exist', $ptid);
        throw new IDNotFoundException('ptid', $msg);
    }

    // Check for confirmation
    if (empty($confirm)) {
        $data = array('type' => $type);
        $data['authkey'] = xarSecGenAuthKey();

        // Get a count of pages that will also be deleted.
        $data['count'] = xarModAPIfunc('xarpages', 'user', 'getpages',
            array('count' => true, 'itemtype' => $type['ptid']));

        // Return output
        return $data;
    }

    // Confirm Auth Key
    if (!xarSecConfirmAuthKey()) return;

    // Pass to API
    if (!xarModAPIFunc('xarpages', 'admin', 'deletetype', array('ptid' => $ptid))) return;
    $msg = xarML('Page type successfully deleted.');
    xarTplSetMessage($msg,'status');
    xarResponseRedirect(xarModURL('xarpages', 'admin', 'viewtypes'));

    return true;
}

?>
