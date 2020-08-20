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
 * View to show the intelligences of an user.
 *
 * @package block_tog
 * @copyright 2018 - 2020 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
// Disable format @formatter:off.
require_once('../../../config.php');
// Enable format @formatter:off.
use block_tog\intelligences;
use block_tog\personality;

$PAGE->set_pagelayout( 'standard' );
$PAGE->set_context( context_system::instance() );
$PAGE->set_title( get_string( 'intelligences_title', 'block_tog' ) );
$PAGE->set_heading( get_string( 'intelligences_heading', 'block_tog' ) );
$PAGE->set_url( $CFG->wwwroot . '/blocks/tog/view/intelligences.php' );
$PAGE->add_body_class( 'block_task_oriented_group' );

$courseid = optional_param( 'courseid', 0, PARAM_INT );
if ($courseid) {
    $course = $DB->get_record( 'course', array ('id' => $courseid
    ), '*', MUST_EXIST );
    require_login( $course );
    context_helper::preload_course( $course->id );
    $context = context_course::instance( $course->id, MUST_EXIST );
    $PAGE->set_context( $context );
} else {
    require_login();
}
$intelligences = intelligences::get_intelligences_of_current_user();
echo $OUTPUT->header();

echo html_writer::start_div( 'container-fluid' );
if ($intelligences) {
    echo html_writer::start_div( 'row' );
    echo html_writer::tag( 'p', get_string( 'intelligences_msg', 'block_tog' ) );
    echo html_writer::end_div();
    echo html_writer::start_div( 'row' );
    echo html_writer::start_tag( 'ul' );
    echo html_writer::tag( 'li',
            html_writer::tag( 'b', get_string( 'intelligences_linguistic', 'block_tog' ) ) .
            $OUTPUT->help_icon( 'intelligences_linguistic', 'block_tog', '' ).
            intelligences::value_to_string( $intelligences->linguistic ) );
    echo html_writer::tag( 'li',
            html_writer::tag( 'b', get_string( 'intelligences_logicalmathematical', 'block_tog' ) ) .
            $OUTPUT->help_icon( 'intelligences_logicalmathematical', 'block_tog', '' ).
            intelligences::value_to_string( $intelligences->logicalmathematical ) );
    echo html_writer::tag( 'li',
            html_writer::tag( 'b', get_string( 'intelligences_spatial', 'block_tog' ) ) .
            $OUTPUT->help_icon( 'intelligences_spatial', 'block_tog', '' ).
            intelligences::value_to_string( $intelligences->spatial ) );
    echo html_writer::tag( 'li',
            html_writer::tag( 'b', get_string( 'intelligences_bodilykinesthetic', 'block_tog' ) ) .
            $OUTPUT->help_icon( 'intelligences_bodilykinesthetic', 'block_tog', '' ).
            intelligences::value_to_string( $intelligences->bodilykinesthetic ) );
    echo html_writer::tag( 'li',
            html_writer::tag( 'b', get_string( 'intelligences_musical', 'block_tog' ) ) .
            $OUTPUT->help_icon( 'intelligences_musical', 'block_tog', '' ).
            intelligences::value_to_string( $intelligences->musical ) );
    echo html_writer::tag( 'li',
            html_writer::tag( 'b', get_string( 'intelligences_intrapersonal', 'block_tog' ) ) .
            $OUTPUT->help_icon( 'intelligences_intrapersonal', 'block_tog', '' ).
            intelligences::value_to_string( $intelligences->intrapersonal ) );
    echo html_writer::tag( 'li',
            html_writer::tag( 'b', get_string( 'intelligences_interpersonal', 'block_tog' ) ) .
            $OUTPUT->help_icon( 'intelligences_interpersonal', 'block_tog', '' ).
            intelligences::value_to_string( $intelligences->interpersonal ) );
    echo html_writer::tag( 'li',
            html_writer::tag( 'b', get_string( 'intelligences_environmental', 'block_tog' ) ) .
            $OUTPUT->help_icon( 'intelligences_environmental', 'block_tog', '' ).
            intelligences::value_to_string( $intelligences->environmental ) );
    echo html_writer::end_tag( 'ul' );
    echo html_writer::end_div();
} else {
    echo html_writer::div( get_string( 'intelligences_error_not_answered_all_questions', 'block_tog' ), 'alert alert-danger',
            array ('role' => 'alert'
            ) );
}
$intelligencestesturl = $CFG->wwwroot . '/blocks/tog/view/intelligences_test.php';
if ($courseid) {
    $intelligencestesturl .= '?courseid=' . $courseid;
}

echo html_writer::start_div( 'row justify-content-md-center actions-row' );
$personality = personality::get_personality_of_current_user();
if (! $personality) {
    $personalitytesturl = $CFG->wwwroot . '/blocks/tog/view/personality_test.php';
    if ($courseid) {
        $personalitytesturl .= '?courseid=' . $courseid;
    }
    echo html_writer::tag( 'button', get_string( 'intelligences_go_to_personality_test', 'block_tog' ),
            array ('type' => 'button', 'class' => 'btn btn-secondary', 'role' => 'button',
                    'onclick' => 'location.href="' . $personalitytesturl . '";'
            ) );
}

echo html_writer::tag( 'button', get_string( 'intelligences_go_to_test', 'block_tog' ),
        array ('type' => 'button', 'class' => 'btn btn-primary', 'role' => 'button',
                'onclick' => 'location.href="' . $intelligencestesturl . '";'
        ) );

if ($courseid) {
    echo html_writer::tag( 'button', get_string( 'intelligences_go_to_course', 'block_tog' ),
            array ('type' => 'button', 'class' => 'btn btn-secondary', 'role' => 'button',
                    'onclick' => 'location.href="' . $CFG->wwwroot . '/course/view.php?id=' . $courseid . '";'
            ) );
}
echo html_writer::end_div();
echo html_writer::end_div();
echo $OUTPUT->footer();
