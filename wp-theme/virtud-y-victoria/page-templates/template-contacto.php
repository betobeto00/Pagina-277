<?php
/**
 * Template Name: Contacto
 *
 * @package Virtud_Y_Victoria
 */

get_header();
?>

<section class="page-header page-header--contacto">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb">
            <?php vyv_breadcrumb(); ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px;" data-animate="fadeInUp">
            
            <!-- Formulario -->
            <div>
                <h2 style="color: #1a3a6b; margin-bottom: 10px;"><?php _e('Envíanos un Mensaje', 'virtud-y-victoria'); ?></h2>
                <p style="color: #7f8c8d; margin-bottom: 30px;"><?php _e('Completa el formulario y te responderemos a la brevedad.', 'virtud-y-victoria'); ?></p>
                
                <?php
                // Formulario de contacto AJAX personalizado
                ?>
                <form class="contact-form" id="vyvContactForm" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="POST">
                    <input type="hidden" name="action" value="vyv_contact_form">
                    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('vyv_nonce'); ?>">
                    
                    <div class="form-group">
                        <label><?php _e('Nombre Completo *', 'virtud-y-victoria'); ?></label>
                        <input type="text" name="nombre" required placeholder="<?php esc_attr_e('Tu nombre completo', 'virtud-y-victoria'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label><?php _e('Correo Electrónico *', 'virtud-y-victoria'); ?></label>
                        <input type="email" name="email" required placeholder="<?php esc_attr_e('tu@email.com', 'virtud-y-victoria'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label><?php _e('Teléfono', 'virtud-y-victoria'); ?></label>
                        <input type="tel" name="telefono" placeholder="<?php esc_attr_e('+58 (XXX) XXX-XXXX', 'virtud-y-victoria'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label><?php _e('Asunto *', 'virtud-y-victoria'); ?></label>
                        <select name="asunto" required>
                            <option value=""><?php _e('Selecciona un asunto', 'virtud-y-victoria'); ?></option>
                            <option value="informacion"><?php _e('Información General', 'virtud-y-victoria'); ?></option>
                            <option value="mason"><?php _e('Quiero Ser Masón', 'virtud-y-victoria'); ?></option>
                            <option value="visita"><?php _e('Visita a la Logia', 'virtud-y-victoria'); ?></option>
                            <option value="eventos"><?php _e('Eventos', 'virtud-y-victoria'); ?></option>
                            <option value="classroom"><?php _e('Classroom', 'virtud-y-victoria'); ?></option>
                            <option value="otro"><?php _e('Otro', 'virtud-y-victoria'); ?></option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label><?php _e('Mensaje *', 'virtud-y-victoria'); ?></label>
                        <textarea name="mensaje" required placeholder="<?php esc_attr_e('Escribe tu mensaje aquí...', 'virtud-y-victoria'); ?>"></textarea>
                    </div>
                    
                    <div id="formMessages"></div>
                    
                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <i class="fas fa-paper-plane" style="margin-right: 8px;"></i>
                        <?php _e('Enviar Mensaje', 'virtud-y-victoria'); ?>
                    </button>
                </form>
            </div>
            
            <!-- Información de Contacto -->
            <div>
                <h2 style="color: #1a3a6b; margin-bottom: 10px;"><?php _e('Información de Contacto', 'virtud-y-victoria'); ?></h2>
                <p style="color: #7f8c8d; margin-bottom: 30px;"><?php _e('También puedes contactarnos directamente.', 'virtud-y-victoria'); ?></p>
                
                <div style="margin-bottom: 35px;">
                    <div style="display: flex; gap: 20px; margin-bottom: 30px;">
                        <div style="width: 55px; height: 55px; background: linear-gradient(135deg, #1a3a6b 0%, #2c5aa0 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #d4af37; font-size: 22px; flex-shrink: 0;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4 style="color: #1a3a6b; margin-bottom: 5px; font-size: 16px;"><?php _e('Dirección', 'virtud-y-victoria'); ?></h4>
                            <p style="color: #666; font-size: 15px; margin: 0;"><?php echo esc_html(get_theme_mod('vyv_address', 'Calle Falcón, Coro 4101, Estado Falcón, Venezuela')); ?></p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 20px; margin-bottom: 30px;">
                        <div style="width: 55px; height: 55px; background: linear-gradient(135deg, #1a3a6b 0%, #2c5aa0 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #d4af37; font-size: 22px; flex-shrink: 0;">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h4 style="color: #1a3a6b; margin-bottom: 5px; font-size: 16px;"><?php _e('Teléfono', 'virtud-y-victoria'); ?></h4>
                            <p style="color: #666; font-size: 15px; margin: 0;"><?php echo esc_html(get_theme_mod('vyv_phone', '+58 424-6632979')); ?></p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 20px; margin-bottom: 30px;">
                        <div style="width: 55px; height: 55px; background: linear-gradient(135deg, #1a3a6b 0%, #2c5aa0 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #d4af37; font-size: 22px; flex-shrink: 0;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4 style="color: #1a3a6b; margin-bottom: 5px; font-size: 16px;"><?php _e('Correo Electrónico', 'virtud-y-victoria'); ?></h4>
                            <p style="color: #666; font-size: 15px; margin: 0;"><?php echo esc_html(get_theme_mod('vyv_email', 'info@virtudyvictoria277.com')); ?></p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 20px;">
                        <div style="width: 55px; height: 55px; background: linear-gradient(135deg, #1a3a6b 0%, #2c5aa0 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #d4af37; font-size: 22px; flex-shrink: 0;">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h4 style="color: #1a3a6b; margin-bottom: 5px; font-size: 16px;"><?php _e('Horario de Atención', 'virtud-y-victoria'); ?></h4>
                            <p style="color: #666; font-size: 15px; margin: 0;"><?php _e('Lunes a Viernes: 9:00 AM - 5:00 PM', 'virtud-y-victoria'); ?></p>
                        </div>
                    </div>
                </div>
                
                <!-- Mapa - Usar embed del customizer o fallback a Coro -->
                <h4 style="color: #1a3a6b; margin-bottom: 15px;"><?php _e('Ubicación', 'virtud-y-victoria'); ?></h4>
                <div class="map-container" style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <?php
                    $gmaps_embed = get_theme_mod('vyv_gmaps_embed');
                    if ($gmaps_embed) :
                    ?>
                        <iframe 
                            src="<?php echo esc_url($gmaps_embed); ?>"
                            width="100%" 
                            height="350" 
                            style="border:0; display: block;" 
                            allowfullscreen="" 
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="<?php _e('Ubicación de la Logia', 'virtud-y-victoria'); ?>">
                        </iframe>
                    <?php else : ?>
                        <!-- Fallback: Coro, Falcón, Venezuela (coordenadas de la logia) -->
                        <iframe 
                            src="https://maps.google.com/maps?q=11.4101875,-69.6718125&hl=es&z=16&output=embed"
                            width="100%" 
                            height="350" 
                            style="border:0; display: block;" 
                            allowfullscreen="" 
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="<?php _e('Ubicación de la Logia', 'virtud-y-victoria'); ?>">
                        </iframe>
                    <?php endif; ?>
                </div>
            </div>
            
        </div>
        
    </div>
</section>

<!-- AJAX Form Handler -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('vyvContactForm');
    if (!form) return;
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        var messagesDiv = document.getElementById('formMessages');
        var submitBtn = form.querySelector('button[type="submit"]');
        var originalText = submitBtn.innerHTML;
        
        // Show loading
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right: 8px;"></i> Enviando...';
        submitBtn.disabled = true;
        
        var formData = new FormData(form);
        
        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            if (data.success) {
                messagesDiv.innerHTML = '<div class="form-success"><i class="fas fa-check-circle" style="margin-right: 8px;"></i>' + data.data.message + '</div>';
                form.reset();
            } else {
                messagesDiv.innerHTML = '<div class="form-error"><i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>' + data.data.message + '</div>';
            }
        })
        .catch(function() {
            messagesDiv.innerHTML = '<div class="form-error"><i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>Error de conexión. Inténtalo de nuevo.</div>';
        })
        .finally(function() {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    });
});
</script>

<?php get_footer(); ?>
