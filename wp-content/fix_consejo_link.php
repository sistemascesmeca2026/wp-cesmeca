<?php
$val = get_post_meta(1551, '_elementor_data', true);
$before = $val;
$val = str_replace('category\/blog\/concejo-academico', 'consejo-academico', $val);
if ($val !== $before) {
    update_post_meta(1551, '_elementor_data', $val);
    echo "Reemplazo hecho correctamente.\n";
} else {
    echo "No se encontro el texto a reemplazar.\n";
}
