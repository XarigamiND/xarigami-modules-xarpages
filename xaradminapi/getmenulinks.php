<?php
/**
 * @package Xaraya
 * @license GPL <http://www.gnu.org/licenses/gpl.html>
 *
 * @subpackage Xarigami xarPages Module
 * @copyright (C) 2010 2skies.com
 * @link http://xarigami.com/project/xarigami_xarpages
 * @author Xarigami team
 *
 * utility function pass individual menu items to the main menu
 *
 * @author the Example module development team
 * @returns array
 * @return array containing the menulinks for the main menu items.
 */

function xarpages_adminapi_getmenulinks()
{
    $menulinks = array();

    // Security Check
    if (xarSecurityCheck('ModerateXarpagesPage', 0)) {
        $menulinks[] = array(
            'url'   => xarModURL('xarpages', 'admin', 'viewpages'),
            'title' => xarML('View pages'),
            'label' => xarML('View pages'),
            'active' => array('viewpages')
        );
    }

    if (xarSecurityCheck('AddXarpagesPage', 0)) {
        $menulinks[] = array(
            'url'   => xarModURL('xarpages', 'admin', 'newpage'),
            'title' => xarML('Add a new page'),
            'label' => xarML('Add page'),
            'active' => array('newpage')
        );
    }

    if (xarSecurityCheck('AdminXarpagesPagetype', 0)) {
        $menulinks[] = array(
            'url'   => xarModURL('xarpages', 'admin', 'viewtypes'),
            'title' => xarML('View page types'),
            'label' => xarML('View page types'),
            'active' => array('viewtypes')

        );
    }

    if (xarSecurityCheck('AdminXarpagesPagetype', 0)) {
        $menulinks[] = array(
            'url'   => xarModURL('xarpages', 'admin', 'newtype'),
            'title' => xarML('Add a page type'),
            'label' => xarML('Add page type'),
            'active' => array('newtype')
        );
    }

    if (xarSecurityCheck('AdminXarpagesPage', 0)) {
        $menulinks[] = array(
            'url'   => xarModURL('xarpages', 'admin', 'modifyconfig'),
            'title' => xarML('Modify configuration settings'),
            'label' => xarML('Modify Config'),
            'active' => array('modifyconfig')

        );
    }

    return $menulinks;
}

?>