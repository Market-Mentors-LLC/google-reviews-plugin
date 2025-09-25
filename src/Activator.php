<?php

namespace MarketMentors\GoogleReviewsPlugin\src;

/**
 * Fired during plugin activation
 *
 * @link       https://marketmentors.com
 * @since      0.0.1
 *
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      0.0.1
 * @author     Market Mentors, LLC. <accounts@marketmentors.com>
 */
class Activator
{

  /**
   * Short Description. (use period)
   *
   * Long Description.
   *
   * @since    0.0.1
   */
  public static function activate()
  {
    flush_rewrite_rules();
  }
}
