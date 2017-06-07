<?php

namespace Drupal\unical_client\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * The calendar controller.
 */
class UnicalClientController extends ControllerBase {

 public function content() {

   // Get rout info for base tag
   $route = \Drupal::routeMatch()->getRouteObject();
   $is_admin = \Drupal::service('router.admin_context')->isAdminRoute($route);
   $is_front = \Drupal::service('path.matcher')->isFrontPage($route);
   $current_uri = \Drupal::request()->getRequestUri();

   if (!$is_admin) {

    if($is_front) {
      $baseUrl = '/';
    } else {
      $baseUrl = $current_uri . '/';
      //Replacement patterns
      $patterns = array();
      $patterns[0] = '/event\/([0-9]+)\/([a-z0-9-]+)*\/?/';
      $patterns[1] = '/submit-event\/?/';
      //Regular expression to remove any event URL params
      $baseUrl = preg_replace($patterns, '', $baseUrl);
    }

   }

   // Get module config info
   $unical_client_fields = \Drupal::config('unical_client.settings');

   // Return template variables
   return [
      '#theme' => 'calendar',
      '#site_id'   => $unical_client_fields->get('unical_client.site_id'),
      '#site_url'   => $unical_client_fields->get('unical_client.site_url'),
      '#addevent_id'   => $unical_client_fields->get('unical_client.addevent_id'),
      '#base' => $baseUrl
   ];

 }
}
