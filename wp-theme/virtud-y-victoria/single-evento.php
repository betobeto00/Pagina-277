<?php
/**
 * Single Evento Template
 *
 * @package Virtud_Y_Victoria
 */

get_header();

while (have_posts()) : the_post();
    $fecha = get_post_meta(get_the_ID(), '_vyv_fecha_evento', true);
    $hora = get_post_meta(get_the_ID(), '_vyv_hora_evento', true);
    $lugar = get_post_meta(get_the_ID(), '_vyv_lugar_evento', true);
    $tipo = get_post_meta(get_the_ID(), '_vyv_tipo_evento', true);
    $inscripcion = get_post_meta(get_the_ID(), '_vyv_inscripcion_url', true);
    $categorias = get_the_terms(get_the_ID(), 'categoria_evento');
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
        <div class="evento-single-grid">
            
            <!-- Contenido Principal -->
            <div>
                <?php if (has_post_thumbnail()) : ?>
                    <div style="margin-bottom: 30px; border-radius: var(--border-radius-xl); overflow: hidden;">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="event-details-box">
                    <?php if ($fecha) : ?>
                        <p><strong><?php _e('Fecha:', 'virtud-y-victoria'); ?></strong> <?php echo vyv_format_date($fecha); ?></p>
                    <?php endif; ?>
                    <?php if ($hora) : ?>
                        <p><strong><?php _e('Hora:', 'virtud-y-victoria'); ?></strong> <?php echo esc_html($hora); ?></p>
                    <?php endif; ?>
                    <?php if ($lugar) : ?>
                        <p><strong><?php _e('Lugar:', 'virtud-y-victoria'); ?></strong> <?php echo esc_html($lugar); ?></p>
                    <?php endif; ?>
                    <?php if ($tipo) : ?>
                        <p><strong><?php _e('Tipo:', 'virtud-y-victoria'); ?></strong> <?php echo vyv_get_event_type_label($tipo); ?></p>
                    <?php endif; ?>
                    <?php if ($categorias && !is_wp_error($categorias)) : ?>
                        <p><strong><?php _e('Categoría:', 'virtud-y-victoria'); ?></strong> 
                            <?php echo implode(', ', array_map(function($c) { return $c->name; }, $categorias)); ?>
                        </p>
                    <?php endif; ?>
                </div>
                
                <div class="event-content">
                    <?php the_content(); ?>
                </div>
                
                <?php if ($inscripcion) : ?>
                    <div class="cta-inscripcion">
                        <h3><?php _e('Inscripción', 'virtud-y-victoria'); ?></h3>
                        <p><?php _e('Regístrate para asistir a este evento.', 'virtud-y-victoria'); ?></p>
                        <a href="<?php echo esc_url($inscripcion); ?>" target="_blank" rel="noopener" class="btn btn-primary">
                            <?php _e('Inscribirme', 'virtud-y-victoria'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Sidebar -->
            <aside>
                <div class="share-sidebar">
                    <h3><?php _e('Compartir', 'virtud-y-victoria'); ?></h3>
                    <div class="share-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="btn btn-secondary">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="btn btn-secondary">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' ' . get_permalink()); ?>" target="_blank" class="btn btn-secondary">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </div>
                </div>
                
                <div class="share-sidebar">
                    <h3><?php _e('Volver al Calendario', 'virtud-y-victoria'); ?></h3>
                    <a href="<?php echo home_url('/eventos'); ?>" class="btn btn-secondary" style="width: 100%; text-align: center;">
                        <?php _e('Ver Todos los Eventos', 'virtud-y-victoria'); ?>
                    </a>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
