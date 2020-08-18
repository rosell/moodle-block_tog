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
 * View for fill in the feedback questionnaire.
 *
 * @package block_tog
 * @copyright 2018 - 2020 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
// Disable format @formatter:off.
require_once('../../../config.php');
// Enable format @formatter:on.
global $CFG;
global $PAGE;
global $DB;
global $OUTPUT;
// Disable format @formatter:off.
require_once($CFG->dirroot . '/group/lib.php');
// Enable format @formatter:on.
use block_tog\feedback_questionnaire;

$courseid = optional_param( 'courseid', 0, PARAM_INT );
$PAGE->set_pagelayout( 'standard' );
$PAGE->set_context( context_system::instance() );
$PAGE->set_title( get_string( 'feedback_test_title', 'block_tog' ) );
$PAGE->set_heading( get_string( 'feedback_test_heading', 'block_tog' ) );
$PAGE->set_url( $CFG->wwwroot . '/blocks/tog/view/feedback_test.php' );
$PAGE->add_body_class( 'block_task_oriented_group' );

$course = $DB->get_record( 'course', array ('id' => $courseid
), '*', MUST_EXIST );
require_login( $course );
context_helper::preload_course( $course->id );
$context = context_course::instance( $course->id, MUST_EXIST );
$PAGE->set_context( $context );

