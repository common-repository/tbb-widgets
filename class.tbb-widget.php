<?php


class TBBWidget extends WP_Widget
{
	function __construct($slug,$name,$description,$sections,$control_ops = array()) {
		
		$this->tag = $slug;
		$this->sections = $sections;
		
		parent::__construct(
			// Base ID of your widget
			'tbb_widget_' . $slug, 

			// Widget name will appear in UI
			$name, 

			// Widget description
			array( 'description' => $description ) ,
			$control_ops
		);
	}
	
	private function getPostTypes(){
		
		$args=array(
		    'public'                => true,
		); 
		
		$post_types = get_post_types( $args, 'objects' );

		$output = array();

		foreach($post_types as $id => $type){
			
			if($id != 'revision' && $id != 'nav_menu_item')
				$output[$id] = $type->labels->name;
		}
		
		
		return $output;
	}
	
	private function printSections($instance){
		
		echo '<div class="tbb-widget panel-group" id="' . $this->id  .'-container">';
				
		if(!$instance['last_tab'])
			$instance['last_tab'] = $this->id . '-0';
		
		
		foreach($this->sections as $i => $section){
			?>
			
  		  <div class="panel panel-default">
  		    <div class="panel-heading">
  		      <h5 class="panel-title">
  		        <a data-toggle="collapse" data-parent="#<?php echo $this->id; ?>-container" href="#<?php echo $this->id . '-' . $i ?>">
  		          <i class="fa <?php echo $section['icon']; ?>"></i> <?php echo $section['title']; ?>
  		        </a>
  		      </h5>
  		    </div>
			<div id="<?php echo $this->id . '-' . $i ?>" class="panel-collapse collapse <?php echo ($this->id . '-' . $i == $instance['last_tab'])? 'in' : ''; ?>">
			      <div class="panel-body">
			        <?php $this->printSectionFields($i,$instance); ?>
			      </div>
			    </div>
			  </div>
			
			<?php
		}
		?>
		<input class="tbb-widget-last-tab" id="<?php echo $this->get_field_id( 'last_tab' ); ?>" name="<?php echo $this->get_field_name('last_tab'); ?>" type="hidden" value="<?php $instance['last_tab'] ?>">		
		<?php
		
		echo '</div>';
	}
	
	private function printSectionFields($section,$instance){
		foreach($this->sections[$section]['fields'] as $field){
			
			if ( isset( $instance[ $field['id'] ] ) ) {
				$value = $instance[ $field['id'] ];
			}
			else {
				$value = $field['default'];
			}
			
			if($field['post_types']){
				$field['options'] = array_merge($field['options'],$this->getPostTypes());
			}
			
			$field['title'].= ':';
			
			echo '<p>';
			include(dirname(__FILE__).'/views/' . $field['type'] . '.php');
			echo '</p>';
		}
	}
	
	public function form( $instance ) {
		if(!empty($this->sections)){
			if(count($this->sections) == 1){
				echo '<div class="tbb-widget" id="' . $this->id .'-container">' ;
				$this->printSectionFields(0,$instance);
				echo '</div>';
			}else{
				$this->printSections($instance);
			}
			
			if(is_int($this->number)){
				?>
				<script>
				jQuery(document).ready(function($) { 				
					$('#<?php echo $this->id; ?>-container').tbb_widget({});
				});
				</script>
		
				<?php
			}

		}
	}
	
	public function update( $new_instance, $old_instance ) {
				
		$instance = $new_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['css_class'] = strip_tags($new_instance['css_class']);
		
		if(!$instance['last_tab']){
			$instance['last_tab'] = $old_instance['last_tab'];
		}
		
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		//$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}
    
}