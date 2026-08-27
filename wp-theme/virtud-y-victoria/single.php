<?php
/**
 * Template para entradas individuales
 *
 * @package Virtud_Y_Victoria
 */

get_header();
?>

<section class="page-header">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb">
            <?php vyv_breadcrumb(); ?>
        </div>
    </div>
</section>

<section class="content-area">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail" style="margin-bottom: 30px;">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="post-meta">
                    <span>📅 <?php echo get_the_date(); ?></span>
                    <span> • </span>
                    <span>👤 <?php the_author(); ?></span>
                    <span> • </span>
                    <span><?php echo get_the_category_list(', '); ?></span>
                </div>
                
                <div class="post-content">
                    <?php the_content(); ?>
                </div>
                
                <?php
                // Tags
                $tags = get_the_tags();
                if ($tags) :
                ?>
                    <div class="post-tags">
                        <strong>Etiquetas:</strong>
                        <?php foreach ($tags as $tag) : ?>
                            <a href="<?php echo get_tag_link($tag); ?>"><?php echo $tag->name; ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <!-- Navegación entre entradas -->
                <div class="post-navigation">
                    <?php
                    $prev = get_previous_post();
                    $next = get_next_post();
                    ?>
                    
                    <?php if ($prev) : ?>
                        <a href="<?php echo get_permalink($prev); ?>">
                            ← <?php echo $prev->post_title; ?>
                        </a>
                    <?php else : ?>
                        <span></span>
                    <?php endif; ?>
                    
                    <?php if ($next) : ?>
                        <a href="<?php echo get_permalink($next); ?>">
                            <?php echo $next->post_title; ?> →
                        </a>
                    <?php endif; ?>
                </div>
                
            </article>
        <?php endwhile; ?>
    </div>
</section>

<?php get_footer(); ?>
