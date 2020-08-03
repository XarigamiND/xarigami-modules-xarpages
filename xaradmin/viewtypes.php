<?php
/**
  * Admin overview of all page types.
 *
 * @copyright (C) 2004 by Jason Judge
 * @license GPL <http://www.gnu.org/licenses/gpl.html>
 * @link http://www.academe.co.uk/
 * @author Jason Judge
 *
 * @subpackage Xarigami xarPages Module
 * @copyright (C) 2009-2010 2skies.com
 * @link http://xarigami.com/project/xarigami_xarpages
 * @author Xarigami team
 */ 

function xarpages_admin_viewtypes($args)
{
    extract($args);

    // Security check
    if (!xarSecurityCheck('EditXarpagesPage', 1)) {
        $msg = xarML('You have no permission to edit pages');
        return xarResponseForbidden($msg);
    }

    $types = xarModAPIFunc('xarpages', 'user', 'gettypes',
        array('key' => 'index', 'dd_flag' => false));

    if (empty($types)) $types = array();
    $menulinks = xarModAPIFunc('xarpages','admin','getmenulinks');
    $authid = xarSecGenAuthKey();
    return array('types' => $types,'menulinks'=>$menulinks,'authid'=>$authid);
}

?>