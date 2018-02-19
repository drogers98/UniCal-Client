<div data-ng-app="calendar" class="unical-calendar">
  <div ng-view autoscroll="true"></div>
</div>
<script>
  window.site_id = Drupal.settings.unical_client_variables.site_id;
  window.site_url = Drupal.settings.unical_client_variables.site_url + 'api';
  window.addevent_id = Drupal.settings.unical_client_variables.addevent_id;
</script>
