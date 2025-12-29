<?php
  const GOOGLE_MAPS_KEY = 'AIzaSyC22aRikLh4Qa03UDIXRlabwxtAVkm8T8k';

  //AIzaSyAbEgakBcrqcx5HvO4H6Ikpk8XYVrtHe_Y

  function addGoogleMapApiKeyToAcfInit() {
    acf_update_setting('google_api_key', GOOGLE_MAPS_KEY);
  }

  add_action('acf/init', 'addGoogleMapApiKeyToAcfInit');

  function acfMakeMap($acfLocation) {
    $address = $acfLocation['address'];

    echo '<iframe class="embed-responsive-item w-100" style="height: 250px;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?key=' . GOOGLE_MAPS_KEY . '&q=' . urlencode($address) . '"></iframe>';
}