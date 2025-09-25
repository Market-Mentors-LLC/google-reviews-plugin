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
 * Version:           0.0.1
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
define('GOOGLE_REVIEWS_PLUGIN_VERSION', '0.0.1');
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
    'Autoloader not found. You must run <code>composer install</code> from the theme directory.',
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
        authToken: '',
      )
    );

    $plugin->run();

    $this->load_dependencies();
  }

  /**
   * Load plugin dependencies
   */
  private function load_dependencies()
  {
    // Include ACF Pro
    $this->load_acf_pro();
  }

  /**
   * Load ACF Pro
   */
  private function load_acf_pro()
  {
    // Only load ACF Pro if it's not already loaded
    if (! class_exists('ACF')) {
      $acf_pro_path = GOOGLE_REVIEWS_PLUGIN_PATH . 'wp-content/plugins/advanced-custom-fields-pro/acf.php';

      if (file_exists($acf_pro_path)) {
        // Define ACF as included via plugin to prevent conflicts
        if (! defined('ACF_PLUGIN_INCLUDED')) {
          define('ACF_PLUGIN_INCLUDED', true);
        }

        // Include ACF Pro
        include_once $acf_pro_path;

        // Hide ACF from admin menu since it's bundled
        //add_filter('acf/settings/show_admin', '__return_false');

        // Disable ACF Pro updates since it's bundled
        add_filter('acf/settings/show_updates', '__return_false');

        // Set JSON save/load paths to your plugin
        add_filter('acf/settings/save_json', [$this, 'acf_json_save_point']);
        add_filter('acf/settings/load_json', [$this, 'acf_json_load_point']);
      }
    }
  }

  /**
   * Set ACF JSON save point
   *
   * @param string $path
   * @return string
   */
  public function acf_json_save_point($path)
  {
    return GOOGLE_REVIEWS_PLUGIN_PATH . 'acf-json';
  }

  /**
   * Set ACF JSON load point
   *
   * @param array $paths
   * @return array
   */
  public function acf_json_load_point($paths)
  {
    $paths[] = GOOGLE_REVIEWS_PLUGIN_PATH . 'acf-json';
    return $paths;
  }


  /**
   * Initialize plugin functionality
   */
  private function init_plugin()
  {
    // Add your plugin initialization code here
    // For example:
    // - Register custom post types
    // - Register custom fields
    // - Add admin pages
    // - Register shortcodes
    // - Enqueue scripts and styles

    // Example: Add ACF fields programmatically if needed
    add_action('acf/include_fields', [$this, 'register_acf_fields']);
  }

  /**
   * Register ACF fields
   */
  public function register_acf_fields()
  {
    // Add your ACF field groups here programmatically if needed
    // Or let them be loaded from the acf-json folder
  }
}

// Initialize the plugin
Main::instance();
