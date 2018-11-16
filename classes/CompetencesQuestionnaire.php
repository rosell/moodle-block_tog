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

defined('MOODLE_INTERNAL') || die();

/**
 * Class that represents the competence questionnaire.
 *
 * @package block_task_oriented_groups
 * @copyright 2018 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class CompetencesQuestionnaire {

    /**
     * The number maximum of posible answers for each question.
     *
     * @var integer
     */
    const MAX_QUESTION_ANSWERS = 5;

    /**
     * Factor used to evaluate the verbal competence.
     */
    const VERBAL_FACTOR = 0;

    /**
     * Factor used to evaluate the logic/mathematics competence.
     */
    const LOGIC_MATHEMATICS_FACTOR = 1;

    /**
     * Factor used to evaluate the visual/spatial competence.
     */
    const VISUAL_SPATIAL_FACTOR = 2;

    /**
     * Factor used to evaluate the kinestesica/corporal competence.
     */
    const KINESTESICA_CORPORAL_FACTOR = 3;

    /**
     * Factor used to evaluate the musical/rhythmic competence.
     */
    const MUSICAL_RHYTHMIC_FACTOR = 4;

    /**
     * Factor used to evaluate the intrapersonal competence.
     */
    const INTRAPERSONAL_FACTOR = 5;

    /**
     * Factor used to evaluate the interpersonal competence.
     */
    const INTERPERSONAL_FACTOR = 6;

    /**
     * Factor used to evaluate the naturalist/environmental competence.
     */
    const NATURALIST_ENVIRONMENTAL_FACTOR = 7;

    /**
     * The types assocaited to each question.
     */
    const QUESTION_FACTORS = [self::VERBAL_FACTOR, self::VISUAL_SPATIAL_FACTOR,
        self::INTRAPERSONAL_FACTOR, self::MUSICAL_RHYTHMIC_FACTOR, self::MUSICAL_RHYTHMIC_FACTOR,
        self::LOGIC_MATHEMATICS_FACTOR, self::INTRAPERSONAL_FACTOR, self::LOGIC_MATHEMATICS_FACTOR,
        self::KINESTESICA_CORPORAL_FACTOR, self::VERBAL_FACTOR, self::VISUAL_SPATIAL_FACTOR,
        self::INTERPERSONAL_FACTOR, self::NATURALIST_ENVIRONMENTAL_FACTOR,
        self::MUSICAL_RHYTHMIC_FACTOR, self::VISUAL_SPATIAL_FACTOR, self::LOGIC_MATHEMATICS_FACTOR,
        self::KINESTESICA_CORPORAL_FACTOR, self::VERBAL_FACTOR, self::INTERPERSONAL_FACTOR,
        self::KINESTESICA_CORPORAL_FACTOR, self::LOGIC_MATHEMATICS_FACTOR,
        self::KINESTESICA_CORPORAL_FACTOR, self::VERBAL_FACTOR, self::VISUAL_SPATIAL_FACTOR,
        self::NATURALIST_ENVIRONMENTAL_FACTOR, self::MUSICAL_RHYTHMIC_FACTOR,
        self::LOGIC_MATHEMATICS_FACTOR, self::INTRAPERSONAL_FACTOR, self::VISUAL_SPATIAL_FACTOR,
        self::MUSICAL_RHYTHMIC_FACTOR, self::NATURALIST_ENVIRONMENTAL_FACTOR,
        self::KINESTESICA_CORPORAL_FACTOR, self::VERBAL_FACTOR, self::INTRAPERSONAL_FACTOR,
        self::INTERPERSONAL_FACTOR, self::NATURALIST_ENVIRONMENTAL_FACTOR, self::INTRAPERSONAL_FACTOR,
        self::INTERPERSONAL_FACTOR, self::INTERPERSONAL_FACTOR, self::NATURALIST_ENVIRONMENTAL_FACTOR
    ];

    /**
     * The index of the questions that does not have help.
     */
    const QUESTIONS_WITHOUT_HELP = [2, 5, 9, 12, 16, 24, 29, 30, 31, 35, 38, 39
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
        return get_string('competence_question_' . $index, 'block_task_oriented_groups');
    }

    /**
     * Check if the specified question has help.
     */
    public static function hasQuestionHelp($index) {
        return array_search($index, self::QUESTIONS_WITHOUT_HELP) === false;
    }

    /**
     * Return the identifier of the help string associated to the question.
     */
    public static function getQuestionHelpIdentifier($index) {
        return 'competence_question_' . $index;
    }

    /**
     * Return the text associated to the specified answers in the question.
     */
    public static function getAnswerQuestionTextOf($index) {
        return get_string('competence_question_answer_' . $index, 'block_task_oriented_groups');
    }

    /**
     * Return the value associated to the specified answers in the question.
     */
    public static function getAnswerQuestionValuetOf($index) {
        switch ($index) {
            case 0:
                return 0.0;
            case 1:
                return 0.25;
            case 2:
                return 0.5;
            case 3:
                return 0.75;
            default:
                return 1.0;
        }
    }
}