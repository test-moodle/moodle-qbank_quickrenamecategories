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
 * Tool for quick renaming of many question categories.
 *
 * @package    local_quickrenamequestioncategories
 * @copyright  2016 Vadim Dvorovenko <Vadimon@mail.ru>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("../../config.php");
require_once("$CFG->dirroot/question/editlib.php");

require_login();

list($thispageurl, $contexts, $cmid, $cm, $module, $pagevars) = question_edit_setup('categories',
        '/local/quickrenamequestioncategories/category.php');

$savebutton = optional_param('save', '', PARAM_RAW);
$cancelbutton = optional_param('cancel', '', PARAM_RAW);

$url = new moodle_url($thispageurl);
$url->remove_params(array('cpage'));
$PAGE->set_url($url);
$PAGE->set_title(get_string('quickrenamecategories', 'local_quickrenamequestioncategories'));
$PAGE->set_heading($COURSE->fullname);

if ($cancelbutton) {
    redirect($thispageurl);
} else if ($savebutton) {
    require_sesskey();
    $categorynames = $_POST['categoryname'];
    $categorynames = clean_param_array($categorynames, PARAM_RAW, true);
    $qcobject = new local_quickrenamequestioncategories_question_category_renamer();
    $qcobject->rename_categories($categorynames);
}
echo $OUTPUT->header();

if ($CFG->version >= 2016120503.00) { // Moodle 3.2.3.
    // Print horizontal nav if needed.
    $renderer = $PAGE->get_renderer('core_question', 'bank');
    echo $renderer->extra_horizontal_navigation();
}

$qcobject = new local_quickrenamequestioncategories_question_category_object($pagevars['cpage'], $thispageurl,
        $contexts->having_cap('moodle/question:managecategory'), 0, $pagevars['cat'], 0, array());
$qcobject->output_edit_lists();
echo $OUTPUT->footer();
