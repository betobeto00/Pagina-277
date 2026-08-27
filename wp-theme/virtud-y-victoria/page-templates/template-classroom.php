<?php
/**
 * Template Name: Classroom
 *
 * @package Virtud_Y_Victoria
 */

get_header();
?>

<section class="page-header">
    <div class="container">
        <h1><?php _e('Classroom', 'virtud-y-victoria'); ?></h1>
        <div class="breadcrumb">
            <?php vyv_breadcrumb(); ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        
        <!-- Coming Soon Notice -->
        <div class="classroom-coming-soon" data-animate="fadeInUp" style="text-align: center; padding: 80px 20px; background: linear-gradient(135deg, #1a3a6b 0%, #0d1f3c 100%); border-radius: 16px; margin-bottom: 60px; position: relative; overflow: hidden;">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"60\" height=\"60\" viewBox=\"0 0 60 60\"><g fill-rule=\"evenodd\"><g fill=\"%23d4af37\" fill-opacity=\"0.05\"><path d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/></g></g></svg>'); opacity: 0.3;"></div>
            <div style="position: relative; z-index: 2;">
                <div style="width: 100px; height: 100px; background: rgba(212, 175, 55, 0.15); border: 2px solid #d4af37; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px;">
                    <i class="fas fa-chalkboard-teacher" style="font-size: 48px; color: #d4af37;"></i>
                </div>
                <h2 style="color: white; font-size: 2.5rem; margin-bottom: 15px; font-weight: 300; text-transform: uppercase; letter-spacing: 2px;"><?php _e('Salón de Clases Online', 'virtud-y-victoria'); ?></h2>
                <p style="color: rgba(255,255,255,0.85); font-size: 1.2rem; margin-bottom: 30px; max-width: 600px; margin-left: auto; margin-right: auto; line-height: 1.8;">
                    <?php _e('Un espacio virtual de formación para Aprendices Masones. Estamos trabajando para ofrecerte cursos, talleres y material educativo de calidad.', 'virtud-y-victoria'); ?>
                </p>
                <div style="display: inline-block; background: #d4af37; color: #1a3a6b; padding: 15px 40px; border-radius: 30px; font-size: 1.1rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
                    <i class="fas fa-clock" style="margin-right: 10px;"></i>
                    <?php _e('Próximamente', 'virtud-y-victoria'); ?>
                </div>
            </div>
        </div>

        <!-- Features Preview -->
        <div class="section-title" data-animate="fadeInUp">
            <h2><?php _e('¿Qué encontrarás?', 'virtud-y-victoria'); ?></h2>
            <p class="subtitle"><?php _e('Funcionalidades que estamos preparando para ti', 'virtud-y-victoria'); ?></p>
            <div class="separator-line"></div>
        </div>

        <div class="cards-grid cols-3" data-animate-stagger>
            <div class="card" style="text-align: center; padding: 40px 25px;">
                <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #1a3a6b 0%, #2c5aa0 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: #d4af37; font-size: 28px;">
                    <i class="fas fa-video"></i>
                </div>
                <h4 style="color: #1a3a6b; margin-bottom: 10px;"><?php _e('Clases en Vivo', 'virtud-y-victoria'); ?></h4>
                <p style="color: #666; font-size: 14px; line-height: 1.6;"><?php _e('Sesiones de formación en tiempo real con instructores calificados.', 'virtud-y-victoria'); ?></p>
            </div>

            <div class="card" style="text-align: center; padding: 40px 25px;">
                <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #1a3a6b 0%, #2c5aa0 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: #d4af37; font-size: 28px;">
                    <i class="fas fa-book-open"></i>
                </div>
                <h4 style="color: #1a3a6b; margin-bottom: 10px;"><?php _e('Material de Estudio', 'virtud-y-victoria'); ?></h4>
                <p style="color: #666; font-size: 14px; line-height: 1.6;"><?php _e('Documentos, presentaciones y recursos educativos descargables.', 'virtud-y-victoria'); ?></p>
            </div>

            <div class="card" style="text-align: center; padding: 40px 25px;">
                <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #1a3a6b 0%, #2c5aa0 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: #d4af37; font-size: 28px;">
                    <i class="fas fa-certificate"></i>
                </div>
                <h4 style="color: #1a3a6b; margin-bottom: 10px;"><?php _e('Certificaciones', 'virtud-y-victoria'); ?></h4>
                <p style="color: #666; font-size: 14px; line-height: 1.6;"><?php _e('Certificados de participación para cada curso completado.', 'virtud-y-victoria'); ?></p>
            </div>
        </div>

        <!-- CTA -->
        <div style="text-align: center; margin-top: 60px; padding: 40px; background: #f8f9fa; border-radius: 12px;" data-animate="fadeInUp">
            <h3 style="color: #1a3a6b; margin-bottom: 15px;"><?php _e('¿Interesado en el Classroom?', 'virtud-y-victoria'); ?></h3>
            <p style="color: #666; margin-bottom: 25px;"><?php _e('Contáctanos para más información sobre nuestras próximas actividades de formación.', 'virtud-y-victoria'); ?></p>
            <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="btn btn-primary" style="display: inline-block;">
                <i class="fas fa-envelope" style="margin-right: 8px;"></i>
                <?php _e('Contáctanos', 'virtud-y-victoria'); ?>
            </a>
        </div>

    </div>
</section>

<?php get_footer(); ?>
