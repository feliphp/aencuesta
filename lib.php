<?php
/**
 * Fecha: 2019-03-08 - Update: 2019-03-14
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

defined('MOODLE_INTERNAL') || die();
/**
 * Get answers poll
 * 
 * @param String $order value of order
 * @param String $dir   value of dir
 * @param String $page  value of page
 * @param String $limit value of limit
 * 
 * @return array
 */
function Aulaencuesta_Get_Answers_poll($order,$dir,$page, $limit) 
{
    global $DB;

    if (!$dir) {
         $dir = 'asc';
    }
    if ($order == '') {
        $filtro_query_orden = "ORDER BY ae.id ASC";
    } elseif ($order == 'id') {
        $filtro_query_orden="ORDER BY ae.id $dir";
    } elseif ($order == 'user') {
        $filtro_query_orden="ORDER BY mu.username $dir";
    }
    // página pedida
    $pag = (int) $page;
    if ($pag < 1) {
        $pag = 1;
    }
    $offset = ($pag-1) * $limit;

    $query ="SELECT ae.id as id, ae.user as user, ae.answer_one as answer_one,".
            "ae.answer_two as answer_two, ae.datecreated as datecreated".
            " FROM mdl_aulaencuesta ae ".
            " INNER JOIN mdl_user mu ON mu.id = ae.user ".
            " $filtro_query_orden LIMIT $offset, $limit";
    return $DB->get_records_sql($query);
}
/**
 * Get Number of Total Items
 * 
 * @return array
 */
function Aulaencuesta_Get_Total_Items_In_table() 
{
    global $DB;
    $sql = "SELECT count(*) as items FROM mdl_aulaencuesta";
    return $DB->get_record_sql($sql, null);
}

/**
 * Save
 * 
 * @param int    $user        id user
 * @param string $answer_one  answer
 * @param string $answer_two  second answer
 * @param string $datecreated datecreated
 * 
 * @return array
 */
function Aulaencuesta_save($user, $answer_one, $answer_two, $datecreated) 
{
        global $DB;
        $sql_insert = "INSERT INTO mdl_aulaencuesta (user, answer_one,
        answer_two, datecreated) VALUES
        (".$user.",'".$answer_one."','".$answer_two."','".$datecreated."')" ;
        $DB->execute($sql_insert);
}
/**
 * Get username
 * 
 * @param int $id id user
 * 
 * @return string
 */
function Aulaencuesta_Get_username($id)
{
    global $DB;
    $query ="SELECT username FROM {user} WHERE id = ".$id."";
    $result_string = $DB->get_record_sql($query);
    return $result_string->username;
}
/**
 * Estadisticas cursos xls
 * 
 * @return boolean
 */
function Aulaencuesta_Descarga_Datos_xls()
{
    global $DB;
    include_once dirname(__FILE__).'/vendor/xlsxwriter/xlsxwriter.class.php';
    $filename = XLSXWriter::sanitize_filename("DatosEncuestaAulaVirtual.xlsx");
    $contentype = "Content-Type: application/vnd.openxmlformats-officedocument".
    ".spreadsheetml.sheet";
    header('Content-disposition: attachment; filename="'.$filename.'"');
    header($contentype);
    header('Content-Transfer-Encoding: binary'); 
    header('Cache-Control: must-revalidate');
    $header = array( 
        'ID'=>'string',
        'User'=>'string',
        'answer_one'=>'string',
        'answer_two'=>'string',
        'datecreated'=>'string'
    );

    //xls
    $styleHeader = array(
        'fill'=>'#80CAF9',
        'font-style'=>'bold', 
        'border'=>'left,right,
        top,bottom'
    );
    $writer = new XLSXWriter();
    $writer->writeSheetHeader('Sheet1', $header, $styleHeader);
    $array = array();
    
    $sql = "SELECT * FROM {aulaencuesta} ".
    "ORDER BY id DESC";

    $result = $DB->get_records_sql($sql, null);

    foreach ($result as $data) {
        for ($i=0; $i< count(result); $i++ ) {
            $array['A'.$i] = $data->id; 
            $user = Aulaencuesta_Get_username($data->user);
            $array['B'.$i] = (string)$user;
            $array['C'.$i] = (string)$data->answer_one;
            $array['D'.$i] = (string)$data->answer_two;
            $array['E'.$i] = (string)$data->datecreated; 
        } 
        $writer->writeSheetRow('Sheet1', $array);
    } 
    $writer->writeToStdOut();
    return true;
}

$number_report=$_GET['nr'];
if ($number_report == '1') {
    Aulaencuesta_Descarga_Datos_xls();
}