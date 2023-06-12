<?php get_header(); ?>


<div class="">

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
          if ( ! $background_image) {
            $background_image = get_template_directory_uri() . '/images/blank.png';
          }
        ?>
        <section class="hero hero-home hero--center" style="background-image: url('<?php echo $background_image; ?>')">
          <div class="hero-overlay">
            <h1 class="hero__title"><?php echo the_title(); ?></h1>
          </div>
        </section><!-- .hero .hero-home -->

        <div class="content">
          <?php echo the_content(); ?>
        </div><!-- .left-right -->


      <?php endwhile;
    endif;
  ?>

</div><!-- . -->


<?php get_footer(); ?>
