<?php
/**
 * Gallery Template Part - Improved with Lightbox
 *
 * @package Virtud_Y_Victoria
 */

$gallery_per_page = get_theme_mod('vyv_gallery_count', 8);
$galeria_query = new WP_Query(array(
    'post_type'      => 'galeria',
    'posts_per_page' => $gallery_per_page,
));

if ($galeria_query->have_posts()) :
?>
<!-- Galería -->
<section class="section">
    <div class="container">
        <div class="section-title" data-animate="fadeInUp">
            <h2><?php _e('Galería de Actividades', 'virtud-y-victoria'); ?></h2>
            <p class="subtitle"><?php _e('Momentos capturados de nuestras tenidas y eventos', 'virtud-y-victoria'); ?></p>
            <div class="separator-line"></div>
        </div>
        
        <div class="gallery-grid" data-animate-stagger>
            <?php while ($galeria_query->have_posts()) : $galeria_query->the_post(); ?>
                <div class="gallery-item">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php
                        $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                        $thumb_medium = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                        ?>
                        <a href="<?php echo esc_url($thumb_url); ?>" data-lightbox="galeria" data-title="<?php the_title_attribute(); ?>">
                            <img src="<?php echo esc_url($thumb_medium); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                        </a>
                        <div class="gallery-overlay">
                            <span><?php the_title(); ?></span>
                        </div>
                    <?php else : ?>
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #1a3a6b 0%, #2c5aa0 100%); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-image" style="font-size: 32px; color: #d4af37;"></i>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
        
        <div style="text-align: center; margin-top: 40px;" data-animate="fadeInUp">
            <a href="<?php echo esc_url(home_url('/galeria')); ?>" class="btn btn-secondary">
                <?php _e('Ver Galería Completa', 'virtud-y-victoria'); ?>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>
