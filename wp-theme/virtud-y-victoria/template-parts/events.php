<?php
/**
 * Events Template Part - Improved
 *
 * @package Virtud_Y_Victoria
 */

$events_per_page = get_theme_mod('vyv_events_count', 4);
$eventos_query = new WP_Query(array(
    'post_type'      => 'evento',
    'posts_per_page' => $events_per_page,
    'meta_key'       => '_vyv_fecha_evento',
    'meta_value'     => date('Y-m-d'),
    'meta_compare'   => '>=',
    'orderby'        => 'meta_value',
    'order'          => 'ASC',
));

if ($eventos_query->have_posts()) :
?>
<!-- Eventos Próximos -->
<section class="section section-alt">
    <div class="container">
        <div class="section-title" data-animate="fadeInUp">
            <h2><?php _e('Próximos Eventos', 'virtud-y-victoria'); ?></h2>
            <p class="subtitle"><?php _e('Calendario de actividades de la logia', 'virtud-y-victoria'); ?></p>
            <div class="separator-line"></div>
        </div>
        
        <div class="cards-grid cols-2" data-animate-stagger>
            <?php while ($eventos_query->have_posts()) : $eventos_query->the_post();
                $fecha = get_post_meta(get_the_ID(), '_vyv_fecha_evento', true);
                $hora = get_post_meta(get_the_ID(), '_vyv_hora_evento', true);
                $lugar = get_post_meta(get_the_ID(), '_vyv_lugar_evento', true);
                $tipo = get_post_meta(get_the_ID(), '_vyv_tipo_evento', true);
            ?>
                <div class="event-card">
                    <div class="event-date">
                        <span class="day"><?php echo date('d', strtotime($fecha)); ?></span>
                        <span class="month"><?php echo strtoupper(date('M', strtotime($fecha))); ?></span>
                    </div>
                    <div class="event-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium_large', array('style' => 'width:100%;height:100%;object-fit:cover;')); ?>
                        <?php else : ?>
                            <div style="width:100%;height:100%;background:linear-gradient(135deg, #1a3a6b 0%, #2c5aa0 100%);display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-calendar-alt" style="font-size:48px;color:#d4af37;"></i>
                            </div>
                        <?php endif; ?>
                        <div class="image-overlay"></div>
                    </div>
                    <div class="event-info">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="event-meta">
                            <?php if ($hora) : ?>
                                <span><i class="far fa-clock"></i> <?php echo esc_html($hora); ?></span>
                            <?php endif; ?>
                            <?php if ($lugar) : ?>
                                <span><i class="fas fa-map-marker-alt"></i> <?php echo esc_html($lugar); ?></span>
                            <?php endif; ?>
                            <span><i class="fas fa-tag"></i> <?php echo vyv_get_event_type_label($tipo); ?></span>
                        </div>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        <a href="<?php the_permalink(); ?>" class="event-link">
                            <?php _e('Ver detalles', 'virtud-y-victoria'); ?> <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
        
        <div style="text-align: center; margin-top: 40px;" data-animate="fadeInUp">
            <a href="<?php echo esc_url(home_url('/eventos')); ?>" class="btn btn-secondary">
                <?php _e('Ver Todos los Eventos', 'virtud-y-victoria'); ?>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>
