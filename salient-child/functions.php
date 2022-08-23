<?php

add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles', 100);

function salient_child_enqueue_styles() {
		
		$nectar_theme_version = nectar_get_theme_version();
		wp_enqueue_style( 'salient-child-style', get_stylesheet_directory_uri() . '/style.css', '', $nectar_theme_version );
		
    if ( is_rtl() ) {
   		wp_enqueue_style(  'salient-rtl',  get_template_directory_uri(). '/rtl.css', array(), '1', 'screen' );
		}
}

/* ------ footer administrable ------ */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Configuración',
		'menu_title'	=> 'Configuración pagina',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}


 /* ---------------------- header font scripts  ---------------------- */
add_action('wp_head', 'font_google_load_function');
function font_google_load_function(){
?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Titillium+Web:wght@200;300;400;600;700&display=swap" rel="stylesheet">
<?php
};


 /* ---------------------- shorcode proyectos home  ---------------------- */


 add_action( 'init', 'lpproyectoshome' );

 function lpproyectoshome(){
     add_shortcode('lpproyectoshome', 'lp_proyectos_home');
 }

 if(!function_exists('lp_proyectos_home')) {
     function lp_proyectos_home()
     {
         
         ?>


        <div class="lp__home_proyectos">
        
            <?php
                
				$args = array(  
					'post_type' => 'proyect',
					'post_status' => 'publish',
					'order' => 'ASC', 
				);
			
				$loop = new WP_Query( $args ); 
					
				while ( $loop->have_posts() ) : $loop->the_post(); 
			?>
					

				<div class="lp__home_proyectos_proyecto">
					<div class="lp__home_proyectos_proyecto_info" style="background: url(<?php echo get_field('imagen_proyecto'); ?>);">
						<img class="certificado" src="<?php echo get_field('certificacion_logo_proyecto'); ?>" alt="">
						<p class="estado" style="background-color:<?php the_field('color_estado_proyecto'); ?>; color:<?php the_field('color_texto_estado_proyecto'); ?>"><?php echo the_field('estado_del_proyecto'); ?></p>
						<img class="logo" src="<?php echo get_field('logo_del_proyecto'); ?>" alt=" "/>
					</div>
					<div class="lp__home_proyectos_proyecto_info-grey">
						<h3 class="distrito"><?php echo get_field('distrito_proyectos'); ?></h3>
						<div class="direccion">
							<p><?php echo the_field('direccion_proyecto'); ?></p>
						</div>
					</div>
					
					
					<li><a href="<?php the_permalink(); ?>">VER PROYECTO</a></li>
				</div>


			<?php
				endwhile;
			
				wp_reset_postdata(); 

            ?>

        </div>


         <?php

    }
}




 /* ---------------------- shorcode noticias  ---------------------- */


 add_action( 'init', 'lphomeentradas' );

 function lphomeentradas(){
     add_shortcode('lphomeentradas', 'lp_home_entradas');
 }

 if(!function_exists('lp_home_entradas')) {
     function lp_home_entradas()
     {
         
         ?>
				
				<div class="lp_home_entradas-cont">
					<li><a href="#">
						<img src="https://lpd.xpress.ws/wp-content/uploads/Rectangle-9.png" alt="">
						<h3>Conoce las 8 mejores tendencias para decorar tu departamento en 2022</h3>
					</a></li>
					<li><a href="#">
						<img src="http://lpd.xpress.ws/wp-content/uploads/Rectangle-8.png" alt="">
						<h3>Conoce las 8 mejores tendencias para decorar tu departamento en 2022</h3>
					</a></li>
					<li><a href="#">
						<img src="https://lpd.xpress.ws/wp-content/uploads/Rectangle-7.png" alt="">
						<h3>Conoce las 8 mejores tendencias para decorar tu departamento en 2022</h3>
					</a></li>
				</div>

       

         <?php

    }
}




 /* ---------------------- shorcode proyectos home  ---------------------- */


 add_action( 'init', 'lphomeproyectosbuscador' );

 function lphomeproyectosbuscador(){
     add_shortcode('lphomeproyectosbuscador', 'lp_home_proyectos_buscador');
 }

 if(!function_exists('lp_home_proyectos_buscador')) {
     function lp_home_proyectos_buscador()
     {
         ?>
				<form action="<?php echo get_site_url();?>/tienda/" class="<?php echo ( !is_front_page() ) ? '' : 'header-hidden' ?>">
					<div class="lp_home_proyectos_buscador">
						<select name="filter_distrito" id="cars">
						<?php
							$taxonomies = get_terms( array(
								'taxonomy' => 'pa_distrito',
								'hide_empty' => true
							) );
							if ( !empty($taxonomies) ) :
							foreach( $taxonomies as $category ) {
						?>
							<option value="<?php echo $category->slug;?>"><?php echo $category->name;?></option>
						<?php
							}
							endif;
						?>
						</select>
						<button>
							<img src="http://lpd.xpress.ws/wp-content/uploads/Group-1.svg" alt=" "/>
						</button>
					</div>
				</form>
         <?php

    }
}





