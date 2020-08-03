<?php
/**
 * @package modules
 * @copyright (C) 2002-2008 The Digital Development Foundation
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 * @link http://www.xaraya.com
 *
 * @subpackage Xarigami xarPages Module
 * @copyright (C) 2007-2010 2skies.com
 * @link http://xarigami.com/project/xarigami_xarpages
 * @author 2skies.com - xarigami changes
*/

function xarpages_admin_changestatus($args)
{
   if (!xarVarFetch('pid', 'id', $pid, '', XARVAR_DONT_SET)) return;
  
    $newstatus = '';

    if (!empty($pid)) {
        // Setting up necessary data.
        $page= xarModAPIFunc('xarpages', 'user', 'getpage',
            array('pid' => $pid)
        );
        $pagetype= xarModAPIFunc('xarpages', 'user', 'gettype',
            array('ptid' => $page['ptid'])
        );
        // Check we have minimum privs to edit this page
        if (!xarSecurityCheck('EditXarpagesPage', 0, 'Page', $page['name'] . ':' . $pagetype['name'])) {
            $msg = xarML('You have no permission to edit this page #(1) type #(2)', $page['name'], $pagetype['name']);
            return xarResponseForbidden($msg);
        }        
        if ($page['status'] != 'INACTIVE' && $page['status'] != 'ACTIVE') return;
        $newstatus = $page['status']=='INACTIVE' ? 'ACTIVE': 'INACTIVE';
        $page['status'] = $newstatus;
        $page['return_url'] = xarModURL('xarpages','admin','viewpages');
        $page['moving'] = FALSE;

        $pageupdate = xarModAPIFunc('xarpages','admin','updatepage',$page);
    }    
    xarResponseRedirect(xarModURL('xarpages','admin','viewpages'));
    return;
}

?>