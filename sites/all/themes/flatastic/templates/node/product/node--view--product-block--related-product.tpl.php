<?php
global $base_url;
global $theme_root;

if (!empty($node->field_product['und'][0])) {
    $product = commerce_product_load($node->field_product['und'][0]['product_id']);
    $id = $product->product_id;
    $price = commerce_product_calculate_sell_price($product);
    $price_display = commerce_currency_format($price['amount'], $price['currency_code']);
}

$single_image = 'http://placehold.it/242x242';
if (!empty($node->field_single_image['und'])) {
    $single_image = image_style_url("product_block_242x242", $node->field_single_image['und'][0]['uri']);
}
$str_att = '';
if (isset($node->field_product_attributes)):
    if(isset($node->field_product_attributes['und'])){
        foreach ($node->field_product_attributes['und'] as $att) {
            $str_att .= ' ' . strtolower($att['taxonomy_term']->name);
        }
    }
endif;

$multiple_image = array();
if (!empty($node->field_image['und'])) {
    $multiple_image = $node->field_image['und'];
}

?>
<figure class="r_corners photoframe shadow relative d_inline_b d_md_block d_xs_inline_b tr_all_hover">
    <!--product preview-->
    <a href="<?php echo $node_url ?>" class="d_block relative pp_wrap">
        <!--hot product-->
        <?php if(theme_get_setting('demo') == 'interior'):?>
            <?php if (strpos($str_att,'hit')): ?>
                <span class="hot_interior"><?php print t('HOT');?></span>
            <?php endif; ?>
            <?php if (strpos($str_att,'specials')): ?>
                <span class="hot_interior type_2"><?php print t('SALE');?></span>
            <?php endif; ?>
        <?php else:?>
            <?php if (strpos($str_att,'hit')): ?>
                <span class="hot_stripe"><img width="82px" height="82px" src="<?php print $theme_root; ?>/images/hot_product.png" alt=""></span>
            <?php endif; ?>
            <?php if (strpos($str_att,'specials')): ?>
                <span class="hot_stripe type_2"><img width="82px" height="82px" src="<?php print $theme_root; ?>/images/sale_product_type_2.png" alt=""></span>
            <?php endif; ?>
        <?php endif;?>
        <img width="242px" height="242px" src="<?php print $single_image; ?>" class="tr_all_hover" alt="">
    </a>
    <!--description and price of product-->
    <figcaption class="t_xs_align_l">
        <h5 class="m_bottom_10"><a href="<?php echo $node_url ?>" class="color_dark ellipsis"><?php print $title; ?></a></h5>
        <div class="clearfix">
            <div class="scheme_color f_left f_size_large m_bottom_15">
                <?php
                $regular_price = '';
                $currency = commerce_currency_load(commerce_multicurrency_get_user_currency_code());
                $conversion_rate = $currency['conversion_rate'];
                if (!empty($product->field_regular_price) && ($product->field_regular_price['und'][0]['amount'] > 0)):
                    $regular_price = commerce_currency_format($product->field_regular_price['und'][0]['amount'] / $conversion_rate,$price['currency_code']);
                    ?>
                    <s><?php print $regular_price; ?></s>
                <?php endif; ?>
                <?php print $price_display; ?>
            </div>
            <!--rating-->
            <div class="horizontal_list f_right clearfix rating_list tr_all_hover">
                <?php print render($content['field_rating']);?>
            </div>
        </div>
        <div class="clearfix">
        <div class="f_left">
        <?php print render($content['field_product']);?>
        </div>
        <?php if (module_exists('flag')): ?>
            <div class="f_right">
                <?php print flag_create_link('shop', $node->nid); ?>
            </div>
        <?php endif; ?>
        </div>
    </figcaption>
</figure>
