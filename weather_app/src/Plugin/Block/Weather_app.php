<?php

namespace Drupal\weather_app\Plugin\Block;


use Drupal\Core\Block\BlockBase;


/**
 * Provides a 'Weather_app' block.
 *
 * @Block(
 *  id = "weather_app",
 *  admin_label = @Translation("Weather_app"),
 * )
 */
class Weather_app extends BlockBase
{

    /**
     * The contact settings config object.
     *
     * @var \Drupal\Core\Config\ConfigFactoryInterface
     */
    protected $configFactory;

    /**
     * Constructs a ContactPageAccess instance.
     *
     * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
     *   The config factory.
     * @param \Drupal\user\UserDataInterface $user_data
     *   The user data service.
     */


    /**
     * {@inheritdoc}
     */
    public function build()
    {
        $module_path = \Drupal::service('module_handler');
        $module_path = $module_path->getModule('weather_app')->getPath();
        $path = 'https://' . \Drupal::request()->getHost() . '/' . $module_path;
        $config = \Drupal::config('weather_app.weather_app')->get('key');
        $build = [];
        $build['#theme'] = 'weather_app_theme';
        $build['#path'] = $path;
        $build['#attached']['drupalSettings']['weatherKey'] = $config;
        $build['#attached']['library'] = array('weather_app/weather_style');
        return $build;
    }
}
