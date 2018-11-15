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
namespace block_task_oriented_groups\privacy;

use core_privacy\local\metadata\collection;
use core_privacy\local\request\approved_contextlist;
use core_privacy\local\request\approved_userlist;
use core_privacy\local\request\contextlist;
use core_privacy\local\request\transform;
use core_privacy\local\request\userlist;
use core_privacy\local\request\writer;
use block_task_oriented_groups\PersonalityQuestionnaire;
use block_task_oriented_groups\CompetencesQuestionnaire;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacity details.
 *
 * @package block_task_oriented_groups
 * @category blocks
 * @copyright UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements \core_privacy\local\metadata\provider,
        \core_privacy\local\request\core_userlist_provider,
        \core_privacy\local\request\plugin\provider {

    /**
     * Returns the metadata that describe the personal data stored by the block.
     *
     * @param collection $collection The initialised collection to add items to.
     * @return collection A listing of user data stored through this system.
     */
    public static function get_metadata(collection $collection): collection {
        $collection->add_database_table('btog_personality_answers',
                ['userid' => 'privacy:metadata:btog_personality_answers:userid',
                    'question' => 'privacy:metadata:btog_personality_answers:discussionid',
                    'answer' => 'privacy:metadata:btog_personality_answers:preference'
                ], 'privacy:metadata:btog_personality_answers');
        $collection->add_database_table('btog_competences_answers',
                ['userid' => 'privacy:metadata:btog_competences_answers:userid',
                    'question' => 'privacy:metadata:btog_competences_answers:discussionid',
                    'answer' => 'privacy:metadata:btog_competences_answers:preference'
                ], 'privacy:metadata:btog_competences_answers');

        return $collection;
    }

    /**
     * Get the list of contexts that contain user information for the specified user.
     *
     * @param int $userid The user to search.
     * @return contextlist $contextlist The contextlist containing the list of contexts used in this
     *         plugin.
     */
    public static function get_contexts_for_userid(int $userid): contextlist {
        $contextlist = new contextlist();

        if (static::has_data_for($userid)) {
            $contextlist->add_user_context($userid);
        }

        return $contextlist;
    }

    /**
     * Delete all data for all users in the specified context.
     *
     * @param context $context The specific context to delete data for.
     */
    public static function delete_data_for_all_users_in_context(\context $context) {
        if ($context instanceof \context_user) {
            static::delete_user_data($context->instanceid);
        }
    }

    /**
     * Delete all user data for the specified user, in the specified contexts.
     *
     * @param approved_contextlist $contextlist The approved contexts and user information to delete
     *        information for.
     */
    public static function delete_data_for_user(approved_contextlist $contextlist) {
        if (empty($contextlist->count())) {
            return;
        }
        $userid = $contextlist->get_user()->id;
        // Remove non-user and invalid contexts. If it ends up empty then early return.
        $contexts = array_filter($contextlist->get_contexts(),
                function ($context) use ($userid) {
                    return $context->contextlevel == CONTEXT_USER && $context->instanceid == $userid;
                });
        if (empty($contexts)) {
            return;
        }
        static::delete_user_data($userid);
    }

    /**
     * Delete multiple users within a single context.
     *
     * @param approved_userlist $userlist The approved context and user information to delete
     *        information for.
     */
    public static function delete_data_for_users(approved_userlist $userlist) {
        $context = $userlist->get_context();
        if (!$context instanceof \context_user) {
            return;
        }
        // Remove invalid users. If it ends up empty then early return.
        $userids = array_filter($userlist->get_userids(),
                function ($userid) use ($context) {
                    return $context->instanceid == $userid;
                });
        if (empty($userids)) {
            return;
        }
        static::delete_user_data($context->instanceid);
    }

    /**
     * Get the list of users who have data within a context.
     *
     * @param userlist $userlist The userlist containing the list of users who have data in this
     *        context/plugin combination.
     */
    public static function get_users_in_context(userlist $userlist) {
        $context = $userlist->get_context();
        if (!$context instanceof \context_user) {
            return;
        }
        $userid = $context->instanceid;

        if (static::has_data_for($userid)) {
            $userlist->add_user($userid);
        }
        $userid = $context->instanceid;
    }

    /**
     * Check if exist dat for the specified user.
     */
    protected static function has_data_for(int $userid): bool {
        global $DB;

        $hasdata = false;
        $hasdata = $hasdata || $DB->record_exists('btog_personality_answers', [
            'userid' => $userid
        ]);
        $hasdata = $hasdata || $DB->record_exists('btog_competences_answers', [
            'userid' => $userid
        ]);
        return $hasdata;
    }

    /**
     * Delete all user data for the specified user.
     *
     * @param int $userid The user id
     */
    protected static function delete_user_data(int $userid) {
        global $DB;
        $DB->delete_records('btog_personality_answers', ['userid' => $userid
        ]);
        $DB->delete_records('btog_competences_answers', ['userid' => $userid
        ]);
    }

    /**
     * Export all user data for the specified user, in the specified contexts.
     *
     * @param approved_contextlist $contextlist The approved contexts to export information for.
     */
    public static function export_user_data(approved_contextlist $contextlist) {
        if (empty($contextlist->count())) {
            return;
        }
        $userid = $contextlist->get_user()->id;
        $contexts = array_filter($contextlist->get_contexts(),
                function ($context) use ($userid) {
                    return $context->contextlevel == CONTEXT_USER && $context->instanceid == $userid;
                });
        if (empty($contexts)) {
            return;
        }
        self::export_user_data_personality_answers($userid);
        self::export_user_data_competences_answers($userid);
    }

    /**
     * Export the personality answers users data.
     *
     * @param int $userid
     */
    protected static function export_user_data_personality_answers(int $userid) {
        global $DB;
        $context = \context_user::instance($userid);
        $answersdata = [];
        $answers = $DB->get_recordset_select('btog_personality_answers', 'userid = ?', [$userid
        ], 'question ASC');
        foreach ($answers as $personalityanswer) {
            $data = (object) [
                'question' => PersonalityQuestionnaire::getQuestionTextOf(
                        $personalityanswer->question),
                'answer' => PersonalityQuestionnaire::getAnswerQuestionTextOf(
                        $personalityanswer->question, $personalityanswer->answer)
            ];
            $answersdata[] = $data;
        }
        $answers->close();
        writer::with_context($context)->export_data(
                [get_string('privacy:export:btog_personality_answers', 'btog_personality_answers')
                ], (object) $answersdata);
    }

    /**
     * Export the competences answers users data.
     *
     * @param int $userid
     */
    protected static function export_user_data_competences_answers(int $userid) {
        global $DB;
        $context = \context_user::instance($userid);
        $answersdata = [];
        $answers = $DB->get_recordset_select('btog_competences_answers', 'userid = ?', [$userid
        ], 'question ASC');
        foreach ($answers as $competencesanswer) {
            $data = (object) [
                'question' => CompetencesQuestionnaire::getQuestionTextOf(
                        $competencesanswer->question),
                'answer' => CompetencesQuestionnaire::getAnswerQuestionTextOf(
                        $competencesanswer->answer)
            ];
            $answersdata[] = $data;
        }
        $answers->close();
        writer::with_context($context)->export_data(
                [get_string('privacy:export:btog_competences_answers', 'btog_competences_answers')
                ], (object) $answersdata);
    }
}