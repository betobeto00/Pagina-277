<?php
/**
 * Template para páginas estáticas
 *
 * @package Virtud_Y_Victoria
 */

get_header();

// Mapeo slug -> clase modificadora del page-header
$page_slug = get_post_field('post_name', get_the_ID());
$page_header_modifier = '';
$slug_to_modifier = array(
    'masoneria'            => 'masoneria',
    'quienes-somos'        => 'quienes-somos',
    'eventos'              => 'eventos',
    'galeria'              => 'galeria',
    'blog'                 => 'blog',
    'contacto'             => 'contacto',
    'politica-de-privacidad' => 'privacidad',
    'masones-celebres'     => 'masones',
);
if (isset($slug_to_modifier[$page_slug])) {
    $page_header_modifier = ' page-header--' . $slug_to_modifier[$page_slug];
}
?>

<section class="page-header<?php echo esc_attr($page_header_modifier); ?>">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo home_url(); ?>">Inicio</a> / <?php the_title(); ?>
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
                
                <div class="page-content">
                    <?php the_content(); ?>
                </div>
                
            </article>
        <?php endwhile; ?>
    </div>
</section>

<?php get_footer(); ?>
