<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'hello-elementor-parent', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'cesmeca-google-fonts', 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&family=Lora:wght@400;600;700&display=swap', [], null );
    wp_enqueue_style( 'hello-elementor-child', get_stylesheet_directory_uri() . '/style.css', [ 'hello-elementor-parent' ], filemtime( get_stylesheet_directory() . '/style.css' ) );
});

require_once get_stylesheet_directory() . '/laud-shortcode.php';
require_once get_stylesheet_directory() . '/lacem-shortcode.php';
require_once get_stylesheet_directory() . '/seminario-historia-shortcode.php';
require_once get_stylesheet_directory() . '/laboratoria-shortcode.php';
require_once get_stylesheet_directory() . '/odemca-shortcode.php';
require_once get_stylesheet_directory() . '/reveldia-shortcode.php';
require_once get_stylesheet_directory() . '/eac-shortcode.php';
require_once get_stylesheet_directory() . '/observatorio-feministas-shortcode.php';
require_once get_stylesheet_directory() . '/catedra-marti-shortcode.php';
require_once get_stylesheet_directory() . '/catedra-mercedes-shortcode.php';
require_once get_stylesheet_directory() . '/convenios-shortcode.php';
require_once get_stylesheet_directory() . '/meif-shortcode.php';
require_once get_stylesheet_directory() . '/deif-shortcode.php';
require_once get_stylesheet_directory() . '/mcsh-shortcode.php';
require_once get_stylesheet_directory() . '/dcsh-shortcode.php';
require_once get_stylesheet_directory() . '/cid-info-shortcode.php';
require_once get_stylesheet_directory() . '/cid-normativa-shortcode.php';
require_once get_stylesheet_directory() . '/contacto-shortcode.php';
require_once get_stylesheet_directory() . '/inicio-shortcode.php';
require_once get_stylesheet_directory() . '/ret-mcsh-shortcode.php';
require_once get_stylesheet_directory() . '/ret-dcsh-shortcode.php';
require_once get_stylesheet_directory() . '/ret-meif-shortcode.php';
require_once get_stylesheet_directory() . '/ret-deif-shortcode.php';

// Quitar imagen destacada en articulos de categoria avisos-y-comunicados
add_filter('post_thumbnail_html', function($html) {
    if (is_single() && in_category('avisos-y-comunicados')) {
        return '';
    }
    return $html;
});

// Banderilla fecha hover - Publicaciones Elementor
add_action('wp_footer', function() {
    if (is_category('publicaciones')) {
        ?>
        <script>
        setTimeout(function() {
            document.querySelectorAll('.elementor-post__card').forEach(function(card) {
                var dateEl = card.querySelector('.elementor-post-date');
                var thumb = card.querySelector('.elementor-post__thumbnail__link');
                if (dateEl && thumb) {
                    var badge = document.createElement('span');
                    badge.className = 'pub-card-date-hover';
                    badge.textContent = dateEl.textContent.trim();
                    thumb.style.position = 'relative';
                    thumb.style.display = 'block';
                    thumb.style.overflow = 'hidden';
                    thumb.appendChild(badge);
                }
            });
        }, 800);
        </script>
        <?php
    }
});

add_shortcode('directorio_tabs', function() {
    $departamentos = get_terms(array(
        'taxonomy'   => 'departamento',
        'hide_empty' => true,
        'orderby'    => 'term_id',
    ));

    if (empty($departamentos) || is_wp_error($departamentos)) {
        return '<p>No hay información del directorio disponible.</p>';
    }

    ob_start();
    ?>
    <style>
        .dir-wrap { display:flex; align-items:stretch; gap:0; max-width:1200px; margin:0 auto; padding:0; flex-wrap:wrap; }
        .dir-menu { min-width:240px; width:240px; border:1px solid #e0e0e0; border-radius:8px 0 0 8px; overflow:hidden; background:#fff; }
        .dir-nav-search { padding:12px; border-bottom:1px solid #e0e0e0; }
        .dir-nav-search input { width:100%; padding:8px 10px; border:1px solid #ccc; border-radius:6px; font-size:14px; box-sizing:border-box; }
        .dir-menu-item { display:block; width:100%; text-align:left; padding:13px 18px; background:none; border:none; border-bottom:1px solid #eee; cursor:pointer; font-size:.88rem; color:#1a1a2e; text-decoration:none !important; line-height:1.3; }
        .dir-menu-item:last-child { border-bottom:none; }
        .dir-menu-item:hover { background:#f0f4ff; color:#2563eb; }
        .dir-menu-item.active { background:#3d8fb5; color:#fff; font-weight:700; }
        .dir-content { flex:1; border:1px solid #e0e0e0; border-left:none; border-radius:0 8px 8px 0; background:#f9f9f9; min-height:400px; }
        .dir-section { display:none; padding:28px 32px; column-count:2; column-gap:32px; }
        .dir-section.active { display:block; }
        .dir-section-title { font-size:1.15rem; font-weight:700; color:#1a3a4a; margin:0 0 20px; padding-bottom:12px; border-bottom:2px solid #e0e0e0; column-span:all; }
        .dir-persona { break-inside:avoid; margin:0 0 14px; font-size:.9rem; line-height:1.7; color:#333; }
        .dir-persona .dir-nombre { font-weight:600; }
        .dir-persona a { color:#2563eb; text-decoration:none; }
        .dir-persona a:hover { text-decoration:underline; }
        .dir-badge { display:inline-block; margin-top:4px; padding:2px 10px; background:#eaf3f8; color:#1a6ebd; border-radius:12px; font-size:12px; font-weight:600; }
        .dir-persona-oculta { display:none !important; }
        @media(max-width:900px){ .dir-section{ column-count:1; } }
        @media(max-width:768px){
            .dir-wrap{ flex-direction:column; padding:16px; }
            .dir-menu{ width:100%; border-radius:8px 8px 0 0; display:flex; flex-wrap:wrap; }
            .dir-nav-search{ flex-basis:100%; }
            .dir-content{ border-left:1px solid #e0e0e0; border-top:none; border-radius:0 0 8px 8px; min-height:auto; }
        }
    </style>
    <div style="margin:16px 0;padding:12px 20px;background:#f0f7fb;border-left:4px solid #3d8fb5;border-radius:6px;display:flex;align-items:center;flex-wrap:wrap;gap:6px;font-size:.88rem;color:#1a3a4a"><strong>📞 Conmutador General:</strong> <a href="tel:+529676786921" style="color:#3d8fb5;font-weight:600">(+52) 967-6786921</a> &middot; <a href="tel:9671120483" style="color:#3d8fb5">967-1120483</a> &middot; <a href="tel:9671120484" style="color:#3d8fb5">967-1120484</a> &middot; <a href="tel:9671120485" style="color:#3d8fb5">967-1120485</a> — marca la extensión deseada</div>

    <div class="dir-wrap">
        <div class="dir-menu">
            <div class="dir-nav-search">
                <input type="text" id="dir-buscador" placeholder="Buscar por nombre...">
            </div>
            <?php foreach ($departamentos as $i => $dep): ?>
                <a href="#" class="dir-menu-item<?php echo $i === 0 ? ' active' : ''; ?>" onclick="dirTab(<?php echo $i; ?>); return false;"><?php echo esc_html($dep->name); ?></a>
            <?php endforeach; ?>
        </div>

        <div class="dir-content">
            <?php foreach ($departamentos as $i => $dep):
                $personas = get_posts(array(
                    'post_type'      => 'directorio_persona',
                    'posts_per_page' => -1,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                    'tax_query'      => array(array(
                        'taxonomy' => 'departamento',
                        'field'    => 'term_id',
                        'terms'    => $dep->term_id,
                    )),
                ));
                ?>
                <div class="dir-section<?php echo $i === 0 ? ' active' : ''; ?>" id="dir-sec-<?php echo $i; ?>">
                    <div class="dir-section-title"><?php echo esc_html($dep->name); ?></div>
                    <?php foreach ($personas as $persona):
                        $cargo = get_post_meta($persona->ID, '_directorio_cargo', true);
                        $email = get_post_meta($persona->ID, '_directorio_email', true);
                        $tel   = get_post_meta($persona->ID, '_directorio_tel', true);
                        $nota  = get_post_meta($persona->ID, '_directorio_nota', true);
                        ?>
                        <div class="dir-persona" data-nombre="<?php echo esc_attr(mb_strtolower($persona->post_title)); ?>">
                            <div class="dir-nombre"><?php echo esc_html($persona->post_title); ?></div>
                            <?php if ($cargo): ?><div><span class="dir-badge"><?php echo esc_html($cargo); ?></span></div><?php endif; ?>
                            <?php if ($email): ?><div>✉ <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></div><?php endif; ?>
                            <?php if ($tel): ?><div><?php echo esc_html($tel); ?></div><?php endif; ?>
                            <?php if ($nota): ?><div><span class="dir-badge"><?php echo esc_html($nota); ?></span></div><?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script>
    function dirTab(n) {
        document.querySelectorAll(".dir-menu-item").forEach(function(el,i){ el.classList.toggle("active", i===n); });
        document.querySelectorAll(".dir-section").forEach(function(el,i){ el.classList.toggle("active", i===n); });
    }
    (function() {
        var buscador = document.getElementById('dir-buscador');
        if (!buscador) return;
        buscador.addEventListener('input', function() {
            var q = buscador.value.trim().toLowerCase();
            var personas = document.querySelectorAll('.dir-persona');
            var secciones = document.querySelectorAll('.dir-section');
            var menuItems = document.querySelectorAll('.dir-menu-item');

            if (q === '') {
                personas.forEach(function(p) { p.classList.remove('dir-persona-oculta'); });
                secciones.forEach(function(s, i) { s.classList.toggle('active', i === 0); });
                menuItems.forEach(function(el, i) { el.classList.toggle('active', i === 0); });
                return;
            }

            personas.forEach(function(p) {
                var coincide = p.dataset.nombre.indexOf(q) !== -1;
                p.classList.toggle('dir-persona-oculta', !coincide);
            });

            secciones.forEach(function(s, i) {
                var tieneCoincidencia = s.querySelectorAll('.dir-persona:not(.dir-persona-oculta)').length > 0;
                s.classList.toggle('active', tieneCoincidencia);
                menuItems[i].classList.toggle('active', tieneCoincidencia);
            });
        });
    })();
    </script>
    <?php
    return ob_get_clean();
});

add_action('wp_footer', function() {
    if (is_front_page()) {
        echo '<script>
        window.addEventListener("load", function() {
            setTimeout(function() {
                document.querySelectorAll(".swiper").forEach(function(el) {
                    if (el.swiper) { el.swiper.update(); }
                });
            }, 300);
        });
        </script>';
    }
});

// Logo institucional en el footer
add_action('wp_footer', function() {
    ?>
    <div style="background-color:#353942; padding:30px 20px; text-align:center;">
        <img src="/wp-content/uploads/2026/07/logo-web-cesmeca.png" alt="CESMECA" style="max-width:280px; width:100%; height:auto;">
    </div>
    <?php
}, 5);

// ── CPT Banner (slider editable sin Elementor) ──
function cesmeca_registrar_cpt_banner() {
    register_post_type('cesmeca_banner', [
        'labels' => [
            'name' => 'Banners',
            'singular_name' => 'Banner',
            'add_new' => 'Anadir banner',
            'add_new_item' => 'Anadir nuevo banner',
            'edit_item' => 'Editar banner',
            'all_items' => 'Todos los banners',
        ],
        'public' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-images-alt2',
        'supports' => ['title', 'thumbnail'],
        'menu_position' => 20,
    ]);

    register_post_meta('cesmeca_banner', 'banner_link', [
        'type' => 'string',
        'single' => true,
        'show_in_rest' => true,
    ]);
}
add_action('init', 'cesmeca_registrar_cpt_banner');

// Agregar campo "Link del banner" en el editor
function cesmeca_banner_meta_box() {
    add_meta_box('banner_link_box', 'Enlace del banner', 'cesmeca_banner_link_callback', 'cesmeca_banner', 'normal', 'high');
}
add_action('add_meta_boxes', 'cesmeca_banner_meta_box');

function cesmeca_banner_link_callback($post) {
    $link = get_post_meta($post->ID, 'banner_link', true);
    wp_nonce_field('cesmeca_banner_save', 'cesmeca_banner_nonce');
    echo '<label for="banner_link_field">URL de destino al hacer clic (opcional):</label><br>';
    echo '<input type="text" id="banner_link_field" name="banner_link_field" value="' . esc_attr($link) . '" style="width:100%;padding:8px;margin-top:5px;" placeholder="https://ejemplo.com/pagina-destino">';
}

function cesmeca_banner_save($post_id) {
    if (!isset($_POST['cesmeca_banner_nonce']) || !wp_verify_nonce($_POST['cesmeca_banner_nonce'], 'cesmeca_banner_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (isset($_POST['banner_link_field'])) {
        update_post_meta($post_id, 'banner_link', sanitize_text_field($_POST['banner_link_field']));
    }
}
add_action('save_post', 'cesmeca_banner_save');

// ── Shortcode [banner_slider] - slider editable sin Elementor ──
function cesmeca_banner_slider_shortcode() {
    $banners = new WP_Query([
        'post_type' => 'cesmeca_banner',
        'posts_per_page' => -1,
        'orderby' => 'menu_order date',
        'order' => 'ASC',
    ]);

    if (!$banners->have_posts()) return '';

    $uid = 'banner_' . uniqid();
    ob_start();
    ?>
    <div class="cesmeca-banner-slider" id="<?php echo esc_attr($uid); ?>">
        <div class="cesmeca-banner-track">
            <?php while ($banners->have_posts()) : $banners->the_post();
                $link = get_post_meta(get_the_ID(), 'banner_link', true);
                $img = get_the_post_thumbnail_url(get_the_ID(), 'full');
                if (!$img) continue;
            ?>
                <div class="cesmeca-banner-slide">
                    <?php if ($link) : ?>
                        <a href="<?php echo esc_url($link); ?>">
                            <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                        </a>
                    <?php else : ?>
                        <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                    <?php endif; ?>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <button class="cesmeca-banner-prev" aria-label="Anterior">&#8249;</button>
        <button class="cesmeca-banner-next" aria-label="Siguiente">&#8250;</button>
        <div class="cesmeca-banner-dots"></div>
    </div>
    <script>
    (function(){
        var root = document.getElementById('<?php echo esc_js($uid); ?>');
        if (!root) return;
        var track = root.querySelector('.cesmeca-banner-track');
        var slides = Array.from(track.children);
        var dotsWrap = root.querySelector('.cesmeca-banner-dots');
        var idx = 0, timer;

        slides.forEach(function(_, i){
            var d = document.createElement('button');
            d.className = 'cesmeca-banner-dot' + (i === 0 ? ' active' : '');
            d.addEventListener('click', function(){ goTo(i); resetTimer(); });
            dotsWrap.appendChild(d);
        });

        function goTo(i){
            idx = (i + slides.length) % slides.length;
            track.style.transform = 'translateX(-' + (idx * 100) + '%)';
            dotsWrap.querySelectorAll('.cesmeca-banner-dot').forEach(function(d, di){
                d.classList.toggle('active', di === idx);
            });
        }
        function next(){ goTo(idx + 1); }
        function prev(){ goTo(idx - 1); }
        function resetTimer(){ clearInterval(timer); timer = setInterval(next, 9000); }

        root.querySelector('.cesmeca-banner-next').addEventListener('click', function(){ next(); resetTimer(); });
        root.querySelector('.cesmeca-banner-prev').addEventListener('click', function(){ prev(); resetTimer(); });

        resetTimer();
    })();
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('banner_slider', 'cesmeca_banner_slider_shortcode');


/* ================================================================
 * LOGIN PERSONALIZADO V4 - Layout exacto como referencia
 * ================================================================
 *
 * Estrategia: JS mueve #nav, #backtoblog y .language-switcher
 * DENTRO de un wrapper junto al formulario, para que el flexbox
 * de #login solo vea 2 hijos: branding y form-wrap.
 * ================================================================ */

add_filter( 'login_headerurl', function () {
    return home_url();
});

add_filter( 'login_headertext', function () {
    return 'Centro de Estudios Superiores de Mexico y Centroamerica';
});

function cesmeca_login_v4_styles() {
    $logo_jaguar = content_url('uploads/2026/07/logo-jaguar.png');
    ?>
    <style type="text/css">
        /* ── Reset base ── */
        html, body.login {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow-x: hidden;
        }

        body.login {
            background: #1B2A52;
            background-image:
                linear-gradient(160deg, rgba(27,42,82,0.97) 0%, rgba(46,76,140,0.92) 100%),
                url('<?php echo esc_url($logo_jaguar); ?>');
            background-repeat: no-repeat;
            background-position: center center, right -80px bottom -60px;
            background-size: cover, 480px auto;
            font-family: 'Source Sans Pro', -apple-system, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            min-height: 100vh;
            overflow-y: auto;
        }

        /* ── Ocultar h1 nativo de WP ── */
        body.login #login h1 {
            display: none !important;
        }

        /* ── Wrapper principal: SOLO 2 hijos (flex row) ── */
        body.login #login {
            width: 100% !important;
            max-width: 1800px !important;
            padding: 40px !important;
            margin: 0 auto !important;
            float: none !important;
            background: transparent !important;
            box-shadow: none !important;
            border: none !important;
            display: flex !important;
            flex-direction: row;
            align-items: center;
            justify-content: space-around;
            gap: 80px;
            box-sizing: border-box;
        }
        /* ── Laptop ── */
        @media screen and (max-width: 1400px) {
            body.login #login {
                max-width: 1100px !important;
                gap: 60px;
            }
        }

        /* ── Columna izquierda: branding ── */
        .cesmeca-login-branding {
            flex: 1;
            max-width: 420px;
            color: #ffffff;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .cesmeca-login-branding .login-logo {
            width: 260px;
            height: auto;
            margin-bottom: 24px;
            opacity: 1;
        }

        .cesmeca-login-branding .login-institution {
            font-family: 'Lora', Georgia, serif;
            font-size: 32px;
            font-weight: 400;
            line-height: 1.3;
            color: #ffffff;
            margin: 0;
        }

        /* ── Columna derecha: wrapper del formulario ── */
        .cesmeca-login-form-wrap {
            flex: 0 0 380px;
            max-width: 380px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Formulario */
        body.login #loginform {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 35px rgba(0,0,0,0.25);
            border: none;
            padding: 32px 28px;
            margin: 0;
            width: 100%;
            box-sizing: border-box;
        }

        /* Labels */
        body.login label {
            color: #2b2b2b;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
        }

        /* Inputs */
        body.login input[type="text"],
        body.login input[type="password"] {
            border-radius: 7px;
            border: 1.5px solid #d7dbe3;
            padding: 11px 12px;
            font-size: 15px;
            width: 100%;
            box-sizing: border-box;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }

        body.login input[type="text"]:focus,
        body.login input[type="password"]:focus {
            border-color: #2E4C8C;
            box-shadow: 0 0 0 3px rgba(46,76,140,0.15);
            outline: none;
        }

        /* Boton */
        body.login .button-primary {
            background: #1B2A52;
            border: none;
            border-radius: 7px;
            text-shadow: none;
            box-shadow: none;
            padding: 8px 22px;
            height: auto;
            font-weight: 600;
            letter-spacing: 0.2px;
            transition: background 0.2s ease, transform 0.1s ease;
            font-size: 14px;
        }

        body.login .button-primary:hover,
        body.login .button-primary:focus {
            background: #2E4C8C;
            transform: translateY(-1px);
        }

        /* Checkbox */
        body.login .forgetmenot {
            font-size: 13px;
        }

        body.login .forgetmenot label {
            color: #555;
            font-weight: 400;
        }

        /* Links debajo del form - DENTRO del wrap */
        .cesmeca-login-form-wrap #nav {
            text-align: center;
            margin-top: 14px;
            width: 100%;
        }

        .cesmeca-login-form-wrap #nav a {
            color: #ffffff !important;
            opacity: 0.85;
            font-size: 13px;
            text-decoration: none;
        }

        .cesmeca-login-form-wrap #nav a:hover {
            opacity: 1;
            text-decoration: underline;
            color: #A9C2DE;
        }

        .cesmeca-login-form-wrap #backtoblog {
            text-align: center;
            margin-top: 10px;
            width: 100%;
        }

        .cesmeca-login-form-wrap #backtoblog a {
            color: #ffffff !important;
            opacity: 0.85;
            font-size: 13px;
            text-decoration: none;
        }

        .cesmeca-login-form-wrap #backtoblog a:hover {
            opacity: 1;
            color: #A9C2DE;
        }

        /* Selector de idioma - DENTRO del wrap */
        .cesmeca-login-form-wrap .language-switcher {
            text-align: center;
            margin-top: 18px;
            width: 100%;
        }

        .cesmeca-login-form-wrap .language-switcher select {
            border-radius: 6px;
            padding: 6px 10px;
            border: 1px solid rgba(255,255,255,0.3);
            background: rgba(255,255,255,0.1);
            color: #ffffff !important;
            font-size: 13px;
        }
        .cesmeca-login-form-wrap .language-switcher label,
        .cesmeca-login-form-wrap .language-switcher .dashicons {
            color: #ffffff !important;
        }

        .cesmeca-login-form-wrap .language-switcher .button {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.3);
            color: #A9C2DE;
            border-radius: 6px;
            padding: 6px 14px;
            font-size: 13px;
            cursor: pointer;
        }

        .cesmeca-login-form-wrap .language-switcher .button:hover {
            background: rgba(255,255,255,0.1);
        }

        /* Mensajes */
        body.login .message,
        body.login #login_error {
            border-radius: 8px;
            border-left-width: 4px;
            margin-bottom: 20px;
        }

        /* ── Responsive ── */
        @media screen and (max-width: 900px) {
            body.login #login {
                flex-direction: column;
                gap: 40px;
                padding: 30px 20px !important;
            }

            .cesmeca-login-branding {
                order: -1;
                max-width: 100%;
            }

            .cesmeca-login-branding .login-logo {
                width: 150px;
            }

            .cesmeca-login-branding .login-institution {
                font-size: 24px;
            }

            .cesmeca-login-form-wrap {
                flex: 0 0 auto;
                width: 100%;
                max-width: 380px;
            }
        }

        @media screen and (max-width: 480px) {
            body.login #login {
                padding: 20px 16px !important;
            }

            .cesmeca-login-branding .login-logo {
                width: 110px;
            }

            .cesmeca-login-branding .login-institution {
                font-size: 20px;
            }

            body.login #loginform {
                padding: 26px 20px;
                border-radius: 10px;
            }
        }

        @media screen and (max-height: 600px) {
            body.login {
                align-items: flex-start;
                padding-top: 20px;
            }
        }
    </style>
    <?php
}
add_action( 'login_enqueue_scripts', 'cesmeca_login_v4_styles' );

