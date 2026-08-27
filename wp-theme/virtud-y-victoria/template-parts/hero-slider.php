<?php
/**
 * Hero Slider Template Part
 *
 * @package Virtud_Y_Victoria
 */

// Build slides from customizer settings
$hero_slides = array();
for ($i = 1; $i <= 3; $i++) {
    $title = get_theme_mod("vyv_hero_slide_{$i}_title");
    if ($title) {
        $hero_slides[] = array(
            'title'     => $title,
            'subtitle'  => get_theme_mod("vyv_hero_slide_{$i}_subtitle"),
            'text'      => get_theme_mod("vyv_hero_slide_{$i}_text"),
            'cta_text'  => get_theme_mod("vyv_hero_slide_{$i}_cta_text"),
            'cta_url'   => get_theme_mod("vyv_hero_slide_{$i}_cta_url"),
            'image'     => get_theme_mod("vyv_hero_slide_{$i}_image"),
        );
    }
}

// Fallback default slides if none configured
if (empty($hero_slides)) {
    $hero_slides = array(
        array(
            'title'     => 'Virtud y Victoria Nº 277',
            'subtitle'  => 'Respetable Logia Simb&oacute;lica',
            'text'      => 'Trabajamos bajo los principios de Amor Fraternal, Caridad y Verdad para el perfeccionamiento de la humanidad.',
            'cta_text'  => 'Cont&aacute;ctanos',
            'cta_url'   => home_url('/contacto'),
            'image'     => '',
        ),
        array(
            'title'     => 'La Masoner&iacute;a',
            'subtitle'  => 'Ciencia Moral y Filos&oacute;fica',
            'text'      => 'Una instituci&oacute;n que busca la verdad, estudia la moral universal y practica la solidaridad.',
            'cta_text'  => 'Conoce M&aacute;s',
            'cta_url'   => home_url('/la-masoneria'),
            'image'     => '',
        ),
        array(
            'title'     => 'Eventos y Tenidas',
            'subtitle'  => 'Calendario de Actividades',
            'text'      => 'Participa en nuestras tenidas ordinarias, ceremonias y eventos filantr&oacute;picos.',
            'cta_text'  => 'Ver Eventos',
            'cta_url'   => home_url('/eventos'),
            'image'     => '',
        ),
    );
}
?>

<!-- Hero Slider -->
<section class="hero-section">
    <div class="hero-slider-container">
        <div class="hero-slider" id="heroSlider">
            <?php foreach ($hero_slides as $index => $slide) : ?>
                <div class="hero-slide <?php echo $index === 0 ? 'active' : ''; ?>" style="<?php echo $slide['image'] ? 'background-image: url(' . esc_url($slide['image']) . ');' : ''; ?>">
                    <div class="container">
                        <div class="hero-content" data-animate="fadeInUp" data-animate-delay="<?php echo $index * 200; ?>">
                            <h1><?php echo wp_kses_post($slide['title']); ?>
                                <?php if (!empty($slide['subtitle'])) : ?>
                                    <span><?php echo wp_kses_post($slide['subtitle']); ?></span>
                                <?php endif; ?>
                            </h1>
                            <?php if (!empty($slide['text'])) : ?>
                                <p><?php echo wp_kses_post($slide['text']); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($slide['cta_text']) && !empty($slide['cta_url'])) : ?>
                                <a href="<?php echo esc_url($slide['cta_url']); ?>" class="btn btn-primary btn-lg">
                                    <?php echo esc_html($slide['cta_text']); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Navigation -->
        <button class="hero-slider-nav hero-slider-prev" aria-label="Slide anterior">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="hero-slider-nav hero-slider-next" aria-label="Slide siguiente">
            <i class="fas fa-chevron-right"></i>
        </button>
        
        <!-- Indicators -->
        <div class="hero-slider-indicators">
            <?php foreach ($hero_slides as $index => $slide) : ?>
                <button class="hero-slider-dot <?php echo $index === 0 ? 'active' : ''; ?>" data-slide="<?php echo $index; ?>" aria-label="Slide <?php echo $index + 1; ?>"></button>
            <?php endforeach; ?>
        </div>
    </div>
</section>