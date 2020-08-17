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
 * Data model for the personality of a user.
 *
 * @package block_tog
 * @copyright 2018 - 2020 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace block_tog;

defined( 'MOODLE_INTERNAL' ) || die();

use block_tog\personality_questionnaire;

/**
 * Class used to manage the personality of an user.
 *
 * @copyright 2018 - 2020 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class personality {

    /**
     * Calculate the personality of the specified user.
     *
     * @param int $userid
     *            identifier of teh user.
     *
     * @return boolean true if the personality has been calculated.
     */
    public static function calculate_personality_of($userid) {
        global $DB;

        $calculated = false;

        $answers = personality_questionnaire::get_answers_of( $userid );
        if (count( $answers ) == personality_questionnaire::count_questions()) {
            $record = new \stdClass();
            $record->userid = $userid;
            $record->type = '';
            $record->gender = 0;
            $record->judgment = 0.0;
            $record->attitude = 0.0;
            $record->perception = 0.0;
            $record->extrovert = 0.0;
            $total = [ 0, 0, 0, 0
            ];
            foreach ($answers as $answer) {
                $factor = personality_questionnaire::get_question_factor( $answer->question );
                $value = personality_questionnaire::get_answer_question_value_of( $answer->question, $answer->answer );
                switch ($factor) {
                    case personality_questionnaire::JUDGMENT_FACTOR :
                        $record->judgment += $value;
                        $total [0] ++;
                        break;
                    case personality_questionnaire::ATTITUDE_FACTOR :
                        $record->attitude += $value;
                        $total [1] ++;
                        break;
                    case personality_questionnaire::PERCEPTION_FACTOR :
                        $record->perception += $value;
                        $total [2] ++;
                        break;
                    case personality_questionnaire::EXTROVERT_FACTOR :
                        $record->extrovert += $value;
                        $total [3] ++;
                        break;
                    default :
                        // Gender answer.
                        if ($value > 0) {
                            // It is a male.
                            $record->gender = 1;
                        } else {
                            // It is a female.
                            $record->gender = 0;
                        }
                }
            }
            $record->judgment = $record->judgment / $total [0];
            $record->attitude = $record->attitude / $total [1];
            $record->perception = $record->perception / $total [2];
            $record->extrovert = $record->extrovert / $total [3];
            if ($record->extrovert > 0) {
                $record->type .= 'E';
            } else {
                $record->type .= 'I';
            }
            if ($record->perception > 0) {
                $record->type .= 'N';
            } else {
                $record->type .= 'S';
            }
            if ($record->judgment > 0) {
                $record->type .= 'T';
            } else {
                $record->type .= 'F';
            }
            if ($record->attitude > 0) {
                $record->type .= 'J';
            } else {
                $record->type .= 'P';
            }

            $previousanswer = self::get_personality_of( $userid );
            if ($previousanswer !== false) {
                $record->id = $previousanswer->id;
                $calculated = $DB->update_record( 'block_tog_personality', $record );
            } else {
                $calculated = $DB->insert_record( 'block_tog_personality', $record, false ) === true;
            }
        }

        return $calculated;
    }

    /**
     * Return the coimpetences of teh current user.
     *
     * @return stdObject|boolean the personality associated to the user or false if the user does
     *         not have a personality.
     */
    public static function get_personality_of_current_user() {
        global $USER;
        return self::get_personality_of( $USER->id );
    }

    /**
     * Return the the personality of an user.
     *
     * @param int $userid
     *            identifier of the user to obtain the personality.
     *
     * @return stdObject|boolean the personality associated to the user or false if the user does
     *         not have a personality.
     */
    public static function get_personality_of($userid) {
        global $DB;

        $personality = $DB->get_record( 'block_tog_personality', array ('userid' => $userid
        ), '*', IGNORE_MISSING );
        if ($personality !== false && isset( $personality )) {
            return $personality;
        } else {
            return false;
        }
    }

    /**
     * Check if it is calculated the personality for the current user.
     *
     * @return boolean trus if the personalkity has been calculated for the current user.
     */
    public static function is_personality_calculated_for_current_user() {
        global $USER;
        return self::is_personality_calculated_for( $USER->id );
    }

    /**
     * Check if for an user has calculated its personality.
     *
     * @param int $userid
     *            identifier of the user to check if the perosnlaity has been calculated.
     *
     * @return boolean trus if the personalkity has been calculated for a user.
     */
    public static function is_personality_calculated_for($userid) {
        global $DB;
        return $DB->record_exists( 'block_tog_personality', array ('userid' => $userid
        ) );
    }
}
