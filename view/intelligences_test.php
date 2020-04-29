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
use block_task_oriented_groups\IntelligencesQuestionnaire;
use block_task_oriented_groups\Intelligences;

$PAGE->set_pagelayout('standard');
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('intelligences_test_title', 'block_task_oriented_groups'));
$PAGE->set_heading(get_string('intelligences_test_heading', 'block_task_oriented_groups'));
$PAGE->set_url($CFG->wwwroot . '/blocks/task_oriented_groups/view/intelligences_test.php');
$PAGE->add_body_class('block_task_oriented_group');

require_login();
$answers = IntelligencesQuestionnaire::getAnswersOfCurrentUser();
echo $OUTPUT->header();
?>
<div class="container intelligences-questions">
 <?php
for ($i = 0; $i < IntelligencesQuestionnaire::countQuestions(); $i++) {
    $questionId = 'intelligencesQuestion_' . $i;
    ?>
  <div class="row<?php

    if ($i % 2 != 0) {
        echo ' bg-light';
    }
    ?> intelligences-question">
		<div class="container">
			<div class="row">
				<h4><?=IntelligencesQuestionnaire::getQuestionTextOf($i)?><?php

    if (IntelligencesQuestionnaire::hasQuestionHelp($i)) {
        echo '&nbsp;&nbsp;';
        echo $OUTPUT->help_icon(IntelligencesQuestionnaire::getQuestionHelpIdentifier($i),
                'block_task_oriented_groups', '');
    }
    ?></h4>
			</div>
			<div class="row justify-content-center">
  <?php
    $selected = -1;
    foreach ($answers as $k => $answer) {
        if ($answer->question == $i) {
            $selected = $answer->answer;
            unset($answers[$k]);
            break;
        }
    }

    for ($j = 0; $j < IntelligencesQuestionnaire::MAX_QUESTION_ANSWERS; $j++) {
        ?>
   <div class="form-check-inline col-md">
					<input
						class="form-check-input"
						type="radio"
						id="answer_<?=$j?>_for_intelligences_question_<?=$i?>"
						name="<?=$questionId?>"
						value="<?=IntelligencesQuestionnaire::getAnswerQuestionValueOf($j)?>"
						<?php

        if ($selected == $j) {
            echo 'checked="checked"';
        }
        ?>
					><label
						class="form-check-label"
						for="answer_<?=$j?>_for_intelligences_question_<?=$i?>"
					><?=IntelligencesQuestionnaire::getAnswerQuestionTextOf($j)?></label>
				</div>
  <?php
    }
    ?>
   </div>
		</div>
	</div>
  <?php
}
if (Intelligences::getIntelligencesOfCurrentUser()) {

    $linkstr = get_string('intelligences_test_go_to_intelligences', 'block_task_oriented_groups');
    $linkaddr = $CFG->wwwroot . '/blocks/task_oriented_groups/view/intelligences.php';
    ?>
    	<div class="row justify-content-md-center">
		<a
			class="btn btn-primary"
			href="<?=$linkaddr?>"
			role="button"
		><?=$linkstr?></a>
	</div>
    <?php
}
?>
</div>
<?php
$PAGE->requires->js_call_amd('block_task_oriented_groups/intelligences_test', 'initialise');
echo $OUTPUT->footer();