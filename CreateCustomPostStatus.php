<?php 

//ADD THIS CODE TO YOUR WORDPRESS THEME'S FUNCTIONS.PHP FILE.  REPLACE ALL INSTANCES OF StatusName, Status Name AND statusname WITH THE NAME YOU HAVE CHOSEN FOR YOUR NEW POST STATUS. (THE SAFEST WAY TO DO THIS IS TO PERFORM A FIND AND REPLACE WITH THE 'MATCH CASE' OPTION ENABLED.

// Register Custom Status 
function custom_post_status() {

	$args = array(
		'label'                     => _x( 'StatusName', 'Status General Name', 'text_domain' ),
		'label_count'               => _n_noop( 'StatusName (%s)',  'Status Name (%s)', 'text_domain' ), 
		'public'                    => false,
		'private'					=> true,
		'protected'                 => true,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'exclude_from_search'       => true,
	);
	register_post_status( 'statusname', $args );

}
add_action( 'init', 'custom_post_status', 0 );

function add_to_post_status_dropdown()
{
    ?>
    <script>
    jQuery(document).ready(function($){
        $("select#post_status").append("<option value=\"StatusName\" <?php selected('StatusName', $post->post_status); ?>>StatusName</option>");
    });
    </script>
    <?php
}

add_action( 'post_submitbox_misc_actions', 'add_to_post_status_dropdown');

function wp_display_statusname_state( $states ) {
     global $post;
     $arg = get_query_var( 'post_status' );
     if($arg != 'statusname'){
          if($post->post_status == 'statusname'){
               return array('StatusName');
          }
     }
    return $states;
}
add_filter( 'display_post_states', 'wp_display_statusname_state' );

?>
