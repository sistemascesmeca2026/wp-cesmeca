<?php
/**
 * Sistema de Investigadores CESMECA
 * Plantilla de página "Investigador" + campos personalizados + directorio dinámico.
 * No usa un CPT nuevo: reutiliza el post_type 'page' para preservar exactamente
 * las URLs actuales (ej. /dvsolis/, /maguilar/) sin necesidad de reglas de
 * reescritura personalizadas.
 */

// 1. Registrar la plantilla de página "Investigador" para que aparezca en el selector
add_filter('theme_page_templates', function($templates) {
    $templates['plantilla-investigador.php'] = 'Investigador';
    return $templates;
});

// WordPress necesita que el archivo de plantilla exista físicamente; lo enganchamos
// vía template_include para no depender de un archivo separado en el tema.
add_filter('template_include', function($template) {
    if (is_page() && get_page_template_slug() === 'plantilla-investigador.php') {
        return __DIR__ . '/plantilla-investigador-render.php';
    }
    return $template;
});

// 2. Metabox de campos personalizados (solo visible si la plantilla es "Investigador")
add_action('add_meta_boxes', function() {
    add_meta_box(
        'cesmeca_investigador_campos',
        'Datos del investigador',
        'cesmeca_investigador_metabox_html',
        'page',
        'normal',
        'high'
    );
});

function cesmeca_investigador_metabox_html($post) {
    $template = get_page_template_slug($post->ID);
    if ($template !== 'plantilla-investigador.php') {
        echo '<p style="color:#888">Este metabox solo aplica cuando la plantilla de página es <strong>Investigador</strong>. Selecciona esa plantilla en el panel "Atributos de página" y guarda o actualiza la página para que aparezca.</p>';
        return;
    }
    wp_nonce_field('cesmeca_investigador_save', 'cesmeca_investigador_nonce');
    $campos = [
        'apellido' => ['label' => 'Apellido (para orden alfabético)', 'type' => 'text'],
        'perfil' => ['label' => 'Perfil', 'type' => 'editor'],
        'lineas_investigacion' => ['label' => 'Líneas de investigación', 'type' => 'textarea'],
        'proyectos_investigacion' => ['label' => 'Proyectos de investigación', 'type' => 'textarea'],
        'publicaciones' => ['label' => 'Algunas publicaciones', 'type' => 'editor'],
        'correo' => ['label' => 'Correo electrónico', 'type' => 'text'],
        'cooperacion_interinstitucional' => ['label' => 'Cooperación interinstitucional', 'type' => 'editor'],
    ];
    foreach ($campos as $key => $c) {
        $value = get_post_meta($post->ID, '_inv_' . $key, true);
        echo '<p style="margin-bottom:4px"><label for="inv_' . esc_attr($key) . '"><strong>' . esc_html($c['label']) . '</strong></label></p>';
        if ($c['type'] === 'editor') {
            wp_editor($value, 'inv_' . $key, [
                'textarea_name' => 'inv_' . $key,
                'textarea_rows' => 8,
                'media_buttons' => false,
                'teeny' => true,
            ]);
        } elseif ($c['type'] === 'textarea') {
            echo '<textarea name="inv_' . esc_attr($key) . '" id="inv_' . esc_attr($key) . '" rows="5" style="width:100%">' . esc_textarea($value) . '</textarea>';
        } else {
            echo '<input type="text" name="inv_' . esc_attr($key) . '" id="inv_' . esc_attr($key) . '" value="' . esc_attr($value) . '" style="width:100%">';
        }
        echo '<div style="margin-bottom:22px"></div>';
    }
    echo '<p style="color:#888;margin-top:10px">La foto se sube como "Imagen destacada" en el panel lateral derecho, igual que en cualquier página.</p>';
}

