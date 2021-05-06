<?php
// Get an array of registered images
function rapc_thumb_sizes() {
	global $_wp_additional_image_sizes;
 
    $sizes = array(
		'full' => __( 'Full', 'ra-post-carousel-widget' )
	);

	$get_intermediate_image_sizes = get_intermediate_image_sizes();

	
	
	foreach( $get_intermediate_image_sizes as $_size ) {
		if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {
			$sizes[ $_size ] = ucwords( $_size ); // strtouppercase
		}
	}

	return $sizes;
}