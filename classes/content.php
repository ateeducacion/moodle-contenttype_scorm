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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Content class for SCORM packages.
 *
 * @package    contenttype_scorm
 * @copyright  2025 Área de Tecnología Educativa <ate.educacion@gobiernodecanarias.org>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace contenttype_scorm;

use core_contentbank\content as base_content;
use moodle_url;

defined('MOODLE_INTERNAL') || die();

/**
 * SCORM content item stored in the content bank.
 */
class content extends base_content {
    /**
     * Returns the URL to view the SCORM package.
     *
     * @return moodle_url
     */
    public function get_view_url(): moodle_url {
        return new moodle_url('/contentbank/scorm/view.php', ['id' => $this->get_id()]);
    }
}

