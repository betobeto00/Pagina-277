<?php
/**
 * Template Name: Página Principal
 *
 * @package Virtud_Y_Victoria
 */

get_header();
?>

<!-- Hero Slider -->
<?php get_template_part('template-parts/hero-slider'); ?>

<!-- Classroom (Próximamente) -->
<?php get_template_part('template-parts/classroom'); ?>

<!-- Premisas -->
<?php get_template_part('template-parts/premisas'); ?>

<!-- Blog Posts Recientes -->
<?php get_template_part('template-parts/blog-posts'); ?>

<!-- Masones Célebres -->
<?php get_template_part('template-parts/masones-celebres'); ?>

<!-- Eventos Próximos -->
<?php get_template_part('template-parts/events'); ?>

<!-- CTA: Únete -->
<?php get_template_part('template-parts/cta'); ?>

<!-- Galería -->
<?php get_template_part('template-parts/gallery'); ?>

<?php get_footer(); ?>
