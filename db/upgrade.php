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

    if ($oldversion < 2020081800) {
        // Remove the table intelligences and create again.
        $table = new xmldb_table( 'block_tog_intelligences' );
        if ($dbman->table_exists( $table )) {

            $dbman->drop_table( $table );
        }
        // Define table block_tog_intelligences to be created.
        $table = new xmldb_table( 'block_tog_intelligences' );

        // Adding fields to table block_tog_intelligences.
        $table->add_field( 'id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null );
        $table->add_field( 'userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null );
        $table->add_field( 'verbal', XMLDB_TYPE_NUMBER, '15, 14', null, XMLDB_NOTNULL, null, null );
        $table->add_field( 'logicmathematics', XMLDB_TYPE_NUMBER, '15, 14', null, XMLDB_NOTNULL, null, null );
        $table->add_field( 'visualspatial', XMLDB_TYPE_NUMBER, '15, 14', null, XMLDB_NOTNULL, null, null );
        $table->add_field( 'kinestesicacorporal', XMLDB_TYPE_NUMBER, '15, 14', null, XMLDB_NOTNULL, null, null );
        $table->add_field( 'musicalrhythmic', XMLDB_TYPE_NUMBER, '15, 14', null, XMLDB_NOTNULL, null, null );
        $table->add_field( 'intrapersonal', XMLDB_TYPE_NUMBER, '15, 14', null, XMLDB_NOTNULL, null, null );
        $table->add_field( 'interpersonal', XMLDB_TYPE_NUMBER, '15, 14', null, XMLDB_NOTNULL, null, null );
        $table->add_field( 'naturalistenvironmental', XMLDB_TYPE_NUMBER, '15, 14', null, XMLDB_NOTNULL, null, null );

        // Adding keys to table block_tog_intelligences.
        $table->add_key( 'primary', XMLDB_KEY_PRIMARY, [ 'id'
        ] );

        // Conditionally launch create table for block_tog_intelligences.
        if (! $dbman->table_exists( $table )) {
            $dbman->create_table( $table );
        }

        // Tog savepoint reached.
        upgrade_block_savepoint( true, 2020081800, 'tog' );
    }

    return true;
}
