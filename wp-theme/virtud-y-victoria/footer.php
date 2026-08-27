<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Columna 1: Info de la logia -->
            <div class="footer-col">
                <img src="<?php echo esc_url(VYV_URI . '/assets/images/logo-footer.png'); ?>" alt="<?php bloginfo('name'); ?>" style="max-width: 120px; height: auto; margin-bottom: 15px;">
                <h4><?php bloginfo('name'); ?></h4>
                <p>Respetable Logia Simbólica Virtud y Victoria Nº 277</p>
                
                <?php if (get_theme_mod('vyv_address')) : ?>
                    <p><i class="fas fa-map-marker-alt"></i> <?php echo esc_html(get_theme_mod('vyv_address')); ?></p>
                <?php endif; ?>
                
                <?php if (get_theme_mod('vyv_phone')) : ?>
                    <p><i class="fas fa-phone"></i> <?php echo esc_html(get_theme_mod('vyv_phone')); ?></p>
                <?php endif; ?>
                
                <?php if (get_theme_mod('vyv_email')) : ?>
                    <p><i class="fas fa-envelope"></i> <a href="mailto:<?php echo esc_attr(get_theme_mod('vyv_email')); ?>"><?php echo esc_html(get_theme_mod('vyv_email')); ?></a></p>
                <?php endif; ?>
                
                <div class="social-links">
                    <?php if (get_theme_mod('vyv_facebook')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('vyv_facebook')); ?>" target="_blank" rel="noopener" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    <?php endif; ?>
                    
                    <?php if (get_theme_mod('vyv_instagram')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('vyv_instagram')); ?>" target="_blank" rel="noopener" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Columna 2: Enlaces -->
            <div class="footer-col">
                <h4><?php _e('Enlaces', 'virtud-y-victoria'); ?></h4>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'     => 'footer-menu',
                    'depth'          => 1,
                ));
                ?>
            </div>
            
            <!-- Columna 3: Legal -->
            <div class="footer-col">
                <h4><?php _e('Legal', 'virtud-y-victoria'); ?></h4>
                <ul>
                    <li><a href="<?php echo esc_url(get_privacy_policy_url()); ?>"><?php _e('Política de Privacidad', 'virtud-y-victoria'); ?></a></li>
                </ul>
            </div>
            
            <!-- Columna 4: Widget -->
            <div class="footer-col">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <?php dynamic_sidebar('footer-1'); ?>
                <?php else : ?>
                    <h4><?php _e('Síguenos', 'virtud-y-victoria'); ?></h4>
                    <p><?php _e('Mantente conectado con nuestra logia.', 'virtud-y-victoria'); ?></p>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('Todos los derechos reservados.', 'virtud-y-victoria'); ?></p>
                <?php $gran_logia_url = get_theme_mod('vyv_gran_logia_url', 'https://granlogiadevenezuela.com'); ?>
                <a href="<?php echo esc_url($gran_logia_url); ?>" target="_blank" rel="noopener" class="footer-gran-logia" aria-label="<?php _e('Sitio de la Gran Logia de Venezuela', 'virtud-y-victoria'); ?>">
                    <img src="<?php echo esc_url(VYV_URI . '/assets/images/gran-logia-venezuela.jpg'); ?>"
                         alt="Gran Logia de Venezuela"
                         loading="lazy">
                    <span><?php _e('Bajo jurisdicción de la', 'virtud-y-victoria'); ?><br><strong><?php _e('Gran Logia de Venezuela', 'virtud-y-victoria'); ?></strong></span>
                </a>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top -->
<a href="#" class="back-to-top" id="backToTop" aria-label="<?php esc_attr_e('Volver arriba', 'virtud-y-victoria'); ?>">
    <i class="fas fa-chevron-up"></i>
</a>

<?php wp_footer(); ?>
</body>
</html>
