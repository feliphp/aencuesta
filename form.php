<?php
/**
 * Fecha:  2019-03-08 - Update: 2019-03-14
 * PHP Version 7
 * 
 * @category   Components
 * @package    Moodle
 * @subpackage Mod_Aulaencuesta
 * @author     JFHR <felipe.herrera@iteraprocess.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://aulavirtual.issste.gob.mx
 */
require_once dirname(dirname(dirname(__FILE__))).'/config.php';
require_once dirname(__FILE__).'/lib.php';
require_once $CFG->libdir.'/adminlib.php';
require_once $CFG->libdir.'/formslib.php';
/**
 * Poll_Form Class
 * 
 * @category Class
 * @package  Moodle
 * @author   JFHR <felipe.herrera@iteraprocess.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://aulavirtual.issste.gob.mx
 */
class Poll_Form extends moodleform
{
    /**
     * Function from Form 
     * 
     * @return null
     */
    public function definition() 
    {
        global $CFG;
 
        $mform = $this->_form;    
        //filtro nombre curso

        $mform->addElement(
            'select', 
            'first_question', 
            get_string('first_question', 'aulaencuesta'),  
            array('Excelente', 'Bien', 'Mal'), 
            null
        );
        $mform->addElement('html', '<br>');
        $mform->setDefault('name', $this->_customdata['name']);
        $mform->addElement(
            'textarea', 
            'second_question', 
            get_string("second_question", "aulaencuesta"),
            'wrap="virtual" rows="5" cols="80"'
        );
        $mform->addRule(
            'second_question', 
            get_string('required'), 
            'required'
        );

        $mform->addElement('hidden', 'accion', 'poll');

        $this->add_action_buttons(
            $cancel = false,
            $submitlabel = get_string('submit_value', 'aulaencuesta')
        );

    }
}
