<?php $aria_label = ! empty( $args['aria_label'] ) ? esc_attr( $args['aria_label'] ) : ''; ?>
<?php $aria_label_tag = ! empty( $aria_label ) ? 'aria-label="' . $aria_label . '"' : ''; ?>

<form role="search" <?php echo $aria_label_tag; ?> method="get" id="searchform-<?php echo $aria_label; ?>" action="<?php echo home_url( '/' ); ?>">
    <label for="s-<?php echo $aria_label; ?>">
       GO
    </label>
    <input type="text" value="" name="s" id="s-<?php echo $aria_label; ?>" placeholder="Search" />
    <input type="button" class="go-button" value="GO" onclick="document.getElementById('searchform-<?php echo $aria_label; ?>').submit();" />
</form>
