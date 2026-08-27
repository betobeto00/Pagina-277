<?php
/**
 * Tema: Virtud y Victoria Nº 277
 * Funciones principales del tema
 *
 * @package Virtud_Y_Victoria
 * @version 1.0.0
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Constantes del tema
 */
define('VYV_VERSION', '1.0.2'); // Incrementado para forzar cache busting
define('VYV_DIR', get_template_directory());
define('VYV_URI', get_template_directory_uri());

/**
 * Configuración del tema
 */
function vyv_setup() {
    // Soporte para títulos
    add_theme_support('title-tag');
    
    // Imágenes destacadas
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 630, true);
    
    // Logotipo personalizado
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 250,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Imágenes personalizadas
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
    ));
    
    // Feed RSS
    add_theme_support('automatic-feed-links');
    
    // Menús
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'virtud-y-victoria'),
        'footer'  => __('Menú Footer', 'virtud-y-victoria'),
    ));
}
add_action('after_setup_theme', 'vyv_setup');

/**
 * Estilos y scripts
 */
function vyv_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@300;400;700&display=swap',
        array(),
        null
    );
    
    // Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        array(),
        '6.4.0'
    );
    
    // Estilos del tema
    wp_enqueue_style(
        'vyv-style',
        get_stylesheet_uri(),
        array(),
        VYV_VERSION
    );
    
    // Estilos custom adicionales
    wp_enqueue_style(
        'vyv-custom',
        VYV_URI . '/assets/css/custom.css',
        array('vyv-style'),
        VYV_VERSION
    );
    
    // JavaScript del tema
    wp_enqueue_script(
        'vyv-script',
        VYV_URI . '/assets/js/main.js',
        array('jquery'),
        VYV_VERSION,
        true
    );
    
    // Localización para AJAX
    wp_localize_script('vyv-script', 'vyvAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('vyv_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'vyv_scripts');

/**
 * Registrar Custom Post Types
 */
