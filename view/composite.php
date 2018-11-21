<?php
use block_task_oriented_groups\Personality;
use block_task_oriented_groups\Competences;

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
require_once ($CFG->dirroot . '/group/lib.php');
require_once ($CFG->libdir . '/tablelib.php');

$courseid = optional_param('courseid', 0, PARAM_INT);
$roleid = optional_param('roleid', -1, PARAM_INT);
$PAGE->set_pagelayout('standard');
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('composite_title', 'block_task_oriented_groups'));
$PAGE->set_heading(get_string('composite_heading', 'block_task_oriented_groups'));
$PAGE->set_url($CFG->wwwroot . '/blocks/task_oriented_groups/view/composite.php');

$course = $DB->get_record('course', array('id' => $courseid
), '*', MUST_EXIST);
require_login($course);
context_helper::preload_course($course->id);
$context = context_course::instance($course->id, MUST_EXIST);
$PAGE->set_context($context);

echo $OUTPUT->header();
if (has_capability('moodle/course:managegroups', $context)) {

    $profileroles = get_profile_roles($context);
    if ($roleid == -1) {
        // use the role student or the last one as default for the potencial users.
        foreach ($profileroles as $profilerole) {
            $roleid = $profilerole->id;
            if (strcasecmp('student', $profilerole->shortname) == 0) {
                break;
            }
        }
    }
    $roles = role_fix_names($profileroles, $context, ROLENAME_ALIAS, true);
    $form = html_writer::start_tag('form');
    // --- select role input ----
    $form .= html_writer::start_div('form-group');
    $form .= html_writer::tag('label',
            get_string('composite_select_role_for_users', 'block_task_oriented_groups') .
            '&nbsp;&nbsp' .
            $OUTPUT->help_icon('composite_select_role_for_users', 'block_task_oriented_groups', ''),
            array('for' => 'selectedRoleForUsers'
            ));
    $form .= html_writer::start_tag('select',
            array('class' => 'form-control', 'id' => 'selectedRoleForUsers'
            ));
    foreach ($roles as $fixedroleid => $fixedrolename) {

        $attributes = array('value' => $fixedroleid
        );
        if ($fixedroleid == $roleid) {

            $attributes['selected'] = 'true';
        }
        $form .= html_writer::tag('option', $fixedrolename, $attributes);
    }
    $form .= html_writer::end_tag('select');
    $form .= html_writer::end_div();
    // --- selected users table ----
    $table = new html_table();
    $table->head = array(get_string('composite_column_name', 'block_task_oriented_groups'),
        get_string('composite_column_personality', 'block_task_oriented_groups'),
        get_string('composite_column_competences', 'block_task_oriented_groups'),
        get_string('composite_column_actions', 'block_task_oriented_groups')
    );
    $pageItems = array();
    $pageIndex = 1;
    $students = array();
    foreach (groups_get_potential_members($course->id, $roleid) as $enrolledUser) {
        $personality = Personality::getPersonalityOf($enrolledUser->id);
        $competences = Competences::getCompetencesOf($enrolledUser->id);
        if ($personality && $competences) {
            $student = new \stdClass();
            $student->id = $enrolledUser->id;
            $student->personality = new \stdClass();
            $student->personality->gender = $personality->gender;
            $student->personality->judgment = $personality->judgment;
            $student->personality->attitude = $personality->attitude;
            $student->personality->perception = $personality->perception;
            $student->personality->extrovert = $personality->extrovert;
            $student->competences = new \stdClass();
            $student->competences->verbal = $competences->verbal;
            $student->competences->logic_mathematics = $competences->logic_mathematics;
            $student->competences->visual_spatial = $competences->visual_spatial;
            $student->competences->kinestesica_corporal = $competences->kinestesica_corporal;
            $student->competences->musical_rhythmic = $competences->musical_rhythmic;
            $student->competences->intrapersonal = $competences->intrapersonal;
            $student->competences->interpersonal = $competences->interpersonal;
            $student->competences->naturalist_environmental = $competences->naturalist_environmental;
            $students[] = $student;
        } else {
            $personalityFilled = null;
            if ($personality) {
                $personalityFilled = $OUTPUT->pix_icon('i/grade_correct',
                        get_string('composite_column_personality_filled',
                                'block_task_oriented_groups'));
            } else {
                $personalityFilled = $OUTPUT->pix_icon('i/grade_incorrect',
                        get_string('composite_column_personality_not_filled',
                                'block_task_oriented_groups'));
            }
            $competencesFilled = null;
            if ($competences) {
                $competencesFilled = $OUTPUT->pix_icon('i/grade_correct',
                        get_string('composite_column_competences_filled',
                                'block_task_oriented_groups'));
            } else {
                $competencesFilled = $OUTPUT->pix_icon('i/grade_incorrect',
                        get_string('composite_column_competences_not_filled',
                                'block_task_oriented_groups'));
            }
            $rowPage = floor((count($table->data)) / 5) + 1;
            $row = new html_table_row(
                    array(fullname($enrolledUser), $personalityFilled, $competencesFilled, 'action'
                    ));
            $row->attributes['class'] = 'page-' . $rowPage . ' fill-in-row';
            $table->data[] = $row;
            if ($pageIndex != $rowPage) {
                $pageItems[] = html_writer::tag('li',
                        html_writer::link('#', $pageIndex, array('class' => 'page-link'
                        )), array('class' => 'page-item'
                        ));
                $pageIndex = $rowPage;
            }
        }
    }
    $unfilled = count($table->data);
    if ($unfilled > 0) {

        $form .= html_writer::start_div('alert alert-warning container-fluid',
                array('role' => 'alert'
                ));
        $form .= html_writer::div(
                get_string('composite_unfilled_msg', 'block_task_oriented_groups', $unfilled), 'row');
        $form .= html_writer::div(html_writer::table($table), 'row');
        $form .= html_writer::div(
                html_writer::tag('ul', implode($pageItems),
                        array('class' => 'pagination flex-wrap'
                        )), 'row justify-content-md-center');
        $form .= html_writer::end_div();
    }
    $studentsSize = count($students);
    if ($studentsSize < 1) {

        $form .= html_writer::div(
                get_string('composite_error_not_enough_users', 'block_task_oriented_groups'),
                'alert alert-danger', array('role' => 'alert'
                ));
    } else {

        $form .= html_writer::div(
                html_writer::empty_tag('input',
                        array('id' => 'students', 'value' => json_encode($students)
                        )), '', array('hidden' => 'hidden'
                ));
        // -- enter the grouping name --
        $form .= html_writer::start_div('form-group');
        $form .= html_writer::tag('label',
                get_string('composite_grouping_name', 'block_task_oriented_groups') . '&nbsp;&nbsp' .
                $OUTPUT->help_icon('composite_grouping_name', 'block_task_oriented_groups', ''),
                array('for' => 'groupingName'
                ));
        $form .= html_writer::empty_tag('input',
                array('id' => 'groupingName', 'type' => 'text', 'class' => 'form-control',
                    'placeholder' => get_string('composite_grouping_name_placeholder',
                            'block_task_oriented_groups')
                ));
        $form .= html_writer::end_div();
        // -- enter the grous pattern name --
        $form .= html_writer::start_div('form-group');
        $form .= html_writer::tag('label',
                get_string('composite_groups_pattern', 'block_task_oriented_groups') . '&nbsp;&nbsp' .
                $OUTPUT->help_icon('composite_groups_pattern', 'block_task_oriented_groups', ''),
                array('for' => 'groupsPattern'
                ));
        $form .= html_writer::empty_tag('input',
                array('id' => 'groupsPattern', 'type' => 'text', 'class' => 'form-control',
                    'value' => get_string('composite_groups_pattern_default',
                            'block_task_oriented_groups')
                ));
        $form .= html_writer::end_div();
        // -- select the task requirements --
        $form .= html_writer::div('requirements');
        // -- enter members per team the task requirements
        $form .= html_writer::start_div('form-group');
        $form .= html_writer::tag('label',
                get_string('composite_students_per_group', 'block_task_oriented_groups') .
                '&nbsp;&nbsp' .
                $OUTPUT->help_icon('composite_students_per_group', 'block_task_oriented_groups', ''),
                array('for' => 'studentsPerGroup'
                ));
        $form .= html_writer::empty_tag('input',
                array('id' => 'studentsPerGroup', 'type' => 'number', 'class' => 'form-control',
                    'value' => '2', 'min' => '2'
                ));
        $form .= html_writer::end_div();
        /*
         * <div class="form-check">
         * <input
         * class="form-check-input"
         * type="radio"
         * name="atMostSelection"
         * id="atMostSelectionFalse"
         * value="false"
         * checked
         * > <label
         * class="form-check-label"
         * for="atMostSelectionFalse"
         * > Default radio </label>
         * </div>
         * <div class="form-check">
         * <input
         * class="form-check-input"
         * type="radio"
         * name="atMostSelection"
         * id="atMostSelectionTrue"
         * value="true"
         * > <label
         * class="form-check-label"
         * for="atMostSelectionTrue"
         * > Second default radio </label>
         * </div>
         * <div class="form-group">
         * <label for="overperformance">overperformance</label> <input
         * type="range"
         * class="form-control-range"
         * id="overperformance"
         * >
         * </div>
         * <div class="row justify-content-md-center">
         * <button
         * type="submit"
         * class="btn btn-primary"
         * >Submit</button>
         * </div>
         */
    }
    $form .= html_writer::end_tag('form');
    echo $form;
    $PAGE->requires->js_call_amd('block_task_oriented_groups/composite', 'initialise');
} else {
    echo $html_writer::div(
            get_string('composite_alert_no_capability', 'block_task_oriented_groups'),
            'alert alert-danger', array('role' => 'alert'
            ));
}
echo $OUTPUT->footer();
