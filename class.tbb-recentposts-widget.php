<?php

require_once dirname(__FILE__) . '/class.tbb-widget.php';

class TBBRecentPostsWidget extends TBBWidget
{
	function __construct() {
		parent::__construct('recent_posts',__("TBB's Recent Posts", TBB_WIDGETS_SLUG),__('Will display recent posts with options for filtering and thumbnails.', TBB_WIDGETS_SLUG),array(
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
			            )
        			),
					array(
			            'icon' => 'fa-filter',
			            'title' => __('Filter', TBB_WIDGETS_SLUG),
			            'fields' => array(
		                    array(
		                        'id'            => 'posts_per_page',
		                        'type'          => 'slider',
		                        'title'         => __('Limit', TBB_WIDGETS_SLUG),
		                        'subtitle'      => __('This example displays the value in a text box', 'redux-framework-demo'),
		                        'desc'          => __('Slider description. Min: 0, max: 300, step: 5, default value: 75', 'redux-framework-demo'),
		                        'default'       => 5,
		                        'min'           => 1,
		                        'step'          => 1,
		                        'max'           => 50
		                    ),
			                array(
			                    'id' => 'order',
			                    'type' => 'select',
			                    'title' => __('Order', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Change the login logo link URL.', TBB_WIDGETS_SLUG),
			                    'default' => 'DESC',
								'multi' => false,
								'options' => array(
									'DESC' => 'DESC',
									'ASC' => 'ASC'
								)
			                ),
			                array(
			                    'id' => 'orderby',
			                    'type' => 'select',
			                    'title' => __('Order By', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Change the login logo link URL.', TBB_WIDGETS_SLUG),
			                    'default' => 'date',
								'multi' => false,
								'options' => array(
									'none' => __('No Order', TBB_WIDGETS_SLUG),
									'ID' => __('Post ID', TBB_WIDGETS_SLUG),
									'author' => __('Author', TBB_WIDGETS_SLUG),
									'title' => __('Title', TBB_WIDGETS_SLUG),
									'name' => __('Name', TBB_WIDGETS_SLUG),
									'date' => __('Date', TBB_WIDGETS_SLUG),
									'modified' => __('Last Modified Date', TBB_WIDGETS_SLUG),
									'parent' => __('Parent ID', TBB_WIDGETS_SLUG),
									'rand' => __('Random Order', TBB_WIDGETS_SLUG),
									'comment_count' => __('Number Of Comments', TBB_WIDGETS_SLUG),
									'menu_order' => __('Page Order', TBB_WIDGETS_SLUG),
								)
			                ),
			                array(
			                    'id' => 'category__in',
			                    'type' => 'select',
			                    'title' => __('Categories', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Change the login logo link URL.', TBB_WIDGETS_SLUG),
			                    'default' => '',
								'multi' => true,
								'options' => $this->getCategories()
			                ),
			                array(
			                    'id' => 'tag__in',
			                    'type' => 'select',
			                    'title' => __('Tags', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Change the login logo link URL.', TBB_WIDGETS_SLUG),
			                    'default' => '',
								'multi' => true,
								'options' => $this->getTags()
							),
			                array(
			                    'id' => 'post_type',
			                    'type' => 'select',
			                    'title' => __('Post Type', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Change the login logo link URL.', TBB_WIDGETS_SLUG),
			                    'default' => '',
								'multi' => false,
								'post_types' => true,
								'options' => array('' => __('Choose...', TBB_WIDGETS_SLUG))
			                ),
							
			            )
        			),
					array(
			            'icon' => 'fa-picture-o',
			            'title' => __('Thumbnail', TBB_WIDGETS_SLUG),
			            'fields' => array(
			                array(
			                    'id' => 'display_thumb',
			                    'type' => 'switch',
			                    'title' => __('Display Thumbnail', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Enable the advanced recent posts widget.', TBB_WIDGETS_SLUG),
			                    'default' => true
							),
		                    array(
		                        'id'            => 'thumb_width',
		                        'type'          => 'slider',
		                        'title'         => __('Width', TBB_WIDGETS_SLUG),
		                        'subtitle'      => __('This example displays the value in a text box', 'redux-framework-demo'),
		                        'desc'          => __('Slider description. Min: 0, max: 300, step: 5, default value: 75', 'redux-framework-demo'),
		                        'default'       => 45,
		                        'min'           => 1,
		                        'step'          => 1,
		                        'max'           => 400
		                    ),
		                    array(
		                        'id'            => 'thumb_height',
		                        'type'          => 'slider',
		                        'title'         => __('Height', TBB_WIDGETS_SLUG),
		                        'subtitle'      => __('This example displays the value in a text box', 'redux-framework-demo'),
		                        'desc'          => __('Slider description. Min: 0, max: 300, step: 5, default value: 75', 'redux-framework-demo'),
		                        'default'       => 45,
		                        'min'           => 1,
		                        'step'          => 1,
		                        'max'           => 400
		                    ),
							array(
			                    'id' => 'thumb_placeholder',
			                    'type' => 'text',
			                    'title' => __('Placeholder URL', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Change the login logo link URL.', TBB_WIDGETS_SLUG),
			                    'default' => 'http://placehold.it/45x45&text=Not%20Found',
			                ),
			            )
        			),
					array(
			            'icon' => 'fa-cogs',
			            'title' => __('Other', TBB_WIDGETS_SLUG),
			            'fields' => array(
			                array(
			                    'id' => 'display_excerpt',
			                    'type' => 'switch',
			                    'title' => __('Display Excerpt', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Enable the advanced recent posts widget.', TBB_WIDGETS_SLUG),
			                    'default' => false
							),
							array(
		                        'id'            => 'excerpt_length',
		                        'type'          => 'slider',
		                        'title'         => __('Excerpt Length', TBB_WIDGETS_SLUG),
		                        'subtitle'      => __('This example displays the value in a text box', 'redux-framework-demo'),
		                        'desc'          => __('Slider description. Min: 0, max: 300, step: 5, default value: 75', 'redux-framework-demo'),
		                        'default'       => 20,
		                        'min'           => 1,
		                        'step'          => 1,
		                        'max'           => 200,
		                        'display_value' => 'text'
		                    ),
			                array(
			                    'id' => 'display_readmore',
			                    'type' => 'switch',
			                    'title' => __('Display Readmore', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Enable the advanced recent posts widget.', TBB_WIDGETS_SLUG),
			                    'default' => false
							),
							array(
			                    'id' => 'readmore_text',
			                    'type' => 'text',
			                    'title' => __('Readmore Text', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Change the login logo link URL.', TBB_WIDGETS_SLUG),
			                    'default' => 'MORE',
							),
			                array(
			                    'id' => 'display_date',
			                    'type' => 'switch',
			                    'title' => __('Display Date', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Enable the advanced recent posts widget.', TBB_WIDGETS_SLUG),
			                    'default' => true
							),
							array(
			                    'id' => 'date_format',
			                    'type' => 'text',
			                    'title' => __('Date Format', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Change the login logo link URL.', TBB_WIDGETS_SLUG),
			                    'default' => 'Y/m/d',
			                ),
							
			            )
        			),
				)
			);
	}
	

	
	private function getCategories(){
		$cats = get_categories();
		
		$output = array();

		foreach($cats as $cat){
			$output[$cat->term_id] = $cat->name;
		}
		
		
		return $output;
	}
	
	private function getTags(){
		$tags = get_tags();
		
		$output = array();

		foreach($tags as $tag){
			$output[$tag->term_id] = $tag->name;
		}
		
		
		return $output;
	}
	
	
	public function filterExcerptLength($length){
		return $this->instance['excerpt_length'];
	}
	
	public function filterExcerptMore($more){
		
		
		if($this->instance['display_readmore']){				
			return ' ... <a href="' . get_permalink() . '">' . $this->instance['readmore_text'] . '</a>';				
		}else{
			return ' ...';
		}
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
 
 	   	$query_args = array(
			'post_type' => $instance['post_type'],
			'order' => $instance['order'],
			'orderby' => $instance['orderby'],
			'posts_per_page' => $instance['posts_per_page'],
		);
		
		if($instance['category__in']){
			$query_args['category__in'] = explode(',',$instance['category__in']);
		}
		
		if($instance['tag__in']){
			$query_args['tag__in'] = explode(',',$instance['tag__in']);
		}
		
		// The Query
		$the_query = new WP_Query($query_args);

		// The Loop
		echo '<div class="tbb-recent-posts ' . $instance['css_class'] . '">';
		if ( $the_query->have_posts() ) {
			
			add_filter( 'excerpt_length',array($this,'filterExcerptLength'), 999 );
			add_filter( 'excerpt_more',array($this,'filterExcerptMore'));
			
		    echo '<ul>';
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				echo '<li>';
				
				//thumb
				if($instance['display_thumb']){
					
					$thumb = get_the_post_thumbnail(get_the_ID(), array($instance['thumb_width'],$instance['thumb_height'],true));
					
					if(!$thumb){
						$thumb = '<img class="" src="' . $instance['thumb_placeholder'] . '" alt="'. get_the_title() .'" width="'. $instance['thumb_width'].'" height="'. $instance['thumb_height'] .'">';
						
					}
					
					echo '<a href="' . get_permalink() . '" rel="bookmark">';
					echo $thumb;
					echo '</a>';
				}
				
				//title
				echo '<h4>';
				echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
				echo '</h4>';

				
				//date
				if($instance['display_date']){
					echo '<time datetime="' . get_the_date('c') . '">' . get_the_date($instance['date_format']) . '</time>';
				}
				
				echo '<div>';
				//excerpt
				if($instance['display_excerpt']){				
					the_excerpt();				
				}		

				echo '</div>';
				echo'</li>';
			}
		    echo '</ul>';
			
			remove_filter( 'excerpt_length',array($this,'filterExcerptLength'));
			remove_filter( 'excerpt_more',array($this,'filterExcerptMore'));
			
		} else {
			// no posts found
		}
		echo '</div>';
		
		/* Restore original Post Data */
		wp_reset_postdata();
 
		echo $after_widget;
	}
    
}