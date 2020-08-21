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
 * Plugin strings in English are defined here.
 *
 * @package block_tog
 * @category string
 * @copyright 2018 - 2020 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined( 'MOODLE_INTERNAL' ) || die();

$string ['pluginname'] = 'Task oriented groups block';
$string ['tog'] = 'Task oriented groups';

$string ['settings:heading'] = 'A Moodle block to groupings users depending on the task to do. The formed groups have diversity in gender, personality and intelligence.';
$string ['settings:base_api_url_title'] = 'Base API URL';
$string ['settings:base_api_url_description'] = 'The URL to the external service that will generate the groups for a task. We provided the service (https://eduteams.iiia.csic.es/saas/) free of charges without any limitation on the number of calls. Unfortunately, we have some physics limits on the server that only can process some thousand of request per second. When the service is called, it stores the information of the HTTP header as the remote address or port, the number of students per group, the request intelligence, the expected performance for the groups, and the list of students. For each student is stored an identifier and its associated personality and intelligence. The identifier is anonymized so the service does not known at with person on the Moodle is associated with the identifier. Also, it stored the formed groups for the students. On the other hand, it stored the feedback provided by the teachers that are used to evaluate the performance of the formed groups.';

$string ['main:composite'] = 'Create a new groups by task';
$string ['main:fill_personality_test'] = 'Fill in your personality test';
$string ['main:my_personality'] = 'My personality';
$string ['main:my_intelligences'] = 'My intelligences';
$string ['main:fill_intelligences_test'] = 'Fill in your intelligences test';
$string ['main:auto_fill_in'] = 'Auto fill in tests';
$string ['main:feedback_test'] = 'Provide feedback of the created groups';

$string ['personality_test_title'] = 'Personality test';
$string ['personality_test_heading'] = 'Personality test';
$string ['personality_test_go_to_personality'] = 'Show my personality';
$string ['personality_test_go_to_course'] = 'Back to course';
$string ['personality_test_go_to_intelligences_test'] = 'Fill in intelligences test';
$string ['personality_test_storing_msg'] = 'Storing answer';

$string ['personality_question_0'] = 'I am';
$string ['personality_question_0_answer_0'] = 'Female';
$string ['personality_question_0_answer_1'] = 'Male';
$string ['personality_question_0_answer_2'] = 'I prefer not to answer';

$string ['personality_question_1'] = 'The judges must be';
$string ['personality_question_1_help'] = 'Example: If a judge judges your brother, you must follow the laws that apply to everyone equally.';
$string ['personality_question_1_answer_0'] = 'Compassionate';
$string ['personality_question_1_answer_1'] = 'Impartial';
$string ['personality_question_1_answer_2'] = 'It depends on each case';

$string ['personality_question_2'] = 'You prefer things';
$string ['personality_question_2_help'] = 'Example: I like to plan my day to day or I prefer to improvise.';
$string ['personality_question_2_answer_0'] = 'Open-ended';
$string ['personality_question_2_answer_1'] = 'Planned';
$string ['personality_question_2_answer_2'] = 'Indifferent';

$string ['personality_question_3'] = 'You prefer';
$string ['personality_question_3_answer_0'] = 'The traditional';
$string ['personality_question_3_answer_1'] = 'The new';
$string ['personality_question_3_answer_2'] = 'Indifferent';

$string ['personality_question_4'] = 'You prefer';
$string ['personality_question_4_answer_0'] = 'Being alone';
$string ['personality_question_4_answer_1'] = 'Be with someone';
$string ['personality_question_4_answer_2'] = 'Indifferent';

$string ['personality_question_5'] = 'You are more';
$string ['personality_question_5_help'] = 'Example: You believe in the things they say or you prefer to check it.';
$string ['personality_question_5_answer_0'] = 'Tolerant';
$string ['personality_question_5_answer_1'] = 'Skeptical';
$string ['personality_question_5_answer_2'] = 'Indifferent';

$string ['personality_question_6'] = 'You work better';
$string ['personality_question_6_answer_0'] = 'Without pressure';
$string ['personality_question_6_answer_1'] = 'With pressure';
$string ['personality_question_6_answer_2'] = 'Indifferent';

