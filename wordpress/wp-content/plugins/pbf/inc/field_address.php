<?php

function field_address( $post) {
  $metadata = get_post_meta($post->ID);
  $long = $metadata["long"][0] ?? 2.3522218999999955;
  $lat = $metadata["lat"][0] ?? 48.856670471898596;
  if ($long == "") {
    $long = 2.352221899999995;
  }
  $address = $metadata["address"][0] ?? "";
  if ($lat == "") {
    $lat = 48.856670471898596;
  }


  wp_nonce_field('save_pbf_post', 'field_address' );
  echo '';
  ?>
  <p>
    Adresse
    <input type="text" id="address" name="address" value="<?= $address ?>" placeholder="Adresse" style="width:100%;"/>
  </p>
  <div style="float:left;width:200px;">
    <button type="button" id="search-address" class="button">
      Rechercher coordonnées
    </button>
    <p>
      Longitude
      <input type="text" id="long" name="long" value="<?= $long ?>" placeholder="Longitude"/>
    </p>
    <p>
      Lattitude
      <input type="text" id="lat" name="lat" value="<?= $lat ?>" placeholder="Longitude"/>
    </p>
    <p>Vous pouvez aussi déplacer le curseur sur la carte pour modifier les coordonnées.</p>
  </div>
  <div id="map" style="width:500px;height:300px;"></div>
  <script>
  var map;
  var marker;

  jQuery(function($) {
    $("#search-address").click(function(e) {
      $.get("https://maps.googleapis.com/maps/api/geocode/json", {
        key: '<?= $_ENV["GMAP_API_KEY"] ?>',
        address: $("#address").val()
      }, function(data) {
        if (data.results) {
          marker.setPosition(data.results[0].geometry.location);
          map.setCenter(data.results[0].geometry.location);
          map.setZoom(14);
          $("#long").val(data.results[0].geometry.location.lng);
          $("#lat").val(data.results[0].geometry.location.lat);
        }

      })
    });
  });

  function initMap() {
    // The location of Uluru
     var coords = {lat: <?= $lat ?>, lng: <?= $long ?>};
     // The map, centered at Uluru
     map = new google.maps.Map(
         document.getElementById('map'), {zoom: 14, center: coords});
     // The marker, positioned at Uluru
     marker = new google.maps.Marker({position: coords, map: map, draggable:true});

     google.maps.event.addListener(marker, 'dragend', function()
      {
        document.getElementById("long").value = (marker.position.lng());
        document.getElementById("lat").value = (marker.position.lat());
      });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= $_ENV["GMAP_API_KEY"] ?>&callback=initMap"
async defer></script>
  <?php
}

?>
