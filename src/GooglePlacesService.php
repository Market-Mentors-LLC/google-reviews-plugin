<?php

namespace MarketMentors\GoogleReviewsPlugin\src;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Strategy\GreedyCacheStrategy;
use Kevinrob\GuzzleCache\Storage\FlysystemStorage;
use League\Flysystem\Local\LocalFilesystemAdapter;

class GooglePlacesService
{
  private $client;
  private $apiKey;

  public function __construct($cacheDir = null)
  {
    $this->apiKey = null;

    $cacheDir = $cacheDir ?: $this->getWordPressCacheDir();

    $adapter = new LocalFilesystemAdapter($cacheDir);

    $stack = HandlerStack::create();

    $privateCache = new CacheMiddleware(
      new GreedyCacheStrategy(
        new FlysystemStorage($adapter),
        60 * 60 * 24, // 1 day
      ),
    );
    $stack->push($privateCache, 'greedy-cache');

    $this->client = new Client(['handler' => $stack]);
  }

  public function setApiKey($apiKey)
  {
    $this->apiKey = $apiKey;
  }

  private function getWordPressCacheDir()
  {
    // Get WordPress uploads directory
    $uploadDir = wp_upload_dir();
    $cacheDir = $uploadDir['basedir'] . '/google-reviews-plugin/cache';

    // Ensure the directory exists
    if (!file_exists($cacheDir)) {
      wp_mkdir_p($cacheDir);
    }

    return $cacheDir;
  }

  public function searchPlaces($query, $location = null, $radius = null)
  {
    try {
      $response = $this->client->get('https://maps.googleapis.com/maps/api/place/textsearch/json', [
        'query' => [
          'query' => $query,
          'key' => $this->apiKey,
          'location' => $location,
          'radius' => $radius
        ]
      ]);

      return json_decode($response->getBody(), true);
    } catch (\GuzzleHttp\Exception\RequestException $e) {
      // Handle error
      throw new \Exception('Google Places API request failed: ' . $e->getMessage());
    }
  }

  public function getPlaceDetails(string $placeId, string $fields = null)
  {
    try {
      $query = [
        'place_id' => $placeId,
        'key' => $this->apiKey,
        'fields' => 'reviews',
      ];

      if ($fields) {
        $query['fields'] = $fields;
      }

      $response = $this->client->get('https://places.googleapis.com/v1/places/' . $placeId, [
        'headers' => [
          'Accept' => 'application/json',
          'Content-Type' => 'application/json',
          'X-Goog-Api-Key' => $this->apiKey,
          'X-Goog-FieldMask' => $fields,
        ]
      ]);

      return json_decode($response->getBody(), true);
    } catch (\GuzzleHttp\Exception\RequestException $e) {
      throw new \Exception('Google Places API request failed: ' . $e->getMessage());
    }
  }

  public function clearCache()
  {
    $cacheDir = __DIR__ . '/cache';
    if (is_dir($cacheDir)) {
      $this->deleteDirectory($cacheDir);
    }
  }

  private function deleteDirectory($dir)
  {
    if (!is_dir($dir)) {
      return;
    }

    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
      $path = $dir . '/' . $file;
      is_dir($path) ? $this->deleteDirectory($path) : unlink($path);
    }
    rmdir($dir);
  }
}
