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
      <h1 class="no-bottom-margin"><?php the_title(); ?></h1>
      <?php the_content(); ?>
     </div>
    <?php endwhile;
  endif;
?>

<div class="thumbs thumbs-grey thumbs--juried-competitions">
  <div class="thumbs-inner">
    <h1 class="font-medium">Past Juried Competitions</h2>
    <ul id="content-loop">

        <?php
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $juried_competition_args = array(
            'post_type' => 'baxter_event',
            'meta_query' => array(
              array(
                'key' => 'event_type',
                'value' => 'juried_competition',
                'compare' => '='
              )
            ),
            'meta_key' => 'start_date',
            'orderby' => 'meta_value',
            'order' => 'DESC',
            'numberposts' => -1,
            'posts_per_page' => 9,
            'paged' => $paged
          );
          $the_query = new WP_Query( $juried_competition_args ); 
          if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) : $the_query->the_post();
              get_template_part( 'thumb', get_post_type() );
            endwhile; ?>
          <?php endif; ?>
        </ul>
    </div>
    <?php
    wp_localize_script(
      'main',
      'baxter_pagination',
      array(
        'paged' => $paged + 1,
        'max_num_pages' => $the_query->max_num_pages,
        'query' => json_encode( $the_query->query )
      )
    );
  ?>
  <div class="load-more" data-content="thumb">
    <?php next_posts_link('Load More Exhibitions', $the_query->max_num_pages); ?>
  </div>
</div>

<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
