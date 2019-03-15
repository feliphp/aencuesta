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
//
require_once $CFG->libdir.'/adminlib.php';
$contextid = optional_param('contextid', 0, PARAM_INT);
$openlink = optional_param('openlink', 0, PARAM_INT); 
$user = optional_param('user', 0, PARAM_INT); 
$returnurl = optional_param('returnurl', '', PARAM_LOCALURL);
$strname = get_string('aulaencuesta', 'aulaencuesta');
$items_by_page = 5;
$page = optional_param('page', 0, PARAM_INT);
$order = optional_param('order', 'name', PARAM_TEXT); 
$dir = optional_param('dir', 'asc', PARAM_TEXT); 

$baseurl = new moodle_url('/mod/aulaencuesta/index.php', null);
if ($contextid) {
    $context = context_system::instance();
} else {
    $context = context_system::instance();
}

$PAGE->set_url($CFG->wwwroot.'/mod/aulaencuesta/index.php');
require_capability('moodle/site:config', get_context_instance(CONTEXT_SYSTEM));
$PAGE->navbar->add($strname);

$PAGE->set_context($context);
$PAGE->set_pagelayout('admin');
$PAGE->set_heading($site->fullname);
$strorg = get_string('aulaencuesta', 'aulaencuesta');

echo $PAGE->set_title($strorg);  
echo $OUTPUT->header();  
echo $OUTPUT->heading($strname);  

//pagination
$array_all_items = Aulaencuesta_Get_Total_Items_In_table();
$all_items = $array_all_items->items;
$totalPag = ceil($all_items/$items_by_page);
echo get_string('pages', 'aulaencuesta');
for ($i=1; $i<=$totalPag ; $i++) {
    if ($page == $i) {
        $links[] = "<a href='".$baseurl."?page=$i'>".
        "<strong>$i</strong></a>"; 
    } else {
        $links[] = "<a href='".$baseurl."?page=$i'>$i</a>"; 
    }
}
echo implode(" - ", $links);
$links = array();
//end pagination


$imagen_dir_id = $OUTPUT->image_url('menos', 'aulaencuesta');
if ($order=='id') {
    if ($dir == 'asc') {
        $imagen_dir_id = $OUTPUT->image_url('asc', 'aulaencuesta');
        $link_dir = 'desc';
    } else {
        $imagen_dir_id = $OUTPUT->image_url('desc', 'aulaencuesta');
        $link_dir = 'asc';
    }
}

$imagen_dir_user = $OUTPUT->image_url('menos', 'aulaencuesta');
if ($order=='user') {
    if ($dir == 'asc') {
        $imagen_dir_user = $OUTPUT->image_url('asc', 'aulaencuesta');
        $link_dir = 'desc';
    } else {
        $imagen_dir_user = $OUTPUT->image_url('desc', 'aulaencuesta');
        $link_dir = 'asc';
    }
}

echo "<table class='flexible reportlog generaltable generalbox'
         cellspacing='0'>";
        echo "<thead>";
        echo "<tr>";
            echo "<th class='header c0' scope='col'>";
            echo "<a href ='".$baseurl."?order=id&dir=$link_dir&page=$page'>";
            echo get_string(
                'label_table_id',
                'aulaencuesta'
            )."<img src='".$imagen_dir_id."' 
            width='15px' height='15px'></a>";
            echo "</th>";
            echo "<th class='header c3' scope='col'>";
            echo "<a href ='".$baseurl."?order=user&dir=$link_dir&page=$page'>";
            echo get_string(
                'label_table_user',
                'aulaencuesta'
            )."<img src='".$imagen_dir_user."' 
            width='15px' height='15px'></a>";
            echo "</th>";
            echo "<th class='header c3' scope='col'>";
            echo "".
            get_string(
                'label_table_answer_one',
                'aulaencuesta'
            );
            echo "</th>";
            echo "</th>";
            echo "<th class='header c3' scope='col'>";
            echo "".
            get_string(
                'label_table_answer_two',
                'aulaencuesta'
            );
            echo "</th>";
            echo "<thead>";

            $registered_data = Aulaencuesta_Get_Answers_poll(
                $order,
                $dir,
                $page,
                $items_by_page
            );

            echo "<tbody>";
            foreach ($registered_data as $data) {
                echo "<tr>";
                echo "<td>";
                echo $data->id;
                echo "</td>";
                echo "<td>";
                $user = Aulaencuesta_Get_username($data->user);
                echo $user;
                echo "</td>";
                echo "<td>";
                echo $data->answer_one;
                echo "</td>";
                echo "<td>";
                echo $data->answer_two;
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

            echo "<br><a href='lib.php?nr=1'>".
            get_string('download_xls', 'aulaencuesta')."</a>";
            
            echo $OUTPUT->footer();
