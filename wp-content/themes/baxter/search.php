<?php get_header(); ?>

<?php $search_query = get_search_query(); ?>

<div class="content content--search">
  <div class="search-results-page">
    <h1>Search Results</h1>
    <h2><?php echo $search_query; ?></h2>
    <?php get_search_form(); ?>
    <br>
    <hr>
  </div>
</div>

<?php
  if (have_posts()) :
    while (have_posts()) : the_post();
      get_template_part( 'wide', get_post_type() );
    endwhile;
  endif;
?>

<?php get_footer(); ?>
