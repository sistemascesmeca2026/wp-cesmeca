<?php
global $wpdb;
$rows = $wpdb->get_results("SELECT meta_id, LENGTH(meta_value) as len FROM {$wpdb->postmeta} WHERE post_id=1551 AND meta_key='_elementor_data'");
foreach ($rows as $r) {
    echo "meta_id: {$r->meta_id}, longitud: {$r->len}\n";
}
echo "Total filas: " . count($rows) . "\n";
