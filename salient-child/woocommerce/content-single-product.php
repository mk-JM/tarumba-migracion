<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }

$nectar_options        = get_nectar_theme_options(); 
$product_style         = (!empty($nectar_options['product_style'])) ? $nectar_options['product_style'] : 'classic';
$product_gallery_style = (!empty($nectar_options['single_product_gallery_type'])) ? $nectar_options['single_product_gallery_type'] : 'default';
$product_hide_sku      = (!empty($nectar_options['woo_hide_product_sku'])) ? $nectar_options['woo_hide_product_sku'] : 'false';

?>
<?php if( function_exists('wc_product_class') ) { ?>
	<div itemscope data-project-style="<?php echo esc_attr($product_style); ?>" data-hide-product-sku="<?php echo esc_attr($product_hide_sku); ?>" data-gallery-style="<?php echo esc_attr($product_gallery_style); ?>" data-tab-pos="<?php echo (!empty($nectar_options['product_tab_position'])) ? esc_attr($nectar_options['product_tab_position']) : 'default'; ?>" id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
<?php } else { ?>
	<div itemscope data-project-style="<?php echo esc_attr($product_style); ?>" data-hide-product-sku="<?php echo esc_attr($product_hide_sku); ?>" data-gallery-style="<?php echo esc_attr($product_gallery_style); ?>" data-tab-pos="<?php echo (!empty($nectar_options['product_tab_position'])) ? esc_attr($nectar_options['product_tab_position']) : 'default'; ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php } ?>
	<div data-sticky-container class="container-product-single">
		<div class="summary entry-summary sting-product-left">
			<?php
				/**
				 * woocommerce_single_product_summary hook.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				//do_action( 'woocommerce_single_product_summary' );
			?>
			<?php
				$tag = get_field('acf_product_project_type');
				switch($tag){
					case 'preventa': $label = 'Pre Venta'; break;
					case 'entrega': $label = 'Entrega Inmediata'; break;
					case 'construccion': $label = 'Construcción'; break;
					case '3dias': $label = '3 dias de locura'; break;
					case 'combo': $label = 'Combo'; break;
				}
			?>
			<div class="container-prev-info">
				<div class="product-label label-<?php echo $tag ?>">
					<?php echo $label ?>
				</div>
				<div class="product-label label-name-proyect-<?php echo $tag ?>">
					<?php the_field('acf_product_project_name'); ?>
				</div>
				<?php
					$tituloRegalo = get_field( 'titulo_regalo_departamentos' );
					$imagenRegalo = get_field( 'imagen_regalo_departamentos' );
					$nombreRegalo = get_field( 'nombre_regalo_departamentos' );
					$color_background = get_field( 'color_de_fondo_departamentos' );
					$color_text = get_field( 'color_de_fondo_texto' );
				?>
				<?php if ( !empty( $tituloRegalo ) ): ?>
				<?php endif; ?>
			</div>
			<div class="container-image-infotext">
				<?php
					/**
					 * woocommerce_before_single_product_summary hook.
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					do_action( 'woocommerce_before_single_product_summary' );
				?>
				<div class="nvcontent-gallery-single">
					<div>
						<p class="custom-product-attr">
							
							<span class="custom-product-attr-value">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/imgs/ico_dm.svg" /> <?php echo $product->get_attribute( 'dormitorios' ) ?>
							</span>
							<span class="custom-product-attr-label">
								<span class="custom-product-attr-name">Dormitorios</span>
							</span>
						</p>
						<p class="custom-product-attr">
							
							<span class="custom-product-attr-value">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/imgs/ico_bn.svg" />  <?php echo $product->get_attribute( 'banos' ) ?>
							</span>
							<span class="custom-product-attr-label">
								<span class="custom-product-attr-name">Baños</span>
							</span>
						</p>
						<?php if($areaTotal = get_field('acf_product_area_total')): ?>
						<p class="custom-product-attr">
							
							<span class="custom-product-attr-value"><img src="<?php echo get_stylesheet_directory_uri(); ?>/imgs/ico_mt.svg" /> <?php echo $areaTotal ?> m<sup>2</sup></span>
							<span class="custom-product-attr-label">
								<span class="custom-product-attr-name"></span>
							</span>
						</p>
						<?php endif ?>
						<div class="galeria_prod">
							<img src="<?php echo get_field('acf_product_floor'); ?>" alt="">
						</div>
						<div class="galeria_prod">
							<img src="<?php echo get_field('imagen_360_producto'); ?>" alt="">
						</div>
					</div>
					<?php if($imgID = get_field('acf_product_floor')): ?>
						<div class="images-border">
							<?php echo wp_get_attachment_image( $imgID, 'shop_catalog', false, array( 'class' => 'custom-product-img-floor' )) ?>
						</div>
					<?php endif ?>
					<?php if($imgID2 = get_field('acf_product_360nv')): ?>
						<div class="prod-360-image">
							<?php echo wp_get_attachment_image( $imgID2, 'shop_catalog', false, array( 'class' => 'custom-product-img-floor' )) ?>
						</div>
					<?php endif ?>
				</div>
			</div>
		</div><!-- .summary -->
	</div>
	
	

	<div data-margin-top="115" data-sticky-class="is-sticky" class="span_5 classstiky-right sting-product-right">
			<?php
				/**
				 * woocommerce_single_product_summary hook.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				do_action( 'woocommerce_single_product_summary' );
			?>
		</div><!-- .summary -->

	<?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>

