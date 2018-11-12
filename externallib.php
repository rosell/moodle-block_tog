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
/**
 * External methods necessary to do ajax interaction.
 *
 * @package block_task_oriented_groups
 * @copyright 2018 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once ($CFG->libdir . "/externallib.php");
class block_task_oriented_groups_external extends external_api {

    /**
     * The function called to get the informatiomn of the parameter to store the answer.
     */
    public static function store_answer_parameters() {
        return new external_function_parameters(array());
    }

    /**
     * The function called to store an answer for a question.
     */
    public static function store_answer() {
        $result = array();
        $result['code'] = 'OK';
        return $result;
    }

    /**
     * The function called to get the informatiomn of the parameter to store the answer.
     */
    public static function store_answer_returns() {
        return new external_single_structure(
                array('code' => new external_value(PARAM_TEXT, 'Result text')
                ));
    }
}