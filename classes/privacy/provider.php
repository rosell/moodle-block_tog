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
 * Privacity details.
 *
 * @package block_tog
 * @copyright 2018 - 2020 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace block_tog\privacy;

use core_privacy\local\metadata\collection;
use core_privacy\local\request\approved_contextlist;
use core_privacy\local\request\approved_userlist;
use core_privacy\local\request\contextlist;
use core_privacy\local\request\transform;
use core_privacy\local\request\userlist;
use core_privacy\local\request\writer;
use block_tog\personality_questionnaire;
use block_tog\intelligences_questionnaire;
use block_tog\personality;
use block_tog\intelligences;

defined( 'MOODLE_INTERNAL' ) || die();

/**
 * Provider for the provacity details.
 *
 * @copyright 2018 - 2020 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements \core_privacy\local\metadata\provider, \core_privacy\local\request\core_userlist_provider,
        \core_privacy\local\request\plugin\provider {

    /**
     * Returns the metadata that describe the personal data stored by the block.
     *
     * @param collection $collection
     *            The initialised collection to add items to.
     *
     * @return collection A listing of user data stored through this system.
     */
    public static function get_metadata(collection $collection): collection {
        $collection->add_database_table( 'block_tog_perso_answers',
                [ 'userid' => 'privacy:metadata:block_tog_perso_answers:userid',
                        'question' => 'privacy:metadata:block_tog_perso_answers:discussionid',
                        'answer' => 'privacy:metadata:block_tog_perso_answers:preference'
                ], 'privacy:metadata:block_tog_perso_answers' );
        $collection->add_database_table( 'block_tog_intel_answers',
                [ 'userid' => 'privacy:metadata:block_tog_intel_answers:userid',
                        'question' => 'privacy:metadata:block_tog_intel_answers:discussionid',
                        'answer' => 'privacy:metadata:block_tog_intel_answers:preference'
                ], 'privacy:metadata:block_tog_intel_answers' );
        $collection->add_database_table( 'block_tog_personality',
                [ 'userid' => 'privacy:metadata:block_tog_personality:userid',
                        'type' => 'privacy:metadata:block_tog_personality:type',
                        'gender' => 'privacy:metadata:block_tog_personality:gender',
                        'judgment' => 'privacy:metadata:block_tog_personality:judgment',
                        'attitude' => 'privacy:metadata:block_tog_personality:attitude',
                        'perception' => 'privacy:metadata:block_tog_personality:perception',
                        'extrovert' => 'privacy:metadata:block_tog_personality:extrovert'
                ], 'privacy:metadata:block_tog_intel_answers' );
        $collection->add_database_table( 'block_tog_intelligences',
                [ 'userid' => 'privacy:metadata:block_tog_intelligences:userid',
                        'linguistic' => 'privacy:metadata:block_tog_intelligences:linguistic',
                        'logicalmathematical' => 'privacy:metadata:block_tog_intelligences:logicalmathematical',
                        'spatial' => 'privacy:metadata:block_tog_intelligences:spatial',
                        'bodilykinesthetic' => 'privacy:metadata:block_tog_intelligences:bodilykinesthetic',
                        'musical' => 'privacy:metadata:block_tog_intelligences:musical',
                        'intrapersonal' => 'privacy:metadata:block_tog_intelligences:intrapersonal',
                        'interpersonal' => 'privacy:metadata:block_tog_intelligences:interpersonal',
                        'environmental' => 'privacy:metadata:block_tog_intelligences:environmental'
                ], 'privacy:metadata:block_tog_intel_answers' );

        return $collection;
    }

    /**
     * Get the list of contexts that contain user information for the specified user.
     *
     * @param int $userid
     *            The user to search.
     * @return contextlist $contextlist The contextlist containing the list of contexts used in this
     *         plugin.
     */
    public static function get_contexts_for_userid(int $userid): contextlist {
        $contextlist = new contextlist();

        if (static::has_data_for( $userid )) {
            $contextlist->add_user_context( $userid );
        }

        return $contextlist;
    }

    /**
     * Delete all data for all users in the specified context.
     *
     * @param context $context
     *            The specific context to delete data for.
     */
    public static function delete_data_for_all_users_in_context(\context $context) {
        if ($context instanceof \context_user) {
            static::delete_user_data( $context->instanceid );
        }
    }

    /**
     * Delete all user data for the specified user, in the specified contexts.
     *
     * @param approved_contextlist $contextlist
     *            The approved contexts and user information to delete
     *            information for.
     */
    public static function delete_data_for_user(approved_contextlist $contextlist) {
        if (empty( $contextlist->count() )) {
            return;
        }
        $userid = $contextlist->get_user()->id;
        // Remove non-user and invalid contexts. If it ends up empty then early return.
        $contexts = array_filter( $contextlist->get_contexts(),
                function ($context) use ($userid) {
                    return $context->contextlevel == CONTEXT_USER && $context->instanceid == $userid;
                } );
        if (empty( $contexts )) {
            return;
        }
        static::delete_user_data( $userid );
    }

    /**
     * Delete multiple users within a single context.
     *
     * @param approved_userlist $userlist
     *            The approved context and user information to delete
     *            information for.
     */
    public static function delete_data_for_users(approved_userlist $userlist) {
        $context = $userlist->get_context();
        if (! $context instanceof \context_user) {
            return;
        }
        // Remove invalid users. If it ends up empty then early return.
        $userids = array_filter( $userlist->get_userids(),
                function ($userid) use ($context) {
                    return $context->instanceid == $userid;
                } );
        if (empty( $userids )) {
            return;
        }
        static::delete_user_data( $context->instanceid );
    }

    /**
     * Get the list of users who have data within a context.
     *
     * @param userlist $userlist
     *            The userlist containing the list of users who have data in this
     *            context/plugin combination.
     */
    public static function get_users_in_context(userlist $userlist) {
        $context = $userlist->get_context();
        if (! $context instanceof \context_user) {
            return;
        }
        $userid = $context->instanceid;

        if (static::has_data_for( $userid )) {
            $userlist->add_user( $userid );
        }
        $userid = $context->instanceid;
    }

    /**
     * Check if exist data for the specified user.
     *
     * @param int $userid
     *            identifier of the user.
     *
     * @return boolean true if has data for the specified user.
     */
    protected static function has_data_for(int $userid): bool {
        global $DB;

        $hasdata = false;
        $hasdata = $hasdata || $DB->record_exists( 'block_tog_perso_answers', [ 'userid' => $userid
        ] );
        $hasdata = $hasdata || $DB->record_exists( 'block_tog_intel_answers', [ 'userid' => $userid
        ] );
        $hasdata = $hasdata || $DB->record_exists( 'block_tog_personality', [ 'userid' => $userid
        ] );
        $hasdata = $hasdata || $DB->record_exists( 'block_tog_intelligences', [ 'userid' => $userid
        ] );
        return $hasdata;
    }

    /**
     * Delete all user data for the specified user.
     *
     * @param int $userid
     *            The user id
     */
    protected static function delete_user_data(int $userid) {
        global $DB;
        $DB->delete_records( 'block_tog_perso_answers', [ 'userid' => $userid
        ] );
        $DB->delete_records( 'block_tog_intel_answers', [ 'userid' => $userid
        ] );
        $DB->delete_records( 'block_tog_personality', [ 'userid' => $userid
        ] );
        $DB->delete_records( 'block_tog_intelligences', [ 'userid' => $userid
        ] );
    }

    /**
     * Export all user data for the specified user, in the specified contexts.
     *
     * @param approved_contextlist $contextlist
     *            The approved contexts to export information for.
     */
    public static function export_user_data(approved_contextlist $contextlist) {
        if (empty( $contextlist->count() )) {
            return;
        }
        $userid = $contextlist->get_user()->id;
        $contexts = array_filter( $contextlist->get_contexts(),
                function ($context) use ($userid) {
                    return $context->contextlevel == CONTEXT_USER && $context->instanceid == $userid;
                } );
        if (empty( $contexts )) {
            return;
        }
        self::export_user_data_personality_answers( $userid );
        self::export_user_data_intelligences_answers( $userid );
        self::export_user_data_personality( $userid );
        self::export_user_data_intelligences( $userid );
    }

    /**
     * Export the personality answers users data.
     *
     * @param int $userid
     *            identfier of the user.
     */
    protected static function export_user_data_personality_answers(int $userid) {
        global $DB;
        $context = \context_user::instance( $userid );
        $answersdata = [ ];
        $answers = $DB->get_recordset_select( 'block_tog_perso_answers', 'userid = ?', [ $userid
        ], 'question ASC' );
        foreach ($answers as $personalityanswer) {
            $data = ( object ) [
                    'question' => personality_questionnaire::get_question_text_of( $personalityanswer->question ),
                    'answer' => personality_questionnaire::get_answer_question_text_of( $personalityanswer->question,
                            $personalityanswer->answer )
            ];
            $answersdata [] = $data;
        }
        $answers->close();
        writer::with_context( $context )->export_data(
                [ get_string( 'privacy:export:block_tog_perso_answers', 'block_tog' )
                ], ( object ) $answersdata );
    }

    /**
     * Export the intelligences answers users data.
     *
     * @param int $userid
     *            identfier of the user.
     */
    protected static function export_user_data_intelligences_answers(int $userid) {
        global $DB;
        $context = \context_user::instance( $userid );
        $answersdata = [ ];
        $answers = $DB->get_recordset_select( 'block_tog_intel_answers', 'userid = ?', [ $userid
        ], 'question ASC' );
        foreach ($answers as $intelligencesanswer) {
            $data = ( object ) [
                    'question' => intelligences_questionnaire::get_question_text_of( $intelligencesanswer->question ),
                    'answer' => intelligences_questionnaire::get_answer_question_text_of( $intelligencesanswer->answer )
            ];
            $answersdata [] = $data;
        }
        $answers->close();
        writer::with_context( $context )->export_data(
                [ get_string( 'privacy:export:block_tog_intel_answers', 'block_tog' )
                ], ( object ) $answersdata );
    }

    /**
     * Export the personality of an user.
     *
     * @param int $userid
     *            identfier of the user.
     */
    protected static function export_user_data_personality(int $userid) {
        global $DB;
        $context = \context_user::instance( $userid );
        $personalitydata = [ ];
        $personality = personality::get_personality_of( $userid );
        if ($personality !== false) {
            $personalitydata = [ 'type' => $personality->type,
                    'gender' => personality_questionnaire::get_answer_question_text_of( 0, $personality->gender ),
                    'judgment' => $personality->judgment, 'attitude' => $personality->attitude,
                    'perception' => $personality->perception, 'extrovert' => $personality->extrovert
            ];
        }
        writer::with_context( $context )->export_data(
                [ get_string( 'privacy:export:block_tog_personality', 'block_tog' )
                ], ( object ) $personalitydata );
    }

    /**
     * Export the intelligences of an user.
     *
     * @param int $userid
     *            identfier of the user.
     */
    protected static function export_user_data_intelligences(int $userid) {
        global $DB;
        $context = \context_user::instance( $userid );
        $intelligencesdata = [ ];
        $intelligences = intelligences::get_intelligences_of( $userid );
        if ($intelligences !== false) {
            $intelligencesdata = [ 'linguistic' => $intelligences->linguistic,
                    'logicalmathematical' => $intelligences->logicalmathematical, 'spatial' => $intelligences->spatial,
                    'bodilykinesthetic' => $intelligences->bodilykinesthetic, 'musical' => $intelligences->musical,
                    'intrapersonal' => $intelligences->intrapersonal, 'interpersonal' => $intelligences->interpersonal,
                    'environmental' => $intelligences->environmental
            ];
        }
        writer::with_context( $context )->export_data(
                [ get_string( 'privacy:export:block_tog_intelligences', 'block_tog' )
                ], ( object ) $intelligencesdata );
    }
}
