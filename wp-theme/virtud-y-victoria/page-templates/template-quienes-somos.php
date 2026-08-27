<?php
/**
 * Template Name: Quiénes Somos
 *
 * @package Virtud_Y_Victoria
 */

get_header();
?>

<section class="page-header page-header--quienes-somos">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb">
            <?php vyv_breadcrumb(); ?>
        </div>
    </div>
</section>

<section class="content-area">
    <div class="container">
        
        <!-- Nuestra Historia -->
        <div style="margin-bottom: 60px;" data-animate="fadeInUp">
            <h2><?php _e('Nuestra Historia', 'virtud-y-victoria'); ?></h2>
            <div style="border-radius: var(--border-radius-lg); overflow: hidden; box-shadow: var(--shadow-md); margin-bottom: 25px;">
                <img src="<?php echo esc_url(VYV_URI . '/assets/images/templo-foto1.jpg'); ?>"
                     alt="Cuadro Logial Virtud y Victoria Nº 277 en ceremonia"
                     style="width: 100%; height: auto; display: block;"
                     loading="lazy">
            </div>
            <p>La Respetable Logia Simbólica Virtud y Victoria Nº 277 fue <strong>jurisdiccionada el <?php echo esc_html(get_theme_mod('vyv_fundacion_fecha', '18 de julio de 2022')); ?></strong> a la Muy Respetable Gran Logia de la República de Venezuela, en la ciudad de <?php echo esc_html(get_theme_mod('vyv_ciudad', 'Coro')); ?>, Estado <?php echo esc_html(get_theme_mod('vyv_estado', 'Falcón')); ?>.</p>
            <p>Desde su fundación, la logia ha mantenido vivo el espíritu masónico, trabajando bajo los principios de Amor Fraternal, Caridad y Verdad, y contribuyendo al bienestar de la comunidad.</p>
        </div>
        
        <!-- Misión y Visión -->
        <div class="page-mission-grid" data-animate-stagger>
            <div style="background: #f8f9fa; padding: 40px; border-radius: var(--border-radius-xl); border-left: 4px solid var(--color-secondary);">
                <h3 style="color: var(--color-primary); margin-bottom: 15px;"><i class="fas fa-bullseye" style="color: var(--color-secondary); margin-right: 10px;"></i><?php _e('Misión', 'virtud-y-victoria'); ?></h3>
                <p style="color: #555; line-height: 1.8;">Somos una institución que busca el perfeccionamiento moral e intelectual de sus miembros a través de la práctica de los principios masónicos, promoviendo la solidaridad, la educación y el servicio a la comunidad.</p>
            </div>
            
            <div style="background: #f8f9fa; padding: 40px; border-radius: var(--border-radius-xl); border-left: 4px solid var(--color-primary);">
                <h3 style="color: var(--color-primary); margin-bottom: 15px;"><i class="fas fa-eye" style="color: var(--color-primary); margin-right: 10px;"></i><?php _e('Visión', 'virtud-y-victoria'); ?></h3>
                <p style="color: #555; line-height: 1.8;">Ser una logia referente en la región por la calidad de sus trabajos masónicos, la formación de hombres virtuosos y su contribución al desarrollo social y cultural de nuestra comunidad.</p>
            </div>
        </div>
        
        <!-- Valores -->
        <div style="margin-bottom: 60px;">
            <h2 style="text-align: center; margin-bottom: 40px;" data-animate="fadeInUp"><?php _e('Nuestros Valores', 'virtud-y-victoria'); ?></h2>
            <div class="cards-grid cols-4" data-animate-stagger>
                <div class="card valor-card">
                    <div class="valor-icon">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h4><?php _e('Virtud', 'virtud-y-victoria'); ?></h4>
                    <p>La práctica constante de la moralidad y la rectitud.</p>
                </div>
                
                <div class="card valor-card">
                    <div class="valor-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h4><?php _e('Victoria', 'virtud-y-victoria'); ?></h4>
                    <p>El triunfo sobre las pasiones y la conquista del conocimiento.</p>
                </div>
                
                <div class="card valor-card">
                    <div class="valor-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4><?php _e('Fraternidad', 'virtud-y-victoria'); ?></h4>
                    <p>El lazo que une a todos los hermanos en paz y armonía.</p>
                </div>
                
                <div class="card valor-card">
                    <div class="valor-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h4><?php _e('Sabiduría', 'virtud-y-victoria'); ?></h4>
                    <p>La búsqueda incansable de la verdad y el conocimiento.</p>
                </div>
            </div>
        </div>
        
        <!-- El Templo -->
        <div style="margin-bottom: 60px;" data-animate="fadeInUp">
            <h2><?php _e('Nuestro Templo', 'virtud-y-victoria'); ?></h2>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start;">
                <?php $gmaps_embed = get_theme_mod('vyv_gmaps_embed'); if ($gmaps_embed) : ?>
                    <div style="border-radius: var(--border-radius-lg); overflow: hidden; box-shadow: var(--shadow-md); aspect-ratio: 4/3;">
                        <iframe src="<?php echo esc_url($gmaps_embed); ?>"
                                width="100%" height="100%"
                                style="border: 0; display: block;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                title="Ubicación de la Logia"></iframe>
                    </div>
                <?php else : ?>
                    <div class="img-placeholder" style="margin-bottom: 0;">
                        <div style="text-align: center;">
                            <i class="fas fa-church" style="margin-bottom: 15px;"></i>
                            <p>[Foto del templo]</p>
                        </div>
                    </div>
                <?php endif; ?>
                <div>
                    <p>Nuestro templo se encuentra ubicado en <strong><?php echo esc_html(get_theme_mod('vyv_address', 'Calle Falcón, Coro 4101, Estado Falcón, Venezuela')); ?></strong>.</p>
                    <p>Es el espacio sagrado donde se reúnen los hermanos para realizar sus trabajos masónicos bajo los principios de fraternidad y armonía.</p>
                    <div style="margin-top: 25px;">
                        <?php if ($address = get_theme_mod('vyv_address')) : ?>
                            <p style="margin-bottom: 10px;"><i class="fas fa-map-marker-alt" style="color: var(--color-secondary); margin-right: 10px; width: 20px;"></i> <?php echo esc_html($address); ?></p>
                        <?php endif; ?>
                        <?php if ($phone = get_theme_mod('vyv_phone')) : ?>
                            <p style="margin-bottom: 10px;"><i class="fas fa-phone" style="color: var(--color-secondary); margin-right: 10px; width: 20px;"></i> <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" style="color: inherit;"><?php echo esc_html($phone); ?></a></p>
                        <?php endif; ?>
                        <?php if ($email = get_theme_mod('vyv_email')) : ?>
                            <p style="margin-bottom: 10px;"><i class="fas fa-envelope" style="color: var(--color-secondary); margin-right: 10px; width: 20px;"></i> <a href="mailto:<?php echo esc_attr($email); ?>" style="color: inherit;"><?php echo esc_html($email); ?></a></p>
                        <?php endif; ?>
                        <?php if ($gmaps_url = get_theme_mod('vyv_gmaps_url')) : ?>
                            <p style="margin-top: 15px;">
                                <a href="<?php echo esc_url($gmaps_url); ?>" target="_blank" rel="noopener" class="btn btn-secondary" style="display: inline-flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-directions"></i> <?php _e('Cómo llegar', 'virtud-y-victoria'); ?>
                                </a>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Cuadro Logial -->
        <div style="margin-bottom: 60px;">
            <h2 style="text-align: center; margin-bottom: 15px;" data-animate="fadeInUp"><?php _e('Cuadro Logial Actual', 'virtud-y-victoria'); ?></h2>
            <p style="text-align: center; color: var(--color-gray); margin-bottom: 40px; font-style: italic;">Período <?php echo date('Y'); ?></p>

            <!-- Venerable Maestro (destacado) -->
            <div style="display: flex; justify-content: center; margin-bottom: 50px;" data-animate="scaleIn">
                <div class="card cuadro-logial-card cuadro-vm">
                    <div class="cuadro-avatar vm">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="card-body">
                        <p class="cuadro-role"><?php _e('Venerable Maestro', 'virtud-y-victoria'); ?></p>
                        <p class="cuadro-name">Jorge Morillo</p>
                    </div>
                </div>
            </div>

            <!-- Vigilantes -->
            <h3 style="text-align: center; color: var(--color-primary); margin-bottom: 25px; font-size: 1.3rem;" data-animate="fadeInUp">
                <i class="fas fa-users" style="color: var(--color-secondary); margin-right: 10px;"></i><?php _e('Vigilantes', 'virtud-y-victoria'); ?>
            </h3>
            <div class="cards-grid cols-3" style="margin-bottom: 40px;" data-animate-stagger>
                <div class="card cuadro-logial-card">
                    <div class="cuadro-avatar">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="card-body">
                        <p class="cuadro-role"><?php _e('Primer Vigilante', 'virtud-y-victoria'); ?></p>
                        <p class="cuadro-name">José Weffer</p>
                    </div>
                </div>

                <div class="card cuadro-logial-card">
                    <div class="cuadro-avatar">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="card-body">
                        <p class="cuadro-role"><?php _e('Segundo Vigilante', 'virtud-y-victoria'); ?></p>
                        <p class="cuadro-name">Daviel Fernández</p>
                    </div>
                </div>

                <div class="card cuadro-logial-card cuadro-vacant">
                    <div class="cuadro-avatar">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="card-body">
                        <p class="cuadro-role"><?php _e('Orador Fiscal', 'virtud-y-victoria'); ?></p>
                        <p class="cuadro-name">Javier Levane</p>
                    </div>
                </div>
            </div>

            <!-- Oficiales -->
            <h3 style="text-align: center; color: var(--color-primary); margin-bottom: 25px; font-size: 1.3rem;" data-animate="fadeInUp">
                <i class="fas fa-scroll" style="color: var(--color-secondary); margin-right: 10px;"></i><?php _e('Oficiales', 'virtud-y-victoria'); ?>
            </h3>
            <div class="cards-grid cols-3" data-animate-stagger>
                <div class="card cuadro-logial-card">
                    <div class="cuadro-avatar small">
                        <i class="fas fa-pen-nib"></i>
                    </div>
                    <div class="card-body">
                        <p class="cuadro-role"><?php _e('Secretario', 'virtud-y-victoria'); ?></p>
                        <p class="cuadro-name">Luis Jiménez</p>
                    </div>
                </div>

                <div class="card cuadro-logial-card">
                    <div class="cuadro-avatar small">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="card-body">
                        <p class="cuadro-role"><?php _e('Tesorero', 'virtud-y-victoria'); ?></p>
                        <p class="cuadro-name">Deynis Colina</p>
                    </div>
                </div>

                <div class="card cuadro-logial-card">
                    <div class="cuadro-avatar small">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="card-body">
                        <p class="cuadro-role"><?php _e('Primer Experto', 'virtud-y-victoria'); ?></p>
                        <p class="cuadro-name">Williams Pérez</p>
                    </div>
                </div>

                <div class="card cuadro-logial-card">
                    <div class="cuadro-avatar small">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="card-body">
                        <p class="cuadro-role"><?php _e('Segundo Experto', 'virtud-y-victoria'); ?></p>
                        <p class="cuadro-name">Kalec Bou</p>
                    </div>
                </div>

                <div class="card cuadro-logial-card">
                    <div class="cuadro-avatar small">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <div class="card-body">
                        <p class="cuadro-role"><?php _e('Primer Maestro de Ceremonias', 'virtud-y-victoria'); ?></p>
                        <p class="cuadro-name">Jesús de la Rosa</p>
                    </div>
                </div>

                <div class="card cuadro-logial-card">
                    <div class="cuadro-avatar small">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <div class="card-body">
                        <p class="cuadro-role"><?php _e('Segundo Maestro de Ceremonias', 'virtud-y-victoria'); ?></p>
                        <p class="cuadro-name">Guiseppe Pino</p>
                    </div>
                </div>

                <div class="card cuadro-logial-card">
                    <div class="cuadro-avatar small">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <div class="card-body">
                        <p class="cuadro-role"><?php _e('Hospitalario', 'virtud-y-victoria'); ?></p>
                        <p class="cuadro-name">Roger Saavedra</p>
                    </div>
                </div>

                <div class="card cuadro-logial-card">
                    <div class="cuadro-avatar small">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="card-body">
                        <p class="cuadro-role"><?php _e('Guarda Templo Interior', 'virtud-y-victoria'); ?></p>
                        <p class="cuadro-name">Numan Bolívar</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- CTA -->
        <div class="page-cta-final" data-animate="fadeInUp">
            <h2><?php _e('¿Quieres Conocernos?', 'virtud-y-victoria'); ?></h2>
            <p>Si deseas formar parte de nuestra logia o simplemente conocer más sobre la Masonería, no dudes en contactarnos.</p>
            <a href="<?php echo home_url('/contacto'); ?>" class="btn btn-primary"><?php _e('Contáctanos', 'virtud-y-victoria'); ?></a>
        </div>
        
    </div>
</section>

<?php get_footer(); ?>