$string ['personality_question_7'] = 'You are more';
$string ['personality_question_7_help'] = 'Example: When I do my homework, I like to organize it step by step, always in the same order or I prefer to start at random.';
$string ['personality_question_7_answer_0'] = 'Methodic';
$string ['personality_question_7_answer_1'] = 'Improviser';
$string ['personality_question_7_answer_2'] = 'Indifferent';

$string ['personality_question_8'] = 'You are more';
$string ['personality_question_8_help'] = 'Example: I like mathematics more (theoretical) or physical education (practical).';
$string ['personality_question_8_answer_0'] = 'Theoretical';
$string ['personality_question_8_answer_1'] = 'Practical';
$string ['personality_question_8_answer_2'] = 'Indifferent';

$string ['personality_question_9'] = 'You are more';
$string ['personality_question_9_help'] = 'Example: I like to tell everything to what happens to my friends or I prefer to keep it for me.';
$string ['personality_question_9_answer_0'] = 'Reserved';
$string ['personality_question_9_answer_1'] = 'Social';
$string ['personality_question_9_answer_2'] = 'Indifferent';

$string ['personality_question_10'] = 'You see yourself more';
$string ['personality_question_10_help'] = 'Example: You prefer to build a robot (Curious) or buy it already made (Accommodated).';
$string ['personality_question_10_answer_0'] = 'Accommodated';
$string ['personality_question_10_answer_1'] = 'Curious';
$string ['personality_question_10_answer_2'] = 'Indifferent';

$string ['personality_question_11'] = 'You are more';
$string ['personality_question_11_answer_0'] = 'Content';
$string ['personality_question_11_answer_1'] = 'Expressive';
$string ['personality_question_11_answer_2'] = 'Indifferent';

$string ['personality_question_12'] = 'You are more';
$string ['personality_question_12_help'] = 'Example: I say things as they are (honest) or I prefer to omit words that may hurt.';
$string ['personality_question_12_answer_0'] = 'Diplomatic';
$string ['personality_question_12_answer_1'] = 'Honest';
$string ['personality_question_12_answer_2'] = 'Indifferent';

$string ['personality_question_13'] = 'You prefer';
$string ['personality_question_13_help'] = 'Example: You prefer to make maps (the concrete) or solve mathematical problems (the abstract).';
$string ['personality_question_13_answer_0'] = 'The specific';
$string ['personality_question_13_answer_1'] = 'The abstract';
$string ['personality_question_13_answer_2'] = 'Indifferent';

$string ['personality_question_14'] = 'You are more';
$string ['personality_question_14_answer_0'] = 'Silent';
$string ['personality_question_14_answer_1'] = 'Talkative';
$string ['personality_question_14_answer_2'] = 'Indifferent';

$string ['personality_question_15'] = 'You learn better';
$string ['personality_question_15_answer_0'] = 'Reading';
$string ['personality_question_15_answer_1'] = 'Listening';
$string ['personality_question_15_answer_2'] = 'Indifferent';

$string ['personality_question_16'] = 'You are more';
$string ['personality_question_16_help'] = 'Example: You like to think about why airplanes fly (conceptual) or make a model of an airplane (practical)';
$string ['personality_question_16_answer_0'] = 'Practical';
$string ['personality_question_16_answer_1'] = 'Conceptual';
$string ['personality_question_16_answer_2'] = 'Indifferent';

$string ['personality_question_17'] = 'You prefer';
$string ['personality_question_17_help'] = 'Example: If your friend arrives 20 minutes late, you want to know why (empathy) or you get angry regardless of the reason (logic).';
$string ['personality_question_17_answer_0'] = 'Empathy';
$string ['personality_question_17_answer_1'] = 'Logic';
$string ['personality_question_17_answer_2'] = 'Indifferent';

$string ['personality_question_18'] = 'You prefer';
$string ['personality_question_18_help'] = 'Example: When there is a robbery I prefer to investigate the facts or imagine what could have happened.';
$string ['personality_question_18_answer_0'] = 'Investigate';
$string ['personality_question_18_answer_1'] = 'Speculate';
$string ['personality_question_18_answer_2'] = 'Indifferent';

