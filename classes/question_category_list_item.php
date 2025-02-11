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
 * @package    qbank_quickrenamecategories
 * @copyright  2016 Vadim Dvorovenko <Vadimon@mail.ru>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace qbank_quickrenamecategories;

use html_writer;
use qbank_managecategories\question_category_list_item as base_question_category_list_item;

/**
 * Class representing custom category list item
 *
 * @package    qbank_quickrenamecategories
 * @copyright  2016 Vadim Dvorovenko <Vadimon@mail.ru>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class question_category_list_item extends base_question_category_list_item {

    /**
     * Creating list without icons.
     *
     * @param bool $first
     * @param bool $last
     * @param \stdClass $lastitem
     */
    public function set_icon_html($first, $last, $lastitem): void {
    }

    /**
     * Output the html just for this item. Called by to_html which adds html for children.
     *
     * @param array $extraargs
     * @return string
     */
    public function item_html($extraargs = []): string {
        $category = $this->item;

        $attributes = [];
        $attributes['type'] = 'text';
        $attributes['value'] = $category->name;
        $attributes['name'] = "categoryname[{$category->contextid}][{$category->id}]";
        $attributes['size'] = 80;
        $attributes['maxsize'] = 254;
        $item = html_writer::empty_tag('input', $attributes);

        return $item;
    }
}
