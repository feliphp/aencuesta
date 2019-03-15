<?php
/**
 * Fecha:  2019-03-08 - Update: 2019-03-08
 * PHP Version 7
 * 
 * @category   Components
 * @package    Moodle
 * @subpackage Mod_Aulaencuesta
 * @author     JFHR <felipe.herrera@iteraprocess.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://aulavirtual.issste.gob.mx
 */
defined('MOODLE_INTERNAL') || die;
/**
 * Backup_aulaencuesta_activity_structure_step Class
 * 
 * @category Class
 * @package  Moodle
 * @author   JFHR <felipe.herrera@iteraprocess.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://aulavirtual.issste.gob.mx
 */
class Backup_Aulaencuesta_Activity_Structure_Step extends 
backup_activity_structure_step
{
    /**
     * Defines the backup structure of the module
     *
     * @return backup_nested_element
     */
    protected function defineStructure()
    {
        $userinfo = $this->get_setting_value('userinfo');
        $aulaencuesta = new backup_nested_element(
            'aulaencuesta', array('id'),
            array('name', 'intro', 'introformat', 'grade')
        );
        $aulaencuesta->set_source_table(
            'aulaencuesta',
            array('id' => backup::VAR_ACTIVITYID)
        );
        $aulaencuesta->annotate_files('mod_aulaencuesta', 'intro', null);
        return $this->prepare_activity_structure($aulaencuesta);
    }
}