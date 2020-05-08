<?php
function pbf_filter_events_by_date($query)
{

  // do not modify queries in the admin
  if (is_admin()) {

    return $query;
  }

  // only modify queries for 'event' post type
  if (isset($query->query_vars['post_type']) && (is_archive() || (isset($query->query_vars['filter']) && $query->query_vars['filter'] == 'date')) && $query->query_vars['post_type'] == 'event') {
    $date = pbf_get_selected_date();

    $query->set('meta_query', array(
      "relation" => "OR",
      array(
        "key" => "start_date",
        "value" => $date,
        "compare" => "="
      ),
      array(
        "relation" => "AND",
        array(
          "key" => "start_date",
          "compare" => "<=",
          "value" => $date
        ),
        array(
          "key" => "end_date",
          "compare" => ">=",
          "value" => $date
        )
      )
    ));
  }


  // return
  return $query;
}

function pbf_get_selected_date()
{
  $date = strval(date('Y-m-d', time()));
  if (isset($_GET["date"])) {
    $date = $_GET["date"];
  }
  if ($date >= "2020-09-03" && $date < "2020-10-03") {
    $date = "2020-10-03";
  }
  return $date;
}

add_action('pre_get_posts', 'pbf_filter_events_by_date');
