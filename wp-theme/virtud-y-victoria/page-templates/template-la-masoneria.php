<?php
/**
 * Template Name: La Masonería
 *
 * @package Virtud_Y_Victoria
 */

get_header();
?>

<section class="page-header page-header--masoneria">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb">
            <?php vyv_breadcrumb(); ?>
        </div>
    </div>
</section>

<section class="content-area">
    <div class="container" style="max-width: 900px;">
        
        <!-- ¿Qué es la Masonería? -->
        <div style="margin-bottom: 60px;" data-animate="fadeInUp">
            <h2><?php _e('¿Qué es la Masonería?', 'virtud-y-victoria'); ?></h2>
            <div class="img-placeholder" style="background: transparent; padding: 0; min-height: 0;">
                <img src="<?php echo esc_url(VYV_URI . '/assets/images/simbolos-masonicos.jpg'); ?>" alt="Símbolos masónicos" style="width: 100%; max-width: 600px; height: auto; display: block; margin: 0 auto; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            </div>
            <p>La Masonería (o Francmasonería) es una institución filosófica y filantrópica, que tiene por objeto la búsqueda de la verdad, el estudio de la moral universal y la práctica de la solidaridad.</p>
            <p>Es una sociedad de hombres libres, de buenas costumbres, que se reúnen en logias bajo los principios de tolerancia, respeto mutuo y fraternidad.</p>
            <p>La Masonería no es una religión, pero exige a sus miembros la creencia en un Ser Supremo, al que denomina Gran Arquitecto del Universo (G.A.D.U.).</p>
        </div>
        
        <!-- Los Grados -->
        <div style="margin-bottom: 60px;">
            <h2 style="text-align: center; margin-bottom: 40px;" data-animate="fadeInUp"><?php _e('Los Tres Grados', 'virtud-y-victoria'); ?></h2>
            <div class="cards-grid" data-animate-stagger>
                <div class="card">
                    <div class="masoneria-icon-box">
                        <i class="fas fa-cube"></i>
                    </div>
                    <div class="card-body">
                        <h3 style="font-size: 18px;"><?php _e('Primer Grado: Aprendiz', 'virtud-y-victoria'); ?></h3>
                        <p>El grado de entrada, donde el candidato comienza su viaje masónico. Simboliza el nacimiento y la búsqueda de la luz.</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="masoneria-icon-box">
                        <i class="fas fa-cubes"></i>
                    </div>
                    <div class="card-body">
                        <h3 style="font-size: 18px;"><?php _e('Segundo Grado: Compañero', 'virtud-y-victoria'); ?></h3>
                        <p>El grado de construcción, donde el masón perfecciona sus conocimientos y trabaja en la edificación del templo interior.</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="masoneria-icon-box">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="card-body">
                        <h3 style="font-size: 18px;"><?php _e('Tercer Grado: Maestro', 'virtud-y-victoria'); ?></h3>
                        <p>El grado de perfección, que representa la muerte y resurrección simbólica. El masón alcanza la plenitud de su formación.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Principios -->
        <div style="margin-bottom: 60px;">
            <h2 style="text-align: center; margin-bottom: 40px;" data-animate="fadeInUp"><?php _e('Principios Masónicos', 'virtud-y-victoria'); ?></h2>
            <div class="cards-grid cols-2" data-animate-stagger>
                <div class="card masoneria-principle">
                    <div class="card-body">
                        <h3><i class="fas fa-heart"></i><?php _e('Fraternidad', 'virtud-y-victoria'); ?></h3>
                        <p>La Masonería es, ante todo, una institución fraternal. Todos los hermanos son iguales sin distinción de raza, religión o condición social.</p>
                    </div>
                </div>
                
                <div class="card masoneria-principle">
                    <div class="card-body">
                        <h3><i class="fas fa-hands-helping"></i><?php _e('Caridad', 'virtud-y-victoria'); ?></h3>
                        <p>El servicio a la comunidad y la ayuda a los más necesitados son pilares fundamentales de la acción masónica.</p>
                    </div>
                </div>
                
                <div class="card masoneria-principle">
                    <div class="card-body">
                        <h3><i class="fas fa-graduation-cap"></i><?php _e('Educación', 'virtud-y-victoria'); ?></h3>
                        <p>La búsqueda constante del conocimiento y la ilustración es un deber de todo masón.</p>
                    </div>
                </div>
                
                <div class="card masoneria-principle">
                    <div class="card-body">
                        <h3><i class="fas fa-balance-scale"></i><?php _e('Tolerancia', 'virtud-y-victoria'); ?></h3>
                        <p>La Masonería prohíbe toda discusión política o religiosa en sus logias, fomentando el respeto por las opiniones de todos.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Preguntas Frecuentes -->
        <div style="margin-bottom: 60px;">
            <h2 style="text-align: center; margin-bottom: 40px;" data-animate="fadeInUp"><?php _e('Preguntas Frecuentes', 'virtud-y-victoria'); ?></h2>
            
            <div class="faq-item" data-animate="fadeInUp">
                <div class="faq-question">
                    <span><?php _e('¿La Masonería es una religión?', 'virtud-y-victoria'); ?></span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-inner">
                        <p>No. La Masonería no es una religión ni sustituye a ninguna religión. Sin embargo, exige a sus miembros la creencia en un Ser Supremo.</p>
                    </div>
                </div>
            </div>
            
            <div class="faq-item" data-animate="fadeInUp">
                <div class="faq-question">
                    <span><?php _e('¿Puede ser masón cualquier hombre?', 'virtud-y-victoria'); ?></span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-inner">
                        <p>Cualquier hombre mayor de 18 años, de buenas costumbres, que crea en un Ser Supremo y sea recomendado por dos miembros de la logia, puede solicitar su ingreso.</p>
                    </div>
                </div>
            </div>
            
            <div class="faq-item" data-animate="fadeInUp">
                <div class="faq-question">
                    <span><?php _e('¿Cuáles son los beneficios de ser masón?', 'virtud-y-victoria'); ?></span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-inner">
                        <p>Los beneficios son principalmente morales: formación en valores, fraternidad, servicio a la comunidad, y el satisfactorio de trabajar por el mejoramiento personal y social.</p>
                    </div>
                </div>
            </div>
            
            <div class="faq-item" data-animate="fadeInUp">
                <div class="faq-question">
                    <span><?php _e('¿Cuánto cuesta ser masón?', 'virtud-y-victoria'); ?></span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-inner">
                        <p>Cada logia establece una cuota de mantenimiento que cubre los gastos operativos. La Masonería no es una organización lucrativa.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- CTA -->
        <div class="masoneria-cta" data-animate="fadeInUp">
            <h2><?php _e('¿Quieres Conocer Más?', 'virtud-y-victoria'); ?></h2>
            <p style="margin-bottom: 30px;">Si la Masonería ha despertado tu interés, te invitamos a contactarnos.</p>
            <a href="<?php echo home_url('/contacto'); ?>" class="btn btn-primary"><?php _e('Contáctanos', 'virtud-y-victoria'); ?></a>
        </div>
        
    </div>
</section>

<?php get_footer(); ?>
