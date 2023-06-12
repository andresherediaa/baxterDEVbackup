<?php
/**
 * The main template file.
 *
 * @package baxter
 */
?>

<?php get_header(); ?>

<div class="thumbs">
	<div class="thumbs-inner">
		<ul id="content-loop">
<?php
  if (have_posts()) :
    while (have_posts()) : the_post();
        get_template_part( 'content', get_post_type() );
    endwhile;
  endif;
?>
		</ul>
	</div><!-- .thumbs-inner -->
</div><!-- .thumbs -->

<?php get_footer(); ?>
