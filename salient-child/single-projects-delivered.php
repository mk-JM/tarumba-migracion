<?php get_header(); ?>
    <?php while( have_posts() ): the_post(); ?>
        <div class="container-wrap no-sidebar">
            <div class="container main-content">
                <div class="row">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php get_footer(); ?>
 