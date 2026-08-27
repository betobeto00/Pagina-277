<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo esc_url(VYV_URI . '/assets/images/favicon.png'); ?>">
    <link rel="apple-touch-icon" href="<?php echo esc_url(VYV_URI . '/assets/images/logo-apple.png'); ?>">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Top Bar -->
<div class="top-bar">
    <div class="container">
        <div class="top-bar-left">
            <span>🏛️ En Nombre del G.A.D.U.</span>
        </div>
        <div class="top-bar-right">
            <?php if (get_theme_mod('vyv_phone')) : ?>
                <a href="tel:<?php echo esc_attr(get_theme_mod('vyv_phone')); ?>">
                    <i class="fas fa-phone"></i> <?php echo esc_html(get_theme_mod('vyv_phone')); ?>
                </a>
            <?php endif; ?>
            
            <?php if (get_theme_mod('vyv_facebook')) : ?>
                <a href="<?php echo esc_url(get_theme_mod('vyv_facebook')); ?>" target="_blank" rel="noopener">
                    <i class="fab fa-facebook-f"></i>
                </a>
            <?php endif; ?>
            
            <?php if (get_theme_mod('vyv_instagram')) : ?>
                <a href="<?php echo esc_url(get_theme_mod('vyv_instagram')); ?>" target="_blank" rel="noopener">
                    <i class="fab fa-instagram"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Header -->
<header class="site-header">
    <div class="container">
        <!-- Classroom Button (left side of logo) -->
        <a href="<?php echo esc_url(home_url('/classroom')); ?>" class="nav-classroom-btn">
            <i class="fas fa-chalkboard-teacher" style="margin-right: 6px;"></i>
            <?php _e('Classroom', 'virtud-y-victoria'); ?>
        </a>
        
        <a href="<?php echo home_url(); ?>" class="site-logo">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <img src="<?php echo esc_url(VYV_URI . '/assets/images/logo-header.png'); ?>" alt="<?php bloginfo('name'); ?>" class="site-logo-img" height="80" width="250">
            <?php endif; ?>
        </a>
        
        <nav class="main-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'nav-menu',
                'fallback_cb'    => false,
                'depth'          => 2,
            ));
            ?>
        </nav>
        
        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle" aria-label="<?php esc_attr_e('Abrir menú', 'virtud-y-victoria'); ?>" aria-expanded="false">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Mobile Menu Overlay -->
        <div class="mobile-menu-overlay"></div>
    </div>
</header>

<main id="main-content">
