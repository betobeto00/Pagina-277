<?php
/**
 * Single Mason Celebre Template
 *
 * @package Virtud_Y_Victoria
 */

get_header();

while (have_posts()) : the_post();
?>

<section class="page-header">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb">
            <?php vyv_breadcrumb(); ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="mason-single-grid">
            <!-- Foto -->
            <div class="mason-single-photo">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium'); ?>
                <?php else : ?>
                    <div class="mason-avatar-large">
                        <i class="fas fa-user"></i>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Contenido -->
            <div>
                <h2 style="color: var(--color-primary); margin-bottom: 20px;"><?php the_title(); ?></h2>
                <div class="mason-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
        
        <div style="margin-top: 50px; padding-top: 30px; border-top: 1px solid #ecf0f1; text-align: center;">
            <a href="<?php echo home_url('/masones-celebres'); ?>" class="btn btn-secondary">
                <?php _e('Volver a Masones Célebres', 'virtud-y-victoria'); ?>
            </a>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
