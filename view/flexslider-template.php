
<section class="rtc-slider <?php echo $align; ?>" data-slider-animation="<?php echo $animation ?>" data-slider-width="<?php echo $width; ?>">
  <div class="flexslider">
    <ul class="slides">
    	<?php if( $slides ) : foreach ( $slides as $key => $slide ) :  ?>
			<li>
				<div class="rtc-slide-inner">
					<img src="<?php echo $slide['image_src']; ?>" />
					<div class="featured-content">
						<div class="featured-inner">
							<h2><?php echo $slide['title']; ?></h2>
							<p><?php echo $slide['content']; ?></p>
							<a class="link-mask" href="<?php echo $slide['permalink']; ?>"></a>
						</div>
					</div>
				</div>
			</li>
		<?php endforeach; endif; ?>
    </ul>
  </div>
</section>

<div class="rtc-clearfix"></div>