<?php
/**
 * OW Accordion Panel Block template.
 *
 * @param array  $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool   $is_preview True during backend preview render.
 * @param int    $post_id The post ID the block is rendering content against.
 *                     This is either the post ID currently being displayed inside a query loop,
 *                     or the post ID of the post hosting this block.
 * @param array $context The context provided to the block by the post or it's parent block.
 * 
 */

// Load values and assign defaults.
$panel_title = get_field( 'panel_title' );
$heading_level = $context['acf/fields']['heading_level'] ? $context['acf/fields']['heading_level'] : 'h3';
$default_open = get_field( 'default_open' );

// Support custom "anchor" values.
if ( ! empty( $block['anchor'] ) ) {
    $anchor = esc_attr( $block['anchor'] );
} else {
    $anchor = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 6);
}

$inner_blocks_template = array(
	array(
        'core/paragraph',
        array(),
        array()
    ),
);
?>

<?php if ( ! $is_preview ) { ?>
    <li
        <?php
        echo wp_kses_data(
            get_block_wrapper_attributes(
                array(
                    'id'    => 'accordion-item-' . $anchor,
                    'class' => 'ow-accordion-item' . ( $default_open == 'yes' ? ' ow-open' : '' ),
                )
            )
        );
        ?>
    >
<?php } ?>

<?php if ( ! $is_preview ) { ?>
    <div class="ow-panel-title">
        <<?php echo $heading_level; ?> class="ow-heading">
            <button 
                id="button-<?php echo $anchor; ?>" 
                data-id="<?php echo $anchor; ?>"
                aria-controls="accordion-panel-<?php echo $anchor; ?>" 
                aria-expanded="<?php echo $default_open == 'yes' ? 'true' : 'false'; ?>">
                    <span class="toggle-icon" aria-hidden="true"><span class="closed"><?php include('images/star-outline.svg'); ?></span><span class="open"><?php include('images/star-filled.svg'); ?></span></span><span class="ow-heading-inner"><?php echo $panel_title; ?></span>
            </button>
        </<?php echo $heading_level; ?>>
    </div>
    <?php } else { ?>
        <h3><span class="toggle-icon"><span><?php include('images/star-outline.svg'); ?></span></span> <?php echo $panel_title; ?></h3>
    <?php } ?>

    <?php if ( ! $is_preview ) { ?>
        <div 
            role="region"
            id="accordion-panel-<?php echo $anchor; ?>" 
            aria-labelledby="button-<?php echo $anchor; ?>" 
            class="ow-accordion-panel <?php echo $default_open == 'yes' ? '' : 'ow-hidden'; ?>"
        >
        
    <?php } ?>

        <InnerBlocks 
            class="ow-panel-content"
            template="<?php echo esc_attr( wp_json_encode( $inner_blocks_template ) ); ?>" 
        />

    <?php if ( ! $is_preview ) { ?>
        </div>
    <?php } ?>

<?php if ( ! $is_preview ) { ?>
    </li>
<?php } ?>