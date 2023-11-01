<?php get_header(); ?>

<?php
include_once 'programs-filter.php';
$current_article_args = array(
    'post_type' => 'post',
    'tax_query' => array(
        array(
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms' => array('post-format-video'),
            'operator' => 'NOT IN'
        ),
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $programs_filter,
            'operator' => 'NOT IN'
        )
    ),
    'orderby' => 'date',
    'order' => 'DESC',
    'numberposts' => 1
);
$current_articles = get_posts($current_article_args);
if (!empty($current_articles)) {
    $current_article = $current_articles[0];

    $custom = get_post_custom( $current_article->ID );
    if ( isset( $custom['baxter_featured_image_2'] ) && $custom['baxter_featured_image_2'][0] ) {
        $background_image = $custom['baxter_featured_image_2'][0];
    } else {
        $background_image = wp_get_attachment_url( get_post_thumbnail_id( $current_article->ID ) );
    }
    if ( ! $background_image) {
        $background_image = get_template_directory_uri() . '/images/blank.png';
    }
    ?>
    <section class="hero hero-home" style="background-image: url('<?php echo $background_image; ?>')">
        <div class="hero-overlay">
            <a href="<?php echo get_permalink($current_article->ID); ?>">
                <h1><?php echo $current_article->post_title; ?></h1>
            </a>
        </div>
    </section>
    <?php
} 
?>

<div class="content">
    &nbsp;
</div>

<div class="thumbs">
	<div class="thumbs-inner">
		<ul id="content-loop">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $offset = (get_query_var('paged')) ? 1 : -1;
            $args = array(
                'post_type' => 'post',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'post_format',
                        'field' => 'slug',
                        'terms' => array('post-format-video'),
                        'operator' => 'NOT IN'
                    ),
                    array(
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' => $programs_filter,
                        'operator' => 'NOT IN'
                    )
                ),
                'orderby' => 'date',
                'order' => 'DESC',
                // 'offset' => $offset,
                'numberposts' => -1,
                'posts_per_page' => 9,
                'paged' => $paged
            );
            $the_query = new WP_Query($args);
            if ($the_query->have_posts()) :
                while ($the_query->have_posts()) : $the_query->the_post();
                    get_template_part( 'content', get_post_type() );
                endwhile;
            endif;
            ?>
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
            

		</ul>
        <div class="load-more" data-content="content">
            <?php next_posts_link('Load More Articles', $the_query->max_num_pages); ?>
        </div>
        <?php wp_reset_postdata(); ?>
	</div><!-- .thumbs-inner -->
</div><!-- .thumbs -->

<?php get_footer(); ?>
