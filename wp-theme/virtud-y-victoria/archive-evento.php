<?php
/**
 * Archive: Eventos
 * Reuses template-eventos.php content with scroll animations
 *
 * @package Virtud_Y_Victoria
 */

get_header();
?>

<section class="page-header">
    <div class="container">
        <h1><?php post_type_archive_title(); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo home_url(); ?>">Inicio</a> / <?php post_type_archive_title(); ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        
        <!-- Filtros -->
        <div style="margin-bottom: 40px; display: flex; gap: 15px; flex-wrap: wrap; justify-content: center;" data-animate="fadeInUp">
            <span style="padding: 10px 20px; background: #1a3a6b; color: white; border-radius: 25px; font-size: 14px; font-weight: 500; cursor: pointer;"><?php _e('Todos', 'virtud-y-victoria'); ?></span>
            <span style="padding: 10px 20px; background: #ecf0f1; color: #666; border-radius: 25px; font-size: 14px; cursor: pointer;"><?php _e('Tenidas', 'virtud-y-victoria'); ?></span>
            <span style="padding: 10px 20px; background: #ecf0f1; color: #666; border-radius: 25px; font-size: 14px; cursor: pointer;"><?php _e('Ceremonias', 'virtud-y-victoria'); ?></span>
            <span style="padding: 10px 20px; background: #ecf0f1; color: #666; border-radius: 25px; font-size: 14px; cursor: pointer;"><?php _e('Filantropía', 'virtud-y-victoria'); ?></span>
            <span style="padding: 10px 20px; background: #ecf0f1; color: #666; border-radius: 25px; font-size: 14px; cursor: pointer;"><?php _e('Sociales', 'virtud-y-victoria'); ?></span>
        </div>
        
        <!-- Evento Destacado -->
        <div data-animate="fadeInUp">
        <div style="background: linear-gradient(135deg, #1a3a6b 0%, #2c5aa0 100%); color: white; border-radius: 16px; padding: 50px; margin-bottom: 50px; position: relative; overflow: hidden;">
            <div style="position: absolute; top: 0; right: 0; width: 300px; height: 300px; background: rgba(212,175,55,0.1); border-radius: 50%; transform: translate(50%, -50%);"></div>
            <div style="position: relative; z-index: 1;">
                <span style="background: #d4af37; color: #1a3a6b; padding: 6px 16px; border-radius: 20px; font-size: 12px; font-weight: bold; text-transform: uppercase;"><?php _e('Próximo Evento', 'virtud-y-victoria'); ?></span>
                <h2 style="color: white; font-size: 32px; margin: 20px 0 15px;"><?php _e('Tenida Ordinaria del Próximo Mes', 'virtud-y-victoria'); ?></h2>
                <p style="opacity: 0.9; margin-bottom: 25px; max-width: 600px;">Trabajo masónico ordinario. Se tratarán asuntos internos de la logia y se recibirá a nuevos visitantes.</p>
                <div style="margin-bottom: 25px;">
                    <p style="margin-bottom: 8px;"><strong>📅</strong> [Fecha del próximo evento]</p>
                    <p style="margin-bottom: 8px;"><strong>🕐</strong> 7:00 PM</p>
                    <p><strong>📍</strong> Templo de la Logia - [Dirección]</p>
                </div>
                <a href="<?php echo home_url('/contacto'); ?>" class="btn btn-primary"><?php _e('Más Información', 'virtud-y-victoria'); ?></a>
            </div>
        </div>
        </div>
        
        <!-- Lista de Eventos -->
        <div class="section-title" data-animate="fadeInUp">
            <h2><?php _e('Próximos Eventos', 'virtud-y-victoria'); ?></h2>
            <div class="divider"></div>
        </div>
        
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post();
                $fecha = get_post_meta(get_the_ID(), '_vyv_fecha_evento', true);
                $hora = get_post_meta(get_the_ID(), '_vyv_hora_evento', true);
                $lugar = get_post_meta(get_the_ID(), '_vyv_lugar_evento', true);
                $tipo = get_post_meta(get_the_ID(), '_vyv_tipo_evento', true);
            ?>
            <div class="event-card" data-animate="fadeInUp">
                <div class="event-date">
                    <span class="day"><?php echo $fecha ? date('d', strtotime($fecha)) : date('d'); ?></span>
                    <span class="month"><?php echo $fecha ? strtoupper(date('M', strtotime($fecha))) : strtoupper(date('M')); ?></span>
                </div>
                <div class="event-info">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="event-meta">
                        <?php if ($hora) : ?>
                            <span>🕐 <?php echo esc_html($hora); ?></span>
                        <?php endif; ?>
                        <?php if ($lugar) : ?>
                            <span>📍 <?php echo esc_html($lugar); ?></span>
                        <?php endif; ?>
                        <?php if ($tipo) : ?>
                            <span>🏷️ <?php echo esc_html($tipo); ?></span>
                        <?php endif; ?>
                    </div>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else : ?>
            <!-- Eventos de ejemplo -->
            <div class="event-card" data-animate="fadeInUp">
                <div class="event-date">
                    <span class="day">28</span>
                    <span class="month">SEP</span>
                </div>
                <div class="event-info">
                    <h3><?php _e('Tenida Ordinaria de Septiembre', 'virtud-y-victoria'); ?></h3>
                    <div class="event-meta">
                        <span>🕐 7:00 PM</span>
                        <span>📍 Templo de la Logia</span>
                        <span>🏷️ Tenida</span>
                    </div>
                    <p><?php _e('Trabajo masónico ordinario mensual.', 'virtud-y-victoria'); ?></p>
                </div>
            </div>
            
            <div class="event-card" data-animate="fadeInUp">
                <div class="event-date">
                    <span class="day">15</span>
                    <span class="month">OCT</span>
                </div>
                <div class="event-info">
                    <h3><?php _e('Ceremonia de Elevación', 'virtud-y-victoria'); ?></h3>
                    <div class="event-meta">
                        <span>🕐 6:00 PM</span>
                        <span>📍 Templo de la Logia</span>
                        <span>🏷️ Ceremonia</span>
                    </div>
                    <p><?php _e('Ceremonia de elevación al grado de Compañero.', 'virtud-y-victoria'); ?></p>
                </div>
            </div>
            
            <div class="event-card" data-animate="fadeInUp">
                <div class="event-date">
                    <span class="day">20</span>
                    <span class="month">OCT</span>
                </div>
                <div class="event-info">
                    <h3><?php _e('Jornada Filantrópica', 'virtud-y-victoria'); ?></h3>
                    <div class="event-meta">
                        <span>🕐 9:00 AM</span>
                        <span>📍 [Lugar]</span>
                        <span>🏷️ Filantropía</span>
                    </div>
                    <p><?php _e('Jornada de ayuda a la comunidad.', 'virtud-y-victoria'); ?></p>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- Paginación -->
        <div style="text-align: center; margin-top: 50px;" data-animate="fadeInUp">
            <?php
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => '&laquo; Anterior',
                'next_text' => 'Siguiente &raquo;',
            ));
            ?>
        </div>
        
    </div>
</section>

<?php get_footer(); ?>
