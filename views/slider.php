<div>
<label for="<?php echo $this->get_field_id( $field['id'] ); ?>"><?php echo $field['title']  ?></label><br>
<input class="noUi-value" type='number' value="<?php echo $value ?>" name='<?php echo $this->get_field_name( $field['id'] ); ?>' id='<?php echo $this->get_field_id( $field['id'] ); ?>'>
<div data-start="<?php echo $value ?>" data-step="<?php echo $field['step']; ?>" data-min="<?php echo $field['min']; ?>" data-max="<?php echo $field['max']; ?>" class="tbb-widget-slider" id="<?php echo $this->get_field_id( $field['id'] ); ?>-slider"></div>
<div style="clear:both;"></div>
</div>