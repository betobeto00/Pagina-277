<?php
/**
 * Archive Mason Celebre Template
 *
 * @package Virtud_Y_Victoria
 */

get_header();
?>

<section class="page-header">
    <div class="container">
        <h1><?php post_type_archive_title(); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo home_url(); ?>"><?php _e('Inicio', 'virtud-y-victoria'); ?></a> / <?php post_type_archive_title(); ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php
        $masones = new WP_Query(array(
            'post_type'      => 'mason_celebre',
            'posts_per_page' => 12,
            'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
        ));
        
        if ($masones->have_posts()) :
        ?>
        <div class="cards-grid cols-4">
            <?php while ($masones->have_posts()) : $masones->the_post(); ?>
                <div class="card" style="text-align: center;">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('thumbnail', array('class' => 'card-img', 'style' => 'border-radius: 50%; width: 100px; height: 100px; margin: 20px auto;')); ?>
                    <?php else : ?>
                        <div style="width: 100px; height: 100px; background: #ecf0f1; border-radius: 50%; margin: 20px auto; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user" style="font-size: 32px; color: #95a5a6;"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <h4 style="font-size: 16px; margin-bottom: 5px;"><a href="<?php the_permalink(); ?>" style="color: inherit;"><?php the_title(); ?></a></h4>
                        <p style="font-size: 13px; font-style: italic; color: #7f8c8d;">"<?php echo wp_trim_words(get_the_excerpt(), 15); ?>"</p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        
        <!-- Paginación -->
        <?php if ($masones->max_num_pages > 1) : ?>
        <div style="text-align: center; margin-top: 50px;">
            <?php
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => '<i class="fas fa-chevron-left"></i>',
                'next_text' => '<i class="fas fa-chevron-right"></i>',
            ));
            ?>
        </div>
        <?php endif; ?>
        
        <?php else : ?>
            <div class="no-masones" style="text-align: center; padding: 60px 20px;">
                <i class="fas fa-user-astronaut" style="font-size: 64px; color: #95a5a6; margin-bottom: 20px;"></i>
                <h3 style="color: #1a3a6b; margin-bottom: 10px;"><?php _e('No hay masones célebres registrados', 'virtud-y-victoria'); ?></p>
                <p style="color: #7f8c8d;"><?php _e('Pronto agregaremos contenido.', 'virtud-y-victoria'); ?></p>
            </div>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</section>

<?php get_footer(); ?>