function create_posttype_proyectos() {
 
    register_post_type( 'proyect',
        array(
            'labels' => array(
                'name' => __( 'Proyectos' ),
                'singular_name' => __( 'Proyecto' ),
                'add_new_item' => __( 'Add New proyecto')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array( 'slug' => 'venta-departamento' ),
			'supports' => array('title', 'editor', 'page-attributes'),
			'hierarchical' => true
        )
    );
}

add_action( 'init', 'create_posttype_proyectos');

function ProyectosShortcode() {
	return '<p>Hello World!</p>';
}
add_shortcode('proyectos', 'ProyectosShortcode');

function themeRegisterMenus() {
	register_nav_menus(
		array(
			'new-menu-primary' => __('Nuevo Menú Principal'),
		)
	);
}

add_action('init', 'themeRegisterMenus');


//acf fields
include_once 'includes/custom-fields/acf_fields.php'; 



/*** *****/

function woocommerce_template_single_add_to_cart(){
	return;
}

function woocommerce_template_single_meta() {
	return;
}

function nectar_product_thumbnail_material() {

	global $product;
	global $woocommerce;
	global $product_hover_alt_image;
	global $nectar_quick_view_in_use;
	?>

	<div class="product-wrap <?php if($product->get_stock_status() === 'outofstock') echo 'custom-product-out-of-stock' ?>">
		<?php

		$product_second_image = null;
		if ( $product_hover_alt_image == '1' ) {

			if ( $woocommerce && version_compare( $woocommerce->version, '3.0', '>=' ) ) {
				$product_attach_ids = $product->get_gallery_image_ids();
			} else {
				$product_attach_ids = $product->get_gallery_attachment_ids();
			}
			$numImages = count($product_attach_ids);

			if ($numImages) {
				$random1 = rand(0, $numImages - 1);
				$product_second_image1 = wp_get_attachment_image( $product_attach_ids[$random1], 'shop_catalog', false, array( 'class' => 'attachment-woocommerce_thumbnail size-woocommerce_thumbnail' ) );
			}
		}
		
		$priceNormal = (int) get_field('acf_product_price_normal');
		$priceInternet = (int) get_field('acf_product_price_internet');
		$tag = get_field('acf_product_project_type');
		$tituloRegalo = get_field( 'titulo_regalo_departamentos' );
		$imagenRegalo = get_field( 'imagen_regalo_departamentos' );
		$nombreRegalo = get_field( 'nombre_regalo_departamentos' );
		$color_background = get_field( 'color_de_fondo_departamentos' );
		$color_text = get_field( 'color_de_fondo_texto' );
		$coundDownInit = get_field( 'fecha_inicial_contador' );
		$coundDownFinal = get_field( 'fecha_final_contador' );
		$coundDownImage = get_field( 'imagen_contador' );

		$date = new DateTime("now", new DateTimeZone('America/Lima'));
		$nowDate = $date->format('m/d/Y H:i:s');
		$validateNowDate = strtotime($nowDate);
		$validateFinalCoundDown = strtotime($coundDownFinal) - $validateNowDate;
		$validateInitCoundDown = strtotime($coundDownInit);

		$separationPercentage = get_field( 'acf_separation_percentage' );
		$separationNormalPrice = get_field( 'acf_separation_price_normal' );
		$separationNormalDiscount = get_field( 'acf_separation_price_regular' );
		
		$initialPercentage = get_field( 'acf_initial_percentage' );
		$initialNormalPrice = get_field( 'acf_intial_price_normal' );
		$initialNormalDiscount = get_field( 'acf_intial_price_regular' );
	
		$dormitorios = get_field( 'acf_product_dormitorios' );
		$baños = get_field( 'acf_product_banos' );

		switch($tag){
			case 'preventa': $label = 'Pre Venta'; break;
			case 'entrega': $label = 'Entrega Inmediata'; break;
			case 'construccion': $label = 'Construcción'; break;
			case '3dias': $label = '3 días de locura'; break;
			case 'combo': $label = 'Combo'; break;
		}

		$image_dep = wp_get_attachment_image_src( get_post_thumbnail_id( $product->id ), 'single-post-thumbnail' );
		
		echo '<a href="' . esc_url( get_permalink() ) . '">';
			echo '<span class="custom-card-tag custom-card-tag-' . $tag . '">' . $label . '</span>';
			if(!empty($image_dep)){
				echo '<div class="map_post_thumbnail" style="background-image: url('.$image_dep[0].');">';
				echo '<div class="woocommerce-product-gallery__trigger">
					<img draggable="false" role="img" src="'.get_stylesheet_directory_uri() . '/imgs/ico_search_store.svg">
				</div>';
				echo '</div>';
			}else{
				echo '<img src="'.get_stylesheet_directory_uri().'/imgs/img_shop.svg" alt="" />';
			}
			
			if ( !empty( $coundDownInit || $coundDownFinal ) && $validateFinalCoundDown > 0 ) {
				echo '<div class="clockdiv show" data-init="'.$coundDownInit.'" data-final="'.$coundDownFinal.'">';
					echo '<div class="clockdiv__left">';
						echo '<h3>ÚLTIMAS HORAS DISPONIBLES</h3>';
					echo '</div>';
					echo '<div class="clockdiv__right">';
						echo '<div>';
							echo '<span class="pl__days"></span>';
							echo '<div class="smalltext">Días</div>';
						echo '</div>';
						echo '<div>';
							echo '<span class="pl__hours"></span>';
							echo '<div class="smalltext">Horas</div>';
						echo '</div>';
						echo '<div>';
							echo '<span class="pl__minutes"></span>';
							echo '<div class="smalltext">Minutos</div>';
						echo '</div>';
						echo '<div>';
							echo '<span class="pl__seconds"></span>';
							echo '<div class="smalltext">Segundos</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
		echo '</a>';
		echo '<div class="custom-card-summary">';
			echo '<div class="custom-card-flex">';
				echo '<div class="custom-card-summary-top">';
					if($dpt = get_field('acf_product_project_number')){
						echo '<p class="custom-card-summary-number">DPTO. ' . $dpt . '</p>';
					}
					
					echo '<div class="custom-card-summary-key">';
						echo '<p>';
						if($areaTotal = get_field('acf_product_area_total')){
							echo '<img src="'.get_stylesheet_directory_uri().'/imgs/ico_mt.svg" /> '.$areaTotal .  'm<sup>2</sup>';
						};
						echo '</p>';
						echo '<p>';
						if(!empty( $dormitorios)){
							echo '<img src="'.get_stylesheet_directory_uri().'/imgs/ico_dm.svg" /> '.$dormitorios;
						} else {
							echo '<img src="'.get_stylesheet_directory_uri().'/imgs/ico_dm.svg" /> '.$product->get_attribute( 'dormitorios' ) .' Dormitorios';
						};
						echo '</p>';
						echo '<p>';
						if(!empty($baños)){
							echo '<img src="'.get_stylesheet_directory_uri().'/imgs/ico_bn.svg" /> '.$baños;
						} else {
							echo '<img src="'.get_stylesheet_directory_uri().'/imgs/ico_bn.svg" /> '.$product->get_attribute( 'banos' ) . ' Baños';
						};
						echo '</p>';
					echo '</div>';
				echo '</div>';
				echo '<div class="custom-card-summary-right">';
					
					echo '<ul class="info-right__item border-price">';
						echo '<li>';
								echo '<div class="old-price">';
									if( !empty( $priceNormal ) ) {
										echo 'Precio <small>S/' . number_format($priceNormal, 0, '.', ',').'</small>';
									}
								echo '</div>';
								echo '<div class="dd-price">';
									if( !empty( $priceInternet ) ) {
										echo 'S/' . number_format($priceInternet, 0, '.', ',');
									}
								echo '</div>';
						echo '</li>';
					echo '</ul>';
					echo '<div class="btn_separa">';
						echo '<a href="' . esc_url( get_permalink() ) . '">Separa aquí</a>';
					echo '</div>';	
				echo '</div>';
			echo '</div>';
			
		echo '</div>';
		?>
	</div>
	<?php
}

function getIconToilet(){
	return '<svg width="18" height="18" viewBox="0 0 15 20" fill="none" xmlns="http://www.w3.org/2000/svg">
	<path fill-rule="evenodd" clip-rule="evenodd" d="M14.7257 1.43637C14.283 0.550547 13.3923 0 12.4015 0H2.59848C1.60766 0 0.716953 0.550547 0.274258 1.43637C0.0948047 1.79523 0 2.19727 0 2.59848V3.59496C0 3.71824 0.00855469 3.84074 0.0260547 3.96238L0.683984 8.56895C0.800391 9.38477 1.51 10 2.33398 10H3.31176C3.47148 10.2922 3.65703 10.5687 3.85582 10.8333H2.91664C2.22734 10.8333 1.66664 11.394 1.66664 12.0833C1.66664 12.6345 2.0275 13.0981 2.52352 13.2639C2.6416 14.9487 3.59637 16.4733 5.08012 17.2949C4.49094 17.9163 4.16664 18.7288 4.16664 19.5833C4.16664 19.8136 4.35301 20 4.58332 20H10.4166C10.647 20 10.8333 19.8136 10.8333 19.5833C10.8333 18.7288 10.509 17.9163 9.90477 17.2961C11.4026 16.4733 12.3583 14.9487 12.4764 13.2639C12.9724 13.0981 13.3333 12.6345 13.3333 12.0833C13.3333 11.394 12.7726 10.8333 12.0833 10.8333H11.1441C11.343 10.5687 11.5285 10.2922 11.6882 10H12.666C13.49 10 14.1996 9.38477 14.316 8.56895L14.9739 3.96242C14.9914 3.84074 15 3.71828 15 3.595V2.59852C15 2.19727 14.9052 1.79523 14.7257 1.43637ZM9.50396 16.5659C9.27974 16.6888 9.1288 16.9032 9.08931 17.1543C9.04903 17.4143 9.13122 17.6743 9.31513 17.868C9.65978 18.2318 9.88317 18.6822 9.96493 19.1668H5.03497C5.11634 18.6822 5.34017 18.2317 5.68478 17.8684C5.86868 17.6743 5.95091 17.4143 5.9106 17.1543C5.87114 16.9032 5.72017 16.6888 5.49638 16.5663C4.28571 15.901 3.49833 14.6864 3.36157 13.3335H11.6383C11.5016 14.6864 10.7143 15.9009 9.50396 16.5659ZM12.0833 11.6665C12.3132 11.6665 12.5 11.8533 12.5 12.0832C12.5 12.3131 12.3132 12.4999 12.0833 12.4999H2.91668C2.6868 12.4999 2.5 12.3131 2.5 12.0832C2.5 11.8533 2.68676 11.6665 2.91668 11.6665H12.0833ZM10.0569 10.8333H4.94312C3.96351 9.80934 3.33331 8.34203 3.33331 7.04344C3.33331 4.89867 5.11515 2.5 7.49999 2.5C9.88484 2.5 11.6667 4.89867 11.6667 7.04348C11.6667 8.34203 11.0365 9.80938 10.0569 10.8333ZM14.1667 3.59506C14.1667 3.67846 14.1606 3.76189 14.1488 3.84447L13.4908 8.451C13.4326 8.85912 13.0782 9.16674 12.666 9.16674H12.0688C12.3414 8.46408 12.5 7.73432 12.5 7.04357C12.5 4.50533 10.3617 1.66678 7.50001 1.66678C4.6383 1.66678 2.50001 4.50533 2.50001 7.04357C2.50001 7.73436 2.65865 8.46412 2.93119 9.16678H2.334C1.92181 9.16678 1.5674 8.85916 1.50919 8.45104L0.851265 3.84451C0.839468 3.76189 0.833374 3.6785 0.833374 3.5951V2.59861C0.833374 2.326 0.897671 2.05295 1.01974 1.80924C1.32044 1.20744 1.92552 0.833496 2.59853 0.833496H12.4016C13.0746 0.833496 13.6797 1.20744 13.9804 1.80924C14.1024 2.05299 14.1667 2.326 14.1667 2.59861V3.59506H14.1667Z" fill="#636363"/>
	</svg>';
}
function getIconBed(){
	return '<svg width="18" height="18" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
	<path fill-rule="evenodd" clip-rule="evenodd" d="M22.6923 11.5385H22.3077V10.3846C22.3067 9.62087 21.8538 8.9301 21.1538 8.62462V2.69231C21.1538 2.53942 21.0632 2.40115 20.9231 2.34C21.0731 2.09952 21.153 1.82192 21.1538 1.53846C21.1538 0.688798 20.465 0 19.6154 0C18.7657 0 18.0769 0.688798 18.0769 1.53846C18.0785 1.80933 18.1524 2.07486 18.2908 2.30769H4.78615C4.92457 2.07486 4.99841 1.80933 5 1.53846C5 0.688798 4.3112 0 3.46154 0C2.61187 0 1.92308 0.688798 1.92308 1.53846C1.92389 1.82192 2.0038 2.09952 2.15385 2.34C2.01375 2.40115 1.92317 2.53942 1.92308 2.69231V8.62462C1.22308 8.9301 0.77024 9.62087 0.769231 10.3846V11.5385H0.384615C0.172212 11.5385 0 11.7107 0 11.9231V17.3077C0 17.5201 0.172212 17.6923 0.384615 17.6923H0.769231V19.6154C0.769231 19.8278 0.941442 20 1.15385 20H2.69231C2.90471 20 3.07692 19.8278 3.07692 19.6154V17.6923H20V19.6154C20 19.8278 20.1722 20 20.3846 20H21.9231C22.1355 20 22.3077 19.8278 22.3077 19.6154V17.6923H22.6923C22.9047 17.6923 23.0769 17.5201 23.0769 17.3077V11.9231C23.0769 11.7107 22.9047 11.5385 22.6923 11.5385ZM19.6154 0.769287C20.0403 0.769287 20.3847 1.11366 20.3847 1.53852C20.3847 1.96337 20.0403 2.30775 19.6154 2.30775C19.1906 2.30775 18.8462 1.96337 18.8462 1.53852C18.8462 1.11366 19.1906 0.769287 19.6154 0.769287ZM3.46155 0.769287C3.88641 0.769287 4.23078 1.11366 4.23078 1.53852C4.23078 1.96337 3.88641 2.30775 3.46155 2.30775C3.0367 2.30775 2.69232 1.96337 2.69232 1.53852C2.69232 1.11366 3.0367 0.769287 3.46155 0.769287ZM2.69232 3.0769H20.3846V8.46152H18.8362C19.0907 8.13061 19.2294 7.72517 19.2308 7.30767V6.53844C19.2295 5.4769 18.3692 4.61662 17.3077 4.61537H14.2308C13.1692 4.61662 12.309 5.4769 12.3077 6.53844V7.30767C12.3091 7.72517 12.4478 8.13061 12.7023 8.46152H10.3746C10.6291 8.13061 10.7679 7.72517 10.7692 7.30767V6.53844C10.768 5.4769 9.90771 4.61662 8.84617 4.61537H5.76925C4.70771 4.61662 3.84742 5.4769 3.84617 6.53844V7.30767C3.84756 7.72517 3.98626 8.13061 4.24078 8.46152H2.69232V3.0769ZM18.4615 6.53861V7.30784C18.4615 7.9451 17.9449 8.46169 17.3077 8.46169H14.2308C13.5935 8.46169 13.0769 7.9451 13.0769 7.30784V6.53861C13.0769 5.90135 13.5935 5.38477 14.2308 5.38477H17.3077C17.9449 5.38477 18.4615 5.90135 18.4615 6.53861ZM9.99997 6.53861V7.30784C9.99997 7.9451 9.48339 8.46169 8.84613 8.46169H5.7692C5.13194 8.46169 4.61536 7.9451 4.61536 7.30784V6.53861C4.61536 5.90135 5.13194 5.38477 5.7692 5.38477H8.84613C9.48339 5.38477 9.99997 5.90135 9.99997 6.53861ZM1.53845 10.3846C1.53845 9.7473 2.05504 9.23071 2.6923 9.23071H20.3846C21.0219 9.23071 21.5385 9.7473 21.5385 10.3846V11.5384H1.53845V10.3846ZM2.30768 19.2308H1.53845V17.6924H2.30768V19.2308ZM21.5385 19.2308H20.7692V17.6924H21.5385V19.2308ZM22.3077 16.923H0.769226V12.3076H22.3077V16.923Z" fill="#636363"/>
	</svg>';
}
function getIconArea(){
	return '<svg width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
	<path fill-rule="evenodd" clip-rule="evenodd" d="M19.5049 4.06863C19.7745 4.06863 19.9951 3.84804 20 3.57843V0.495098C20 0.220588 19.7794 0 19.5049 0H16.4216C16.152 0 15.9314 0.220588 15.9314 0.495098V1.56863H4.06863V0.495098C4.06863 0.22549 3.84804 0.00490196 3.57843 0H0.495098C0.22549 0 0.00490196 0.220588 0 0.495098V3.57843C0 3.84804 0.220588 4.06863 0.495098 4.06863H1.56863V15.9314H0.495098C0.22549 15.9314 0.00490196 16.152 0 16.4216V19.5049C0 19.7745 0.220588 19.9951 0.495098 20H3.57843C3.84804 20 4.06863 19.7794 4.06863 19.5049V18.4314H15.9314V19.5049C15.9314 19.7745 16.152 19.9951 16.4216 20H19.5049C19.7745 20 19.9951 19.7794 20 19.5049V16.4216C20 16.152 19.7794 15.9314 19.5049 15.9314H18.4314V4.06863H19.5049ZM0.980469 3.08831V0.980469H3.08831V3.08831H0.980469ZM3.08831 19.0195H0.980469V16.9116H3.08831V19.0195ZM15.9314 16.4216V17.451H4.06868V16.4216C4.06868 16.152 3.84809 15.9314 3.57848 15.9314H2.54907V4.06868H3.57848C3.84809 4.06868 4.06868 3.84809 4.06868 3.57848V2.54907H15.9314V3.57848C15.9314 3.84809 16.152 4.06868 16.4216 4.06868H17.451V15.9314H16.4216C16.152 15.9314 15.9314 16.152 15.9314 16.4216ZM19.0196 16.9116V19.0195H16.9117V16.9116H19.0196ZM16.9117 3.08831V0.980469H19.0196V3.08831H16.9117Z" fill="#636363"/>
	</svg>';
}


function wpb_widgets_portales() {
 
    register_sidebar( array(
        'name'          => 'Show filters',
        'id'            => 'filter-store',
        'before_widget' => '<div class="show-filter-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="chw-title">',
        'after_title'   => '</h2>',
    ) );

	register_sidebar( array(
        'name'          => 'Filter state',
        'id'            => 'filter-state',
        'before_widget' => '<div class="chw-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="chw-title">',
        'after_title'   => '</h2>',
    ) );

	register_sidebar( array(
        'name'          => 'Filter district',
        'id'            => 'filter-district',
        'before_widget' => '<div class="chw-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="chw-title">',
        'after_title'   => '</h2>',
    ) );

	register_sidebar( array(
        'name'          => 'Filter bedroom',
        'id'            => 'filter-bedroom',
        'before_widget' => '<div class="chw-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="chw-title">',
        'after_title'   => '</h2>',
    ) );
 
}
add_action( 'widgets_init', 'wpb_widgets_portales' );

/*
Footer Scripts
*/
add_action( 'wp_footer', 'my_footer_scripts' );
function my_footer_scripts(){ ?>
	<script>
		(function( $ ){
			//When page loads...
			$(".tab_content").hide(); //Hide all content
			$("ul.tabs li:first").addClass("active").show(); //Activate first tab
			$(".tab_content:first").show(); //Show first tab content

			//On Click Event
			$("ul.tabs li").click(function() {

				$("ul.tabs li").removeClass("active"); //Remove any "active" class
				$(this).addClass("active"); //Add "active" class to selected tab
				$(".tab_content").hide(); //Hide all tab content

				var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
				$(activeTab).fadeIn(); //Fade in the active ID content
				return false;
			});
		})( jQuery );
	</script>
	<?php
}