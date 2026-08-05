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
    $page = get_page_by_path('directorio');
    if (!$page) return '<p>No se encontro la pagina Directorio.</p>';

    $content = wpautop($page->post_content);

    preg_match_all('/<h2[^>]*>(.*?)<\/h2>/i', $content, $matches);
    $titles = $matches[1];
    $sections = preg_split('/<h2[^>]*>.*?<\/h2>/i', $content);
    array_shift($sections);

    if (empty($titles)) return $content;

    ob_start();
    echo '<style>
    .dir-wrap{display:flex;gap:0;max-width:1200px;margin:0 auto;padding:32px;align-items:flex-start}
    .dir-menu{min-width:240px;width:240px;border:1px solid #e0e0e0;border-radius:8px 0 0 8px;overflow:hidden;background:#fff}
    .dir-menu-item{display:block;padding:13px 18px;cursor:pointer;font-size:.88rem;color:#1a1a2e;border-bottom:1px solid #eee;transition:all .2s;text-decoration:none;line-height:1.3}
    .dir-menu-item:last-child{border-bottom:none}
    .dir-menu-item:hover{background:#f0f4ff;color:#2563eb}
    .dir-menu-item.active{background:#1a3a4a;color:#fff;font-weight:700}
    .dir-content{flex:1;border:1px solid #e0e0e0;border-left:none;border-radius:0 8px 8px 0;background:#f9f9f9;min-height:400px}
    .dir-section{display:none;padding:28px 32px}
    .dir-section.active{display:block}
    .dir-section-title{font-size:1.15rem;font-weight:700;color:#1a3a4a;margin:0 0 20px;padding-bottom:12px;border-bottom:2px solid #e0e0e0}
    .dir-section p{margin:0 0 14px;font-size:.9rem;line-height:1.7;color:#333}
    .dir-section a{color:#2563eb;text-decoration:none}
    .dir-section a:hover{text-decoration:underline}
    @media(max-width:768px){
        .dir-wrap{flex-direction:column;padding:16px}
        .dir-menu{width:100%;border-radius:8px 8px 0 0}
        .dir-content{border-left:1px solid #e0e0e0;border-top:none;border-radius:0 0 8px 8px;min-height:auto}
    }
    </style>';

    echo '<div class="dir-wrap"><div class="dir-menu">';
    foreach($titles as $i => $title) {
        $active = $i === 0 ? ' active' : '';
        echo '<a class="dir-menu-item' . $active . '" href="#" onclick="dirTab(' . $i . '); return false;">' . strip_tags($title) . '</a>';
    }
    echo '</div><div class="dir-content">';
    foreach($sections as $i => $section) {
        $active = $i === 0 ? ' active' : '';
        echo '<div class="dir-section' . $active . '" id="dir-sec-' . $i . '">';
        echo '<div class="dir-section-title">' . strip_tags($titles[$i]) . '</div>';
        echo trim($section);
        echo '</div>';
    }
    echo '</div></div>';
    echo '<script>
    function dirTab(n) {
        document.querySelectorAll(".dir-menu-item").forEach(function(el,i){ el.classList.toggle("active", i===n); });
        document.querySelectorAll(".dir-section").forEach(function(el,i){ el.classList.toggle("active", i===n); });
    }
    </script>';

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
