<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

$nectar_options                = get_nectar_theme_options(); 
$product_style                 = (!empty($nectar_options['product_style'])) ? $nectar_options['product_style'] : 'classic';
$nectar_main_shop_layout       = (!empty($nectar_options['main_shop_layout'])) ? $nectar_options['main_shop_layout'] : 'no-sidebar';
$nectar_woo_desktop_cols       = (!empty($nectar_options['product_desktop_cols'])) ? $nectar_options['product_desktop_cols'] : 'default';
$nectar_woo_desktop_small_cols = (!empty($nectar_options['product_desktop_small_cols'])) ? $nectar_options['product_desktop_small_cols'] : 'default';
$nectar_woo_tablet_cols        = (!empty($nectar_options['product_tablet_cols'])) ? $nectar_options['product_tablet_cols'] : 'default';
$nectar_woo_phone_cols         = (!empty($nectar_options['product_phone_cols'])) ? $nectar_options['product_phone_cols'] : 'default';
$nectar_woo_lazy_load          = (isset( $nectar_options['product_lazy_load_images'] ) && !empty( $nectar_options['product_lazy_load_images'] )) ? $nectar_options['product_lazy_load_images'] : 'off';
$nectar_woo_rm_mobile_hover    = (isset( $nectar_options['product_mobile_deactivate_hover'] ) && !empty( $nectar_options['product_mobile_deactivate_hover'] )) ? $nectar_options['product_mobile_deactivate_hover'] : 'off';

// Default to modern flex columns.
if( 'classic' === $product_style || 'text_on_hover' === $product_style ) {
  
  if( 'no-sidebar' === $nectar_main_shop_layout ) {
    if( 'default' === $nectar_woo_desktop_cols ) {
      $nectar_woo_desktop_cols = '4';
    }
    if( 'default' === $nectar_woo_desktop_small_cols ) {
      $nectar_woo_desktop_small_cols = '3';
    }
  }

  if( 'right-sidebar' === $nectar_main_shop_layout || 
      'left-sidebar' === $nectar_main_shop_layout ) {  
    if( 'default' === $nectar_woo_desktop_cols ) {
      $nectar_woo_desktop_cols = '3';
    }
    if( 'default' === $nectar_woo_desktop_small_cols ) {
      $nectar_woo_desktop_small_cols = '3';
    }
  }
  
  if( 'fullwidth' === $nectar_main_shop_layout ) {
    if( 'default' === $nectar_woo_desktop_cols ) {
      $nectar_woo_desktop_cols = '5';
    }
  }
  
}

?>

<?php
global $product;
if ( is_product() ) {
?>
<div class="filter_depart_lpd">
  <h3>Depas relacionados</h3>
</div>
<?php
}else{
?>
<div class="filter_depart_lpd">
  <div class="filter_section">
    <ul class="tabs">
        <li><a href="#tab1"><div><img src="<?php echo get_stylesheet_directory_uri(); ?>/imgs/ico_state.svg" alt=""><span>Estado</span></div></a></li>
        <li><a href="#tab2"><div><img src="<?php echo get_stylesheet_directory_uri(); ?>/imgs/ico_dist.svg" alt=""><span>Distrito</span></div></a></li>
        <li><a href="#tab3"><div><img src="<?php echo get_stylesheet_directory_uri(); ?>/imgs/ico_bedroom.svg" alt=""><span>Dormitorios</span></div></a></li>
    </ul>

    <div class="tab_container">
        <div class="tab_content" id="tab1">
            <!-- filter state -->
            <?php if ( is_active_sidebar( 'filter-state' ) ) : ?>
                <div id="header-widget-area" class="chw-widget-area widget-area" role="complementary">
                  <?php dynamic_sidebar( 'filter-state' ); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="tab_content" id="tab2">
            <!-- filter district -->
            <?php if ( is_active_sidebar( 'filter-district' ) ) : ?>
                <div id="header-widget-area" class="chw-widget-area widget-area" role="complementary">
                  <?php dynamic_sidebar( 'filter-district' ); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="tab_content" id="tab3">
            <!-- filter district -->
            <?php if ( is_active_sidebar( 'filter-bedroom' ) ) : ?>
                <div id="header-widget-area" class="chw-widget-area widget-area" role="complementary">
                  <?php dynamic_sidebar( 'filter-bedroom' ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- filter store -->
    <?php if ( is_active_sidebar( 'filter-store' ) ) : ?>
        <div id="header-widget-area" class="chw-widget-area widget-area" role="complementary">
          <?php dynamic_sidebar( 'filter-store' ); ?>
        </div>
    <?php endif; ?>
  </div>
  <h3>Escoge tu depa aquí</h3>
</div>
<?php  
}
?>
<?php if(function_exists('wc_get_loop_prop')) { ?>
  <ul class="products columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) );?>" data-n-lazy="<?php echo esc_attr($nectar_woo_lazy_load); ?>" data-rm-m-hover="<?php echo esc_attr($nectar_woo_rm_mobile_hover); ?>" data-n-desktop-columns="<?php echo esc_attr( $nectar_woo_desktop_cols ); ?>" data-n-desktop-small-columns="<?php echo esc_attr( $nectar_woo_desktop_small_cols ); ?>" data-n-tablet-columns="<?php echo esc_attr( $nectar_woo_tablet_cols ); ?>" data-n-phone-columns="<?php echo esc_attr( $nectar_woo_phone_cols ); ?>" data-product-style="<?php echo esc_attr( $product_style ); ?>">
<?php } else { ?>
  <ul class="products" data-product-style="<?php echo esc_attr( $product_style ); ?>">
<?php } ?>


