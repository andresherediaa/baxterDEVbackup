<?php

function baxter_add_meta_boxes() {
    $posts = [ 'post', 'baxter_event', 'baxter_residency' ];
    foreach ( $posts as $post ) {
        add_meta_box(
            'baxter_featured_image_2', // id
            'Hero Image', // title
            'baxter_featured_image_2', // callback
            $post, // screen
            'side' // context
        );
    }
}
add_action( 'add_meta_boxes', 'baxter_add_meta_boxes' );

function baxter_featured_image_2($post) {
    $baxter_featured_image_2 = get_post_meta( $post->ID, 'baxter_featured_image_2', true );
    ?>
    <div id="baxter-featured-image-2">
        <input type="hidden" class="upload-txt" name="baxter_featured_image_2" id="baxter_featured_image_2" value="<?php echo $baxter_featured_image_2; ?>">
        <div class="upload-img">
            <?php if ( $baxter_featured_image_2 ) { ?>
                <img src="<?php echo $baxter_featured_image_2; ?>">
            <?php } ?>
        </div>
        <p><a href="#" class="upload-btn">Set featured image 2</a></p>
    </div>
    <?php
} 

function baxter_save_post( $post_id ) {
    if ( array_key_exists( 'baxter_featured_image_2', $_POST ) ) {
        update_post_meta(
            $post_id,
            'baxter_featured_image_2',
            $_POST['baxter_featured_image_2']
        );
    }
}
add_action( 'save_post', 'baxter_save_post' );
