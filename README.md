About UniCal Client
===============================

This module is solely for displaying calendar sites created in UniCal. You may install this module on any drupal site you wish, and reference a SITE from the MASTER install.

Settings
-------------------------------

There are only 2 settings for this module:

- Site ID: this is the NID of the particular site created on the MASTER install, viewable to admins on the node page of that site.
- Site URL: This is the URL of the MASTER install, so we know where to point the REST endpoint. Also available on the node page of the Site.

Troubleshooting
-------------------------------

If you are running into errors, be sure to check that CORS is running on the MASTER install, and that you can ping your endpoints.
