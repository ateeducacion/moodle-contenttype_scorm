# SCORM Content Type Plugin for Moodle Content Bank

This is a Moodle plugin that adds support for SCORM packages in the Content Bank. It allows teachers and content creators to upload `.zip` files containing SCORM packages, manage them within the Content Bank, and potentially reuse them in courses.

## Features

- Upload SCORM packages to the Content Bank (`.zip` files with `imsmanifest.xml`).
- Store metadata and manage files by context.
- Reuse SCORM content across different courses.
- Easy integration into Moodle's native contentbank UI.

## Accepted file types

The plugin allows uploading SCORM packages in `.zip` format. Other file types, such as `.h5p`, are not supported.

## Installation

1. Clone this repository into the `contentbank/contenttype/` directory of your Moodle installation:

   ```bash
   git clone https://github.com/YOUR_USERNAME/moodle-contenttype_scorm.git contentbank/contenttype/scorm
   ```

2. Visit your Moodle site as an admin to complete the plugin installation.

3. Ensure that required capabilities are granted to roles such as `editingteacher` or `manager`.

## Directory structure

```
moodle/contentbank/contenttype/scorm/
├── classes/
│   ├── contenttype.php
│   └── content.php
├── db/
│   └── access.php
├── lang/
│   └── en/
│       └── contenttype_scorm.php
├── lib.php
└── version.php
```

## Capabilities

The plugin defines its own capabilities:

* `contenttype/scorm:addinstance` — controls who can upload SCORM packages to the Content Bank.
* `contenttype/scorm:access` — grants access to the SCORM content type in the Content Bank.

## Requirements

* Moodle 4.0 or later
* PHP 7.4 or later

## License

GNU GPL v3 or later


## Development with Docker

This repository includes a `docker-compose.yml` and `Makefile` to help run Moodle
with this plugin in a containerized environment. Copy `.env.dist` to `.env` and
adjust the values if needed. Then use `make up` to start the containers or
`make shell` to open a shell inside the Moodle container. The setup uses
MariaDB 10.11, which meets Moodle 5.0 database requirements. The plugin folder
from the host is mounted inside the Moodle container for easier debugging.

## Packaging the plugin

To create a release ZIP archive, use:

```bash
make package VERSION=1.0
```

The `.gitattributes` file ensures development files are excluded from the archive. This archive is also generated automatically when publishing a GitHub release via the included workflow.
