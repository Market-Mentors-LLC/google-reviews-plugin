<?php

namespace MarketMentors\GoogleReviewsPlugin\src;

/**
 * Fired during plugin deactivation
 *
 * @link       https://marketmentors.com
 * @since      0.0.1
 *
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      0.0.1
 * @author     Market Mentors, LLC. <accounts@marketmentors.com>
 */
class Deactivator
{

  /**
   * Short Description. (use period)
   *
   * Long Description.
   *
   * @since    0.0.1
   */
  public static function deactivate()
  {
    flush_rewrite_rules();
  }
}
