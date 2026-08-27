<?php
/**
 * Masones Célebres Template Part - Carousel Style
 *
 * @package Virtud_Y_Victoria
 */

$masones_per_page = get_theme_mod('vyv_masones_count', 6);
$masones_query = new WP_Query(array(
    'post_type'      => 'mason_celebre',
    'posts_per_page' => $masones_per_page,
));

if ($masones_query->have_posts()) :
?>
<!-- Masones Célebres - Carousel -->
<section class="masones-carousel">
    <div class="container">
        <div class="section-title" data-animate="fadeInUp">
            <h2><?php _e('Masones Célebres', 'virtud-y-victoria'); ?></h2>
            <p class="subtitle"><?php _e('Personalidades que honran nuestra tradición', 'virtud-y-victoria'); ?></p>
            <div class="separator-line"></div>
        </div>
    </div>
    
    <div class="masones-track" data-animate="fadeIn">
        <?php while ($masones_query->have_posts()) : $masones_query->the_post();
            $pais = get_post_meta(get_the_ID(), '_vyv_pais', true);
            $epoca = get_post_meta(get_the_ID(), '_vyv_epoca', true);
        ?>
            <div class="masones-slide">
                <div class="mason-avatar-carousel">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('thumbnail', array('style' => 'width:100%;height:100%;object-fit:cover;')); ?>
                    <?php else : ?>
                        <div class="avatar-placeholder">
                            <i class="fas fa-user"></i>
                        </div>
                    <?php endif; ?>
                </div>
                <h3 class="mason-name"><?php the_title(); ?></h3>
                <?php if ($pais) : ?>
                    <p class="mason-subtitle"><?php echo esc_html($pais); ?><?php if ($epoca) echo ' · ' . esc_html(ucfirst(str_replace('-', ' ', $epoca))); ?></p>
                <?php endif; ?>
                <div class="mason-quote">
                    <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                </div>
            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </div>
    
    <div class="container" style="text-align: center; margin-top: 30px;">
        <a href="<?php echo esc_url(home_url('/masones-celebres')); ?>" class="btn btn-secondary" style="background: rgba(255,255,255,0.15); color: white; border: 1px solid rgba(255,255,255,0.3);" data-animate="fadeInUp">
            <?php _e('Ver Todos los Masones', 'virtud-y-victoria'); ?> <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
        </a>
    </div>
</section>
<?php endif; ?>
