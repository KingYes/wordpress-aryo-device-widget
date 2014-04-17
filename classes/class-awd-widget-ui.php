<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AWD_Widget_UI {
	
	protected $_display_options = array();
	
	public function widget_display_callback( $instance, WP_Widget $widget, $args ) {
		if ( empty( $instance['awd_display_widget'] ) || empty( $this->_display_options[ $instance['awd_display_widget'] ] ) )
			return $instance;
		
		if ( false !== $instance ) {
			$display_widget = $instance['awd_display_widget'];
			
			$args['before_widget'] = '<div class="awd-' . $display_widget . '">' . $args['before_widget'];
			$args['after_widget'] = $args['after_widget'] . '</div>';
			$widget->widget( $args, $instance );
		}
		return false;
	}
	
	public function in_widget_form( WP_Widget $widget, $return, $instance ) {
		$instance['awd_display_widget'] = ! empty( $instance['awd_display_widget'] ) ? $instance['awd_display_widget'] : '';
		?>
		<p>
			<label for="<?php echo $widget->get_field_id( 'awd_display_widget' ); ?>"><?php _e( 'Show/Hide Widget', 'aryo-awd' ) ?></label>
			<select name="<?php echo $widget->get_field_name( 'awd_display_widget' ); ?>" id="<?php echo $widget->get_field_id( 'awd_display_widget' ); ?>" class="widefat">
				<option value=""><?php _e( 'Show on all devices', 'aryo-awd' ) ?></option>
				<?php foreach ( $this->_display_options as $key => $value ) : ?>
				<option value="<?php echo $key; ?>"<?php selected( $instance['awd_display_widget'], $key ) ?>><?php echo $value; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
	<?php
	}
	
	public function widget_update_callback( $instance, $new_instance, $old_instance, WP_Widget $widget ) {
		if ( ! empty( $new_instance['awd_display_widget'] ) && ! empty( $this->_display_options[ $new_instance['awd_display_widget'] ] ) )
			$instance['awd_display_widget'] = $new_instance['awd_display_widget'];
		else
			$instance['awd_display_widget'] = '';
		
		return $instance;
	}
	
	public function wp_enqueue_scripts() {
		wp_enqueue_style( 'awd-style', plugins_url( 'assets/css/style.css', WIDGET_DEVICE_BASE ) );
	}
	
	public function __construct() {
		$this->_display_options = array(
			'visible-desktop' => __( 'Visible Desktop', 'aryo-awd' ),
			'visible-tablet'  => __( 'Visible Tablet', 'aryo-awd' ),
			'visible-phone'   => __( 'Visible Phone', 'aryo-awd' ),
			'hidden-desktop'  => __( 'Hidden Desktop', 'aryo-awd' ),
			'hidden-tablet'   => __( 'Hidden Tablet', 'aryo-awd' ),
			'hidden-phone'    => __( 'Hidden Phone', 'aryo-awd' ),
		);
		
		add_filter( 'widget_display_callback', array( &$this, 'widget_display_callback' ), 999, 3 );
		add_action( 'in_widget_form', array( &$this, 'in_widget_form' ), 10, 3 );
		add_filter( 'widget_update_callback', array( &$this, 'widget_update_callback' ), 10, 4 );

		add_action( 'wp_enqueue_scripts', array( &$this, 'wp_enqueue_scripts' ) );
	}
	
}
