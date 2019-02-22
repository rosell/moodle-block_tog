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
global $CFG;
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

    /**
     * The function called to get the informatiomn of the parameter to composite groups.
     */
    public static function composite_groups_parameters() {
        $requirement = new external_single_structure(
                ['level' => new external_value(PARAM_FLOAT, 'The level for the requirement'),
                    'importance' => new external_value(PARAM_FLOAT,
                            'The importance for the requirement')
                ], 'Requirement values', VALUE_OPTIONAL);
        return new external_function_parameters(
                array(
                    'membersPerGroups' => new external_value(PARAM_INT,
                            'Number of memebrs per each group'),
                    'atMost' => new external_value(PARAM_BOOL,
                            'This is true if the member per group can not be more that the specified'),
                    'groupingName' => new external_value(PARAM_TEXT,
                            'Name of the grouping to generate'),
                    'namePattern' => new external_value(PARAM_TEXT,
                            'Pattern to generate the group names'),
                    'performance' => new external_value(PARAM_FLOAT,
                            'Value that indicates if the groups are under or over performance'),
                    'members' => new external_multiple_structure(
                            new external_single_structure(
                                    [
                                        'id' => new external_value(
                                                core_user::get_property_type('id'),
                                                'ID of the member'),
                                        'gender' => new external_value(PARAM_TEXT,
                                                'The gender of the member'),
                                        'personality' => new external_single_structure(
                                                [
                                                    'judgment' => new external_value(PARAM_FLOAT,
                                                            'The value for the personality judgment'),
                                                    'attitude' => new external_value(PARAM_FLOAT,
                                                            'The value for the personality attitude'),
                                                    'perception' => new external_value(PARAM_FLOAT,
                                                            'The value for the personality perception'),
                                                    'extrovert' => new external_value(PARAM_FLOAT,
                                                            'The value for the personality extrovert')
                                                ], 'Contains the member personality'),
                                        'competences' => new external_single_structure(
                                                [
                                                    'verbal' => new external_value(PARAM_FLOAT,
                                                            'The value for the competences verbal'),
                                                    'logic_mathematics' => new external_value(
                                                            PARAM_FLOAT,
                                                            'The value for the competences logic mathematics'),
                                                    'visual_spatial' => new external_value(
                                                            PARAM_FLOAT,
                                                            'The value for the competences visual_spatial'),
                                                    'kinestesica_corporal' => new external_value(
                                                            PARAM_FLOAT,
                                                            'The value for the competences kinestesica corporal'),
                                                    'musical_rhythmic' => new external_value(
                                                            PARAM_FLOAT,
                                                            'The value for the competences musical rhythmic'),
                                                    'intrapersonal' => new external_value(
                                                            PARAM_FLOAT,
                                                            'The value for the competences intrapersonal'),
                                                    'interpersonal' => new external_value(
                                                            PARAM_FLOAT,
                                                            'The value for the competences interpersonal'),
                                                    'naturalist_environmental' => new external_value(
                                                            PARAM_FLOAT,
                                                            'The value for the competences naturalist environmental')
                                                ], 'Contains the member personality')
                                    ]), 'The members that can be form part of a group'),
                    'requirements' => new external_single_structure(
                            ['verbal' => $requirement, 'logic_mathematics' => $requirement,
                                'visual_spatial' => $requirement,
                                'kinestesica_corporal' => $requirement,
                                'musical_rhythmic' => $requirement, 'intrapersonal' => $requirement,
                                'interpersonal' => $requirement,
                                'naturalist_environmental' => $requirement
                            ], 'The requirements for the groups')
                ));
    }

    /**
     * The function called to composite the new groups.
     */
    public static function composite_groups($membersPerGroups, $atMost, $groupingName, $namePattern,
            $performance, $members, $requirements) {
        $params = self::validate_parameters(self::composite_groups_parameters(),
                array('membersPerGroups' => $membersPerGroups, 'atMost' => $atMost,
                    'groupingName' => $groupingName, 'namePattern' => $namePattern,
                    'performance' => $performance, 'members' => $members,
                    'requirements' => $requirements
                ));
        $membersPerGroups = $params['membersPerGroups'];
        $atMost = $params['atMost'];
        $groupingName = $params['groupingName'];
        $namePattern = $params['namePattern'];
        $performance = $params['performance'];
        $members = $params['members'];
        $requirements = $params['requirements'];

        $updated = false;
        $calculated = false;
        $data = new \stdClass();
        $data->peoplePerTeam = intval($membersPerGroups);
        $data->atMost = boolval($atMost);
        $data->performance = floatVal($performance);
        $data->people = array();
        foreach ($members as $member) {

            $person = new \stdClass();
            $person->id = $member[id];
            $person->gender = $member[gender];
            $person->personality = array();
            $perception = new \stdClass();
            $perception->factor = 'PERCEPTION';
            $perception->value = floatVal($member[personality][perception]);
            $person->personality[] = $perception;
            $judgment = new \stdClass();
            $judgment->factor = 'JUDGMENT';
            $judgment->value = floatVal($member[personality][judgment]);
            $person->personality[] = $judgment;
            $extrovert = new \stdClass();
            $extrovert->factor = 'EXTROVERT';
            $extrovert->value = floatVal($member[personality][extrovert]);
            $person->personality[] = $extrovert;
            $attitude = new \stdClass();
            $attitude->factor = 'ATTITUDE';
            $attitude->value = floatVal($member[personality][attitude]);
            $person->personality[] = $attitude;
            $person->competences = array();
            $verbal = new \stdClass();
            $verbal->factor = 'VERBAL';
            $verbal->value = floatVal($member[competences][verbal]);
            $person->competences[] = $verbal;
            $logic_mathematics = new \stdClass();
            $logic_mathematics->factor = 'LOGIC_MATHEMATICS';
            $logic_mathematics->value = floatVal($member[competences][logic_mathematics]);
            $person->competences[] = $logic_mathematics;
            $visual_spatial = new \stdClass();
            $visual_spatial->factor = 'VISUAL_SPATIAL';
            $visual_spatial->value = floatVal($member[competences][visual_spatial]);
            $person->competences[] = $visual_spatial;
            $kinestesica_corporal = new \stdClass();
            $kinestesica_corporal->factor = 'KINESTESICA_CORPORAL';
            $kinestesica_corporal->value = floatVal($member[competences][kinestesica_corporal]);
            $person->competences[] = $kinestesica_corporal;
            $musical_rhythmic = new \stdClass();
            $musical_rhythmic->factor = 'MUSICAL_RHYTHMIC';
            $musical_rhythmic->value = floatVal($member[competences][musical_rhythmic]);
            $person->competences[] = $musical_rhythmic;
            $intrapersonal = new \stdClass();
            $intrapersonal->factor = 'INTRAPERSONAL';
            $intrapersonal->value = floatVal($member[competences][intrapersonal]);
            $person->competences[] = $intrapersonal;
            $interpersonal = new \stdClass();
            $interpersonal->factor = 'INTERPERSONAL';
            $interpersonal->value = floatVal($member[competences][interpersonal]);
            $person->competences[] = $interpersonal;
            $naturalist_environmental = new \stdClass();
            $naturalist_environmental->factor = 'NATURALIST_ENVIRONMENTAL';
            $naturalist_environmental->value = floatVal(
                    $member[competences][naturalist_environmental]);
            $person->competences[] = $naturalist_environmental;
            $data->people[] = $person;
        }

        $data->requirements = array();
        foreach ($requirements as $factor => $requirement) {

            $requirementData = new \stdClass();
            $requirementData->factor = strtoupper($factor);
            $requirementData->level = floatVal($requirement[level]);
            $requirementData->importance = floatVal($requirement[importance]);
            $data->requirements[] = $requirementData;
        }
        $payload = json_encode($data);
        $config = get_config('task_oriented_groups');
        $composite_url = str_replace('//composite', '/composite',
                $config->base_api_url . '/composite');
        $curl = curl_init($composite_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
                array('Content-Type: application/json', 'Content-Length: ' . strlen($payload),
                    'Accept: application/json'
                ));

        $response = curl_exec($curl);
        if (!$response) {

            $calculated = true;
            // $groups = json_decode($result, true);
            // // json_encode($response);
            // $result['response'] = strval($result);
        }
        curl_close($curl);

        $result = array();
        $result['success'] = $updated;
        $result['calculated'] = $calculated;
        return $result;
    }

    /**
     * The function called to get the informatiomn of the parameter to composite groups.
     */
    public static function composite_groups_returns() {
        return new external_single_structure(
                array(
                    'success' => new external_value(PARAM_BOOL,
                            'This is true if the grouping has been stored'),
                    'calculated' => new external_value(PARAM_BOOL,
                            'This is true if the groups has been calculated')
                ));
    }
}