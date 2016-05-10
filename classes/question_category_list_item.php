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

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->dirroot/question/category_class.php");

/**
 * Class representing custom category list item
 *
 * @package    local_quickrenamequestioncategories
 * @copyright  2016 Vadim Dvorovenko <Vadimon@mail.ru>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class local_quickrenamequestioncategories_question_category_list_item extends question_category_list_item {

    /**
     * Creating list without icons.
     *
     * @param bool $first
     * @param bool $last
     * @param stdClass $lastitem
     */
    public function set_icon_html($first, $last, $lastitem) {
    }

    /**
     * Output the html just for this item. Called by to_html which adds html for children.
     *
     * @param array $extraargs
     * @return string
     */
    public function item_html($extraargs = array()) {
        $category = $this->item;

        $attributes = array();
        $attributes['type'] = 'text';
        $attributes['value'] = $category->name;
        $attributes['name'] = "categoryname[{$category->contextid}][{$category->id}]";
        $attributes['size'] = 80;
        $attributes['maxsize'] = 254;
        $item = html_writer::empty_tag('input', $attributes);

        return $item;
    }
}
