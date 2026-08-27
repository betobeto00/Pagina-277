<?php
/**
 * Template Name: Blog
 *
 * @package Virtud_Y_Victoria
 */

get_header();
?>

<section class="page-header page-header--blog">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo home_url(); ?>">Inicio</a> / <?php the_title(); ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        
        <!-- Filtros de Categoría -->
        <div style="margin-bottom: 40px; display: flex; gap: 15px; flex-wrap: wrap; justify-content: center;" data-animate="fadeInUp">
            <span style="padding: 10px 20px; background: #1a3a6b; color: white; border-radius: 25px; font-size: 14px; font-weight: 500; cursor: pointer;"><?php _e('Todos', 'virtud-y-victoria'); ?></span>
            <?php
            $categories = get_categories(array(
                'orderby' => 'name',
                'order'   => 'ASC',
            ));
            
            foreach ($categories as $category) :
            ?>
                <span style="padding: 10px 20px; background: #ecf0f1; color: #666; border-radius: 25px; font-size: 14px; cursor: pointer;"><?php echo esc_html($category->name); ?></span>
            <?php endforeach; ?>
        </div>
        
        <!-- Grid de Artículos -->
        <div data-animate-stagger>
        <?php
        $blog_posts = new WP_Query(array(
            'post_type'      => 'post',
            'posts_per_page' => 9,
            'post_status'    => 'publish',
        ));
        
        if ($blog_posts->have_posts()) :
        ?>
        <div class="cards-grid">
            <?php
            while ($blog_posts->have_posts()) : $blog_posts->the_post();
            ?>
                <article class="card">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="card-img-wrapper">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium_large', array('class' => 'card-img')); ?>
                            </a>
                        </div>
                    <?php else : ?>
                        <div class="card-img" style="background: linear-gradient(135deg, #1a3a6b 0%, #2c5aa0 100%); display: flex; align-items: center; justify-content: center; color: #d4af37;">
                            <i class="fas fa-scroll" style="font-size: 48px;"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <div class="card-meta">
                            <span>📅 <?php echo get_the_date(); ?></span>
                            <span>•</span>
                            <span><?php echo get_the_category_list(', '); ?></span>
                        </div>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        <a href="<?php the_permalink(); ?>" class="card-link">
                            <?php _e('Leer más →', 'virtud-y-victoria'); ?>
                        </a>
                    </div>
                </article>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
        <?php else : ?>
        <!-- Posts de ejemplo -->
        <div class="cards-grid">
            <?php for ($i = 1; $i <= 6; $i++) : ?>
                <article class="card">
                    <div class="card-img" style="background: linear-gradient(135deg, <?php echo ($i % 2 == 0) ? '#1a3a6b' : '#2c5aa0'; ?> 0%, <?php echo ($i % 2 == 0) ? '#2c5aa0' : '#1a3a6b'; ?> 100%); display: flex; align-items: center; justify-content: center; color: #d4af37;">
                        <i class="fas fa-scroll" style="font-size: 48px;"></i>
                    </div>
                    <div class="card-body">
                        <div class="card-meta">
                            <span>📅 <?php echo date('d M Y', strtotime("-{$i} days")); ?></span>
                            <span>•</span>
                            <span><?php _e('Noticias', 'virtud-y-victoria'); ?></span>
                        </div>
                        <h3><?php _e('Artículo de ejemplo', 'virtud-y-victoria'); ?> <?php echo $i; ?></h3>
                        <p><?php _e('Descripción breve del artículo con información relevante para los lectores.', 'virtud-y-victoria'); ?></p>
                        <a href="#" class="card-link">
                            <?php _e('Leer más →', 'virtud-y-victoria'); ?>
                        </a>
                    </div>
                </article>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
        </div>
        
        <!-- Paginación -->
        <div style="text-align: center; margin-top: 50px;" data-animate="fadeInUp">
            <?php
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => '&laquo; Anterior',
                'next_text' => 'Siguiente &raquo;',
            ));
            ?>
        </div>
        
    </div>
</section>

<?php get_footer(); ?>
