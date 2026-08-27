<?php
/**
 * Template principal de WordPress
 *
 * Este archivo es requerido por WordPress para que el tema sea válido.
 *
 * @package Virtud_Y_Victoria
 */

get_header();
?>

<main id="main-content" class="site-main">
    <div class="container">
        <?php if (have_posts()) : ?>
            
            <?php if (is_home() && !is_front_page()) : ?>
                <header class="page-header">
                    <h1><?php single_post_title(); ?></h1>
                </header>
            <?php endif; ?>
            
            <div class="posts-grid cards-grid">
                <?php
                while (have_posts()) :
                    the_post();
                ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium_large', array('class' => 'card-img')); ?>
                            </a>
                        <?php endif; ?>
                        
                        <div class="card-body">
                            <div class="card-meta">
                                <span>📅 <?php echo get_the_date(); ?></span>
                                <span>•</span>
                                <span><?php echo get_the_category_list(', '); ?></span>
                            </div>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="card-link">
                                <?php _e('Leer más →', 'virtud-y-victoria'); ?>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <!-- Paginación -->
            <div class="pagination">
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => '&laquo; Anterior',
                    'next_text' => 'Siguiente &raquo;',
                ));
                ?>
            </div>
            
        <?php else : ?>
            
            <div class="no-results">
                <h2><?php _e('No se encontraron entradas', 'virtud-y-victoria'); ?></h2>
                <p><?php _e('Parece que no podemos encontrar lo que buscas. Intenta buscar algo diferente.', 'virtud-y-victoria'); ?></p>
                <?php get_search_form(); ?>
            </div>
            
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
