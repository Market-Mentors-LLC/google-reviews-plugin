<?php

namespace MarketMentors\GoogleReviewsPlugin\src;

use \YahnisElsts\PluginUpdateChecker\v5\PucFactory;
use \YahnisElsts\PluginUpdateChecker\v5\PluginUpdateChecker;
use MarketMentors\GoogleReviewsPlugin\src\admin\AdminController;
use MarketMentors\GoogleReviewsPlugin\src\public\PublicController;
use MarketMentors\GoogleReviewsPlugin\src\integration\shortcode\LatestReviewsCard;

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://marketmentors.com
 * @since      0.0.1
 *
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      0.0.1
 * @author     Market Mentors, LLC. <accounts@marketmentors.com>
 */
class GoogleReviewsPlugin
{

  /**
   * The loader that's responsible for maintaining and registering all hooks that power
   * the plugin.
   *
   * @since    0.0.1
   * @access   protected
   * @var      Loader    $loader    Maintains and registers all hooks for the plugin.
   */
  protected $loader;

  /**
   * The unique identifier of this plugin.
   *
   * @since    0.0.1
   * @access   protected
   * @var      string    $plugin_name    The string used to uniquely identify this plugin.
   */
  protected $plugin_name;

  /**
   * The current version of the plugin.
   *
   * @since    0.0.1
   * @access   protected
   * @var      string    $version    The current version of the plugin.
   */
  protected $version;

  /**
   * The updater.
   * 
   * @since 0.0.1
   * 
   * @var PluginUpdateChecker
   */
  private $updater;

  /**
   * Define the core functionality of the plugin.
   *
   * Set the plugin name and the plugin version that can be used throughout the plugin.
   * Load the dependencies, define the locale, and set the hooks for the admin area and
   * the public-facing side of the site.
   *
   * @since    0.0.1
   */
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

  /**
   * Register all of the hooks related to the admin area functionality
   * of the plugin.
   *
   * @since    0.0.1
   * @access   private
   */
  private function define_admin_hooks()
  {

    $plugin_admin = new AdminController($this->get_plugin_name(), $this->get_version());

    $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
    $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
  }

  /**
   * Register all of the hooks related to the public-facing functionality
   * of the plugin.
   *
   * @since    0.0.1
   * @access   private
   */
  private function define_public_hooks()
  {

    $plugin_public = new PublicController($this->get_plugin_name(), $this->get_version());

    $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
    $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
  }

  /**
   * Run the loader to execute all of the hooks with WordPress.
   *
   * @since    0.0.1
   */
  public function run()
  {
    $this->loader->run();

    new LatestReviewsCard();
  }

  /**
   * The name of the plugin used to uniquely identify it within the context of
   * WordPress and to define internationalization functionality.
   *
   * @since     0.0.1
   * @return    string    The name of the plugin.
   */
  public function get_plugin_name()
  {
    return $this->plugin_name;
  }

  /**
   * The reference to the class that orchestrates the hooks with the plugin.
   *
   * @since     0.0.1
   * @return    Loader    Orchestrates the hooks of the plugin.
   */
  public function get_loader()
  {
    return $this->loader;
  }

  /**
   * Retrieve the version number of the plugin.
   *
   * @since     0.0.1
   * @return    string    The version number of the plugin.
   */
  public function get_version()
  {
    return $this->version;
  }
}
