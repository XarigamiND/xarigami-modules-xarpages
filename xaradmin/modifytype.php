<?php

/**
 * Modify or create a page type
 *
 * @copyright (C) 2004 by Jason Judge
 * @license GPL <http://www.gnu.org/licenses/gpl.html>
 * @link http://www.academe.co.uk/
 * @author Jason Judge
 *
 * @subpackage Xarigami xarPages Module
 * @copyright (C) 2009-2011 2skies.com
 * @link http://xarigami.com/project/xarigami_xarpages
 * @author Xarigami team
 */

function xarpages_admin_modifytype($args)
{
    extract($args);

    if (!xarVarFetch('creating', 'bool', $creating, true, XARVAR_NOT_REQUIRED)) return;
    if (!xarVarFetch('ptid', 'id', $ptid, 0, XARVAR_DONT_SET)) return;
    if (!xarVarFetch('return_url', 'str:0:254', $return_url, '', XARVAR_DONT_SET)) return;
    if (!xarVarFetch('invalid', 'isset', $invalid, array(), XARVAR_DONT_SET)) return;
    if (!xarVarFetch('name', 'str:1:100', $name,'', XARVAR_DONT_SET))  return;

    $data = array();
    $data['invalid'] = isset($invalid) && is_array($invalid)?$invalid:array();
    // Get the itemtype of the page type.
    $type_itemtype = xarModAPIfunc('xarpages', 'user', 'gettypeitemtype');

    if (!empty($ptid)) {
        // Editing an existing page type

        // We need all pages, but with the current page tree pruned.
        $type = xarModAPIFunc('xarpages', 'user', 'gettype',
            array('ptid' => $ptid, 'dd_flag' => false));

        if (empty($type)) {
            // TODO: raise an error message.
            $msg = xarML('Page type "#(1)" not found.', $ptid);
            throw new IDNotFoundParameterException('ptid', $msg);
        }

        // Security: check we are able to modify this page type.
        if (!xarSecurityCheck('EditXarpagesPagetype', 1, 'Pagetype', $type['name'])) {
            $msg = xarML('You have no permission to edit page type "#(1)"', $type['name']);
            return xarResponseForbidden($msg);
        }

        $data['func'] = 'modify';

        // The modify hooks for the page type as an item.
        $modifyhooks = xarModCallHooks(
            'item', 'modify', $type['ptid'],
            array('module' => 'xarpages', 'itemtype' => $type_itemtype)
        );

        // Do config hooks for the page type as an item type.
        $confighooks = xarModCallHooks(
            'module', 'modifyconfig', 'xarpages',
            array('module' => 'xarpages', 'itemtype' => $type['ptid'])
        );
    } else {
        // Adding a new page type.
        //we might have name returned as invalid
        $name = isset($name)&& !empty($name)?$name:'';
        // Get some example page types from the xardata directory.
        $files = array();
        $xml_files = xarModAPIFunc(
            'dynamicdata', 'admin', 'browse',
            array('basedir' => 'modules/xarpages/xardata', 'filetype' => 'xml')
        );
        if (!empty($xml_files)) {
            $files[''] = xarML('-- Predefined --');

            foreach($xml_files as $xml_file) {
                $type_name = preg_replace('/-def\.xml$/', '', $xml_file);
                $files[$type_name] = $type_name;
            }
        }
        $data['files'] = $files;

        // Security: allowed to create page types?
        if (!xarSecurityCheck('AdminXarpagesPagetype', 1, 'Pagetype', 'All')) {
            $msg = xarML('You have no permission to administrate page types');
            xarResponseForbidden($msg);
        }

        // Default data for the page type form.
        $type = array(
            'ptid' => NULL,
            'name' => $name,
            'desc' => ''
        );

        $data['func'] = 'create';
        $data['ptid'] = NULL;

        // The 'new' modify hooks for the page type as an item.
        $modifyhooks = xarModCallHooks(
            'item', 'new', '',
            array('module' => 'xarpages', 'itemtype' => $type_itemtype)
        );
    }

    // Clear out any empty hooks, trim the remainder.
    foreach($modifyhooks as $key => $modifyhook) {
        if (trim($modifyhook) == '') {
            unset($modifyhooks[$key]);
        } else {
            $modifyhooks[$key] = trim($modifyhook);
        }
    }
    $data['modifyhooks'] =& $modifyhooks;

    // Clear out any empty hooks, trim the remainder.
    if (isset($confighooks)) {
        foreach($confighooks as $key => $confighook) {
            if (trim($confighook) == '') {
                unset($confighooks[$key]);
            } else {
                $confighooks[$key] = trim($confighook);
            }
        }
        $data['confighooks'] =& $confighooks;
    }
    $data['return_url'] = $return_url;
    // Pass the page type to the template.
    $data['type'] = $type;
    $data['ptid'] = $type['ptid'];
    $data['menulinks'] = xarModAPIFunc('xarpages','admin','getmenulinks');

    // Return output
    return $data;
}

?>