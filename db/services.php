<?php
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
/**
 * Web service block plugin template external functions and service definitions.
 *
 * @package block_task_oriented_groups
 * @copyright 2018 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
// We defined the web service functions to install.
$functions = array(
    'block_task_oriented_groups_store_personality_answer' => array(
        'classname' => 'block_task_oriented_groups_external',
        'methodname' => 'store_personality_answer',
        'classpath' => 'blocks/task_oriented_groups/externallib.php',
        'description' => 'Allow to store the user answer to a question of the personality test',
        'type' => 'write', 'ajax' => true
    ),
    'block_task_oriented_groups_store_competences_answer' => array(
        'classname' => 'block_task_oriented_groups_external',
        'methodname' => 'store_competences_answer',
        'classpath' => 'blocks/task_oriented_groups/externallib.php',
        'description' => 'Allow to store the user answer to a question of the competences test',
        'type' => 'write', 'ajax' => true
    )
);
// We define the services to install as pre-build services. A pre-build service is not editable by
// administrator.
$services = array(
    'task_oriented_groups' => array(
        'functions' => array('block_task_oriented_groups_store_personality_answer',
            'block_task_oriented_groups_store_competences_answer'
        ), 'restrictedusers' => 0, 'enabled' => 1
    )
);