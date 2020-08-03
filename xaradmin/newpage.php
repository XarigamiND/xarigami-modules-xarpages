<?php
/**
 * Create a new page.
 *
 * @package Xaraya
 * @copyright (C) 2004 by Jason Judge
 * @license GPL <http://www.gnu.org/licenses/gpl.html>
 * @link http://www.academe.co.uk/
 * @author Jason Judge
 *
 * @subpackage Xarigami xarPages Module
 * @copyright (C) 2010 2skies.com
 * @link http://xarigami.com/project/xarigami_xarpages
 * @author Xarigami team
 */

function xarpages_admin_newpage($args)
{
    $args['menulinks'] = xarModAPIFunc('xarpages', 'admin', 'getmenulinks');
    return xarModFunc('xarpages', 'admin', 'modifypage', $args);
}

?>