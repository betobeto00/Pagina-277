<?php
/**
 * Template Name: Masones Célebres
 *
 * @package Virtud_Y_Victoria
 */

get_header();

// Obtener las secciones padre (Internacionales, Venezolanos)
$secciones = get_terms(array(
    'taxonomy'   => 'categoria_mason',
    'hide_empty' => true,
    'parent'     => 0,
));
?>

<section class="page-header page-header--masones">
    <div class="container">
        <h1><?php echo esc_html(get_the_title()); ?></h1>
        <div class="breadcrumb">
            <?php vyv_breadcrumb(); ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">

        <?php
        $page_content = get_the_content();
        if (!empty(trim(strip_tags($page_content)))) : ?>
            <div class="page-intro" style="max-width: 900px; margin: 0 auto 50px; text-align: center;">
                <?php echo wpautop($page_content); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($secciones) && !is_wp_error($secciones)) : ?>
            <?php foreach ($secciones as $seccion) :
                $hijos = get_terms(array(
                    'taxonomy'   => 'categoria_mason',
                    'hide_empty' => true,
                    'parent'     => $seccion->term_id,
                ));

                if (empty($hijos) || is_wp_error($hijos)) continue;
            ?>
                <div class="mason-section" style="margin-bottom: 60px;">
                    <h2 style="text-align: center; color: var(--color-primary); margin-bottom: 10px; font-size: 2rem;">
                        <?php if ($seccion->slug === 'internacional') : ?>
                            <i class="fas fa-globe-americas" style="color: var(--color-secondary); margin-right: 10px;"></i>
                        <?php elseif ($seccion->slug === 'venezolano') : ?>
                            <i class="fas fa-flag" style="color: var(--color-secondary); margin-right: 10px;"></i>
                        <?php else : ?>
                            <i class="fas fa-star" style="color: var(--color-secondary); margin-right: 10px;"></i>
                        <?php endif; ?>
                        <?php echo esc_html($seccion->name); ?>
                    </h2>
                    <?php if ($seccion->description) : ?>
                        <p style="text-align: center; color: var(--color-gray); font-style: italic; margin-bottom: 30px;">
                            <?php echo esc_html($seccion->description); ?>
                        </p>
                    <?php endif; ?>

                    <?php foreach ($hijos as $subcategoria) :
                        $query = new WP_Query(array(
                            'post_type'      => 'mason_celebre',
                            'posts_per_page' => -1,
                            'tax_query'      => array(
                                array(
                                    'taxonomy' => 'categoria_mason',
                                    'field'    => 'term_id',
                                    'terms'    => $subcategoria->term_id,
                                ),
                            ),
                            'orderby' => 'title',
                            'order'   => 'ASC',
                        ));

                        if (!$query->have_posts()) continue;
                    ?>
                        <div class="mason-subcategoria" style="margin-bottom: 40px;">
                            <h3 style="text-align: center; color: var(--color-primary); margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid var(--color-secondary); display: inline-block; width: 100%;">
                                <?php echo esc_html($subcategoria->name); ?>
                                <span style="font-size: 0.9rem; color: var(--color-gray); font-weight: normal; margin-left: 10px;">
                                    (<?php echo $query->found_posts; ?>)
                                </span>
                            </h3>

                            <div class="cards-grid cols-3">
                                <?php while ($query->have_posts()) : $query->the_post();
                                    $logia = get_post_meta(get_the_ID(), '_vyv_logia', true);
                                    $pais = get_post_meta(get_the_ID(), '_vyv_pais', true);
                                    $nacimiento = get_post_meta(get_the_ID(), '_vyv_nacimiento', true);
                                    $fallecimiento = get_post_meta(get_the_ID(), '_vyv_fallecimiento', true);
                                    $epoca = get_post_meta(get_the_ID(), '_vyv_epoca', true);
                                    $grado = get_post_meta(get_the_ID(), '_vyv_grado', true);

                                    $epoca_label = '';
                                    if ($epoca === 'siglo-xviii') $epoca_label = 'S. XVIII';
                                    elseif ($epoca === 'siglo-xix') $epoca_label = 'S. XIX';
                                    elseif ($epoca === 'siglo-xx') $epoca_label = 'S. XX';
                                    elseif ($epoca === 'siglo-xxi') $epoca_label = 'S. XXI';

                                    $anos = '';
                                    if ($nacimiento) {
                                        $anos = $nacimiento;
                                        if ($fallecimiento) $anos .= ' - ' . $fallecimiento;
                                        else $anos .= ' - presente';
                                    }
                                ?>
                                    <div class="card mason-card-detailed">
                                        <div class="mason-card-header">
                                            <div class="mason-icon-large">
                                                <i class="fas fa-user-tie"></i>
                                            </div>
                                            <?php if ($epoca_label) : ?>
                                                <span class="mason-epoca"><?php echo esc_html($epoca_label); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-body">
                                            <h4 style="margin-bottom: 8px; color: var(--color-primary);"><?php the_title(); ?></h4>
                                            <?php if ($anos) : ?>
                                                <p style="font-size: 0.85rem; color: var(--color-gray); margin-bottom: 8px;">
                                                    <i class="far fa-calendar"></i> <?php echo esc_html($anos); ?>
                                                </p>
                                            <?php endif; ?>
                                            <?php if ($pais) : ?>
                                                <p style="font-size: 0.85rem; color: var(--color-gray); margin-bottom: 8px;">
                                                    <i class="fas fa-map-marker-alt"></i> <?php echo esc_html($pais); ?>
                                                </p>
                                            <?php endif; ?>
                                            <?php if ($grado) : ?>
                                                <p style="font-size: 0.85rem; color: var(--color-secondary); margin-bottom: 8px; font-weight: 600;">
                                                    <i class="fas fa-star"></i> <?php echo esc_html($grado); ?>
                                                </p>
                                            <?php endif; ?>
                                            <p class="mason-excerpt" style="font-size: 0.9rem; line-height: 1.5; margin-bottom: 12px;">
                                                <?php echo wp_trim_words(get_the_excerpt(), 18); ?>
                                            </p>
                                            <?php if ($logia) : ?>
                                                <details style="margin-top: 10px;">
                                                    <summary style="cursor: pointer; color: var(--color-primary); font-size: 0.85rem; font-weight: 600;">
                                                        <i class="fas fa-info-circle"></i> Ver logia
                                                    </summary>
                                                    <p style="font-size: 0.8rem; color: var(--color-gray); margin-top: 8px; padding: 10px; background: var(--bg-alt); border-radius: 4px;">
                                                        <?php echo esc_html($logia); ?>
                                                    </p>
                                                </details>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endwhile; wp_reset_postdata(); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p style="text-align: center;"><?php _e('No hay masones célebres registrados aún.', 'virtud-y-victoria'); ?></p>
        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>
