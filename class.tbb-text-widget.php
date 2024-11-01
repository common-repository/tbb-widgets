<?php

require_once dirname(__FILE__) . '/class.tbb-widget.php';

class TBBTextWidget extends TBBWidget
{
	function __construct() {
		parent::__construct('text',__("TBB's Text", TBB_WIDGETS_SLUG),__('Will render PHP oder HTML with shortcodes.', TBB_WIDGETS_SLUG),array(
					array(
			            'icon' => 'fa-home',
			            'title' => __('General', TBB_WIDGETS_SLUG),
			            'fields' => array(
			                array(
			                    'id' => 'title',
			                    'type' => 'text',
			                    'title' => __('Title', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Change the login logo link URL.', TBB_WIDGETS_SLUG),
			                    'default' => '',
			                ),
			                array(
			                    'id' => 'css_class',
			                    'type' => 'text',
			                    'title' => __('CSS Class', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Change the login logo link URL.', TBB_WIDGETS_SLUG),
			                    'default' => '',
							),
			                array(
			                    'id' => 'text-mode',
			                    'type' => 'select',
			                    'title' => __('Mode', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Change the login logo link URL.', TBB_WIDGETS_SLUG),
			                    'default' => 'html',
								'multi' => false,
								'ace_mode' => true,
								'options' => array(
									'html' => 'HTML',
									'php' => 'PHP'
								)
			                ),
			                array(
			                    'id' => 'text',
			                    'type' => 'ace_editor',
			                    'title' => __('Code', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Paste your CSS here.', TBB_WIDGETS_SLUG),
			                    'mode' => 'html',
			                    'theme' => 'monokai',
			                    'desc' => __('Paste your CSS here.', TBB_WIDGETS_SLUG)
			                )
			            )
					)
				),
				array('width' => 400, 'height' => 350)
			);
	}
	
	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		
		$this->instance = $instance;
		
		$title = apply_filters('widget_title', $instance['title'] );
		
		extract($args);
 
		echo $before_widget;
 
		// Display the widget title 
		if ( $title )
		    echo $before_title . $title . $after_title;

		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		
		echo '<div class="tbb-text ' . $instance['css_class'] . '">';
		if($instance['text-mode'] == 'php'){
			if (strpos($text, '<' . '?') !== false) {
				ob_start();
				eval('?' . '>' . $text);
				$text = ob_get_contents();
				ob_end_clean();
				
				echo $text;
			}

		}else{
			echo do_shortcode($text);
		}

		echo '</div>';
		
 
		echo $after_widget;
	}
	
    
}