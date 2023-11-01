<?php get_header(); ?>

<?php if ( is_active_sidebar( 'baxter_primary_events_slider' ) ) : ?>
	<?php dynamic_sidebar( 'baxter_primary_events_slider' ); ?>
<?php endif; ?>

<?php if ( is_active_sidebar( 'baxter_secondary_events_slider' ) ) : ?>
	<?php dynamic_sidebar( 'baxter_secondary_events_slider' ); ?>
<?php endif; ?>

<div class="thumbs thumbs--tight-bottom-space">
	<div class="thumbs-inner">
		<ul>
		<?php
			include_once 'programs-filter.php';
			// $press_category = get_term_by('name', 'Press', 'category');
			$latest_posts_args = array(
				'post_type' => 'post',
				// 'category' => $press_category->term_id,
				'orderby' => 'date',
				'order' => 'DESC',
				'numberposts' => 6,
				'category__not_in' => $excluded_category_ids,
			);
			$latest_posts = get_posts($latest_posts_args);
			
			foreach ($latest_posts as $post) {
				$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
				if ( ! $image) {
					$image = get_template_directory_uri() . '/images/blank.png';
				}
				$excerpt = empty($post->post_excerpt) ? wp_trim_words($post->post_content, 55, '') : $post->post_excerpt;
				$categories = get_the_category($post->ID);
				?>
				<li>
					<a href="<?php echo get_permalink($post->ID); ?>">
						<div class="thumbs__thumbnail thumbs__thumbnail--landscape" style="background-image: url(<?php echo $image; ?>);"></div>
						<?php if ( ! empty( $categories ) ) { ?>
							<h3 class="font-medium font-eyebrow"><?php echo esc_html( $categories[0]->name ); ?></h3>
						<?php } ?>
						<h4 class="font-medium"><?php echo $post->post_title; ?></h4>
						<h5><?php echo $excerpt; ?></h5>
					</a>
				</li>
				<?php
			}
		?>
		</ul>
	</div><!-- .thumbs-inner -->
</div><!-- .thumbs -->


<div class="thumbs thumbs-grey thumbs--residencies">
	<div class="thumbs-inner">
		<h2 class="font-medium font-eyebrow">ARTIST RESIDENCIES</h2>
		<h1 class="font-medium">Our Current Workspace Residents</h1>

		<ul>
			<?php
			$residency_args = array(
				'post_type' => 'baxter_residency',
				'meta_query' => array(
					array(
						'key' => 'year',
						'value' => '2021',
						'compare' => '='
					)
				),
				'orderby' => 'title',
				'numberposts' => 4
			);
			$residencies = get_posts($residency_args);
			foreach ($residencies as $residency) {
				$image = wp_get_attachment_url( get_post_thumbnail_id( $residency->ID ) );
				if ( ! $image) {
					$image = get_template_directory_uri() . '/images/blank.png';
				}

				$excerpt = empty($residency->post_excerpt) ? wp_trim_words($residency->post_content, 55, '') : $residency->post_excerpt;
				?>
				<li>
					<a href="<?php echo get_permalink($residency->ID); ?>">
						<div class="thumbs__thumbnail" style="background-image: url(<?php echo $image; ?>);"></div>
						<!--<img src="<?php echo $image; ?>">-->
						<h4 class="font-medium"><?php echo $residency->post_title; ?></h4>
						<h5><?php echo $excerpt; ?></h5>
					</a>
				</li>
				<?php
			}
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

<?php get_footer(); ?>
