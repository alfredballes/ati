<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

// END ENQUEUE PARENT ACTION

function template_chooser($template) {    
    global $wp_query;   
    $post_type = get_query_var('post_type');   
    if( $wp_query->is_search && $post_type == 'courses' ) {
        return locate_template('archive-search.php');  // redirect to archive-search.php
    }   
    return $template;   
}
add_filter('template_include', 'template_chooser');  

function mycustomscript_enqueue() { 
    wp_enqueue_style('style-name', get_stylesheet_directory_uri() . '/slick/slick.css');
    wp_enqueue_style('style-name', get_stylesheet_directory_uri() . '/slick/slick-themes.css');
    wp_enqueue_script('custom-scripts', get_stylesheet_directory_uri() . '/slick/slick.js', array('jquery'), null, true); 
}
add_action('wp_enqueue_scripts', 'mycustomscript_enqueue');

function my_register_javascript() {
    wp_register_script('mediaelement', plugins_url('wp-mediaelement.min.js', __FILE__), array('jquery'), '4.8.2', true);
    wp_enqueue_script('mediaelement');
}
add_action('wp_enqueue_scripts', 'my_register_javascript', 100);

function my_custom_enqueue_scripts() {
    // Dequeue Divi's jQuery
    wp_dequeue_script('jquery');
    wp_deregister_script('jquery');

    // Enqueue WordPress's default jQuery
    wp_enqueue_script('jquery', includes_url('/js/jquery/jquery.js'), array(), null, true);
}
add_action('wp_enqueue_scripts', 'my_custom_enqueue_scripts', 100);

function my_custom_scripts() {
    wp_enqueue_script('my-custom-script', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'my_custom_scripts');

// Add the custom column to the post admin screen
add_filter('manage_courses_posts_columns', 'add_custom_column');
function add_custom_column($columns) {
    $columns['custom_field'] = __('Course Code', 'your_text_domain');
    return $columns;
}

// Populate the custom column with data from the custom field
add_action('manage_courses_posts_custom_column', 'populate_custom_column', 10, 2);
function populate_custom_column($column, $post_id) {
    if ($column == 'custom_field') {
        $custom_field_value = get_post_meta($post_id, 'course_code', true);
        echo esc_html($custom_field_value);
    }
}

function your_columns_head($defaults) {  
    $new = array();
    $tags = $defaults['custom_field'];  // save the tags column
    unset($defaults['custom_field']);   // remove it from the columns list

    foreach($defaults as $key=>$value) {
        if($key=='taxonomy-location') {  // when we find the date column
            $new['custom_field'] = $tags;  // put the tags column before it
        }    
        $new[$key] = $value;
    }  

    return $new;  
} 
add_filter('manage_posts_columns', 'your_columns_head');  

function add_tags_to_custom_post_type() {
    register_taxonomy_for_object_type('post_tag', 'courses');
}
add_action('init', 'add_tags_to_custom_post_type');

/*function courses_permalink($post_link, $post, $leavename, $sample) {
    // If is custom post type "courses"
    if ($post->post_type == 'courses') {
        // Get current post object
        global $post;
        // Get current value from custom taxonomy "industries"
        $terms = get_the_terms($post->id, 'industries');
        // Define category from "slug" of taxonomy object
        $term = $terms[0]->slug;
        // Re-structure permalink with string replace to include taxonomy value and post name
        $permalink = str_replace('courses/', 'courses/' . $term . '/', $post_link);
    }
    return $permalink;
}
add_filter('post_type_link', 'courses_permalink', 10, 4);

add_rewrite_rule(
    // The regex to match the incoming URL
    'courses/([^/]+)/([^/]+)/?',
    // The resulting internal URL: `index.php` because we still use WordPress
    // `pagename` because we use this WordPress page
    // `designer_slug` because we assign the first captured regex part to this variable
    'index.php?industries=$matches[1]&courses=$matches[2]',
    // This is a rather specific URL, so we add it to the top of the list
    // Otherwise, the "catch-all" rules at the bottom (for pages and attachments) will "win"
    'top'
);*/

function posts_add_rewrite_rules( $wp_rewrite ) {
    $new_rules = [
        'articles/page/([0-9]{1,})/?$' => 'index.php?post_type=post&paged='. $wp_rewrite->preg_index(1),
        'articles/(.+?)/(.+?)/?$' => 'index.php?post_type=post&name='. $wp_rewrite->preg_index(2),
    ];
    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
    return $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'posts_add_rewrite_rules');

function posts_change_blog_links($post_link, $id = 0){
    global $post;
    // Get current value from custom taxonomy "industries"
    $terms = get_the_terms($post->id, 'category');
    // Define category from "slug" of taxonomy object
    $term = $terms[0]->slug;
    if (is_object($post) && $post->post_type == 'post') {
        return home_url('/articles/' . $term . '/' . $post->post_name . '/');
    }
    return $post_link;
}
add_filter('post_link', 'posts_change_blog_links', 1, 3);

function control_search_results() {
    if ( is_search() )
        set_query_var('posts_per_archive_page', -1); // Change 10 to the number of search results you want to appear per page.
}

add_filter('pre_get_posts', 'control_search_results');

function enqueue_select2_jquery() {
    wp_register_style( 'select2css', '//cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.css', false, '1.0', 'all' );
    wp_register_script( 'select2', '//cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_style( 'select2css' );
    wp_enqueue_script( 'select2' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_select2_jquery', 100 ); 

function resize_screen() {
	if(is_page( array( 'course-enrol-a1', 'course-enrol-n1', 'course-enrol-r1', 'course-enrol-a2', 'course-enrol-r2' )) ) {
		$js = '<script type="text/javascript">
				function triggerResizeEvent() {
					window.dispatchEvent(new Event(\'resize\'));
				}

				function startTriggeringResize() {
					// Set an interval to trigger the resize event every second
					const intervalId = setInterval(function() {
						triggerResizeEvent();
					}, 1000);
					
					// Set a timeout to stop triggering the resize event after 10 seconds
					setTimeout(function() {
						clearInterval(intervalId); // Stop the interval
					}, 1000);
				}

				document.addEventListener(\'DOMContentLoaded\', startTriggeringResize);
			</script>';
		echo $js;
	}
}
add_action( 'wp_footer', 'resize_screen', 100 );

// Add the custom column to the post admin screen for course_fee
add_filter('manage_courses_posts_columns', 'add_custom_column2');
function add_custom_column2($columns) {
    $columns['course_fee'] = __('Course Fee', 'your_text_domain');
    return $columns;
}

// Populate the custom column with data from the custom field for course_fee
add_action('manage_courses_posts_custom_column', 'populate_custom_column2', 10, 2);
function populate_custom_column2($column, $post_id) {
    if ($column == 'course_fee') {
        $custom_field_value = get_post_meta($post_id, 'course_fee', true);
        echo "$" . do_shortcode($custom_field_value) . ".00";
    }
}

function your_columns_head2($defaults) {  
    $new = array();
    $tags = $defaults['course_fee'];  // save the tags column
    unset($defaults['course_fee']);   // remove it from the columns list

    foreach($defaults as $key=>$value) {
        if($key=='custom_field') {  // when we find the date column
            $new['course_fee'] = $tags;  // put the tags column before it
        }    
        $new[$key] = $value;
    }  

    return $new;  
} 
add_filter('manage_posts_columns', 'your_columns_head2');  