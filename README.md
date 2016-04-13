INTRODUCTION
------------

This module is solely for displaying calendar Sites created in UniCal. You may
install this module on any Drupal site you wish, and reference a SITE from the
MASTER install.

REQUIREMENTS
------------

This module requires the following modules:

* UniCal (https://www.drupal.org/sandbox/rogerseyebyte/2648414)

This install can, however, be on a separate installation, but you will need to have
access to the site ID's/etc from there, or have them provided by an administrator.

INSTALLATION
------------

* Install as you would normally install a contributed Drupal module. See:
  https://drupal.org/documentation/install/modules-themes/modules-7
  for further information.
* Modify .htaccess file, as shown in configuration.

CONFIGURATION
-------------

* Configure user permissions in
  Administration » Configuration » Web services » UniCal Client settings:
  - Site ID: this is the NID of the particular site created on the MASTER
    install, viewable to admins on the node page of that site.
  - Site URL: This is the URL of the MASTER install, so we know where to point
    the REST endpoint. Also available on the node page of the Site.

### .htaccess modifications: ###

Some modifications are neccesary to both re-route social bots the actual node
page (php) of the main site, in order to scrape, and to allow use of non # urls.
The following rules assume that your events are in the format /event/NID/TITLE,
and be sure to modify YOUR_MAIN_INSTALL_URL with actual url of your main site, so
that facebook bots/are redirected to the stock drupal node of the event.

  # Allow social media crawlers to work by redirecting them to a server-rendered static version on the page
  RewriteCond %{HTTP_USER_AGENT} (facebookexternalhit/[0-9]|Twitterbot|Pinterest|Google.*snippet)
  RewriteRule event/(.*)/(.*) YOUR_MAIN_INSTALL_URL/node/$1 [P]

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

Be sure that the <base href="/"> is showing in the <head>.
