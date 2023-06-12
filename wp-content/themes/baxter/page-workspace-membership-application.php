<?php get_header(); ?>


<?php
  if (have_posts()) :
    while (have_posts()) : the_post(); ?>


      <div class="left-right">
        <div class="left-right-inner center">
          <?php //echo the_content(); ?>
          <!-- <iframe onload="window.parent.scrollTo(0,0)" height="1686" allowTransparency="true" frameborder="0" scrolling="no" style="width:100%;border:none"  src="https://secure.lglforms.com/form_engine/s/9L4X5GwCH8SdAIfZz0ihLQ"><a href="https://secure.lglforms.com/form_engine/s/9L4X5GwCH8SdAIfZz0ihLQ">Fill out my LGL Form!</a></iframe> -->
          <script type="text/javascript" src="https://secure.lglforms.com/form_engine/s/9L4X5GwCH8SdAIfZz0ihLQ.js"></script><noscript><a href="https://secure.lglforms.com/form_engine/s/9L4X5GwCH8SdAIfZz0ihLQ">Fill out my LGL Form!</a><br/></noscript>
        </div><!-- .left-right-inner -->
      </div><!-- .left-right -->


    <?php endwhile;
  endif;
?>


<?php get_footer(); ?>
