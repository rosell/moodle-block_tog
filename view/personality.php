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
use block_task_oriented_groups\Personality;

$PAGE->set_pagelayout('standard');
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('personality_title', 'block_task_oriented_groups'));
$PAGE->set_heading(get_string('personality_heading', 'block_task_oriented_groups'));
$PAGE->set_url($CFG->wwwroot . '/blocks/task_oriented_groups/view/personality.php');
$PAGE->add_body_class('block_task_oriented_group');

require_login();
$personality = Personality::getPersonalityOfCurrentUser();
$l10npersonality = new \stdClass();
$l10npersonality->type = $personality->type;
$l10npersonality->name = get_string('personality_' . $personality->type . '_name',
        'block_task_oriented_groups');
$l10npersonality->description = get_string('personality_' . $personality->type . '_description',
        'block_task_oriented_groups');
echo $OUTPUT->header();
?>
<div class="container">
	<div class="row">
		<p><?=get_string('personality_msg', 'block_task_oriented_groups', $l10npersonality)?></p>
	</div>
	<div class="row justify-content-md-center">
		<a
			class="btn btn-secondary"
			href="<?=get_string('personality_' . $personality->type . '_more', 'block_task_oriented_groups')?>"
			role="button"
		><?=get_string('personality_read_more', 'block_task_oriented_groups')?></a> <a
			class="btn btn-primary"
			href="<?=$CFG->wwwroot . '/blocks/task_oriented_groups/view/personality_test.php'?>"
			role="button"
		><?=get_string('personality_go_to_test', 'block_task_oriented_groups')?></a>
	</div>
</div>
<?php
echo $OUTPUT->footer();