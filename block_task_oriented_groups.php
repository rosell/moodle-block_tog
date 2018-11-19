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
        if (!is_null($this->content)) {
            return $this->content;
        }

        // create the links to the option of the block
        $this->content = new stdClass();
        $contents = array();

        if (has_capability('moodle/course:managegroups', $this->page->context)) {

            $contenturl = new moodle_url('/blocks/task_oriented_groups/view/composite.php');
            $contentlink = html_writer::link($contenturl,
                    get_string('main:composite', 'block_task_oriented_groups'));
            $contents[] = html_writer::tag('li', $contentlink);
        }

        if (Personality::isPersonalityCalculatedForCurrentUser()) {

            $contenturl = new moodle_url('/blocks/task_oriented_groups/view/personality.php');
            $contentlink = html_writer::link($contenturl,
                    get_string('main:my_personality', 'block_task_oriented_groups'));
            $contents[] = html_writer::tag('li', $contentlink);
        } else {

            $contenturl = new moodle_url('/blocks/task_oriented_groups/view/personality_test.php');
            $contentlink = html_writer::link($contenturl,
                    get_string('main:fill_personality_test', 'block_task_oriented_groups'));
            $contents[] = html_writer::tag('li', $contentlink);
        }

        if (Competences::isCompetencesCalculatedForCurrentUser()) {

            $contenturl = new moodle_url('/blocks/task_oriented_groups/view/competences.php');
            $contentlink = html_writer::link($contenturl,
                    get_string('main:my_competences', 'block_task_oriented_groups'));
            $contents[] = html_writer::tag('li', $contentlink);
        } else {

            $contenturl = new moodle_url('/blocks/task_oriented_groups/view/competences_test.php');
            $contentlink = html_writer::link($contenturl,
                    get_string('main:fill_competences_test', 'block_task_oriented_groups'));
            $contents[] = html_writer::tag('li', $contentlink);
        }
        $this->content->text = html_writer::tag('ol', implode('', $contents),
                array('class' => 'list'
                ));

        $this->content->footer = '';

        return $this->content;
    }
}
