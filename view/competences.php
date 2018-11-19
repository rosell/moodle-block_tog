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
use block_task_oriented_groups\Competences;

$PAGE->set_pagelayout('standard');
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('competences_title', 'block_task_oriented_groups'));
$PAGE->set_heading(get_string('competences_heading', 'block_task_oriented_groups'));
$PAGE->set_url($CFG->wwwroot . '/blocks/task_oriented_groups/view/competences.php');

require_login();
$competences = Competences::getCompetencesOfCurrentUser();
echo $OUTPUT->header();
?>
<div class="container">
	<div class="row">
		<p><?=get_string('competences_msg','block_task_oriented_groups')?></p>
	</div>
	<div class="row">
		<ul>
			<li><b><?=get_string('competences_verbal_factor','block_task_oriented_groups')?>:</b>&nbsp;<?=Competences::valueToString($competences->verbal)?></li>
			<li><b><?=get_string('competences_logic_mathematics_factor','block_task_oriented_groups')?>:</b>&nbsp;<?=Competences::valueToString($competences->logic_mathematics)?></li>
			<li><b><?=get_string('competences_visual_spatial_factor','block_task_oriented_groups')?>:</b>&nbsp;<?=Competences::valueToString($competences->visual_spatial)?></li>
			<li><b><?=get_string('competences_kinestesica_corporal_factor','block_task_oriented_groups')?>:</b>&nbsp;<?=Competences::valueToString($competences->kinestesica_corporal)?></li>
			<li><b><?=get_string('competences_musical_rhythmic_factor','block_task_oriented_groups')?>:</b>&nbsp;<?=Competences::valueToString($competences->musical_rhythmic)?></li>
			<li><b><?=get_string('competences_intrapersonal_factor','block_task_oriented_groups')?>:</b>&nbsp;<?=Competences::valueToString($competences->intrapersonal)?></li>
			<li><b><?=get_string('competences_interpersonal_factor','block_task_oriented_groups')?>:</b>&nbsp;<?=Competences::valueToString($competences->interpersonal)?></li>
			<li><b><?=get_string('competences_naturalist_environmental_factor','block_task_oriented_groups')?>:</b>&nbsp;<?=Competences::valueToString($competences->naturalist_environmental)?></li>
		</ul>
	</div>
	<div class="row justify-content-md-center">
		<a
			class="btn btn-primary"
			href="<?=$CFG->wwwroot .'/blocks/task_oriented_groups/view/competences_test.php'?>"
			role="button"
		><?=get_string('competences_go_to_test','block_task_oriented_groups')?></a>
	</div>
</div>
<?php
echo $OUTPUT->footer();