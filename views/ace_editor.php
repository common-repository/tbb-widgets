<div>
<label for="<?php echo $this->get_field_id( $field['id'] ); ?>"><?php echo $field['title']  ?></label>
<div class="tbb-widget-editor" id="<?php echo $this->get_field_id( $field['id'] ); ?>-editor"><?php echo htmlentities($value) ?></div>
<textarea class="tbb-widget-editor-textarea" id="<?php echo $this->get_field_id( $field['id'] ); ?>" name="<?php echo $this->get_field_name( $field['id'] ); ?>" style="display: none;"><?php echo $value ?></textarea>
</div>
