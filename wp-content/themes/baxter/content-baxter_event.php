<?php
$title = $post->post_title;

$curator = get_post_meta( $post->ID, 'curator', true );
$artist = get_post_meta( $post->ID, 'artist', true );

$opening = get_post_meta( $post->ID, 'opening', true );
$story = get_post_meta( $post->ID, 'story', true );

$date1 = get_post_meta( $post->ID, 'start_date', true );
$dateTime1 = DateTime::createFromFormat('Y-m-d', $date1);

$date2 = get_post_meta( $post->ID, 'end_date', true );
$dateTime2 = DateTime::createFromFormat('Y-m-d', $date2);

$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
if ( ! $image) {
    $image = get_template_directory_uri() . '/images/blank.png';
}

$event_type = get_post_meta( $post->ID, 'event_type', true );

?>

<li class="exhibition-thumb">
    <a href='<?php echo get_permalink($post->ID); ?>'>
    <div class="exhibition-thumb__photo" style="background-image: url(<?php echo $image; ?>);"></div> 
    <?php if ($dateTime1 && $dateTime2) { ?>
        <h6 class="exhibition-thumb__date font-medium font-eyebrow"><?php echo $dateTime1->format('F j, Y'); ?>&ndash;<?php echo $dateTime2->format('F j, Y'); ?></h6>
    <?php } else if ($dateTime1) { ?>
        <h6 class="exhibition-thumb__date font-medium font-eyebrow"><?php echo $dateTime1->format('F j, Y'); ?></h6>
    <?php } ?>
    <h4 class="exhibition-thumb__title font-medium"><?php echo $title; ?></h4>
	<?php if ($event_type != 'conversation') { ?>
		<div class="exhibition-thumb__artist"><?php echo $artist; ?></div>
	<?php } ?>
    </a>
</li>
