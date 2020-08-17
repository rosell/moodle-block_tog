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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Data model for the intelligences questionnaire.
 *
 * @package block_tog
 * @copyright 2018 - 2020 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace block_tog;

defined( 'MOODLE_INTERNAL' ) || die();

/**
 * Class that represents the intelligence questionnaire.
 *
 * @copyright 2018 - 2020 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class intelligences_questionnaire {

    /**
     * The number maximum of posible answers for each question.
     *
     * @var integer
     */
    const MAX_QUESTION_ANSWERS = 5;

    /**
     * Factor used to evaluate the verbal intelligence.
     */
    const VERBAL_FACTOR = 0;

    /**
     * Factor used to evaluate the logic/mathematics intelligence.
     */
    const logicmathematics_FACTOR = 1;

    /**
     * Factor used to evaluate the visual/spatial intelligence.
     */
    const visualspatial_FACTOR = 2;

    /**
     * Factor used to evaluate the kinestesica/corporal intelligence.
     */
    const kinestesicacorporal_FACTOR = 3;

    /**
     * Factor used to evaluate the musical/rhythmic intelligence.
     */
    const musicalrhythmic_FACTOR = 4;

    /**
     * Factor used to evaluate the intrapersonal intelligence.
     */
    const INTRAPERSONAL_FACTOR = 5;

    /**
     * Factor used to evaluate the interpersonal intelligence.
     */
    const INTERPERSONAL_FACTOR = 6;

    /**
     * Factor used to evaluate the naturalist/environmental intelligence.
     */
    const naturalistenvironmental_FACTOR = 7;

    /**
     * The types assocaited to each question.
     */
    const QUESTION_FACTORS = [ self::VERBAL_FACTOR, self::visualspatial_FACTOR, self::INTRAPERSONAL_FACTOR,
            self::musicalrhythmic_FACTOR, self::musicalrhythmic_FACTOR, self::logicmathematics_FACTOR, self::INTRAPERSONAL_FACTOR,
            self::logicmathematics_FACTOR, self::kinestesicacorporal_FACTOR, self::VERBAL_FACTOR, self::visualspatial_FACTOR,
            self::INTERPERSONAL_FACTOR, self::naturalistenvironmental_FACTOR, self::musicalrhythmic_FACTOR,
            self::visualspatial_FACTOR, self::logicmathematics_FACTOR, self::kinestesicacorporal_FACTOR, self::VERBAL_FACTOR,
            self::INTERPERSONAL_FACTOR, self::kinestesicacorporal_FACTOR, self::logicmathematics_FACTOR,
            self::kinestesicacorporal_FACTOR, self::VERBAL_FACTOR, self::visualspatial_FACTOR, self::naturalistenvironmental_FACTOR,
            self::musicalrhythmic_FACTOR, self::logicmathematics_FACTOR, self::INTRAPERSONAL_FACTOR, self::visualspatial_FACTOR,
            self::musicalrhythmic_FACTOR, self::naturalistenvironmental_FACTOR, self::kinestesicacorporal_FACTOR,
            self::VERBAL_FACTOR, self::INTRAPERSONAL_FACTOR, self::INTERPERSONAL_FACTOR, self::naturalistenvironmental_FACTOR,
            self::INTRAPERSONAL_FACTOR, self::INTERPERSONAL_FACTOR, self::INTERPERSONAL_FACTOR, self::naturalistenvironmental_FACTOR
    ];

    /**
     * The index of the questions that does not have help.
     */
    const QUESTIONS_WITHOUT_HELP = [ 2, 5, 9, 12, 16, 24, 29, 30, 31, 35, 38, 39
    ];

    /**
     * Load user answers.
     */
    public function __construct() {
    }

    /**
     * Return the number of questions that have the questionnaire.
     *
     * @return int the nukmber of question in the questionnaire.
     */
    public static function count_questions() {
        return count( self::QUESTION_FACTORS );
    }

    /**
     * Return the facor associated to the question.
     *
     * @param int $index
     *            of the question to obtain the factor.
     *
     * @return int the factor associated to the question.
     */
    public static function get_question_factor($index) {
        return self::QUESTION_FACTORS [$index];
    }

    /**
     * Return the text associated to the question.
     *
     * @param int $index
     *            of the question to obtain the text.
     *
     * @return string the localized text for the question.
     */
    public static function get_question_text_of($index) {
        return get_string( 'intelligence_question_' . $index, 'block_tog' );
    }

    /**
     * Check if the specified question has help.
     *
     * @param int $index
     *            of the question to check.
     *
     * @return boolean true if the question has help message.
     */
    public static function has_question_help($index) {
        return array_search( $index, self::QUESTIONS_WITHOUT_HELP ) === false;
    }

    /**
     * Return the identifier of the help string associated to the question.
     *
     * @param int $index
     *            of the question to obtain the help identifier.
     *
     * @return string the identifier for the quesiton help.
     */
    public static function get_question_help_identifier($index) {
        return 'intelligence_question_' . $index;
    }

    /**
     * Return the text associated to the specified answers in the question.
     *
     * @param int $index
     *            of the answer to obtain the text.
     *
     * @return string the localized text for the answer.
     */
    public static function get_answer_question_text_of($index) {
        return get_string( 'intelligence_question_answer_' . $index, 'block_tog' );
    }

    /**
     * Return the value associated to the specified answers in the question.
     *
     * @param int $index
     *            of the answer to obtain the value.
     *
     * @return double the value associated to the answer.
     */
    public static function get_answer_question_value_of($index) {
        switch ($index) {
            case 0 :
                return 0.0;
            case 1 :
                return 0.25;
            case 2 :
                return 0.5;
            case 3 :
                return 0.75;
            default :
                return 1.0;
        }
    }

    /**
     * Get the answers done by the current user for the intelligences questions.
     *
     * @return stdObject[]|boolean the intelligences answers of the current user or false if cannot obtain the answers.
     */
    public static function get_answers_of_current_user() {
        global $USER;
        return self::get_answers_of( $USER->id );
    }

    /**
     * Get the answers done by spoecified user for the intelligences questions.
     *
     * @param int $userid
     *            identifier of the user to obtain the number of answers.
     *
     * @return stdObject[]|boolean the intelligences answers of a user or false if cannot obtain the answers.
     */
    public static function get_answers_of($userid) {
        global $DB;
        return $DB->get_records( 'block_tog_intel_answers', array ('userid' => $userid
        ), 'question', 'question,answer' );
    }

    /**
     * Store the answer of an user to a intelligences question.
     *
     * @param int $question
     *            identifier of the question.
     * @param int $answer
     *            identifier of the answer.
     * @param int $userid
     *            identifier of the user.
     *
     * @return boolean true if the answer has been stored.
     */
    public static function set_intelligences_answer_for($question, $answer, $userid) {
        global $DB;
        $updated = false;
        $previousanswer = $DB->get_record( 'block_tog_intel_answers', array ('userid' => $userid, 'question' => $question
        ), '*', IGNORE_MISSING );

        if ($previousanswer !== false && isset( $previousanswer )) {
            $previousanswer->answer = $answer;
            $updated = $DB->update_record( 'block_tog_intel_answers', $previousanswer );
        } else {
            $record = new \stdClass();
            $record->userid = $userid;
            $record->question = $question;
            $record->answer = $answer;
            $updated = $DB->insert_record( 'block_tog_intel_answers', $record, false ) === true;
        }

        return $updated;
    }
}
