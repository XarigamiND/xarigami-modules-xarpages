<?php
/**
 * @license GPL <http://www.gnu.org/licenses/gpl.html>
 *
 * @subpackage Xarigami xarPages Module
 * @copyright (C) 2010=2011 2skies.com
 * @link http://xarigami.com/project/xarigami_xarpages
 * @author Xarigami team
 *
 * Delete a page type.
 * @param $args['ptid'] the ID of the page
 * @returns bool
 * @return true on success, false on failure
 */
function xarpages_adminapi_deletetype($args)
{
    // Get arguments from argument array
    extract($args);

    // Argument check
    if (empty($ptid)) {
        $msg = xarML('Invalid page type ID #(1)', $ptid);
        throw new EmptyParameterException('ptid', $msg);
    }

    // Get the page type.
    $type = xarModAPIfunc('xarpages', 'user', 'gettype', $args);

    if (empty($type)) {
        $msg = xarML('Page type does not exist.');
        throw new BadParameterException($args, $msg);
    }

    // Security check
    if (!xarSecurityCheck('AdminXarpagesPagetype', 1)) return;

    // Get the [optional] pages for deleting.
    $pages = xarModAPIFunc('xarpages', 'user', 'getpages',
        array('dd_flag' => false, 'itemtype' => $ptid));

    if (is_array($pages)) {
        // Delete each page of this type.
        foreach($pages as $page) {
            // Delete the page.
            if (!xarModAPIfunc(
                'xarpages', 'admin', 'deletepage',
                array('pid' => $page['pid'])
            )) return;
        }
    }
    //check for object
    $objectid = xarModGetVar('xarpages','objectid_'.$type['name']);
    if (!isset($objectid)) {
        //it might be a  non-standard pagetype and have itemtype as the name
        $object = xarModAPIFunc('dynamicdata','user','getobject', array('moduleid'=>xarModGetIDFromName('xarpages'),'itemtype'=>$ptid));
        if ($object) $objectid = $object->objectid;
    }
    if (isset($objectid)) { //we have an object let's delete it
         xarModAPIFunc('dynamicdata','admin','deleteobject',
                      array('objectid' => $objectid));
        xarModDelVar('xarpages','objectid_'.$type['name']);

    }
    // Get database setup.
    $dbconn = xarDBGetConn();
    $xartable = xarDBGetTables();

    $query = 'DELETE FROM ' . $xartable['xarpages_types'] . ' WHERE xar_ptid = ?';

    $result = $dbconn->Execute($query, array((int)$ptid));
    if (!$result) return;

    $type_itemtype = xarModAPIfunc('xarpages', 'user', 'gettypeitemtype');

    // Delete the page type as an item.
    xarModCallHooks('item', 'delete', $type['ptid'],
        array('module' => 'xarpages', 'itemtype' => $type_itemtype));

    // Delete the page type as a type.
    // TODO: this hook is not yet available.
    //xarModCallHooks(
    //    'itemtype', 'delete', $type_itemtype,
    //    array('module' => 'xarpages', 'itemtype' => $type_itemtype)
    //);

    return true;
}

?>
