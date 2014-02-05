<?php
/* By taking advantage of hooks, filters, and the Custom Loop API, you can make Thesis
 * do ANYTHING you want. For more information, please see the following articles from
 * the Thesis User’s Guide or visit the members-only Thesis Support Forums:
 * 
 * Hooks: http://diythemes.com/thesis/rtfm/customizing-with-hooks/
 * Filters: http://diythemes.com/thesis/rtfm/customizing-with-filters/
 * Custom Loop API: http://diythemes.com/thesis/rtfm/custom-loop-api/

---:[ place your custom code below this line ]:---*/




// Here's how you can add a custom header
function custom_header() { 
  ?>
  <!-- Place HTML content Here -->
  <?php
}
remove_action('thesis_hook_header', 'thesis_default_header'); // This of course removes the default header
add_action('thesis_hook_header', 'custom_header'); // Adds the new header so you can see how add_action functions work
remove_action('thesis_hook_before_header', 'thesis_nav_menu'); // It's sometimes helpful to also remove the navigation

// Here's how you would add a custom page
remove_action('thesis_hook_custom_template', 'thesis_custom_template_sample');
function custom_page() {
  if(is_page(1))
    include (TEMPLATEPATH . '/custom/pages/homepage.php');

	
}
add_action('thesis_hook_custom_template', 'custom_page');

// Here's how to add a custom footer
function custom_footer() {
    ?>
    <!-- Place HTML content Here -->
    <?php
}
remove_action('thesis_hook_footer', 'thesis_attribution');
add_action('thesis_hook_footer', 'custom_footer');

// Here's how you would add a custom class to a page, example .homepage .page etc
function custom_body_class($classes) {
  if(is_page(1)) {
        $classes[] = 'homepage';
        return $classes;
    }
  if(is_page(2)) {
        $classes[] = 'aboutus';
        return $classes;
    }
}
add_filter('thesis_body_classes', 'custom_body_class');

// Here's the code for adding a shortcode
add_shortcode('shortcodename', 'show_shortcodename'); // this is what displays in [shortcodename]
function show_shortcodename(){
  ob_start();
  ?>
  <!-- Place the HTML Content Here -->
  <?php
  $output_string = ob_get_contents();
  ob_end_clean();
  return $output_string;
}

// If you're adding a shortcode to a sidebar you'll need to add this line of code
add_filter('widget_text', 'do_shortcode');

// Adding scripts to the <head></head> tags can be done using this, example jQuery:
function add_scripts_to_page_head() {
  if(is_page(1)) {
    ?>
	<link rel="stylesheet" href= "<?php bloginfo('template_directory'); ?>/custom/assets/bootstrap/css/bootstrap.min.css" />
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/custom/assets/js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/custom/assets/bootstrap/js/bootstrap.min.js"></script>
    <?php
  }
}
add_action('wp_head', 'add_scripts_to_page_head');

?>

