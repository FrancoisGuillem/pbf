<?php
// Récupère l'adresse d'un évènement.
// Il s'agit soit de l'adresse directement entrée dans la page de l'évènement,
// soit l'adresse du premier organisateur de l'évènement
function pbf_get_event_address($event_metadata) {
  if (array_key_exists("address", $event_metadata) && $event_metadata["address"][0] != "") {
    return array(
      "address" => $event_metadata["address"][0] ?? "",
      "long" => $event_metadata["long"][0] ?? "",
      "lat" => $event_metadata["lat"][0] ?? "",
    );
  }

  if (array_key_exists("organizers", $event_metadata) && ! empty($event_metadata["organizers"])) {
    $org_id = explode(",", $event_metadata["organizers"][0])[0];
    $organizer_metadata = get_post_meta($org_id);
    return array(
      "address" => $organizer_metadata["address"][0] ?? "",
      "long" => $organizer_metadata["long"][0] ?? "",
      "lat" => $organizer_metadata["lat"][0] ?? "",
    );
  }

  return "";
}

// Template function qui affiche la date et l'heure d'un évènement.
function pbf_event_schedule($event_metadata) {
  $date = "";
  $time = "";

  if (array_key_exists("start_date", $event_metadata) && !empty($event_metadata["start_date"][0])) {
    if (array_key_exists("end_date", $event_metadata) && !empty($event_metadata["end_date"][0])) {
      $date = "Du " . $event_metadata["start_date"][0] . " au " . $event_metadata["end_date"][0];
    } else {
      $date = "Le ". $event_metadata["start_date"][0];
    }
  }

  if (array_key_exists("start_time", $event_metadata) && !empty($event_metadata["start_time"][0])) {
    if (array_key_exists("end_time", $event_metadata) && !empty($event_metadata["end_time"][0])) {
      $time = "De " . $event_metadata["start_time"][0] . " à " . $event_metadata["end_time"][0];
    } else {
      $time = "A partir de ". $event_metadata["start_time"][0];
    }
  }
  echo "<div class='event-date'>". $date ."</div>";
  echo "<div class='event-time'>" . $time ."</div>";
}

// Template function qui renvoie la liste des organisateurs d'un évènements
function pbf_event_organizers($event_metadata) {

}

 ?>
