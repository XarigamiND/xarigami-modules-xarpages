<?php
/**
 * @package Xaraya modules
 * @copyright (C) 2004 by Jason Judge
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 *
 * @subpackage Xarigami xarPages Module
 * @copyright (C) 2007-2010 2skies.com
 * @link http://xarigami.com/project/xarigami_xarpages
 * @author Jason Judge
 */

function xarpages_admin_modify($args)
{
    return xarModfunc('xarpages', 'admin', 'deletepage', $args);
}

?>