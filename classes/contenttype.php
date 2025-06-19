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
 * Content type definition for SCORM packages.
 *
 * @package    contenttype_scorm
 * @copyright  2025 Área de Tecnología Educativa <ate.educacion@gobiernodecanarias.org>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace contenttype_scorm;

use core_contentbank\contenttype as base_contenttype;
use core_contentbank\content;
use moodle_exception;
use stored_file;
use stdClass;

defined('MOODLE_INTERNAL') || die();

/**
 * SCORM content type class.
 */
class contenttype extends base_contenttype {
    /** Plugin content type name. */
    public const TYPE = 'scorm';

    /**
     * Returns the plugin name.
     *
     * @return string
     */
    public static function get_name(): string {
        return get_string('pluginname', 'contenttype_scorm');
    }

    /**
     * Returns features implemented by this content type.
     *
     * @return array
     */
    public static function get_implemented_features(): array {
        return [];
    }

    /**
     * Allowed file extensions that can be managed.
     *
     * @return array
     */
    public static function get_manageable_extensions(): array {
        return ['zip'];
    }

    /**
     * Returns the list of content type identifiers provided by this plugin.
     *
     * @return array
     */
    public static function get_contenttype_types(): array {
        return [self::TYPE];
    }

    /**
     * Uploads a SCORM package into the content bank.
     *
     * @param stdClass $record content record data
     * @param stored_file $file uploaded file
     * @return content
     */
    public function upload_content(stored_file $file, ?stdClass $record = null): content {
        global $USER;

        if ($file->get_mimetype() !== 'application/zip') {
            throw new moodle_exception('invalidfiletype');
        }

        if ($record === null) {
            $record = new stdClass();
        }

        $record->contenttype = self::TYPE;
        $record->contextid = $this->context->id;
        $record->name = $file->get_filename();
        $record->usercreated = $USER->id;
        $record->timecreated = time();

        return $this->add_content($record, $file);
    }
}

