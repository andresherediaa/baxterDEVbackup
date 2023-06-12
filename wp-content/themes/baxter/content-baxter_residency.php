<?php
$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
if ( ! $image) {
    $image = get_template_directory_uri() . '/images/blank.png';
}

$excerpt = empty($post->post_excerpt) ? wp_trim_words($post->post_content, 55, '') : $post->post_excerpt;
?>
<li>
    <a href="<?php echo get_permalink($post->ID); ?>">
        <div class="thumbs__thumbnail" style="background-image: url(<?php echo $image; ?>);"></div>
        <h4 class="font-medium"><?php echo $post->post_title; ?></h4>
        <h5><?php echo $excerpt; ?></h5>
    </a>
</li>