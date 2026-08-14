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
                            <?php if ($cargo): ?><div><?php echo esc_html($cargo); ?></div><?php endif; ?>
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