$string ['personality_question_19'] = 'You are more';
$string ['personality_question_19_help'] = 'Example: When I prepare to go to sleep, I always follow the same order (wash teeth, put on pajamas etc).';
$string ['personality_question_19_answer_0'] = 'Systematic';
$string ['personality_question_19_answer_1'] = 'Informal';
$string ['personality_question_19_answer_2'] = 'Indifferent';

$string ['personality_question_20'] = 'You prefer';
$string ['personality_question_20_help'] = 'Example: I like to eat different things (variety) or I prefer to always eat pizza (routine).';
$string ['personality_question_20_answer_0'] = 'Routine';
$string ['personality_question_20_answer_1'] = 'Variety';
$string ['personality_question_20_answer_2'] = 'Indifferent';

$string ['intelligences_test_title'] = 'Intelligences test';
$string ['intelligences_test_heading'] = 'Intelligences test';
$string ['intelligences_test_go_to_intelligences'] = 'Show my intelligences';
$string ['intelligences_test_go_to_course'] = 'Back to course';
$string ['intelligences_test_go_to_personality_test'] = 'Fill in personality test';
$string ['intelligences_test_storing_msg'] = 'Storing answer';

$string ['intelligence_question_0'] = 'Writing is a natural way for me to express myself';
$string ['intelligence_question_answer_0'] = 'Totally disagree';
$string ['intelligence_question_answer_1'] = 'Disagree';
$string ['intelligence_question_answer_2'] = 'Neither agree nor disagree';
$string ['intelligence_question_answer_3'] = 'Agree';
$string ['intelligence_question_answer_4'] = 'Totally agree';

$string ['intelligence_question_1'] = 'At school studies in native language or social studies were easier for me than mathematics, physics and chemistry.';

$string ['intelligence_question_2'] = 'I have recently written something that I am especially proud of, or for which I have received recognition.';

$string ['intelligence_question_3'] = 'Metaphors and vivid verbal expressions help me learn efficiently.';

$string ['intelligence_question_4'] = 'At school I was good at mathematics, physics or chemistry.';

$string ['intelligence_question_5'] = 'I can work with and solve complex problems.';

$string ['intelligence_question_6'] = 'Mental arithmetic is easy for me.';

$string ['intelligence_question_7'] = 'I am good at games and problem solving, which require logical thinking.';

$string ['intelligence_question_8'] = 'At school, geometry and various kinds of assignments involving spacial perception were easier for me than solving equations.';

$string ['intelligence_question_9'] = 'It is easy for me to conceptualize complex and multidimensional patterns.';

$string ['intelligence_question_10'] = 'I can easily imagine how a landscape looks from a bird’s-eye view.';

$string ['intelligence_question_11'] = 'When I read, I form illustrative pictures or designs in my mind.';

$string ['intelligence_question_12'] = 'I am handy.';

$string ['intelligence_question_13'] = 'I can easily do something concrete with my hands (e.g. knitting and woodwork).';

$string ['intelligence_question_14'] = 'I am good at showing how to do something in practice.';

$string ['intelligence_question_15'] = 'I was good at handicrafts at school.';

$string ['intelligence_question_16'] = 'After hearing a tune once or twice I am able to sing or whistle it quite accurately.';

$string ['intelligence_question_17'] = 'When listening to music, I am able to discern instruments or recognize melodies.';

$string ['intelligence_question_18'] = 'I can easily keep the rhythm when drumming a melody.';

$string ['intelligence_question_19'] = 'I notice immediately if a melody is out of tune.';

$string ['intelligence_question_20'] = 'Even in strange company, I easily find someone to talk to.';

$string ['intelligence_question_21'] = 'I get alone easily with different types of people.';

$string ['intelligence_question_22'] = 'I make contact easily with other people.';

$string ['intelligence_question_23'] = 'In negotiations and group work, I am able to support the group to find a consensus.';

$string ['intelligence_question_24'] = 'I am able to analyze my own motives and ways of action.';

$string ['intelligence_question_25'] = 'I often think about my own feelings and sentiments and seek reasons for them.';

