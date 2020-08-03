<?php
/**
 *
 * Xarpages table definitions function.
 *
 * @copyright (C) 2003 by the Digital Development Foundation.
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 *
 * @subpackage Xarigami xarPages Module
 * @copyright (C) 2009-2010 2skies.com
 * @link http://xarigami.com/project/xarigami_xarpages
 * @author Jason Judge
 * @author 2skies.com for xarigami changes
 */

/**
 * Return xarpages table names to xaraya.
 *
 * @access private
 * @return array
 */

function xarpages_xartables()
{
    // Initialise table array.
    $xarTables = array();
    $basename = 'xarpages';

    // Loop for each table.
    foreach(array('pages', 'types') as $table) {
        // Set the table name.
        $xarTables[$basename . '_' . $table] = xarDBGetSiteTablePrefix() . '_' . $basename . '_' . $table;
    }

    // Return the table information
    return $xarTables;
}

?>