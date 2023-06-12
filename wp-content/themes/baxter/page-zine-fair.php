<?php get_header(); ?>

<?php
  if (have_posts()) :
    while (have_posts()) : the_post(); ?>

      <?php if ( is_front_page() ) { ?>
      <?php } else { ?>
      <?php } ?>

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

<?php
	$book_fair_args = array(
		'post_type' => 'baxter_event',
		'meta_query' => array(
			array(
				'key' => 'event_type',
				'value' => 'book_fair',
				'compare' => '='
			)
		),
		'meta_key' => 'start_date',
    'orderby' => 'meta_value',
    'order' => 'DESC',
	);
    $book_fairs = get_posts($book_fair_args);
    if (!empty($book_fairs)) { ?>
        <div class="thumbs thumbs-grey thumbs--book-fair">
	        <div class="thumbs-inner">
                <h1 class="font-medium">Past Zine and Book Fairs</h2>
                <ul>
                    <?php foreach ($book_fairs as $book_fair) {
                        $image = wp_get_attachment_url( get_post_thumbnail_id( $book_fair->ID ) );
                        if ( ! $image) {
                            $image = get_template_directory_uri() . '/images/blank.png';
                        }
        
                        $excerpt = empty($book_fair->post_excerpt) ? wp_trim_words($book_fair->post_content, 55, '') : $book_fair->post_excerpt;

                        $start_date = get_post_meta( $book_fair->ID, 'start_date', true );
                        $start_date_time = DateTime::createFromFormat('Y-m-d', $start_date);

                        $end_date = get_post_meta( $book_fair->ID, 'end_date', true );
                        $end_date_time = DateTime::createFromFormat('Y-m-d', $end_date);
                        ?>
                        <li>
                            <a href="<?php echo get_permalink($book_fair->ID); ?>">
                                <div class="thumbs__thumbnail" style="background-image: url(<?php echo $image; ?>);"></div>
                                <?php if ($start_date_time && $end_date_time) { ?>
                                  <h6 class="exhibition-thumb__date font-medium font-eyebrow"><?php echo $start_date_time->format('F j, Y'); ?> - <?php echo $end_date_time->format('F j, Y'); ?>, <?php echo get_post_meta($book_fair->ID, 'hours', true); ?></h6>
                                <?php } else if ($start_date_time) { ?>
                                  <h6 class="exhibition-thumb__date font-medium font-eyebrow"><?php echo $start_date_time->format('F j, Y'); ?>, <?php echo get_post_meta($book_fair->ID, 'hours', true); ?></h6>
                                <?php } ?>
                                <h4 class="font-medium"><?php echo $book_fair->post_title; ?></h4>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php } 
?>
<?php get_footer(); ?>
