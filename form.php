<?php
/**
 * Fecha:  2019-03-08 - Update: 2019-03-14
 * PHP Version 7
 * 
 * @category   Components
 * @package    Moodle
 * @subpackage Mod_Aulaencuesta
 * @author     JFHR <felsul@hotmail.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       
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
 * @author   JFHR <felsul@hotmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     
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

        //question 1
        $radio_quetion_one_array=array();
        $radio_quetion_one_array[] = $mform->createElement(
            'radio', 
            'question_one', 
            '', 
            get_string('yes'), 
            1
        );
        $radio_quetion_one_array[] = $mform->createElement(
            'radio', 
            'question_one', 
            '', 
            get_string('no'), 
            0
        );
        $mform->addGroup(
            $radio_quetion_one_array, 
            'question_one', 
            get_string('first_question', 'aulaencuesta'),
            array(' '), 
            false
        );
        $mform->setDefault('question_one', 1);
        //question 2
        $radio_quetion_two_array=array();
        $radio_quetion_two_array[] = $mform->createElement(
            'radio', 
            'question_two', 
            '', 
            get_string('yes'), 
            1
        );
        $radio_quetion_two_array[] = $mform->createElement(
            'radio', 
            'question_two', 
            '', 
            get_string('no'), 
            0
        );
        $mform->addGroup(
            $radio_quetion_two_array, 
            'question_two', 
            get_string('second_question', 'aulaencuesta'),
            array(' '), 
            false
        );
        $mform->setDefault('question_two', 1);
        //question 3
        $radio_quetion_three_array=array();
        $radio_quetion_three_array[] = $mform->createElement(
            'radio', 
            'question_three', 
            '', 
            get_string('yes'), 
            1
        );
        $radio_quetion_three_array[] = $mform->createElement(
            'radio', 
            'question_three', 
            '', 
            get_string('no'), 
            0
        );
        $mform->addGroup(
            $radio_quetion_three_array, 
            'question_three', 
            get_string('three_question', 'aulaencuesta'),
            array(' '), 
            false
        );
        $mform->setDefault('question_three', 1);
        //question 4
        $radio_quetion_four_array=array();
        $radio_quetion_four_array[] = $mform->createElement(
            'radio', 
            'question_four', 
            '', 
            get_string('yes'), 
            1
        );
        $radio_quetion_four_array[] = $mform->createElement(
            'radio', 
            'question_four', 
            '', 
            get_string('no'), 
            0
        );
        $mform->addGroup(
            $radio_quetion_four_array, 
            'question_four', 
            get_string('four_question', 'aulaencuesta'),
            array(' '), 
            false
        );
        $mform->setDefault('question_four', 1);


        $options_areas = array(
            '' => 'Seleccionar área',
            'Médica' => 'Médica',
            'Tecnológica' => 'Tecnológica',
            'Administrativa' => 'Administrativa',
            'Programas de Office' => 'Programas de Office',
        );

        $select = $mform->addElement(
            'select',
            'question_five', 
            get_string('five_question', 'aulaencuesta'),
            $options_areas
        );
        // This will select the colour blue.
        $select->setSelected('');


        $mform->addElement('hidden', 'accion', 'poll');

        $this->add_action_buttons(
            $cancel = false,
            $submitlabel = get_string('submit_value', 'aulaencuesta')
        );

    }
}
