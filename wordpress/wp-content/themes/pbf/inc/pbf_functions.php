<?php


// Template function qui affiche la date et l'heure d'un évènement.
function pbf_event_schedule($event_metadata)
{
  $date = "";
  $time = "";

  if (array_key_exists("start_date", $event_metadata) && !empty($event_metadata["start_date"][0])) {
    if (array_key_exists("end_date", $event_metadata) && !empty($event_metadata["end_date"][0])) {
      $date = "Du " . $event_metadata["start_date"][0] . " au " . $event_metadata["end_date"][0];
    } else {
      $date = "Le " . $event_metadata["start_date"][0];
    }
  }

  if (array_key_exists("start_time", $event_metadata) && !empty($event_metadata["start_time"][0])) {
    if (array_key_exists("end_time", $event_metadata) && !empty($event_metadata["end_time"][0])) {
      $time = "De " . $event_metadata["start_time"][0] . " à " . $event_metadata["end_time"][0];
    } else {
      $time = "A partir de " . $event_metadata["start_time"][0];
    }
  }
  echo "<div class='event-date'>" . $date . "</div>";
  echo "<div class='event-time'>" . $time . "</div>";
}

// Template function qui renvoie la liste des organisateurs d'un évènements
function pbf_event_organizers($event_metadata)
{
  $links = array();

  if (array_key_exists("organizers", $event_metadata) && !empty($event_metadata["organizers"][0])) {
    $organizers = explode(",", $event_metadata["organizers"][0]);
    foreach ($organizers as $org_id) {
      $post = get_post($org_id);
      $link = get_permalink($post);
      array_push($links, '<a href="' . $link . '">' . get_the_title($post) . '</a>');
    }
  }
  echo implode(", ", $links);
}

// Template function qui renvoie la liste des organisateurs d'un évènements
function get_pbf_event_organizers($event_metadata)
{
  $organizers = array();

  if (array_key_exists("organizers", $event_metadata) && !empty($event_metadata["organizers"][0])) {
    $organizers_ids = explode(",", $event_metadata["organizers"][0]);

    foreach ($organizers_ids as $org_id) {

      $post = get_post($org_id);

      $terms = get_the_terms($post, 'participant_cat');
      $categories = array();

      if (!empty($terms)) {
        foreach ($terms as $term) {
          $categories[] = $term->name;
        }
      }

      $organizer = array(
        "title" => get_the_title($post),
        "id" => get_the_ID($post),
        "permalink" => get_permalink($post),
        "thumbnail" => get_the_post_thumbnail_url($post),
        "categories" => $categories,
      );

      array_push($organizers, $organizer);
    }
  }

  return $organizers[0];
}

function pbf_participant_events($participant_metadata)
{
  if (array_key_exists("events", $participant_metadata) && !empty($participant_metadata["events"][0])) {
    $events = explode(",", $participant_metadata["events"][0]);
    $links = array();
    foreach ($events as $evt_id) {
      $post = get_post($evt_id);
      $link = get_permalink($post);
      array_push($links, '<a href="' . $link . '">' . get_the_title($post) . '</a>');
    }
  }
  echo implode("<br/>", $links);
}

function get_pbf_participant_events($participant_metadata)
{
  $events = array();

  if (array_key_exists("events", $participant_metadata) && !empty($participant_metadata["events"][0])) {
    $event_ids = explode(",", $participant_metadata["events"][0]);
    foreach ($event_ids as $evt_id) {
      $post = get_post($evt_id);
      $metadata = get_post_meta($evt_id);

      $content = $post->post_content;
      $content = apply_filters('the_content', $content);
      $content = str_replace(']]>', ']]&gt;', $content);

      $new_event = array(
        "link" => get_permalink($post),
        "title" => get_the_title($post),
        "content" => $content,
        "geo" => pbf_get_event_address($metadata),
        "start_date" => $metadata["start_date"][0],
        "start_time" => $metadata["start_time"][0],
        "end_date" => $metadata["end_date"][0],
        "end_time" => $metadata["end_time"][0],
        "metadata" => $metadata
      );
      array_push($events, $new_event);
    }
  }
  usort($events, function($a, $b) {
    return strcmp($a["start_date"], $b["start_date"]);
  });
  return $events;
}

function pbf_month($date)
{
  if (empty($date)) return "";
  $month = substr($date, 5, 2);
  $ref = array(
    "01" => __("[:en]January[:][:fr]janvier[:]"),
    "02" => __("[:en]February[:][:fr]février[:]"),
    "03" => __("[:en]March[:][:fr]mars[:]"),
    "04" => __("[:en]April[:][:fr]avril[:]"),
    "05" => __("[:en]May[:][:fr]mai[:]"),
    "06" => __("[:en]June[:][:fr]juin[:]")
  );
  if (!array_key_exists($month, $ref)) return "";
  return $ref[$month];
}

function pbf_dow($date)
{
  $dow = strftime("%w", strtotime($date));
  $ref = array(
    "0" => __("[:en]Sunday[:][:fr]dimanche[:]"),
    "1" => __("[:en]Monday[:][:fr]lundi[:]"),
    "2" => __("[:en]Tuesday[:][:fr]mardi[:]"),
    "3" => __("[:en]Wednesday[:][:fr]mercredi[:]"),
    "4" => __("[:en]Thursday[:][:fr]jeudi[:]"),
    "5" => __("[:en]Friday[:][:fr]vendredi[:]"),
    "6" => __("[:en]Saturday[:][:fr]samedi[:]"),
    "7" => __("[:en]Sunday[:][:fr]dimanche[:]")
  );
  return $ref[$dow];
}

function pbf_day($date)
{
  return substr($date, 8, 2);
}

function pbf_time($event)
{
  if (empty($event["end_time"][0])) {
    if (empty($event['start_time'][0])) return "";
    return __("[:en]At[:][:fr]À[:]") . " " . $event["start_time"][0];
  }
  return $event["start_time"][0] . "-" . $event["end_time"][0];
}
