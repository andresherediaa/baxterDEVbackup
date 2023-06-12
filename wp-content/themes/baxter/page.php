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
          <section class="hero hero-home hero--center" style="background-image: url('<?php echo $background_image; ?>')"></section>
        <?php }
      ?>
     
     <div class="content">
      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>

     </div>


    <?php endwhile;
  endif;
?>

<?php get_footer(); ?>
