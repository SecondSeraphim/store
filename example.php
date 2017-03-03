<?php

// Initializing the WordPress engine in a stanalone PHP file
include('../wp-blog-header.php');

// Preparing a WP_query
$the_query = new WP_Query(
array(
'post_type' => 'page', // We only want pages
'post_count' => -1 // We do not want to limit the post count
// We can define any additional arguments that we need - see Codex for the full list
)
);

$return_array = array(); // Initializing the array that will be used for the table

while( $the_query->have_posts() ){

// Fetch the post
$the_query->the_post();

// Filling in the new array entry
$return_array[] = array(
'Title' => get_the_title(), // Set the title
'Content preview with link' => get_permalink().'||'.strip_tags( strip_shortcodes( substr( get_the_content(), 0, 200 ) ) ).'...'
// Get first 200 chars of the content and replace the shortcodes and tags
);

}

// Now the array is prepared, we just need to serialize and output it
echo serialize( $return_array );

?>
