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

use block_task_oriented_groups\CompetencesQuestionnaire;

/**
 * Class that represents the competences questionnaire.
 *
 * @package block_task_oriented_groups
 * @copyright 2018 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class Competences {

    /**
     * Return the the competences of an user.
     *
     * @param int $userid
     * @return stdObject/boolean the competences associated to the user or false if the user does
     *         not have a competences.
     */
    public static function getCompetencesOf($userid) {
        global $DB;

        $competences = $DB->get_record('btog_competences', array('userid' => $userid
        ), '*', IGNORE_MISSING);
        if ($competences !== false && isset($competences)) {

            return $competences;
        } else {

            return false;
        }
    }

    /**
     * Calculate the competences of the specified user.
     *
     * @param int $userid
     * @return boolean true if the competences has been calculated.
     */
    public static function calculateCompetencesOf($userid) {
        global $DB;

        $calculated = false;

        $answers = CompetencesQuestionnaire::getAnswersOf($userid);
        if (count($answers) == CompetencesQuestionnaire::countQuestions()) {

            $record = new \stdClass();
            $record->userid = $userid;
            $record->verbal = 0.0;
            $record->logic_mathematics = 0.0;
            $record->visual_spatial = 0.0;
            $record->kinestesica_corporal = 0.0;
            $record->musical_rhythmic = 0.0;
            $record->intrapersonal = 0.0;
            $record->interpersonal = 0.0;
            $record->naturalist_environmental = 0.0;
            $total = [0, 0, 0, 0, 0, 0, 0, 0
            ];
            foreach ($answers as $answer) {

                $factor = CompetencesQuestionnaire::getQuestionFactor($answer->question);
                $value = CompetencesQuestionnaire::getAnswerQuestionValueOf($answer->answer);
                switch ($factor) {
                    case CompetencesQuestionnaire::VERBAL_FACTOR:
                        $record->verbal += $value;
                        $total[0]++;
                        break;
                    case CompetencesQuestionnaire::LOGIC_MATHEMATICS_FACTOR:
                        $record->logic_mathematics += $value;
                        $total[1]++;
                        break;
                    case CompetencesQuestionnaire::VISUAL_SPATIAL_FACTOR:
                        $record->visual_spatial += $value;
                        $total[2]++;
                        break;
                    case CompetencesQuestionnaire::KINESTESICA_CORPORAL_FACTOR:
                        $record->kinestesica_corporal += $value;
                        $total[3]++;
                        break;
                    case CompetencesQuestionnaire::MUSICAL_RHYTHMIC_FACTOR:
                        $record->musical_rhythmic += $value;
                        $total[4]++;
                        break;
                    case CompetencesQuestionnaire::INTRAPERSONAL_FACTOR:
                        $record->intrapersonal += $value;
                        $total[5]++;
                        break;
                    case CompetencesQuestionnaire::INTERPERSONAL_FACTOR:
                        $record->interpersonal += $value;
                        $total[6]++;
                        break;
                    default:
                        // CompetencesQuestionnaire::NATURALIST_ENVIRONMENTAL_FACTOR:
                        $record->naturalist_environmental += $value;
                        $total[7]++;
                }
            }
            $record->verbal = $record->verbal / $total[0];
            $record->logic_mathematics = $record->logic_mathematics / $total[1];
            $record->visual_spatial = $record->visual_spatial / $total[2];
            $record->kinestesica_corporal = $record->kinestesica_corporal / $total[3];
            $record->musical_rhythmic = $record->verbal / $total[4];
            $record->intrapersonal = $record->logic_mathematics / $total[5];
            $record->interpersonal = $record->visual_spatial / $total[6];
            $record->naturalist_environmental = $record->kinestesica_corporal / $total[7];

            $previousAnswer = self::getCompetencesOf($userid);
            if ($previousAnswer !== false) {

                $record->id = $previousAnswer->id;
                $calculated = $DB->update_record('btog_competences', $record);
            } else {

                $calculated = $DB->insert_record('btog_competences', $record, false) === true;
            }
        }

        return $calculated;
    }

    /**
     * Check if it is calculated the competences for the current user.
     */
    public static function isCompetencesCalculatedForCurrentUser() {
        global $USER;
        return self::isCompetencesCalculatedFor($USER->id);
    }

    /**
     * Check if for an user has calculated its competences.
     */
    public static function isCompetencesCalculatedFor($userid) {
        global $DB;
        return $DB->record_exists('btog_competences', array('userid' => $userid
        ));
    }
}