$string ['intelligence_question_26'] = 'I spend time regularly reflecting on the important issues in life.';

$string ['intelligence_question_27'] = 'I like to read psychological or philosophical literature to increase my self-knowledge.';

$string ['intelligence_question_28'] = 'I enjoy the beauty and experiences related to nature.';

$string ['intelligence_question_29'] = 'Protecting the nature is important to me.';

$string ['intelligence_question_30'] = 'I pay attention to my consumption habits in order to protect environment.';

$string ['store_personality_answer_error_title'] = 'Error';
$string ['store_personality_answer_error_text'] = 'Could not store your personality answer.';
$string ['store_personality_answer_error_continue'] = 'ok';

$string ['store_intelligences_answer_error_title'] = 'Error';
$string ['store_intelligences_answer_error_text'] = 'Could not store your intelligences answer.';
$string ['store_intelligences_answer_error_continue'] = 'ok';

$string ['privacy:metadata:block_tog_perso_answers'] = 'Information about the answers of the user to the personality test questions.';
$string ['privacy:metadata:block_tog_perso_answers:userid'] = 'The ID of the user that answer the question.';
$string ['privacy:metadata:block_tog_perso_answers:question'] = 'The identifier of the question.';
$string ['privacy:metadata:block_tog_perso_answers:answer'] = 'The identifier of the answer in the question.';
$string ['privacy:export:block_tog_perso_answers'] = 'Personality test';

$string ['privacy:metadata:block_tog_intel_answers'] = 'Information about the answers of the user to the intelligences test questions.';
$string ['privacy:metadata:block_tog_intel_answers:userid'] = 'The ID of the user that answer the question.';
$string ['privacy:metadata:block_tog_intel_answers:question'] = 'The identifier of the question.';
$string ['privacy:metadata:block_tog_intel_answers:answer'] = 'The identifier of the answer in the question.';
$string ['privacy:export:block_tog_intel_answers'] = 'Intelligences test';

$string ['privacy:metadata:block_tog_personality'] = 'Information about the personality of an user.';
$string ['privacy:metadata:block_tog_personality:userid'] = 'The ID of the user that the personality refers.';
$string ['privacy:metadata:block_tog_personality:type'] = 'The type of personality.';
$string ['privacy:metadata:block_tog_personality:gender'] = 'The gender of the user.';
$string ['privacy:metadata:block_tog_personality:judgment'] = 'The judgment personality factor of the user.';
$string ['privacy:metadata:block_tog_personality:attitude'] = 'The attitude personality factor of the user.';
$string ['privacy:metadata:block_tog_personality:perception'] = 'The perception personality factor of the user.';
$string ['privacy:metadata:block_tog_personality:gender'] = 'The extrovert personality factor of the user.';
$string ['privacy:export:block_tog_personality'] = 'Personality';

$string ['privacy:metadata:block_tog_intelligences'] = 'Information about the intelligences of an user.';
$string ['privacy:metadata:block_tog_intelligences:userid'] = 'The ID of the user that the intelligences refers.';
$string ['privacy:metadata:block_tog_intelligences:linguistic'] = 'The linguistic intelligence factor of the user.';
$string ['privacy:metadata:block_tog_intelligences:logicalmathematical'] = 'The logical/mathematical intelligence factor of the user.';
$string ['privacy:metadata:block_tog_intelligences:spacial'] = 'The visual/spacial intelligence factor of the user.';
$string ['privacy:metadata:block_tog_intelligences:bodilykinesthetic'] = 'The kinestesica/corporal intelligence factor of the user.';
$string ['privacy:metadata:block_tog_intelligences:musical'] = 'The musical/rhythmic intelligence factor of the user.';
$string ['privacy:metadata:block_tog_intelligences:intrapersonal'] = 'The intrapersonal intelligence factor of the user.';
$string ['privacy:metadata:block_tog_intelligences:interpersonal'] = 'The interpersonal intelligence factor of the user.';
$string ['privacy:metadata:block_tog_intelligences:environmental'] = 'The naturalist/environmental intelligence factor of the user.';
$string ['privacy:export:block_tog_intelligences'] = 'Intelligences';

