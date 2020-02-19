<?php
function pbf_get_event_address($event_metadata) {
  if (array_key_exists("address", $event_metadata) && $event_metadata["address"] != "") {
    return $event_metadata["address"];
  }

  if (array_key_exists("organizers", $event_metadata)) {
    $organizer_metadata = get_post_meta($event_metadata["organizers"][0]);
    return $organizer_metadata["address"];
  }

  return "";
}
 ?>
