<?php
/**
 * Xarpages version information.
 *
 * @copyright (C) 2003-2009 Jason Judge.
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 *
 * @subpackage Xarigami xarPages Module
 * @copyright (C) 2009-2013 2skies.com
 * @link http://xarigami.com/project/xarigami_xarpages
 * @author Jason Judge
 * @author 2skies.com for xarigami changes
 */
$modversion['name']           = 'xarpages';
$modversion['id']             = '160';
$modversion['version']        = '0.3.5';
$modversion['displayname']    = 'Xarpages';
$modversion['description']    = 'Static pages administration';
$modversion['help']           = 'xardocs/privileges.txt';
$modversion['changelog']      = 'xardocs/news.txt';
$modversion['official']       = 1;
$modversion['author']         = 'Jason Judge';
$modversion['contact']        = 'http://www.academe.co.uk/';
$modversion['homepage']     = 'http://xarigami.com/project/xarigami_xarpages';
$modversion['admin']          = 1;
$modversion['user']           = 1;
$modversion['securityschema'] = array();
$modversion['class']          = 'Complete';
$modversion['category']       = 'Content';
$modversion['dependency']     = array(182); //dynamic data
$modversion['dependencyinfo']   = array(
                                    0 => array(
                                            'name' => 'core',
                                            'version_ge' => '1.5.3' // jquery 1.9.1 compat
                                         ),
                                    182 => array(
                                            'name' => 'dynamicdata',
                                            'version_ge' => '1.2.0'
                                        ),
                                );

if (false) {
    xarML('Xarpages');
    xarML('Static pages administration');
}
?>