/**
 * Inyecta la columna izquierda y reorganiza el DOM para que
 * #login solo tenga 2 hijos: branding y form-wrap.
 */
function cesmeca_login_v4_reorganizar_dom() {
    $logo_cesmeca = content_url('uploads/2026/07/logo-cesmeca.png');
    ?>
    <script>
    (function() {
        var loginWrapper = document.getElementById('login');
        var loginForm = document.getElementById('loginform');
        if (!loginWrapper || !loginForm) return;

        // 1. Crear columna izquierda (branding)
        var branding = document.createElement('div');
        branding.className = 'cesmeca-login-branding';
        branding.innerHTML =
            '<img src="<?php echo esc_url($logo_cesmeca); ?>" alt="CESMECA" class="login-logo" onerror="this.style.display=\'none\'">' +
            '<p class="login-institution">Centro de Estudios Superiores<br>de M&eacute;xico y Centroam&eacute;rica</p>';

        // 2. Crear wrapper para el formulario y sus accesorios
        var formWrap = document.createElement('div');
        formWrap.className = 'cesmeca-login-form-wrap';

        // 3. Mover el formulario dentro del wrapper
        loginWrapper.insertBefore(branding, loginForm);
        loginWrapper.insertBefore(formWrap, loginForm);
        formWrap.appendChild(loginForm);

        // 4. Mover #nav dentro del wrapper
        var nav = document.getElementById('nav');
        if (nav) {
            formWrap.appendChild(nav);
        }

        // 5. Mover #backtoblog dentro del wrapper
        var backToBlog = document.getElementById('backtoblog');
        if (backToBlog) {
            formWrap.appendChild(backToBlog);
        }

        // 6. Mover .language-switcher dentro del wrapper
        var langSwitcher = document.querySelector('.language-switcher');
        if (langSwitcher) {
            formWrap.appendChild(langSwitcher);
        }
    })();
    </script>
    <?php
}
add_action( 'login_footer', 'cesmeca_login_v4_reorganizar_dom' );

require_once __DIR__ . '/investigadores-sistema.php';

add_action('init', function () {
    add_rewrite_rule(
        '^consejo-academico/page/([0-9]+)/?$',
        'index.php?category_name=consejo-academico&paged=$matches[1]',
        'top'
    );
});

/**
 * Renderiza una pagina con bloque de intro opcional + pestañas de tipo
 * imagenes / videos / posts (eventos dinamicos de WordPress).
 * Consolida el patron repetido en laud/lacem/eac y demas shortcodes.
 */