function vyv_register_post_types() {
    
    // Eventos
    register_post_type('evento', array(
        'labels' => array(
            'name'               => __('Eventos', 'virtud-y-victoria'),
            'singular_name'      => __('Evento', 'virtud-y-victoria'),
            'add_new_item'       => __('Agregar Nuevo Evento', 'virtud-y-victoria'),
            'edit_item'          => __('Editar Evento', 'virtud-y-victoria'),
            'all_items'          => __('Todos los Eventos', 'virtud-y-victoria'),
            'view_item'          => __('Ver Evento', 'virtud-y-victoria'),
            'search_items'       => __('Buscar Eventos', 'virtud-y-victoria'),
            'not_found'          => __('No se encontraron eventos', 'virtud-y-victoria'),
        ),
        'public'       => true,
        'has_archive'  => false,
        'menu_icon'    => 'dashicons-calendar-alt',
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'rewrite'      => array('slug' => 'eventos'),
        'show_in_rest' => true,
    ));
    
    // Categorías de Eventos
    register_taxonomy('categoria_evento', 'evento', array(
        'labels' => array(
            'name'          => __('Categorías de Eventos', 'virtud-y-victoria'),
            'singular_name' => __('Categoría de Evento', 'virtud-y-victoria'),
            'add_new_item'  => __('Agregar Nueva Categoría', 'virtud-y-victoria'),
        ),
        'hierarchical' => true,
        'rewrite'      => array('slug' => 'categoria-evento'),
        'show_in_rest' => true,
    ));
    
    // Masones Célebres
    register_post_type('mason_celebre', array(
        'labels' => array(
            'name'               => __('Masones Célebres', 'virtud-y-victoria'),
            'singular_name'      => __('Masón Celebre', 'virtud-y-victoria'),
            'add_new_item'       => __('Agregar Masón Celebre', 'virtud-y-victoria'),
            'edit_item'          => __('Editar Masón Celebre', 'virtud-y-victoria'),
            'all_items'          => __('Todos los Masones', 'virtud-y-victoria'),
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-admin-users',
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite'      => array('slug' => 'archivo-masones', 'with_front' => false),
        'show_in_rest' => true,
    ));

    // Categorías de Masones (jerárquica: secciones padre + tipos hijos)
    register_taxonomy('categoria_mason', 'mason_celebre', array(
        'labels' => array(
            'name'              => __('Categorías de Masones', 'virtud-y-victoria'),
            'singular_name'     => __('Categoría de Masón', 'virtud-y-victoria'),
            'search_items'      => __('Buscar Categorías', 'virtud-y-victoria'),
            'all_items'         => __('Todas las Categorías', 'virtud-y-victoria'),
            'parent_item'       => __('Sección Padre', 'virtud-y-victoria'),
            'parent_item_colon' => __('Sección Padre:', 'virtud-y-victoria'),
            'edit_item'         => __('Editar Categoría', 'virtud-y-victoria'),
            'update_item'       => __('Actualizar Categoría', 'virtud-y-victoria'),
            'add_new_item'      => __('Agregar Nueva Categoría', 'virtud-y-victoria'),
            'new_item_name'     => __('Nombre de la Categoría', 'virtud-y-victoria'),
            'menu_name'         => __('Categorías', 'virtud-y-victoria'),
        ),
        'hierarchical' => true,
        'rewrite'      => array('slug' => 'categoria-mason'),
        'show_in_rest' => true,
        'show_admin_column' => true,
    ));
    
    // Galería
    register_post_type('galeria', array(
        'labels' => array(
            'name'               => __('Galerías', 'virtud-y-victoria'),
            'singular_name'      => __('Galería', 'virtud-y-victoria'),
            'add_new_item'       => __('Agregar Nueva Galería', 'virtud-y-victoria'),
            'edit_item'          => __('Editar Galería', 'virtud-y-victoria'),
            'all_items'          => __('Todas las Galerías', 'virtud-y-victoria'),
        ),
        'public'       => true,
        'has_archive'  => false,
        'menu_icon'    => 'dashicons-format-gallery',
        'supports'     => array('title', 'editor', 'thumbnail'),
        'rewrite'      => array('slug' => 'galeria'),
        'show_in_rest' => true,
    ));
    
    // Álbumes de Galería
    register_taxonomy('album_galeria', 'galeria', array(
        'labels' => array(
            'name'          => __('Álbumes', 'virtud-y-victoria'),
            'singular_name' => __('Álbum', 'virtud-y-victoria'),
        ),
        'hierarchical' => true,
        'rewrite'      => array('slug' => 'album'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'vyv_register_post_types');

/**
 * Meta Box para Eventos
 */
function vyv_add_evento_meta_boxes() {
    add_meta_box(
        'vyv_evento_details',
        __('Detalles del Evento', 'virtud-y-victoria'),
        'vyv_evento_meta_box_callback',
        'evento',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vyv_add_evento_meta_boxes');

function vyv_evento_meta_box_callback($post) {
    wp_nonce_field('vyv_evento_meta_box', 'vyv_evento_meta_nonce');
    
    $fecha = get_post_meta($post->ID, '_vyv_fecha_evento', true);
    $hora = get_post_meta($post->ID, '_vyv_hora_evento', true);
    $lugar = get_post_meta($post->ID, '_vyv_lugar_evento', true);
    $tipo = get_post_meta($post->ID, '_vyv_tipo_evento', true);
    $inscripcion = get_post_meta($post->ID, '_vyv_inscripcion_url', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="vyv_fecha_evento"><?php _e('Fecha del Evento', 'virtud-y-victoria'); ?></label></th>
            <td><input type="date" id="vyv_fecha_evento" name="vyv_fecha_evento" value="<?php echo esc_attr($fecha); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="vyv_hora_evento"><?php _e('Hora del Evento', 'virtud-y-victoria'); ?></label></th>
            <td><input type="time" id="vyv_hora_evento" name="vyv_hora_evento" value="<?php echo esc_attr($hora); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="vyv_lugar_evento"><?php _e('Lugar del Evento', 'virtud-y-victoria'); ?></label></th>
            <td><input type="text" id="vyv_lugar_evento" name="vyv_lugar_evento" value="<?php echo esc_attr($lugar); ?>" class="regular-text" placeholder="Ej: Templo de la Logia"></td>
        </tr>
        <tr>
            <th><label for="vyv_tipo_evento"><?php _e('Tipo de Evento', 'virtud-y-victoria'); ?></label></th>
            <td>
                <select id="vyv_tipo_evento" name="vyv_tipo_evento">
                    <option value="tenida" <?php selected($tipo, 'tenida'); ?>><?php _e('Tenida', 'virtud-y-victoria'); ?></option>
                    <option value="ceremonia" <?php selected($tipo, 'ceremonia'); ?>><?php _e('Ceremonia', 'virtud-y-victoria'); ?></option>
                    <option value="social" <?php selected($tipo, 'social'); ?>><?php _e('Evento Social', 'virtud-y-victoria'); ?></option>
                    <option value="filantropia" <?php selected($tipo, 'filantropia'); ?>><?php _e('Filantropía', 'virtud-y-victoria'); ?></option>
                    <option value="otro" <?php selected($tipo, 'otro'); ?>><?php _e('Otro', 'virtud-y-victoria'); ?></option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="vyv_inscripcion_url"><?php _e('URL de Inscripción', 'virtud-y-victoria'); ?></label></th>
            <td><input type="url" id="vyv_inscripcion_url" name="vyv_inscripcion_url" value="<?php echo esc_url($inscripcion); ?>" class="regular-text" placeholder="https://..."></td>
        </tr>
    </table>
    <?php
}

function vyv_save_evento_meta($post_id) {
    if (!isset($_POST['vyv_evento_meta_nonce']) || !wp_verify_nonce($_POST['vyv_evento_meta_nonce'], 'vyv_evento_meta_box')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $fields = array('fecha_evento', 'hora_evento', 'lugar_evento', 'tipo_evento', 'inscripcion_url');
    
    foreach ($fields as $field) {
        if (isset($_POST['vyv_' . $field])) {
            $value = sanitize_text_field($_POST['vyv_' . $field]);
            update_post_meta($post_id, '_vyv_' . $field, $value);
        }
    }
}
add_action('save_post_evento', 'vyv_save_evento_meta');

/**
 * Meta Box para Masones Célebres
 */
function vyv_add_mason_meta_boxes() {
    add_meta_box(
        'vyv_mason_details',
        __('Información del Masón', 'virtud-y-victoria'),
        'vyv_mason_meta_box_callback',
        'mason_celebre',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vyv_add_mason_meta_boxes');

function vyv_mason_meta_box_callback($post) {
    wp_nonce_field('vyv_mason_meta_box', 'vyv_mason_meta_nonce');

    $logia    = get_post_meta($post->ID, '_vyv_logia', true);
    $epoca    = get_post_meta($post->ID, '_vyv_epoca', true);
    $grado    = get_post_meta($post->ID, '_vyv_grado', true);
    $nacimiento = get_post_meta($post->ID, '_vyv_nacimiento', true);
    $fallecimiento = get_post_meta($post->ID, '_vyv_fallecimiento', true);
    $pais     = get_post_meta($post->ID, '_vyv_pais', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="vyv_logia"><?php _e('Logia / Afiliación Masónica', 'virtud-y-victoria'); ?></label></th>
            <td><input type="text" id="vyv_logia" name="vyv_logia" value="<?php echo esc_attr($logia); ?>" class="regular-text" placeholder="Ej: Holland Lodge Nº 8, Nueva York"></td>
        </tr>
        <tr>
            <th><label for="vyv_pais"><?php _e('País', 'virtud-y-victoria'); ?></label></th>
            <td><input type="text" id="vyv_pais" name="vyv_pais" value="<?php echo esc_attr($pais); ?>" class="regular-text" placeholder="Ej: Estados Unidos, Venezuela, Francia"></td>
        </tr>
        <tr>
            <th><label for="vyv_nacimiento"><?php _e('Año de Nacimiento', 'virtud-y-victoria'); ?></label></th>
            <td><input type="number" id="vyv_nacimiento" name="vyv_nacimiento" value="<?php echo esc_attr($nacimiento); ?>" min="1500" max="2100" class="small-text" placeholder="Ej: 1732"></td>
        </tr>
        <tr>
            <th><label for="vyv_fallecimiento"><?php _e('Año de Fallecimiento', 'virtud-y-victoria'); ?></label></th>
            <td><input type="number" id="vyv_fallecimiento" name="vyv_fallecimiento" value="<?php echo esc_attr($fallecimiento); ?>" min="1500" max="2100" class="small-text" placeholder="Ej: 1799 (dejar vacío si vive)"></td>
        </tr>
        <tr>
            <th><label for="vyv_epoca"><?php _e('Época', 'virtud-y-victoria'); ?></label></th>
            <td>
                <select id="vyv_epoca" name="vyv_epoca">
                    <option value=""><?php _e('Seleccionar...', 'virtud-y-victoria'); ?></option>
                    <option value="siglo-xviii" <?php selected($epoca, 'siglo-xviii'); ?>><?php _e('Siglo XVIII (1700-1799)', 'virtud-y-victoria'); ?></option>
                    <option value="siglo-xix" <?php selected($epoca, 'siglo-xix'); ?>><?php _e('Siglo XIX (1800-1899)', 'virtud-y-victoria'); ?></option>
                    <option value="siglo-xx" <?php selected($epoca, 'siglo-xx'); ?>><?php _e('Siglo XX (1900-1999)', 'virtud-y-victoria'); ?></option>
                    <option value="siglo-xxi" <?php selected($epoca, 'siglo-xxi'); ?>><?php _e('Siglo XXI (2000-presente)', 'virtud-y-victoria'); ?></option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="vyv_grado"><?php _e('Grado Masónico', 'virtud-y-victoria'); ?></label></th>
            <td><input type="text" id="vyv_grado" name="vyv_grado" value="<?php echo esc_attr($grado); ?>" class="regular-text" placeholder="Ej: Grado 33, Serenísimo Gran Maestro, Maestro"></td>
        </tr>
    </table>
    <?php
}

function vyv_save_mason_meta($post_id) {
    if (!isset($_POST['vyv_mason_meta_nonce']) || !wp_verify_nonce($_POST['vyv_mason_meta_nonce'], 'vyv_mason_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('logia', 'pais', 'nacimiento', 'fallecimiento', 'epoca', 'grado');

    foreach ($fields as $field) {
        if (isset($_POST['vyv_' . $field])) {
            $value = sanitize_text_field($_POST['vyv_' . $field]);
            update_post_meta($post_id, '_vyv_' . $field, $value);
        }
    }
}
add_action('save_post_mason_celebre', 'vyv_save_mason_meta');

/**
 * Widgets
 */
function vyv_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar Principal', 'virtud-y-victoria'),
        'id'            => 'sidebar-main',
        'description'   => __('Widget de la sidebar principal', 'virtud-y-victoria'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Columna 1', 'virtud-y-victoria'),
        'id'            => 'footer-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Columna 2', 'virtud-y-victoria'),
        'id'            => 'footer-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'vyv_widgets_init');

/**
 * Personalizar excerpt
 */
function vyv_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'vyv_excerpt_length');

function vyv_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'vyv_excerpt_more');

/**
 * Función para obtener fecha formateada en español
 */
function vyv_format_date($date, $format = 'd M Y') {
    if (empty($date)) {
        return '';
    }

    $timestamp = is_numeric($date) ? intval($date) : strtotime($date);

    if (!$timestamp || $timestamp < 0) {
        return '';
    }

    $meses = array(
        '01' => 'Ene', '02' => 'Feb', '03' => 'Mar', '04' => 'Abr',
        '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Ago',
        '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dic',
    );

    $dia = date('d', $timestamp);
    $mes = $meses[date('m', $timestamp)];
    $anio = date('Y', $timestamp);

    return "$dia $mes $anio";
}

/**
 * Función para obtener el tipo de evento en español
 */
function vyv_get_event_type_label($type) {
    $labels = array(
        'tenida'      => 'Tenida',
        'ceremonia'   => 'Ceremonia',
        'social'      => 'Evento Social',
        'filantropia' => 'Filantropía',
        'otro'        => 'Otro',
    );
    
    return isset($labels[$type]) ? $labels[$type] : $type;
}

/**
 * Breadcrumb reutilizable
 */
function vyv_breadcrumb($separator = '/') {
    if (is_front_page()) {
        return;
    }
    
    echo '<a href="' . esc_url(home_url('/')) . '">' . __('Inicio', 'virtud-y-victoria') . '</a>';
    
    if (is_singular('post')) {
        $categories = get_the_category();
        if ($categories) {
            echo '<span class="separator">' . $separator . '</span>';
            echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
        }
        echo '<span class="separator">' . $separator . '</span>';
        the_title();
    } elseif (is_singular('evento')) {
        echo '<span class="separator">' . $separator . '</span>';
        echo '<a href="' . esc_url(home_url('/eventos')) . '">' . __('Eventos', 'virtud-y-victoria') . '</a>';
        echo '<span class="separator">' . $separator . '</span>';
        the_title();
    } elseif (is_singular('mason_celebre')) {
        echo '<span class="separator">' . $separator . '</span>';
        echo '<a href="' . esc_url(home_url('/masones-celebres')) . '">' . __('Masones Célebres', 'virtud-y-victoria') . '</a>';
        echo '<span class="separator">' . $separator . '</span>';
        the_title();
    } elseif (is_singular('galeria')) {
        echo '<span class="separator">' . $separator . '</span>';
        echo '<a href="' . esc_url(home_url('/galeria')) . '">' . __('Galería', 'virtud-y-victoria') . '</a>';
        echo '<span class="separator">' . $separator . '</span>';
        the_title();
    } elseif (is_singular('page')) {
        echo '<span class="separator">' . $separator . '</span>';
        the_title();
    } elseif (is_post_type_archive('evento')) {
        echo '<span class="separator">' . $separator . '</span>';
        echo __('Eventos', 'virtud-y-victoria');
    } elseif (is_post_type_archive('mason_celebre')) {
        echo '<span class="separator">' . $separator . '</span>';
        echo __('Masones Célebres', 'virtud-y-victoria');
    } elseif (is_post_type_archive('galeria')) {
        echo '<span class="separator">' . $separator . '</span>';
        echo __('Galería', 'virtud-y-victoria');
    } elseif (is_category() || is_tag()) {
        echo '<span class="separator">' . $separator . '</span>';
        the_archive_title();
    } elseif (is_search()) {
        echo '<span class="separator">' . $separator . '</span>';
        printf(__('Resultados para: %s', 'virtud-y-victoria'), get_search_query());
    } elseif (is_404()) {
        echo '<span class="separator">' . $separator . '</span>';
        echo __('Página no encontrada', 'virtud-y-victoria');
    }
}

/**
 * Customizer
 */
function vyv_customize_register($wp_customize) {
    // Sección: Información de la Logia
    $wp_customize->add_section('vyv_logia_info', array(
        'title'    => __('Información de la Logia', 'virtud-y-victoria'),
        'priority' => 30,
    ));
    
    // Campo: Teléfono
    $wp_customize->add_setting('vyv_phone', array(
        'default'           => '+58 (XXX) XXX-XXXX',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('vyv_phone', array(
        'label'   => __('Teléfono', 'virtud-y-victoria'),
        'section' => 'vyv_logia_info',
        'type'    => 'text',
    ));
    
    // Campo: Email
    $wp_customize->add_setting('vyv_email', array(
        'default'           => 'info@virtudyvictoria277.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('vyv_email', array(
        'label'   => __('Email', 'virtud-y-victoria'),
        'section' => 'vyv_logia_info',
        'type'    => 'email',
    ));
    
    // Campo: Dirección
    $wp_customize->add_setting('vyv_address', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('vyv_address', array(
        'label'   => __('Dirección del Templo', 'virtud-y-victoria'),
        'section' => 'vyv_logia_info',
        'type'    => 'textarea',
    ));
    
    // Campo: Facebook URL
    $wp_customize->add_setting('vyv_facebook', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('vyv_facebook', array(
        'label'   => __('URL de Facebook', 'virtud-y-victoria'),
        'section' => 'vyv_logia_info',
        'type'    => 'url',
    ));
    
    // Campo: Instagram URL
    $wp_customize->add_setting('vyv_instagram', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('vyv_instagram', array(
        'label'   => __('URL de Instagram', 'virtud-y-victoria'),
        'section' => 'vyv_logia_info',
        'type'    => 'url',
    ));

    // Campo: Google Maps URL
    $wp_customize->add_setting('vyv_gmaps_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('vyv_gmaps_url', array(
        'label'       => __('URL de Google Maps', 'virtud-y-victoria'),
        'description' => __('Link para abrir el mapa en una nueva pestaña', 'virtud-y-victoria'),
        'section'     => 'vyv_logia_info',
        'type'        => 'url',
    ));

    // Campo: Google Maps Embed URL
    $wp_customize->add_setting('vyv_gmaps_embed', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('vyv_gmaps_embed', array(
        'label'       => __('URL Embed de Google Maps', 'virtud-y-victoria'),
        'description' => __('URL /embed?pb=... para mostrar el mapa en la pagina', 'virtud-y-victoria'),
        'section'     => 'vyv_logia_info',
        'type'        => 'url',
    ));

    // Campo: Fecha de Fundación
    $wp_customize->add_setting('vyv_fundacion_fecha', array(
        'default'           => '18 de julio de 2022',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('vyv_fundacion_fecha', array(
        'label'   => __('Fecha de Fundación', 'virtud-y-victoria'),
        'section' => 'vyv_logia_info',
        'type'    => 'text',
    ));

    // Campo: Ciudad
    $wp_customize->add_setting('vyv_ciudad', array(
        'default'           => 'Coro',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('vyv_ciudad', array(
        'label'   => __('Ciudad', 'virtud-y-victoria'),
        'section' => 'vyv_logia_info',
        'type'    => 'text',
    ));

    // Campo: Estado
    $wp_customize->add_setting('vyv_estado', array(
        'default'           => 'Falcón',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('vyv_estado', array(
        'label'   => __('Estado', 'virtud-y-victoria'),
        'section' => 'vyv_logia_info',
        'type'    => 'text',
    ));

    // Campo: URL Gran Logia de Venezuela
    $wp_customize->add_setting('vyv_gran_logia_url', array(
        'default'           => 'https://granlogiadevenezuela.com',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('vyv_gran_logia_url', array(
        'label'   => __('URL de la Gran Logia de Venezuela', 'virtud-y-victoria'),
        'section' => 'vyv_logia_info',
        'type'    => 'url',
    ));

    // Sección: Hero Slider
    $wp_customize->add_section('vyv_hero_slider', array(
        'title'    => __('Hero Slider', 'virtud-y-victoria'),
        'priority' => 35,
    ));

    // Repetidor de slides (usando setting repetido simplificado)
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("vyv_hero_slide_{$i}_title", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("vyv_hero_slide_{$i}_title", array(
            'label'   => sprintf(__('Slide %d - Título', 'virtud-y-victoria'), $i),
            'section' => 'vyv_hero_slider',
            'type'    => 'text',
        ));

        $wp_customize->add_setting("vyv_hero_slide_{$i}_subtitle", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("vyv_hero_slide_{$i}_subtitle", array(
            'label'   => sprintf(__('Slide %d - Subtítulo', 'virtud-y-victoria'), $i),
            'section' => 'vyv_hero_slider',
            'type'    => 'text',
        ));

        $wp_customize->add_setting("vyv_hero_slide_{$i}_text", array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        ));
        $wp_customize->add_control("vyv_hero_slide_{$i}_text", array(
            'label'   => sprintf(__('Slide %d - Texto', 'virtud-y-victoria'), $i),
            'section' => 'vyv_hero_slider',
            'type'    => 'textarea',
        ));

        $wp_customize->add_setting("vyv_hero_slide_{$i}_cta_text", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("vyv_hero_slide_{$i}_cta_text", array(
            'label'   => sprintf(__('Slide %d - Texto CTA', 'virtud-y-victoria'), $i),
            'section' => 'vyv_hero_slider',
            'type'    => 'text',
        ));

        $wp_customize->add_setting("vyv_hero_slide_{$i}_cta_url", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control("vyv_hero_slide_{$i}_cta_url", array(
            'label'   => sprintf(__('Slide %d - URL CTA', 'virtud-y-victoria'), $i),
            'section' => 'vyv_hero_slider',
            'type'    => 'url',
        ));

        $wp_customize->add_setting("vyv_hero_slide_{$i}_image", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "vyv_hero_slide_{$i}_image", array(
            'label'   => sprintf(__('Slide %d - Imagen', 'virtud-y-victoria'), $i),
            'section' => 'vyv_hero_slider',
        )));
    }

    // Sección: Homepage Settings
    $wp_customize->add_section('vyv_homepage', array(
        'title'    => __('Configuración de Inicio', 'virtud-y-victoria'),
        'priority' => 40,
    ));

    $wp_customize->add_setting('vyv_blog_posts_count', array(
        'default'           => 3,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('vyv_blog_posts_count', array(
        'label'   => __('Número de posts en Inicio', 'virtud-y-victoria'),
        'section' => 'vyv_homepage',
        'type'    => 'number',
        'input_attrs' => array('min' => 1, 'max' => 10),
    ));

    $wp_customize->add_setting('vyv_masones_count', array(
        'default'           => 6,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('vyv_masones_count', array(
        'label'   => __('Número de masones célebres en Inicio', 'virtud-y-victoria'),
        'section' => 'vyv_homepage',
        'type'    => 'number',
        'input_attrs' => array('min' => 1, 'max' => 12),
    ));

    $wp_customize->add_setting('vyv_events_count', array(
        'default'           => 4,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('vyv_events_count', array(
        'label'   => __('Número de eventos en Inicio', 'virtud-y-victoria'),
        'section' => 'vyv_homepage',
        'type'    => 'number',
        'input_attrs' => array('min' => 1, 'max' => 10),
    ));

    $wp_customize->add_setting('vyv_gallery_count', array(
        'default'           => 8,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('vyv_gallery_count', array(
        'label'   => __('Número de imágenes en Inicio', 'virtud-y-victoria'),
        'section' => 'vyv_homepage',
        'type'    => 'number',
        'input_attrs' => array('min' => 1, 'max' => 16),
    ));

    // Sección: Contacto
    $wp_customize->add_section('vyv_contact', array(
        'title'    => __('Formulario de Contacto', 'virtud-y-victoria'),
        'priority' => 45,
    ));

    $wp_customize->add_setting('vyv_cf7_form_id', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('vyv_cf7_form_id', array(
        'label'   => __('ID de Contact Form 7 (opcional)', 'virtud-y-victoria'),
        'section' => 'vyv_contact',
        'type'    => 'text',
        'description' => __('Dejar vacío para usar el formulario integrado del tema.', 'virtud-y-victoria'),
    ));

    // Sección: CTA
    $wp_customize->add_section('vyv_cta', array(
        'title'    => __('Llamada a la Acción', 'virtud-y-victoria'),
        'priority' => 50,
    ));

    $wp_customize->add_setting('vyv_cta_title', array(
        'default'           => '¿Quieres Ser Masón?',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('vyv_cta_title', array(
        'label'   => __('Título CTA', 'virtud-y-victoria'),
        'section' => 'vyv_cta',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('vyv_cta_text', array(
        'default'           => 'La Masonería es una institución de hombres libres que buscan hacer el bien. Si deseas conocernos, estamos aquí para responder tus preguntas.',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('vyv_cta_text', array(
        'label'   => __('Texto CTA', 'virtud-y-victoria'),
        'section' => 'vyv_cta',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('vyv_cta_button_text', array(
        'default'           => 'Contáctanos',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('vyv_cta_button_text', array(
        'label'   => __('Texto del Botón', 'virtud-y-victoria'),
        'section' => 'vyv_cta',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('vyv_cta_button_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('vyv_cta_button_url', array(
        'label'   => __('URL del Botón', 'virtud-y-victoria'),
        'section' => 'vyv_cta',
        'type'    => 'url',
        'description' => __('Dejar vacío para usar /contacto', 'virtud-y-victoria'),
    ));
}
add_action('customize_register', 'vyv_customize_register');

/**
 * Añadir clase al body
 */
function vyv_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'front-page';
    }
    
    if (is_singular()) {
        $classes[] = 'singular';
    }
    
    return $classes;
}
add_filter('body_class', 'vyv_body_classes');

/**
 * AJAX Handler para formulario de contacto
 */
function vyv_contact_form() {
    // Verificar nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'vyv_nonce')) {
        wp_send_json_error(array('message' => __('Error de seguridad. Intenta de nuevo.', 'virtud-y-victoria')));
    }

    // Sanitizar datos
    $nombre = sanitize_text_field($_POST['nombre']);
    $email = sanitize_email($_POST['email']);
    $telefono = sanitize_text_field($_POST['telefono']);
    $asunto = sanitize_text_field($_POST['asunto']);
    $mensaje = sanitize_textarea_field($_POST['mensaje']);

    // Validar campos requeridos
    if (empty($nombre) || empty($email) || empty($asunto) || empty($mensaje)) {
        wp_send_json_error(array('message' => __('Todos los campos obligatorios deben ser completados.', 'virtud-y-victoria')));
    }

    // Preparar email
    $to = get_option('admin_email');
    $subject = '[' . get_bloginfo('name') . '] ' . $asunto;
    
    $message = "Nombre: $nombre\n";
    $message .= "Email: $email\n";
    $message .= "Teléfono: $telefono\n";
    $message .= "Asunto: $asunto\n\n";
    $message .= "Mensaje:\n$mensaje\n";
    
    $headers = array(
        'From: ' . get_bloginfo('name') . ' <' . $to . '>',
        'Reply-To: ' . $nombre . ' <' . $email . '>',
        'Content-Type: text/plain; charset=UTF-8',
    );

    // Enviar email
    $sent = wp_mail($to, $subject, $message, $headers);

    if ($sent) {
        wp_send_json_success(array('message' => __('Mensaje enviado correctamente. Te responderemos a la brevedad.', 'virtud-y-victoria')));
    } else {
        wp_send_json_error(array('message' => __('Error al enviar el mensaje. Por favor, inténtalo de nuevo más tarde.', 'virtud-y-victoria')));
    }
}
add_action('wp_ajax_vyv_contact_form', 'vyv_contact_form');
add_action('wp_ajax_nopriv_vyv_contact_form', 'vyv_contact_form');

/**
 * Soporte para Contact Form 7
 */
function vyv_cf7_init() {
    if (function_exists('wpcf7_enqueue_scripts')) {
        wpcf7_enqueue_scripts();
        wpcf7_enqueue_styles();
    }
}
add_action('wp_enqueue_scripts', 'vyv_cf7_init');

/**
 * Añadir clase a Contact Form 7 para estilos personalizados
 */
function vyv_cf7_form_class($attributes) {
    $attributes['class'] = 'contact-form wpcf7-form';
    return $attributes;
}
add_filter('wpcf7_form_attributes', 'vyv_cf7_form_class');

/**
 * Configuración adicional de The Events Calendar (si está activo)
 */
function vyv_events_calendar_setup() {
    if (class_exists('Tribe__Events__Main')) {
        // Desactivar estilos por defecto si queremos usar los nuestros
        add_filter('tribe_events_template_get_template', function($template) {
            return $template;
        });
    }
}
add_action('init', 'vyv_events_calendar_setup');

/**
 * Limpieza de código innecesario en head
 */
function vyv_clean_head() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'start_post_rel_link');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('init', 'vyv_clean_head');

/**
 * Desactivar emojis
 */
function vyv_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
}
add_action('init', 'vyv_disable_emojis');

/**
 * Añadir tamaños de imagen personalizados
 */
function vyv_image_sizes() {
    add_image_size('vyv-hero', 1920, 1080, true);
    add_image_size('vyv-thumb-square', 400, 400, true);
    add_image_size('vyv-blog-thumb', 600, 400, true);
    add_image_size('vyv-event-thumb', 400, 300, true);
    add_image_size('vyv-gallery-thumb', 600, 600, true);
}
add_action('after_setup_theme', 'vyv_image_sizes');

/**
 * Mover jQuery al footer
 */
function vyv_move_jquery_to_footer() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', includes_url('/js/jquery/jquery.min.js'), array(), null, true);
        wp_enqueue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'vyv_move_jquery_to_footer', 99);

/**
 * Soporte para Simple Lightbox
 */
function vyv_simple_lightbox_setup() {
    if (function_exists('slb_init')) {
        // Configurar Simple Lightbox
        add_filter('slb_options', function($options) {
            $options['animation_speed'] = 300;
            $options['overlay_opacity'] = 0.9;
            $options['caption'] = true;
            $options['nav_arrows'] = true;
            $options['close_button'] = true;
            $options['loop'] = true;
            return $options;
        });
    }
}
add_action('init', 'vyv_simple_lightbox_setup');

/**
 * Añadir clase lightbox a imágenes de galería
 */
function vyv_gallery_lightbox($content) {
    if (is_singular('galeria') || is_post_type_archive('galeria') || is_tax('album_galeria')) {
        $pattern = '/<a(.*?)href="(.*?)"(.*?)><img(.*?)<\/a>/i';
        $replacement = '<a$1href="$2"$3 data-slb-group="galeria"$4></a>';
        $content = preg_replace($pattern, $replacement, $content);
    }
    return $content;
}
add_filter('the_content', 'vyv_gallery_lightbox');

/**
 * Desactivar estilos de The Events Calendar si usamos los nuestros
 */
function vyv_dequeue_events_styles() {
    if (class_exists('Tribe__Events__Main')) {
        wp_dequeue_style('tribe-events-full');
        wp_dequeue_style('tribe-events-full-mobile');
        wp_dequeue_style('tribe-events-full-pro');
    }
}
add_action('wp_enqueue_scripts', 'vyv_dequeue_events_styles', 99);

/**
 * Soporte para WPML / Polylang
 */
function vyv_language_support() {
    // Para WPML
    if (function_exists('icl_register_string')) {
        icl_register_string('Virtud y Victoria', 'Site Title', get_bloginfo('name'));
        icl_register_string('Virtud y Victoria', 'Site Description', get_bloginfo('description'));
    }
}
add_action('init', 'vyv_language_support');

/**
 * Preconnect para fuentes externas
 */
function vyv_resource_hints($urls, $relation_type) {
    if ('preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
            'crossorigin' => 'anonymous',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
        $urls[] = array(
            'href' => 'https://cdnjs.cloudflare.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $urls;
}
add_filter('wp_resource_hints', 'vyv_resource_hints', 10, 2);

/**
 * Permitir SVG en uploads (para logo) - CON SANITIZACIÓN DE SEGURIDAD
 */
function vyv_allow_svg_upload($mimes) {
    // Solo permitir SVG para administradores
    if (!current_user_can('manage_options')) {
        return $mimes;
    }
    
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'vyv_allow_svg_upload');

/**
 * Sanitizar SVG files al subir para prevenir XSS
 */
function vyv_sanitize_svg_upload($file, $filename, $mimes) {
    // Solo procesar archivos SVG
    if ($file['type'] !== 'image/svg+xml' && pathinfo($filename, PATHINFO_EXTENSION) !== 'svg') {
        return $file;
    }

    // Leer el contenido del archivo
    $content = file_get_contents($file['tmp_name']);
    
    // Verificar contenido malicioso común en SVG
    $malicious_patterns = array(
        '/<script/i',
        '/javascript:/i',
        '/on\w+\s*=/i',  // Event handlers como onclick, onload, etc.
        '/<iframe/i',
        '/<object/i',
        '/<embed/i',
        '/data:text\/html/i',
    );

    foreach ($malicious_patterns as $pattern) {
        if (preg_match($pattern, $content)) {
            // Rechazar archivo si contiene código sospechoso
            $file['error'] = 'SVG file contains potentially malicious content.';
            return $file;
        }
    }

    // Sanitizar: remover comentarios y etiquetas script si están presentes
    $sanitized = preg_replace(
        array(
            '/<!--.*?-->/s',           // Comentarios HTML
            '/<script\b[^>]*>(.*?)<\/script>/is', // Scripts
            '/<\?xml.*?\?>/s',          // Declaraciones XML
        ),
        '',
        $content
    );

    // Si se modificó el contenido, escribir la versión sanitizada
    if ($sanitized !== $content) {
        file_put_contents($file['tmp_name'], $sanitized);
    }

    return $file;
}
add_filter('wp_handle_upload', 'vyv_sanitize_svg_upload', 10, 3);

/**
 * Open Graph meta tags para redes sociales
 */
function vyv_opengraph_meta() {
    if (is_singular()) {
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr(wp_trim_words(get_the_excerpt(), 30)) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
        echo '<meta property="og:type" content="article">' . "\n";
        
        if (has_post_thumbnail()) {
            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            echo '<meta property="og:image" content="' . esc_url($thumb[0]) . '">' . "\n";
        } else {
            echo '<meta property="og:image" content="' . esc_url(VYV_URI . '/assets/images/logo-social.png') . '">' . "\n";
        }
    } else {
        echo '<meta property="og:title" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr(get_bloginfo('description')) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(home_url()) . '">' . "\n";
        echo '<meta property="og:type" content="website">' . "\n";
        echo '<meta property="og:image" content="' . esc_url(VYV_URI . '/assets/images/logo-social.png') . '">' . "\n";
    }
    
    echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
    echo '<meta property="og:locale" content="es_VE">' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr(get_bloginfo('description')) . '">' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url(VYV_URI . '/assets/images/logo-social.png') . '">' . "\n";
}
add_action('wp_head', 'vyv_opengraph_meta', 1);

/**
 * Añadir campo de confirmación en el registro de usuarios (si se habilita)
 */
function vyv_registration_fields() {
    // Se puede extender para área de miembros
}
add_action('register_form', 'vyv_registration_fields');

/**
 * Crear menús programáticamente
 * Se ejecuta una sola vez después de activar el tema
 */
function vyv_create_menus() {
    // Verificar si los menús ya existen
    $primary_menu = wp_get_nav_menu_object('Menú Principal');
    $footer_menu = wp_get_nav_menu_object('Menú Footer');
    
    // Crear menú principal si no existe
    if (!$primary_menu) {
        $primary_menu_id = wp_create_nav_menu('Menú Principal', array(
            'slug' => 'menu-principal',
        ));
        
        if (!is_wp_error($primary_menu_id)) {
            // Asignar ubicación
            $locations = get_theme_mod('nav_menu_locations');
            $locations['primary'] = $primary_menu_id;
            set_theme_mod('nav_menu_locations', $locations);
            
            // Obtener IDs de páginas
            $pages = array(
                'inicio'           => get_page_by_path('inicio'),
                'la-masoneria'     => get_page_by_path('la-masoneria'),
                'quienes-somos'    => get_page_by_path('quienes-somos'),
                'eventos'          => get_page_by_path('eventos'),
                'galeria'          => get_page_by_path('galeria'),
                'blog'             => get_page_by_path('blog'),
                'contacto'         => get_page_by_path('contacto'),
            );
            
            // Agregar páginas al menú (en orden)
            $menu_items = array(
                array('slug' => 'inicio', 'title' => 'Inicio'),
                array('slug' => 'la-masoneria', 'title' => 'La Masonería'),
                array('slug' => 'quienes-somos', 'title' => 'Quiénes Somos'),
                array('slug' => 'eventos', 'title' => 'Eventos'),
                array('slug' => 'galeria', 'title' => 'Galería'),
                array('slug' => 'blog', 'title' => 'Blog'),
                array('slug' => 'contacto', 'title' => 'Contacto'),
            );
            
            foreach ($menu_items as $item) {
                if (!empty($pages[$item['slug']]) && !is_wp_error($pages[$item['slug']])) {
                    wp_update_nav_menu_item($primary_menu_id, 0, array(
                        'menu-item-title'     => $item['title'],
                        'menu-item-object'    => 'page',
                        'menu-item-object-id' => $pages[$item['slug']]->ID,
                        'menu-item-type'      => 'post_type',
                        'menu-item-status'    => 'publish',
                    ));
                }
            }
            
            error_log('VyV: Menú Principal creado exitosamente');
        }
    }
    
    // Crear menú footer si no existe
    if (!$footer_menu) {
        $footer_menu_id = wp_create_nav_menu('Menú Footer', array(
            'slug' => 'menu-footer',
        ));
        
        if (!is_wp_error($footer_menu_id)) {
            // Asignar ubicación
            $locations = get_theme_mod('nav_menu_locations');
            $locations['footer'] = $footer_menu_id;
            set_theme_mod('nav_menu_locations', $locations);
            
            // Obtener IDs de páginas
            $pages = array(
                'inicio'              => get_page_by_path('inicio'),
                'quienes-somos'       => get_page_by_path('quienes-somos'),
                'la-masoneria'        => get_page_by_path('la-masoneria'),
                'eventos'             => get_page_by_path('eventos'),
                'contacto'            => get_page_by_path('contacto'),
                'politica-de-privacidad' => get_page_by_path('politica-de-privacidad'),
            );
            
            // Agregar páginas al menú footer
            $footer_items = array(
                array('slug' => 'inicio', 'title' => 'Inicio'),
                array('slug' => 'quienes-somos', 'title' => 'Quiénes Somos'),
                array('slug' => 'la-masoneria', 'title' => 'La Masonería'),
                array('slug' => 'eventos', 'title' => 'Eventos'),
                array('slug' => 'contacto', 'title' => 'Contacto'),
                array('slug' => 'politica-de-privacidad', 'title' => 'Política de Privacidad'),
            );
            
            foreach ($footer_items as $item) {
                if (!empty($pages[$item['slug']]) && !is_wp_error($pages[$item['slug']])) {
                    wp_update_nav_menu_item($footer_menu_id, 0, array(
                        'menu-item-title'     => $item['title'],
                        'menu-item-object'    => 'page',
                        'menu-item-object-id' => $pages[$item['slug']]->ID,
                        'menu-item-type'      => 'post_type',
                        'menu-item-status'    => 'publish',
                    ));
                }
            }
            
            error_log('VyV: Menú Footer creado exitosamente');
        }
    }
}

/**
 * Ejecutar creación de menús al activar el tema
 */
function vyv_after_switch_theme() {
    vyv_create_menus();
    flush_rewrite_rules();
}

/**
 * Flush rewrite rules una vez (ejecutar con ?vyv_flush_rewrites=1)
 */
function vyv_flush_rewrites_once() {
    if (isset($_GET['vyv_flush_rewrites']) && current_user_can('manage_options')) {
        global $wp_rewrite;
        $wp_rewrite->flush_rules();
        wp_redirect(admin_url('admin.php?rewrites_flushed=1'));
        exit;
    }
}

/**
 * Auto-flush rewrite rules on theme load if option not set
 */
function vyv_auto_flush_rewrites() {
    if (!get_option('vyv_rewrites_flushed')) {
        global $wp_rewrite;
        $wp_rewrite->flush_rules();
        update_option('vyv_rewrites_flushed', true);
    }
}
add_action('admin_init', 'vyv_flush_rewrites_once');
add_action('init', 'vyv_auto_flush_rewrites');
add_action('after_switch_theme', 'vyv_after_switch_theme');

/**
 * Función para crear menús manualmente (ejecutar una vez)
 * Agregar ?vyv_setup_menus=1 a la URL del admin para ejecutar
 */
function vyv_manual_menu_setup() {
    if (isset($_GET['vyv_setup_menus']) && current_user_can('manage_options')) {
        vyv_create_menus();
        wp_redirect(admin_url('admin.php?menus_created=1'));
        exit;
    }
}
add_action('admin_init', 'vyv_manual_menu_setup');

/**
 * Crear página Classroom si no existe
 */
function vyv_create_classroom_page() {
    // Verificar si ya existe una página con el slug 'classroom'
    $existing = get_page_by_path('classroom');
    if ($existing) {
        return;
    }
    
    $page_data = array(
        'post_title'    => 'Classroom',
        'post_name'     => 'classroom',
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'comment_status' => 'closed',
    );
    
    $page_id = wp_insert_post($page_data);
    
    if ($page_id && !is_wp_error($page_id)) {
        update_post_meta($page_id, '_wp_page_template', 'page-templates/template-classroom.php');
    }
}
add_action('init', 'vyv_create_classroom_page');