echo $OUTPUT->header();
if (has_capability( 'moodle/course:managegroups', $context )) {

    // Add component to select the grouping.
    $defaultfeedbackid = null;
    $defaultgroupingid = null;
    $groupingoptions = '';
    $groupselectors = '';

    $groupings = groups_get_all_groupings( $course->id );
    foreach ($groupings as $grouping) {
        $defaultgroupfeedbackid = null;
        $groupselectoroptions = '';
        $groups = groups_get_all_groups( $course->id, 0, $grouping->id );
        foreach ($groups as $group) {
            $composed = $DB->get_record( 'block_tog_composed',
                    array ('groupingid' => $grouping->id, 'groupid' => $group->id
                    ), '*', IGNORE_MISSING );
            if ($composed !== false && isset( $composed )) {
                $groupselectoroptions .= html_writer::tag( 'option', $group->name,
                        array ('value' => $composed->feedbackid, 'class' => 'feedback_test-group_option'
                        ) );
                if ($defaultfeedbackid == null) {
                    $defaultfeedbackid = $composed->feedbackid;
                }
                if ($defaultgroupfeedbackid == null) {
                    $defaultgroupfeedbackid = $composed->feedbackid;
                }
            }
        }

        if ($defaultgroupfeedbackid != null) {
            if ($defaultgroupingid == null) {
                $defaultgroupingid = $grouping->id;
            }
            $groupingoptions .= html_writer::tag( 'option', $grouping->name,
                    array ('value' => $grouping->id, 'class' => 'feedback_test-grouping_option'
                    ) );
            $groupselector = html_writer::start_div( 'form-row',
                    array ('id' => 'feedback_test__group_row_for_' . $grouping->id,
                            'class' => 'feedback_test__group_row'
                    ) );
            $groupselector .= html_writer::start_div( 'form-group' );
            $groupselector .= html_writer::tag( 'label',
                    get_string( 'feedback_test_group_selector', 'block_tog' ) . '&nbsp;&nbsp' .
                    $OUTPUT->help_icon( 'feedback_test_group_selector', 'block_tog', '' ),
                    array ('for' => 'feedback_test__group_selector_for_' . $grouping->id
                    ) );
            $groupselector .= html_writer::tag( 'select', $groupselectoroptions,
                    array ('class' => 'form-control feedback_test__group_selector',
                            'id' => 'feedback_test__group_selector_for_' . $grouping->id,
                            'value' => $defaultgroupfeedbackid
                    ) );
            $groupselector .= html_writer::end_div();
            $groupselector .= html_writer::end_div();
            $groupselectors .= $groupselector;
        }
    }
    $groupingselector = html_writer::start_div( 'form-row' );
    $groupingselector .= html_writer::start_div( 'form-group' );
    $groupingselector .= html_writer::tag( 'label',
            get_string( 'feedback_test_grouping_selector', 'block_tog' ) . '&nbsp;&nbsp' .
            $OUTPUT->help_icon( 'feedback_test_grouping_selector', 'block_tog', '' ),
            array ('for' => 'feedback_test__grouping_selector'
            ) );
    $groupingselector .= html_writer::start_tag( 'select',
            array ('class' => 'form-control', 'id' => 'feedback_test__grouping_selector', 'value' => $defaultgroupingid
            ) );
    $groupingselector .= $groupingoptions;
    $groupingselector .= html_writer::end_tag( 'select' );
    $groupingselector .= html_writer::end_div();
    $groupingselector .= html_writer::end_div();

    $content = html_writer::div( get_string( 'feedback_test_alert_empty', 'block_tog' ), 'alert alert-danger',
            array ('role' => 'alert', 'id' => 'feedback_test__alert_empty'
            ) );
    if ($defaultfeedbackid == null) {
        echo $content;
    } else {
        $content .= html_writer::start_tag( 'form', array ('id' => 'feedback_test__form'
        ) );
        $content .= html_writer::empty_tag( 'input',
                array ('id' => 'feedback_test__feedbackid', 'type' => 'hidden', 'value' => $defaultfeedbackid
                ) );
        $content .= html_writer::start_tag( 'fieldset', array ('class' => 'border p-2'
        ) );
        $content .= html_writer::tag( 'legend',
                get_string( 'feedback_test_group', 'block_tog' ) . '&nbsp;&nbsp' .
                $OUTPUT->help_icon( 'feedback_test_group', 'block_tog', '' ), array ('class' => 'w-auto'
                ) );
        $content .= $groupingselector;
        $content .= $groupselectors;
        $content .= html_writer::end_tag( 'fieldset' );

        // Add the questionaire.
        $content .= html_writer::start_div( 'container feedback-questions' );
        $content .= html_writer::empty_tag( 'input',
                array ('id' => 'feedback_test__max_questions', 'type' => 'hidden',
                        'value' => feedback_questionnaire::MAX_QUESTIONS
                ) );
        for ($i = 0; $i < feedback_questionnaire::MAX_QUESTIONS; $i ++) {
            $questionid = 'feedback_test__question_' . $i;
            if ($i % 2 != 0) {
                $content .= html_writer::start_div( 'row bg-light feedback-question' );
            } else {
                $content .= html_writer::start_div( 'row feedback-question' );
            }
            $content .= html_writer::empty_tag( 'input',
                    array ('id' => $questionid, 'type' => 'hidden', 'value' => '-2'
                    ) );
            $content .= html_writer::start_div( 'container' );

            $content .= html_writer::start_div( 'row' );
            $content .= html_writer::tag( 'h4', feedback_questionnaire::get_question_text_of( $i ) );
            $content .= html_writer::end_div();

            $content .= html_writer::start_div( 'row justify-content-center' );
            for ($j = 0; $j < feedback_questionnaire::MAX_QUESTION_ANSWERS; $j ++) {
                $content .= html_writer::start_div( 'form-check-inline col-md' );
                $content .= html_writer::tag( 'input', '',
                        array ('class' => 'form-check-input feedback_test-answer-input', 'type' => 'radio',
                                'id' => 'answer_' . $j . '_for_feedback_question_' . $i, 'name' => $questionid,
                                'value' => feedback_questionnaire::get_answer_question_value_of( $j )
                        ) );
                $content .= html_writer::tag( 'label', feedback_questionnaire::get_answer_question_text_of( $j ),
                        array ('for' => 'answer_' . $j . '_for_feedback_question_' . $i, 'class' => 'form-check-label'
                        ) );
                $content .= html_writer::end_div();
            }
            $content .= html_writer::end_div();

            // End question row.
            $content .= html_writer::end_div();
            $content .= html_writer::end_div();
        }
        $content .= html_writer::start_div( 'row feedback-question' );
        $content .= html_writer::start_div( 'container' );
        $content .= html_writer::start_div( 'row justify-content-center' );
        $content .= html_writer::tag( 'button', get_string( 'feedback_test_submit', 'block_tog' ),
                array ('type' => 'button', 'class' => 'btn btn-primary', 'id' => 'feedback_test__submit'
                ) );
        $content .= html_writer::end_div();
        $content .= html_writer::end_div();
        $content .= html_writer::end_div();
        $content .= html_writer::div(
                html_writer::div(
                        html_writer::span(
                                get_string( 'feedback_test_progress', 'block_tog' ) .
                                html_writer::span( '', 'dotdotdot' ) ),
                        'progress-bar progress-bar-striped progress-bar-animated',
                        array ('role' => 'progressbar', 'aria-valuenow' => '75', 'aria-valuemin' => '0',
                                'aria-valuemax' => '100'
                        ) ), 'progress feedback_test-progress', array ('id' => 'feedback_test__progress'
                ) );

        // FINISh the content.
        $content .= html_writer::end_tag( 'form' );
        $content .= html_writer::div( get_string( 'feedback_test_alert_submit_success', 'block_tog' ),
                'alert alert-success', array ('role' => 'alert', 'id' => 'feedback_test__alert_submit_success'
                ) );

        echo $content;
        $PAGE->requires->js_call_amd( 'block_tog/feedback_test', 'initialise' );
    }
} else {
    echo html_writer::div( get_string( 'feedback_test_alert_no_capability', 'block_tog' ), 'alert alert-danger',
            array ('role' => 'alert'
            ) );
}
echo $OUTPUT->footer();
