<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php
	
	$nectar_options = get_nectar_theme_options();
	
	nectar_meta_viewport();
	
	// Shortcut icon fallback.
	if ( ! empty( $nectar_options['favicon'] ) && ! empty( $nectar_options['favicon']['url'] ) ) {
		echo '<link rel="shortcut icon" href="'. esc_url( nectar_options_img( $nectar_options['favicon'] ) ) .'" />';
	}
	
	wp_head();
	
?>
</head><?php

$nectar_header_options = nectar_get_header_variables();

?><body <?php body_class(); ?> <?php nectar_body_attributes(); ?>>
	
	<?php
	
	nectar_hook_after_body_open();
	
	nectar_hook_before_header_nav();
	
	// Boxed theme option opening div.
	if ( $nectar_header_options['n_boxed_style'] ) {
		echo '<div id="boxed">';
	}
	
	get_template_part( 'includes/partials/header/header-space' );
	
	?>
	<div id="header-outer" <?php nectar_header_nav_attributes(); ?>>
		<?php
		
		get_template_part( 'includes/partials/header/secondary-navigation' );
		
		if ('ascend' !== $nectar_header_options['theme_skin'] && 
			  'left-header' !== $nectar_header_options['header_format']) {
			get_template_part( 'includes/header-search' );
		}
		
		get_template_part( 'includes/partials/header/header-menu' );
		
		
		?>
		
	</div>

	<?php
	global $product;
	$banner = get_stylesheet_directory_uri() . '/img/banner-product-detail.jpg';
    if ( is_product() ) {
	  
	?>
	<div id="page-header-wrap" data-animate-in-effect="none" data-midnight="light" class="" style="height: 390px;"><div id="page-header-bg" class="not-loaded " data-padding-amt="normal" data-animate-in-effect="none" data-midnight="light" data-text-effect="none" data-bg-pos="center" data-alignment="center" data-alignment-v="middle" data-parallax="0" data-height="390" style="background-color: #000; height:390px;">					<div class="page-header-bg-image-wrap" id="nectar-page-header-p-wrap" data-parallax-speed="fast">
						<div class="page-header-bg-image" style="background-image: url(https://lpd.xpress.ws/wp-content/uploads/bg_header_shop.jpg);"></div>
					</div> 
				<div class="container">
			<div class="row">
				<div class="col span_6 ">
					<div class="inner-wrap">
						<h1>Estamos en la mejor ubicación para tu nuevo Depa</h1>
					</div>

										</div>
				</div>

				


			</div>
</div>

</div>
	<?php
	  
	}
	?>
	<?php
	
	if ( ! empty( $nectar_options['enable-cart'] ) && '1' === $nectar_options['enable-cart'] ) {
		get_template_part( 'includes/partials/header/woo-slide-in-cart' );
	}
	
	if ( 'ascend' === $nectar_header_options['theme_skin'] || 
		   'left-header' === $nectar_header_options['header_format'] && 
		   'false' !== $nectar_header_options['header_search'] ) {
		get_template_part( 'includes/header-search' ); 
	}
	
  get_template_part( 'includes/partials/footer/body-border' );
  
	?>
	<div id="ajax-content-wrap">
<?php
		
		nectar_hook_after_outer_wrap_open();
