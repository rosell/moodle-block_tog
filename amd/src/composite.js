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

		var smallText = $('#composite__students_per_group_help');
		smallText.text('');
		var atMost = $('#composite__at_most');
		atMost.hide();
		var atMostTrue = $('[for=composite__students_per_group_at_most_true]');
		atMostTrue.text('');
		var atMostFalse = $('[for=composite__students_per_group_at_most_false]');
		atMostFalse.text('');
		var stringkeys = [ {
		  key : 'composite_students_per_group_how_many_pattern',
		  component : 'block_task_oriented_groups'
		}, {
		  key : 'composite_students_per_group_how_many_pattern_2',
		  component : 'block_task_oriented_groups'
		} ];
		Str.get_strings(stringkeys).then(function(patterns) {

			var smallText = $('#composite__students_per_group_help');
			var atMost = $('#composite__at_most');
			var atMostTrue = $('[for=composite__students_per_group_at_most_true]');
			var atMostFalse = $('[for=composite__students_per_group_at_most_false]');
			var studentsPerGroup = Number($('#composite__students_per_group').val());
			var studentsSize = Number($('#composite__students_size').val());
			var teams = calculateTeamsDistribution(studentsSize, studentsPerGroup);
			var teamsAtMost = calculateTeamsDistributionAtMost(studentsSize, studentsPerGroup);
			var text = '';
			if (teams.length == 0 && teamsAtMost.length > 0) {

				text = localizeDistribution(teamsAtMost, patterns);
				smallText.text(text);

			} else if (teams.length > 0 && teamsAtMost.length == 0) {

				text = localizeDistribution(teams, patterns);
				smallText.text(text);

			} else {

				text = localizeDistribution(teams, patterns);
				atMostFalse.text(text);
				text = localizeDistribution(teamsAtMost, patterns);
				atMostTrue.text(text);
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

	return {
	  pageItemClicked : pageItemClicked,
	  sendIconClicked : sendIconClicked,
	  selectedRoleForUsersChanged : selectedRoleForUsersChanged,
	  studentsPerGroupChanged : studentsPerGroupChanged,
	  calculateTeamsDistributionAtMost : calculateTeamsDistributionAtMost,
	  calculateTeamsDistribution : calculateTeamsDistribution,
	  sendSelectedClicked : sendSelectedClicked,
	  sendAllClicked : sendAllClicked,
	  initialise : function($params) {

		  $('#composite__selected_role_for_users').change(selectedRoleForUsersChanged);
		  $('#composite__students_per_group').change(studentsPerGroupChanged);
		  $('#composite__send_selected').click(sendSelectedClicked);
		  $('#composite__send_all').click(sendAllClicked);
		  $('.fill-in-row').hide();
		  $('.page-1').show();
		  $('.page-item').click(pageItemClicked);
		  $('.send-icon').click(sendIconClicked);
		  studentsPerGroupChanged();
	  }
	};

});
