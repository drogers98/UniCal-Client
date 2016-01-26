INTRODUCTION
------------

This module is solely for displaying calendar Sites created in UniCal. You may
install this module on any Drupal site you wish, and reference a SITE from the
MASTER install.

REQUIREMENTS
------------

This module requires the following modules:

* UniCal (https://www.drupal.org/sandbox/rogerseyebyte/2648414)

INSTALLATION
------------

* Install as you would normally install a contributed Drupal module. See:
  https://drupal.org/documentation/install/modules-themes/modules-7
  for further information.

CONFIGURATION
-------------

* Configure user permissions in
  Administration » Configuration » Web services » UniCal Client settings:
  - Site ID: this is the NID of the particular site created on the MASTER
    install, viewable to admins on the node page of that site.
  - Site URL: This is the URL of the MASTER install, so we know where to point
    the REST endpoint. Also available on the node page of the Site.


TROUBLESHOOTING
---------------

If you are running into errors, be sure to check that CORS is running on the
MASTER install, and that you can ping your endpoints.
