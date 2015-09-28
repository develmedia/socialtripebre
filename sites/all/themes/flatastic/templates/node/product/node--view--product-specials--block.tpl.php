<?php
$single_image = 'http://placehold.it/242x242';
if (!empty($node->field_single_image['und'])) {
    $single_image = image_style_url("product_block_242x242", $node->field_single_image['und'][0]['uri']);
}

if (!empty($node->field_product['und'][0])) {
    $product = commerce_product_load($node->field_product['und'][0]['product_id']);
    $id = $product->product_id;
    $price = commerce_product_calculate_sell_price($product);
    $price_display = commerce_currency_format($price['amount'], $price['currency_code']);
}
?>

<div class="specials_item">
    <a href="<?php print $node_url;?>" class="d_block d_xs_inline_b wrapper m_bottom_20">
        <img width="242px" height="242px" class="tr_all_long_hover" src="<?php print $single_image;?>" alt="">
    </a>
    <h5 class="m_bottom_10"><a href="<?php print $node_url;?>" class="color_dark ellipsis"><?php print $title;?></a></h5>
    <p class="f_size_large m_bottom_15">
        <?php
        $regular_price = '';
        $currency = commerce_currency_load(commerce_multicurrency_get_user_currency_code());
        $conversion_rate = $currency['conversion_rate'];
        if (!empty($product->field_regular_price) && ($product->field_regular_price['und'][0]['amount'] > 0)):
            $regular_price = commerce_currency_format($product->field_regular_price['und'][0]['amount'] / $conversion_rate,$price['currency_code']);
            ?>
            <s><?php print $regular_price; ?></s>
        <?php endif; ?>
        <span class="scheme_color"><?php print $price_display;?></span></p>

    <?php print render($content['field_product']); ?>
</div>