$string ['personality_title'] = 'Personality';
$string ['personality_heading'] = 'Personality';
$string ['personality_go_to_test'] = 'Modify personality test';
$string ['personality_read_more'] = 'Read more';
$string ['personality_msg'] = 'Your personality is {$a->type} ( {$a->name} ). {$a->description}';
$string ['personality_ENFJ_description'] = 'Charismatic and inspiring leaders, able to mesmerize their listeners.';
$string ['personality_ENFJ_more'] = 'https://www.16personalities.com/enfj-personality';
$string ['personality_ENFJ_name'] = 'The protagonist';
$string ['personality_ENFP_description'] = 'Enthusiastic, creative and sociable free spirits, who can always find a reason to smile.';
$string ['personality_ENFP_more'] = 'https://www.16personalities.com/enfp-personality';
$string ['personality_ENFP_name'] = 'The campaigner';
$string ['personality_ENTJ_description'] = 'Bold, imaginative and strong-willed leaders, always finding a way – or making one.';
$string ['personality_ENTJ_more'] = 'https://www.16personalities.com/entj-personality';
$string ['personality_ENTJ_name'] = 'The commander';
$string ['personality_ENTP_description'] = 'Smart and curious thinkers who cannot resist an intellectual challenge.';
$string ['personality_ENTP_more'] = 'https://www.16personalities.com/entp-personality';
$string ['personality_ENTP_name'] = 'The debater';
$string ['personality_ESFJ_description'] = 'Extraordinarily caring, social and popular people, always eager to help.';
$string ['personality_ESFJ_more'] = 'https://www.16personalities.com/esfj-personality';
$string ['personality_ESFJ_name'] = 'The consul';
$string ['personality_ESFP_description'] = 'Spontaneous, energetic and enthusiastic people – life is never boring around them.';
$string ['personality_ESFP_more'] = 'https://www.16personalities.com/esfp-personality';
$string ['personality_ESFP_name'] = 'The entertainer';
$string ['personality_ESTJ_description'] = 'Excellent administrators, unsurpassed at managing things – or people.';
$string ['personality_ESTJ_more'] = 'https://www.16personalities.com/estj-personality';
$string ['personality_ESTJ_name'] = 'The executive';
$string ['personality_ESTP_description'] = 'Smart, energetic and very perceptive people, who truly enjoy living on the edge.';
$string ['personality_ESTP_more'] = 'https://www.16personalities.com/estp-personality';
$string ['personality_ESTP_name'] = 'The entrepreneur';
$string ['personality_INFJ_description'] = 'Quiet and mystical, yet very inspiring and tireless idealists.';
$string ['personality_INFJ_more'] = 'https://www.16personalities.com/infj-personality';
$string ['personality_INFJ_name'] = 'The advocate';
$string ['personality_INFP_description'] = 'Poetic, kind and altruistic people, always eager to help a good cause.';
$string ['personality_INFP_more'] = 'https://www.16personalities.com/infp-personality';
$string ['personality_INFP_name'] = 'The mediator';
$string ['personality_INTJ_description'] = 'Imaginative and strategic thinkers, with a plan for everything.';
$string ['personality_INTJ_more'] = 'https://www.16personalities.com/intj-personality';
$string ['personality_INTJ_name'] = 'The architect';
$string ['personality_INTP_description'] = 'Innovative inventors with an unquenchable thirst for knowledge. Imaginative and strategic thinkers, with a plan for everything.';
$string ['personality_INTP_more'] = 'https://www.16personalities.com/intp-personality';
$string ['personality_INTP_name'] = 'The logician';
$string ['personality_ISFJ_description'] = 'Very dedicated and warm protectors, always ready to defend their loved ones.';
$string ['personality_ISFJ_more'] = 'https://www.16personalities.com/isfj-personality';
$string ['personality_ISFJ_name'] = 'The defender';
$string ['personality_ISFP_description'] = 'Flexible and charming artists, always ready to explore and experience something new.';
$string ['personality_ISFP_more'] = 'https://www.16personalities.com/isfp-personality';
$string ['personality_ISFP_name'] = 'The adventurer';
$string ['personality_ISTJ_description'] = 'Practical and fact-minded individuals, whose reliability cannot be doubted.';
$string ['personality_ISTJ_more'] = 'https://www.16personalities.com/istj-personality';
$string ['personality_ISTJ_name'] = 'The logistician';
$string ['personality_ISTP_description'] = 'Bold and practical experimenters, masters of all kinds of tools.';
$string ['personality_ISTP_more'] = 'https://www.16personalities.com/istp-personality';
$string ['personality_ISTP_name'] = 'The virtuoso';
$string ['personality_error_not_answered_all_questions'] = 'You have to answer all the questions to be able to know your personality';
$string ['personality_go_to_course'] = 'Back to the course';
$string ['personality_go_to_intelligences_test'] = 'Fill in intelligences test';

