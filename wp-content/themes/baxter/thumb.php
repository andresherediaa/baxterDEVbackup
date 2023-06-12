<?php
$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
if ( ! $image) {
    $image = get_template_directory_uri() . '/images/blank.png';
}

$excerpt = empty($post->post_excerpt) ? wp_trim_words($post->post_content, 55, '') : $post->post_excerpt;

$start_date = get_post_meta( $post->ID, 'start_date', true );
$start_date_time = DateTime::createFromFormat('Y-m-d', $start_date);

$end_date = get_post_meta( $post->ID, 'end_date', true );
$end_date_time = DateTime::createFromFormat('Y-m-d', $end_date);

?>
<li>
    <a href="<?php echo get_permalink($post->ID); ?>">
        <div class="thumbs__thumbnail" style="background-image: url(<?php echo $image; ?>);"></div>
        <?php if ($start_date_time && $end_date_time) { ?>
          <h6 class="exhibition-thumb__date font-medium font-eyebrow"><?php echo $start_date_time->format('F j, Y'); ?> - <?php echo $end_date_time->format('F j, Y'); ?></h6>
        <?php } else if ($start_date_time) { ?>
          <h6 class="exhibition-thumb__date font-medium font-eyebrow"><?php echo $start_date_time->format('F j, Y'); ?></h6>
        <?php } ?>
        <h4 class="font-medium"><?php echo $post->post_title; ?></h4>
    </a>
</li>