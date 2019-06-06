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
require_once dirname(__FILE__).'/form.php';
$accion = optional_param('accion', '', PARAM_TEXT); 
$strname = get_string('aulaencuesta', 'aulaencuesta');
$PAGE->set_url($CFG->wwwroot.'/mod/aulaencuesta/poll.php');
echo "<html id='html'><head><link rel='stylesheet' href='styles.css'>";
echo "<title>".$strname."</title></head><body scrolling='no'>";
echo $PAGE->set_title($strname); 
//echo '<div id="title">'.$OUTPUT->heading($strname).'</div>'; 
$date_to_day = date("Y-m-d");
$imagen_issste = $OUTPUT->image_url('ite', 'aulaencuesta');
$imagen_av = $OUTPUT->image_url('av', 'aulaencuesta');
$imagen_logo_av = $OUTPUT->image_url('logo_av', 'aulaencuesta');
$imagen_pleca_inf = $OUTPUT->image_url('pleca_inf', 'aulaencuesta');

global $USER;
$customdata = array('name' => $strname);
        $links = array();
        $mform = new Poll_form(
            null,
            $customdata
        );
        echo "<div id ='img_issste'><img src='".$imagen_ite."' width='258px'".
        " height='100px'></div>";
        echo "<div id='pleca_av'><img src='".$imagen_av."' width='600px'".
        " height='30px'></div>";
        echo '<table id="table-poll"><tr><td width="20%" height="40%">';
        echo '</td><td></td><td width="20%"></td></tr>';
        echo '<tr><td></td><td id="tdcontent">';
        if ($mform->is_cancelled()) {
        } else if ($dataform = $mform->get_data()) {
            $mform->display();

            echo  '</td><td></td></tr></table>'; 
            $question_1 = $dataform->question_one;
            $question_2 = $dataform->question_two;
            $question_3 = $dataform->question_three;
            $question_4 = $dataform->question_four;
            $question_5 = $dataform->question_five;
                global $USER;
                $userid = $USER->id;
                $datecreated = date('d/m/Y');
                Aulaencuesta_save(
                    $userid, 
                    $question_1, 
                    $question_2, 
                    $question_3, 
                    $question_4, 
                    $question_5,
                    $datecreated
                );
                ?>
                    <script>
            top.location.reload();
                    </script>
                <?php
    
        } else {
           // $mform->set_data($toform);
            $mform->display();

            echo "<div id ='logo_av'><img src='".$imagen_logo_av."' width='300px'".
            " height='250px'></div>";
            echo "<div id ='pleca_inf'><img src='".$imagen_pleca_inf."'".
            " width='750px' height='5px'></div>";
        }
       
        echo "</body></html>";