$string ['intelligences_title'] = 'Intelligences';
$string ['intelligences_heading'] = 'Intelligences';
$string ['intelligences_msg'] = 'Your intelligences are';
$string ['intelligences_value_0'] = 'Fundamental awareness';
$string ['intelligences_value_1'] = 'Novice';
$string ['intelligences_value_2'] = 'Intermediate';
$string ['intelligences_value_3'] = 'Advanced';
$string ['intelligences_value_4'] = 'Expert';
$string ['intelligences_interpersonal'] = 'Interpersonal intelligence';
$string ['intelligences_interpersonal_help'] = 'The interpersonal intelligence measures persons’ perceptions of his/her abilities to social relations.';
$string ['intelligences_intrapersonal'] = 'Intrapersonal intelligence';
$string ['intelligences_intrapersonal_help'] = 'The intrapersonal intelligence consisted of two components. The “Self-reflection” component measured persons’ views on their ability to reflect on important issues in life, and deep psychological and philosophical issues.';
$string ['intelligences_bodilykinesthetic'] = 'Linguistic intelligence';
$string ['intelligences_bodilykinesthetic_help'] = 'The Bodily-kinesthetic intelligence is used to measure persons’ views on their abilities related to working with hands and coordinating their bodies.';
$string ['intelligences_logicalmathematical'] = 'Logical-mathematical intelligence intelligence';
$string ['intelligences_logicalmathematical_help'] = 'The logical-mathematical intelligence is used to measure the skills of a person on mathematical ability and on logical thinking.';
$string ['intelligences_musical'] = 'Musical intelligence';
$string ['intelligences_musical_help'] = 'The musical intelligence is used to measure the ability of a person to hearing or producing music.';
$string ['intelligences_environmental'] = 'Environmental intelligence';
$string ['intelligences_environmental_help'] = 'The environmental intelligence has following three categories: 1) Love for nature; 2) Nature conservation; 3) Environment-friendly consumer habits';
$string ['intelligences_linguistic'] = 'Linguistic intelligence';
$string ['intelligences_linguistic_help'] = 'The linguistic intelligence is used to measure the skills of a person on verbal and written expressions.';
$string ['intelligences_spacial'] = 'Spacial intelligence';
$string ['intelligences_spacial_help'] = 'The spacial intelligence measured persons’ vies on his/her abilities to visualize and work with multidimensional objects.';
$string ['intelligences_go_to_test'] = 'Modify intelligences test';
$string ['intelligences_error_not_answered_all_questions'] = 'You have to answer all the questions to be able to know your intelligences';
$string ['intelligences_go_to_course'] = 'Back to the course';
$string ['intelligences_go_to_personality_test'] = 'Fill in personality test';

