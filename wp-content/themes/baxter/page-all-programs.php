<?php get_header(); ?>

<div class="main-programs-page">
  <div class="main-programs-container">
    <div class="main-programs__header">
      <?php
      $args = array(
        'post_type' => 'post',
        'meta_key' => 'program_checkbox',
        'meta_value' => 'yes',
        'posts_per_page' => 1,
        'order' => 'DESC',
      );
      $post = get_posts($args)[0];
      $post_title = $post->post_title;
      $post_excerpt = $post->post_excerpt;
      $image = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
      if (!$image) {
        $image = get_template_directory_uri() . '/images/blank.png';
      }
      $postHeader = $post->ID;
      ?>
      <div class="hero hero-home main-programs__hero" style="background-image: url('<?php echo $image; ?>')">
      </div>
      <div class="main-programs__container">
        <h1 class="main-programs__container-title font-medium"><?php echo $post_title; ?></h1>
        <p class="main-programs__container-description"><?php echo $post_excerpt; ?></p>
      </div>
    </div>
    <section class="main-programs">
      <?php
      $programs_filter = array("Program Aperture Baxter,Program conversations, Program Call for Curators, Program Coffee Talks, Program DEI Task Force, Program Call for Mid-Career, Program Photo Book Share");
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
            if (get_the_ID() !== $postHeader) {  
              get_template_part('wide-all-programs', get_post_type());
            }
          endwhile;
        endif;
      }
      wp_reset_postdata();
      ?>
    </section>

    <section class="archived">
      <div class="thumbs thumbs-grey thumbs--exhibitions archived-section">
        <div class="thumbs-inner archived-section___inner">
          <h1 class="font-medium archived-section__title">Archived Programs</h1>
          <ul id="content-loop">
            <?php
            $programs_filter = array("Program Zine and Photo Book Fair, Program Past Lectures,  Program Critique Groups");
            foreach ($programs_filter as &$value) {
              $args = array(
                'category_name' => $value,
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'DESC',
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