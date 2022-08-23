<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$priceNormal = (int) get_field('acf_product_price_normal');
$priceInternet = (int) get_field('acf_product_price_internet');
if(!empty($priceInternet) && !empty($priceNormal)){
    $discount = 100 - floor($priceInternet * 100 / $priceNormal);
}
$separationNormalDiscount = (int) get_field( 'acf_separation_price_regular' );
?>

<div class="custom-product-summary">
    <div class="custom-product-summary-right">
        <p class="custom-product-attr custom-product-attr-one">
            <span class="custom-product-attr-name">Internet:</span>
            <span class="custom-product-attr-value">
                s/ <?php echo number_format($priceInternet, 0, '.', ','); ?>
            </span>
        </p>
        <p class="custom-product-attr custom-product-attr-two">
            <span class="custom-product-attr-name">Normal:</span>
            <span class="custom-product-attr-value normal">
                s/ <?php echo number_format($priceNormal, 0, '.', ','); ?>
            </span>
        </p>
        <?php if( !empty( $separationNormalDiscount ) ) : ?>
            <p class="custom-product-attr custom-product-attr-three">
                <span class="custom-product-attr-name">Separación:</span>
                <span class="custom-product-attr-value">s/ <?php echo number_format($separationNormalDiscount, 0, '.', ',') ?></span>
            </p>
        <?php endif; ?>
        <div class="custom-product-attr">
            <div class="custom-product-cart">
                <?php do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart' ); ?>
            </div>
        </div>
    </div>
</div>