$string ['composite_title'] = 'Composite groups';
$string ['composite_heading'] = 'Composite groups by task';
$string ['composite_alert_no_capability'] = 'You do not have the capability to composite groups. Ask to the administrator the required privileges to do it.';
$string ['composite_grouping_name'] = 'Grouping name';
$string ['composite_grouping_name_placeholder'] = 'Write the grouping name.';
$string ['composite_grouping_name_help'] = 'The name associated to the group that will be composited.';
$string ['composite_groups_pattern'] = 'Group pattern';
$string ['composite_groups_pattern_default'] = 'Group {}';
$string ['composite_groups_pattern_help'] = 'The pattern used to generate the name of the groups. The symbol {} will be replaced by the index of the generated group.';
$string ['composite_members_per_group'] = 'Members per group';
$string ['composite_members_per_group_help'] = 'The number of students that has to be on each generated group.';
$string ['composite_error_not_enough_users'] = 'Not enough users has filled in the personality and intelligence tests.';
$string ['composite_column_name'] = 'User name';
$string ['composite_column_personality'] = 'Fill in personality test';
$string ['composite_column_personality_not_filled'] = 'The user has not filled in the personality test';
$string ['composite_column_personality_filled'] = 'The user has filled in the personality test';
$string ['composite_column_intelligences'] = 'Fill in intelligences test';
$string ['composite_column_intelligences_not_filled'] = 'The user has not filled in the intelligences test';
$string ['composite_column_intelligences_filled'] = 'The user has filled in the intelligences test';
$string ['composite_column_send'] = 'Send message';
$string ['composite_column_send_alt'] = 'Send a message to the user that has not filled in the personality or the intelligence test';
$string ['composite_unfilled_msg'] = 'There are {$a} users who have not completed the personality or intelligences test. Without this information it is not possible to know which group to go, so they will not be added to any group. In the following table you can know who they are.';
$string ['composite_select_role_for_users'] = 'Select members with role';
$string ['composite_select_role_for_users_help'] = 'Select the role for the members that has to be used to form the groups';
$string ['composite_send_selected'] = 'Send message to selected ones';
$string ['composite_send_all'] = 'Send message to all';
$string ['composite_members_per_group_how_many_pattern'] = 'You can form {{groups}} groups with {{size}} member in each one';
$string ['composite_members_per_group_how_many_pattern_2'] = 'You can form {{groups1}} groups with {{size1}} member in each one and {{groups2}} groups with {{size2}} member in each one';
$string ['composite_requirements'] = 'Requirements';
$string ['composite_requirements_help'] = 'Requirements that are necessary to do the task in question';
$string ['composite_requirements_add'] = 'Add';
$string ['composite_requirements'] = 'Factor';
$string ['composite_requirements_factor_help'] = 'The intelligences required from member groups to perform the task in question';
$string ['composite_requirements_factor_0'] = 'Linguistic';
$string ['composite_requirements_factor_1'] = 'Logical-Mathematics';
$string ['composite_requirements_factor_2'] = 'Visual-Spacial';
$string ['composite_requirements_factor_3'] = 'Bodily-Kinesthetic';
$string ['composite_requirements_factor_4'] = 'Musical';
$string ['composite_requirements_factor_5'] = 'Intrapersonal';
$string ['composite_requirements_factor_6'] = 'Interpersonal';
$string ['composite_requirements_factor_7'] = 'Naturalist-Environmental';
$string ['composite_requirements_importance'] = 'Importance';
$string ['composite_requirements_importance_help'] = 'The importance of this intelligence to perform the task in question';
$string ['composite_requirements_importance_0'] = 'Not at all important';
$string ['composite_requirements_importance_1'] = 'Slightly important';
$string ['composite_requirements_importance_2'] = 'Important';
$string ['composite_requirements_importance_3'] = 'Fairly important';
$string ['composite_requirements_importance_4'] = 'Very important';
$string ['composite_requirements_level'] = 'Level';
$string ['composite_requirements_level_help'] = 'The required intelligence level';
$string ['composite_requirements_level_0'] = 'Fundamental awareness';
$string ['composite_requirements_level_1'] = 'Novice';
$string ['composite_requirements_level_2'] = 'Intermediate';
$string ['composite_requirements_level_3'] = 'Advanced';
$string ['composite_requirements_level_4'] = 'Expert';
$string ['composite_requirements_none'] = 'At the moment the task does not have intelligence requirements. The members are grouped based on gender and personality.';
$string ['composite_requirements_pattern'] = 'For the intelligence {$a->factor} is {$a->importance} a minimum {$a->level} level';
$string ['composite_performance'] = 'Performance';
$string ['composite_performance_help'] = 'Define if you want over performance or underperformance groups';
$string ['composite_performance_over'] = 'Over performance';
$string ['composite_performance_under'] = 'Underperformance';
$string ['composite_submit'] = 'Composite groups';
$string ['composite_progress'] = 'Calculating';
$string ['composite_groups_error_title'] = 'Error';
$string ['composite_groups_error_text'] = 'Cannot calculate the groups.';
$string ['composite_groups_error_continue'] = 'Ok';

