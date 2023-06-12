<?php get_header(); ?>


<?php
  if (have_posts()) :
    while (have_posts()) : the_post(); ?>


      <div class="left-right">
        <div class="left-right-inner">
          <?php //echo the_content(); ?>
          <!-- <iframe onload="window.parent.scrollTo(0,0)" height="2028" allowTransparency="true" frameborder="0" scrolling="no" style="width:100%;border:none"  src="https://secure.lglforms.com/form_engine/s/HBAGb4891BqfCeGcC7IR7A"><a href="https://secure.lglforms.com/form_engine/s/HBAGb4891BqfCeGcC7IR7A">Fill out my LGL Form!</a></iframe> -->
          <script type="text/javascript" src="https://secure.lglforms.com/form_engine/s/HBAGb4891BqfCeGcC7IR7A.js"></script><noscript><a href="https://secure.lglforms.com/form_engine/s/HBAGb4891BqfCeGcC7IR7A">Fill out my LGL Form!</a><br/></noscript>
        </div><!-- .left-right-inner -->
      </div><!-- .left-right -->


    <?php endwhile;
  endif;
?>


<?php get_footer(); ?>
