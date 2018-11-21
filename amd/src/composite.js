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
define([ 'jquery', 'core/ajax', 'core/str', 'core/notification' ], function($, ajax, str, notification) {
	return {
		initialise : function($params) {

			$('#selectedRoleForUsers').change(function() {

				selectedRoleForUsersChanged();

			});

			$('#studentsPerGroup').change(function() {

				studentsPerGroupChanged();

			});

			$('.fill-in-row').hide();
			$('.page-1').show();
			$('.page-item').click(function(event) {
				event.stopPropagation();

				$('.fill-in-row').hide();
				$('.page-' + $(this).text().trim()).show();

			});
		}
	};

	/**
	 * Called when teh number of students per group has been changed.
	 */
	function studentsPerGroupChanged() {

		var studentsPerGroup = $('#studentsPerGroup').value;
		var students = $('#numberOfStudents').value;
		var teams = calculateTeamsDistribution(students, studentsPerGroup);

	}

	/**
	 * Called when teh number of students per group has been changed.
	 */
	function selectedRoleForUsersChanged() {

		var roleid = $('#selectedRoleForUsers').val();
		var url = window.location.href;
		var start = url.indexOf('?courseid=');
		var end = url.indexOf('&', start);
		if (end > 0) {

			url = url.substring(0, end);
		}

		window.location.href = url + '&roleid=' + roleid;
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
});
