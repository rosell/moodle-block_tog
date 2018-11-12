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

$PAGE->set_pagelayout('standard');
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('competences_test_title', 'block_task_oriented_groups'));
$PAGE->set_heading(get_string('competences_test_heading', 'block_task_oriented_groups'));
$PAGE->set_url($CFG->wwwroot . '/blocks/task_oriented_groups/view/competences_test.php');

require_login();

echo $OUTPUT->header();
?>
<div class="container competences-questions">
	<?php
for ($i = 0; $i < CompetencesQuestionnaire::countQuestions(); $i++) {
    $questionId = 'competencesQuestion_' . $i;
    ?>
		<div class="row competences-question<?php

    if ($i % 2 != 0) {
        echo ' bg-light';
    }
    ?>">
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
    for ($j = 0; $j < CompetencesQuestionnaire::MAX_QUESTION_ANSWERS; $j++) {
        ?>
			<div class="form-check-inline col-md">
					<input
						class="form-check-input"
						type="radio"
						id="answers_<?=$j?>_for_competences_question_<?=$i?>"
						name="<?=$questionId?>"
						value="<?=CompetencesQuestionnaire::getAnswerQuestionValuetOf($j)?>"
					><label
						class="form-check-label"
						for="answers_<?=$j?>_for_competences_question_<?=$i?>"
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
?>

</div>
<?php
echo $OUTPUT->footer();