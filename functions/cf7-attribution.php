<?php

add_action('wp_enqueue_scripts', function () {
  // Load only on pages that have CF7 (optional optimization)
  wp_enqueue_script(
    'cf7-attribution',
    get_stylesheet_directory_uri() . '/js/cf7-attribution.js',
    array(),
    '1.0.0',
    true
  );
}, 20);


add_filter('wpcf7_posted_data', function ($data) {
  // Only if empty (don't overwrite JS-filled values)
  if (empty($data['landing_page'])) {
    $data['landing_page'] = (is_ssl() ? 'https://' : 'http://') . ($_SERVER['HTTP_HOST'] ?? '') . ($_SERVER['REQUEST_URI'] ?? '');
  }

  if (empty($data['referrer']) && !empty($_SERVER['HTTP_REFERER'])) {
    $data['referrer'] = esc_url_raw($_SERVER['HTTP_REFERER']);
  }

  // Basic sanitization for safety
  $keys = ['utm_source','utm_medium','utm_campaign'];
  foreach ($keys as $k) {
    if (isset($data[$k])) $data[$k] = sanitize_text_field($data[$k]);
  }

  return $data;
});

?>