<?php get_header(); ?>


<h1>Archive</h1>


<?php if ( is_post_type_archive() ) : ?>
  <h1><?php post_type_archive_title(); ?></h1>
<?php endif; ?>

<?php get_footer();
