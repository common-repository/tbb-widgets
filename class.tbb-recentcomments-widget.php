<?php

require_once dirname(__FILE__) . '/class.tbb-widget.php';

class TBBRecentCommentsWidget extends TBBWidget
{
	function __construct() {
		parent::__construct('recent_comments',__("TBB's Recent Comments", TBB_WIDGETS_SLUG),__('Will display recent comments with options for filtering and thumbnails.', TBB_WIDGETS_SLUG),array(
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
		                        'id'            => 'number',
		                        'type'          => 'slider',
		                        'title'         => __('Number', TBB_WIDGETS_SLUG),
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
			                    'default' => 'comment_date_gmt',
								'multi' => false,
								'options' => array(
									'user_id' => __('User ID', TBB_WIDGETS_SLUG),
									'comment_ID' => __('Comment ID', TBB_WIDGETS_SLUG),
									'comment_type' => __('Type', TBB_WIDGETS_SLUG),
									'comment_approved' => __('Approved', TBB_WIDGETS_SLUG),
									'comment_parent' => __('Parent', TBB_WIDGETS_SLUG),
									'comment_date' => __('Date', TBB_WIDGETS_SLUG),
									'comment_date_gmt' => __('Date GMT', TBB_WIDGETS_SLUG),
									'comment_post_ID' => __('Post ID', TBB_WIDGETS_SLUG),
									'comment_author' => __('Author', TBB_WIDGETS_SLUG),
									'comment_author_email' => __('Author Email', TBB_WIDGETS_SLUG),
									'comment_author_IP' => __('Author IP', TBB_WIDGETS_SLUG),
									'comment_author_url' => __('Author URL', TBB_WIDGETS_SLUG),
									'comment_content' => __('Content', TBB_WIDGETS_SLUG),
									'comment_agent' => __('Agent', TBB_WIDGETS_SLUG),
									'comment_karma' => __('Karma', TBB_WIDGETS_SLUG),
								)
			                ),
			                array(
			                    'id' => 'status',
			                    'type' => 'select',
			                    'title' => __('Status', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Change the login logo link URL.', TBB_WIDGETS_SLUG),
			                    'default' => '',
								'multi' => false,
								'options' => array(
									'' => __('Choose...', TBB_WIDGETS_SLUG),
									'hold' => __('Hold', TBB_WIDGETS_SLUG),
									'approve' => __('Approve', TBB_WIDGETS_SLUG),
									'spam' => __('Spam', TBB_WIDGETS_SLUG),
									'trash' => __('Trash', TBB_WIDGETS_SLUG),
								)
			                ),
			                array(
			                    'id' => 'type',
			                    'type' => 'select',
			                    'title' => __('Type', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Change the login logo link URL.', TBB_WIDGETS_SLUG),
			                    'default' => '',
								'multi' => false,
								'options' => array(
									'' => __('Choose...', TBB_WIDGETS_SLUG),
									'comment' => __('Comment', TBB_WIDGETS_SLUG),
									'pingback' => __('Pingback', TBB_WIDGETS_SLUG),
									'trackback' => __('Trackback', TBB_WIDGETS_SLUG),
									'pings' => __('Pings (pingback &amp; trackback)', TBB_WIDGETS_SLUG),
									'custom_type' => __('Custom Type', TBB_WIDGETS_SLUG),
								)
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
			            'title' => __('Avatar', TBB_WIDGETS_SLUG),
			            'fields' => array(
			                array(
			                    'id' => 'display_avatar',
			                    'type' => 'switch',
			                    'title' => __('Display Avatar', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Enable the advanced recent posts widget.', TBB_WIDGETS_SLUG),
			                    'default' => true
							),
		                    array(
		                        'id'            => 'avatar_size',
		                        'type'          => 'slider',
		                        'title'         => __('Size', TBB_WIDGETS_SLUG),
		                        'subtitle'      => __('This example displays the value in a text box', 'redux-framework-demo'),
		                        'desc'          => __('Slider description. Min: 0, max: 300, step: 5, default value: 75', 'redux-framework-demo'),
		                        'default'       => 45,
		                        'min'           => 1,
		                        'step'          => 1,
		                        'max'           => 512
		                    ),
			            )
        			),
					array(
			            'icon' => 'fa-cogs',
			            'title' => __('Other', TBB_WIDGETS_SLUG),
			            'fields' => array(
			                array(
			                    'id' => 'display_content',
			                    'type' => 'switch',
			                    'title' => __('Display Content', TBB_WIDGETS_SLUG),
			                    'subtitle' => __('Enable the advanced recent posts widget.', TBB_WIDGETS_SLUG),
			                    'default' => false
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
			'number' => $instance['number'],
			'status' => $instance['status'],
			'type' => $instance['type'],
		);

		
		// The Query
		$the_query = new WP_Comment_Query;
		$comments = $the_query->query( $query_args );

		// The Loop
		echo '<div class="tbb-recent-comments ' . $instance['css_class'] . '">';
		if ( $comments ) {
			
			
		    echo '<ul>';
			foreach ( $comments as $comment ) {
				echo '<li>';
				
				//thumb
				if($instance['display_avatar']){
					
					$thumb = get_avatar($comment->comment_author_email , $instance['avatar_size']);
					
					$author_url = $comment->comment_author_url;
					$comment_link = get_comment_link($comment->comment_ID );
					
					if(!$author_url){
						$author_url = $comment_link;
					}
					
					echo '<a href="' . $author_url  . '" rel="bookmark">';
					echo $thumb;
					echo '</a>';

					

				}
				
				//title
				echo '<h4>';
				echo '<a href="' . $author_url . '">' . $comment->comment_author . '</a>';
				echo ' ' . __('on',TBB_WIDGETS_SLUG) . ' ';			
				echo '<a href="' . $comment_link . '">' . get_the_title($comment->comment_post_ID ) . '</a>';
				echo '</h4>';

				
				//date
				if($instance['display_date']){
					echo '<time datetime="' . get_comment_date('c',$comment->comment_ID ) . '">' . get_comment_date($instance['date_format'],$comment->comment_ID ) . '</time>';
				}
				
				echo '<div>';
				//excerpt
				if($instance['display_content']){				
					comment_excerpt( $comment->comment_ID );			
				}		

				echo '</div>';
				echo'</li>';
			}
		    echo '</ul>';
			
			
		} else {
			// no posts found
		}
		echo '</div>';
		
 
		echo $after_widget;
	}
    
}