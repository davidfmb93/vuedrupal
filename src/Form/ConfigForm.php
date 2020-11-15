<?php

namespace Drupal\vuedrupal\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Configure example settings for this site.
 */
class ConfigForm extends ConfigFormBase
{
  /** @var string Config settings */
  const SETTINGS = 'app.core';

  /**
   * {@inheritdoc}
   */

  public function getFormId()
  {
    return 'app_config_settings';
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */

  protected function getEditableConfigNames()
  {
    return [
      static::SETTINGS,
    ];
  }

  /**
   * {@inheritdoc}
   */

  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config(static::SETTINGS);


    $form['game_week'] = array(
      '#title' => 'Etapa activada',
      '#type' => 'radios', 
      '#options' => array('1' => 'Etapa 1', '2' => 'Etapa 2', '3' => 'Etapa 3', '4' => 'Etapa 4'),
      '#default_value' => '1',
      '#required' => TRUE,
      '#default_value' => $config->get('game_week'),
    );

    $form['game_status'] = array(
      '#title' => 'status',
      '#type' => 'radios', 
      '#options' => array('0' => 'Desarrollo', '1' => 'Producción'),
      '#default_value' => '0',
      '#required' => TRUE,
      '#default_value' => $config->get('game_status'),
    );

    $form['game_time'] = array(
      '#title' => 'time',
      '#type' => 'textfield', 
      '#default_value' => '0',
      '#required' => TRUE,
      '#default_value' => $config->get('game_time'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */

  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $this->config(static::SETTINGS)
      ->set('game_week', $form_state->getValue('game_week'))
      ->save();

    $this->config(static::SETTINGS)
      ->set('game_status', $form_state->getValue('game_status'))
      ->save();
    
    $this->config(static::SETTINGS)
      ->set('game_time', $form_state->getValue('game_time'))
      ->save();

    $this->messenger()->addMessage('Etapa saved');
  }
}
