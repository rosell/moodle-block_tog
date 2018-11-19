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
defined('MOODLE_INTERNAL') || die();

use block_task_oriented_groups\Personality;
use block_task_oriented_groups\Competences;

/**
 * Block task_oriented_groups is defined here.
 *
 * @package block_task_oriented_groups
 * @copyright 2018 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_task_oriented_groups extends block_base {

    /**
     * Initializes the block, called by the constructor
     */
    public function init() {
        $this->title = get_string('task_oriented_groups', 'block_task_oriented_groups');
    }

    /**
     * Which page types this block may appear on
     *
     * @return array
     */
    public function applicable_formats() {
        return array('site-index' => true, 'course-view-*' => true, 'all' => true
        );
    }

    /**
     * Populate this block's content object
     *
     * @return stdClass block content info
     */
    public function get_content() {
        global $CFG, $OUTPUT, $USER;
        if (!is_null($this->content)) {
            return $this->content;
        }
        $this->content = new stdClass();
        $this->content->text = 'Text: Hello world';

        $this->content->footer = $OUTPUT->render_from_template('block_task_oriented_groups/footer',
                (object) array('wwwroot' => $CFG->wwwroot,
                    'personalityDefined' => Personality::isPersonalityCalculatedForCurrentUser(),
                    'competencesDefined' => Competences::isCompetencesCalculatedForCurrentUser()
                ));

        return $this->content;
    }
}
