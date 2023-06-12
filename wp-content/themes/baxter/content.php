<?php
$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
if ( ! $image) {
    $image = get_template_directory_uri() . '/images/blank.png';
}

if ( has_post_format( 'video' )) {
    $image = baxter_thumbnail_from_video($post);
}

$excerpt = empty($post->post_excerpt) ? wp_trim_words($post->post_content, 55, '') : $post->post_excerpt;

$categories = get_the_category($post->ID);
?>
<li>
    <a href="<?php echo get_permalink($post->ID); ?>">
        <div class="thumbs__thumbnail thumbs__thumbnail--landscape" style="background-image: url(<?php echo $image; ?>);"></div>
        <?php if ( ! empty( $categories ) ) { ?>
            <h3 class="font-medium font-eyebrow"><?php echo esc_html( $categories[0]->name ); ?></h3>
        <?php } ?>
        <h4 class="font-medium"><?php echo get_the_title($post->ID); ?></h4>
        <h5><?php echo $excerpt; ?></h5>
    </a>
</li>