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
 * Javascript components used to manage the personality quesions answers.
 * 
 * @package block_task_oriented_groups
 * @copyright 2018 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define([ 'jquery', 'core/ajax' ], function($, ajax) {
	return {
		initialise : function($params) {
			$('input:radio').click(function(event) {
				event.stopPropagation();
				var promises = ajax.call([ {
				  methodname : 'block_task_oriented_groups_store_answer',
				  args : {}
				} ]);
				promises[0].done(function(response) {
					console.log('success' + response);
				}).fail(function(ex) {
					console.log('fail' + ex);
				});
			});
		}
	};
});
