<?php

namespace MarketMentors\GoogleReviewsPlugin\src\public;

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://marketmentors.com
 * @since      0.0.1
 *
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @author     Market Mentors, LLC. <accounts@marketmentors.com>
 */
class PublicController
{

  /**
   * The ID of this plugin.
   *
   * @since    0.0.1
   * @access   private
   * @var      string    $plugin_name    The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The version of this plugin.
   *
   * @since    0.0.1
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
   * @since    0.0.1
   * @param      string    $plugin_name       The name of the plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct($plugin_name, $version)
  {

    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }

  /**
   * Register the stylesheets for the public-facing side of the site.
   *
   * @since    0.0.1
   */
  public function enqueue_styles()
  {

    /**
     * This function is provided for demonstration purposes only.
     *
     * An instance of this class should be passed to the run() function
     * defined in Easy_Locations_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Easy_Locations_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/styles.css', array(), $this->version, 'all');

    wp_enqueue_style('swiper-styles', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), $this->version, 'all');
  }

  /**
   * Register the JavaScript for the public-facing side of the site.
   *
   * @since    0.0.1
   */
  public function enqueue_scripts()
  {

    /**
     * This function is provided for demonstration purposes only.
     *
     * An instance of this class should be passed to the run() function
     * defined in Easy_Locations_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Easy_Locations_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */
    wp_enqueue_script('swiper-scripts', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array('jquery'), $this->version, true);

    wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/scripts.js', array('jquery', 'swiper-scripts'), $this->version, false);
  }
}
