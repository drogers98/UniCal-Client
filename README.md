INTRODUCTION
------------

This module is solely for displaying calendar Sites created in UniCal. You may
install this module on any Drupal site you wish, and reference a SITE from the
MASTER install.

REQUIREMENTS
------------

This module requires the following modules:

* UniCal (https://github.com/idfive/UniCal)

This install can, however, be on a separate installation, but you will need to have
access to the site ID's/etc from there, or have them provided by an administrator.

INSTALLATION
------------

* Install as you would normally install a contributed Drupal module. See:
  https://www.drupal.org/docs/8/extending-drupal-8/installing-modules
  for further information.
* Modify .htaccess file, as shown in configuration.

CONFIGURATION
-------------

* Configure user permissions in (/admin/config/unical_client/config)
  Administration » Configuration » Web services » UniCal Client settings:
  - Site ID: this is the NID of the particular site created on the MASTER
    install, viewable to admins on the node page of that site.
  - Site URL: This is the URL of the MASTER install, so we know where to point
    the REST endpoint. Also available on the node page of the Site.
  - Use Stock CSS: This boolean controls whether you wish to use the stock unical
    css on the MASTER install (Site ID/sites/all/modules/unical/assets/css/styles.css).
    Best to leave this checked unless there is a specific reason not too.
  - Use Custom CSS: This boolean controls whether you wish to reference a custom
    stylesheet from the unical_styles module on the MASTER install.
  - Module Path: This is set by default to sites/all/modules. If your MASTER install has
    a different path for module installs, modify this here.
  - addevent.com ID: This is a field to enter an addevent.com paid plan key.

### .htaccess modifications: ###

Some modifications are necessary to both re-route social bots the actual node
page (php) of the main site, in order to scrape, and to allow use of non # urls.
The following rules assume that your events are in the format /event/NID/TITLE.

  # Allow social media crawlers to work by redirecting them to a server-rendered static version on the page
  RewriteCond %{HTTP_USER_AGENT} (facebookexternalhit/[0-9]|Twitterbot|Pinterest|Google.*snippet)
  RewriteRule event/(.*)/(.*) http://%{HTTP_HOST}/node/$1 [P]

  **It is possible that you may need to change the proxy [P] to [NE, L] in some
  acquia prod environments**

  # Workaround to be able to use non # url in the calendar
  RewriteCond %{HTTP_USER_AGENT} !(facebookexternalhit/[0-9]|Twitterbot|Pinterest|Google.*snippet)
  RewriteCond %{REQUEST_URI} !^/admin
  RewriteRule event/(.*)/(.*) http://%{HTTP_HOST}/#%1/event/$1/$2 [NE,L]


TROUBLESHOOTING
---------------

If you are running into errors, be sure to check that CORS is running on the
MASTER install, and that you can ping your endpoints.

Be sure that the html5 mode base href="/" is showing in the head.
