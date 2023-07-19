<?php
$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
if ( ! $image) {
    $image = get_template_directory_uri() . '/images/blank.png';
}
$excerpt = empty($post->post_excerpt) ? wp_trim_words($post->post_content, 55, '') : $post->post_excerpt;
$eyebrow = baxter_eyebrow($post);
?>

<div class='wide-program'> 
    <a href="<?php echo get_permalink($post->ID); ?>">
        <div class='wide-program__inner'>
            <div class="wide-program__container">
                <div class='wide-program__image'><img src='<?php echo $image; ?>' alt='' /></div> 
                <div class='wide-program__details'> 
                    <h6 class="wide-program__eyebrow font-eyebrow font-medium"><?php echo $eyebrow; ?></h6>
                    <h2 class="wide-program__title font-medium"><?php echo get_the_title($post->ID); ?></h2>
                    <div><?php echo $excerpt; ?></div>
                </div> 
            </div>
        </div>
    </a>
</div> 