function cesmeca_render_gallery_tabs($args) {
    $prefix     = isset($args['prefix']) ? sanitize_html_class($args['prefix']) : 'cgt';
    $intro_html = $args['intro_html'] ?? '';
    $tabs       = $args['tabs'] ?? [];
    $uid        = $prefix . '_' . uniqid();

    ob_start();
    ?>
<style>
.<?php echo $prefix; ?>-intro{display:flex;gap:40px;margin-bottom:36px;align-items:flex-start}
.<?php echo $prefix; ?>-intro-text{flex:2}
.<?php echo $prefix; ?>-intro-img{flex:1;text-align:center}
.<?php echo $prefix; ?>-intro-img img{max-width:100%;border-radius:6px}
.<?php echo $prefix; ?>-intro-text h1,.<?php echo $prefix; ?>-intro-text h2{font-size:40px;margin-bottom:16px;color:#1a1a2e;font-family:'Lora',serif}
.<?php echo $prefix; ?>-intro-text h3{font-size:1.1rem;margin:20px 0 8px;color:#1a1a2e}
.<?php echo $prefix; ?>-intro-text p,.<?php echo $prefix; ?>-intro-text li{font-size:.97rem;line-height:1.7;text-align:justify;color:#333}
.<?php echo $prefix; ?>-intro-text ul{padding-left:20px}
.<?php echo $prefix; ?>-intro-text a{color:#2563eb}

.<?php echo $prefix; ?>-tabs-nav{display:flex;flex-wrap:wrap;border-bottom:2px solid #ddd;margin-bottom:24px;gap:4px}
.<?php echo $prefix; ?>-tab-btn{padding:8px 16px;background:#5dade2;border:1px solid #ddd;border-bottom:none;cursor:pointer;font-size:.9rem;color:#fff;border-radius:4px 4px 0 0}
.<?php echo $prefix; ?>-tab-btn:hover,.<?php echo $prefix; ?>-tab-btn:focus{background:#5dade2!important;color:#fff!important;text-decoration:none}
.<?php echo $prefix; ?>-tab-btn.active{background:#3498db!important;color:#fff!important;font-weight:600;border-bottom:2px solid #3498db;margin-bottom:-2px}
.<?php echo $prefix; ?>-tab-btn.active:hover,.<?php echo $prefix; ?>-tab-btn.active:focus{background:#3498db!important;color:#fff!important}
.<?php echo $prefix; ?>-tab-panel{display:none}
.<?php echo $prefix; ?>-tab-panel.active{display:block}
.<?php echo $prefix; ?>-tabs-wrapper{border:1px solid #e0e0e0!important;border-radius:8px!important;padding:24px!important;box-shadow:0 2px 10px rgba(0,0,0,.06)!important}

.<?php echo $prefix; ?>-gallery{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:16px;margin-top:8px}
.<?php echo $prefix; ?>-gallery-item{cursor:pointer;border-radius:6px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.<?php echo $prefix; ?>-gallery-item img{width:100%;height:220px;object-fit:cover;display:block;transition:transform .2s}
.<?php echo $prefix; ?>-gallery-item:hover img{transform:scale(1.03)}

.<?php echo $prefix; ?>-videos-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:20px;margin-top:8px}
.<?php echo $prefix; ?>-video-item{cursor:pointer;border-radius:8px;overflow:hidden;background:#000;box-shadow:0 2px 8px rgba(0,0,0,.15)}
.<?php echo $prefix; ?>-video-thumb{position:relative}
.<?php echo $prefix; ?>-video-thumb img{width:100%;height:160px;object-fit:cover;display:block;opacity:.85}
.<?php echo $prefix; ?>-video-item:hover .<?php echo $prefix; ?>-video-thumb img{opacity:1}
.<?php echo $prefix; ?>-video-play{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:48px;height:48px;background:rgba(255,0,0,.85);border-radius:50%;display:flex;align-items:center;justify-content:center}
.<?php echo $prefix; ?>-video-play svg{width:20px;height:20px;fill:#fff;margin-left:3px}
.<?php echo $prefix; ?>-video-title{padding:10px 12px;background:#111;color:#eee;font-size:.8rem;line-height:1.4;min-height:52px}

.<?php echo $prefix; ?>-eventos-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
.<?php echo $prefix; ?>-content-block{font-size:.97rem;line-height:1.7;color:#333}
.<?php echo $prefix; ?>-content-block p{margin-bottom:12px;text-align:justify}
.<?php echo $prefix; ?>-content-block ul{padding-left:20px;margin-bottom:12px}
.<?php echo $prefix; ?>-content-block li{margin-bottom:8px}
.<?php echo $prefix; ?>-content-block img{max-width:320px;border-radius:6px;margin:12px 0;display:block}
.<?php echo $prefix; ?>-evento-card{background:#fff;border:1px solid #e5e5e5;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.06);transition:transform .2s,box-shadow .2s}
.<?php echo $prefix; ?>-evento-card:hover{transform:translateY(-4px);box-shadow:0 6px 20px rgba(0,0,0,.12)}
.<?php echo $prefix; ?>-evento-card img{width:100%;height:200px;object-fit:cover;display:block}
.<?php echo $prefix; ?>-evento-card-body{padding:16px}
.<?php echo $prefix; ?>-evento-card-body h4{font-size:.95rem;font-weight:700;text-transform:uppercase;margin:0 0 10px;color:#1a1a2e;line-height:1.4}
.<?php echo $prefix; ?>-evento-card-body p{font-size:.88rem;color:#555;line-height:1.6;margin-bottom:14px}
.<?php echo $prefix; ?>-evento-card-body a.btn-vermas{display:inline-block;padding:7px 16px;background:#1a6fa8;color:#fff;border-radius:4px;font-size:.85rem;text-decoration:none}

.<?php echo $prefix; ?>-modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.88);z-index:99999;align-items:center;justify-content:center}
.<?php echo $prefix; ?>-modal-overlay.open{display:flex}
.<?php echo $prefix; ?>-modal-inner{position:relative;max-width:90vw;max-height:90vh}
.<?php echo $prefix; ?>-modal-inner img{max-width:88vw;max-height:85vh;border-radius:4px;display:block}
.<?php echo $prefix; ?>-modal-inner iframe{width:80vw;height:45vw;max-height:80vh;border:none;border-radius:4px;display:block}
.<?php echo $prefix; ?>-modal-close{position:absolute;top:-36px;right:0;background:none;border:none;color:#fff;font-size:2rem;cursor:pointer}
.<?php echo $prefix; ?>-modal-prev,.<?php echo $prefix; ?>-modal-next{position:fixed;top:50%;transform:translateY(-50%);background:rgba(255,255,255,.15);border:none;color:#fff;font-size:2rem;padding:12px 18px;cursor:pointer;border-radius:4px;z-index:100000}
.<?php echo $prefix; ?>-modal-prev{left:16px}
.<?php echo $prefix; ?>-modal-next{right:16px}

@media(max-width:768px){
  .<?php echo $prefix; ?>-intro{flex-direction:column}
  .<?php echo $prefix; ?>-eventos-grid{grid-template-columns:1fr}
  .<?php echo $prefix; ?>-tab-btn{font-size:.8rem;padding:6px 10px}
}
</style>

<?php if ($intro_html): ?>
<div class="<?php echo $prefix; ?>-intro"><?php echo $intro_html; ?></div>
<?php endif; ?>

<div class="<?php echo $prefix; ?>-tabs-wrapper" id="<?php echo esc_attr($uid); ?>">
  <div class="<?php echo $prefix; ?>-tabs-nav">
    <?php foreach ($tabs as $i => $tab): ?>
      <button class="<?php echo $prefix; ?>-tab-btn<?php echo $i === 0 ? ' active' : ''; ?>" data-tab="tab<?php echo $i; ?>">
        <?php echo esc_html($tab['label']); ?>
      </button>
    <?php endforeach; ?>
  </div>

  <?php foreach ($tabs as $i => $tab): ?>
    <div class="<?php echo $prefix; ?>-tab-panel<?php echo $i === 0 ? ' active' : ''; ?>" data-panel="tab<?php echo $i; ?>">

      <?php if ($tab['type'] === 'images'): ?>
        <div class="<?php echo $prefix; ?>-gallery" id="<?php echo esc_attr($uid . '_gal' . $i); ?>">
          <?php foreach ($tab['items'] as $j => $img): ?>
            <div class="<?php echo $prefix; ?>-gallery-item" data-gallery="<?php echo esc_attr($uid . '_gal' . $i); ?>" data-index="<?php echo $j; ?>">
              <img src="<?php echo esc_url($img['src']); ?>" alt="<?php echo esc_attr($img['alt'] ?? ''); ?>" loading="lazy">
            </div>
          <?php endforeach; ?>
        </div>

      <?php elseif ($tab['type'] === 'videos'): ?>
        <div class="<?php echo $prefix; ?>-videos-grid">
          <?php foreach ($tab['items'] as $v): ?>
            <div class="<?php echo $prefix; ?>-video-item" data-video-id="<?php echo esc_attr($v['id']); ?>">
              <div class="<?php echo $prefix; ?>-video-thumb">
                <img src="https://i.ytimg.com/vi/<?php echo esc_attr($v['id']); ?>/hqdefault.jpg" alt="<?php echo esc_attr($v['title']); ?>" loading="lazy">
                <div class="<?php echo $prefix; ?>-video-play"><svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21"/></svg></div>
              </div>
              <div class="<?php echo $prefix; ?>-video-title"><?php echo esc_html($v['title']); ?></div>
            </div>
          <?php endforeach; ?>
        </div>

      <?php elseif ($tab['type'] === 'posts'): ?>
        <div class="<?php echo $prefix; ?>-eventos-grid">
          <?php foreach ($tab['items'] as $item):
            $post    = is_array($item) && isset($item['post']) ? $item['post'] : $item;
            $thumb   = get_the_post_thumbnail_url($post->ID, 'medium');
            if (empty($thumb) && is_array($item) && !empty($item['thumb'])) $thumb = $item['thumb'];
            $excerpt = wp_trim_words(get_the_excerpt($post), 28, '...');
            $url     = get_permalink($post->ID);
          ?>
            <div class="<?php echo $prefix; ?>-evento-card">
              <?php if ($thumb): ?><img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($post->post_title); ?>"><?php endif; ?>
              <div class="<?php echo $prefix; ?>-evento-card-body">
                <h4><?php echo esc_html($post->post_title); ?></h4>
                <p><?php echo esc_html($excerpt); ?></p>
                <a class="btn-vermas" href="<?php echo esc_url($url); ?>">Ver mas...</a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php elseif ($tab['type'] === 'content'): ?>
        <div class="<?php echo $prefix; ?>-content-block">
          <?php echo $tab['html']; ?>
        </div>
      <?php endif; ?>

    </div>
  <?php endforeach; ?>
</div>

<div class="<?php echo $prefix; ?>-modal-overlay" id="<?php echo esc_attr($uid); ?>_img_modal">
  <button class="<?php echo $prefix; ?>-modal-prev" id="<?php echo esc_attr($uid); ?>_prev">&#8249;</button>
  <div class="<?php echo $prefix; ?>-modal-inner">
    <button class="<?php echo $prefix; ?>-modal-close" id="<?php echo esc_attr($uid); ?>_img_close">&times;</button>
    <img src="" alt="" id="<?php echo esc_attr($uid); ?>_img_display">
  </div>
  <button class="<?php echo $prefix; ?>-modal-next" id="<?php echo esc_attr($uid); ?>_next">&#8250;</button>
</div>
<div class="<?php echo $prefix; ?>-modal-overlay" id="<?php echo esc_attr($uid); ?>_vid_modal">
  <div class="<?php echo $prefix; ?>-modal-inner">
    <button class="<?php echo $prefix; ?>-modal-close" id="<?php echo esc_attr($uid); ?>_vid_close">&times;</button>
    <iframe id="<?php echo esc_attr($uid); ?>_vid_frame" src="" allowfullscreen allow="autoplay; encrypted-media"></iframe>
  </div>
</div>

<script>
(function(){
  var uid=<?php echo json_encode($uid); ?>;

  document.querySelectorAll('#'+uid+' .<?php echo $prefix; ?>-tab-btn').forEach(function(btn){
    btn.addEventListener('click',function(){
      document.querySelectorAll('#'+uid+' .<?php echo $prefix; ?>-tab-btn').forEach(function(b){b.classList.remove('active')});
      document.querySelectorAll('#'+uid+' .<?php echo $prefix; ?>-tab-panel').forEach(function(p){p.classList.remove('active')});
      btn.classList.add('active');
      document.querySelector('#'+uid+' [data-panel="'+btn.getAttribute('data-tab')+'"]').classList.add('active');
    });
  });

  var imgModal=document.getElementById(uid+'_img_modal');
  var imgDisplay=document.getElementById(uid+'_img_display');
  var currentGallery=[],currentIndex=0;
  document.querySelectorAll('#'+uid+' .<?php echo $prefix; ?>-gallery-item').forEach(function(item){
    item.addEventListener('click',function(){
      var galId=item.getAttribute('data-gallery');
      currentIndex=parseInt(item.getAttribute('data-index'));
      currentGallery=Array.from(document.querySelectorAll('[data-gallery="'+galId+'"] img')).map(function(i){return{src:i.src,alt:i.alt}});
      imgDisplay.src=currentGallery[currentIndex].src;
      imgDisplay.alt=currentGallery[currentIndex].alt;
      imgModal.classList.add('open');
      document.getElementById(uid+'_prev').style.display=currentGallery.length>1?'':'none';
      document.getElementById(uid+'_next').style.display=currentGallery.length>1?'':'none';
    });
  });
  document.getElementById(uid+'_img_close').addEventListener('click',function(){imgModal.classList.remove('open')});
  imgModal.addEventListener('click',function(e){if(e.target===imgModal)imgModal.classList.remove('open')});
  document.getElementById(uid+'_prev').addEventListener('click',function(){currentIndex=(currentIndex-1+currentGallery.length)%currentGallery.length;imgDisplay.src=currentGallery[currentIndex].src;imgDisplay.alt=currentGallery[currentIndex].alt});
  document.getElementById(uid+'_next').addEventListener('click',function(){currentIndex=(currentIndex+1)%currentGallery.length;imgDisplay.src=currentGallery[currentIndex].src;imgDisplay.alt=currentGallery[currentIndex].alt});

  var vidModal=document.getElementById(uid+'_vid_modal');
  var vidFrame=document.getElementById(uid+'_vid_frame');
  document.querySelectorAll('#'+uid+' .<?php echo $prefix; ?>-video-item').forEach(function(item){
    item.addEventListener('click',function(){
      vidFrame.src='https://www.youtube-nocookie.com/embed/'+item.getAttribute('data-video-id')+'?autoplay=1&rel=0';
      vidModal.classList.add('open');
    });
  });
  document.getElementById(uid+'_vid_close').addEventListener('click',function(){vidModal.classList.remove('open');vidFrame.src=''});
  vidModal.addEventListener('click',function(e){if(e.target===vidModal){vidModal.classList.remove('open');vidFrame.src=''}});

  document.addEventListener('keydown',function(e){if(e.key==='Escape'){imgModal.classList.remove('open');vidModal.classList.remove('open');vidFrame.src=''}});
})();
</script>
    <?php
    return ob_get_clean();
}


// Reemplazar comillas francesas « » por comillas normales " "
function cesmeca_fix_quotes($text) {
    return str_replace(['«', '»'], '"', $text);
}
add_filter('the_title', 'cesmeca_fix_quotes', 20);
add_filter('the_content', 'cesmeca_fix_quotes', 20);
// --- Custom Post Type: directorio_persona ---
function cesmeca_registrar_cpt_directorio() {
    register_post_type('directorio_persona', array(
        'labels' => array(
            'name'          => 'Directorio',
            'singular_name' => 'Persona',
            'add_new_item'  => 'Agregar persona',
            'edit_item'     => 'Editar persona',
            'all_items'     => 'Directorio',
        ),
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'menu_icon'    => 'dashicons-groups',
        'supports'     => array('title', 'page-attributes'),
        'hierarchical' => false,
    ));
}
add_action('init', 'cesmeca_registrar_cpt_directorio');

function cesmeca_registrar_taxonomia_departamento() {
    register_taxonomy('departamento', 'directorio_persona', array(
        'labels' => array(
            'name'          => 'Departamentos',
            'singular_name' => 'Departamento',
        ),
        'hierarchical' => true,
        'show_ui'      => true,
        'show_admin_column' => true,
    ));
}
add_action('init', 'cesmeca_registrar_taxonomia_departamento');

function cesmeca_precargar_departamentos() {
    if (get_option('cesmeca_departamentos_precargados')) return;
    $departamentos = array(
        'Dirección','Secretaría Académica','Secretaría de Extensión y Vinculación',
        'Secretaría Administrativa','Coordinación de Posgrados','Área de Servicios Informáticos',
        'CID Andrés Fábregas Puig','Investigadores','Técnicos académicos','Estancias posdoctorales',
    );
    foreach ($departamentos as $nombre) {
        if (!term_exists($nombre, 'departamento')) {
            wp_insert_term($nombre, 'departamento');
        }
    }
    update_option('cesmeca_departamentos_precargados', 1);
}
add_action('init', 'cesmeca_precargar_departamentos', 20);

function cesmeca_directorio_metabox() {
    add_meta_box('cesmeca_directorio_datos', 'Datos de contacto', 'cesmeca_directorio_metabox_html', 'directorio_persona', 'normal', 'high');
}
add_action('add_meta_boxes', 'cesmeca_directorio_metabox');

function cesmeca_directorio_metabox_html($post) {
    wp_nonce_field('cesmeca_directorio_guardar', 'cesmeca_directorio_nonce');
    $cargo = get_post_meta($post->ID, '_directorio_cargo', true);
    $email = get_post_meta($post->ID, '_directorio_email', true);
    $tel   = get_post_meta($post->ID, '_directorio_tel', true);
    $nota  = get_post_meta($post->ID, '_directorio_nota', true);
    ?>
    <p><label for="cesmeca_cargo"><strong>Cargo</strong></label><br>
    <input type="text" id="cesmeca_cargo" name="cesmeca_cargo" value="<?php echo esc_attr($cargo); ?>" style="width:100%;" placeholder="Ej. Director, Coordinadora del Posgrado en..."></p>
    <p><label for="cesmeca_email"><strong>Email</strong></label><br>
    <input type="email" id="cesmeca_email" name="cesmeca_email" value="<?php echo esc_attr($email); ?>" style="width:100%;" placeholder="nombre.apellido@unicach.mx"></p>
    <p><label for="cesmeca_tel"><strong>Teléfono / Extensión</strong></label><br>
    <input type="text" id="cesmeca_tel" name="cesmeca_tel" value="<?php echo esc_attr($tel); ?>" style="width:100%;" placeholder="Ej. Tel. 103"></p>
    <p><label for="cesmeca_nota"><strong>Nota</strong> (opcional — se muestra como etiqueta)</label><br>
    <input type="text" id="cesmeca_nota" name="cesmeca_nota" value="<?php echo esc_attr($nota); ?>" style="width:100%;" placeholder="Ej. Licencia, Estancia Posdoctoral por México"></p>
    <?php
}

function cesmeca_directorio_guardar($post_id) {
    if (!isset($_POST['cesmeca_directorio_nonce']) || !wp_verify_nonce($_POST['cesmeca_directorio_nonce'], 'cesmeca_directorio_guardar')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    $campos = array('cesmeca_cargo' => '_directorio_cargo', 'cesmeca_email' => '_directorio_email', 'cesmeca_tel' => '_directorio_tel', 'cesmeca_nota' => '_directorio_nota');
    foreach ($campos as $campo_post => $meta_key) {
        if (isset($_POST[$campo_post])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$campo_post]));
        }
    }
}
add_action('save_post_directorio_persona', 'cesmeca_directorio_guardar');

function cesmeca_migrar_directorio() {
    if (get_option('cesmeca_directorio_migrado')) return;
    $datos = array(
        'Dirección' => array(
            array('Dr. Emmanuel Nájera de León', 'Director', 'director_cesmeca@unicach.mx', 'Tel. 103', ''),
            array('Lic. Ana María de la Cruz González', 'Asistente de la Dirección', 'direccion_cesmeca@unicach.mx', 'Tel. 103', ''),
        ),
        'Secretaría Académica' => array(
            array('Dra. Yesenia López Cruz', 'Secretaria Académica', 'investigacion_cesmeca@unicach.mx', 'Tel. 142', ''),
        ),
        'Secretaría de Extensión y Vinculación' => array(
            array('Lic. Roberto Rico Chong', 'Secretario de Extensión y Vinculación', 'roberto.rico@unicach.mx', 'Tel. 139', ''),
            array('Mtra. Adriana G. Ramos Zepeda', 'Coordinación de Comunicación y Difusión', 'adriana.ramos@unicach.mx', 'Tel. 106', ''),
            array('Lic. Irma Cecilia Medina Villafuerte', 'Editora adjunta', 'irma.medina@unicach.mx', 'Tel. 106', ''),
            array('Tec. Brenda Medina Villafuerte', 'Asistente editorial', 'brenda.medina@unicach.mx', 'Tel. 106', ''),
            array('Ing. Roberto Carlos Hoover Silvano', 'Técnico informático', 'roberto.hoover@unicach.mx', 'Tel. 106', ''),
            array('Lic. Gabriela Fragoso Samaniego', 'Convenios', 'gabriela.fragoso@unicach.mx', '', ''),
        ),
        'Secretaría Administrativa' => array(
            array('Lic. Jenny Araceli Molina Gómez', 'Secretaria Administrativa', 'administracion_cesmeca@unicach.mx', 'Tel. 140', ''),
            array('Lic. Patricia Ballinas Salazar', 'Auxiliar administrativa', 'patricia.ballinas@unicach.mx', 'Tel. 104', ''),
            array('Lic. Patricia Ruiz Pérez', 'Auxiliar administrativa', 'patricia.ruiz@unicach.mx', 'Tel. 104', ''),
            array('C. Dora Juvenalia Gordillo', 'Recepcionista', 'dora.gordillo@unicach.mx', 'Tel. 102', ''),
        ),
        'Coordinación de Posgrados' => array(
            array('Mtra. Gabriela Cartagena López', 'Coordinadora del Posgrado en Ciencias Sociales y Humanísticas', 'posgrado.sociales@unicach.mx', 'Tel. 136', ''),
            array('Mtra. Norma Guadalupe Pérez López', 'Coordinadora del Posgrado en Estudios e Intervención Feministas', 'posgrado.feminismos@unicach.mx', 'Tel. 141', ''),
            array('Lic. Yenny Reyes Roque', 'Servicios Escolares', 'yenny.reyes@unicach.mx', 'Tel. 105', ''),
            array('Lic. Alma Yaneth Mera Calva', 'Asistente académica', 'alma.mera@unicach.mx', 'Tel. 105', ''),
        ),
        'Área de Servicios Informáticos' => array(
            array('Ing. Salvador Jorge Huerta Díaz', 'Responsable de sistemas', 'salvador.huerta@unicach.mx', 'Tel. 108', ''),
        ),
        'CID Andrés Fábregas Puig' => array(
            array('Lic. Idolina Guzmán Coronado', 'Jefa del área', 'cid.cesmeca@unicach.mx', 'Tel. 107', ''),
            array('Ing. Luis Gerardo Morales Ramos', 'Asistente de Biblioteca', 'cid.cesmeca@unicach.mx', 'Tel. 107', ''),
        ),
        'Investigadores' => array(
            array('Dr. Daniel Villafuerte Solís', '', 'gasoda2000@gmail.com', 'Tel. 109', ''),
            array('Dr. Jesús Solís Cruz', '', 'jesus.solis@unicach.mx', 'Tel. 110', ''),
            array('Dra. Astrid Pinto Durán', '', 'astrid.pinto@unicach.mx', 'Tel. 113', ''),
            array('Dr. Jesús Morales Bermúdez', '', 'jesus.morales@unicach.mx', 'Tel. 118', ''),
            array('Dr. Martín de la Cruz López Moya', '', 'martin.lopez@unicach.mx', 'Tel. 120', ''),
            array('Dra. Alejandra Robles Ruiz', '', 'ana.robles@unicach.mx', 'Tel. 123', ''),
            array('Dra. Flor Marina Bermúdez Urbina', '', 'flor.bermudez@unicach.mx', 'Tel. 125', ''),
            array('Dr. Mario Valdez Gordillo', '', 'mvaldezg@unicach.mx', 'Tel. 126', ''),
            array('Dra. Ma. Luisa de la Garza Chávez', '', 'marialuisa.garza@unicach.mx', 'Tel. 129', ''),
            array('Dra. María del Carmen García Aguilar', '', 'carmen.garcia@unicach.mx', 'Tel. 131', ''),
            array('Dr. Alain Basail Rodríguez', '', 'alain.basail@unicach.mx', 'Tel. 132', ''),
            array('Dra. Magda Estrella Zúñiga Zenteno', '', 'magdazuniga@hotmail.com', 'Tel. 134', ''),
            array('Dr. Axel Köhler', '', 'axel.kohler@unicach.mx', 'Tel. 135', ''),
            array('Dra. Teresa Garzón Martínez', '', 'maria.garzon@unicach.mx', 'Tel. 138', ''),
            array('Dra. María de Lourdes Morales Vargas', '', 'maria.morales@unicach.mx', '', ''),
            array('Dr. Carlos de Jesús Gómez Abarca', '', 'carlos.gomez@unicach.mx', 'Tel. 114', ''),
            array('Dra. Delmy Tania Cruz Hernández', '', 'delmy.cruz@unicach.mx', '', ''),
            array('Dra. Mónica Aguilar Mendizábal', '', 'monica.aguilar@unicach.mx', '', ''),
            array('Dra. Karla Lizbeth Somosa Ibarra', '', 'karla.somosa@unicach.mx', '', ''),
            array('Dra. Marisol Anzo Escobar', '', 'marisol.anzo@unicach.mx', '', ''),
            array('Dr. Armando Méndez Zárate', '', 'armando.mendez@unicach.mx', '', ''),
        ),
        'Técnicos académicos' => array(
            array('Dr. Fabio Alexis de Ganges López', '', 'fabio.ganges@unicach.mx', '', ''),
            array('Mtro. Gabriel Hernández García', '', 'gabriel.hernandez@unicach.mx', 'Tel. 119', ''),
            array('Dr. Pablo Alejandro Uc González', 'Coordinador del Observatorio de las Democracias del sur de México y Centroamérica', 'pablo.uc@unicach.mx', '', ''),
            array('Lic. Egner Vázquez López', '', 'egner.vazquez@unicach.mx', '', ''),
            array('Mtro. Emilio Pérez Pérez', '', 'emilio.perez@unicach.mx', '', 'Licencia'),
            array('Dr. Mauricio Arellano Nucamendi', '', 'mauricio.arellano@unicach.mx', '', 'Estancia posdoctoral en CIESAS-Pacífico'),
            array('Lic. Juan Jesús Pérez Gómez', '', 'juan.perez@unicach.mx', '', ''),
        ),
        'Estancias posdoctorales' => array(
            array('Dra. Nelly Eblin Barrientos Gutiérrez', '', '', '', 'Investigadores por México-CONAHCyT'),
            array('Dr. Soiber Adalberto Velázquez Matíaz', '', '', '', 'Estancia Posdoctoral por México'),
            array('Dr. Francisco Ramón Castro Hernández', '', '', '', 'Estancia Posdoctoral por México'),
            array('Dr. Manuel Ignacio Martínez Espinoza', '', '', '', 'Estancia Posdoctoral por México'),
            array('Dra. Agnes del Rosario Jiménez Romo', '', '', '', 'Estancia Posdoctoral por México'),
            array('Dra. Ana Luisa Sánchez Hernández', '', '', '', 'Estancia Posdoctoral por México'),
            array('Dr. Arturo Montoya Hernández', '', '', '', 'Estancia Posdoctoral'),
        ),
    );

    foreach ($datos as $departamento => $personas) {
        $orden = 1;
        foreach ($personas as $p) {
            list($nombre, $cargo, $email, $tel, $nota) = $p;
            $post_id = wp_insert_post(array(
                'post_title'  => $nombre,
                'post_type'   => 'directorio_persona',
                'post_status' => 'publish',
                'menu_order'  => $orden,
            ));
            if (!is_wp_error($post_id) && $post_id) {
                wp_set_object_terms($post_id, $departamento, 'departamento');
                if ($cargo) update_post_meta($post_id, '_directorio_cargo', $cargo);
                if ($email) update_post_meta($post_id, '_directorio_email', $email);
                if ($tel)   update_post_meta($post_id, '_directorio_tel', $tel);
                if ($nota)  update_post_meta($post_id, '_directorio_nota', $nota);
            }
            $orden++;
        }
    }
    update_option('cesmeca_directorio_migrado', 1);
}
add_action('init', 'cesmeca_migrar_directorio', 30);

// --- Publicaciones: mostrar todas en una sola página (para que el buscador JS las encuentre todas) ---
add_action('pre_get_posts', function($query) {
    if (!is_admin() && $query->is_main_query() && is_category('publicaciones')) {
        $query->set('posts_per_page', 200);
    }
});

// --- Redirigir páginas "padre" vacías (con submenú) a su primera página hija ---
add_action('template_redirect', function() {
    if (!is_page()) return;

    $post_id = get_queried_object_id();

    $hijas = get_pages([
        'child_of'    => $post_id,
        'parent'      => $post_id,
        'sort_column' => 'menu_order,post_title',
        'sort_order'  => 'ASC',
        'number'      => 1,
    ]);

    if (!empty($hijas)) {
        wp_redirect(get_permalink($hijas[0]->ID), 302);
        exit;
    }
});

function cesmeca_get_youtube_videos($prefix, $limit = 50) {
    $file = WP_CONTENT_DIR . '/uploads/youtube-cache/' . $prefix . '.json';
    if (!file_exists($file)) {
        return [];
    }
    $data = json_decode(file_get_contents($file), true);
    if (empty($data['items']) || !is_array($data['items'])) {
        return [];
    }
    $videos = [];
    foreach ($data['items'] as $item) {
        $video_id = $item['snippet']['resourceId']['videoId'] ?? null;
        $title = $item['snippet']['title'] ?? '';
        if (!$video_id || $title === 'Private video' || $title === 'Deleted video') {
            continue;
        }
        $published = $item['snippet']['publishedAt'] ?? '';
        $videos[] = ['id' => $video_id, 'title' => $title, 'published' => $published];
    }
    return array_slice($videos, 0, $limit);
}

function cesmeca_registrar_cpt_galeria() {
    register_post_type('cesmeca_galeria_item', array(
        'labels' => array(
            'name'          => 'Items de Galería',
            'singular_name' => 'Item de Galería',
            'add_new_item'  => 'Agregar imagen',
            'edit_item'     => 'Editar imagen',
            'all_items'     => 'Items de Galería',
        ),
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'menu_icon'    => 'dashicons-format-gallery',
        'supports'     => array('title', 'thumbnail', 'page-attributes'),
        'hierarchical' => false,
    ));
}
add_action('init', 'cesmeca_registrar_cpt_galeria');

function cesmeca_registrar_taxonomia_galeria_pagina() {
    register_taxonomy('galeria_pagina', 'cesmeca_galeria_item', array(
        'labels' => array(
            'name'          => 'Páginas',
            'singular_name' => 'Página',
        ),
        'hierarchical' => true,
        'show_ui'      => true,
        'show_admin_column' => true,
    ));
}
add_action('init', 'cesmeca_registrar_taxonomia_galeria_pagina');

function cesmeca_registrar_taxonomia_galeria_pestana() {
    register_taxonomy('galeria_pestana', 'cesmeca_galeria_item', array(
        'labels' => array(
            'name'          => 'Pestañas',
            'singular_name' => 'Pestaña',
        ),
        'hierarchical' => true,
        'show_ui'      => true,
        'show_admin_column' => true,
    ));
}
add_action('init', 'cesmeca_registrar_taxonomia_galeria_pestana');

function cesmeca_precargar_paginas_galeria() {
    if (get_option('cesmeca_paginas_galeria_precargadas')) return;
    $paginas = array('merc' => 'Cátedra Mercedes Olivera', 'lacem' => 'LACEM', 'semhist' => 'Seminario Historia', 'laud' => 'LAUD', 'marti' => 'Cátedra Martí', 'eac' => 'EAC', 'laboratoria' => 'Laboratoria', 'reveldia' => 'ReVeldía');
    foreach ($paginas as $slug => $nombre) {
        if (!term_exists($slug, 'galeria_pagina')) {
            wp_insert_term($nombre, 'galeria_pagina', array('slug' => $slug));
        }
    }
    update_option('cesmeca_paginas_galeria_precargadas', 1);
}
add_action('init', 'cesmeca_precargar_paginas_galeria', 20);

function cesmeca_get_galeria_imagenes($pagina_slug, $pestana_slug = null) {
    $args = array(
        'post_type' => 'cesmeca_galeria_item',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'tax_query' => array(
            array('taxonomy' => 'galeria_pagina', 'field' => 'slug', 'terms' => $pagina_slug),
        ),
    );
    if ($pestana_slug) {
        $args['tax_query'][] = array('taxonomy' => 'galeria_pestana', 'field' => 'slug', 'terms' => $pestana_slug);
    }
    $posts = get_posts($args);
    $items = array();
    foreach ($posts as $p) {
        $src = get_the_post_thumbnail_url($p->ID, 'large');
        if (!$src) continue;
        $items[] = array('src' => $src, 'alt' => get_the_title($p->ID));
    }
    return $items;
}

function cesmeca_migrar_galeria_mercedes_once() {
    if (get_option('cesmeca_galeria_mercedes_migrada')) return;
    if (!current_user_can('manage_options')) return;
    if (!isset($_GET['cesmeca_migrar_mercedes'])) return;

    $imagenes = [
        '/wp-content/uploads/cesmeca-legacy/2018/00/CatMercedes20181.jpg',
        '/wp-content/uploads/cesmeca-legacy/2018/00/CatMercedes20182.jpg',
        '/wp-content/uploads/cesmeca-legacy/2018/00/CatMercedes20183.jpg',
        '/wp-content/uploads/cesmeca-legacy/2018/00/CatMercedes20184.jpg',
        '/wp-content/uploads/cesmeca-legacy/2018/00/CatMercedes20185.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/10/21/Propuesta_Conferencia_Aida_Hern%C3%A1ndez.png',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Ciclo_de_conferencias_Magistrales.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Raquel_Gutirrez.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Foro_el_teatro_popular.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/mujeres-en-defensa-de-la-tierra.jpg',
        '/wp-content/uploads/cesmeca-legacy/2020/02/06/JORNADA_Semi%C3%B3ticas_Corporales-02.png',
        '/wp-content/uploads/cesmeca-legacy/2020/10/08/Capitalismo_gore_y_transfeminismos-2020.png',
        '/wp-content/uploads/cesmeca-legacy/actualizacion_2025/catedra_mercedes_olivera/Conv_1.jpg',
        '/wp-content/uploads/cesmeca-legacy/actualizacion_2025/catedra_mercedes_olivera/Conv_2.jpg',
        '/wp-content/uploads/cesmeca-legacy/actualizacion_2025/catedra_mercedes_olivera/ExposicinFotog.jpg',
        '/wp-content/uploads/cesmeca-legacy/actualizacion_2025/catedra_mercedes_olivera/Mara_Viveros.jpg',
        '/wp-content/uploads/cesmeca-legacy/actualizacion_2025/catedra_mercedes_olivera/Resonando_desde_el_sur.jpg',
    ];

    $orden = 0;
    $creadas = 0;
    foreach ($imagenes as $ruta) {
        $ruta_decodificada = urldecode($ruta);
        $archivo_absoluto = ABSPATH . ltrim($ruta_decodificada, '/');
        if (!file_exists($archivo_absoluto)) {
            error_log("Migrar Mercedes: archivo no encontrado: $archivo_absoluto");
            continue;
        }

        // Buscar si ya existe un adjunto para este archivo
        $guid = site_url($ruta_decodificada);
        $existente = get_posts([
            'post_type' => 'attachment',
            'meta_query' => [],
            'guid' => $guid,
            'posts_per_page' => 1,
        ]);
        // get_posts no filtra bien por guid directo, usar WP_Query con 'guid' via SQL alterno:
        global $wpdb;
        $attachment_id = $wpdb->get_var($wpdb->prepare(
            "SELECT ID FROM $wpdb->posts WHERE post_type='attachment' AND guid=%s LIMIT 1",
            $guid
        ));

        if (!$attachment_id) {
            $filetype = wp_check_filetype(basename($archivo_absoluto), null);
            $attachment = [
                'guid' => $guid,
                'post_mime_type' => $filetype['type'],
                'post_title' => sanitize_file_name(basename($archivo_absoluto)),
                'post_content' => '',
                'post_status' => 'inherit',
            ];
            $attachment_id = wp_insert_attachment($attachment, $archivo_absoluto);
            if (!is_wp_error($attachment_id) && $attachment_id) {
                require_once ABSPATH . 'wp-admin/includes/image.php';
                $attach_data = wp_generate_attachment_metadata($attachment_id, $archivo_absoluto);
                wp_update_attachment_metadata($attachment_id, $attach_data);
            }
        }

        if (!$attachment_id || is_wp_error($attachment_id)) {
            error_log("Migrar Mercedes: fallo al crear adjunto para $archivo_absoluto");
            continue;
        }

        $orden++;
        $post_id = wp_insert_post([
            'post_type' => 'cesmeca_galeria_item',
            'post_title' => 'Agenda académica Mercedes ' . $orden,
            'post_status' => 'publish',
            'menu_order' => $orden,
        ]);
        if ($post_id && !is_wp_error($post_id)) {
            set_post_thumbnail($post_id, $attachment_id);
            wp_set_object_terms($post_id, 'merc', 'galeria_pagina');
            $creadas++;
        }
    }

    update_option('cesmeca_galeria_mercedes_migrada', 1);
    wp_die("Migración completa. $creadas imágenes creadas de " . count($imagenes) . " totales.");
}
add_action('admin_init', 'cesmeca_migrar_galeria_mercedes_once');

function cesmeca_actualizar_contenido_mercedes_once() {
    if (get_option('cesmeca_contenido_mercedes_actualizado')) return;
    if (!current_user_can('manage_options')) return;
    if (!isset($_GET['cesmeca_actualizar_contenido_mercedes'])) return;

    $contenido = '<!-- wp:heading {"level":3} -->
<h3>Descripción</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>La Cátedra de Estudios de Género y Feminismos "Mercedes Olivera" nació en 2013, en el marco de los Posgrados en Estudios e Intervención Feministas, con el propósito de articular la vida académica e intelectual universitaria con la sociedad civil y las organizaciones sociales de Chiapas, la región sur-sureste de México, Centroamérica y el Caribe.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Desde 2022, la Cátedra se ha enfocado en generar espacios de diálogo que fortalezcan los vínculos con los feminismos de los Sures Globales. Con el fin de continuar este giro epistémico, hemos invitado a colegas y referentes de estos feminismos para enriquecer la articulación teórico-política que impulsa nuestro trabajo.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>En 2025 contamos con la presencia de la Dra. Mara Viveros Vigoya, destacada pensadora feminista colombiana, quien visitará el Centro de Estudios Superiores de México y Centroamérica (CESMECA). Su participación nos permitirá reflexionar colectivamente —corazonar— sobre la comprensión del Sur Global y el lugar de la interseccionalidad dentro de los feminismos contemporáneos.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>El programa lleva por nombre &quot;Los Feminismos del Sur con…&quot;, un título pensado para construir un marco de diálogos epistémicos desde la Cátedra. Cada invitada forma parte del margen epistémico del Sur, y consideramos que estos espacios de formación, basados en dichas epistemologías, fortalecen y distinguen la propuesta académica del posgrado.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>La Dra. Mara Viveros Vigoya es profesora del Departamento de Antropología y de la Escuela de Estudios de Género de la Universidad Nacional de Colombia. Su trabajo se ha centrado en los estudios de género, la perspectiva interseccional, la raza y la sexualidad, así como en el análisis de las clases medias negras en Colombia, entre otros temas relevantes.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Coordinadora</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Dra. Delmy Tania Cruz Hernández</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Retribución Social</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Larissa Fuentes Machorro</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Comité</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>En conformación</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[catedra_mercedes_page]
<!-- /wp:shortcode -->';

    $resultado = wp_update_post([
        'ID' => 1703,
        'post_content' => $contenido,
    ], true);

    // Asignar el logo como imagen destacada, si no la tiene
    if (!has_post_thumbnail(1703)) {
        $logo_path = ABSPATH . 'wp-content/uploads/cesmeca-legacy/actualizacion_2025/catedra_mercedes_olivera/LOGO.png';
        if (file_exists($logo_path)) {
            $guid = site_url('/wp-content/uploads/cesmeca-legacy/actualizacion_2025/catedra_mercedes_olivera/LOGO.png');
            global $wpdb;
            $attachment_id = $wpdb->get_var($wpdb->prepare(
                "SELECT ID FROM $wpdb->posts WHERE post_type='attachment' AND guid=%s LIMIT 1", $guid
            ));
            if (!$attachment_id) {
                $filetype = wp_check_filetype('LOGO.png', null);
                $attachment_id = wp_insert_attachment([
                    'guid' => $guid,
                    'post_mime_type' => $filetype['type'],
                    'post_title' => 'LOGO Cátedra Mercedes',
                    'post_status' => 'inherit',
                ], $logo_path);
                if (!is_wp_error($attachment_id)) {
                    require_once ABSPATH . 'wp-admin/includes/image.php';
                    $attach_data = wp_generate_attachment_metadata($attachment_id, $logo_path);
                    wp_update_attachment_metadata($attachment_id, $attach_data);
                }
            }
            if ($attachment_id && !is_wp_error($attachment_id)) {
                set_post_thumbnail(1703, $attachment_id);
            }
        }
    }

    update_option('cesmeca_contenido_mercedes_actualizado', 1);
    if (is_wp_error($resultado)) {
        wp_die('ERROR: ' . $resultado->get_error_message());
    }
    wp_die('Contenido de la página 1703 actualizado correctamente. Logo asignado: ' . (has_post_thumbnail(1703) ? 'SÍ' : 'NO'));
}
add_action('admin_init', 'cesmeca_actualizar_contenido_mercedes_once');

function cesmeca_prepend_logo_flotante($content) {
    if (!is_page() || !has_post_thumbnail() || !in_the_loop() || !is_main_query()) return $content;
    global $post;
    $shortcodes_galeria = ['catedra_mercedes_page', 'lacem_page', 'seminario_historia_page', 'laud_page', 'catedra_marti_page'];
    $tiene_shortcode = false;
    foreach ($shortcodes_galeria as $sc) {
        if (has_shortcode($post->post_content, $sc)) { $tiene_shortcode = true; break; }
    }
    if (!$tiene_shortcode) return $content;

    $logo_url = get_the_post_thumbnail_url($post->ID, 'medium');
    $logo_html = '<div class="cesmeca-logo-flotante"><img src="' . esc_url($logo_url) . '" alt="Logo"></div>';
    return $logo_html . $content;
}
add_filter('the_content', 'cesmeca_prepend_logo_flotante', 5);

function cesmeca_migrar_galeria_lacem_once() {
    if (get_option('cesmeca_galeria_lacem_migrada')) return;
    if (!current_user_can('manage_options')) return;
    if (!isset($_GET['cesmeca_migrar_lacem'])) return;

    if (!term_exists('actividades-2023', 'galeria_pestana')) {
        wp_insert_term('Actividades 2022-2023', 'galeria_pestana', ['slug' => 'actividades-2023']);
    }
    if (!term_exists('actividades-2021', 'galeria_pestana')) {
        wp_insert_term('Actividades 2015-2021', 'galeria_pestana', ['slug' => 'actividades-2021']);
    }

    $grupos = [
        'actividades-2023' => [
            '/wp-content/uploads/cesmeca-legacy/LACEM/memoria.jpg',
            '/wp-content/uploads/cesmeca-legacy/LACEM/cartografia.jpg',
        ],
        'actividades-2021' => [
            '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Aztecas_en_la_nube_de_puntos_.jpg',
            '/wp-content/uploads/cesmeca-legacy/2019/10/07/ciudad-de-vacaciones.png',
            '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Hector_Brignoli.jpg',
            '/wp-content/uploads/cesmeca-legacy/2021/01/22/Sesion_Ceieg_cartel.png',
            '/wp-content/uploads/cesmeca-legacy/2020/01/17/Transformaciones_territoriales_en_Chiapas.png',
            '/wp-content/uploads/cesmeca-legacy/2021/04/27/Foro_Atlas_de_Genero.png',
            '/wp-content/uploads/cesmeca-legacy/2020/09/11/Cartel_interpretaciones_cartograficas_.png',
            '/wp-content/uploads/cesmeca-legacy/2020/00/Curso_SIG_CienciasS.png',
            '/wp-content/uploads/cesmeca-legacy/2020/11/10/Foro_Mapas_para_armar_final.png',
            '/wp-content/uploads/cesmeca-legacy/2021/03/10/Cartel_Guatemala_en_Datos.png',
            '/wp-content/uploads/cesmeca-legacy/2021/09/10/Sesiones-INEGI-LACEM21.png',
        ],
    ];

    $creadas = 0;
    $total = 0;
    global $wpdb;
    foreach ($grupos as $pestana_slug => $imagenes) {
        $orden = 0;
        foreach ($imagenes as $ruta) {
            $total++;
            $ruta_decodificada = urldecode($ruta);
            $archivo_absoluto = ABSPATH . ltrim($ruta_decodificada, '/');
            if (!file_exists($archivo_absoluto)) {
                error_log("Migrar LACEM: archivo no encontrado: $archivo_absoluto");
                continue;
            }
            $guid = site_url($ruta_decodificada);
            $attachment_id = $wpdb->get_var($wpdb->prepare(
                "SELECT ID FROM $wpdb->posts WHERE post_type='attachment' AND guid=%s LIMIT 1", $guid
            ));
            if (!$attachment_id) {
                $filetype = wp_check_filetype(basename($archivo_absoluto), null);
                $attachment_id = wp_insert_attachment([
                    'guid' => $guid,
                    'post_mime_type' => $filetype['type'],
                    'post_title' => sanitize_file_name(basename($archivo_absoluto)),
                    'post_status' => 'inherit',
                ], $archivo_absoluto);
                if (!is_wp_error($attachment_id) && $attachment_id) {
                    require_once ABSPATH . 'wp-admin/includes/image.php';
                    $attach_data = wp_generate_attachment_metadata($attachment_id, $archivo_absoluto);
                    wp_update_attachment_metadata($attachment_id, $attach_data);
                }
            }
            if (!$attachment_id || is_wp_error($attachment_id)) {
                error_log("Migrar LACEM: fallo al crear adjunto para $archivo_absoluto");
                continue;
            }
            $orden++;
            $post_id = wp_insert_post([
                'post_type' => 'cesmeca_galeria_item',
                'post_title' => 'LACEM ' . $pestana_slug . ' ' . $orden,
                'post_status' => 'publish',
                'menu_order' => $orden,
            ]);
            if ($post_id && !is_wp_error($post_id)) {
                set_post_thumbnail($post_id, $attachment_id);
                wp_set_object_terms($post_id, 'lacem', 'galeria_pagina');
                wp_set_object_terms($post_id, $pestana_slug, 'galeria_pestana');
                $creadas++;
            }
        }
    }

    update_option('cesmeca_galeria_lacem_migrada', 1);
    wp_die("Migración LACEM completa. $creadas imágenes creadas de $total totales.");
}
add_action('admin_init', 'cesmeca_migrar_galeria_lacem_once');

function cesmeca_actualizar_contenido_lacem_once() {
    if (get_option('cesmeca_contenido_lacem_actualizado')) return;
    if (!current_user_can('manage_options')) return;
    if (!isset($_GET['cesmeca_actualizar_contenido_lacem'])) return;

    $contenido = '<!-- wp:heading -->
<h1>Laboratorio de Cartografia y Elaboracion de Mapas (LACEM)</h1>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3>Presentacion</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>El LACEM se estableció en 2015 con el objetivo principal de dotar a los proyectos de investigación desarrollados en el CESMECA, del entorno de trabajo y las herramientas que les posibiliten desplegar sus temáticas de manera espacial por medio de representaciones cartográficas de alta calidad. Además de ser considerado como un espacio de creación, edición, acopio y difusión de mapas digitales, como físicos, especialmente de temáticas relacionadas con las ciencias sociales y humanidades.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>De este modo, en la línea de investigación aplicada: <strong>Perspectivas globales en la historia de Chiapas, Centroamérica y el Caribe, épocas moderna y contemporánea</strong>, buscamos reorganizar las actividades y funciones del laboratorio, con el fin de mantener los objetivos de este espacio y potenciar el trabajo colaborativo con estudiantes, investigadores, centros públicos CONACyT e institucionales de la UNICACH.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Objetivos</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>Desarrollar el LACEM como un proyecto institucional del CESMECA que atienda la demanda del uso de tecnologías para el manejo y proyección de información geográfica.</li>
<li>Buscar la interdisciplinariedad del LACEM en especial con la antropologia, la historia, la sociologia y los estudios de genero.</li>
<li>Gestionar y proponer posibles soluciones a las problemáticas sociales de Chiapas y Centroamérica a partir del uso de las herramientas SIG.</li>
<li>Ofrecer herramientas para mejorar los análisis sociales, económicos, culturales y de género desde una perspectiva histórica y contemporánea.</li>
<li>Configurar un espacio de formación y práctica para estudiantes, investigadores y el público en general.</li>
<li>Contribuir a la difusión de las investigaciones de la línea de investigación y de los análisis creados por el CESMECA.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>Coordinadores</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Dr. Mario Eduardo Valdez Gordillo</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Dr. Armando Mendez Zarate</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Contacto</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><a href="mailto:lacem@unicach.mx">lacem@unicach.mx</a></p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[lacem_page]
<!-- /wp:shortcode -->';

    $resultado = wp_update_post([
        'ID' => 1690,
        'post_content' => $contenido,
    ], true);

    if (!has_post_thumbnail(1690)) {
        $logo_path = ABSPATH . 'wp-content/uploads/cesmeca-legacy/2019/08/22/lacem.png';
        if (file_exists($logo_path)) {
            $guid = site_url('/wp-content/uploads/cesmeca-legacy/2019/08/22/lacem.png');
            global $wpdb;
            $attachment_id = $wpdb->get_var($wpdb->prepare(
                "SELECT ID FROM $wpdb->posts WHERE post_type='attachment' AND guid=%s LIMIT 1", $guid
            ));
            if (!$attachment_id) {
                $filetype = wp_check_filetype('lacem.png', null);
                $attachment_id = wp_insert_attachment([
                    'guid' => $guid,
                    'post_mime_type' => $filetype['type'],
                    'post_title' => 'LOGO LACEM',
                    'post_status' => 'inherit',
                ], $logo_path);
                if (!is_wp_error($attachment_id)) {
                    require_once ABSPATH . 'wp-admin/includes/image.php';
                    $attach_data = wp_generate_attachment_metadata($attachment_id, $logo_path);
                    wp_update_attachment_metadata($attachment_id, $attach_data);
                }
            }
            if ($attachment_id && !is_wp_error($attachment_id)) {
                set_post_thumbnail(1690, $attachment_id);
            }
        }
    }

    update_option('cesmeca_contenido_lacem_actualizado', 1);
    if (is_wp_error($resultado)) {
        wp_die('ERROR: ' . $resultado->get_error_message());
    }
    wp_die('Contenido de la página 1690 (LACEM) actualizado. Logo asignado: ' . (has_post_thumbnail(1690) ? 'SÍ' : 'NO'));
}
add_action('admin_init', 'cesmeca_actualizar_contenido_lacem_once');

function cesmeca_migrar_galeria_semhist_once() {
    if (get_option('cesmeca_galeria_semhist_migrada')) return;
    if (!current_user_can('manage_options')) return;
    if (!isset($_GET['cesmeca_migrar_semhist'])) return;

    $imagenes = [
        ['/wp-content/uploads/cesmeca-legacy/2026/02/12/633259523_26439353935670993_5625947691991344746_n.jpg', 'Agenda seminario'],
        ['/wp-content/uploads/cesmeca-legacy/2026/02/12/631744838_26439353942337659_4064999045065488171_n.jpg', 'Agenda seminario'],
        ['/wp-content/uploads/cesmeca-legacy/2026/02/12/490469037_1217855590346032_1991189855996174867_n.jpg', 'Agenda seminario'],
        ['/wp-content/uploads/cesmeca-legacy/2026/02/12/492069699_1053389130253056_4900088558451583392_n.jpg', 'Agenda seminario'],
        ['/wp-content/uploads/cesmeca-legacy/2026/02/12/515439637_1338390048292585_3145956085056992701_n_1.jpg', 'Agenda seminario'],
        ['/wp-content/uploads/cesmeca-legacy/2026/02/12/569035112_1394469272684662_7779209741331473144_n_1.jpg', 'Agenda seminario'],
        ['/wp-content/uploads/cesmeca-legacy/2021/00/seminario-de-historia-2021-agosto-noviembre.png', 'Seminario agosto-noviembre 2021'],
        ['/wp-content/uploads/cesmeca-legacy/2026/02/12/enero-mayo.2020CARTEL_s.jpg', 'Enero-mayo 2020'],
        ['/wp-content/uploads/cesmeca-legacy/seminario_permanente/cartel-1ersemestre2018.jpg', 'Primer semestre 2018'],
        ['/wp-content/uploads/cesmeca-legacy/seminario_permanente/2019.1er.semestre.jpg', 'Primer semestre 2019'],
        ['/wp-content/uploads/cesmeca-legacy/seminario_permanente/cartel-segundo-semestre-2018.jpg', 'Segundo semestre 2018'],
    ];

    $orden = 0;
    $creadas = 0;
    global $wpdb;
    foreach ($imagenes as $item) {
        list($ruta, $alt) = $item;
        $ruta_decodificada = urldecode($ruta);
        $archivo_absoluto = ABSPATH . ltrim($ruta_decodificada, '/');
        if (!file_exists($archivo_absoluto)) {
            error_log("Migrar SemHist: archivo no encontrado: $archivo_absoluto");
            continue;
        }
        $guid = site_url($ruta_decodificada);
        $attachment_id = $wpdb->get_var($wpdb->prepare(
            "SELECT ID FROM $wpdb->posts WHERE post_type='attachment' AND guid=%s LIMIT 1", $guid
        ));
        if (!$attachment_id) {
            $filetype = wp_check_filetype(basename($archivo_absoluto), null);
            $attachment_id = wp_insert_attachment([
                'guid' => $guid,
                'post_mime_type' => $filetype['type'],
                'post_title' => sanitize_file_name(basename($archivo_absoluto)),
                'post_status' => 'inherit',
            ], $archivo_absoluto);
            if (!is_wp_error($attachment_id) && $attachment_id) {
                require_once ABSPATH . 'wp-admin/includes/image.php';
                $attach_data = wp_generate_attachment_metadata($attachment_id, $archivo_absoluto);
                wp_update_attachment_metadata($attachment_id, $attach_data);
            }
        }
        if (!$attachment_id || is_wp_error($attachment_id)) {
            error_log("Migrar SemHist: fallo al crear adjunto para $archivo_absoluto");
            continue;
        }
        $orden++;
        $post_id = wp_insert_post([
            'post_type' => 'cesmeca_galeria_item',
            'post_title' => $alt,
            'post_status' => 'publish',
            'menu_order' => $orden,
        ]);
        if ($post_id && !is_wp_error($post_id)) {
            set_post_thumbnail($post_id, $attachment_id);
            wp_set_object_terms($post_id, 'semhist', 'galeria_pagina');
            $creadas++;
        }
    }

    update_option('cesmeca_galeria_semhist_migrada', 1);
    wp_die("Migración Seminario Historia completa. $creadas imágenes creadas de " . count($imagenes) . " totales.");
}
add_action('admin_init', 'cesmeca_migrar_galeria_semhist_once');

function cesmeca_actualizar_contenido_semhist_once() {
    if (get_option('cesmeca_contenido_semhist_actualizado')) return;
    if (!current_user_can('manage_options')) return;
    if (!isset($_GET['cesmeca_actualizar_contenido_semhist'])) return;

    $contenido = '<!-- wp:heading {"level":3} -->
<h3>Descripcion</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>El Seminario Permanente de Historia de Chiapas y Centroamérica se trata de un esfuerzo interinstitucional en el que participan estudiosos de la historia (profesores y estudiantes de posgrado) adscritos a las siguientes instancias académicas de San Cristóbal de Las Casas, Chiapas:</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>- El Centro de Estudios Superiores de México y Centroamérica de la Universidad de Ciencias y Artes de Chiapas (CESMECA-UNICACH).<br>- El Centro de investigaciones Multidisciplinarias sobre Chiapas y Centroamérica de la Universidad Nacional Autónoma de México (CIMSUR-UNAM).<br>- El Centro de Investigaciones y Estudios Superiores en Antropologia Social (CIESAS) Unidad Sureste.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Quienes participan en el seminario se reunen una vez al mes desde su creacion, en abril de 2016.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>El objetivo principal del seminario es conocer los campos de investigación de cada integrante, compartir el análisis de la historia que se estudia en la región, y, a partir del análisis colectivo por pares de los trabajos, incrementar la calidad y el alcance de los aportes de investigación que redunde en beneficio de la historia regional. Asimismo, se coordinan eventos académicos vinculados con investigaciones sobre historia de Chiapas y de América Central.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Coordinadores</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>- Dr. Aaron Pollack (CIESAS Unidad Sureste)<br>- Dr. Mario E. Valdez Gordillo (CESMECA)<br>- Dr. Gerardo Monterrosa Cubias (CIMSUR)</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[seminario_historia_page]
<!-- /wp:shortcode -->';

    $resultado = wp_update_post([
        'ID' => 1696,
        'post_content' => $contenido,
    ], true);

    update_option('cesmeca_contenido_semhist_actualizado', 1);
    if (is_wp_error($resultado)) {
        wp_die('ERROR: ' . $resultado->get_error_message());
    }
    wp_die('Contenido de la página 1696 (Seminario Historia) actualizado correctamente.');
}
add_action('admin_init', 'cesmeca_actualizar_contenido_semhist_once');

function cesmeca_migrar_galeria_laud_once() {
    if (get_option('cesmeca_galeria_laud_migrada')) return;
    if (!current_user_can('manage_options')) return;
    if (!isset($_GET['cesmeca_migrar_laud'])) return;

    $base = '/wp-content/uploads/2026/06';
    $imgs_raw = [
        'laud_LAUD20171.jpg',
        'laud_LAUD20181.jpg','laud_LAUD20182.jpg','laud_LAUD20183.jpg','laud_LAUD20184.jpg',
        'laud_61356512_2486795461331641_8716390721390641152_o.jpg',
        'laud_61376768_2487216434622877_6121429231277703168_o.jpg',
        'laud_6tas_Jornadas_de_Afromexicanidad.jpg',
        'laud_Conferencia_PabloChavarra_PECDA.jpg',
        'laud_Converstario_6tas_Jornadas_de_Afromexicanidad.jpg',
        'laud_muestra-de-cine-feminista-2019.jpg',
        'laud_LAUD20191.jpg','laud_LAUD20192.jpg','laud_LAUD20193.jpg',
        'laud_7Jornadas_Afrodecendencia2020.png',
        'laud_Presentacin_de_proyectos_Aquelarre_LAUD.jpg',
        'laud_taller-de-baile_6tas-jornadas-de-afromexicanidad.jpg',
        'laud_Charlas_Videofnicas_1.jpg','laud_Charlas_videofnicas_2.jpg',
        'laud_FotObservatorio.jpg',
        'laud_Resiliencia-Resistencia_Mujeres-Negras_21.png',
        'laud_7118b23a-4ebd-4dd6-9713-8b57634e8c72.jpg',
        'laud_IMG-20180626-WA0002.jpg',
        'laud_IMG_1144.jpg',
        'laud_La_Caravana_Migrante-Expo_de_Jacob_Garcia_y_Rodrigo_Pardo.jpg',
        'laud_8JornadasAfro3.png',
        'laud_Banner-Conferencia_Sagrario_Cruz.png',
        'laud_Banner-Conferencia_Sara_Islas.png',
        'laud_Banner_Sagrario_Cruz.png',
        'laud_Banner_Sara_Islas.png',
        'laud_Laboratorio_de_Sonoridades.png',
        'laud_Taller_de_Cine_Documental2021.png',
        'laud_1-Arte_factor_social_Arte_factor_social_Arte_factor_social.png',
        'laud_3_No-Mente_dibujo_de_rostro_No-Mente_dibujo_de_rostro.png',
    ];

    $orden = 0;
    $creadas = 0;
    global $wpdb;
    foreach ($imgs_raw as $nombre) {
        $ruta = $base . '/' . $nombre;
        $archivo_absoluto = ABSPATH . ltrim($ruta, '/');
        if (!file_exists($archivo_absoluto)) {
            error_log("Migrar LAUD: archivo no encontrado: $archivo_absoluto");
            continue;
        }
        $guid = site_url($ruta);
        $attachment_id = $wpdb->get_var($wpdb->prepare(
            "SELECT ID FROM $wpdb->posts WHERE post_type='attachment' AND guid=%s LIMIT 1", $guid
        ));
        if (!$attachment_id) {
            $filetype = wp_check_filetype($nombre, null);
            $attachment_id = wp_insert_attachment([
                'guid' => $guid,
                'post_mime_type' => $filetype['type'],
                'post_title' => sanitize_file_name($nombre),
                'post_status' => 'inherit',
            ], $archivo_absoluto);
            if (!is_wp_error($attachment_id) && $attachment_id) {
                require_once ABSPATH . 'wp-admin/includes/image.php';
                $attach_data = wp_generate_attachment_metadata($attachment_id, $archivo_absoluto);
                wp_update_attachment_metadata($attachment_id, $attach_data);
            }
        }
        if (!$attachment_id || is_wp_error($attachment_id)) {
            error_log("Migrar LAUD: fallo al crear adjunto para $archivo_absoluto");
            continue;
        }
        $orden++;
        $post_id = wp_insert_post([
            'post_type' => 'cesmeca_galeria_item',
            'post_title' => 'LAUD ' . $orden,
            'post_status' => 'publish',
            'menu_order' => $orden,
        ]);
        if ($post_id && !is_wp_error($post_id)) {
            set_post_thumbnail($post_id, $attachment_id);
            wp_set_object_terms($post_id, 'laud', 'galeria_pagina');
            $creadas++;
        }
    }

    update_option('cesmeca_galeria_laud_migrada', 1);
    wp_die("Migración LAUD completa. $creadas imágenes creadas de " . count($imgs_raw) . " totales.");
}
add_action('admin_init', 'cesmeca_migrar_galeria_laud_once');

function cesmeca_migrar_galeria_marti_once() {
    if (get_option('cesmeca_galeria_marti_migrada')) return;
    if (!current_user_can('manage_options')) return;
    if (!isset($_GET['cesmeca_migrar_marti'])) return;

    $imagenes = [
        '/wp-content/uploads/cesmeca-legacy/2014/00/CAtMart20141.jpg',
        '/wp-content/uploads/cesmeca-legacy/2017/00/CAtMart20171.jpg',
        '/wp-content/uploads/cesmeca-legacy/2018/00/CAtMart20181.jpg',
        '/wp-content/uploads/cesmeca-legacy/2018/00/CAtMart20183.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Balam_Rodrigo.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Eckart_Boege.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Enrique_Saforcada.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Fabiola_Escarzaga.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Leticia_Salomn.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Reviviendo_los_sonidos_mayas.png',
        '/wp-content/uploads/cesmeca-legacy/2019/00/memorias-no-antropocentricas-guerra-en-colombia.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Javier_Vidal_y_Roque_Moreno.jpg',
        '/wp-content/uploads/cesmeca-legacy/2020/08/21/SergioRam-CatedraMart.png',
        '/wp-content/uploads/cesmeca-legacy/2020/10/08/Capitalismo_gore_y_transfeminismos-2020.png',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Hector_Brignoli.jpg',
        '/wp-content/uploads/cesmeca-legacy/2020/12/06/Pablo_pachakuti.png',
    ];

    $orden = 0;
    $creadas = 0;
    global $wpdb;
    foreach ($imagenes as $ruta) {
        $ruta_decodificada = urldecode($ruta);
        $archivo_absoluto = ABSPATH . ltrim($ruta_decodificada, '/');
        if (!file_exists($archivo_absoluto)) {
            error_log("Migrar Marti: archivo no encontrado: $archivo_absoluto");
            continue;
        }
        $guid = site_url($ruta_decodificada);
        $attachment_id = $wpdb->get_var($wpdb->prepare(
            "SELECT ID FROM $wpdb->posts WHERE post_type='attachment' AND guid=%s LIMIT 1", $guid
        ));
        if (!$attachment_id) {
            $filetype = wp_check_filetype(basename($archivo_absoluto), null);
            $attachment_id = wp_insert_attachment([
                'guid' => $guid,
                'post_mime_type' => $filetype['type'],
                'post_title' => sanitize_file_name(basename($archivo_absoluto)),
                'post_status' => 'inherit',
            ], $archivo_absoluto);
            if (!is_wp_error($attachment_id) && $attachment_id) {
                require_once ABSPATH . 'wp-admin/includes/image.php';
                $attach_data = wp_generate_attachment_metadata($attachment_id, $archivo_absoluto);
                wp_update_attachment_metadata($attachment_id, $attach_data);
            }
        }
        if (!$attachment_id || is_wp_error($attachment_id)) {
            error_log("Migrar Marti: fallo al crear adjunto para $archivo_absoluto");
            continue;
        }
        $orden++;
        $post_id = wp_insert_post([
            'post_type' => 'cesmeca_galeria_item',
            'post_title' => 'Cátedra Martí ' . $orden,
            'post_status' => 'publish',
            'menu_order' => $orden,
        ]);
        if ($post_id && !is_wp_error($post_id)) {
            set_post_thumbnail($post_id, $attachment_id);
            wp_set_object_terms($post_id, 'marti', 'galeria_pagina');
            $creadas++;
        }
    }

    update_option('cesmeca_galeria_marti_migrada', 1);
    wp_die("Migración Martí completa. $creadas imágenes creadas de " . count($imagenes) . " totales.");
}
add_action('admin_init', 'cesmeca_migrar_galeria_marti_once');

function cesmeca_actualizar_contenido_marti_once() {
    if (get_option('cesmeca_contenido_marti_actualizado')) return;
    if (!current_user_can('manage_options')) return;
    if (!isset($_GET['cesmeca_actualizar_contenido_marti'])) return;

    $contenido = '<!-- wp:heading {"level":3} -->
<h3>Descripción</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>En enero de 2014 el CESMECA impulsó la creación de la Cátedra de Pensamiento Social José Martí, cuyo objetivo responde al compromiso universitario de fortalecer la vinculación y extensión de los conocimientos, saberes y reflexiones que derivan del pensamiento social, político, cultural y humanístico de Nuestra América-Abya Yala.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>El CESMECA, a través de esta Cátedra de Pensamiento Social y situado desde Centroamérica, el Caribe y el área sur sureste de México, mira, interpela y reflexiona desde una mirada histórica la contemporaneidad de los problemas sociales que aquejan a la región, además de que reconoce críticamente las virtudes de los pensamientos latinoamericanos y caribeños que han tejido la configuración cultural de nuestros pueblos.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Para ello, impulsa conferencias magistrales, seminarios especializados, coloquios y talleres con destacados intelectuales, académicas y académicos de la región.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Coordinador e integrantes</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Consejo Honorífico:<br>Gilberto Valdes (Instituto de Filosofía de La Habana y GALFISA, Cuba)<br>Jaime Preciado Coronado (Universidad de Guadalajara, México)<br>Luciano Concheiro (Universidad Autónoma de México-Xochimilco, México)<br>Sergio Ramírez (Narrador, ensayista, periodista, político y abogado nicaragüense)</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[catedra_marti_page]
<!-- /wp:shortcode -->';

    $resultado = wp_update_post([
        'ID' => 1702,
        'post_content' => $contenido,
    ], true);

    if (!has_post_thumbnail(1702)) {
        $logo_path = ABSPATH . 'wp-content/uploads/cesmeca-legacy/catedras_laboratorios/Ctedr_Jos_Mart_Negro_Mesa_de_trabajo_1.png';
        if (file_exists($logo_path)) {
            $guid = site_url('/wp-content/uploads/cesmeca-legacy/catedras_laboratorios/Ctedr_Jos_Mart_Negro_Mesa_de_trabajo_1.png');
            global $wpdb;
            $attachment_id = $wpdb->get_var($wpdb->prepare(
                "SELECT ID FROM $wpdb->posts WHERE post_type='attachment' AND guid=%s LIMIT 1", $guid
            ));
            if (!$attachment_id) {
                $filetype = wp_check_filetype('Ctedr_Jos_Mart.png', null);
                $attachment_id = wp_insert_attachment([
                    'guid' => $guid,
                    'post_mime_type' => $filetype['type'],
                    'post_title' => 'LOGO Cátedra Martí',
                    'post_status' => 'inherit',
                ], $logo_path);
                if (!is_wp_error($attachment_id)) {
                    require_once ABSPATH . 'wp-admin/includes/image.php';
                    $attach_data = wp_generate_attachment_metadata($attachment_id, $logo_path);
                    wp_update_attachment_metadata($attachment_id, $attach_data);
                }
            }
            if ($attachment_id && !is_wp_error($attachment_id)) {
                set_post_thumbnail(1702, $attachment_id);
            }
        }
    }

    update_option('cesmeca_contenido_marti_actualizado', 1);
    if (is_wp_error($resultado)) {
        wp_die('ERROR: ' . $resultado->get_error_message());
    }
    wp_die('Contenido de la página 1702 (Martí) actualizado. Logo asignado: ' . (has_post_thumbnail(1702) ? 'SÍ' : 'NO'));
}
add_action('admin_init', 'cesmeca_actualizar_contenido_marti_once');
/* ============================================================
   CUERPOS ACADÉMICOS - CPT dinámico
   ============================================================ */

// 1. Custom Post Type
function ca_registrar_cpt() {
    register_post_type('cuerpo_academico', array(
        'labels' => array(
            'name' => 'Cuerpos Académicos',
            'singular_name' => 'Cuerpo Académico',
            'add_new_item' => 'Agregar Cuerpo Académico',
            'edit_item' => 'Editar Cuerpo Académico',
            'all_items' => 'Todos los Cuerpos Académicos',
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title', 'page-attributes'),
        'has_archive' => false,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'menu_position' => 20,
    ));
}
add_action('init', 'ca_registrar_cpt');

// 2. Taxonomía de Estado (Consolidado / En Consolidación / En Formación)
function ca_registrar_taxonomia() {
    register_taxonomy('ca_estado', 'cuerpo_academico', array(
        'labels' => array(
            'name' => 'Estado',
            'singular_name' => 'Estado',
        ),
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'hierarchical' => false,
    ));
}
add_action('init', 'ca_registrar_taxonomia');

// Crea los 3 términos por defecto si no existen
function ca_crear_terminos_default() {
    $estados = array(
        'consolidado'      => 'Consolidado',
        'en-consolidacion' => 'En Consolidación',
        'en-formacion'     => 'En Formación',
    );
    foreach ($estados as $slug => $nombre) {
        if (!term_exists($slug, 'ca_estado')) {
            wp_insert_term($nombre, 'ca_estado', array('slug' => $slug));
        }
    }
}
add_action('init', 'ca_crear_terminos_default', 20);

// 3. Metabox de Integrantes: repeater simple (nombre + enlace opcional)
function ca_agregar_metabox() {
    add_meta_box(
        'ca_integrantes_box',
        'Integrantes',
        'ca_render_metabox',
        'cuerpo_academico',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ca_agregar_metabox');

function ca_render_metabox($post) {
    wp_nonce_field('ca_guardar_integrantes', 'ca_integrantes_nonce');
    $integrantes = get_post_meta($post->ID, '_ca_integrantes_data', true);
    if (!is_array($integrantes)) {
        $integrantes = array();
    }
    // Siempre dejar al menos 3 filas vacías disponibles para capturar
    while (count($integrantes) < 3) {
        $integrantes[] = array('nombre' => '', 'enlace' => '');
    }
    ?>
    <p>Nombre del integrante y, opcionalmente, el enlace a su ficha (ej. https://cesmeca.mx/maguilar/). Si el enlace se deja vacío, se muestra como texto sin liga.</p>
    <table class="widefat" id="ca-integrantes-tabla">
        <thead>
            <tr>
                <th style="width:45%;">Nombre</th>
                <th style="width:45%;">Enlace (opcional)</th>
                <th style="width:10%;"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($integrantes as $i => $row) : ?>
            <tr>
                <td><input type="text" style="width:100%;" name="ca_integrantes[<?php echo $i; ?>][nombre]" value="<?php echo esc_attr($row['nombre']); ?>" /></td>
                <td><input type="text" style="width:100%;" name="ca_integrantes[<?php echo $i; ?>][enlace]" value="<?php echo esc_attr($row['enlace']); ?>" placeholder="https://cesmeca.mx/slug/" /></td>
                <td><button type="button" class="button ca-quitar-fila">Quitar</button></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p><button type="button" class="button button-secondary" id="ca-agregar-fila">+ Agregar integrante</button></p>
    <script>
    (function(){
        var tabla = document.querySelector('#ca-integrantes-tabla tbody');
        var addBtn = document.getElementById('ca-agregar-fila');
        function reindexar(){
            tabla.querySelectorAll('tr').forEach(function(tr, idx){
                tr.querySelectorAll('input').forEach(function(input){
                    input.name = input.name.replace(/\[\d+\]/, '[' + idx + ']');
                });
            });
        }
        addBtn.addEventListener('click', function(){
            var idx = tabla.querySelectorAll('tr').length;
            var tr = document.createElement('tr');
            tr.innerHTML = '<td><input type="text" style="width:100%;" name="ca_integrantes[' + idx + '][nombre]" value="" /></td>' +
                            '<td><input type="text" style="width:100%;" name="ca_integrantes[' + idx + '][enlace]" value="" placeholder="https://cesmeca.mx/slug/" /></td>' +
                            '<td><button type="button" class="button ca-quitar-fila">Quitar</button></td>';
            tabla.appendChild(tr);
        });
        tabla.addEventListener('click', function(e){
            if (e.target.classList.contains('ca-quitar-fila')) {
                e.target.closest('tr').remove();
                reindexar();
            }
        });
    })();
    </script>
    <?php
}

function ca_guardar_metabox($post_id) {
    if (!isset($_POST['ca_integrantes_nonce']) || !wp_verify_nonce($_POST['ca_integrantes_nonce'], 'ca_guardar_integrantes')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['ca_integrantes']) && is_array($_POST['ca_integrantes'])) {
        $limpio = array();
        foreach ($_POST['ca_integrantes'] as $row) {
            $nombre = sanitize_text_field($row['nombre']);
            $enlace = esc_url_raw(trim($row['enlace']));
            if (!empty($nombre)) {
                $limpio[] = array('nombre' => $nombre, 'enlace' => $enlace);
            }
        }
        update_post_meta($post_id, '_ca_integrantes_data', $limpio);
    }
}
add_action('save_post', 'ca_guardar_metabox');

// 4. Shortcode [cuerpos_academicos]
function ca_shortcode_render() {
    wp_enqueue_style('cesmeca-shared');
    $query = new WP_Query(array(
        'post_type' => 'cuerpo_academico',
        'posts_per_page' => -1,
        'orderby' => 'menu_order title',
        'order' => 'ASC',
    ));
    ob_start();
    ?>
    <div class="cesmeca-grid">
        <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
            <?php
            $terms = get_the_terms(get_the_ID(), 'ca_estado');
            $estado_slug = '';
            $estado_nombre = '';
            if ($terms && !is_wp_error($terms)) {
                $estado_slug = $terms[0]->slug;
                $estado_nombre = $terms[0]->name;
            }
            $clase_nivel = 'cesmeca-badge';
            if ($estado_slug === 'en-formacion') {
                $clase_nivel .= ' cesmeca-badge--alerta';
            } elseif ($estado_slug === 'consolidado') {
                $clase_nivel .= ' cesmeca-badge--exito';
            } elseif ($estado_slug === 'en-consolidacion') {
                $clase_nivel .= ' cesmeca-badge--info';
            }
            $integrantes = get_post_meta(get_the_ID(), '_ca_integrantes_data', true);
            if (!is_array($integrantes)) {
                $integrantes = array();
            }
            ?>
            <div class="cesmeca-card">
                <h3><?php the_title(); ?></h3>
                <p><span class="<?php echo esc_attr($clase_nivel); ?>"><?php echo esc_html($estado_nombre); ?></span></p>
                <div class="cesmeca-integrantes">
                    <h4>Integrantes</h4>
                    <ul>
                        <?php foreach ($integrantes as $row) : ?>
                            <li>
                                <?php if (!empty($row['enlace'])) : ?>
                                    <a href="<?php echo esc_url($row['enlace']); ?>"><?php echo esc_html($row['nombre']); ?></a>
                                <?php else : ?>
                                    <span><?php echo esc_html($row['nombre']); ?></span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('cuerpos_academicos', 'ca_shortcode_render');
/* ============================================================
   LÍNEAS DE INVESTIGACIÓN - CPT dinámico
   ============================================================ */

// 1. Custom Post Type
function li_registrar_cpt() {
    register_post_type('linea_investigacion', array(
        'labels' => array(
            'name' => 'Líneas de Investigación',
            'singular_name' => 'Línea de Investigación',
            'add_new_item' => 'Agregar Línea de Investigación',
            'edit_item' => 'Editar Línea de Investigación',
            'all_items' => 'Todas las Líneas de Investigación',
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-analytics',
        'supports' => array('title', 'editor', 'page-attributes'),
        'has_archive' => false,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'menu_position' => 21,
    ));
}
add_action('init', 'li_registrar_cpt');

// 2. Metabox de Integrantes: repeater simple (nombre + enlace opcional)
function li_agregar_metabox() {
    add_meta_box(
        'li_integrantes_box',
        'Integrantes',
        'li_render_metabox',
        'linea_investigacion',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'li_agregar_metabox');

function li_render_metabox($post) {
    wp_nonce_field('li_guardar_integrantes', 'li_integrantes_nonce');
    $integrantes = get_post_meta($post->ID, '_li_integrantes_data', true);
    if (!is_array($integrantes)) {
        $integrantes = array();
    }
    while (count($integrantes) < 3) {
        $integrantes[] = array('nombre' => '', 'enlace' => '');
    }
    ?>
    <p>Nombre del integrante y, opcionalmente, el enlace a su ficha (ej. https://cesmeca.mx/maguilar/). Si el enlace se deja vacío, se muestra como texto sin liga.</p>
    <table class="widefat" id="li-integrantes-tabla">
        <thead>
            <tr>
                <th style="width:45%;">Nombre</th>
                <th style="width:45%;">Enlace (opcional)</th>
                <th style="width:10%;"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($integrantes as $i => $row) : ?>
            <tr>
                <td><input type="text" style="width:100%;" name="li_integrantes[<?php echo $i; ?>][nombre]" value="<?php echo esc_attr($row['nombre']); ?>" /></td>
                <td><input type="text" style="width:100%;" name="li_integrantes[<?php echo $i; ?>][enlace]" value="<?php echo esc_attr($row['enlace']); ?>" placeholder="https://cesmeca.mx/slug/" /></td>
                <td><button type="button" class="button li-quitar-fila">Quitar</button></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p><button type="button" class="button button-secondary" id="li-agregar-fila">+ Agregar integrante</button></p>
    <script>
    (function(){
        var tabla = document.querySelector('#li-integrantes-tabla tbody');
        var addBtn = document.getElementById('li-agregar-fila');
        function reindexar(){
            tabla.querySelectorAll('tr').forEach(function(tr, idx){
                tr.querySelectorAll('input').forEach(function(input){
                    input.name = input.name.replace(/\[\d+\]/, '[' + idx + ']');
                });
            });
        }
        addBtn.addEventListener('click', function(){
            var idx = tabla.querySelectorAll('tr').length;
            var tr = document.createElement('tr');
            tr.innerHTML = '<td><input type="text" style="width:100%;" name="li_integrantes[' + idx + '][nombre]" value="" /></td>' +
                            '<td><input type="text" style="width:100%;" name="li_integrantes[' + idx + '][enlace]" value="" placeholder="https://cesmeca.mx/slug/" /></td>' +
                            '<td><button type="button" class="button li-quitar-fila">Quitar</button></td>';
            tabla.appendChild(tr);
        });
        tabla.addEventListener('click', function(e){
            if (e.target.classList.contains('li-quitar-fila')) {
                e.target.closest('tr').remove();
                reindexar();
            }
        });
    })();
    </script>
    <?php
}

function li_guardar_metabox($post_id) {
    if (!isset($_POST['li_integrantes_nonce']) || !wp_verify_nonce($_POST['li_integrantes_nonce'], 'li_guardar_integrantes')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['li_integrantes']) && is_array($_POST['li_integrantes'])) {
        $limpio = array();
        foreach ($_POST['li_integrantes'] as $row) {
            $nombre = sanitize_text_field($row['nombre']);
            $enlace = esc_url_raw(trim($row['enlace']));
            if (!empty($nombre)) {
                $limpio[] = array('nombre' => $nombre, 'enlace' => $enlace);
            }
        }
        update_post_meta($post_id, '_li_integrantes_data', $limpio);
    }
}
add_action('save_post', 'li_guardar_metabox');

// 3. Shortcode [lineas_investigacion]
function li_shortcode_render() {
    wp_enqueue_style('cesmeca-shared');
    $query = new WP_Query(array(
        'post_type' => 'linea_investigacion',
        'posts_per_page' => -1,
        'orderby' => 'menu_order title',
        'order' => 'ASC',
    ));
    ob_start();
    ?>
    <div class="cesmeca-grid">
        <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
            <?php
            $integrantes = get_post_meta(get_the_ID(), '_li_integrantes_data', true);
            if (!is_array($integrantes)) {
                $integrantes = array();
            }
            ?>
            <div class="cesmeca-card">
                <h3><?php the_title(); ?></h3>
                <p><?php echo wp_kses_post(get_the_content()); ?></p>
                <div class="cesmeca-integrantes cesmeca-integrantes--separado">
                    <h4>Integrantes</h4>
                    <ul>
                        <?php foreach ($integrantes as $row) : ?>
                            <li>
                                <?php if (!empty($row['enlace'])) : ?>
                                    <a href="<?php echo esc_url($row['enlace']); ?>"><?php echo esc_html($row['nombre']); ?></a>
                                <?php else : ?>
                                    <span><?php echo esc_html($row['nombre']); ?></span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('lineas_investigacion', 'li_shortcode_render');
/* ============================================================
   PROYECTOS DE INVESTIGACIÓN - CPT dinámico
   ============================================================ */

// 1. Custom Post Type (cada post = una línea/sección del acordeón)
/* ============================================================
   PROYECTOS DE INVESTIGACIÓN - CPT dinámico
   ============================================================ */

// 1. Custom Post Type (cada post = una línea/sección del acordeón)
function pi_registrar_cpt() {
    register_post_type('pi_proyecto', array(
        'labels' => array(
            'name' => 'Proyectos de Investigación',
            'singular_name' => 'Línea de Proyectos',
            'add_new_item' => 'Agregar Línea de Proyectos',
            'edit_item' => 'Editar Línea de Proyectos',
            'all_items' => 'Todas las Líneas de Proyectos',
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => array('title', 'page-attributes'),
        'has_archive' => false,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'menu_position' => 22,
    ));
}
add_action('init', 'pi_registrar_cpt');

// 2. Metabox: repeater de investigador + proyecto(s)
function pi_agregar_metabox() {
    add_meta_box(
        'pi_investigadores_box',
        'Investigadores y Proyectos',
        'pi_render_metabox',
        'pi_proyecto',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'pi_agregar_metabox');

function pi_render_metabox($post) {
    wp_nonce_field('pi_guardar_investigadores', 'pi_investigadores_nonce');
    $filas = get_post_meta($post->ID, '_pi_investigadores_data', true);
    if (!is_array($filas)) {
        $filas = array();
    }
    while (count($filas) < 2) {
        $filas[] = array('nombre' => '', 'enlace' => '', 'proyectos' => '');
    }
    ?>
    <p>Un investigador por bloque. En "Proyectos" escribe uno por línea (se mostrarán separados igual que en la tabla original). El enlace es opcional.</p>
    <div id="pi-tabla-wrap">
        <?php foreach ($filas as $i => $row) : ?>
        <div class="pi-fila" style="border:1px solid #ddd;padding:12px;margin-bottom:10px;background:#fafafa;">
            <p>
                <label><strong>Nombre del investigador/a</strong></label><br>
                <input type="text" style="width:60%;" name="pi_investigadores[<?php echo $i; ?>][nombre]" value="<?php echo esc_attr($row['nombre']); ?>" />
                <input type="text" style="width:35%;" name="pi_investigadores[<?php echo $i; ?>][enlace]" value="<?php echo esc_attr($row['enlace']); ?>" placeholder="https://cesmeca.mx/slug/ (opcional)" />
            </p>
            <p>
                <label><strong>Proyectos</strong> (uno por línea)</label><br>
                <textarea style="width:100%;height:80px;" name="pi_investigadores[<?php echo $i; ?>][proyectos]"><?php echo esc_textarea($row['proyectos']); ?></textarea>
            </p>
            <button type="button" class="button pi-quitar-fila">Quitar investigador</button>
        </div>
        <?php endforeach; ?>
    </div>
    <p><button type="button" class="button button-secondary" id="pi-agregar-fila">+ Agregar investigador</button></p>
    <script>
    (function(){
        var wrap = document.getElementById('pi-tabla-wrap');
        var addBtn = document.getElementById('pi-agregar-fila');
        function reindexar(){
            wrap.querySelectorAll('.pi-fila').forEach(function(fila, idx){
                fila.querySelectorAll('input, textarea').forEach(function(input){
                    input.name = input.name.replace(/\[\d+\]/, '[' + idx + ']');
                });
            });
        }
        addBtn.addEventListener('click', function(){
            var idx = wrap.querySelectorAll('.pi-fila').length;
            var div = document.createElement('div');
            div.className = 'pi-fila';
            div.style.cssText = 'border:1px solid #ddd;padding:12px;margin-bottom:10px;background:#fafafa;';
            div.innerHTML = '<p><label><strong>Nombre del investigador/a</strong></label><br>' +
                '<input type="text" style="width:60%;" name="pi_investigadores[' + idx + '][nombre]" value="" />' +
                '<input type="text" style="width:35%;" name="pi_investigadores[' + idx + '][enlace]" value="" placeholder="https://cesmeca.mx/slug/ (opcional)" /></p>' +
                '<p><label><strong>Proyectos</strong> (uno por línea)</label><br>' +
                '<textarea style="width:100%;height:80px;" name="pi_investigadores[' + idx + '][proyectos]"></textarea></p>' +
                '<button type="button" class="button pi-quitar-fila">Quitar investigador</button>';
            wrap.appendChild(div);
        });
        wrap.addEventListener('click', function(e){
            if (e.target.classList.contains('pi-quitar-fila')) {
                e.target.closest('.pi-fila').remove();
                reindexar();
            }
        });
    })();
    </script>
    <?php
}

function pi_guardar_metabox($post_id) {
    if (!isset($_POST['pi_investigadores_nonce']) || !wp_verify_nonce($_POST['pi_investigadores_nonce'], 'pi_guardar_investigadores')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['pi_investigadores']) && is_array($_POST['pi_investigadores'])) {
        $limpio = array();
        foreach ($_POST['pi_investigadores'] as $row) {
            $nombre = sanitize_text_field($row['nombre']);
            $enlace = esc_url_raw(trim($row['enlace']));
            $proyectos = sanitize_textarea_field($row['proyectos']);
            if (!empty($nombre)) {
                $limpio[] = array('nombre' => $nombre, 'enlace' => $enlace, 'proyectos' => $proyectos);
            }
        }
        update_post_meta($post_id, '_pi_investigadores_data', $limpio);
    }
}
add_action('save_post', 'pi_guardar_metabox');

// 3. Shortcode [proyectos_investigacion]
function pi_shortcode_render() {
    wp_enqueue_style('cesmeca-shared');
    $query = new WP_Query(array(
        'post_type' => 'pi_proyecto',
        'posts_per_page' => -1,
        'orderby' => 'menu_order title',
        'order' => 'ASC',
    ));
    ob_start();
    ?>
    <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
        <?php
        $filas = get_post_meta(get_the_ID(), '_pi_investigadores_data', true);
        if (!is_array($filas)) { $filas = array(); }
        ?>
        <div class="cesmeca-accordion-seccion">
            <div class="cesmeca-accordion-header" onclick="cesmecaToggleAccordion(this)">
                Línea: <?php the_title(); ?> <span class="arrow">›</span>
            </div>
            <div class="cesmeca-accordion-body">
                <table class="cesmeca-table">
                    <tbody>
                        <tr><th>Investigador/a</th><th>Proyecto</th></tr>
                        <?php foreach ($filas as $row) :
                            $proyectos_html = nl2br(esc_html($row['proyectos']));
                        ?>
                        <tr>
                            <td>
                                <?php if (!empty($row['enlace'])) : ?>
                                    <a href="<?php echo esc_url($row['enlace']); ?>"><?php echo esc_html($row['nombre']); ?></a>
                                <?php else : ?>
                                    <?php echo esc_html($row['nombre']); ?>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $proyectos_html; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endwhile; wp_reset_postdata(); endif; ?>
    <p class="cesmeca-nota">* Los proyectos de investigación se encuentran en actualización</p>
    <script>
    function cesmecaToggleAccordion(header) {
        const body = header.nextElementSibling;
        header.classList.toggle('open');
        body.classList.toggle('open');
    }
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('proyectos_investigacion', 'pi_shortcode_render');
/* ============================================================
   INVESTIGADORES - Metabox de edición amigable
   (la plantilla plantilla-investigador.php ya lee estos campos
   meta: _inv_perfil, _inv_lineas_investigacion, etc. Este bloque
   solo mejora la pantalla de edición en el admin.)
   ============================================================ */

// 1. Detectar si la página usa la plantilla de investigador
function inv_es_pagina_investigador($post_id) {
    $template = get_post_meta($post_id, '_wp_page_template', true);
    return ($template === 'plantilla-investigador.php');
}

// 2. Ocultar el editor clásico de contenido en páginas de investigador
function inv_ocultar_editor_contenido() {
    global $post;
    if ($post && $post->post_type === 'page' && inv_es_pagina_investigador($post->ID)) {
        remove_post_type_support('page', 'editor');
    }
}
add_action('admin_init', 'inv_ocultar_editor_contenido');

// 3. Metabox con los 6 campos reales que usa la plantilla
function inv_agregar_metabox() {
    add_meta_box(
        'inv_datos_box',
        'Datos del Investigador / Investigadora',
        'inv_render_metabox',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'inv_agregar_metabox');

function inv_render_metabox($post) {
    // Solo mostrar en páginas con la plantilla de investigador
    if (!inv_es_pagina_investigador($post->ID)) {
        echo '<p style="color:#888;">Este metabox solo aplica a páginas con la plantilla "Investigador".</p>';
        return;
    }

    wp_nonce_field('inv_guardar_datos', 'inv_datos_nonce');

    $campos = array(
        'perfil' => array('label' => 'Perfil', 'help' => 'Formación académica, grados, distinciones.'),
        'lineas_investigacion' => array('label' => 'Líneas de investigación', 'help' => 'Una por línea si son varias.'),
        'proyectos_investigacion' => array('label' => 'Proyectos de investigación', 'help' => 'Uno por línea.'),
        'publicaciones' => array('label' => 'Algunas publicaciones', 'help' => 'Una por línea (deja una línea en blanco entre referencias si quieres más espacio). Puedes usar <em>texto</em> para cursivas.'),
        'correo' => array('label' => 'Correo electrónico', 'help' => 'Ej. nombre@unicach.mx'),
        'cooperacion_interinstitucional' => array('label' => 'Cooperación interinstitucional', 'help' => 'Una por línea. Deja vacío si no aplica.'),
    );

    foreach ($campos as $key => $c) {
        $valor = get_post_meta($post->ID, '_inv_' . $key, true);
        $rows = ($key === 'correo') ? 1 : 5;
        ?>
        <p style="margin-bottom:4px;">
            <label for="inv_<?php echo esc_attr($key); ?>"><strong><?php echo esc_html($c['label']); ?></strong></label><br>
            <span style="color:#888;font-size:12px;"><?php echo esc_html($c['help']); ?></span>
        </p>
        <?php if ($rows === 1) : ?>
            <input type="text" style="width:100%;margin-bottom:18px;" id="inv_<?php echo esc_attr($key); ?>" name="inv_<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($valor); ?>" />
        <?php else : ?>
            <textarea style="width:100%;height:<?php echo $rows * 24; ?>px;margin-bottom:18px;" id="inv_<?php echo esc_attr($key); ?>" name="inv_<?php echo esc_attr($key); ?>"><?php echo esc_textarea($valor); ?></textarea>
        <?php endif;
    }
}

function inv_guardar_metabox($post_id) {
    if (!isset($_POST['inv_datos_nonce']) || !wp_verify_nonce($_POST['inv_datos_nonce'], 'inv_guardar_datos')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!inv_es_pagina_investigador($post_id)) {
        return;
    }

    $campos = array('perfil', 'lineas_investigacion', 'proyectos_investigacion', 'publicaciones', 'correo', 'cooperacion_interinstitucional');
    foreach ($campos as $key) {
        if (isset($_POST['inv_' . $key])) {
            $valor = ($key === 'correo')
                ? sanitize_text_field($_POST['inv_' . $key])
                : wp_kses_post($_POST['inv_' . $key]);
            update_post_meta($post_id, '_inv_' . $key, $valor);
        }
    }
}
add_action('save_post', 'inv_guardar_metabox');
/* ============================================================
   LABORATORIA - Metabox editable (alimenta el shortcode
   [laboratoria_page] que ya usa cesmeca_render_gallery_tabs)
   ============================================================ */

function lab_es_pagina_laboratoria($post_id) {
    return ($post_id == 1697);
}

function lab_agregar_metabox() {
    add_meta_box(
        'lab_datos_box',
        'Datos de Laboratoria',
        'lab_render_metabox',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'lab_agregar_metabox');

function lab_render_metabox($post) {
    if (!lab_es_pagina_laboratoria($post->ID)) {
        return;
    }
    wp_nonce_field('lab_guardar_datos', 'lab_datos_nonce');

    $intro = get_post_meta($post->ID, '_lab_intro', true);
    $coordinadora = get_post_meta($post->ID, '_lab_coordinadora', true);
    $colaboradora = get_post_meta($post->ID, '_lab_colaboradora', true);
    $imagen_principal = get_post_meta($post->ID, '_lab_imagen_principal', true);

    $actividades = get_post_meta($post->ID, '_lab_actividades_data', true);
    if (!is_array($actividades)) {
        $actividades = array();
    }
    while (count($actividades) < 4) {
        $actividades[] = array('etiqueta' => '', 'texto' => '', 'imagenes' => '');
    }
    ?>
    <p><label><strong>Introducción</strong> (un párrafo por línea)</label><br>
    <textarea style="width:100%;height:100px;" name="lab_intro"><?php echo esc_textarea($intro); ?></textarea></p>

    <p><label><strong>Imagen principal</strong> (URL)</label><br>
    <input type="text" style="width:100%;" name="lab_imagen_principal" value="<?php echo esc_attr($imagen_principal); ?>" placeholder="/wp-content/uploads/..." /></p>

    <p style="width:48%;display:inline-block;"><label><strong>Coordinadora</strong></label><br>
    <input type="text" style="width:100%;" name="lab_coordinadora" value="<?php echo esc_attr($coordinadora); ?>" /></p>

    <p style="width:48%;display:inline-block;margin-left:2%;"><label><strong>Colaboradora</strong></label><br>
    <input type="text" style="width:100%;" name="lab_colaboradora" value="<?php echo esc_attr($colaboradora); ?>" /></p>

    <hr>
    <p><strong>Actividades (pestañas)</strong></p>
    <div id="lab-actividades-wrap">
        <?php foreach ($actividades as $i => $act) : ?>
        <div class="lab-fila" style="border:1px solid #ddd;padding:12px;margin-bottom:10px;background:#fafafa;">
            <p><label><strong>Etiqueta de la pestaña</strong> (ej. Actividad 1)</label><br>
            <input type="text" style="width:100%;" name="lab_actividades[<?php echo $i; ?>][etiqueta]" value="<?php echo esc_attr($act['etiqueta']); ?>" /></p>
            <p><label><strong>Texto</strong> (puedes usar &lt;strong&gt;, &lt;em&gt;, &lt;br&gt;)</label><br>
            <textarea style="width:100%;height:100px;" name="lab_actividades[<?php echo $i; ?>][texto]"><?php echo esc_textarea($act['texto']); ?></textarea></p>
            <p><label><strong>Imágenes</strong> (una URL por línea)</label><br>
            <textarea style="width:100%;height:60px;" name="lab_actividades[<?php echo $i; ?>][imagenes]"><?php echo esc_textarea($act['imagenes']); ?></textarea></p>
            <button type="button" class="button lab-quitar-fila">Quitar actividad</button>
        </div>
        <?php endforeach; ?>
    </div>
    <p><button type="button" class="button button-secondary" id="lab-agregar-fila">+ Agregar actividad</button></p>
    <script>
    (function(){
        var wrap = document.getElementById('lab-actividades-wrap');
        var addBtn = document.getElementById('lab-agregar-fila');
        function reindexar(){
            wrap.querySelectorAll('.lab-fila').forEach(function(fila, idx){
                fila.querySelectorAll('input, textarea').forEach(function(input){
                    input.name = input.name.replace(/\[\d+\]/, '[' + idx + ']');
                });
            });
        }
        addBtn.addEventListener('click', function(){
            var idx = wrap.querySelectorAll('.lab-fila').length;
            var div = document.createElement('div');
            div.className = 'lab-fila';
            div.style.cssText = 'border:1px solid #ddd;padding:12px;margin-bottom:10px;background:#fafafa;';
            div.innerHTML = '<p><label><strong>Etiqueta de la pestaña</strong> (ej. Actividad 1)</label><br>' +
                '<input type="text" style="width:100%;" name="lab_actividades[' + idx + '][etiqueta]" value="" /></p>' +
                '<p><label><strong>Texto</strong></label><br>' +
                '<textarea style="width:100%;height:100px;" name="lab_actividades[' + idx + '][texto]"></textarea></p>' +
                '<p><label><strong>Imágenes</strong> (una URL por línea)</label><br>' +
                '<textarea style="width:100%;height:60px;" name="lab_actividades[' + idx + '][imagenes]"></textarea></p>' +
                '<button type="button" class="button lab-quitar-fila">Quitar actividad</button>';
            wrap.appendChild(div);
        });
        wrap.addEventListener('click', function(e){
            if (e.target.classList.contains('lab-quitar-fila')) {
                e.target.closest('.lab-fila').remove();
                reindexar();
            }
        });
    })();
    </script>
    <?php
}

function lab_guardar_metabox($post_id) {
    if (!isset($_POST['lab_datos_nonce']) || !wp_verify_nonce($_POST['lab_datos_nonce'], 'lab_guardar_datos')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!lab_es_pagina_laboratoria($post_id)) {
        return;
    }

    if (isset($_POST['lab_intro'])) {
        update_post_meta($post_id, '_lab_intro', wp_kses_post($_POST['lab_intro']));
    }
    if (isset($_POST['lab_coordinadora'])) {
        update_post_meta($post_id, '_lab_coordinadora', sanitize_text_field($_POST['lab_coordinadora']));
    }
    if (isset($_POST['lab_colaboradora'])) {
        update_post_meta($post_id, '_lab_colaboradora', sanitize_text_field($_POST['lab_colaboradora']));
    }
    if (isset($_POST['lab_imagen_principal'])) {
        update_post_meta($post_id, '_lab_imagen_principal', sanitize_text_field($_POST['lab_imagen_principal']));
    }
    if (isset($_POST['lab_actividades']) && is_array($_POST['lab_actividades'])) {
        $limpio = array();
        foreach ($_POST['lab_actividades'] as $act) {
            $etiqueta = sanitize_text_field($act['etiqueta']);
            $texto = wp_kses_post($act['texto']);
            $imagenes = sanitize_textarea_field($act['imagenes']);
            if (!empty($etiqueta)) {
                $limpio[] = array('etiqueta' => $etiqueta, 'texto' => $texto, 'imagenes' => $imagenes);
            }
        }
        update_post_meta($post_id, '_lab_actividades_data', $limpio);
    }
}
add_action('save_post', 'lab_guardar_metabox');

// Reemplaza el shortcode [laboratoria_page] para leer desde los meta campos
function laboratoria_page_shortcode_v2() {
    $post_id = 1697;
    $intro = get_post_meta($post_id, '_lab_intro', true);
    $coordinadora = get_post_meta($post_id, '_lab_coordinadora', true);
    $colaboradora = get_post_meta($post_id, '_lab_colaboradora', true);
    $imagen_principal = get_post_meta($post_id, '_lab_imagen_principal', true);
    $actividades = get_post_meta($post_id, '_lab_actividades_data', true);
    if (!is_array($actividades)) { $actividades = array(); }

    ob_start();
    $parrafos = preg_split('/\n+/', trim($intro));
    foreach ($parrafos as $p) {
        $p = trim($p);
        if ($p === '') continue;
        echo '<p>' . wp_kses_post($p) . '</p>';
    }
    if (!empty($coordinadora)) {
        echo '<h3>Coordinadora</h3><p>' . esc_html($coordinadora) . '</p>';
    }
    if (!empty($colaboradora)) {
        echo '<h3>Colaboradora</h3><p>' . esc_html($colaboradora) . '</p>';
    }
    $intro_html = '<div class="lab-intro-text">' . ob_get_clean() . '</div>';
    if (!empty($imagen_principal)) {
        $intro_html .= '<div class="lab-intro-img"><img src="' . esc_url($imagen_principal) . '" alt="Laboratoria Creación e Incidencia Feminista"></div>';
    }

    $tabs = array();
    foreach ($actividades as $act) {
        ob_start();
        echo wp_kses_post(nl2br($act['texto']));
        if (!empty($act['imagenes'])) {
            $urls = preg_split('/\n+/', trim($act['imagenes']));
            foreach ($urls as $url) {
                $url = trim($url);
                if ($url === '') continue;
                echo '<img class="cesmeca-zoom" src="' . esc_url($url) . '" alt="' . esc_attr($act['etiqueta']) . '">';
            }
        }
        $tab_html = ob_get_clean();
        $tabs[] = array('label' => $act['etiqueta'], 'type' => 'content', 'html' => $tab_html);
    }

    return cesmeca_render_gallery_tabs([
        'prefix' => 'lab',
        'intro_html' => $intro_html,
        'tabs' => $tabs,
    ]);
}
remove_shortcode('laboratoria_page');
add_shortcode('laboratoria_page', 'laboratoria_page_shortcode_v2');
/* ============================================================
   LABORATORIA - Pestañas automáticas desde bloques Gutenberg
   Divide el contenido de la página 1697 en pestañas usando
   los encabezados <h4>Actividad N</h4> como marcadores.
   El contenido se edita 100% en bloques normales (como LACEM/LAUD).
   ============================================================ */

function lab_filtrar_contenido_tabs($content) {
    if (!is_page(1697) || is_admin()) {
        return $content;
    }

    $marcador = '<h3>Actividades</h3>';
    $pos = strpos($content, $marcador);
    if ($pos === false) {
        return $content;
    }

    $intro_html = substr($content, 0, $pos);
    $resto = substr($content, $pos + strlen($marcador));

    if (!preg_match_all('/<h4[^>]*>(.*?)<\/h4>(.*?)(?=(<h4|$))/s', $resto, $matches, PREG_SET_ORDER)) {
        return $content;
    }

    $tabs = array();
    foreach ($matches as $m) {
        $label = trim(wp_strip_all_tags($m[1]));
        $tab_content = trim($m[2]);
        if ($label === '') continue;
        $tabs[] = array('label' => $label, 'type' => 'content', 'html' => $tab_content);
    }

    if (empty($tabs)) {
        return $content;
    }

    return $intro_html . cesmeca_render_gallery_tabs([
        'prefix' => 'lab',
        'intro_html' => '',
        'tabs' => $tabs,
    ]);
}
add_filter('the_content', 'lab_filtrar_contenido_tabs', 20);
/* ============================================================
   CONVENIOS - CPT dinámico
   ============================================================ */

function conv_registrar_cpt() {
    register_post_type('convenio', array(
        'labels' => array(
            'name' => 'Convenios',
            'singular_name' => 'Convenio',
            'add_new_item' => 'Agregar Convenio',
            'edit_item' => 'Editar Convenio',
            'all_items' => 'Todos los Convenios',
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-media-document',
        'supports' => array('title', 'thumbnail', 'page-attributes'),
        'has_archive' => false,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'menu_position' => 23,
    ));
}
add_action('init', 'conv_registrar_cpt');

function conv_agregar_metabox() {
    add_meta_box(
        'conv_datos_box',
        'Datos del Convenio',
        'conv_render_metabox',
        'convenio',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'conv_agregar_metabox');

function conv_render_metabox($post) {
    wp_nonce_field('conv_guardar_datos', 'conv_datos_nonce');
    $descripcion = get_post_meta($post->ID, '_conv_descripcion', true);
    $enlace = get_post_meta($post->ID, '_conv_enlace', true);
    $fecha = get_post_meta($post->ID, '_conv_fecha', true);
    ?>
    <p><label><strong>Descripción</strong></label><br>
    <textarea style="width:100%;height:100px;" name="conv_descripcion"><?php echo esc_textarea($descripcion); ?></textarea></p>

    <p><label><strong>Enlace de "Ver detalles"</strong> (URL completa, opcional)</label><br>
    <input type="text" style="width:100%;" name="conv_enlace" value="<?php echo esc_attr($enlace); ?>" placeholder="https://cesmeca.mx/..." /></p>
    <p><label><strong>Fecha</strong> (opcional, ej. Febrero de 2013)</label><br>
    <input type="text" style="width:100%;" name="conv_fecha" value="<?php echo esc_attr($fecha); ?>" placeholder="Febrero de 2013" /></p>

    <p style="color:#888;">Usa "Imagen destacada" (panel derecho) para la imagen de la tarjeta.</p>
    <?php
}

function conv_guardar_metabox($post_id) {
    if (!isset($_POST['conv_datos_nonce']) || !wp_verify_nonce($_POST['conv_datos_nonce'], 'conv_guardar_datos')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['conv_descripcion'])) {
        update_post_meta($post_id, '_conv_descripcion', sanitize_textarea_field($_POST['conv_descripcion']));
    }
    if (isset($_POST['conv_enlace'])) {
        update_post_meta($post_id, '_conv_enlace', esc_url_raw(trim($_POST['conv_enlace'])));
    }
    if (isset($_POST["conv_fecha"])) {
        update_post_meta($post_id, "_conv_fecha", sanitize_text_field($_POST["conv_fecha"]));
    }
}
add_action('save_post', 'conv_guardar_metabox');

function conv_shortcode_render() {
    wp_enqueue_style('cesmeca-shared');
    $query = new WP_Query(array(
        'post_type' => 'convenio',
        'posts_per_page' => -1,
        'orderby' => 'menu_order title',
        'order' => 'ASC',
    ));
    ob_start();
    ?>
    <div class="cesmeca-grid" style="grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));">
        <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
            <?php
            $descripcion = get_post_meta(get_the_ID(), '_conv_descripcion', true);
            $enlace = get_post_meta(get_the_ID(), '_conv_enlace', true);
            $fecha = get_post_meta(get_the_ID(), '_conv_fecha', true);
            ?>
            <div class="cesmeca-card-media">
                <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>" alt="<?php the_title_attribute(); ?>">
                    <span class="cesmeca-card-media-badge">Convenio</span>
                <?php endif; ?>
                <div class="cesmeca-card-media-body">
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo esc_html($descripcion); ?></p>
                    <div class="cesmeca-card-media-footer">
                        <?php if (!empty($fecha)) : ?>
                            <span class="cesmeca-card-media-fecha"><?php echo esc_html($fecha); ?></span>
                        <?php else: ?>
                            <span></span>
                        <?php endif; ?>
                        <?php if (!empty($enlace)) : ?>
                            <a class="cesmeca-btn" href="<?php echo esc_url($enlace); ?>">Ver detalles</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('convenios_page_v2', 'conv_shortcode_render');
/* ============================================================
   POSGRADOS - CPT reutilizable para las 4 páginas
   (Maestría CSH, Doctorado CSH, Maestría EIF, Doctorado EIF)
   ============================================================ */

function posg_registrar_cpt() {
    register_post_type('posgrado_seccion', array(
        'labels' => array(
            'name' => 'Secciones de Posgrado',
            'singular_name' => 'Sección de Posgrado',
            'add_new_item' => 'Agregar Sección',
            'edit_item' => 'Editar Sección',
            'all_items' => 'Todas las Secciones',
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => array('title', 'editor', 'page-attributes'),
        'has_archive' => false,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'menu_position' => 24,
    ));
}
add_action('init', 'posg_registrar_cpt');

function posg_registrar_taxonomia() {
    register_taxonomy('posgrado_programa', 'posgrado_seccion', array(
        'labels' => array('name' => 'Programa', 'singular_name' => 'Programa'),
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
    ));
}
add_action('init', 'posg_registrar_taxonomia');

function posg_crear_terminos_default() {
    $programas = array(
        'mcsh' => 'Maestría en Ciencias Sociales y Humanísticas',
        'dcsh' => 'Doctorado en Ciencias Sociales y Humanísticas',
        'meif' => 'Maestría en Estudios e Intervención Feministas',
        'deif' => 'Doctorado en Estudios e Intervención Feministas',
    );
    foreach ($programas as $slug => $nombre) {
        if (!term_exists($slug, 'posgrado_programa')) {
            wp_insert_term($nombre, 'posgrado_programa', array('slug' => $slug));
        }
    }
}
add_action('init', 'posg_crear_terminos_default', 20);

// Shortcode [posgrado_tabs programa="mcsh" titulo="Maestría en..." imagen="/ruta/..."]
function posg_tabs_shortcode($atts) {
    wp_enqueue_style('cesmeca-shared');
    $atts = shortcode_atts(array(
        'programa' => '',
        'titulo' => '',
        'imagen' => '/wp-content/uploads/cesmeca-legacy/2019/08/22/posgradosss.jpg',
    ), $atts);

    if (empty($atts['programa'])) {
        return '<p>Falta especificar el programa.</p>';
    }

    $query = new WP_Query(array(
        'post_type' => 'posgrado_seccion',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'posgrado_programa',
                'field' => 'slug',
                'terms' => $atts['programa'],
            ),
        ),
    ));

    if (!$query->have_posts()) {
        return '<p>Aún no hay secciones cargadas para este programa.</p>';
    }

    $uid = 'posg_' . uniqid();
    ob_start();
    ?>
    <div class="cesmeca-wrap" id="<?php echo esc_attr($uid); ?>">
      <div class="cesmeca-header">
        <div class="cesmeca-header-text"><h1><?php echo esc_html($atts['titulo'] ?: get_the_title()); ?></h1></div>
        <div class="cesmeca-header-img"><img src="<?php echo esc_url($atts['imagen']); ?>" alt="<?php echo esc_attr($atts['titulo']); ?>"></div>
      </div>
      <div class="cesmeca-tabs-vertical-wrapper">
        <div class="cesmeca-tabs-vertical-nav">
          <?php $i = 0; while ($query->have_posts()) : $query->the_post(); ?>
            <button class="cesmeca-tab-btn<?php echo $i === 0 ? ' active' : ''; ?>" data-tab="<?php echo esc_attr($uid . '_' . $i); ?>"><?php the_title(); ?></button>
          <?php $i++; endwhile; ?>
        </div>
        <?php $query->rewind_posts(); $i = 0; while ($query->have_posts()) : $query->the_post(); ?>
          <div class="cesmeca-tab-panel<?php echo $i === 0 ? ' active' : ''; ?>" data-panel="<?php echo esc_attr($uid . '_' . $i); ?>">
            <?php the_content(); ?>
          </div>
        <?php $i++; endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
    <script>
    (function(){
      var wrap = document.getElementById('<?php echo esc_js($uid); ?>');
      wrap.querySelectorAll('.cesmeca-tab-btn').forEach(function(btn){
        btn.addEventListener('click', function(){
          wrap.querySelectorAll('.cesmeca-tab-btn').forEach(function(b){b.classList.remove('active')});
          wrap.querySelectorAll('.cesmeca-tab-panel').forEach(function(p){p.classList.remove('active')});
          btn.classList.add('active');
          wrap.querySelector('[data-panel="'+btn.getAttribute('data-tab')+'"]').classList.add('active');
        });
      });
    })();
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('posgrado_tabs', 'posg_tabs_shortcode');
/* ============================================================
   POSGRADOS - Filtro por programa en la lista del admin
   ============================================================ */

function posg_filtro_admin_programa() {
    global $typenow;
    if ($typenow !== 'posgrado_seccion') {
        return;
    }
    $seleccionado = isset($_GET['posgrado_programa']) ? $_GET['posgrado_programa'] : '';
    $terminos = get_terms(array('taxonomy' => 'posgrado_programa', 'hide_empty' => false));
    if (empty($terminos) || is_wp_error($terminos)) {
        return;
    }
    echo '<select name="posgrado_programa">';
    echo '<option value="">Todos los programas</option>';
    foreach ($terminos as $term) {
        printf(
            '<option value="%s"%s>%s</option>',
            esc_attr($term->slug),
            selected($seleccionado, $term->slug, false),
            esc_html($term->name)
        );
    }
    echo '</select>';
}
add_action('restrict_manage_posts', 'posg_filtro_admin_programa');

// Orden por defecto en el admin: agrupado por programa, luego por orden de pestaña
function posg_admin_orden_defecto($query) {
    global $pagenow, $typenow;
    if (is_admin() && $pagenow === 'edit.php' && $typenow === 'posgrado_seccion' && $query->is_main_query()) {
        if (empty($_GET['orderby'])) {
            $query->set('orderby', 'menu_order');
            $query->set('order', 'ASC');
        }
    }
}
add_action('pre_get_posts', 'posg_admin_orden_defecto');
/* ============================================================
   CESMECA - Registro de la hoja de estilos compartida
   ============================================================ */

function cesmeca_shared_styles() {
    wp_enqueue_style(
        'cesmeca-shared',
        get_stylesheet_directory_uri() . '/cesmeca-shared.css',
        array(),
        filemtime(get_stylesheet_directory() . '/cesmeca-shared.css')
    );
}
add_action('wp_enqueue_scripts', 'cesmeca_shared_styles');
function cesmeca_shared_scripts() { wp_enqueue_script('cesmeca-lightbox', get_stylesheet_directory_uri() . '/cesmeca-lightbox.js', array(), filemtime(get_stylesheet_directory() . '/cesmeca-lightbox.js'), true); } add_action('wp_enqueue_scripts', 'cesmeca_shared_scripts');
