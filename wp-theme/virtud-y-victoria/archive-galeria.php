<?php
/**
 * Archive: Galería
 * Reuses template-galeria.php content with scroll animations
 *
 * @package Virtud_Y_Victoria
 */

get_header();

// Obtener álbumes de la taxonomía
$albums = get_terms(array(
    'taxonomy'   => 'album_galeria',
    'hide_empty' => false,
));
?>

<section class="page-header">
    <div class="container">
        <h1><?php post_type_archive_title(); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo home_url(); ?>">Inicio</a> / <?php post_type_archive_title(); ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        
        <!-- Filtros de Álbum -->
        <div style="margin-bottom: 40px; display: flex; gap: 15px; flex-wrap: wrap; justify-content: center;" data-animate="fadeInUp">
            <button class="gallery-filter-btn is-active" data-filter="all">
                <?php _e('Todas', 'virtud-y-victoria'); ?>
            </button>
            <?php if ($albums && !is_wp_error($albums)) : ?>
                <?php foreach ($albums as $album) : ?>
                    <button class="gallery-filter-btn" data-filter="<?php echo esc_attr($album->slug); ?>">
                        <?php echo esc_html($album->name); ?>
                    </button>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <!-- Galería Grid -->
        <div data-animate-stagger>
        <?php if (have_posts()) : ?>
        <div class="gallery-grid">
            <?php while (have_posts()) : the_post();
                $item_albums = get_the_terms(get_the_ID(), 'album_galeria');
                $album_slugs = '';
                if ($item_albums && !is_wp_error($item_albums)) {
                    $album_slugs = implode(' ', array_map(function($a) { return $a->slug; }, $item_albums));
                }
            ?>
                <div class="gallery-item" data-album="<?php echo esc_attr($album_slugs); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </a>
                        <div class="gallery-overlay">
                            <span><?php the_title(); ?></span>
                        </div>
                    <?php else : ?>
                        <a href="<?php the_permalink(); ?>">
                            <div style="width: 100%; height: 100%; background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-accent) 100%); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image" style="font-size: 32px; color: var(--color-secondary);"></i>
                            </div>
                        </a>
                        <div class="gallery-overlay">
                            <span><?php the_title(); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
        <?php else : ?>
        <!-- Galería de ejemplo -->
        <div class="gallery-grid">
            <?php for ($i = 1; $i <= 12; $i++) : ?>
                <div class="gallery-item" data-album="ejemplo">
                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, <?php echo ($i % 2 == 0) ? 'var(--color-primary)' : 'var(--color-accent)'; ?> 0%, <?php echo ($i % 2 == 0) ? 'var(--color-accent)' : 'var(--color-primary)'; ?> 100%); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-image" style="font-size: 32px; color: var(--color-secondary);"></i>
                    </div>
                    <div class="gallery-overlay">
                        <span><?php _e('Foto de actividad', 'virtud-y-victoria'); ?> <?php echo $i; ?></span>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
        </div>
        
        <!-- Paginación -->
        <div style="text-align: center; margin-top: 50px;">
            <?php
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => '<i class="fas fa-chevron-left"></i>',
                'next_text' => '<i class="fas fa-chevron-right"></i>',
            ));
            ?>
        </div>
        
    </div>
</section>

<?php get_footer(); ?>
