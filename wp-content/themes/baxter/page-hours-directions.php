<?php get_header(); ?>

<?php
  if (have_posts()) :
    while (have_posts()) : the_post(); ?>

      <?php if ( is_front_page() ) { ?>
      <?php } else { ?>
      <?php } ?>

      <section class="hero hero-home hero--center"><iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3023.990951997968!2d-74.00127294814577!3d40.71821567922972!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25989ddf271a1%3A0x82cc67fdce7c95d6!2s126+Baxter+St%2C+New+York%2C+NY+10013!5e0!3m2!1sen!2sus!4v1494785221180" width="100%" height="100%" frameborder="0" allowfullscreen="allowfullscreen"></iframe></section>
     
     <div class="content">
      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>

     </div>


    <?php endwhile;
  endif;
?>

<?php get_footer(); ?>
