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
use block_task_oriented_groups\CompetencesQuestionnaire;
use block_task_oriented_groups\Competences;

$PAGE->set_pagelayout('standard');
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('competences_test_title', 'block_task_oriented_groups'));
$PAGE->set_heading(get_string('competences_test_heading', 'block_task_oriented_groups'));
$PAGE->set_url($CFG->wwwroot . '/blocks/task_oriented_groups/view/competences_test.php');

require_login();
$answers = CompetencesQuestionnaire::getAnswersOfCurrentUser();
echo $OUTPUT->header();
?>
<div class="container competences-questions">
 <?php
for ($i = 0; $i < CompetencesQuestionnaire::countQuestions(); $i++) {
    $questionId = 'competencesQuestion_' . $i;
    ?>
  <div class="row<?php

    if ($i % 2 != 0) {
        echo ' bg-light';
    }
    ?> competences-question">
		<div class="container">
			<div class="row">
				<h4><?=CompetencesQuestionnaire::getQuestionTextOf($i)?><?php

    if (CompetencesQuestionnaire::hasQuestionHelp($i)) {
        echo '&nbsp;&nbsp;';
        echo $OUTPUT->help_icon(CompetencesQuestionnaire::getQuestionHelpIdentifier($i),
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

    for ($j = 0; $j < CompetencesQuestionnaire::MAX_QUESTION_ANSWERS; $j++) {
        ?>
   <div class="form-check-inline col-md">
					<input
						class="form-check-input"
						type="radio"
						id="answer_<?=$j?>_for_competences_question_<?=$i?>"
						name="<?=$questionId?>"
						value="<?=CompetencesQuestionnaire::getAnswerQuestionValueOf($j)?>"
						<?php

        if ($selected == $j) {
            echo 'checked="checked"';
        }
        ?>
					><label
						class="form-check-label"
						for="answer_<?=$j?>_for_competences_question_<?=$i?>"
					><?=CompetencesQuestionnaire::getAnswerQuestionTextOf($j)?></label>
				</div>
  <?php
    }
    ?>
   </div>
		</div>
	</div>
  <?php
}
if (Competences::getCompetencesOfCurrentUser()) {

    $linkstr = get_string('competences_test_go_to_competences', 'block_task_oriented_groups');
    $linkaddr = $CFG->wwwroot . '/blocks/task_oriented_groups/view/competences.php';
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
$PAGE->requires->js_call_amd('block_task_oriented_groups/competences_test', 'initialise');
echo $OUTPUT->footer();