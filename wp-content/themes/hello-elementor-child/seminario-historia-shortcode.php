<?php
function seminario_historia_shortcode() {
    $agenda = cesmeca_get_galeria_imagenes('semhist');
    $videos = cesmeca_get_youtube_videos('semhist');

    return cesmeca_render_gallery_tabs([
        'prefix' => 'semhist',
        'tabs' => [
            ['label' => 'Agenda académica', 'type' => 'images', 'items' => $agenda],
            ['label' => 'Videos', 'type' => 'videos', 'items' => $videos],
        ],
    ]);
}
add_shortcode('seminario_historia_page','seminario_historia_shortcode');
