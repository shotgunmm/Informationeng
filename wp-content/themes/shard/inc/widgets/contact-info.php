<?php
class ABdev_contact_info extends WP_Widget {
	
	function ABdev_contact_info(){
		$widget_ops = array(
			'classname' => 'contact-info', 
			'description' => __('Contact informations with icons', 'ABdev_shard' ),
		);
		$control_ops = array(
			'id_base' => 'contact-info',
		);
		$this->WP_Widget('contact-info', __('Contact Info', 'ABdev_shard' ), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$telephone = isset($instance['telephone'])?$instance['telephone']:'';
		$fax = isset($instance['fax'])?$instance['fax']:'';
		$email = isset($instance['email'])?$instance['email']:'';
		$company = isset($instance['company'])?$instance['company']:'';
		$address = isset($instance['address'])?$instance['address']:'';
		$state = isset($instance['state'])?$instance['state']:'';
		$map_link = isset($instance['map_link'])?$instance['map_link']:'';
		$map_text = isset($instance['map_text'])?$instance['map_text']:'';
		
		echo $before_widget;

		if($title){
			echo $before_title.$title.$after_title;
		}
		
		
		?>
		<div class='contact_info_widget'>
			<?php
			echo (!empty($telephone))? '<div><span>'.__('Tel:', 'ABdev_shard').'</span>'.$telephone.'</div>' : '';
			echo (!empty($fax))? '<div><span>'.__('Fax:', 'ABdev_shard').'</span>'.$fax.'</div>' : '';
			echo (!empty($email))? '<div class="contact_info_widget_email"><span>'.__('E-mail:', 'ABdev_shard').'</span><a href="mailto:'.$email.'">'.$email.'</a></div>' : '';
			echo (!empty($company))? '<div>'.$company.'</div>' : '';
			echo (!empty($address))? '<div>'.$address.'</div>' : '';
			echo (!empty($state))? '<div>'.$state.'</div>' : '';
			$text_out=(!empty($map_text)) ? $map_text : __('Show on Map', 'ABdev_shard');
			echo (!empty($map_link))? '<div><a href="'.$map_link.'">'.$text_out.'</a></div>' : '';
			?>
		</div>
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance){
		$instance = array();
		$instance['title'] = $new_instance['title'];
		$instance['telephone'] = $new_instance['telephone'];
		$instance['fax'] = $new_instance['fax'];
		$instance['email'] = $new_instance['email'];
		$instance['company'] = $new_instance['company'];
		$instance['address'] = $new_instance['address'];
		$instance['state'] = $new_instance['state'];
		$instance['map_link'] = $new_instance['map_link'];
		$instance['map_text'] = $new_instance['map_text'];

		return $instance;
	}

	
	function form($instance){
		$defaults = array('title' => 'Contacts');
		$instance = wp_parse_args((array) $instance, $defaults); 

		$telephone = isset($instance['telephone'])?$instance['telephone']:'';
		$fax = isset($instance['fax'])?$instance['fax']:'';
		$email = isset($instance['email'])?$instance['email']:'';
		$company = isset($instance['company'])?$instance['company']:'';
		$address = isset($instance['address'])?$instance['address']:'';
		$state = isset($instance['state'])?$instance['state']:'';
		$map_link = isset($instance['map_link'])?$instance['map_link']:'';
		$map_text = isset($instance['map_text'])?$instance['map_text']:'';
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ABdev_shard');?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('telephone'); ?>"><?php _e('Telephone:', 'ABdev_shard');?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('telephone'); ?>" name="<?php echo $this->get_field_name('telephone'); ?>" value="<?php echo $telephone; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e('Fax:', 'ABdev_shard');?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" value="<?php echo $fax; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('E-mail:', 'ABdev_shard');?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo $email; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('company'); ?>"><?php _e('Company name:', 'ABdev_shard');?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('company'); ?>" name="<?php echo $this->get_field_name('company'); ?>" value="<?php echo $company; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'ABdev_shard');?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" value="<?php echo $address; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('state'); ?>"><?php _e('State:', 'ABdev_shard');?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('state'); ?>" name="<?php echo $this->get_field_name('state'); ?>" value="<?php echo $state; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('map_link'); ?>"><?php _e('Map link:', 'ABdev_shard');?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('map_link'); ?>" name="<?php echo $this->get_field_name('map_link'); ?>" value="<?php echo $map_link; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('map_text'); ?>"><?php _e('Map text:', 'ABdev_shard');?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('map_text'); ?>" name="<?php echo $this->get_field_name('map_text'); ?>" value="<?php echo $map_text; ?>" />
		</p>

		
	<?php
	}
}


function ABdev_contact_info_widget(){
	register_widget('ABdev_contact_info');
}

add_action('widgets_init', 'ABdev_contact_info_widget');