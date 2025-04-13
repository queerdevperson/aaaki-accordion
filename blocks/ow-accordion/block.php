<?php
/**
 * OW Accordion Block template.
 *
 * @param array  $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool   $is_preview True during backend preview render.
 * @param int    $post_id The post ID the block is rendering content against.
 *                     This is either the post ID currently being displayed inside a query loop,
 *                     or the post ID of the post hosting this block.
 * @param array $context The context provided to the block by the post or it's parent block.
 * 
 * Reference for accessible accordion: https://www.hassellinclusion.com/blog/accessible-accordion-pattern/
 * Reference for parent/child ACF blocks: https://www.advancedcustomfields.com/resources/acf-blocks-using-innerblocks-and-parent-child-relationships/
 * Reference for parent/child ACF values: https://www.advancedcustomfields.com/resources/using-context-with-acf-blocks/
 * 
 */

// Support custom "anchor" values.
if ( ! empty( $block['anchor'] ) ) {
    $anchor = esc_attr( $block['anchor'] );
} else {
    $anchor = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 6);
} 
?>

<?php if ( ! $is_preview ) { ?>
    <ul
        <?php
        echo wp_kses_data(
            get_block_wrapper_attributes(
                array(
                    'id'    => 'aaaki-accordion-container-' . $anchor,
                    'class' => 'aaaki-accordion-container'
                )
            )
        );
        ?>
    >
<?php } ?>
    
    <InnerBlocks 
        allowedBlocks="<?php echo esc_attr( wp_json_encode( array( 'acf/aaaki-accordion-panel' ) ) );?>" 
        template="<?php echo esc_attr( wp_json_encode( array(array( 'acf/aaaki-accordion-panel' )) ) );?>" 
    />

<?php if ( ! $is_preview ) { ?>
    </ul>
<?php } ?>