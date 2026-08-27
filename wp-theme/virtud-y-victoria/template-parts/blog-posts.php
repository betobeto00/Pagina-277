<?php
/**
 * Blog Posts Template Part - Improved
 *
 * @package Virtud_Y_Victoria
 */

$posts_per_page = get_theme_mod('vyv_blog_posts_count', 4);
$recent_posts = new WP_Query(array(
    'posts_per_page' => $posts_per_page,
    'post_status'    => 'publish',
));
?>

<!-- Blog Posts Recientes -->
<section class="section section-alt">
    <div class="container">
        <div class="section-title" data-animate="fadeInUp">
            <h2><?php _e('Nuestro Blog', 'virtud-y-victoria'); ?></h2>
            <p class="subtitle"><?php _e('Descubre los últimos artículos y reflexiones de nuestra comunidad', 'virtud-y-victoria'); ?></p>
            <div class="separator-line"></div>
        </div>
        
        <?php if ($recent_posts->have_posts()) : ?>
            <div class="cards-grid cols-4" data-animate-stagger>
                <?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                    <article class="blog-post-card">
                        <a href="<?php the_permalink(); ?>" class="blog-post-image" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium_large')); ?>');">
                            <div class="post-date-badge">
                                <span class="day"><?php echo date('d', strtotime(get_the_date('Y-m-d'))); ?></span>
                                <span class="month"><?php echo strtoupper(date('M', strtotime(get_the_date('Y-m-d')))); ?></span>
                            </div>
                        </a>
                        <div class="blog-post-content">
                            <div class="post-meta">
                                <span><i class="far fa-user"></i> <?php the_author(); ?></span>
                            </div>
                            <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p class="post-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            <a href="<?php the_permalink(); ?>" class="read-more">
                                <?php _e('Leer más', 'virtud-y-victoria'); ?> <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            
            <div style="text-align: center; margin-top: 40px;" data-animate="fadeInUp">
                <a href="<?php echo esc_url(home_url('/blog')); ?>" class="btn btn-secondary">
                    <?php _e('Ver Todos los Artículos', 'virtud-y-victoria'); ?>
                </a>
            </div>
        <?php else : ?>
            <div class="no-posts">
                <p><?php _e('No hay artículos disponibles en este momento.', 'virtud-y-victoria'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>
