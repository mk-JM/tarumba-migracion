<footer>
    <div class="container lp__footer-sec1">

        <div class="lp__footer-sec1-block1">
            <img src="<?php echo get_field('logo_footer', 'option'); ?>" alt=" "/>
            <h3>Ubícanos</h3>
            <p><?php echo the_field('ubicanos_footer', 'options');?></p>
            <li><a href="<?php the_field('ir_con_google_maps_footer', 'options'); ?>">Ir con google maps</a></li>
        </div>

        <div class="lp__footer-sec1-nums">
            <div>
                <h3>Comunícate con nosotros.</h3>
                <p><img src="<?php echo get_stylesheet_directory_uri(); ?>/imgs/ws_footer.svg" alt=""><?php the_field('comunicate_con_nosotros', 'options'); ?></p>
            </div>
            <div class="lp__footer-sec1-mail">
                <h3><img src="<?php echo get_stylesheet_directory_uri(); ?>/imgs/send_mail_footer.svg" alt=""><a href="mailto:<?php the_field('correo_footer', 'options'); ?>" target="_blank"><?php the_field('correo_footer', 'options'); ?></a></h3>
            </div>
        </div>

        <div class="lp__footer-sec1-project">
            <h3>Nuestros proyectos:</h3>
            <?php if( have_rows( 'proyectos_footer', 'option' ) ): ?>
                <?php while( have_rows( 'proyectos_footer', 'option' ) ): the_row();
                    $texto = get_sub_field('nombre');
                    $link = get_sub_field('link');
                ?>
                    <li>
                        <a href="<?php echo $link ?>">
                            <?php echo $texto ?>
                        </a>
                    </li>

                <?php endwhile; ?>
            <?php endif; ?>
        </div>

        <div class="lp__footer-sec1-redes">
            <?php if( have_rows( 'redes_sociales', 'option' ) ): ?>
                <?php while( have_rows( 'redes_sociales', 'option' ) ): the_row();
                    $icon = get_sub_field('icono');
                    $link = get_sub_field('link');
                ?>
                                
                    <li>
                        <a href="<?php echo $link ?>">
                            <img src="<?php echo esc_url($icon['url']); ?>" alt="">
                        </a>
                    </li>

                <?php endwhile; ?>
            <?php endif; ?>
        </div>

    </div>

    <div class="container lp__footer-sec2">
        <?php if( have_rows( 'legales_footer', 'option' ) ): ?>
            <?php while( have_rows( 'legales_footer', 'option' ) ): the_row();
                $icon = get_sub_field('icono');
                $link = get_sub_field('link');
                $texto = get_sub_field('texto');
            ?>
                            
                <li>
                    <a href="<?php echo $link ?>">
                        <?php if($icon){?><img src="<?php echo esc_url($icon['url']); ?>" alt=""><?php } ?>
                        <?php echo $texto ?>
                    </a>
                </li>

            <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <div class="container lp__footer-copy">
        <?php the_field('copy', 'option'); ?>   
    </div>
</footer>




<?php
/**
* The template for displaying the footer.
*
* @package Salient WordPress Theme
* @version 12.2
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nectar_options = get_nectar_theme_options();
$header_format  = ( !empty($nectar_options['header_format']) ) ? $nectar_options['header_format'] : 'default';

nectar_hook_before_footer_open();

?>


	
</div><!--/footer-outer-->

<?php

nectar_hook_before_outer_wrap_close();

get_template_part( 'includes/partials/footer/off-canvas-navigation' );

?>

</div> <!--/ajax-content-wrap-->

<?php
	
	// Boxed theme option closing div.
	if ( ! empty( $nectar_options['boxed_layout'] ) && 
	'1' === $nectar_options['boxed_layout'] && 
	'left-header' !== $header_format ) {

		echo '</div><!--/boxed closing div-->'; 
	}
	
	get_template_part( 'includes/partials/footer/back-to-top' );
	
	nectar_hook_after_wp_footer();
	nectar_hook_before_body_close();
	
	wp_footer();
?>
</body>
</html>