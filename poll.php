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
require_once dirname(__FILE__).'/form.php';
$accion = optional_param('accion', '', PARAM_TEXT); 
$strname = get_string('aulaencuesta', 'aulaencuesta');
$PAGE->set_url($CFG->wwwroot.'/mod/aulaencuesta/poll.php');
echo "<html id='html'><head><link rel='stylesheet' href='styles.css'>";
echo "<title>".$strname."</title></head><body>";
echo $PAGE->set_title($strname); 
echo '<div id="title">'.$OUTPUT->heading($strname).'</div>'; 
$date_to_day = date("Y-m-d");

global $USER;

$customdata = array('name' => $name);
        $links = array();

        $mform = new Poll_form(
            null,
            $customdata
        );
        echo '<table id="table-poll"><tr><td width="20%" height="40%">';
        echo '</td><td></td><td width="20%"></td></tr>';
        echo '<tr><td></td><td>';
        if ($mform->is_cancelled()) {
        } else if ($dataform = $mform->get_data()) {
            $mform->display();

            echo  '</td><td></td></tr></table>'; 
            $dataform->first_question;
            $question_2 = $dataform->second_question;
            if ($accion == 'poll') {
                switch ($dataform->first_question) {
                case 0:
                    $question_1 = 'Excelente';
                    break;
                case 1:
                    $question_1 = 'Bien';
                    break;
                case 2:
                    $question_1 = 'Mal';
                    break;
                }
                global $USER;
                $userid = $USER->id;
                $datecreated = date('d/m/Y');
                Aulaencuesta_save($userid, $question_1, $question_2, $datecreated);
                ?>
                    <script>
            top.location.reload();
                    </script>
                <?php
    
            }
        } else {
            $mform->set_data($toform);
            $mform->display();
        }
       
        echo "</body></html>";
