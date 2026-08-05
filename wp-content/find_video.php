<?php
global $wpdb;
$rows = $wpdb->get_results("SELECT post_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key='_elementor_data' AND meta_value LIKE '%bDchhJxInWA%'");
foreach ($rows as $r) {
    $title = get_the_title($r->post_id);
    echo "Post ID: {$r->post_id} - Titulo: $title\n";
}
if (empty($rows)) {
    echo "No se encontro ningun post con ese video ID via bDchhJxInWA\n";
}
$rows2 = $wpdb->get_results("SELECT post_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key='_elementor_data' AND meta_value LIKE '%youtube%'");
foreach ($rows2 as $r) {
    $title = get_the_title($r->post_id);
    echo "Contiene 'youtube' - Post ID: {$r->post_id} - Titulo: $title\n";
}
