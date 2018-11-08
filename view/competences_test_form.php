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
require_once ("{$CFG->libdir}/formslib.php");
use block_task_oriented_groups\CompetencesQuestionnaire;

/**
 * Form to fill in the competences test.
 *
 * @package block_task_oriented_groups
 * @category blocks
 * @copyright UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class competences_test_form extends moodleform {

    function definition() {
        $mform = & $this->_form;

        for ($i = 0; $i < CompetencesQuestionnaire::countQuestions(); $i++) {

            $questionId = 'competencesQuestion_' . $i;
            $mform->addElement('header', 'header_' . $questionId,
                    CompetencesQuestionnaire::getQuestionTextOf($i));
            $answers = array();
            for ($j = 0; $j < CompetencesQuestionnaire::MAX_QUESTION_ANSWERS; $j++) {

                $answers[] = $mform->createElement('radio', 'answersOfCompetencesQuestion_' . $i, '',
                        CompetencesQuestionnaire::getAnswerQuestionTextOf($j),
                        CompetencesQuestionnaire::getAnswerQuestionValuetOf($j), '');
            }
            $mform->addGroup($answers, $questionId, null, array(' '
            ), false);
            if (CompetencesQuestionnaire::hasQuestionHelp($i)) {

                $mform->addHelpButton('header_' . $questionId,
                        CompetencesQuestionnaire::getQuestionHelpIdentifier($i),
                        'block_task_oriented_groups');
            }
            $mform->setDefault($questionId, null);
        }
    }
}