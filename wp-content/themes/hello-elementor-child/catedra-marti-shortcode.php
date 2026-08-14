<?php
function catedra_marti_shortcode() {
    $agenda = cesmeca_get_galeria_imagenes('marti');
    $videos = cesmeca_get_youtube_videos('marti');

    return cesmeca_render_gallery_tabs([
        'prefix' => 'marti',
        'tabs' => [
            ['label' => 'Agenda academica', 'type' => 'images', 'items' => $agenda],
            ['label' => 'Videos', 'type' => 'videos', 'items' => $videos],
        ],
    ]);
}
add_shortcode('catedra_marti_page','catedra_marti_shortcode');
