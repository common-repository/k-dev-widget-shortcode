<?php 
/*
Plugin Name:    K-Dev Widget Shortcode
Description:    You can use Shortcode In Widget and you can use [kdev_widget_shortcode_test] for test in this plugin.
Author:         Khaled Developer
Author URI:     https://aparat.com/khaledsss
Version:        1.0
Text Domain:    kdev-widget-shortcode
Domain Path:    /lang
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/ 
if ( ! defined('ABSPATH')) exit;  // if direct access
//functions 
function kdws_test_plugin (){
	return "<b>".__('This is Working')."</b>";
}
//Add Shortcode
add_shortcode("kdev_widget_shortcode_test", "kdws_test_plugin" );
//////////////////////////////////////////////////////////////
//                 Creating the widget                      //
//////////////////////////////////////////////////////////////
class kdws_shortcode_widget extends WP_Widget {
  
function __construct() {
parent::__construct(
  
// Base ID of your widget
'kdws_shortcode_widget', 
  
// Widget name will appear in UI
__("Kdev Widget Shortcode",'kdev-widget-shortcode'), 
  
// Widget description
array( 'description' => __("You can use Shortcode in Widget",'kdev-widget-shortcode') ) 
);
}
  
// Creating widget front-end
  
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
$des = apply_filters( 'widget_title', $instance['description'] );
	if (!empty($des)){
	// before and after widget arguments are defined by themes
	echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		  
		// This is where you run the code and display the output
		echo do_shortcode($des);
	echo $args['after_widget'];
	}
}
          
// Widget Backend 
public function form( $instance ) {
	
	if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
	}
	else {
		$title = "";
	}
	if ( isset( $instance[ 'description' ] ) ) {
		$description = $instance[ 'description' ];
	}
	else {
		$description = "";
	}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php  _e( 'Title:'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php echo __( 'Shortcode:','kdev-widget-shortcode'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" value="<?php echo esc_attr( $description ); ?>" />
</p>
<?php 
}
      
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
return $instance;
}
 
// Class kdws_shortcode_widget ends here
} 
 
 
// Register and load the widget
function kdws_load_widget() {
    register_widget( 'kdws_shortcode_widget' );
}
add_action( 'widgets_init', 'kdws_load_widget' );
?>