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
namespace block_task_oriented_groups;

/**
 * Class that represents teh personality questionnaire.
 *
 * @package block_task_oriented_groups
 * @copyright 2018 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class PersonalityQuestionnaire {

    /**
     * The number maximum of posible answers for each question.
     *
     * @var integer
     */
    const MAX_QUESTION_ANSWERS = 3;

    /**
     * Factor used to evaluate the judgment of a person.
     */
    const JUDGMENT_FACTOR = 0;

    /**
     * Factor used to evaluate the judgment of a person.
     */
    const ATTITUDE_FACTOR = 1;

    /**
     * Factor used to evaluate the judgment of a person.
     */
    const PERCEPTION_FACTOR = 2;

    /**
     * Factor used to evaluate the judgment of a person.
     */
    const EXTROVERT_FACTOR = 3;

    /**
     * The types assocaited to each question.
     */
    const QUESTION_FACTORS = [self::JUDGMENT_FACTOR, self::ATTITUDE_FACTOR, self::PERCEPTION_FACTOR,
        self::EXTROVERT_FACTOR, self::JUDGMENT_FACTOR, self::ATTITUDE_FACTOR, self::ATTITUDE_FACTOR,
        self::PERCEPTION_FACTOR, self::EXTROVERT_FACTOR, self::JUDGMENT_FACTOR, self::EXTROVERT
    ];

    /**
     * The index of the questions that have help.
     */
    const QUESTIONS_WITH_HELP = [0, 1, 4, 6, 7, 8, 9
    ];

    /**
     * Load user answers.
     */
    public function __construct() {
    }

    /**
     * Return the number of questions that have the questionnaire.
     */
    public static function countQuestions() {
        return count(self::QUESTION_FACTORS);
    }

    /**
     * Return the text associated to the question.
     */
    public static function getQuestionTextOf($index) {
        return get_string('personality_question_' . $index, 'block_task_oriented_groups');
    }

    /**
     * Check if the specified question has help.
     */
    public static function hasQuestionHelp($index) {
        return array_search($index, self::QUESTIONS_WITH_HELP) !== FALSE;
    }

    /**
     * Return the identifier of the help string associated to the question.
     */
    public static function getQuestionHelpIdentifier($index) {
        return 'personality_question_' . $index;
    }

    /**
     * Return the text associated to the specified answers in the question.
     */
    public static function getAnswerQuestionTextOf($question, $index) {
        return get_string('personality_question_' . $question . '_answer_' . $index,
                'block_task_oriented_groups');
    }

    /**
     * Return the value associated to the specified answers in the question.
     */
    public static function getAnswerQuestionValuetOf($question, $index) {
        switch ($index) {
            case 0:
                return -1;
            case 1:
                return 1;
                break;
            default:
                return 0;
        }
    }
}