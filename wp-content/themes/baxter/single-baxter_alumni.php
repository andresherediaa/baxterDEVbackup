<?php get_header(); ?>

<?php if ( is_active_sidebar( 'baxter_alumni_header' ) ) : ?>
	<?php dynamic_sidebar( 'baxter_alumni_header' ); ?>
<?php endif; ?>

<div class="single-alumni-page">

  <?php
    if (have_posts()) :
      while (have_posts()) : the_post(); ?>

        <?php
          $alumni_type = get_post_meta( $post->ID, 'alumni_type', true );
		  $viewing_room = get_post_meta($post->ID, 'viewing_room', true);
          $portfolio_site = get_post_meta($post->ID, 'portfolio_site', true);
          $ig_link = get_post_meta( $post->ID, 'ig_link', true );
		  $year = get_post_meta($post->ID, 'year', true);
		  $alumni_gallery = array('image1', 'image2', 'image3', 'image4', 'image5', 'image6', 'image7');
          $profile_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
          if (!$profile_image) {
            $profile_image = get_template_directory_uri() . '/images/blank.png';
          }
        ?>
       
      	<div class="left-right">
          <div class="left-right-inner">

            <div class="mobile">
			  <h2 class="post-eyebrow font-medium font-eyebrow"><?php echo get_alumni_type($post); ?></h2>
			  <h1 class="post-title"><?php the_title(); ?></h1>
			  <h2 class="post-author single-alumni-program"><?php echo get_alumni_related_program($post) . ' (' . $year . ')'; ?></h2>
           	  <div class="alumni-thumb__photo">
				<img src=<?php echo $profile_image; ?> alt=<?php echo the_title(); ?> >
			  </div>
			</div>

            <div class="left-right-left">
			  <h2 class="post-eyebrow font-medium font-eyebrow"><?php echo get_alumni_type($post); ?></h2>
              <h1 class="post-title"><?php the_title(); ?></h1>
			  <h2 class="post-author single-alumni-program"><?php echo get_alumni_related_program($post) . ' (' . $year . ')'; ?></h2>
              <?php the_content(); ?>
			  <div class="alumni-social-media">
				<?php if($viewing_room != '') { ?>
				  <a href="<?php echo $viewing_room; ?>" class="alumni-link" target="_blank">Viewing Room</a>
			    <?php 
				}
				if($portfolio_site != '') { ?>
			  	  <a href="<?php echo $portfolio_site; ?>" class="alumni-link" target="_blank">Portfolio</a>
			    <?php }
			    if($ig_link != '') {
			    ?>
			  	  <a href="<?php echo $ig_link; ?>" class="alumni-link" target="_blank">
				  	<i class="fa fa-instagram" aria-hidden="true"></i>
				  </a>
			    <?php } ?>
			  </div>
            </div>

            <div class="left-right-right desktop">
				<div class="alumni-thumb__photo">
					<img src=<?php echo $profile_image; ?> alt=<?php echo the_title(); ?> >
				</div>
            </div>

          </div><!-- .left-right-inner -->
        </div><!-- .left-right -->

		<div class="alumni-image-gallery">
			<div class="alumni-image-gallery-inner">
				<ul class="alumni-img-loop">
					<?php 
					$tmpImg = '';
					$tmpId = '';
					foreach ($alumni_gallery as $key => $image_key) {
						$imgId = get_post_meta( $post->ID, $image_key, true);
						$imgSrc = wp_get_attachment_url($imgId);
						if($imgSrc != '') {
							$imgSelected = wp_get_attachment_metadata($imgId);
							$attachment = get_post($imgId);
							$width = $imgSelected['width'];
							$height = $imgSelected['height'];
							if($height > $width and $tmpImg != '' and $key < count($alumni_gallery)) {
								$tmpAttachment = get_post($tmpId);
								echo '<img src="'. $imgSrc .'" alt="'.$attachment->post_content.'" title="'.$attachment->post_title.'" class="alumni-gallery-img"/>';
								echo '<img src="'. $tmpImg .'" alt="'.$tmpAttachment->post_content.'" title="'.$tmpAttachment->post_title.'" class="alumni-gallery-img"/>';
								$tmpImg = '';
								$tmpId = '';
							}
							elseif ($height > $width and $tmpImg == '' and $key < count($alumni_gallery)) {
								$tmpImg = $imgSrc;
								$tmpId = $imgId;
							}	
							else 
								echo '<img src="'. $imgSrc .'" alt="'.$attachment->post_content.'" title="'.$attachment->post_title.'" class="alumni-gallery-img"/>';
						}	
					}
					if($tmpImg != ''){
						$tmpAttachment = get_post($tmpId);
						echo '<img src="'. $tmpImg .'" alt="'.$tmpAttachment->post_content.'" title="'.$tmpAttachment->post_title.'" class="alumni-gallery-img"/>';
					}
					?>
				</ul>
			</div>
		</div>
	
		<div class="alumni-gallery-viewer hide-gallery-viewer">
			<div class="gallery-viewer-inner">
				<div class="gallery-selected-image">
					<div class="close-alumni-gallery">
						<a>&#10005;</a>
					</div>
					<div class="alumni-image-container">
						<div class="left-arrow--alumni">
							<a><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/alumni-arrow-left.png"></a>
						</div>
						<img class="single-selected-img"/>
						<div class="right-arrow--alumni">
							<a><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/alumni-arrow-right.png"></a>
						</div>
					</div>
					<div class="artist-name--img"><?php the_title()?></div>
					<div class="title--img"></div>
					<div class="description--img"></div>
				</div>
			</div>
		</div>

      <?php endwhile;
    endif;
  ?>

</div><!-- . -->

<?php get_footer(); ?>