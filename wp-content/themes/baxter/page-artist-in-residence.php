<?php get_header(); ?>

<?php
  if (have_posts()) :
    while (have_posts()) : the_post(); ?>

      <?php
	  	$custom = get_post_custom( $post->ID );
		  if ( isset( $custom['baxter_featured_image_2'] ) && $custom['baxter_featured_image_2'][0] ) {
			$background_image = $custom['baxter_featured_image_2'][0];
		  } else {
			$background_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
		  }
        if ($background_image) { ?>
          <section class="hero hero-home" style="background-image: url('<?php echo $background_image; ?>')"></section>
        <?php }
      ?>
     
     <div class="content">
      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>
     </div>
    <?php endwhile;
  endif;
?>

<div id="content-residency">
<div class="thumbs thumbs-grey thumbs-residency">
	<div class="thumbs-inner">
        <?php
        $residency_year = date("Y");
        if (isset($_GET['residency_year'])) $residency_year = $_GET['residency_year'];
        ?>

        <div class="gallery-form residency-form">
            <div class="gallery-form-inner">
                <select id="residency_year">
                    <option value="">Year</option>
                    <?php
                        $a = "2009";
                        $b = date("Y");
                        for($i=$a; $i<=$b; $i++) { ?>
                            <option value="<?php echo $i; ?>" <?php if ($residency_year == $i) echo 'selected'; ?>><?php echo $i; ?></option>
                        <?php }
                    ?>
                </select>
            </div><!-- .gallery-form-inner -->
        </div><!-- .gallery-form -->

		<h1 class="font-medium" id="residency-title"><?php echo $residency_year; ?> Residents</h1>

		<ul>
			<?php
			$residency_args = array(
				'post_type' => 'baxter_residency',
				'meta_query' => array(
					array(
						'key' => 'year',
						'value' => $residency_year,
						'compare' => '='
					)
				),
				'orderby' => 'title',
				'numberposts' => 4
			);
			$the_query = new WP_Query($residency_args);
			if ( $the_query->have_posts() ) :
				while ( $the_query->have_posts() ) : $the_query->the_post();
					get_template_part( 'content', get_post_type() );
				endwhile;
			endif; 
			$residencies = get_posts($residency_args);
			if (count($residencies) < 3) {
				$announcementImg = wp_get_attachment_url("21767");
				?>
				<li>
					<a class="thumbs__announcement-container" href="https://baxterstdev.wpengine.com/artist-in-residence/?residency_year=2022#content-residency">
						<div class="thumbs__announcement-thumbnail" style="background-image: url(<?php echo $announcementImg; ?>);">
						</div>
						<!--<img src="<?php echo $announcementImg; ?>">-->
					</a>
				</li>
			<?php
			}
			?>
		</ul>
	</div><!-- .thumbs-inner -->
</div><!-- .thumbs -->
</div><!-- #content-residency -->
<?php get_footer(); ?>
