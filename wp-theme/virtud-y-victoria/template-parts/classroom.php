<?php
/**
 * Classroom Template Part - Próximamente
 *
 * @package Virtud_Y_Victoria
 */

// Get upcoming events that could be classroom sessions
$classroom_query = new WP_Query(array(
    'post_type'      => 'evento',
    'posts_per_page' => 2,
    'meta_key'       => '_vyv_tipo_evento',
    'meta_value'     => 'social',
    'meta_compare'   => '=',
    'orderby'        => 'date',
    'order'          => 'DESC',
));

// Show classroom section only if there are events, otherwise show coming soon
if ($classroom_query->have_posts()) :
?>
<!-- Classroom Masónico -->
<section class="mentoring-section">
    <div class="container">
        <div class="section-title" data-animate="fadeInUp">
            <h2><?php _e('Classroom', 'virtud-y-victoria'); ?></h2>
            <p class="subtitle"><?php _e('Salón de Clases Online - Próximamente', 'virtud-y-victoria'); ?></p>
            <div class="separator-line"></div>
        </div>
        
        <div class="mentoring-grid" data-animate-stagger>
            <?php while ($classroom_query->have_posts()) : $classroom_query->the_post();
                $fecha = get_post_meta(get_the_ID(), '_vyv_fecha_evento', true);
                $hora = get_post_meta(get_the_ID(), '_vyv_hora_evento', true);
                $lugar = get_post_meta(get_the_ID(), '_vyv_lugar_evento', true);
                $tipo = get_post_meta(get_the_ID(), '_vyv_tipo_evento', true);
            ?>
                <div class="mentoring-card">
                    <div class="card-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium_large', array('style' => 'width:100%;height:100%;object-fit:cover;')); ?>
                        <?php else : ?>
                            <div style="width:100%;height:100%;background:linear-gradient(135deg, #1a3a6b 0%, #2c5aa0 100%);display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-chalkboard-teacher" style="font-size:48px;color:#d4af37;"></i>
                            </div>
                        <?php endif; ?>
                        <span class="card-badge"><?php _e('Próximamente', 'virtud-y-victoria'); ?></span>
                    </div>
                    <div class="card-body">
                        <h3 style="font-size:1.1rem;margin-bottom:10px;line-height:1.4;"><a href="<?php the_permalink(); ?>" style="color:#2c3e50;text-decoration:none;"><?php the_title(); ?></a></h3>
                        <div class="card-details">
                            <?php if ($fecha) : ?>
                                <div class="detail-item">
                                    <i class="far fa-calendar"></i>
                                    <span><?php echo date('d/m/Y', strtotime($fecha)); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($hora) : ?>
                                <div class="detail-item">
                                    <i class="far fa-clock"></i>
                                    <span><?php echo esc_html($hora); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($lugar) : ?>
                                <div class="detail-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><?php echo esc_html($lugar); ?></span>
                                </div>
                            <?php endif; ?>
                            <div class="detail-item">
                                <i class="fas fa-tag"></i>
                                <span><?php echo vyv_get_event_type_label($tipo); ?></span>
                            </div>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="btn-mentoring">
                            <i class="fas fa-user-plus" style="margin-right: 6px;"></i>
                            <?php _e('Ver Detalles', 'virtud-y-victoria'); ?>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
        
        <div style="text-align: center; margin-top: 30px;" data-animate="fadeInUp">
            <a href="<?php echo esc_url(home_url('/classroom')); ?>" style="color: var(--color-accent); font-weight: 500; text-decoration: none; font-size: 14px; border-bottom: 1px solid #ddd; padding-bottom: 2px; transition: border-color 0.2s;">
                <?php _e('Ir al Classroom', 'virtud-y-victoria'); ?> <i class="fas fa-arrow-right" style="font-size: 12px; margin-left: 4px;"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>
