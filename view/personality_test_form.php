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
require_once ("{$CFG->libdir}/formslib.php");

/**
 * Form to fill in the personality test.
 *
 * @package block_task_oriented_groups
 * @category blocks
 * @copyright UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class personality_test_form extends moodleform {

    function definition() {
        $mform = & $this->_form;
        $radioarray = array();
        $radioarray[] = $mform->createElement('radio', 'yesno', '',
                get_string('yes', 'block_task_oriented_groups'), 1, '');
        $radioarray[] = $mform->createElement('radio', 'yesno', '',
                get_string('no', 'block_task_oriented_groups'), 0, '');
        $mform->addGroup($radioarray, 'radioar',
                get_string('question1', 'block_task_oriented_groups'), array(' '
                ), false);
        $mform->addGroup($radioarray, 'radioar2',
                get_string('question2', 'block_task_oriented_groups'), array(' '
                ), false);
    }
}