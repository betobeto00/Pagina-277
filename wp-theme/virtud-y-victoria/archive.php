<?php
/**
 * Template para archivos (categorías, etiquetas, fechas, etc.)
 *
 * @package Virtud_Y_Victoria
 */

get_header();
?>

<section class="page-header">
    <div class="container">
        <?php the_archive_title('<h1>', '</h1>'); ?>
        <?php the_archive_description('<p class="archive-description">', '</p>'); ?>
        <div class="breadcrumb">
            <a href="<?php echo home_url(); ?>">Inicio</a> / <?php the_archive_title(); ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php if (have_posts()) : ?>
            
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
            
            <div class="no-results" style="text-align: center;">
                <h2><?php _e('No se encontraron entradas', 'virtud-y-victoria'); ?></h2>
                <p><?php _e('No hay contenido que mostrar en esta sección.', 'virtud-y-victoria'); ?></p>
            </div>
            
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
