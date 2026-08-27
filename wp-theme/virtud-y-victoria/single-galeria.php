<?php
/**
 * Single Galeria Template
 *
 * @package Virtud_Y_Victoria
 */

get_header();

while (have_posts()) : the_post();
    $albums = get_the_terms(get_the_ID(), 'album_galeria');
?>

<section class="page-header">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb">
            <?php vyv_breadcrumb(); ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div style="max-width: 900px; margin: 0 auto;">
            <?php if (has_post_thumbnail()) : ?>
                <div style="margin-bottom: 30px; border-radius: var(--border-radius-xl); overflow: hidden;">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>
            
            <div class="gallery-meta">
                <?php if ($albums && !is_wp_error($albums)) : ?>
                    <p><strong><?php _e('Álbum:', 'virtud-y-victoria'); ?></strong> 
                        <?php echo implode(', ', array_map(function($a) { return '<a href="' . get_term_link($a) . '">' . $a->name . '</a>'; }, $albums)); ?>
                    </p>
                <?php endif; ?>
                <p style="margin: 10px 0 0;"><strong><?php _e('Publicado:', 'virtud-y-victoria'); ?></strong> <?php echo vyv_format_date(get_the_date('Y-m-d')); ?></p>
            </div>
            
            <div class="gallery-content">
                <?php the_content(); ?>
            </div>
            
            <div style="margin-top: 40px; text-align: center;">
                <a href="<?php echo home_url('/galeria'); ?>" class="btn btn-secondary">
                    <?php _e('Volver a la Galería', 'virtud-y-victoria'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
