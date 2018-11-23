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
 * Javascript components used to manage the competences quesions answers.
 *
 * @package block_task_oriented_groups
 * @copyright 2018 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define([ 'jquery', 'core/str', 'core_user/participants' ], function($, Str, Participants) {

	/**
	 * Called when a page item has been clicked.
	 *
	 * @param event
	 *          with the clicked information.
	 */
	function pageItemClicked(event) {

		event.stopPropagation();

		$('.fill-in-row').hide();
		$('.page-' + $(this).text().trim()).show();
	}

	/**
	 * Called when a send icon has been clicked.
	 *
	 * @param event
	 *          with the clicked information.
	 */
	function sendIconClicked(event) {

		event.stopPropagation();

		var userid = $(this).attr('data-userid');
		var users = [ userid ];
		var options = {
			courseid : getUrlParameter('courseid')
		};
		Participants.init(options).showSendMessage(users);

	}

	/**
	 * Send a message to the selected memebers.
	 *
	 * @param event
	 *          with the clicked information.
	 */
	function sendSelectedClicked(event) {

		event.stopPropagation();

		var users = $(".send-select:checked").map(function() {

			var checkbox = $(this);
			var userid = checkbox.attr('data-userid');
			checkbox.prop('checked', false);
			return userid;
		}).toArray();

		var options = {
			courseid : getUrlParameter('courseid')
		};
		Participants.init(options).showSendMessage(users);

	}

	/**
	 * Send a message to all the memebers.
	 *
	 * @param event
	 *          with the clicked information.
	 */
	function sendAllClicked(event) {

		event.stopPropagation();
		var users = $(".send-select").map(function() {

			return $(this).attr('data-userid');
		}).toArray();

		var options = {
			courseid : getUrlParameter('courseid')
		};
		Participants.init(options).showSendMessage(users);

	}

	/**
	 * Called when teh number of students per group has been changed.
	 */
	function studentsPerGroupChanged() {

		$('#composite__students_per_group_help').text('');
		$('#composite__at_most_selection').hide();
		var stringkeys = [ {
		  key : 'composite_students_per_group_how_many_pattern',
		  component : 'block_task_oriented_groups'
		}, {
		  key : 'composite_students_per_group_how_many_pattern_2',
		  component : 'block_task_oriented_groups'
		} ];
		Str.get_strings(stringkeys).then(function(patterns) {

			var studentsPerGroup = Number($('#composite__students_per_group').val());
			var studentsSize = Number($('#composite__students_size').val());
			var teams = calculateTeamsDistribution(studentsSize, studentsPerGroup);
			var teamsAtMost = calculateTeamsDistributionAtMost(studentsSize, studentsPerGroup);
			if (teams.length == 0 && teamsAtMost.length > 0) {

				$('#composite__students_per_group_help').text(localizeDistribution(teamsAtMost, patterns));
				$('#composite__at_most').val('true');

			} else if (teams.length > 0 && teamsAtMost.length == 0 || teams.toString() == teamsAtMost.toString()) {

				$('#composite__students_per_group_help').text(localizeDistribution(teams, patterns));
				$('#composite__at_most').val('false');

			} else {

				$('[for=composite__students_per_group_at_most_false]').text(localizeDistribution(teams, patterns));
				$('[for=composite__students_per_group_at_most_true]').text(localizeDistribution(teamsAtMost, patterns));
				$('#composite__at_most').val('true');
				$('#composite__students_per_group_at_most_true').prop('checked', true);
				$('#composite__at_most_selection').show();
			}

		});

	}

	/**
	 * Create the localization of a distribution.
	 *
	 * @param array
	 *          distribution
	 * @param array
	 *          patterns
	 */
	function localizeDistribution(distribution, patterns) {

		if (distribution.length == 2) {

			return patterns[0].replace(/\{\{teams\}\}/g, distribution[0]).replace(/\{\{size\}\}/g, distribution[1]);

		} else if (distribution.length == 4) {

			return patterns[1].replace(/\{\{teams1\}\}/g, distribution[0]).replace(/\{\{size1\}\}/g, distribution[1]).replace(/\{\{teams2\}\}/g,
			    distribution[2]).replace(/\{\{size2}}/g, distribution[3]);

		} else {

			return '';
		}

	}

	/**
	 * Called when teh number of students per group has been changed.
	 */
	function selectedRoleForUsersChanged() {

		var courseid = getUrlParameter('courseid');
		var roleid = $('#composite__selected_role_for_users').val();
		var url = window.location.href;
		var end = url.lastIndexOf('.php') + 4;
		url = url.substring(0, end);

		window.location.href = url + '?courseid=' + courseid + '&roleid=' + roleid;
	}

	/**
	 * Return the parameter of the url.
	 */
	function getUrlParameter(name) {
		name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
		var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
		var results = regex.exec(location.search);
		return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
	}

	/**
	 * Calculate the teams distributions.
	 *
	 * @param int
	 *          n number of students.
	 * @param int
	 *          m number of students per teams.
	 */
	function calculateTeamsDistribution(n, m) {

		if (m < 2) {

			return [];
		}
		var rest = n % m;
		var b = Math.floor(n / m);
		if (n >= m && rest === 0) {

			return [ b, m ];

		} else if (n >= m && rest === b) {

			return [ rest, m + 1 ];

		} else if (n >= m && rest < b) {

			return [ b - rest, m, rest, m + 1 ];

		} else {

			return [];
		}
	}

	/**
	 * Calculate the teams distributions at most.
	 *
	 * @param int
	 *          n number of students.
	 * @param int
	 *          m number of students per teams.
	 */
	function calculateTeamsDistributionAtMost(n, m) {

		if (m < 3) {

			return [];
		}
		var rest = n % m;
		var b = Math.floor(n / m);
		var c = (b + 1) * m % n;
		var bm = b * m;
		var c2 = c * (m - 1);
		if (n >= m && rest === 0) {

			return [ b, m ];

		} else if (n >= m && bm >= c2) {

			return [ b - c + 1, m, c, m - 1 ];

		} else {

			return [];
		}
	}

	/**
	 * Called when want use the at most memebers per group.
	 *
	 * @param event
	 *          with the clicked information.
	 */
	function studentsPerGroupAtMostTrueClicked(event) {

		event.stopPropagation();
		$('#composite__at_most').val('true');

	}

	/**
	 * Called when want not use the at most memebers per group.
	 *
	 * @param event
	 *          with the clicked information.
	 */
	function studentsPerGroupAtMostFalseClicked(event) {

		event.stopPropagation();
		$('#composite__at_most').val('false');

	}

	/**
	 * Called when want to remove a requirement.
	 *
	 * @param event
	 *          with the clicked information.
	 */
	function requirementsRemoveClicked(event) {

		event.stopPropagation();

		var requirement = $(this).parent();
		var requirements = JSON.parse($('#composite__requirements').val());
		var factor = Number(requirement.attr('data-factor'));
		switch (factor) {
		case 0:
			delete requirements.verbal;
			break;
		case 1:
			delete requirements.logic_mathematics;
			break;
		case 2:
			delete requirements.visual_spatial;
			break;
		case 3:
			delete requirements.kinestesica_corporal;
			break;
		case 4:
			delete requirements.musical_rhythmic;
			break;
		case 5:
			delete requirements.intrapersonal;
			break;
		case 6:
			delete requirements.interpersonal;
			break;
		default:
			delete requirements.naturalist_environmental;
		}
		$('#composite__requirements_factor_' + factor).show();
		$('#composite__requirements_factor').val(factor);
		$('#composite__requirements_add').prop('disabled', false);
		$('#composite__requirements').val(JSON.stringify(requirements));
		requirement.remove();
		if ($('#composite__requirements_list').children('li').length == 0) {

			$('#composite__requirements_none').show();
		}
	}

	/**
	 * Called when want to add a requirement.
	 *
	 * @param event
	 *          with the clicked information.
	 */
	function requirementsAddClicked(event) {

		event.stopPropagation();
		var factorSelector = $('#composite__requirements_factor');
		var factor = Number(factorSelector.val());
		var level = Number($('#composite__requirements_level').val());
		var importance = Number($('#composite__requirements_importance').val());
		var requirements = JSON.parse($('#composite__requirements').val());
		var requirement = {
		  'level' : level * 0.2,
		  'importance' : importance * 0.2
		};
		switch (factor) {
		case 0:
			requirements.verbal = requirement;
			break;
		case 1:
			requirements.logic_mathematics = requirement;
			break;
		case 2:
			requirements.visual_spatial = requirement;
			break;
		case 3:
			requirements.kinestesica_corporal = requirement;
			break;
		case 4:
			requirements.musical_rhythmic = requirement;
			break;
		case 5:
			requirements.intrapersonal = requirement;
			break;
		case 6:
			requirements.interpersonal = requirement;
			break;
		default:
			requirements.naturalist_environmental = requirement;
		}

		$('#composite__requirements_factor_' + factor).hide();
		factorSelector.val('');
		$(factorSelector.children('option').get().reverse()).each(function() {
			if ($(this).css('display') != 'none') {
				factorSelector.val($(this).val());
			}
		});
		if (factorSelector.val() == '' || factorSelector.val() == null) {
			// no more values
			$('#composite__requirements_add').prop('disabled', true);
		}
		$('#composite__requirements').val(JSON.stringify(requirements));
		$('#composite__requirements_none').hide();
		var requirementElement = $('<li class="list-group-item" data-factor="' + factor + '"></li>');
		var values = {
		  factor : $('#composite__requirements_factor_' + factor).text().trim().toLowerCase(),
		  level : $('#composite__requirements_level_' + level).text().trim().toLowerCase(),
		  importance : $('#composite__requirements_importance_' + importance).text().trim().toLowerCase()
		};
		Str.get_string('composite_requirements_pattern', 'block_task_oriented_groups', values).then(function(pattern) {
			requirementElement.append('<span>' + pattern + '</span>');
			requirementElement.append('&nbsp;&nbsp;');
			var removeAction = $('<i class="fa fa-trash"></i>');
			requirementElement.append(removeAction);
			removeAction.click(requirementsRemoveClicked);
		});
		$('#composite__requirements_list').append(requirementElement);

	}

	return {
	  pageItemClicked : pageItemClicked,
	  sendIconClicked : sendIconClicked,
	  selectedRoleForUsersChanged : selectedRoleForUsersChanged,
	  studentsPerGroupChanged : studentsPerGroupChanged,
	  calculateTeamsDistributionAtMost : calculateTeamsDistributionAtMost,
	  calculateTeamsDistribution : calculateTeamsDistribution,
	  sendSelectedClicked : sendSelectedClicked,
	  sendAllClicked : sendAllClicked,
	  studentsPerGroupAtMostTrueClicked : studentsPerGroupAtMostTrueClicked,
	  studentsPerGroupAtMostFalseClicked : studentsPerGroupAtMostFalseClicked,
	  requirementsAddClicked : requirementsAddClicked,
	  initialise : function($params) {

		  $('#composite__selected_role_for_users').change(selectedRoleForUsersChanged);
		  $('#composite__students_per_group').change(studentsPerGroupChanged);
		  $('#composite__send_selected').click(sendSelectedClicked);
		  $('#composite__send_all').click(sendAllClicked);
		  $('#composite__students_per_group_at_most_true').click(studentsPerGroupAtMostTrueClicked);
		  $('#composite__students_per_group_at_most_false').click(studentsPerGroupAtMostFalseClicked);
		  $('#composite__requirements_add').click(requirementsAddClicked);
		  $('.fill-in-row').hide();
		  $('.page-1').show();
		  $('.page-item').click(pageItemClicked);
		  $('.send-icon').click(sendIconClicked);
		  studentsPerGroupChanged();
	  }
	};

});
