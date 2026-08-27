<?php
/**
 * Search Results Template
 *
 * @package Virtud_Y_Victoria
 */

get_header();
?>

<section class="page-header">
    <div class="container">
        <h1><?php _e('Resultados de Búsqueda', 'virtud-y-victoria'); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo home_url(); ?>"><?php _e('Inicio', 'virtud-y-victoria'); ?></a> / <?php _e('Búsqueda', 'virtud-y-victoria'); ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto;">
            <p style="margin-bottom: 40px;"><?php printf(_e('Resultados para: %s', 'virtud-y-victoria'), '<strong>' . get_search_query() . '</strong>'); ?></p>
            
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article class="card" style="margin-bottom: 30px;">
                        <div class="card-body">
                            <div class="card-meta">
                                <span><?php echo get_post_type_object(get_post_type())->labels->singular_name; ?></span>
                            </div>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>
                            <a href="<?php the_permalink(); ?>" class="card-link">
                                <?php _e('Leer más &rarr;', 'virtud-y-victoria'); ?>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
                
                <div style="text-align: center; margin-top: 50px;">
                    <?php the_posts_pagination(); ?>
                </div>
            <?php else : ?>
                <div class="no-results" style="text-align: center; padding: 60px 20px;">
                    <i class="fas fa-search" style="font-size: 64px; color: #95a5a6; margin-bottom: 20px;"></i>
                    <h3 style="color: #1a3a6b; margin-bottom: 10px;"><?php _e('No se encontraron resultados', 'virtud-y-victoria'); ?></p>
                    <p style="color: #7f8c8d;"><?php _e('Intenta con otros términos de búsqueda.', 'virtud-y-victoria'); ?></p>
                    <form action="<?php echo home_url('/'); ?>" method="get" style="margin-top: 30px; max-width: 400px; margin-left: auto; margin-right: auto;">
                        <input type="search" name="s" placeholder="<?php _e('Buscar...', 'virtud-y-victoria'); ?>" style="width: 100%; padding: 14px; border: 2px solid #bdc3c7; border-radius: 8px; font-size: 16px;">
                        <button type="submit" class="btn btn-primary" style="margin-top: 15px; width: 100%;"><?php _e('Buscar de nuevo', 'virtud-y-victoria'); ?></button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>