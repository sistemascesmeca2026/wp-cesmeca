<?php
/**
 * Redirige URLs viejas de Joomla hacia el post/pagina real de WordPress.
 * Patrones soportados:
 *  - /{categoria}/{ID}-{slug}
 *  - /component/content/article/{catID}-{cat}/{ID}-{slug}
 *  - Rutas de menu con slug distinto al de produccion (mapeo explicito)
 * Busca por slug (post_type=post primero, luego page) ignorando la categoria reclamada.
 */
add_action("template_redirect", function() {
    if (!is_404()) return;
    $uri = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
    if (empty($uri)) return;

    // Excepcion especifica: slug original de Joomla excedia el limite de WordPress
    if (strpos($uri, "component/content/article/91-notas-informativas/434-") === 0) {
        $target = get_permalink(2069);
        if ($target) {
            wp_redirect($target, 301);
            exit;
        }
    }

    // Mapeo explicito: rutas de menu de produccion cuyo slug en WP es distinto
    $explicit_map = array(
        "investigacion/directorio-de-investigadoras-e-investigadores" => 1648,
        "vinculacion/laboratorio-audiovisual-de-investigacion-social-y-experimentacion-laud" => 1650,
        "vinculacion/laboratorio-de-cartografia-y-elaboracion-de-mapas-lacem" => 1690,
        "vinculacion/laboratorio-creacion-e-indicencia-feminista" => 1697,
        "contact-us" => 1713,
    );
    if (isset($explicit_map[$uri])) {
        $target = get_permalink($explicit_map[$uri]);
        if ($target) {
            wp_redirect($target, 301);
            exit;
        }
    }

    $segments = explode("/", $uri);
    $last = end($segments);
    if (preg_match("/^\d+-(.+)$/", $last, $m)) {
        $slug_candidate = $m[1];
    } else {
        $slug_candidate = $last;
    }
    $slug_candidate = sanitize_title($slug_candidate);
    if (empty($slug_candidate)) return;
    $post = get_page_by_path($slug_candidate, OBJECT, "post");
    if (!$post) {
        $post = get_page_by_path($slug_candidate, OBJECT, "page");
    }
    if ($post && $post->post_status === "publish") {
        wp_redirect(get_permalink($post->ID), 301);
        exit;
    }
});
