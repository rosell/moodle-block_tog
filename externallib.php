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
require_once ($CFG->libdir . "/externallib.php");

use block_task_oriented_groups\PersonalityQuestionnaire;
use block_task_oriented_groups\Personality;
use block_task_oriented_groups\CompetencesQuestionnaire;
use block_task_oriented_groups\Competences;

/**
 * External methods necessary to do ajax interaction.
 *
 * @package block_task_oriented_groups
 * @copyright 2018 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_task_oriented_groups_external extends external_api {

    /**
     * The function called to get the informatiomn of the parameter to store the personality answer.
     */
    public static function store_personality_answer_parameters() {
        return new external_function_parameters(
                array(
                    'question' => new external_value(PARAM_INT,
                            'Contains the question that the user is answering'),
                    'answer' => new external_value(PARAM_INT, 'Contains the answers of the user')
                ));
    }

    /**
     * The function called to store an answer for a personality question.
     */
    public static function store_personality_answer($question, $answer) {
        global $USER;
        $params = self::validate_parameters(self::store_personality_answer_parameters(),
                array('question' => $question, 'answer' => $answer
                ));
        $question = $params['question'];
        $answer = $params['answer'];
        $userid = $USER->id;

        $updated = PersonalityQuestionnaire::setPersonalityAnswerFor($question, $answer, $userid);
        $calculated = false;
        if ($updated) {

            $calculated = Personality::calculatePersonalityOf($userid);
        }
        $result = array();
        $result['success'] = $updated;
        $result['calculated'] = $calculated;
        return $result;
    }

    /**
     * The function called to get the informatiomn of the parameter to store the personality answer.
     */
    public static function store_personality_answer_returns() {
        return new external_single_structure(
                array(
                    'success' => new external_value(PARAM_BOOL,
                            'This is true if the answers has been stored'),
                    'calculated' => new external_value(PARAM_BOOL,
                            'This is true if it is calculated the user personality')
                ));
    }

    /**
     * The function called to get the informatiomn of the parameter to store the competences answer.
     */
    public static function store_competences_answer_parameters() {
        return new external_function_parameters(
                array(
                    'question' => new external_value(PARAM_INT,
                            'Contains the question that the user is answering'),
                    'answer' => new external_value(PARAM_INT, 'Contains the answers of the user')
                ));
    }

    /**
     * The function called to store an answer for a competences question.
     */
    public static function store_competences_answer($question, $answer) {
        global $USER;
        $params = self::validate_parameters(self::store_competences_answer_parameters(),
                array('question' => $question, 'answer' => $answer
                ));
        $question = $params['question'];
        $answer = $params['answer'];
        $userid = $USER->id;

        $updated = CompetencesQuestionnaire::setCompetencesAnswerFor($question, $answer, $userid);
        $calculated = false;
        if ($updated) {

            $calculated = Competences::calculateCompetencesOf($userid);
        }

        $result = array();
        $result['success'] = $updated;
        $result['calculated'] = $calculated;
        return $result;
    }

    /**
     * The function called to get the informatiomn of the parameter to store the competences answer.
     */
    public static function store_competences_answer_returns() {
        return new external_single_structure(
                array(
                    'success' => new external_value(PARAM_BOOL,
                            'This is true if the answers has been stored'),
                    'calculated' => new external_value(PARAM_BOOL,
                            'This is true if it is calculated the user competences')
                ));
    }
}