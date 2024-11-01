<label for="<?php echo $this->get_field_id( $field['id'] ); ?>"><?php echo $field['title']  ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( $field['id'] ); ?>" name="<?php echo $this->get_field_name( $field['id'] ); ?>" type="text" value="<?php echo esc_attr( $value ); ?>">
