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
            <hr style="width: 50%;">
            <p class="review-text"><?= $review['text']['text']; ?></p>
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
      $stars .= '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256" data-darkreader-inline-fill="" style="--darkreader-inline-fill: var(--darkreader-background-000000, #000000);"><path d="M239.18,97.26A16.38,16.38,0,0,0,224.92,86l-59-4.76L143.14,26.15a16.36,16.36,0,0,0-30.27,0L90.11,81.23,31.08,86a16.46,16.46,0,0,0-9.37,28.86l45,38.83L53,211.75a16.38,16.38,0,0,0,24.5,17.82L128,198.49l50.53,31.08A16.4,16.4,0,0,0,203,211.75l-13.76-58.07,45-38.83A16.43,16.43,0,0,0,239.18,97.26Zm-15.34,5.47-48.7,42a8,8,0,0,0-2.56,7.91l14.88,62.8a.37.37,0,0,1-.17.48c-.18.14-.23.11-.38,0l-54.72-33.65a8,8,0,0,0-8.38,0L69.09,215.94c-.15.09-.19.12-.38,0a.37.37,0,0,1-.17-.48l14.88-62.8a8,8,0,0,0-2.56-7.91l-48.7-42c-.12-.1-.23-.19-.13-.5s.18-.27.33-.29l63.92-5.16A8,8,0,0,0,103,91.86l24.62-59.61c.08-.17.11-.25.35-.25s.27.08.35.25L153,91.86a8,8,0,0,0,6.75,4.92l63.92,5.16c.15,0,.24,0,.33.29S224,102.63,223.84,102.73Z"></path></svg>';
    }
    return $stars;
  }
}
