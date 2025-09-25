=== Google Reviews Plugin ===
Contributors: marketmentors
Donate link: https://marketmentors.com
Tags: google reviews, reviews, testimonials, google places, swiper, slider
Requires at least: 6.0
Tested up to: 6.8
Stable tag: 1.0.0
Requires PHP: 8.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Display Google Reviews with a beautiful swiper slider using the Google Places API.

== Description ==

The Google Reviews Plugin allows you to easily display your latest Google Reviews on your WordPress website using a modern, responsive swiper slider. Perfect for showcasing customer testimonials and building trust with potential customers.

## Key Features

* **Google Places API Integration** - Automatically fetches reviews from your Google Business Profile
* **Beautiful Swiper Slider** - Modern, touch-friendly slider with navigation controls
* **Responsive Design** - Works perfectly on desktop, tablet, and mobile devices
* **Customizable Display** - Control the number of reviews, sorting, and appearance
* **Easy Shortcode** - Simple `[latest_reviews_card]` shortcode for easy integration
* **Auto-play Support** - Reviews automatically cycle through with customizable timing
* **Navigation Controls** - Previous/next arrows and dot pagination
* **ACF Pro Integration** - Advanced Custom Fields Pro included for enhanced functionality

## How It Works

1. **Get Your Google Places API Key** - Sign up for a Google Places API key
2. **Configure Your Place ID** - Find your business's Google Place ID
3. **Add the Shortcode** - Use `[latest_reviews_card]` anywhere on your site
4. **Customize as Needed** - Adjust settings like review limit, sorting, and appearance

## Shortcode Options

* `title` - Custom title for the reviews section (default: "Latest Reviews")
* `place_id` - Your Google Place ID
* `limit` - Number of reviews to display (default: 10)
* `sort_by` - How to sort reviews (default: "newest")

Example: `[latest_reviews_card title="Customer Reviews" limit="5" sort_by="newest"]`

## Requirements

* WordPress 6.0 or higher
* PHP 8.2 or higher
* Google Places API key
* Valid Google Business Profile with reviews

== Frequently Asked Questions ==

= Do I need a Google Places API key? =

Yes, you'll need to obtain a Google Places API key from the Google Cloud Console. The plugin uses this to fetch your business reviews.

= How do I find my Google Place ID? =

You can find your Place ID using Google's Place ID Finder tool or by using the Google Places API. The Place ID is a unique identifier for your business location.

= Can I customize the appearance of the reviews? =

Yes! The plugin includes CSS classes that you can customize in your theme's stylesheet. The reviews are displayed in a modern card format with profile pictures, star ratings, and review text.

= Does the plugin work on mobile devices? =

Absolutely! The swiper slider is fully responsive and touch-friendly, providing an excellent experience on all devices.

= Can I control how many reviews are displayed? =

Yes, you can use the `limit` parameter in the shortcode to control how many reviews are shown. The default is 10 reviews.

= Is the plugin compatible with page builders? =

Yes, the shortcode can be used in most page builders including Gutenberg, Elementor, and others.

== Screenshots ==

1. Reviews slider displaying customer testimonials with navigation controls
2. Mobile-responsive design showing touch-friendly swipe navigation
3. Admin settings page for configuring Google Places API integration

== Changelog ==

= 1.0.0 =
* Initial release
* Google Places API integration
* Swiper slider with navigation controls
* Responsive design
* Shortcode support
* ACF Pro integration
* Auto-play functionality
* Dot pagination controls

== Upgrade Notice ==

= 1.0.0 =
Initial release of the Google Reviews Plugin. Perfect for showcasing customer testimonials and building trust with potential customers.
