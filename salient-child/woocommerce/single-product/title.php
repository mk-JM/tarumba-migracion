<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce/Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$tag = get_field('acf_product_project_type');
switch($tag){
    case 'preventa': $label = 'Pre Venta'; break;
    case 'entrega': $label = 'Entrega Inmediata'; break;
    case 'construccion': $label = 'Construcción'; break;
    case '3dias': $label = '3 dias de locura'; break;
	case 'combo': $label = 'Combo'; break;
}
?>

<div class="custom-product-head">
    <div class="custom-product-head-left">
        <div class="custom-product-title">
            Dpto. <?php the_field('acf_product_project_number') ?>
        </div>
    </div>

</div>