add_action('save_post_page', function($post_id) {
    if (!isset($_POST['cesmeca_investigador_nonce']) || !wp_verify_nonce($_POST['cesmeca_investigador_nonce'], 'cesmeca_investigador_save')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_page', $post_id)) {
        return;
    }
    $campos_editor = ['perfil', 'publicaciones', 'cooperacion_interinstitucional'];
    $campos_texto = ['apellido', 'lineas_investigacion', 'proyectos_investigacion'];
    foreach ($campos_editor as $key) {
        if (isset($_POST['inv_' . $key])) {
            update_post_meta($post_id, '_inv_' . $key, wp_kses_post($_POST['inv_' . $key]));
        }
    }
    foreach ($campos_texto as $key) {
        if (isset($_POST['inv_' . $key])) {
            update_post_meta($post_id, '_inv_' . $key, sanitize_textarea_field($_POST['inv_' . $key]));
        }
    }
    if (isset($_POST['inv_correo'])) {
        update_post_meta($post_id, '_inv_correo', sanitize_email($_POST['inv_correo']));
    }
});

// 3. Shortcode del directorio dinámico, ordenado alfabéticamente por apellido
add_shortcode('directorio_investigadores', function() {
    $query = new WP_Query([
        'post_type' => 'page',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'meta_query' => [
            [
                'key' => '_wp_page_template',
                'value' => 'plantilla-investigador.php',
            ],
        ],
    ]);

    if (!$query->have_posts()) {
        return '<p>No hay investigadores registrados todavía.</p>';
    }

    $items = [];
    foreach ($query->posts as $p) {
        $apellido = get_post_meta($p->ID, '_inv_apellido', true);
        $items[] = [
            'title' => get_the_title($p->ID),
            'url' => get_permalink($p->ID),
            'apellido' => $apellido ?: get_the_title($p->ID),
            'foto' => get_the_post_thumbnail_url($p->ID, 'medium'),
        ];
    }
    $normalizar = function($str) {
        $str = str_replace(['á','é','í','ó','ú','Á','É','Í','Ó','Ú','ñ','Ñ','ü','Ü'], ['a','e','i','o','u','A','E','I','O','U','n','N','u','U'], $str);
        return strtolower($str);
    };
    usort($items, function($a, $b) use ($normalizar) {
        return strcmp($normalizar($a['apellido']), $normalizar($b['apellido']));
    });

    ob_start();
    ?>
    <style>
    .dir-inv-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:36px 32px;margin-top:28px;padding:0 24px}
    @media(max-width:768px){.dir-inv-grid{grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:24px 16px;padding:0 20px}}
    @media(max-width:480px){.dir-inv-grid{grid-template-columns:repeat(2,1fr);gap:20px 12px;padding:0 16px}}
    .dir-inv-item{text-align:center;text-decoration:none!important;display:block;padding:12px;border-radius:12px;transition:transform .2s,box-shadow .2s}
    .dir-inv-item:hover{transform:translateY(-4px);box-shadow:0 8px 20px rgba(0,0,0,.08)}
    .dir-inv-photo{width:170px!important;height:170px!important;border-radius:50%;object-fit:cover;margin:0 auto 14px;display:block;filter:grayscale(100%);transition:filter .3s;border:1px solid #e5e5e5}
    .dir-inv-item:hover .dir-inv-photo{filter:grayscale(0%)}
    .dir-inv-photo-placeholder{width:170px;height:170px;border-radius:50%;background:#e5e5e5;margin:0 auto 14px}
    .dir-inv-name{color:#1a1a2e!important;font-weight:600;font-size:.95rem;text-decoration:none!important;line-height:1.4;min-height:2.8em;display:flex;align-items:center;justify-content:center;transition:color .2s}
    .dir-inv-item:hover .dir-inv-name{color:#3498db!important}
    </style>
    <div class="dir-inv-grid">
    <?php foreach ($items as $it): ?>
        <a class="dir-inv-item" href="<?php echo esc_url($it['url']); ?>">
            <?php if ($it['foto']): ?>
                <img class="dir-inv-photo" src="<?php echo esc_url($it['foto']); ?>" alt="<?php echo esc_attr($it['title']); ?>">
            <?php else: ?>
                <div class="dir-inv-photo-placeholder"></div>
            <?php endif; ?>
            <div class="dir-inv-name"><?php echo esc_html($it['title']); ?></div>
        </a>
    <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
});
