<?php
/**
 * Get a single page type.
 *
 * @subpackage Xarigami xarPages Module
 * @copyright (C) 2010 2skies.com
 * @link http://xarigami.com/project/xarigami_xarpages
 * @author Xarigami team
 */

function xarpages_userapi_gettype($args)
{
    $types = xarModAPIfunc('xarpages', 'user', 'gettypes', $args);

    if (empty($types) || count($types) > 1) return;

    return reset($types);
}

?>