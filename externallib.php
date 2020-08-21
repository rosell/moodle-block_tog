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
 * External methods necessary to do ajax interaction.
 *
 * @package block_tog
 * @copyright 2018 - 2020 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined( 'MOODLE_INTERNAL' ) || die();
global $CFG;
// Disable format @formatter:off.
require_once($CFG->libdir . '/externallib.php');
require_once($CFG->dirroot . '/group/lib.php');
// Enable format @formatter:on.

use block_tog\personality;
use block_tog\intelligences;
use block_tog\personality_questionnaire;
use block_tog\intelligences_questionnaire;

/**
 * Define the interaction API.
 *
 * @copyright 2018 - 2020 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_tog_external extends external_api {

    /**
     * The function called to get the informatiomn of the parameter to store the personality answer.
     */
    public static function store_personality_answer_parameters() {
        return new external_function_parameters(
                array (
                        'question' => new external_value( PARAM_INT, 'Contains the question that the user is answering' ),
                        'answer' => new external_value( PARAM_INT, 'Contains the answers of the user' )
                ) );
    }

    /**
     * The function called to store an answer for a personality question.
     *
     * @param int $question
     *            identifier of the question.
     * @param int $answer
     *            identifier of the answer.
     */
    public static function store_personality_answer($question, $answer) {
        global $USER;
        $params = self::validate_parameters( self::store_personality_answer_parameters(),
                array ('question' => $question, 'answer' => $answer
                ) );
        $question = $params ['question'];
        $answer = $params ['answer'];
        $userid = $USER->id;

        $updated = personality_questionnaire::set_personality_answer_for( $question, $answer, $userid );
        $calculated = false;
        if ($updated) {
            $calculated = personality::calculate_personality_of( $userid );
        }
        $result = array ();
        $result ['success'] = $updated;
        $result ['calculated'] = $calculated;
        return $result;
    }

    /**
     * The function called to get the informatiomn of the parameter to store the personality answer.
     */
    public static function store_personality_answer_returns() {
        return new external_single_structure(
                array ('success' => new external_value( PARAM_BOOL, 'This is true if the answers has been stored' ),
                        'calculated' => new external_value( PARAM_BOOL,
                                'This is true if it is calculated the user personality' )
                ) );
    }

    /**
     * The function called to get the informatiomn of the parameter to store the intelligences
     * answer.
     */
    public static function store_intelligences_answer_parameters() {
        return new external_function_parameters(
                array (
                        'question' => new external_value( PARAM_INT, 'Contains the question that the user is answering' ),
                        'answer' => new external_value( PARAM_INT, 'Contains the answers of the user' )
                ) );
    }

    /**
     * The function called to store an answer for a intelligences question.
     *
     * @param int $question
     *            identifier of the question.
     * @param int $answer
     *            identifier of the answer.
     */
    public static function store_intelligences_answer($question, $answer) {
        global $USER;
        $params = self::validate_parameters( self::store_intelligences_answer_parameters(),
                array ('question' => $question, 'answer' => $answer
                ) );
        $question = $params ['question'];
        $answer = $params ['answer'];
        $userid = $USER->id;

        $updated = intelligences_questionnaire::set_intelligences_answer_for( $question, $answer, $userid );
        $calculated = false;
        if ($updated) {
            $calculated = intelligences::calculate_intelligences_of( $userid );
        }

        $result = array ();
        $result ['success'] = $updated;
        $result ['calculated'] = $calculated;
        return $result;
    }

    /**
     * The function called to get the informatiomn of the parameter to store the intelligences
     * answer.
     */
    public static function store_intelligences_answer_returns() {
        return new external_single_structure(
                array ('success' => new external_value( PARAM_BOOL, 'This is true if the answers has been stored' ),
                        'calculated' => new external_value( PARAM_BOOL,
                                'This is true if it is calculated the user intelligences' )
                ) );
    }

    /**
     * The function called to get the informatiomn of the parameter to composite groups.
     */
    public static function composite_groups_parameters() {
        $requirement = new external_single_structure(
                [ 'level' => new external_value( PARAM_FLOAT, 'The level for the requirement' ),
                        'importance' => new external_value( PARAM_FLOAT, 'The importance for the requirement' )
                ], 'Requirement values', VALUE_OPTIONAL );
        return new external_function_parameters(
                array ('courseid' => new external_value( PARAM_INT, 'The identifier of the course to add the groups' ),
                        'memberspergroups' => new external_value( PARAM_INT, 'Number of memebrs per each group' ),
                        'atmost' => new external_value( PARAM_BOOL,
                                'This is true if the member per group can not be more that the specified' ),
                        'groupingname' => new external_value( PARAM_TEXT, 'Name of the grouping to generate' ),
                        'namepattern' => new external_value( PARAM_TEXT, 'Pattern to generate the group names' ),
                        'performance' => new external_value( PARAM_FLOAT,
                                'Value that indicates if the groups are under or over performance' ),
                        'members' => new external_multiple_structure(
                                new external_single_structure(
                                        [
                                                'id' => new external_value( core_user::get_property_type( 'id' ),
                                                        'ID of the member' ),
                                                'gender' => new external_value( PARAM_TEXT, 'The gender of the member' ),
                                                'personality' => new external_single_structure(
                                                        [
                                                                'judgment' => new external_value( PARAM_FLOAT,
                                                                        'The value for the personality judgment' ),
                                                                'attitude' => new external_value( PARAM_FLOAT,
                                                                        'The value for the personality attitude' ),
                                                                'perception' => new external_value( PARAM_FLOAT,
                                                                        'The value for the personality perception' ),
                                                                'extrovert' => new external_value( PARAM_FLOAT,
                                                                        'The value for the personality extrovert' )
                                                        ], 'Contains the member personality' ),
                                                'intelligences' => new external_single_structure(
                                                        [
                                                                'linguistic' => new external_value( PARAM_FLOAT,
                                                                        'The value for the intelligences linguistic' ),
                                                                'logicalmathematical' => new external_value(
                                                                        PARAM_FLOAT,
                                                                        'The value for the intelligences logic mathematics' ),
                                                                'spacial' => new external_value( PARAM_FLOAT,
                                                                        'The value for the intelligences spacial' ),
                                                                'bodilykinesthetic' => new external_value( PARAM_FLOAT,
                                                                        'The value for the intelligences kinestesica corporal' ),
                                                                'musical' => new external_value( PARAM_FLOAT,
                                                                        'The value for the intelligences musical rhythmic' ),
                                                                'intrapersonal' => new external_value( PARAM_FLOAT,
                                                                        'The value for the intelligences intrapersonal' ),
                                                                'interpersonal' => new external_value( PARAM_FLOAT,
                                                                        'The value for the intelligences interpersonal' ),
                                                                'environmental' => new external_value( PARAM_FLOAT,
                                                                        'The value for the intelligences naturalist environmental' )
                                                        ], 'Contains the member personality' )
                                        ] ), 'The members that can be form part of a group' ),
                        'requirements' => new external_single_structure(
                                [ 'linguistic' => $requirement, 'logicalmathematical' => $requirement,
                                        'spacial' => $requirement, 'bodilykinesthetic' => $requirement,
                                        'musical' => $requirement, 'intrapersonal' => $requirement,
                                        'interpersonal' => $requirement, 'environmental' => $requirement
                                ], 'The requirements for the groups' )
                ) );
    }

    /**
     * The function called to composite the new groups.
     *
     * @param int $courseid
     *            identifier of the course.
     * @param int $memberspergroups
     *            number of members for each goup.
     * @param boolean $atmost
     *            is true if the number of member of group is a maximum.
     * @param string $groupingname
     *            name for the gtoupoing formation.
     * @param string $namepattern
     *            pattern of the name to generate for each goup.
     * @param double $performance
     *            expected for the group.
     * @param stdObject[] $members
     *            members to group.
     * @param stdObject[] $requirements
     *            fro the groups to create.
     */
    public static function composite_groups($courseid, $memberspergroups, $atmost, $groupingname, $namepattern,
            $performance, $members, $requirements) {
        global $DB;
        $updated = false;
        $calculated = false;
        $message = '';

        try {
            $params = self::validate_parameters( self::composite_groups_parameters(),
                    array ('courseid' => $courseid, 'memberspergroups' => $memberspergroups, 'atmost' => $atmost,
                            'groupingname' => $groupingname, 'namepattern' => $namepattern,
                            'performance' => $performance, 'members' => $members, 'requirements' => $requirements
                    ) );

            $courseid = $params ['courseid'];
            $memberspergroups = $params ['memberspergroups'];
            $atmost = $params ['atmost'];
            $groupingname = $params ['groupingname'];
            $namepattern = $params ['namepattern'];
            $performance = $params ['performance'];
            $members = $params ['members'];
            $requirements = $params ['requirements'];

            $data = new \stdClass();
            $data->peoplePerTeam = intval( $memberspergroups );
            $data->atmost = boolval( $atmost );
            $data->performance = floatval( $performance );
            $data->people = array ();
            foreach ($members as $member) {
                $person = new \stdClass();
                $person->id = $member [id];
                $person->gender = $member [gender];
                $person->personality = array ();
                $perception = new \stdClass();
                $perception->factor = 'PERCEPTION';
                $perception->value = floatval( $member [personality] [perception] );
                $person->personality [] = $perception;
                $judgment = new \stdClass();
                $judgment->factor = 'JUDGMENT';
                $judgment->value = floatval( $member [personality] [judgment] );
                $person->personality [] = $judgment;
                $extrovert = new \stdClass();
                $extrovert->factor = 'EXTROVERT';
                $extrovert->value = floatval( $member [personality] [extrovert] );
                $person->personality [] = $extrovert;
                $attitude = new \stdClass();
                $attitude->factor = 'ATTITUDE';
                $attitude->value = floatval( $member [personality] [attitude] );
                $person->personality [] = $attitude;
                $person->intelligences = array ();
                $linguistic = new \stdClass();
                $linguistic->factor = 'LINGUISTIC';
                $linguistic->value = floatval( $member [intelligences] [linguistic] );
                $person->intelligences [] = $linguistic;
                $logicalmathematical = new \stdClass();
                $logicalmathematical->factor = 'LOGICAL_MATHEMATICAL';
                $logicalmathematical->value = floatval( $member [intelligences] [logicalmathematical] );
                $person->intelligences [] = $logicalmathematical;
                $spacial = new \stdClass();
                $spacial->factor = 'SPACIAL';
                $spacial->value = floatval( $member [intelligences] [spacial] );
                $person->intelligences [] = $spacial;
                $bodilykinesthetic = new \stdClass();
                $bodilykinesthetic->factor = 'BODILY_KINESTHETIC';
                $bodilykinesthetic->value = floatval( $member [intelligences] [bodilykinesthetic] );
                $person->intelligences [] = $bodilykinesthetic;
                $musical = new \stdClass();
                $musical->factor = 'MUSICAL';
                $musical->value = floatval( $member [intelligences] [musical] );
                $person->intelligences [] = $musical;
                $interpersonal = new \stdClass();
                $interpersonal->factor = 'INTRAPERSONAL';
                $interpersonal->value = floatval( $member [intelligences] [interpersonal] );
                $person->intelligences [] = $interpersonal;
                $intrapersonal = new \stdClass();
                $intrapersonal->factor = 'INTERPERSONAL';
                $intrapersonal->value = floatval( $member [intelligences] [intrapersonal] );
                $person->intelligences [] = $intrapersonal;
                $environmental = new \stdClass();
                $environmental->factor = 'ENVIRONMENTAL';
                $environmental->value = floatval( $member [intelligences] [environmental] );
                $person->intelligences [] = $environmental;
                $data->people [] = $person;
            }

            $data->requirements = array ();
            foreach ($requirements as $factor => $requirement) {
                $requirementdata = new \stdClass();
                if ($factor == 'logicalmathematical') {

                    $requirementdata->factor = 'LOGICAL_MATHEMATICAL';
                } else if ($factor == 'bodilykinesthetic') {

                    $requirementdata->factor = 'BODILY_KINESTHETIC';
                } else if ($factor == 'spacial') {

                    $requirementdata->factor = 'SPATIAL';
                } else {

                    $requirementdata->factor = strtoupper( $factor );
                }
                $requirementdata->level = floatval( $requirement [level] );
                $requirementdata->importance = floatval( $requirement [importance] );
                $data->requirements [] = $requirementdata;
            }
            $payload = json_encode( $data );
            $config = get_config( 'block_tog' );
            $compositeurl = str_replace( '//composite', '/composite', $config->base_api_url . '/composite' );
            $options = array (CURLOPT_POST => 1, CURLOPT_HEADER => 0, CURLOPT_URL => $compositeurl,
                    CURLOPT_FRESH_CONNECT => 1, CURLOPT_RETURNTRANSFER => 1, CURLOPT_FORBID_REUSE => 1,
                    CURLOPT_TIMEOUT => 3600, CURLOPT_POSTFIELDS => $payload,
                    CURLOPT_HTTPHEADER => array ('Content-Type: application/json',
                            'Content-Length: ' . strlen( $payload ), 'Accept: application/json'
                    ), CURLOPT_FAILONERROR => true
            );

            $ch = curl_init();
            curl_setopt_array( $ch, $options );
            if (! $response = curl_exec( $ch )) {
                $message = "SAAS server connection failed, because " . curl_error( $ch );
            } else {
                $calculated = true;
                $teamscomposition = json_decode( $response );
                if (count( $teamscomposition->teams ) > 0) {
                    $groupingdata = new \stdClass();
                    $groupingdata->name = $groupingname;
                    $groupingdata->courseid = $courseid;
                    $groupingid = groups_create_grouping( $groupingdata );
                    if (! $groupingid) {
                        $message = "Could not create the grouping";
                    } else {
                        $index = 1;
                        foreach ($teamscomposition->teams as $team) {
                            $groupdata = new \stdClass();
                            $groupdata->courseid = $courseid;
                            $groupdata->name = str_replace( '{}', strval( $index ), $namepattern );
                            $groupdata->description = '<ul>';
                            foreach ($team->people as $person) {
                                $groupdata->description .= '<li><b>';
                                $user = $DB->get_record( 'user', array ('id' => $person->id
                                ), '*', MUST_EXIST );
                                $groupdata->description .= $user->firstname . ' ' . $user->lastname . '</b>';
                                $maxintelligences = count( $person->intelligences );
                                if ($maxintelligences > 0) {
                                    $groupdata->description .= ' ' .
                                            get_string( 'externallib:group_description_reponsable_of', 'block_tog' );
                                    $intelligenceindex = 1;
                                    foreach ($person->intelligences as $intelligence) {
                                        if ($intelligenceindex == 1) {
                                            $groupdata->description .= ' ';
                                        } else if ($intelligenceindex == $maxintelligences) {
                                            $groupdata->description .= ' ' .
                                                    get_string( 'externallib:group_description_last_intelligence_and',
                                                            'block_tog' ) . ' ';
                                        } else {
                                            $groupdata->description .= ', ';
                                        }

                                        $groupdata->description .= get_string(
                                                'externallib:group_description_intelligence_' .
                                                strtolower( $intelligence ), 'block_tog' );
                                        $intelligenceindex ++;
                                    }
                                } else {
                                    $groupdata->description .= ' ' .
                                            get_string( 'externallib:group_description_no_responsibility', 'block_tog' );
                                }
                                $groupdata->description .= '</li>';
                            }
                            $groupdata->description .= '</ul>';
                            $groupdata->descriptionformat = FORMAT_HTML;
                            $groupid = groups_create_group( $groupdata );
                            if (! $groupid) {
                                $message .= "Could not create the group with " . json_encode( $groupdata );
                            } else {
                                if (! groups_assign_grouping( $groupingid, $groupid )) {
                                    $message .= "Could not assign the group " . $groupid . " to the grouping " .
                                            $groupingid;
                                }
                                foreach ($team->people as $person) {
                                    if (! groups_add_member( $groupid, $person->id )) {
                                        $message .= "\nCould not add the user " . $person->id . " to the group " .
                                                $groupid;
                                    }
                                }
                                $feedbackrecord = new \stdClass();
                                $feedbackrecord->groupingid = $groupingid;
                                $feedbackrecord->groupid = $groupid;
                                $feedbackrecord->feedbackid = $team->feedbackId;
                                if (! $DB->insert_record( 'block_tog_composed', $feedbackrecord, false )) {
                                    $message .= "\nCould not store the feedback identifier to the group " . $groupid;
                                }
                            }
                            $index ++;
                        }

                        if (strlen( $message ) == 0) {
                            $updated = true;
                        }
                    }
                } else {
                    $message = "No teams composed";
                }
            }
            curl_close( $ch );
        } catch ( \Throwable $e ) {
            $message = $e->getMessage() . '\n' . $e->getTraceAsString();
        }
        $result = array ();
        $result ['success'] = $updated;
        $result ['calculated'] = $calculated;
        $result ['message'] = $message;
        return $result;
    }

    /**
     * The function called to get the informatiomn of the parameter to composite groups.
     */
    public static function composite_groups_returns() {
        return new external_single_structure(
                array ('success' => new external_value( PARAM_BOOL, 'This is true if the grouping has been stored' ),
                        'calculated' => new external_value( PARAM_BOOL, 'This is true if the groups has been calculated' ),
                        'message' => new external_value( PARAM_TEXT,
                                'This contains a message that explains why is not calculated or stored' )
                ) );
    }

    /**
     * The function called to get the informatiomn of the parameter to auto fill in personality.
     */
    public static function auto_fill_in_personality_parameters() {
        return new external_function_parameters(
                array ('userid' => new external_value( PARAM_INT, 'The user to auto fill in the personality test' )
                ) );
    }

    /**
     * The function called to auto fill in personality of an user.
     *
     * @param int $userid
     *            identifier of the user.
     */
    public static function auto_fill_in_personality($userid) {
        $success = true;
        $message = '';
        try {
            $params = self::validate_parameters( self::auto_fill_in_personality_parameters(),
                    array ('userid' => $userid
                    ) );

            $userid = $params ['userid'];
            $maxquestions = personality_questionnaire::count_questions();
            for ($question = 0; $question < $maxquestions; $question ++) {
                $answer = rand( 0, personality_questionnaire::MAX_QUESTION_ANSWERS - 1 );
                if (! personality_questionnaire::set_personality_answer_for( $question, $answer, $userid )) {
                    $success = false;
                    $message = 'Can not store the personality answer for a question';
                }
            }

            if (! personality::calculate_personality_of( $userid )) {
                $success = false;
                $message = 'Can not calculate the personality of the user.';
            }
        } catch ( \Throwable $e ) {
            $message = $e->getMessage() . '\n' . $e->getTraceAsString();
        }
        $result = array ();
        $result ['success'] = $success;
        $result ['message'] = $message;
        return $result;
    }

    /**
     * The function called to get the informatiomn of the parameter to auto fill in personality.
     */
    public static function auto_fill_in_personality_returns() {
        return new external_single_structure(
                array (
                        'success' => new external_value( PARAM_BOOL,
                                'This is true if the personality test has been filled in' ),
                        'message' => new external_value( PARAM_TEXT,
                                'This contains a message that explains why is not filled in the personality test' )
                ) );
    }

    /**
     * The function called to get the informatiomn of the parameter to auto fill in intelligences.
     */
    public static function auto_fill_in_intelligences_parameters() {
        return new external_function_parameters(
                array ('userid' => new external_value( PARAM_INT, 'The user to auto fill in the intelligences test' )
                ) );
    }

    /**
     * The function called to auto fill in intelligences of an user.
     *
     * @param int $userid
     *            identifier of the user.
     */
    public static function auto_fill_in_intelligences($userid) {
        $success = true;
        $message = '';
        try {
            $params = self::validate_parameters( self::auto_fill_in_intelligences_parameters(),
                    array ('userid' => $userid
                    ) );

            $userid = $params ['userid'];
            $maxquestions = intelligences_questionnaire::count_questions();
            for ($question = 0; $question < $maxquestions; $question ++) {
                $answer = rand( 0, intelligences_questionnaire::MAX_QUESTION_ANSWERS - 1 );
                if (! intelligences_questionnaire::set_intelligences_answer_for( $question, $answer, $userid )) {
                    $success = false;
                    $message = 'Can not store the intelligences answer for a question';
                }
            }

            if (! intelligences::calculate_intelligences_of( $userid )) {
                $success = false;
                $message = 'Can not calculate the intelligences of the user.';
            }
        } catch ( \Throwable $e ) {
            $message = $e->getMessage() . '\n' . $e->getTraceAsString();
        }
        $result = array ();
        $result ['success'] = $success;
        $result ['message'] = $message;
        return $result;
    }

    /**
     * The function called to get the informatiomn of the parameter to auto fill in intelligences.
     */
    public static function auto_fill_in_intelligences_returns() {
        return new external_single_structure(
                array (
                        'success' => new external_value( PARAM_BOOL,
                                'This is true if the intelligences test has been filled in' ),
                        'message' => new external_value( PARAM_TEXT,
                                'This contains a message that explains why is not filled in the intelligences test' )
                ) );
    }

    /**
     * The function called to get the informatiomn of the parameter to feedback a group.
     */
    public static function feedback_group_parameters() {
        return new external_function_parameters(
                array (
                        'feedbackid' => new external_value( PARAM_TEXT,
                                'Contains the identifier of the feedback to provide' ),
                        'answervalues' => new external_multiple_structure(
                                new external_value( PARAM_INT, 'Contains the answers of the user' ) )
                ) );
    }

    /**
     * The function called to composite the new groups.
     *
     * @param int $feedbackid
     *            identifier of the group that provide feedback.
     * @param int[] $answervalues
     *            identifier of the feedback answers.
     */
    public static function feedback_group($feedbackid, $answervalues) {
        global $DB;
        $updated = false;
        $message = "";
        try {
            $params = self::validate_parameters( self::feedback_group_parameters(),
                    array ('feedbackid' => $feedbackid, 'answervalues' => $answervalues
                    ) );

            $feedbackid = $params ['feedbackid'];
            $answervalues = $params ['answervalues'];

            $composed = $DB->get_record( 'block_tog_composed', array ('feedbackid' => $feedbackid
            ), '*', IGNORE_MISSING );
            if ($composed !== false && isset( $composed )) {
                $data = new \stdClass();
                $data->feedbackId = $feedbackid;
                $data->answerValues = $answervalues;

                $payload = json_encode( $data );
                $config = get_config( 'block_tog' );
                $compositeurl = str_replace( '//composite', '/composite', $config->base_api_url . '/composite/feedback' );
                $options = array (CURLOPT_POST => 1, CURLOPT_HEADER => 0, CURLOPT_URL => $compositeurl,
                        CURLOPT_FRESH_CONNECT => 1, CURLOPT_RETURNTRANSFER => 0, CURLOPT_FORBID_REUSE => 1,
                        CURLOPT_TIMEOUT => 3600, CURLOPT_POSTFIELDS => $payload,
                        CURLOPT_HTTPHEADER => array ('Content-Type: application/json',
                                'Content-Length: ' . strlen( $payload ), 'Accept: application/json'
                        ), CURLOPT_FAILONERROR => true
                );

                $ch = curl_init();
                curl_setopt_array( $ch, $options );
                if (! curl_exec( $ch )) {
                    $message = "SAAS server connection failed, because " . curl_error( $ch );
                } else {
                    $updated = true;
                    $DB->delete_records( 'block_tog_composed', array ('id' => $composed->id
                    ) );
                }
                curl_close( $ch );
            } else {
                $message = "Undefined feedback identifier";
            }
        } catch ( \Throwable $e ) {
            $message = $e->getMessage() . '\n' . $e->getTraceAsString();
        }
        $result = array ();
        $result ['success'] = $updated;
        $result ['message'] = $message;
        return $result;
    }

    /**
     * The function called to get the informatiomn of the parameter to feedback a group.
     */
    public static function feedback_group_returns() {
        return new external_single_structure(
                array ('success' => new external_value( PARAM_BOOL, 'This is true if the grouping has been stored' ),
                        'message' => new external_value( PARAM_TEXT,
                                'This contains a message that explains why is not calculated or stored' )
                ) );
    }
}
