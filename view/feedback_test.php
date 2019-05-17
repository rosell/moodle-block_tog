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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.
require_once ('../../../config.php');
use block_task_oriented_groups\FeedbackQuestionnaire;

$PAGE->set_pagelayout('standard');
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('feedback_test_title', 'block_task_oriented_groups'));
$PAGE->set_heading(get_string('feedback_test_heading', 'block_task_oriented_groups'));
$PAGE->set_url($CFG->wwwroot . '/blocks/task_oriented_groups/view/feedback_test.php');

require_login();
echo $OUTPUT->header();
$content = html_writer::start_div('container feedback-questions');
// add component to select the grouping
$content .= html_writer::start_div('row');
$content .= html_writer::tag('label', 'select the group to provide feedback');
$content .= html_writer::end_div();
// add component to select the group

$content .= html_writer::start_tag('input',
        array('id' => 'feedback_test__feedbackid', 'type' => 'hidden', 'value' => ''
        ));

// add the questionaire
$content .= html_writer::start_tag('input',
        array('id' => 'feedback_test__max_questions', 'type' => 'hidden',
            'value' => FeedbackQuestionnaire::MAX_QUESTIONS
        ));
for ($i = 0; $i < FeedbackQuestionnaire::MAX_QUESTIONS; $i++) {

    $questionId = 'feedback_test__question_' . $i;
    $content .= html_writer::start_tag('input',
            array('id' => $questionId, 'type' => 'hidden', 'value' => '-2'
            ));
    if ($i % 2 != 0) {

        $content .= html_writer::start_div('row bg-light feedback-question');
    } else {

        $content .= html_writer::start_div('row feedback-question');
    }
    $content .= html_writer::start_div('container');
    $content .= html_writer::start_div('row');
    $content .= html_writer::tag('h4', FeedbackQuestionnaire::getQuestionTextOf($i));
    $content .= html_writer::end_div();
    $content .= html_writer::start_div('row justify-content-center');
    for ($j = 0; $j < FeedbackQuestionnaire::MAX_QUESTION_ANSWERS; $j++) {

        $content .= html_writer::start_div('form-check-inline col-md');
        $content .= html_writer::tag('input', '',
                array('class' => 'form-check-input', 'type' => 'radio',
                    'id' => 'answer_' . $j . '_for_feedback_question_' . $i, 'name' => $questionId,
                    'value' => FeedbackQuestionnaire::getAnswerQuestionValueOf($j)
                ));
        $content .= html_writer::tag('label', FeedbackQuestionnaire::getAnswerQuestionTextOf($j),
                array('for' => 'answer_' . $j . '_for_feedback_question_' . $i,
                    'class' => 'form-check-label'
                ));
        $content .= html_writer::end_div();
    }
    $content .= html_writer::end_div();
    $content .= html_writer::end_div();
    $content .= html_writer::end_div();
}
$content .= html_writer::start_div('row justify-content-md-center');
$content .= html_writer::tag('button',
        get_string('feedback_test_submit', 'block_task_oriented_groups'),
        array('type' => 'button', 'class' => 'btn btn-primary', 'id' => 'feedback_test__submit'
        ));
$content .= html_writer::end_div();
$content .= html_writer::div(
        html_writer::div(
                html_writer::span(
                        get_string('feedback_test_progress', 'block_task_oriented_groups') .
                        html_writer::span('', 'dotdotdot')),
                'progress-bar progress-bar-striped progress-bar-animated',
                array('role' => 'progressbar', 'aria-valuenow' => '75', 'aria-valuemin' => '0',
                    'aria-valuemax' => '100'
                )), 'progress feedback_test-progress', array('id' => 'feedback_test__progress'
        ));

// FINISh the content
$content .= html_writer::end_div();

echo $content;
$PAGE->requires->js_call_amd('block_task_oriented_groups/feedback_test', 'initialise');
echo $OUTPUT->footer();