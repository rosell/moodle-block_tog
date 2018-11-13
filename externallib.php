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
        global $DB, $USER;
        $params = self::validate_parameters(self::store_personality_answer_parameters(),
                array('question' => $question, 'answer' => $answer
                ));
        $updated = FALSE;
        try {

            $previousAnswer = $DB->get_record('btog_personality_answers',
                    array('userid' => $USER->id, 'question' => $question
                    ), '*', IGNORE_MISSING);

            if ($previousAnswer !== FALSE && isset($previousAnswer)) {

                $previousAnswer->answer = $answer;
                $updated = $DB->update_record('btog_personality_answers', $previousAnswer);
            } else {

                $record = new stdClass();
                $record->userid = $USER->id;
                $record->question = $question;
                $record->answer = $answer;
                $updated = $DB->insert_record('btog_personality_answers', $record, FALSE) === TRUE;
            }
        } catch (Exception $ex) {
        }

        $result = array();
        $result['success'] = $updated;
        return $result;
    }

    /**
     * The function called to get the informatiomn of the parameter to store the personality answer.
     */
    public static function store_personality_answer_returns() {
        return new external_single_structure(
                array(
                    'success' => new external_value(PARAM_BOOL,
                            'This is true if the answers has been stored')
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
        global $DB, $USER;
        $params = self::validate_parameters(self::store_competences_answer_parameters(),
                array('question' => $question, 'answer' => $answer
                ));
        $updated = FALSE;
        try {

            $previousAnswer = $DB->get_record('btog_competences_answers',
                    array('userid' => $USER->id, 'question' => $question
                    ), '*', IGNORE_MISSING);

            if ($previousAnswer !== FALSE && isset($previousAnswer)) {

                $previousAnswer->answer = $answer;
                $updated = $DB->update_record('btog_competences_answers', $previousAnswer);
            } else {

                $record = new stdClass();
                $record->userid = $USER->id;
                $record->question = $question;
                $record->answer = $answer;
                $updated = $DB->insert_record('btog_competences_answers', $record, FALSE) === TRUE;
            }
        } catch (Exception $ex) {
        }

        $result = array();
        $result['success'] = $updated;
        return $result;
    }

    /**
     * The function called to get the informatiomn of the parameter to store the competences answer.
     */
    public static function store_competences_answer_returns() {
        return new external_single_structure(
                array(
                    'success' => new external_value(PARAM_BOOL,
                            'This is true if the answers has been stored')
                ));
    }
}