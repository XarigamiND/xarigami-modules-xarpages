<?php
/*
 * Get the itemtype of the page type.
 *
 * @subpackage Xarigami xarPages Module
 * @copyright (C) 2010 2skies.com
 * @link http://xarigami.com/project/xarigami_xarpages
 * @author Xarigami team
 */

function xarpages_userapi_gettypeitemtype($args)
{
    static $type_itemtype = NULL;

    if (isset($type_itemtype)) return $type_itemtype;

    // Get the itemtype of the page type.
    $pagetype = xarModAPIfunc('xarpages', 'user', 'gettype',
        array('name' => '@pagetype', 'dd_flag' => false, 'include_system' => true));

    if (!empty($pagetype)) {
        $type_itemtype = $pagetype['ptid'];
    } else {
        // If it does not exist, then create it now.
        $type_itemtype = xarModAPIfunc('xarpages', 'admin', 'createtype',
            array('name' => '@pagetype', 'desc' => 'System generated \'pagetype\' type'));
    }

    return $type_itemtype;
}

?>