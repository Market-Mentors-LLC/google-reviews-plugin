<?php

namespace MarketMentors\GoogleReviewsPlugin\src;

use \YahnisElsts\PluginUpdateChecker\v5\PucFactory;
use MarketMentors\GoogleReviewsPlugin\src\admin\AdminController;
use MarketMentors\GoogleReviewsPlugin\src\public\PublicController;
use MarketMentors\GoogleReviewsPlugin\src\integration\shortcode\LatestReviewsCard;

/**
 * @since      0.0.1
 * @author     Market Mentors, LLC. <accounts@marketmentors.com>
 */
class GoogleReviewsPlugin
{

  protected $loader;

  protected $plugin_name;

  protected $version;

  private $updater;

  public function __construct(
    UpdaterConfig $updaterConfig,
  ) {
    // Set up the updater.
    $this->updater = PucFactory::buildUpdateChecker(
      $updaterConfig->metadataUrl,
      $updaterConfig->fullPath,
      $updaterConfig->slug
    );
    $this->updater->setBranch($updaterConfig->branch);
    if (!empty($updaterConfig->authToken)) {
      $this->updater->setAuthentication($updaterConfig->authToken);
    }

    if (defined('GOOGLE_REVIEWS_PLUGIN_VERSION')) {
      $this->version = GOOGLE_REVIEWS_PLUGIN_VERSION;
    } else {
      $this->version = '0.0.1';
    }
    $this->plugin_name = 'google-reviews-plugin';

    $this->loader = new Loader();
    $this->define_admin_hooks();
    $this->define_public_hooks();
  }

  private function define_admin_hooks()
  {

    $plugin_admin = new AdminController($this->get_plugin_name(), $this->get_version());

    $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
    $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
  }


  private function define_public_hooks()
  {

    $plugin_public = new PublicController($this->get_plugin_name(), $this->get_version());

    $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
    $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
  }

  public function run()
  {
    $this->loader->run();

    new LatestReviewsCard();
  }

  public function get_plugin_name()
  {
    return $this->plugin_name;
  }

  public function get_loader()
  {
    return $this->loader;
  }

  public function get_version()
  {
    return $this->version;
  }
}
