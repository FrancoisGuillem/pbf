<?php
function pbf_order_partners_by_level( $query ) {

	// do not modify queries in the admin
	if( is_admin() ) {

		return $query;

	}

	// only modify queries for 'event' post type
	if( isset($query->query_vars['post_type']) && is_archive() && $query->query_vars['post_type'] == 'partner' ) {

		$query->set('orderby', 'meta_value');
		$query->set('meta_key', 'partner_level');
		$query->set('order', 'asc');

	}


	// return
	return $query;

}

add_action('pre_get_posts', 'pbf_order_partners_by_level');
