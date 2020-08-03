<?php
/**
 * Delete a page
 *
 * @copyright (C) 2004 by Jason Judge
 * @license GPL <http://www.gnu.org/licenses/gpl.html>
 * @link http://www.consil.co.uk/
 * @author Jason Judge
 *
 * @subpackage Xarigami xarPages Module
 * @copyright (C) 2007-2011 2skies.com
 * @link http://xarigami.com/project/xarigami_xarpages
 * @author Xarigami team
 */

function xarpages_admin_deletepage($args)
{
    extract($args);

    if (!xarVarFetch('pid', 'id', $pid)) return;
    if (!xarVarFetch('confirm', 'str:1', $confirm, '', XARVAR_NOT_REQUIRED)) return;
    if (!xarVarFetch('return_url', 'str:0:200', $return_url, '', XARVAR_DONT_SET)) return;

    // Get page information
    $page = xarModAPIFunc('xarpages', 'user', 'getpage', array('pid' => $pid));
    $data['menulinks'] = xarModAPIFunc('xarpages','admin','getmenulinks');

    if (empty($page)) {
        $msg = xarML('The page #(1) to be deleted does not exist', $pid);
        throw new IDNotFoundException('pid', $msg);
    }

    // Security check
    if (!xarSecurityCheck('DeleteXarpagesPage', 1, 'Page', $page['name'] . ':' . $page['pagetype']['name'])) {
        $msg = xarML('You have no permission to delete this page #(1) type #(2)', $page['name'], $page['pagetype']['name']);
        return xarResponseForbidden($msg);
    }

    // Check for confirmation
    if (empty($confirm)) {
        $data = array('page' => $page, 'return_url' => $return_url);
        $data['authkey'] = xarSecGenAuthKey();

        $data['count'] = xarModAPIfunc('xarpages', 'user', 'getpages',
            array('count' => true, 'left_range' => array($page['left']+1, $page['right']-1)));

        // Return output
        return $data;
    }

    // Confirm Auth Key
    if (!xarSecConfirmAuthKey()) return;

    // Pass to API
    if (!xarModAPIFunc('xarpages', 'admin', 'deletepage', array('pid' => $pid))) return;

    if (!empty($return_url)) {
        xarResponseRedirect($return_url);
    } else {
        xarResponseRedirect(xarModURL('xarpages', 'admin', 'viewpages'));
    }

    return true;
}

?>