$string ['externallib:group_description_reponsable_of'] = 'is responsible for';
$string ['externallib:group_description_no_responsibility'] = 'has no responsibility for the group';
$string ['externallib:group_description_last_intelligence_and'] = 'and';
$string ['externallib:group_description_intelligence_interpersonal'] = 'Interpersonal intelligence';
$string ['externallib:group_description_intelligence_intrapersonal'] = 'Intrapersonal intelligence';
$string ['externallib:group_description_intelligence_bodilykinesthetic'] = 'Bodily-kinesthetic intelligence';
$string ['externallib:group_description_intelligence_logicalmathematical'] = 'Logical-mathematical intelligence';
$string ['externallib:group_description_intelligence_musical'] = 'Musical intelligence';
$string ['externallib:group_description_intelligence_environmental'] = 'Naturalist-environmental intelligence';
$string ['externallib:group_description_intelligence_linguistic'] = 'Linguistic intelligence';
$string ['externallib:group_description_intelligence_spacial'] = 'Visual-Spacial intelligence';

$string ['auto_fill_in_title'] = 'Auto fill in tests';
$string ['auto_fill_in_heading'] = 'Auto fill in the test of the users';
$string ['auto_fill_in_column_name'] = 'User name';
$string ['auto_fill_in_column_personality'] = 'Fill in personality test';
$string ['auto_fill_in_submit_personality'] = 'Auto fill in';
$string ['auto_fill_in_column_personality_filled'] = 'The user has filled in the personality test';
$string ['auto_fill_in_column_intelligences'] = 'Fill in intelligences test';
$string ['auto_fill_in_submit_intelligences'] = 'Auto fill in';
$string ['auto_fill_in_column_intelligences_filled'] = 'The user has filled in the intelligences test';

$string ['feedback_test_title'] = 'Provide feedback about the performance of a composed team';
$string ['feedback_test_heading'] = 'Provide feedback about the performance of a composed team';
$string ['feedback_question_0'] = 'The group has been organized and collaborated, everyone has been involved in the tasks to be done';
$string ['feedback_question_1'] = 'The whole group has spoken in order to make agreements and plan tasks';
$string ['feedback_question_2'] = 'The group has worked autonomously: the problems have been solved within the group, and the solutions have been found among all';
$string ['feedback_question_3'] = 'The group has made a co-evaluation in a critical and responsible way';
$string ['feedback_question_answer_0'] = 'Little bit';
$string ['feedback_question_answer_1'] = 'Neither much nor little';
$string ['feedback_question_answer_2'] = 'A lot';
$string ['feedback_test_submit'] = 'Report feedback';
$string ['feedback_test_progress'] = 'Reporting';
$string ['feedback_test_groups_error_title'] = 'Error';
$string ['feedback_test_groups_error_text'] = 'Cannot report the feedback for the group.';
$string ['feedback_test_groups_error_continue'] = 'Ok';
$string ['feedback_test_alert_no_capability'] = 'You do not have the capability to provide feedback of a group. Ask to the administrator the required privileges to do it.';
$string ['feedback_test_alert_empty'] = 'Does not exist any group to report feedback.';
$string ['feedback_test_grouping_selector'] = 'Choose a grouping';
$string ['feedback_test_grouping_selector_help'] = 'You have to choose the grouping where the group to provide feedback is defined.';
$string ['feedback_test_group_selector'] = 'Choose a group';
$string ['feedback_test_group_selector_help'] = 'You have to choose the group to provide feedback.';
$string ['feedback_test_group'] = 'Group';
$string ['feedback_test_group_help'] = 'You have to choose the group to provide feedback.';
$string ['feedback_test_alert_submit_success'] = 'Your feedback has been stored.';
