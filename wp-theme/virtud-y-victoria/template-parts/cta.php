<?php
/**
 * CTA Template Part - Parallax Style
 *
 * @package Virtud_Y_Victoria
 */

$cta_title = get_theme_mod('vyv_cta_title', '¿Quieres Ser Masón?');
$cta_text = get_theme_mod('vyv_cta_text', 'La Masonería es una institución de hombres libres que buscan hacer el bien. Si deseas conocernos, estamos aquí para responder tus preguntas.');
$cta_button_text = get_theme_mod('vyv_cta_button_text', 'Contáctanos');
$cta_button_url = get_theme_mod('vyv_cta_button_url', home_url('/contacto'));
?>

<!-- CTA: Únete - Parallax -->
<section class="cta-parallax" data-parallax="0.3" style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/templo-foto1.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="container" data-animate="fadeInUp">
        <h2><?php echo esc_html($cta_title); ?></h2>
        <p><?php echo wp_kses_post($cta_text); ?></p>
        <a href="<?php echo esc_url($cta_button_url); ?>" class="btn-cta-large">
            <i class="fas fa-envelope" style="margin-right: 10px;"></i>
            <?php echo esc_html($cta_button_text); ?>
        </a>
    </div>
</section>
