<?php
function pbf_filter_events_by_date( $query ) {

	// do not modify queries in the admin
	if( is_admin() ) {

		return $query;

	}

	// only modify queries for 'event' post type
	if( isset($query->query_vars['post_type']) && is_archive() && $query->query_vars['post_type'] == 'event' ) {
    $date = strval(date('Y-m-d', time()));
    if (isset($_GET["date"])) {$date = $_GET["date"];}

    if ($date < "2020-04-25") {$date = "2020-04-25";}

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

add_action('pre_get_posts', 'pbf_filter_events_by_date');
