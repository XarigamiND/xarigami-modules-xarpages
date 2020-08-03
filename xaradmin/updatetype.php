<?php
/**
 * Create or update a page type - form handler.
 *
 * @package Xaraya
 * @copyright (C) 2004 by Jason Judge
 * @license GPL <http://www.gnu.org/licenses/gpl.html>
 * @link http://www.academe.co.uk/
 * @author Jason Judge
 *
 * @subpackage Xarigami xarPages Module
 * @copyright (C) 2010-2011 2skies.com
 * @link http://xarigami.com/project/xarigami_xarpages
 * @author Xarigami team
 */

function xarpages_admin_updatetype($args)
{
    extract($args);

    if (!xarVarFetch('ptid', 'id', $ptid, 0, XARVAR_NOT_REQUIRED)) return;
    if (!xarVarFetch('return_url', 'str:0:200', $return_url, '', XARVAR_DONT_SET)) return;

    // Allow the optional pre-selected drop-downs to take precedence.
    xarVarFetch('name_list', 'pre:lower:ftoken:str:1:100', $name, '', XARVAR_NOT_REQUIRED);
    if (empty($name)) unset($name);

    if (!xarVarFetch('name', 'pre:lower:ftoken:str:1:100', $name,'', XARVAR_DONT_SET)) return;
    if (!xarVarFetch('desc', 'str:0:200', $desc)) return;

    // Confirm authorisation code
    if (!xarSecConfirmAuthKey()) return;
    $invalid = array();
    // Pass to API
    if (!empty($ptid)) {
        //check type does not already exist
        $pagetype = xarModAPIFunc('xarpages','user','gettype',array());
        if (!xarModAPIFunc('xarpages', 'admin', 'updatetype', array(
                                                                    'ptid'  => $ptid,
                                                                    'name'  => $name,
                                                                    'desc'  => $desc
                                                                )
                            )) return;
        $msg = xarML('Page type "#(1)" successfully updated.',$name);
        xarTplSetMessage($msg,'status');
    } else {
         //check type does not already exist
        $pagetype = xarModAPIFunc('xarpages','user','gettype',array('name'=>$name));

        if (is_array($pagetype) && !empty($pagetype)) {

            $invalid['name'] = xarML('Please enter a unique Name. A page type with this name already exists.');
        }
        if (empty($name)) {
            $invalid = array();
            $invalid['name'] = xarML('Please enter a unique Name. Page type Name cannot be empty.');
        }
        if (!empty($invalid)) {
          xarResponseRedirect(xarModURL('xarpages','admin','modifytype',array('name'=>$name,'invalid'=>$invalid)));
        }
        // Pass to API
        $ptid = xarModAPIFunc('xarpages', 'admin', 'createtype',
            array(
                'name'  => $name,
                'desc'  => $desc
            )
        );
        if (!$ptid) {
            return;
        } else {
            $msg = xarML('New page type "#(1)" created successfully.',$name);
            xarTplSetMessage($msg,'status');
        }
    }

    if (empty($return_url)) {
        $return_url = (xarModUrl('xarpages', 'admin', 'viewtypes'));
    }
    xarResponseRedirect($return_url);
    return true;
}

?>