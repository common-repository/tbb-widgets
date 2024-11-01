<?php

$data = array();
	
foreach($field['options'] as $k => $v){
	$data[]= '{"id": "' . $k . '", "text": "' . $v . '"}';
}
?>


<label for="<?php echo $this->get_field_id( $field['id'] ); ?>"><?php echo $field['title']  ?></label>
<input placeholder="<?php _e('Choose...', TBB_WIDGETS_SLUG); ?>" data-ace-mode="<?php echo $field['ace_mode']? 'true':'false'  ?>" data-multiple="<?php echo $field['multi']? 'true':'false'  ?>" data-data='[<?php echo join($data, ', ')  ?>]' data-width="100%" class="tbb-widget-select" type='hidden' value="<?php echo $value ?>" data-init-text='' name='<?php echo $this->get_field_name( $field['id'] ); ?>' id='<?php echo $this->get_field_id( $field['id'] ); ?>'>