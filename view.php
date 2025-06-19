<?php
require(__DIR__ . '/../../config.php');

$id = required_param('id', PARAM_INT);
$content = \core_contentbank\content::get($id);
if (!$content) {
    throw new moodle_exception('invalidrecord');
}
$context = $content->get_context();
require_login();
require_capability('contentbank:access', $context);

$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/contentbank/scorm/view.php', ['id' => $id]));
$PAGE->set_title($content->get_name());
$PAGE->set_heading($PAGE->title);

echo $OUTPUT->header();
if ($file = $content->get_file()) {
    $url = moodle_url::make_pluginfile_url(
        $file->get_contextid(), $file->get_component(), $file->get_filearea(),
        $file->get_itemid(), $file->get_filepath(), $file->get_filename()
    );
    echo html_writer::link($url, get_string('download')); 
} else {
    echo get_string('filenotfound');
}

echo $OUTPUT->footer();

