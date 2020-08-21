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
 * Methods to update the database design between plugin versions.
 *
 * @package block_tog
 * @copyright 2018 - 2020 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Update the database.
 *
 * @param unknown $oldversion
 *            version of the plugin to update.
 *
 * @return boolean
 */
function xmldb_block_tog_upgrade($oldversion) {
    global $DB;
    $dbman = $DB->get_manager();

    if ($oldversion < 2020082000) {
        // Remove the previous intelligences answers because does not mathc the new questionnaire.
        $table = new xmldb_table( 'block_tog_intel_answers' );
        if ($dbman->table_exists( $table )) {

            $dbman->drop_table( $table );
        }
        // Define table block_tog_intel_answers to be created.
        $table = new xmldb_table( 'block_tog_intel_answers' );

        // Adding fields to table block_tog_intel_answers.
        $table->add_field( 'id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null );
        $table->add_field( 'userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null );
        $table->add_field( 'question', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL, null, null );
        $table->add_field( 'answer', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, null );

        // Adding keys to table block_tog_intel_answers.
        $table->add_key( 'primary', XMLDB_KEY_PRIMARY, [ 'id'
        ] );

        // Conditionally launch create table for block_tog_intel_answers.
        if (! $dbman->table_exists( $table )) {
            $dbman->create_table( $table );
        }

        // Rename intelligences fields.
        $table = new xmldb_table( 'block_tog_intelligences' );

        // Rename field verbal on table block_tog_intelligences to linguistic.
        $field = new xmldb_field( 'verbal', XMLDB_TYPE_NUMBER, '15, 14', null, XMLDB_NOTNULL, null, null, 'userid' );
        $dbman->rename_field( $table, $field, 'linguistic' );

        // Rename field logic_mathematics on table block_tog_intelligences to logicalmathematical.
        $field = new xmldb_field( 'logic_mathematics', XMLDB_TYPE_NUMBER, '15, 14', null, XMLDB_NOTNULL, null, null,
                'linguistic' );
        $dbman->rename_field( $table, $field, 'logicalmathematical' );

        // Rename field visual_spatial on table block_tog_intelligences to spacial.
        // ATTENTION: we use 'spacial' instead of 'spatial' because this second one is a reserved word.
        $field = new xmldb_field( 'visual_spatial', XMLDB_TYPE_NUMBER, '15, 14', null, XMLDB_NOTNULL, null, null,
                'logicalmathematical' );
        $dbman->rename_field( $table, $field, 'spacial' );

        // Rename field kinestesica_corporal on table block_tog_intelligences to bodilykinesthetic.
        $field = new xmldb_field( 'kinestesica_corporal', XMLDB_TYPE_NUMBER, '15, 14', null, XMLDB_NOTNULL, null, null,
                'spacial' );
        $dbman->rename_field( $table, $field, 'bodilykinesthetic' );

        // Rename field musical_rhythmic on table block_tog_intelligences to musical.
        $field = new xmldb_field( 'musical_rhythmic', XMLDB_TYPE_NUMBER, '15, 14', null, XMLDB_NOTNULL, null, null,
                'bodilykinesthetic' );
        $dbman->rename_field( $table, $field, 'musical' );

        // Rename field naturalist_environmental on table block_tog_intelligences to environmental.
        $field = new xmldb_field( 'naturalist_environmental', XMLDB_TYPE_NUMBER, '15, 14', null, XMLDB_NOTNULL, null,
                null, 'interpersonal' );
        $dbman->rename_field( $table, $field, 'environmental' );

        // Tog savepoint reached.
        upgrade_block_savepoint( true, 2020082000, 'tog' );
    }

    return true;
}
