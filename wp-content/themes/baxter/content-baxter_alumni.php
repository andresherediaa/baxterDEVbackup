<?php
$title = $post->post_title;
$year = get_post_meta($post->ID, 'year', true);

$image = wp_get_attachment_url(get_post_meta( $post->ID, 'image1', true));
if ( ! $image) {
  $image = get_template_directory_uri() . '/images/blank.png';
}

?>

<li class="alumni-thumb">
  <a class="alumni-thumb__link" href='<?php echo get_permalink($post->ID); ?>'>
		<div class="alumni-thumb__photo thumbs__thumbnail thumbs__thumbnail--landscape" style="background-image: url(<?php echo $image; ?>);"></div>
		<h6 class="alumni-thumb__program font-medium"><?php echo get_alumni_related_program($post); ?></h6> 
		<h3 class="alumni-thumb__title font-medium"><?php echo $title; ?></h3>
	  	<h6 class="alumni-thumb__year font-medium"><?php echo $year; ?></h6>
  </a>
</li>