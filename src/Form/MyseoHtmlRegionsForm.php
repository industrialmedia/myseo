<?php

namespace Drupal\myseo\Form;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;



class MyseoHtmlRegionsForm extends ConfigFormBase implements ContainerInjectionInterface {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'myseo_html_regions_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['myseo.html_regions'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('myseo.html_regions');
    $form['help'] = array(
      '#markup' => '<p>Глообальные регионы, используются чаще всего для добавления сторонних скриптов.<br />
                    Не забутьте добавить их (<strong>myseo_head</strong>, <strong>myseo_body_top</strong>, <strong>myseo_body_bottom</strong>)
                    в свой шаблон темы <strong>html.html.twig</strong>
                    </p>',
    );
    $form['myseo_head'] = [
      '#type' => 'textarea',
      '#title' => 'myseo_head',
      '#default_value' => !empty($config->get('myseo_head')) ? $config->get('myseo_head') : '',
      '#rows' => 20,
    ];
    $form['myseo_body_top'] = [
      '#type' => 'textarea',
      '#title' => 'myseo_body_top',
      '#default_value' => !empty($config->get('myseo_body_top')) ? $config->get('myseo_body_top') : '',
      '#rows' => 20,
    ];
    $form['myseo_body_bottom'] = [
      '#type' => 'textarea',
      '#title' => 'myseo_body_bottom',
      '#default_value' => !empty($config->get('myseo_body_bottom')) ? $config->get('myseo_body_bottom') : '',
      '#rows' => 20,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('myseo.html_regions')
      ->set('myseo_head', $form_state->getValue('myseo_head'))
      ->set('myseo_body_top', $form_state->getValue('myseo_body_top'))
      ->set('myseo_body_bottom', $form_state->getValue('myseo_body_bottom'))
      ->save();
    parent::submitForm($form, $form_state);
    drupal_flush_all_caches();
  }

}
