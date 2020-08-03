<?php
/**
 * Overview for xarpages
 *
 * @package modules
 * @copyright (C) 2002-2006 The Digital Development Foundation
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 * @link http://www.xaraya.com
 * @author Jason Judge
 * @author <mikespub@xaraya.com>
 
 * @subpackage Xarigami xarPages Module
 * @copyright (C) 2010 2skies.com
 * @link http://xarigami.com/project/xarigami_xarpages
 * @author Xarigami team
 */

/**
 * Overview displays standard Overview page
 */
function xarpages_admin_overview()
{
    $data=array();
    $data['menulinks'] = xarModAPIFunc('xarpages','admin','getmenulinks');    
    //just return to main function that displays the overview
    return xarTplModule('xarpages', 'admin', 'main', $data, 'main');
}

?>