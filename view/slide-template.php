
  <section class="group" data-slide-number='<%= slide_number %>' >

  	<header class="header">
  		<h3><%= slide_title %><span class="spinner header-loader"></span></h3>
  	</header>

    <section class="content clearfix" >

		<div class="slider-preview">
			<span class="loader2"></span>
			<% if(image_src){ %>
			<img width="" height="" class="slider-image" src="<%= image_src %>" alt="">
			<% } %>
			<input type="hidden" class="slider-image-input" value="" >
		</div>

		<div class="slider-fields clearfix">
			<div class="slide-image row">
				<label for=""><?php _e( 'Choose Image', 'rtcamp' ); ?> : </label>
				<input class="rtc-choose-image" type='text' name='<%= image_src_name %>' value='<%= image_src %>' />
				<button class="button-secondary upload_image_button"><?php _e('Choose Slider Image', 'rtcamp'); ?></button>
				<button class="button-secondary remove-slider-image"><?php _e( 'Remove', 'rtcamp' ); ?></button>
			</div>
			<div class="slide-title row">
				<label for=""><?php _e( 'Slide Title', 'rtcamp' ); ?> :</label>
				<input type="text" class="title" name="<%= slide_title_name %>" placeholder="<?php _e( 'Enter Title', 'rtcamp' ); ?>" value="<%= slide_title %>">
			</div>
			<div class="slide-content row">
				<label for=""><?php _e( 'Slide Content' , 'rtcamp' ); ?> :</label>
				<textarea name="<%= slide_content_name %>" class="content" placeholder="<?php _e( 'Enter some content', 'rtcamp' ); ?>" ><%= slide_content %></textarea>
			</div>
			<div class="slide-permalink row">
				<label for=""><?php _e( 'Slider Link', 'rtcamp' ); ?> :</label>
				<input type="text" class="permalink" name="<%= slide_permalink_name %>" placeholder="<?php _e( 'Enter Slide Link', 'rtcamp' ); ?>" value="<%= slide_permalink %>">
			</div>
		</div>
		<footer class="save-delete">
			<button class="button-primary delete-slide"><?php _e( 'Delete', 'rtcamp' ); ?></button>
			<span class="loader"></span>
		</footer>

    </section>

  </section>

