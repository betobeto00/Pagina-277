<?php
/**
 * 404 Template
 *
 * @package Virtud_Y_Victoria
 */

get_header();
?>

<section class="section" style="min-height: 60vh; display: flex; align-items: center; text-align: center;">
    <div class="container">
        <div style="max-width: 500px; margin: 0 auto;">
            <div style="font-size: 120px; font-weight: 700; color: #d4af37; line-height: 1; margin-bottom: 20px; text-shadow: 4px 4px 0 #1a3a6b;">404</div>
            <h1 style="color: #1a3a6b; margin-bottom: 20px;"><?php _e('Página No Encontrada', 'virtud-y-victoria'); ?></h1>
            <p style="color: #7f8c8d; font-size: 18px; margin-bottom: 40px;"><?php _e('Lo sentimos, la página que buscas no existe o ha sido movida.', 'virtud-y-victoria'); ?></p>
            
            <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo home_url(); ?>" class="btn btn-primary">
                    <i class="fas fa-home"></i> <?php _e('Volver al Inicio', 'virtud-y-victoria'); ?>
                </a>
                <a href="<?php echo home_url('/contacto'); ?>" class="btn btn-secondary">
                    <i class="fas fa-envelope"></i> <?php _e('Contactar', 'virtud-y-victoria'); ?>
                </a>
            </div>
            
            <form action="<?php echo home_url('/'); ?>" method="get" style="margin-top: 40px; max-width: 400px; margin-left: auto; margin-right: auto;">
                <input type="search" name="s" placeholder="<?php _e('Buscar en el sitio...', 'virtud-y-victoria'); ?>" style="width: 100%; padding: 14px; border: 2px solid #bdc3c7; border-radius: 8px; font-size: 16px;">
                <button type="submit" class="btn btn-primary" style="margin-top: 15px; width: 100%;"><?php _e('Buscar', 'virtud-y-victoria'); ?></button>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>