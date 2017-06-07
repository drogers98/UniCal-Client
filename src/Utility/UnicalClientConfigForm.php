<?php

/**

 * @file

 * Contains \Drupal\unical_client\Utility\UnicalClientConfigForm.

 */

namespace Drupal\unical_client\Utility;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class UnicalClientConfigForm extends ConfigFormBase {

  /**

   * {@inheritdoc}

   */

  public function getFormId() {

    return 'unical_client_config_form';

  }

  /**

   * {@inheritdoc}

   */

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);

    $config = $this->config('unical_client.settings');

    $form['help_text'] = array(
      '#markup' => '
      <p>This page allows you to define the settings that will control your rendering of the <a href="http://unical.idfive.com">UniCal</a> custom Calendar. Your site administrator should provide you with the site URL of the mothership site, and your particular Site ID, which will do the work of pulling your custom configurations.</p>
      <ul>
        <li>Your calendar will now be viewable at <a href="/calendar">/calendar</a>.</li>
        <li><a href="/admin/config/search/path/add">Add a local path alias</a> to change the default <a href="/calendar">/calendar</a> link, if you choose.</li>
        <li>Cache clear will most likely be required in order to see changes made here.</li>
      </ul>
      <p>Contact your site administrator (who gave you the Site ID) If further customizations are required.</p>
      ',
    );

    // General settings.
    $form['unical_client_settings'] = array(
      '#type' => 'details',
      '#title' => 'Settings',
      '#open' => TRUE
    );

    // URL of the API.
    $form['unical_client_settings']['site_url'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Site URL'),
      '#default_value' => $config->get('unical_client.site_url'),
      '#required' => TRUE,
      '#description' => 'URL of main UniCal calendar website (MASTER). Include trailing slash. ie: http://myunicalmastersite.com/',
    );

    // Site ID.
    $form['unical_client_settings']['site_id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Site ID'),
      '#default_value' => $config->get('unical_client.site_id'),
      '#required' => TRUE,
      '#description' => 'ID of the site node on MASTER.',
    );

    // Style settings.
    $form['unical_client_style_settings'] = array(
      '#type' => 'details',
      '#title' => 'Styles',
      '#open' => TRUE
    );

    // Add checkbox for using stock UniCal styles
    $form['unical_client_style_settings']['use_stock_css'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Use Stock CSS'),
      '#default_value' => $config->get('unical_client.use_stock_css'),
      '#description' => 'Use the stock UniCal calendar style. Leave this checked unless you know what you are doing.',
    );

    // Add checkbox for using custom UniCal styles
    $form['unical_client_style_settings']['use_custom_css'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Use Custom CSS'),
      '#default_value' => $config->get('unical_client.use_custom_css'),
      '#description' => 'Use a custom UniCal calendar style, served from MASTER via: {{SITE URL}}/{{UNICAL MODULES PATH}}/unical_styles/style.css',
    );

    // Advanced settings.
    $form['unical_client_advanced_settings'] = array(
      '#type' => 'details',
      '#title' => 'Advanced',
      '#open' => FALSE
    );

    // Modules path
    $form['unical_client_advanced_settings']['unical_modules_path'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('UniCal Modules Path'),
      '#default_value' => $config->get('unical_client.unical_modules_path'),
      '#required' => FALSE,
      '#description' => 'The path to the unical modules on the MASTER install.',
    );

    // addevent.com ID
    $form['unical_client_advanced_settings']['addevent_id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('addevent.com ID'),
      '#default_value' => $config->get('unical_client.addevent_id'),
      '#required' => FALSE,
      '#description' => 'ID for paid addevent.com plans',
    );

    return $form;

  }

  /**

   * {@inheritdoc}

   */

  public function submitForm(array &$form, FormStateInterface $form_state) {

    $config = $this->config('unical_client.settings');

    $config->set('unical_client.site_url', $form_state->getValue('site_url'));
    $config->set('unical_client.site_id', $form_state->getValue('site_id'));
    $config->set('unical_client.use_stock_css', $form_state->getValue('use_stock_css'));
    $config->set('unical_client.use_custom_css', $form_state->getValue('use_custom_css'));
    $config->set('unical_client.unical_modules_path', $form_state->getValue('unical_modules_path'));
    $config->set('unical_client.addevent_id', $form_state->getValue('addevent_id'));

    $config->save();

    return parent::submitForm($form, $form_state);

  }

  /**

   * {@inheritdoc}

   */

  protected function getEditableConfigNames() {

    return [

      'unical_client.settings',

    ];

  }

}
