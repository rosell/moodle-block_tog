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
 * Data model for the intelligences of an user.
 *
 * @package block_tog
 * @copyright 2018 - 2020 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace block_tog;

defined( 'MOODLE_INTERNAL' ) || die();

use block_tog\intelligences_questionnaire;

/**
 * Class that represents the intelligences that an user can have.
 *
 * @copyright 2018 - 2020 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class intelligences {

    /**
     * Return the coimpetences of teh current user.
     *
     * @return stdObject|boolean the intelligences associated to the user or false if the user does
     *         not have a intelligences.
     */
    public static function get_intelligences_of_current_user() {
        global $USER;
        return self::get_intelligences_of( $USER->id );
    }

    /**
     * Return the the intelligences of an user.
     *
     * @param int $userid
     * @return stdObject|boolean the intelligences associated to the user or false if the user does
     *         not have a intelligences.
     */
    public static function get_intelligences_of($userid) {
        global $DB;

        $intelligences = $DB->get_record( 'block_tog_intelligences', array ('userid' => $userid
        ), '*', IGNORE_MISSING );
        if ($intelligences !== false && isset( $intelligences )) {
            return $intelligences;
        } else {
            return false;
        }
    }

    /**
     * Calculate the intelligences of the specified user.
     *
     * @param int $userid
     *
     * @return boolean true if the intelligences has been calculated.
     */
    public static function calculate_intelligences_of($userid) {
        global $DB;

        $calculated = false;

        $answers = intelligences_questionnaire::get_answers_of( $userid );
        if (count( $answers ) == intelligences_questionnaire::count_questions()) {
            $record = new \stdClass();
            $record->userid = $userid;
            $record->linguistic = 0.0;
            $record->logicalmathematical = 0.0;
            $record->spatial = 0.0;
            $record->bodilykinesthetic = 0.0;
            $record->musical = 0.0;
            $record->intrapersonal = 0.0;
            $record->interpersonal = 0.0;
            $record->environmental = 0.0;
            $total = [ 0, 0, 0, 0, 0, 0, 0, 0
            ];
            foreach ($answers as $answer) {
                $factor = intelligences_questionnaire::get_question_factor( $answer->question );
                $value = intelligences_questionnaire::get_answer_question_value_of( $answer->answer );
                switch ($factor) {
                    case intelligences_questionnaire::LINGUISTIC_FACTOR:
                        $record->linguistic += $value;
                        $total [0] ++;
                        break;
                    case intelligences_questionnaire::LOGICAL_MATHEMATICAL_FACTOR:
                        $record->logicalmathematical += $value;
                        $total [1] ++;
                        break;
                    case intelligences_questionnaire::SPATIAL_FACTOR:
                        $record->spatial += $value;
                        $total [2] ++;
                        break;
                    case intelligences_questionnaire::BODILY_KINESTHETIC_FACTOR:
                        $record->bodilykinesthetic += $value;
                        $total [3] ++;
                        break;
                    case intelligences_questionnaire::MUSICAL_FACTOR:
                        $record->musical += $value;
                        $total [4] ++;
                        break;
                    case intelligences_questionnaire::INTRAPERSONAL_FACTOR:
                        $record->intrapersonal += $value;
                        $total [5] ++;
                        break;
                    case intelligences_questionnaire::INTERPERSONAL_FACTOR:
                        $record->interpersonal += $value;
                        $total [6] ++;
                        break;
                    default:
                        // It has to be intelligences_questionnaire::ENVIRONMENTAL_FACTOR.
                        $record->environmental += $value;
                        $total [7] ++;
                }
            }
            $record->linguistic = $record->linguistic / $total [0];
            $record->logicalmathematical = $record->logicalmathematical / $total [1];
            $record->spatial = $record->spatial / $total [2];
            $record->bodilykinesthetic = $record->bodilykinesthetic / $total [3];
            $record->musical = $record->musical / $total [4];
            $record->intrapersonal = $record->intrapersonal / $total [5];
            $record->interpersonal = $record->interpersonal / $total [6];
            $record->environmental = $record->environmental / $total [7];

            $previousanswer = self::get_intelligences_of( $userid );
            if ($previousanswer !== false) {
                $record->id = $previousanswer->id;
                $calculated = $DB->update_record( 'block_tog_intelligences', $record );
            } else {
                $calculated = $DB->insert_record( 'block_tog_intelligences', $record, false ) === true;
            }
        }

        return $calculated;
    }

    /**
     * Check if it is calculated the intelligences for the current user.
     *
     * @return boolean true if the intelligences are calculated for the current user.
     */
    public static function is_intelligences_calculated_for_current_user() {
        global $USER;
        return self::is_intelligences_calculated_for( $USER->id );
    }

    /**
     * Check if for an user has calculated its intelligences.
     *
     * @param int $userid
     *            identifier of the user to check if it has fillen in the intelligences test.
     *
     * @return boolean true if the intelligences are calculated for the user.
     */
    public static function is_intelligences_calculated_for($userid) {
        global $DB;
        return $DB->record_exists( 'block_tog_intelligences', array ('userid' => $userid
        ) );
    }

    /**
     * Convert a intelligence value to a human readable value.
     *
     * @param number $value
     *            to obtain the text.
     *
     * @return string the human readable text associated to the value.
     */
    public static function value_to_string($value) {
        $index = floor( $value / 0.2 );
        $index = min( 4, $index );
        return get_string( 'intelligences_value_' . $index, 'block_tog' );
    }
}
