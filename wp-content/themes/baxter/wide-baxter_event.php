<?php
$title = $post->post_title;

$curator = get_post_meta( $post->ID, 'curator', true );
$artist = get_post_meta( $post->ID, 'artist', true );

$opening = get_post_meta( $post->ID, 'opening', true );
$story = get_post_meta( $post->ID, 'story', true );
$description = get_post_meta( $post->ID, 'description', true );

$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
if ( ! $image) {
    $image = get_template_directory_uri() . '/images/blank.png';
}

$start_date = get_post_meta( $post->ID, 'start_date', true );
$start_date_time = DateTime::createFromFormat('Y-m-d', $start_date);

$end_date = get_post_meta( $post->ID, 'end_date', true );
$end_date_time = DateTime::createFromFormat('Y-m-d', $end_date);

$excerpt = empty($post->post_excerpt) ? wp_trim_words($post->post_content, 55, '') : $post->post_excerpt;

$event_type = get_post_meta($post->ID, 'event_type', true);
$eyebrow = baxter_eyebrow($post);
?>

<div class='wide-exhibition'>
    <a href="<?php echo get_permalink($post->ID); ?>">
        <div class='wide-exhibition__inner'>
            <div class="wide-exhibition__container">
                <div class='wide-exhibition__details'>
                    <h6 class="wide-exhibition__eyebrow font-eyebrow font-medium"><?php echo $eyebrow; ?></h6>
                    <h2 class="wide-exhibition__title"><?php echo $title; ?></h2>
                    <?php if ($artist && $event_type != 'conversation') { ?>
                        <h3 class="wide-exhibition__artist font-medium"><?php echo $artist; ?></h3>
                    <?php } ?>
                    <p>
                        <?php if ($curator) { ?>
                            <span class="font-medium">Curated by:</span> <?php echo $curator; ?><br>
                        <?php } ?>
                        <?php if ($start_date_time && $end_date_time) { ?>
                            <?php if ($event_type == 'exhibition') { ?>
                                <span class="font-medium">Exhibition Dates:</span> 
                            <?php } else { ?>
                                <span class="font-medium">Dates:</span> 
                            <?php } ?>
                            <?php echo $start_date_time->format('F j, Y'); ?> - <?php echo $end_date_time->format('F j, Y'); ?><br>
                        <?php } else if ($start_date_time) { ?>
                            <?php if ($event_type == 'exhibition') { ?>
                                <span class="font-medium">Exhibition Date:</span> 
                            <?php } ?>
                            <?php echo $start_date_time->format('F j, Y'); ?><br>
                        <?php } ?>
                        <?php if ($opening) { ?>
                            <span class="font-medium">Opening Reception:</span> <?php echo $opening; ?>
                        <?php } ?>
                    </p>
                    <div><?php echo $excerpt; ?></div>
                </div>
                <div class='wide-exhibition__image'><img src='<?php echo $image; ?>' alt='' /></div>
            </div>
        </div>
    </a>
</div>