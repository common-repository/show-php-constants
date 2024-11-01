<?php
/*
  Plugin Name: Show PHP Constants
  Plugin URI: http://www.stringcat.com/company_blog/2012/08/28/wordpress-plugin-show-all-php-constants
  Description: Plugin for debugging. Showing the value of all PHP constants. Useful for instance for solving problems when upgrading or when changing webhoster
  Author: Ad Lagendijk
  Author URI: http://www.stringcat.com
  Version: 1.0
*/

//
// Hook for adding admin menus
// add_action()
//
add_action('admin_menu', 'show_constants_add_pages');

//
// action function for above hook
// show_constants_add_pages()
//
function show_constants_add_pages() {
    add_options_page('Show PHP constants Options'
	    , 'Show PHP constants'
	    , 10, __FILE__
	    , 'show_php_constants_admin');
}

//
// show_php_constants_admin()
//
function show_php_constants_admin() {
    $allConstants = get_defined_constants(FALSE);
    ksort($allConstants);
    if (!empty($allConstants)) {
	?>
	<table border = "1" width ="500">
	    <tr><td ><strong><?php _e('NAME'); ?>:</strong></td>
		<td ><strong><?php _e('VALUE'); ?>:</strong></td>  
	    </tr>
	    <?php
	    foreach ($allConstants as $name => $value) {
		if (!isset($value)) continue;
		$value = trim($value);
		if (empty($value)) continue;
		?>    
	        <tr>
	    	<td><?php echo ($name); ?></td>
	    	<td><?php echo ($value); ?></td>   
	        </tr>    
		<?php
	    }
	}
	?></table><?php
}
    ?>