<?php
function catedra_mercedes_shortcode() {
    $agenda = cesmeca_get_galeria_imagenes('merc');
    $videos = cesmeca_get_youtube_videos('merc');

    return cesmeca_render_gallery_tabs([
        'prefix' => 'merc',
        'tabs' => [
            ['label' => 'Agenda academica', 'type' => 'images', 'items' => $agenda],
            ['label' => 'Videos', 'type' => 'videos', 'items' => $videos],
        ],
    ]);
}
add_shortcode('catedra_mercedes_page','catedra_mercedes_shortcode');
