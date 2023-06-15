<?php get_header(); ?>

<div class="">
  <div>
    <?php if (is_active_sidebar('baxter_exhibitions_slider')) : ?>
      <?php dynamic_sidebar('baxter_exhibitions_slider'); ?>
    <?php endif; ?>
    <section class="main-programs">
      <?php
      $programs_filter = array("Call for Curators, Program conversations, Program Past Lectures");
      foreach ($programs_filter as &$value) {
        $args = array(
          'category_name' => $value,
          'post_type' => 'post',
          'post_status' => 'publish',
          'posts_per_page' => -1,
          'orderby' => 'date',
          'order' => 'ASC',
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) :
          while ($query->have_posts()) : $query->the_post();
            get_template_part('wide', get_post_type());
          endwhile;
        endif;
      }
      wp_reset_postdata();
      ?>
    </section>
    <section class="main-programs">
      <div class="thumbs thumbs-grey thumbs--exhibitions">
        <div class="thumbs-inner">
          <h1 class="font-medium">Other Programs</h1>
          <ul id="content-loop">
            <?php
            $programs_filter = array("Aperture Baxter St Next Step Award, Program Coffee Talks, Program Critique Groups, 	Program DEI Task Force, Program Call for Mid-Career, 	Program Zine and Photo Book Fair, Program Coffee Talks");
            foreach ($programs_filter as &$value) {
              $args = array(
                'category_name' => $value,
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'ASC',
              );
              $query = new WP_Query($args);
              if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                  get_template_part('content', get_post_type());
                endwhile;
              endif;
            }
            wp_reset_postdata();
            ?>
          </ul>
        </div><!-- .thumbs-inner -->
      </div>
    </section>
  </div><!-- .thumbs -->
</div>
<?php get_footer(); ?>