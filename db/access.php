<?php
/**
 * Fecha:  2019-03-08 - Update: 2019-03-08
 * PHP Version 7
 * 
 * @category   Components
 * @package    Moodle
 * @subpackage Mod_Aulaencuesta
 * @author     JFHR <felsul@hotmail.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       
 */

defined('MOODLE_INTERNAL') || die();

$capabilities = array(
    'mod/aulaencuesta:addinstance' => array(
        'riskbitmask' => RISK_XSS,
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'manager' => CAP_ALLOW
        )
    ),

    'mod/aulaencuesta:view' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_MODULE,
        'legacy' => array(
            'manager' => CAP_ALLOW
        )
    ),

);
