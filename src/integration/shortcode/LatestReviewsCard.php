<?php

namespace MarketMentors\GoogleReviewsPlugin\src\integration\shortcode;

use MarketMentors\GoogleReviewsPlugin\src\GooglePlacesService;

class LatestReviewsCard
{
  private $googlePlacesService;

  public function __construct()
  {
    add_shortcode('latest_reviews_card', array($this, 'render'));

    $this->googlePlacesService = new GooglePlacesService();
  }

  public function getReviews($place_id)
  {
    $reviews = $this->googlePlacesService->getPlaceDetails($place_id, 'reviews');
    return $reviews;
  }

  /**
   * Render the shortcode
   * 
   * @example [latest_reviews_card api_key="***" place_id="***" ]
   * 
   * @param array $atts
   * @return string
   */
  public function render($atts)
  {
    $atts = shortcode_atts(array(
      'title' => 'Latest Reviews',
      'api_key' => '',
      'place_id' => '',
    ), $atts);

    $this->googlePlacesService->setApiKey($atts['api_key']);

    $data = $this->getReviews($atts['place_id']);

    ob_start();
?>
    <div class="latest-reviews-card swiper">
      <div class="reviews swiper-wrapper">
        <?php foreach ($data['reviews'] as $key => $review) : ?>
          <div class="review swiper-slide" data-swiper-slide-index="<?= $key; ?>">
            <div class="profile-pic-first-letter"><?= substr($review['authorAttribution']['displayName'], 0, 1); ?></div>
            <h3 class="review-author"><?= $review['authorAttribution']['displayName']; ?></h3>
            <p class="review-time"><?= $review['relativePublishTimeDescription']; ?></p>
            <p class="review-stars"><?= $this->generateStars($review['rating']); ?></p>
            <p class="review-text"><?= $review['text']['text']; ?></p>
            <div class="google-logo">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256" data-darkreader-inline-fill="" style="--darkreader-inline-fill: var(--darkreader-background-000000, #000000);">
                <path d="M216,128a88,88,0,1,1-88-88A88,88,0,0,1,216,128Z" opacity="0.2"></path>
                <path d="M224,128a96,96,0,1,1-21.95-61.09,8,8,0,1,1-12.33,10.18A80,80,0,1,0,207.6,136H128a8,8,0,0,1,0-16h88A8,8,0,0,1,224,128Z"></path>
              </svg>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
<?php
    return ob_get_clean();
  }

  private function generateStars($rating)
  {
    $stars = '';
    for ($i = 0; $i < $rating; $i++) {
      $stars .= '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#F9E60D" viewBox="0 0 256 256"><path d="M234.29,114.85l-45,38.83L203,211.75a16.4,16.4,0,0,1-24.5,17.82L128,198.49,77.47,229.57A16.4,16.4,0,0,1,53,211.75l13.76-58.07-45-38.83A16.46,16.46,0,0,1,31.08,86l59-4.76,22.76-55.08a16.36,16.36,0,0,1,30.27,0l22.75,55.08,59,4.76a16.46,16.46,0,0,1,9.37,28.86Z"></path></svg>';
    }
    return $stars;
  }
}
