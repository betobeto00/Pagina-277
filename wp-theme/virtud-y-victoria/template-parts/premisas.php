<?php
/**
 * Premisas Template Part - Improved
 *
 * @package Virtud_Y_Victoria
 */

$premisas = get_theme_mod('vyv_premisas', array(
    array(
        'icon'  => 'fa-heart',
        'title' => 'Amor Fraternal',
        'text'  => 'El vínculo que une a todos los hermanos en una relación de respeto, apoyo y solidaridad mutua.',
    ),
    array(
        'icon'  => 'fa-hands-helping',
        'title' => 'Caridad',
        'text'  => 'El compromiso de servir a la comunidad y auxiliar a quienes más lo necesitan.',
    ),
    array(
        'icon'  => 'fa-star',
        'title' => 'Verdad',
        'text'  => 'La búsqueda constante de la sabiduría y el conocimiento como camino hacia la luz.',
    ),
));
?>

<!-- Premisas -->
<section class="section">
    <div class="container">
        <div class="section-title" data-animate="fadeInUp">
            <h2><?php _e('Nuestras Premisas', 'virtud-y-victoria'); ?></h2>
            <p class="subtitle"><?php _e('Los tres pilares que guían nuestro trabajo masónico', 'virtud-y-victoria'); ?></p>
            <div class="separator-line"></div>
        </div>
        
        <div class="premisas-grid" data-animate-stagger>
            <?php foreach ($premisas as $index => $premisa) : ?>
                <div class="premisa" data-animate="fadeInUp" data-animate-delay="<?php echo $index * 150; ?>">
                    <div class="premisa-icon">
                        <i class="fas <?php echo esc_attr($premisa['icon']); ?>"></i>
                    </div>
                    <h3><?php echo esc_html($premisa['title']); ?></h3>
                    <p><?php echo wp_kses_post($premisa['text']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
