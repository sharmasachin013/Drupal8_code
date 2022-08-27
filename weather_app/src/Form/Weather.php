<?php

namespace Drupal\weather_app\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 *  Class Weather
 */

class Weather extends ConfigFormBase
{
    /**
     *  {@inheritDoc}
     */
    protected function getEditableConfigNames()
    {
        return [
            'weather_app.weather_app',
        ];
    }
    /**
     * {@inheritDoc}
     */
    public function getFormID()
    {
        return 'weather_app';
    }
    /**
     * {@inheritDoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('weather_app.weather_app');
        $form['key'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Key'),
            '#maxlength' => 64,
            '#size' => 64,
            '#default_value' => $config->get('key'),
        ];
        return parent::buildForm($form, $form_state);
    }

    /**
     *  {@inheritDoc}
     */

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        parent::submitForm($form, $form_state);

        $this->config('weather_app.weather_app')
            ->set('key', $form_state->getValue('key'))
            ->save();
    }
}
