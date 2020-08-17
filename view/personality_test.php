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
 * View to fill in the personality questionnaire.
 *
 * @package block_tog
 * @copyright 2018 - 2020 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once ('../../../config.php');
use block_tog\personality_questionnaire;
use block_tog\personality;
use block_tog\intelligences;

$PAGE->set_pagelayout( 'standard' );
$PAGE->set_context( context_system::instance() );
$courseid = optional_param( 'courseid', null, PARAM_INT );
$PAGE->set_title( get_string( 'personality_test_title', 'block_tog' ) );
$PAGE->set_heading( get_string( 'personality_test_heading', 'block_tog' ) );
$PAGE->set_url( $CFG->wwwroot . '/blocks/tog/view/personality_test.php' );
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
$answers = personality_questionnaire::get_answers_of_current_user();
echo $OUTPUT->header();
?>
<div class="container personality-questions">
 <?php
for ($i = 0; $i < personality_questionnaire::count_questions(); $i ++) {
    $questionid = 'personalityQuestion_' . $i;
    ?>
  <div
		class="row<?php

    if ($i % 2 != 0) {
        echo ' bg-light';
    }
    ?> personality-question">
		<div class="container">
			<div class="row">
				<h4><?=personality_questionnaire::get_question_text_of( $i )?><?php

    if (personality_questionnaire::has_question_help( $i )) {
        echo '&nbsp;&nbsp;';
        echo $OUTPUT->help_icon( personality_questionnaire::get_question_help_identifier( $i ), 'block_tog', '' );
    }
    ?></h4>
			</div>
			<div class="row justify-content-center">
  <?php
    $selected = - 1;
    foreach ($answers as $k => $answer) {
        if ($answer->question == $i) {
            $selected = $answer->answer;
            unset( $answers [$k] );
            break;
        }
    }

    for ($j = 0; $j < personality_questionnaire::MAX_QUESTION_ANSWERS; $j ++) {
        ?>
   <div class="form-check-inline col-md">
					<input class="form-check-input" type="radio"
						id="answer_<?=$j?>_for_personality_question_<?=$i?>"
						name="<?=$questionid?>"
						value="<?=personality_questionnaire::get_answer_question_value_of( $i, $j )?>"
						<?php

        if ($selected == $j) {
            echo 'checked="checked"';
        }
        ?>><label class="form-check-label"
						for="answer_<?=$j?>_for_personality_question_<?=$i?>"><?=personality_questionnaire::get_answer_question_text_of( $i, $j )?></label>
				</div>
  <?php
    }
    ?>
   </div>
		</div>
	</div>
  <?php
}
$personality_url = $CFG->wwwroot . '/blocks/tog/view/personality.php';
if ($courseid) {
    $personality_url .= '?courseid=' . $courseid;
}
?>
   	<div class="row justify-content-md-center actions-row">
		<div class="alert alert-warning blink" role="alert"
			style="display: none;">
   			<?=get_string( 'personality_test_storing_msg', 'block_tog' )?>
   		</div>
   		<?php
    $intelligences = intelligences::get_intelligences_of_current_user();
    if (! $intelligences) {
        $intelligences_test_url = $CFG->wwwroot . '/blocks/tog/view/intelligences_test.php';
        if ($courseid) {
            $intelligences_test_url .= '?courseid=' . $courseid;
        }
        ?>
		<button type="button" class="btn btn-secondary"
			onclick="location.href='<?=$intelligences_test_url?>';" role="button">
			<?=get_string( 'personality_test_go_to_intelligences_test', 'block_tog' )?>
		</button>
        <?php
    }
    ?>
		<button type="button" class="btn btn-primary"
			onclick="location.href='<?=$personality_url?>';" role="button">
			<?=get_string( 'personality_test_go_to_personality', 'block_tog' )?>
		</button>
		<?php
if ($courseid) {
    ?>
		<button type="button" class="btn btn-secondary"
			onclick="location.href='<?=$CFG->wwwroot . '/course/view.php?id=' . $courseid?>';"
			role="button">
        	<?=get_string( 'personality_test_go_to_course', 'block_tog' )?>
        </button>
        <?php
}
?>
</div>
<?php
$PAGE->requires->js_call_amd( 'block_tog/personality_test', 'initialise' );
echo $OUTPUT->footer();
