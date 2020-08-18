<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * View to auti fill a questionnaire.
 *
 * @package block_tog
 * @copyright 2018 - 2020 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
// Disable format @formatter:off.
require_once('../../../config.php');
require_once($CFG->dirroot . '/group/lib.php');
require_once($CFG->libdir . '/tablelib.php');
// Enable format @formatter:on.

use block_tog\personality;
use block_tog\intelligences;

$courseid = optional_param( 'courseid', 0, PARAM_INT );
$PAGE->set_pagelayout( 'standard' );
$PAGE->set_context( context_system::instance() );
$PAGE->set_title( get_string( 'auto_fill_in_title', 'block_tog' ) );
$PAGE->set_heading( get_string( 'auto_fill_in_heading', 'block_tog' ) );
$PAGE->set_url( $CFG->wwwroot . '/blocks/tog/view/auto_fill_in.php' );
$PAGE->add_body_class( 'block_task_oriented_group' );

$course = $DB->get_record( 'course', array ('id' => $courseid
), '*', MUST_EXIST );
require_login( $course );
context_helper::preload_course( $course->id );
$context = context_course::instance( $course->id, MUST_EXIST );
$PAGE->set_context( $context );

echo $OUTPUT->header();
$table = new html_table();
$table->head = array (new html_table_cell( get_string( 'auto_fill_in_column_name', 'block_tog' ) ),
        new html_table_cell( get_string( 'auto_fill_in_column_personality', 'block_tog' ) ),
        new html_table_cell( get_string( 'auto_fill_in_column_intelligences', 'block_tog' ) )
);
$table->head [0]->attributes ['class'] = 'col-6';
$table->head [1]->attributes ['class'] = 'col-3 text-center';
$table->head [2]->attributes ['class'] = 'col-3 text-center';

$pageitems = array ();
$pageindex = 1;
foreach (groups_get_potential_members( $course->id ) as $enrolleduser) {
    $personality = personality::get_personality_of( $enrolleduser->id );
    $intelligences = intelligences::get_intelligences_of( $enrolleduser->id );

    $personalityfilled = null;
    if ($personality == false) {
        $personalityfilled = html_writer::start_div( 'personality-cell', array ('data-user-id' => $enrolleduser->id
        ) );
        $personalityfilled .= html_writer::div(
                $OUTPUT->pix_icon( 'i/grade_correct',
                        get_string( 'auto_fill_in_column_personality_filled', 'block_tog' ) ),
                'personality-cell-success' );
        $personalityfilled .= html_writer::div(
                html_writer::tag( 'button', get_string( 'auto_fill_in_submit_personality', 'block_tog' ),
                        array ('class' => 'auto-fill-in-personality'
                        ) ), 'personality-cell-submit' );
        $personalityfilled .= html_writer::end_div();
    } else {
        $personalityfilled = $OUTPUT->pix_icon( 'i/grade_correct',
                get_string( 'auto_fill_in_column_personality_filled', 'block_tog' ) );
    }
    $intelligencesfilled = null;
    if ($intelligences == false) {
        $intelligencesfilled = html_writer::start_div( 'intelligences-cell',
                array ('data-user-id' => $enrolleduser->id
                ) );
        $intelligencesfilled .= html_writer::div(
                $OUTPUT->pix_icon( 'i/grade_correct',
                        get_string( 'auto_fill_in_column_intelligences_filled', 'block_tog' ) ),
                'intelligences-cell-success' );
        $intelligencesfilled .= html_writer::div(
                html_writer::tag( 'button', get_string( 'auto_fill_in_submit_intelligences', 'block_tog' ),
                        array ('class' => 'auto-fill-in-intelligences'
                        ) ), 'intelligences-cell-submit' );
        $intelligencesfilled .= html_writer::end_div();
    } else {
        $intelligencesfilled = $OUTPUT->pix_icon( 'i/grade_correct',
                get_string( 'auto_fill_in_column_intelligences_filled', 'block_tog' ) );
    }
    $rowpage = floor( (count( $table->data )) / 20 ) + 1;
    $row = new html_table_row( array (fullname( $enrolleduser ), $personalityfilled, $intelligencesfilled
    ) );
    $row->cells [0]->attributes ['class'] = 'col-6';
    $row->cells [1]->attributes ['class'] = 'col-3 text-center';
    $row->cells [2]->attributes ['class'] = 'col-3 text-center';
    $row->attributes ['class'] = 'page-' . $rowpage . ' fill-in-row';
    $table->data [] = $row;
    if ($pageindex != $rowpage) {
        $pageitems [] = html_writer::tag( 'li', html_writer::link( '#', $pageindex, array ('class' => 'page-link'
        ) ), array ('class' => 'page-item'
        ) );
        $pageindex = $rowpage;
    }
}

echo html_writer::start_div( 'container-fluid' );
echo html_writer::div( html_writer::table( $table ), 'row' );
echo html_writer::div( html_writer::tag( 'ul', implode( $pageitems ), array ('class' => 'pagination flex-wrap'
) ), 'row justify-content-md-center' );
echo html_writer::end_div();
$PAGE->requires->js_call_amd( 'block_tog/auto_fill_in', 'initialise' );
echo $OUTPUT->footer();
