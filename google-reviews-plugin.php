<?php

/**
 * Google Reviews Plugin
 *
 * @package MarketMentors\GoogleReviewsPlugin
 * @author  Market Mentors, LLC
 *
 * @wordpress-plugin
 * Plugin Name:       Google Reviews Plugin
 * Plugin URI:        https://marketmentors.com
 * Description:       Uses the Google Places API to display the latest reviews.
 * Version:           0.0.2
 * Author:            Market Mentors, LLC
 * Author URI:        https://marketmentors.com
 * Text Domain:       google-reviews-plugin
 * Domain Path:       /languages
 * Requires PHP:      8.2
 * Requires at least: 6.0
 * Network:           false
 */

declare(strict_types=1);
/*⣿⣿⣿⣿⣿⣿⡿⠿⠛⠛⠛⠋⠉⠈⠉⠉⠉⠉⠛⠻⢿⣿⣿⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⡿⠋⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠛⢿⣿⣿⣿⣿
⣿⣿⣿⣿⡏⣀⠀⠀⠀⠀⠀⠀⠀⣀⣤⣤⣤⣄⡀⠀⠀⠀⠀⠀⠀⠀⠙⢿⣿⣿
⣿⣿⣿⢏⣴⣿⣷⠀⠀⠀⠀⠀⢾⣿⣿⣿⣿⣿⣿⡆⠀⠀⠀⠀⠀⠀⠀⠈⣿⣿
⣿⣿⣟⣾⣿⡟⠁⠀⠀⠀⠀⠀⢀⣾⣿⣿⣿⣿⣿⣷⢢⠀⠀⠀⠀⠀⠀⠀⢸⣿
⣿⣿⣿⣿⣟⠀⡴⠄⠀⠀⠀⠀⠀⠀⠙⠻⣿⣿⣿⣿⣷⣄⠀⠀⠀⠀⠀⠀⠀⣿
⣿⣿⣿⠟⠻⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠶⢴⣿⣿⣿⣿⣿⣧⠀⠀⠀⠀⠀⠀⣿
⣿⣁⡀⠀⠀⢰⢠⣦⠀⠀⠀⠀⠀⠀⠀⠀⢀⣼⣿⣿⣿⣿⣿⡄⠀⣴⣶⣿⡄⣿
⣿⡋⠀⠀⠀⠎⢸⣿⡆⠀⠀⠀⠀⠀⠀⣴⣿⣿⣿⣿⣿⣿⣿⠗⢘⣿⣟⠛⠿⣼
⣿⣿⠋⢀⡌⢰⣿⡿⢿⡀⠀⠀⠀⠀⠀⠙⠿⣿⣿⣿⣿⣿⡇⠀⢸⣿⣿⣧⢀⣼
⣿⣿⣷⢻⠄⠘⠛⠋⠛⠃⠀⠀⠀⠀⠀⢿⣧⠈⠉⠙⠛⠋⠀⠀⠀⣿⣿⣿⣿⣿
⣿⣿⣧⠀⠈⢸⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠟⠀⠀⠀⠀⢀⢃⠀⠀⢸⣿⣿⣿⣿
⣿⣿⡿⠀⠴⢗⣠⣤⣴⡶⠶⠖⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣀⡸⠀⣿⣿⣿⣿
⣿⣿⣿⡀⢠⣾⣿⠏⠀⠠⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠛⠉⠀⣿⣿⣿⣿
⣿⣿⣿⣧⠈⢹⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣰⣿⣿⣿⣿
⣿⣿⣿⣿⡄⠈⠃⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣠⣴⣾⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣧⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣠⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣷⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣴⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣦⣄⣀⣀⣀⣀⠀⠀⠀⠀⠘⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⡄⠀⠀⠀⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣧⠀⠀⠀⠙⣿⣿⡟⢻⣿⣿⣿⣿⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠇⠀⠁⠀⠀⠹⣿⠃⠀⣿⣿⣿⣿⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⡿⠛⣿⣿⠀⠀⠀⠀⠀⠀⠀⠀⢐⣿⣿⣿⣿⣿⣿⣿⣿⣿
⣿⣿⣿⣿⠿⠛⠉⠉⠁⠀⢻⣿⡇⠀⠀⠀⠀⠀⠀⢀⠈⣿⣿⡿⠉⠛⠛⠛⠉⠉
⣿⡿⠋⠁⠀⠀⢀⣀⣠⡴⣸⣿⣇⡄⠀⠀⠀⠀⢀⡿⠄⠙⠛⠀⣀⣠⣤⣤⠄*/

namespace MarketMentors\GoogleReviewsPlugin;

use MarketMentors\GoogleReviewsPlugin\src\GoogleReviewsPlugin;
use MarketMentors\GoogleReviewsPlugin\src\UpdaterConfig;
use MarketMentors\GoogleReviewsPlugin\src\Activator;
use MarketMentors\GoogleReviewsPlugin\src\Deactivator;

// Prevent direct access
if (! defined('ABSPATH')) {
  exit;
}

// Define plugin constants
define('GOOGLE_REVIEWS_PLUGIN_VERSION', '0.0.2');
define('GOOGLE_REVIEWS_PLUGIN_FILE', __FILE__);
define('GOOGLE_REVIEWS_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('GOOGLE_REVIEWS_PLUGIN_URL', plugin_dir_url(__FILE__));
define('GOOGLE_REVIEWS_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('MIN_PHP_VERSION', '8.2');
define('MIN_WP_VERSION', '6.8.0');

/**
 * Ensure dependencies are loaded
 */
if (!file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
  throw new \Error(
    'Autoloader not found. You must run <code>composer install</code> from the plugin directory.',
  );
}
require_once $composer;

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare(MIN_PHP_VERSION, phpversion(), '>=')) {
  throw new \Error(
    "Invalid PHP version: You must be using PHP " . MIN_PHP_VERSION . " or greater.",
  );
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare(MIN_WP_VERSION, \get_bloginfo('version'), '>=')) {
  throw new \Error(
    "Invalid WordPress version: You must be using WordPress " . MIN_WP_VERSION . " or greater.",
  );
}

/**
 * The code that runs during plugin activation.
 */
\register_activation_hook(__FILE__, [Activator::class, 'activate']);

/**
 * The code that runs during plugin deactivation.
 */
\register_deactivation_hook(__FILE__, [Deactivator::class, 'deactivate']);



/**
 * Main plugin class
 */
class Main
{

  /**
   * Plugin instance
   *
   * @var Main
   */
  private static $instance = null;

  /**
   * Get plugin instance
   *
   * @return Main
   */
  public static function instance()
  {
    if (null === self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  /**
   * Begins execution of the plugin.
   *
   * Since everything within the plugin is registered via hooks,
   * then kicking off the plugin from this point in the file does
   * not affect the page life cycle.
   *
   * @since    0.0.1
   */
  private function __construct()
  {
    /**
     * The core plugin class that is used to define internationalization,
     * admin-specific hooks, and public-facing site hooks.
     */
    $plugin = new GoogleReviewsPlugin(
      new UpdaterConfig(
        metadataUrl: 'https://github.com/Market-Mentors-LLC/google-reviews-plugin',
        fullPath: __FILE__,
        slug: 'google-reviews-plugin',
        branch: 'master',
        authToken: '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',
      )
    );

    $plugin->run();
  }
}

// Initialize the plugin
Main::instance();
